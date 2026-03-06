<?php

namespace App\Http\Controllers;

use App\Models\AksesMeja;
use App\Models\Area;
use App\Models\ManagementMeja;
use Illuminate\Http\Request;

class ManagementMejaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $date = $request->input('date', date('Y-m-d'));
        $areas = Area::all();
        $managementMejas = ManagementMeja::with('area')->get();
        // cek apakah mejanya udah diakses semua melalui cek model akses meja
        foreach($managementMejas as $managementMeja){
            // Ambil data reservasi hari ini beserta data penjualan
            $reservasi = AksesMeja::with('penjualan')
                ->where('management_meja_id', $managementMeja->id)
                ->where('status', '!=', 'selesai')
                ->whereDate('created_at', $date)
                ->get();

            $managementMeja->reservasi_list = $reservasi;
            $managementMeja->terpakai = $reservasi->sum('jumlah');
        }
        return view('meja.index', compact('areas', 'managementMejas'));

    }

    /**
     * Show the form for creating a new resource.
     */ 
    public function create()
    {
        $areas = Area::all();
        return view('meja.create', compact('areas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'area_id' => 'required|exists:areas,id',
            'jumlah_kursi' => 'required|integer|min:1',
        ]);

        ManagementMeja::create($validated);

        return redirect()->route('manajement.meja')->with('success', 'Meja berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ManagementMeja $managementMeja)
    {
        return view('meja.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ManagementMeja $managementMeja)
    {
        return view('meja.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ManagementMeja $managementMeja)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ManagementMeja $managementMeja)
    {
        //
    }

    public function updateStatusAksesMeja(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:akses_mejas,id',
            'status' => 'required|in:digunakan,selesai,reservasi,pending',
        ]);

        $aksesMeja = AksesMeja::findOrFail($request->id);
        $aksesMeja->status = $request->status;
        $aksesMeja->save();

        return response()->json(['success' => true]);
    }

    public function filter(Request $request)
    {
        $areaId = $request->area_id;
        $date = $request->input('date', date('Y-m-d'));
        $kategori = $request->input('kategori', 'all');
        $query = ManagementMeja::with('area');

        if ($areaId && $areaId != 'all') {
            $query->where('area_id', $areaId);
        }

        $managementMejas = $query->get();
        $allReservations = collect();

        foreach ($managementMejas as $managementMeja) {
            $reservasiQuery = AksesMeja::with('penjualan')
                ->where('management_meja_id', $managementMeja->id)
                ->where('status', '!=', 'selesai')
                ->whereDate('created_at', $date);

            if ($kategori && $kategori !== 'all') {
                $searchName = ($kategori === 'reservasi') ? 'Reservasi' : 'Dine In';
                $reservasiQuery->whereHas('penjualan.jenis', function ($q) use ($searchName) {
                    $q->where('name', 'like', "%{$searchName}%");
                });
            }

            $reservasi = $reservasiQuery->get();

            $managementMeja->reservasi_list = $reservasi;
            $managementMeja->terpakai = $reservasi->sum('jumlah');

            // Collect reservations for the side list
            foreach ($reservasi as $res) {
                $res->meja_info = $managementMeja;
                $allReservations->push($res);
            }
        }

        $allReservations = $allReservations->sortBy('created_at');

        $mejaHtml = view('meja.list_partial', compact('managementMejas'))->render();
        $reservasiHtml = view('meja.reservasi_list_partial', compact('allReservations'))->render();

        return response()->json([
            'meja_html' => $mejaHtml,
            'reservasi_html' => $reservasiHtml
        ]);
    }
}
