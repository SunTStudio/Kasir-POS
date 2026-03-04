<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class PenjualanController extends Controller
{
    public function index(Request $request)
    {
        // Data Statis (Dummy)
        $dailyRevenue = 2500000;   // Rp 2.500.000
        $monthlyRevenue = 45000000; // Rp 45.000.000
        $yearlyRevenue = 540000000; // Rp 540.000.000

        // Data Transaksi Statis
        // Menggunakan object stdClass agar mirip dengan hasil query Eloquent
        $recentTransactions = [
            (object) [
                'id' => 'ORD-005',
                'created_at' => Carbon::now()->subMinutes(15),
                'total_price' => 150000,
                'status' => 'paid'
            ],
            (object) [
                'id' => 'ORD-004',
                'created_at' => Carbon::now()->subHours(1),
                'total_price' => 75000,
                'status' => 'paid'
            ],
            (object) [
                'id' => 'ORD-003',
                'created_at' => Carbon::now()->subHours(3),
                'total_price' => 230000,
                'status' => 'paid'
            ],
            (object) [
                'id' => 'ORD-002',
                'created_at' => Carbon::yesterday()->setHour(19)->setMinute(30),
                'total_price' => 120000,
                'status' => 'paid'
            ],
        ];

        // Logika Filter Data Statis
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $startDate = Carbon::parse($request->start_date)->startOfDay();
            $endDate = Carbon::parse($request->end_date)->endOfDay();

            $recentTransactions = collect($recentTransactions)->filter(function ($item) use ($startDate, $endDate) {
                return $item->created_at->between($startDate, $endDate);
            });
        }

        return view('keuangan.index', compact('dailyRevenue', 'monthlyRevenue', 'yearlyRevenue', 'recentTransactions'));
    }
}
