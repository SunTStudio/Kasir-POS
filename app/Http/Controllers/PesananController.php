<?php

namespace App\Http\Controllers;

use App\Models\AksesMeja;
use App\Models\ItemPenjualan;
use App\Models\Jenis;
use App\Models\Kategori;
use App\Models\ManagementMeja;
use App\Models\Payment;
use App\Models\Penjualan;
use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Penjualan::query();

        // Filter Tanggal (Default hari ini)
        $date = $request->input('date', date('Y-m-d'));
        $query->whereDate('tanggal_pemesanan', $date);

        // Filter Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('no_pesanan', 'like', "%{$search}%")
                    ->orWhere('nama_pemesan', 'like', "%{$search}%")
                    ->orWhereHas('meja', function ($subQ) use ($search) {
                        $subQ->where('name', 'like', "%{$search}%");
                    });
            });
        }

        $penjualanans = $query->get();
        // saya ingin memasukan collection deari item penjualan ke $penjualans
        foreach ($penjualanans as $penjualan) {
            $itemPenjualanan = ItemPenjualan::where('penjualan_id', $penjualan->id)->get();
            $penjualan->itemPenjualanan = $itemPenjualanan;
        }
        return view('pesanan.index', compact('penjualanans'));
    }

    /**
     * Show the form for creating a new resource. 
     */
    public function create()
    { 
        $produks = Produk::where('status', true)->get();
        $jenis = Jenis::all();
        $kategoris = Kategori::all();
        $mejas = ManagementMeja::all();

        // cek menegement meja cocokan dengan akses meja pada hari itu apakah sudah full atau belum
        foreach ($mejas as $meja) {
            $aksesMeja = AksesMeja::where('management_meja_id', $meja->id)
                ->where('status', '!=', 'selesai')
                ->whereDate('created_at', now()->toDateString())
                // sum jumlah
                ->sum('jumlah');
            if($aksesMeja >= $meja->jumlah_kursi){
                $meja->kapasitas = 'Penuh';
            } else {
                $meja->kapasitas = $meja->jumlah_kursi . '/' . ($aksesMeja)  ;
            }    
        }
        
        return view('pesanan.create', compact('produks', 'jenis', 'kategoris', 'mejas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'cart_items' => 'required|json',
            'nama_pemesan' => 'required|string|max:255',
            'jenis_id' => 'required', // Menerima string: dine_in, take_away, reservasi
            'meja_input' => 'nullable|array',
            'meja_input.*.id' => 'exists:management_mejas,id',
            'meja_input.*.jumlah' => 'required|integer|min:1',
        ]);
        $cart = json_decode($request->cart_items, true);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Keranjang pesanan kosong.');
        }

        // 2. Mapping Jenis Pesanan (String View -> DB ID)
        $jenisMap = [
            'dine_in' => 'Dine In',
            'take_away' => 'Take Away',
            'reservasi' => 'Reservasi',
        ];
        
        $jenisNama = $jenisMap[$request->jenis_id] ?? 'Dine In';
        // Cari ID jenis di database berdasarkan nama, jika tidak ada buat baru (opsional/safety)
        $jenis = Jenis::firstOrCreate(['name' => $jenisNama]);

        // 3. Logika Kondisional (Meja & Tanggal)
        $mejaInput = $request->meja_input ?? [];
        $tanggalPemesanan = now();
        
        // Pastikan meja_id null jika kosong (untuk menghindari error foreign key string kosong)
        if (empty($mejaInput)) {
            $mejaInput = [];
        }

        if ($request->jenis_id === 'take_away') {
            $mejaInput = []; // Take away tidak pakai meja
            $jumlahOrang = 1; // Default
        } elseif ($request->jenis_id === 'reservasi') {
            $tanggalPemesanan = $request->tanggal_pemesanan ?? now();
            // Hitung total orang dari input meja jika ada, jika tidak pakai input manual
            $jumlahOrang = !empty($mejaInput) ? collect($mejaInput)->sum('jumlah') : ($request->jumlah_orang ?? 1);
        } else {
            // Dine In
            $jumlahOrang = !empty($mejaInput) ? collect($mejaInput)->sum('jumlah') : ($request->jumlah_orang ?? 1);
        }

        // 4. Simpan Transaksi (Gunakan Transaction agar atomik)
        DB::transaction(function () use ($request, $cart, $jenis, $mejaInput, $tanggalPemesanan, $jumlahOrang) {
            // Ambil ID meja pertama sebagai referensi utama di tabel penjualan (jika ada)
            $primaryMejaId = $mejaInput[0]['id'] ?? null;
            
            $penjualan = Penjualan::create([
                'no_pesanan' => 'ORD-' . date('ymd') . '-' . strtoupper(substr(uniqid(), -4)),
                'nama_pemesan' => $request->nama_pemesan,
                'no_telp' => $request->no_telp,
                'jenis_id' => $jenis->id,
                'meja_id' => $primaryMejaId, // null jika take away, atau meja pertama jika ada
                'tanggal_pemesanan' => $tanggalPemesanan,
                'jumlah_orang' => $jumlahOrang,
                'status' => 'pending',
                'tanggal_penjualan' => now(),
            ]);

            // Hanya buat akses meja jika meja_id ada (bukan take away)
            if (!empty($mejaInput)) {
                foreach ($mejaInput as $item) {
                    AksesMeja::create([
                        'penjualan_id' => $penjualan->id,
                        'management_meja_id' => $item['id'],
                        'jumlah' => $item['jumlah'], // Gunakan jumlah spesifik per meja
                        'status' => 'pending',
                        'created_at' => $tanggalPemesanan, // Set tanggal agar sesuai reservasi
                        'updated_at' => $tanggalPemesanan,
                    ]);
                }
            }

            // Simpan Pembayaran (Jika ada input pembayaran)
            if ($request->filled('total_tagihan')) {
                // Hapus titik pemisah ribuan dari input (misal: 15.000 -> 15000)
                $jumlahBayar = (float) str_replace('.', '', $request->total_tagihan);

                if ($jumlahBayar > 0) {
                    Payment::create([
                        'penjualan_id' => $penjualan->id,
                        'metode' => 'cash', // Default cash sesuai UI
                        'jumlah' => $jumlahBayar,
                        'status' => 'paid',
                        'gambar' => null,
                    ]);
                }
            }

            foreach ($cart as $item) {
                ItemPenjualan::create([
                    'penjualan_id' => $penjualan->id,
                    'produk_id' => $item['id'],
                    'jumlah' => $item['qty'],
                    'harga' => $item['price'],
                ]);
            }
        });

        return redirect()->route('pesanan')->with('success', 'Pesanan berhasil dibuat!');
    }

    public function updateStatus(Request $request, $id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $newStatus = $request->input('status');
        // Validasi status baru
        $validStatuses = ['pending', 'cooking', 'served', 'paid', 'cancelled'];
        if (!in_array($newStatus, $validStatuses)) {
            return response()->json(['error' => 'Status tidak valid.'], 400);
        }

        // Update status penjualan
        $penjualan->status = $newStatus;
        $penjualan->save();

        return response()->json(['success' => 'Status berhasil diperbarui.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pesanan $pesanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pesanan $pesanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pesanan $pesanan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pesanan $pesanan)
    {
        //
    }

    public function struk($id)
    {
        $penjualan = Penjualan::with(['penjualans.produk', 'meja', 'payment'])->findOrFail($id);
        return view('pesanan.struk', compact('penjualan'));
    }
}
