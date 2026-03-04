@extends('layouts.main')

@section('content')
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold text-dark mb-0">Edit Menu</h4>
                <a href="{{ route('produk') }}" class="btn btn-outline-secondary rounded-3">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- Route di web.php menggunakan POST untuk update, jadi tidak perlu @method('PUT') kecuali route diubah --}}

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label fw-bold">Nama Menu</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name', $produk->name) }}"
                            placeholder="Contoh: Nasi Goreng Spesial">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="kategori_id" class="form-label fw-bold">Kategori</label>
                        <select class="form-select @error('kategori_id') is-invalid @enderror" id="kategori_id"
                            name="kategori_id">
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}"
                                    {{ old('kategori_id', $produk->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="harga" class="form-label fw-bold">Harga (Rp)</label>
                        <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga"
                            name="harga" value="{{ old('harga', $produk->harga) }}" placeholder="0">
                        @error('harga')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="status" class="form-label fw-bold">Status</label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                            <option value="1" {{ old('status', $produk->status) == 1 ? 'selected' : '' }}>Tersedia
                            </option>
                            <option value="0" {{ old('status', $produk->status) == 0 ? 'selected' : '' }}>Habis
                            </option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="gambar" class="form-label fw-bold">Gambar Menu</label>
                        <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar"
                            name="gambar">
                        @if ($produk->gambar)
                            <div class="mt-2">
                                <img src="{{ asset('img/produk/' . $produk->gambar) }}" alt="Gambar Menu"
                                    class="img-thumbnail" style="height: 100px;">
                            </div>
                        @endif
                        @error('gambar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3"
                            placeholder="Deskripsi singkat menu...">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-warning fw-bold px-4 rounded-3 text-white">
                            <i class="bi bi-pencil-square me-1"></i> Update Menu
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
