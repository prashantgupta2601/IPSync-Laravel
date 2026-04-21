<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patent;
use App\Models\Trademark;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index()
    {
        if (auth()->user()->role !== 'admin')
            abort(403);

        // Initialize arrays
        $monthlyPatents = array_fill(1, 12, 0);
        $monthlyTrademarks = array_fill(1, 12, 0);

        // ✅ FIXED: SQLite compatible month extraction
        $patentsData = Patent::select(
            DB::raw("CAST(strftime('%m', created_at) AS INTEGER) as month"),
            DB::raw("COUNT(*) as count")
        )
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->get();

        foreach ($patentsData as $data) {
            $monthlyPatents[$data->month] = $data->count;
        }

        // ✅ FIXED: Same for trademarks
        $trademarksData = Trademark::select(
            DB::raw("CAST(strftime('%m', created_at) AS INTEGER) as month"),
            DB::raw("COUNT(*) as count")
        )
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->get();

        foreach ($trademarksData as $data) {
            $monthlyTrademarks[$data->month] = $data->count;
        }

        // Summary stats (unchanged)
        $stats = [
            'total_users' => User::count(),
            'clients' => User::where('role', 'client')->count(),
            'patents_by_status' => Patent::selectRaw('status, COUNT(*) as count')->groupBy('status')->pluck('count', 'status')->toArray(),
            'trademarks_by_status' => Trademark::selectRaw('status, COUNT(*) as count')->groupBy('status')->pluck('count', 'status')->toArray(),
        ];

        return view('analytics.index', compact('monthlyPatents', 'monthlyTrademarks', 'stats'));
    }
}