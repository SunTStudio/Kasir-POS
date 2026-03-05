<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PenjualanController extends Controller
{
    public function index(Request $request)
    {
        // Hitung total pendapatan harian, bulanan, dan tahunan, total harga dari model payment
        // ambilnya dari Payment
        $dailyRevenue = Payment::where('status', 'paid')
            ->whereDate('created_at', now())
            ->sum('jumlah');
        $monthlyRevenue = Payment::where('status', 'paid')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('jumlah');
        $yearlyRevenue = Payment::where('status', 'paid')
            ->whereYear('created_at', now()->year)
            ->sum('jumlah');

        // Ambil transaksi terbaru
        $recentTransactions = Penjualan::with(['jenis', 'meja', 'payment'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

       foreach($recentTransactions as $transaction){
            $transaction->formatted_date = Carbon::parse($transaction->created_at)->format('d M Y H:i');
            $payment = Payment::where('penjualan_id', $transaction->id)->first();
            $transaction->total_amount = $transaction->payment ? $payment->jumlah : 0;
            
        }
        return view('keuangan.index', compact('dailyRevenue', 'monthlyRevenue', 'yearlyRevenue', 'recentTransactions'));
    }
}
