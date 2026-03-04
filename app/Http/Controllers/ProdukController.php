<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Produk::with('kategori')->get(); // Mengambil data dari database dengan relasi
        return view('produk.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::all();
        return view('produk.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'harga' => 'required|numeric|min:0',
            'status' => 'required|boolean',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img/produk'), $filename);
            $validated['gambar'] = $filename;
        }

        Produk::create($validated);

        return redirect()->route('produk')->with('success', 'Menu berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // return view('produk.show', compact('produk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kategoris = Kategori::all();
        $produk = Produk::findOrFail($id);
        return view('produk.edit', compact('produk','kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'harga' => 'required|numeric|min:0',
            'status' => 'required|boolean',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $produk = Produk::findOrFail($id);


        if ($request->hasFile('gambar')) {
            if ($produk->gambar && file_exists(public_path('img/produk/' . $produk->gambar))) {
                unlink(public_path('img/produk/' . $produk->gambar));
            }
            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img/produk'), $filename);
            $validated['gambar'] = $filename;
        }

        $produk->update($validated);

        return redirect()->route('produk')->with('success', 'Menu berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if ($produk->gambar && file_exists(public_path('img/produk/' . $produk->gambar))) {
            unlink(public_path('img/produk/' . $produk->gambar));
        }
        $produk->delete();
        return redirect()->route('produk')->with('success', 'Menu berhasil dihapus!');
    }
}
