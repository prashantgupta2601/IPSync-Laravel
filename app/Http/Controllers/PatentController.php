<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Patent;
use App\Models\Document;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Storage;

class PatentController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $query = Patent::with('user');

        if ($user->role === 'client') {
            $query->where('user_id', $user->id);
        }

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $patents = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('patents.index', compact('patents'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'client') abort(403);
        return view('patents.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'client') abort(403);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'inventor_name' => 'required|string|max:255',
            'category' => 'required|string',
            'filing_date' => 'nullable|date',
            'documents.*' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:10240'
        ]);

        $patent = Patent::create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'description' => $validated['description'],
            'inventor_name' => $validated['inventor_name'],
            'category' => $validated['category'],
            'filing_date' => $validated['filing_date'] ?? now(),
        ]);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Submitted Patent',
            'description' => "Submitted patent application: {$patent->title}"
        ]);

        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $path = $file->store('patents', 'public');
                $patent->documents()->create([
                    'user_id' => auth()->id(),
                    'file_path' => $path,
                    'original_name' => $file->getClientOriginalName(),
                    'type' => $file->getClientOriginalExtension()
                ]);
            }
        }

        // Trigger Real-Time Notification (Pusher stub)
        // event(new PatentSubmitted($patent));

        return redirect()->route('patents.index')->with('success', 'Patent application submitted successfully.');
    }

    public function show(Patent $patent)
    {
        $user = auth()->user();
        if ($user->role === 'client' && $patent->user_id !== $user->id) abort(403);
        $patent->load('documents');
        return view('patents.show', compact('patent'));
    }

    public function update(Request $request, Patent $patent)
    {
        if (auth()->user()->role === 'client') abort(403);

        $validated = $request->validate([
            'status' => 'required|in:pending,under_review,approved,rejected'
        ]);

        $patent->update(['status' => $validated['status']]);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Updated Patent Status',
            'description' => "Updated patent {$patent->title} to status: {$validated['status']}"
        ]);

        return redirect()->back()->with('success', 'Patent status updated successfully.');
    }

    public function destroy(Patent $patent)
    {
        //
    }
}
