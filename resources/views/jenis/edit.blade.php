@extends('layouts.main')

@section('content')
    <div class="card border-0 shadow-sm rounded-4" style="max-width: 600px; margin: 0 auto;">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold text-dark mb-0">Edit Status</h4>
                <a href="{{ route('jenis.order') }}" class="btn btn-outline-secondary rounded-3">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <form action="{{ route('jenis.update', $jenis->id) }}" method="POST">
                @csrf
                {{-- Menggunakan POST sesuai route di web.php --}}

                <div class="mb-4">
                    <label for="name" class="form-label fw-bold">Nama Status</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name', $jenis->name) }}" placeholder="Contoh: Tersedia, Reservasi">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-warning fw-bold py-2 rounded-3 text-white">
                        <i class="bi bi-pencil-square me-1"></i> Update Status
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
