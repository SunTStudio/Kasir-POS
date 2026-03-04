@extends('layouts.main')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold text-dark mb-0">Edit Kategori</h5>
                </div>
                <div class="card-body p-4">
                    {{-- Asumsi $kategori dikirim dari controller --}}
                    <form action="{{ route('kategori.update', $kategori->id ?? 1) }}" method="POST">
                        @csrf
                        {{-- Gunakan method PUT jika controller mendukung resource, tapi route web.php Anda menggunakan POST --}}
                        {{-- @method('PUT') --}}

                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold small text-muted">Nama Kategori</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $kategori->name ?? 'Makanan Berat' }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="desc" class="form-label fw-bold small text-muted">Deskripsi Singkat</label>
                            <textarea class="form-control" id="desc" name="desc" rows="3">{{ $kategori->desc ?? 'Deskripsi contoh...' }}</textarea>
                        </div>
                        <div class="row mb-4">
                            {{-- <div class="col-md-6">
                                <label for="icon" class="form-label fw-bold small text-muted">Ikon (Bootstrap
                                    Icons)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-primary"
                                        style="font-size: 1.2rem;">
                                        <i class="{{ $kategori->icon ?? 'bi-box' }} bi" id="icon-preview"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0" id="icon" name="icon"
                                        value="{{ $kategori->icon ?? 'bi-box' }}">
                                </div>
                                <div class="form-text small">
                                    Gunakan nama class dari <a href="https://icons.getbootstrap.com/" target="_blank"
                                        class="text-decoration-none">Bootstrap Icons</a>.
                                </div>
                            </div> --}}
                            <div class="col-md-6">
                                <label for="color" class="form-label fw-bold small text-muted">Warna Tema</label>
                                <select class="form-select" id="color" name="color">
                                    @php
                                        $colors = [
                                            'primary',
                                            'secondary',
                                            'success',
                                            'danger',
                                            'warning',
                                            'info',
                                            'dark',
                                        ];
                                        $current = $kategori->color ?? 'primary';
                                    @endphp
                                    @foreach ($colors as $color)
                                        <option value="{{ $color }}" class="text-{{ $color }} fw-bold"
                                            {{ $current == $color ? 'selected' : '' }}>
                                            {{ ucfirst($color) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr class="border-light">
                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('kategori') }}" class="btn btn-light text-muted fw-bold px-4 rounded-3">
                                <i class="bi bi-arrow-left me-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary fw-bold px-4 rounded-3 shadow-sm">
                                <i class="bi bi-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const iconInput = document.getElementById('icon');
            const iconPreview = document.getElementById('icon-preview');

            // Update preview saat halaman dimuat (jika ada value)
            if (iconInput.value) {
                iconPreview.className = 'bi ' + iconInput.value;
            }

            iconInput.addEventListener('input', function() {
                iconPreview.className = 'bi ' + this.value;
            });
        });
    </script>
@endsection
