<?php

namespace App\Http\Controllers;

use App\Models\AksesMeja;
use App\Models\ItemPenjualan;
use App\Models\ManagementMeja;
use App\Models\Payment;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DahsboardController extends Controller
{
    public function index()
    { 
        // 1. Statistik Utama (Hari Ini)
        $today = now()->toDateString();

        $totalPesanan = Penjualan::whereDate('created_at', $today)->count();
        
        $pendapatan = Payment::whereDate('created_at', $today)
            ->where('status', 'paid')
            ->sum('jumlah');

        $pesananAktif = Penjualan::whereIn('status', ['pending', 'cooking', 'served'])->count();

        // 2. Ketersediaan Meja
        $totalMeja = ManagementMeja::count();
        $mejaTerpakai = AksesMeja::whereDate('created_at', $today)
            ->where('status', '!=', 'selesai')
            ->distinct('management_meja_id')
            ->count('management_meja_id');

        // 3. Pesanan Terbaru
        $recentOrders = Penjualan::with(['meja', 'payment', 'penjualans.produk'])
            ->latest()
            ->take(5)
            ->get();

        // 4. Menu Terlaris (Top 5)
        $topMenus = ItemPenjualan::select('produk_id', DB::raw('SUM(jumlah) as total_sold'))
            ->with('produk')
            ->whereHas('penjualan', function ($query) use ($today) {
                $query->whereDate('created_at', $today);
            })
            ->groupBy('produk_id')
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();

        // 5. Tipe Pesanan (untuk Pie Chart)
        $orderTypes = Penjualan::join('jenis', 'penjualans.jenis_id', '=', 'jenis.id')
            ->whereDate('penjualans.created_at', $today)
            ->select('jenis.name', DB::raw('count(*) as total'))
            ->groupBy('jenis.name')
            ->pluck('total', 'name');

        return view('dashboard', compact(
            'totalPesanan',
            'pendapatan',
            'pesananAktif',
            'totalMeja',
            'mejaTerpakai',
            'recentOrders',
            'topMenus',
            'orderTypes'
        ));
    }
}
