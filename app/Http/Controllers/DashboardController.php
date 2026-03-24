<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patent;
use App\Models\Trademark;
use App\Models\Appointment;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $role = $user->role;

        $data = [
            'role' => $role,
            'total_patents' => 0,
            'pending_patents' => 0,
            'approved_patents' => 0,
            'rejected_patents' => 0,
            'recent_activities' => []
        ];

        if ($role === 'admin') {
            $data['total_patents'] = Patent::count();
            $data['pending_patents'] = Patent::where('status', 'pending')->count();
            $data['approved_patents'] = Patent::where('status', 'approved')->count();
            $data['rejected_patents'] = Patent::where('status', 'rejected')->count();
        } else if ($role === 'client') {
            $data['total_patents'] = Patent::where('user_id', $user->id)->count();
            $data['pending_patents'] = Patent::where('user_id', $user->id)->where('status', 'pending')->count();
            $data['approved_patents'] = Patent::where('user_id', $user->id)->where('status', 'approved')->count();
            $data['rejected_patents'] = Patent::where('user_id', $user->id)->where('status', 'rejected')->count();
        } else if ($role === 'expert') {
            $data['total_patents'] = Patent::where('status', 'under_review')->count(); // Experts review these
        }

        return view('dashboard', compact('data'));
    }
}
