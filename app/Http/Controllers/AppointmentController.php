<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Appointment;
use App\Models\User;
use App\Models\ActivityLog;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $query = Appointment::with(['client', 'expert']);

        if ($user->role === 'client') {
            $query->where('client_id', $user->id);
        } else if ($user->role === 'expert') {
            $query->where('expert_id', $user->id);
        }

        $appointments = $query->orderBy('scheduled_at', 'desc')->paginate(10);
        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'client') abort(403);
        $experts = User::where('role', 'expert')->get();
        return view('appointments.create', compact('experts'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'client') abort(403);

        $validated = $request->validate([
            'expert_id' => 'required|exists:users,id',
            'scheduled_at' => 'required|date|after:now',
            'notes' => 'nullable|string|max:1000'
        ]);

        $appointment = Appointment::create([
            'client_id' => auth()->id(),
            'expert_id' => $validated['expert_id'],
            'scheduled_at' => $validated['scheduled_at'],
            'notes' => $validated['notes'],
            'status' => 'scheduled'
        ]);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Booked Appointment',
            'description' => "Booked appointment with expert {$appointment->expert->name}"
        ]);

        return redirect()->route('appointments.index')->with('success', 'Appointment booked successfully!');
    }

    public function show(Appointment $appointment)
    {
        $user = auth()->user();
        if ($user->role === 'client' && $appointment->client_id !== $user->id) abort(403);
        if ($user->role === 'expert' && $appointment->expert_id !== $user->id) abort(403);

        return view('appointments.show', compact('appointment'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        if (auth()->user()->role === 'client') abort(403);

        $validated = $request->validate([
            'status' => 'required|in:scheduled,completed,cancelled'
        ]);

        $appointment->update(['status' => $validated['status']]);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Updated Appointment Status',
            'description' => "Appointment status updated to {$validated['status']}"
        ]);

        return redirect()->back()->with('success', 'Appointment status updated successfully.');
    }

    public function destroy(string $id)
    {
        //
    }
}
