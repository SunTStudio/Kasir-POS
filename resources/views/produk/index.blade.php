@extends('layouts.main')
@section('content')
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body  p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-bold text-dark mb-1">Daftar Menu</h4>
                    <p class="text-muted small mb-0">Kelola semua menu makanan dan minuman restoran.</p>
                </div>
                <a href="{{ route('produk.create') }}" class="btn btn-primary fw-bold">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Menu
                </a>
            </div>
            <div class="rounded-4 p-3">
                <form action="#" method="GET" class="row g-2">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i
                                    class="bi bi-search"></i></span>
                            <input type="text" name="search" class="form-control border-start-0"
                                placeholder="Cari nama menu..." value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select name="category" class="form-select">
                            <option value="">Semua Kategori</option>
                            <option value="makanan" {{ request('category') == 'makanan' ? 'selected' : '' }}>Makanan
                            </option>
                            <option value="minuman" {{ request('category') == 'minuman' ? 'selected' : '' }}>Minuman
                            </option>
                            <option value="snack" {{ request('category') == 'snack' ? 'selected' : '' }}>Cemilan
                            </option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="sort" class="form-select">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga
                                Terendah</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga
                                Tertinggi</option>
                        </select>
                    </div>
                </form>
            </div>

            <div class="row g-4 bg-light mt-2 p-2 pb-4 m-2">

                @foreach ($products as $product)
                    <div class="col-sm-6 col-md-4 col-lg-2">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden product-card">
                            <div class="position-relative">
                                <img src="{{ $product->gambar ? asset('img/produk/' . $product->gambar) : asset('produk/sample.png') }}"
                                    class="card-img-top" alt="{{ $product->name }}"
                                    style="height: 180px; object-fit: cover;">
                                <div class="position-absolute top-0 start-0 m-2">
                                    <span
                                        class="badge bg-white text-dark shadow-sm">{{ $product->kategori->name ?? 'Umum' }}</span>
                                </div>
                                <div class="position-absolute top-0 end-0 m-2">
                                    <span
                                        class="badge {{ $product->status ? 'bg-success' : 'bg-danger' }} shadow-sm">{{ $product->status ? 'Tersedia' : 'Habis' }}</span>
                                </div>
                            </div>
                            <div class="card-body p-3 d-flex flex-column">
                                <h6 class="fw-bold text-dark mb-1 text-truncate">{{ $product->name }}</h6>
                                <p class="text-muted small mb-2 text-truncate">{{ $product->deskripsi }}</p>
                                <p class="text-primary fw-bold mb-3">Rp
                                    {{ number_format($product->harga, 0, ',', '.') }}</p>

                                <div class="mt-auto d-flex gap-2">
                                    <a href="{{ route('produk.edit', $product->id) }}"
                                        class="btn btn-outline-warning btn-sm flex-fill rounded-3">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <a href="{{ route('produk.delete', $product->id) }}"
                                        class="btn btn-outline-danger btn-sm flex-fill rounded-3"
                                        onclick="return confirm('Yakin ingin menghapus menu ini?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination Mockup --}}
            <div class="d-flex justify-content-end mt-4">
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <style>
        .product-card {
            transition: transform 0.2s;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }
    </style>
@endsection

@section('script')
@endsection
