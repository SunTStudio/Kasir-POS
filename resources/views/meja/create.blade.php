@extends('layouts.main')

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">Tambah Meja Baru</h4>
            <form action="{{ route('manajement.meja.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Meja</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name') }}" placeholder="Contoh: Meja 1">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="area_id" class="form-label">Area</label>
                    <select class="form-select @error('area_id') is-invalid @enderror" id="area_id" name="area_id">
                        <option value="">Pilih Area</option>
                        @foreach ($areas as $area)
                            <option value="{{ $area->id }}" {{ old('area_id') == $area->id ? 'selected' : '' }}>
                                {{ $area->name }}</option>
                        @endforeach
                    </select>
                    @error('area_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="jumlah_kursi" class="form-label">Jumlah Kursi</label>
                    <input type="number" class="form-control @error('jumlah_kursi') is-invalid @enderror" id="jumlah_kursi"
                        name="jumlah_kursi" value="{{ old('jumlah_kursi', 4) }}" min="1">
                    @error('jumlah_kursi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('manajement.meja') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
