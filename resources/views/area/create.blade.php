@extends('layouts.main')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Tambah Area</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('area') }}">Area</a></li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>

        <div class="card mb-4" style="max-width: 600px;">
            <div class="card-header">
                <i class="fas fa-plus me-1"></i> Form Tambah Area
            </div>
            <div class="card-body">
                <form action="{{ route('area.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Area</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name') }}" placeholder="Contoh: Indoor, Outdoor, Lantai 2"
                            required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan</button>
                    <a href="{{ route('area') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
