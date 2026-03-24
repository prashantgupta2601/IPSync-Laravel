<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Trademark;
use App\Models\ActivityLog;

class TrademarkController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $query = Trademark::with('user');

        if ($user->role === 'client') {
            $query->where('user_id', $user->id);
        }

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $trademarks = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('trademarks.index', compact('trademarks'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'client') abort(403);
        return view('trademarks.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'client') abort(403);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'category' => 'required|string',
            'description' => 'required|string',
            'documents.*' => 'nullable|file|mimes:pdf,jpg,png|max:10240'
        ]);

        $trademark = Trademark::create([
            'user_id' => auth()->id(),
            'name' => $validated['name'],
            'owner_name' => $validated['owner_name'],
            'category' => $validated['category'],
            'description' => $validated['description']
        ]);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Submitted Trademark',
            'description' => "Submitted trademark application: {$trademark->name}"
        ]);

        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $path = $file->store('trademarks', 'public');
                $trademark->documents()->create([
                    'user_id' => auth()->id(),
                    'file_path' => $path,
                    'original_name' => $file->getClientOriginalName(),
                    'type' => $file->getClientOriginalExtension()
                ]);
            }
        }

        return redirect()->route('trademarks.index')->with('success', 'Trademark application submitted successfully.');
    }

    public function show(Trademark $trademark)
    {
        $user = auth()->user();
        if ($user->role === 'client' && $trademark->user_id !== $user->id) abort(403);
        $trademark->load('documents');
        return view('trademarks.show', compact('trademark'));
    }

    public function update(Request $request, Trademark $trademark)
    {
        if (auth()->user()->role === 'client') abort(403);

        $validated = $request->validate([
            'status' => 'required|in:pending,under_review,approved,rejected'
        ]);

        $trademark->update(['status' => $validated['status']]);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Updated Trademark Status',
            'description' => "Updated trademark {$trademark->name} to status: {$validated['status']}"
        ]);

        return redirect()->back()->with('success', 'Trademark status updated successfully.');
    }

    public function destroy(string $id)
    {
        //
    }
}
