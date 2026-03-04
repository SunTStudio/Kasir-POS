@extends('layouts.main')
@section('content')
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-bold text-dark mb-1">Kategori Menu</h4>
                    <p class="text-muted small mb-0">Kelola kategori untuk mengelompokkan menu restoran.</p>
                </div>
                <a href="{{ route('kategori.create') }}" class="btn btn-primary fw-bold">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Kategori
                </a>
            </div>

            <div class="bg-light rounded-4 p-3 mb-4">
                <form action="#" method="GET">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                        <input type="text" id="searchInput" name="search" class="form-control border-start-0"
                            placeholder="Cari kategori..." value="{{ request('search') }}">
                    </div>
                </form>
            </div>

            <div class="row g-4 bg-light rounded-4 m-1 pb-3">
                @foreach ($kategoris as $cat)
                    <div class="col-sm-6 col-md-4 col-lg-3 category-item">
                        <div
                            class="card h-100 border-0 shadow-sm rounded-4 category-card position-relative overflow-hidden">
                            <div class="card-body p-4 text-center">
                                {{-- <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-{{ $cat['color'] }}-subtle text-{{ $cat['color'] }} mb-3"
                                    style="width: 64px; height: 64px; font-size: 1.75rem;">
                                    <i class="bi {{ $cat['icon'] }}"></i>
                                </div> --}}
                                <h5 class="fw-bold text-dark mb-1 category-name">{{ $cat->name }}</h5>
                                <p class="text-muted small mb-3">{{ $cat->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
                                {{-- <span class="badge bg-light text-secondary border rounded-pill px-3 py-2">
                                    {{ $cat['count'] }} Menu
                                </span> --}}
                            </div>
                            <div class="card-footer bg-white border-0 pt-0 pb-4 d-flex justify-content-center gap-2">
                                <a href="{{ route('kategori.edit', $cat->id) }}"
                                    class="btn btn-outline-warning btn-sm rounded-3 px-3">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="{{ route('kategori.delete', $cat->id) }}"
                                    class="btn btn-outline-danger btn-sm rounded-3 px-3"
                                    onclick="return confirm('Hapus kategori ini?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('style')
    <style>
        .category-card {
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
        }
    </style>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const items = document.querySelectorAll('.category-item');

            searchInput.addEventListener('keyup', function(e) {
                const term = e.target.value.toLowerCase();

                items.forEach(function(item) {
                    const name = item.querySelector('.category-name').textContent.toLowerCase();
                    if (name.includes(term)) {
                        item.style.display = ''; // Tampilkan kembali (default CSS)
                    } else {
                        item.style.display = 'none'; // Sembunyikan
                    }
                });
            });
        });
    </script>
@endsection
