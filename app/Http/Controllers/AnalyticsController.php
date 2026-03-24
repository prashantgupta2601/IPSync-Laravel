<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patent;
use App\Models\Trademark;
use App\Models\User;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    public function index()
    {
        if (auth()->user()->role !== 'admin') abort(403);

        // Get monthly applications count for the current year
        $monthlyPatents = array_fill(1, 12, 0);
        $monthlyTrademarks = array_fill(1, 12, 0);

        $patentsData = Patent::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->get();

        foreach ($patentsData as $data) {
            $monthlyPatents[$data->month] = $data->count;
        }

        $trademarksData = Trademark::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->get();

        foreach ($trademarksData as $data) {
            $monthlyTrademarks[$data->month] = $data->count;
        }

        // Summary statistics
        $stats = [
            'total_users' => User::count(),
            'clients' => User::where('role', 'client')->count(),
            'patents_by_status' => Patent::selectRaw('status, COUNT(*) as count')->groupBy('status')->pluck('count', 'status')->toArray(),
            'trademarks_by_status' => Trademark::selectRaw('status, COUNT(*) as count')->groupBy('status')->pluck('count', 'status')->toArray(),
        ];

        return view('analytics.index', compact('monthlyPatents', 'monthlyTrademarks', 'stats'));
    }
}
