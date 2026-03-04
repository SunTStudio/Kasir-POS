@extends('layouts.main')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold text-dark mb-0">Tambah Kategori Baru</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('kategori.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold small text-muted">Nama Kategori</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Contoh: Makanan Berat" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label fw-bold small text-muted">Deskripsi Singkat</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"
                                placeholder="Deskripsi singkat kategori..."></textarea>
                        </div>
                        <div class="row mb-4">
                            {{-- <div class="col-md-6">
                                <label for="icon" class="form-label fw-bold small text-muted">Ikon (Bootstrap
                                    Icons)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-primary"
                                        style="font-size: 1.2rem;">
                                        <i class="bi bi-box" id="icon-preview"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0" id="icon" name="icon"
                                        placeholder="bi-egg-fried" value="bi-box">
                                </div>
                                <div class="form-text small">
                                    Gunakan nama class dari <a href="https://icons.getbootstrap.com/" target="_blank"
                                        class="text-decoration-none">Bootstrap Icons</a>.
                                </div>
                            </div> --}}
                            {{-- <div class="col-md-6">
                                <label for="color" class="form-label fw-bold small text-muted">Warna Tema</label>
                                <select class="form-select" id="color" name="color">
                                    <option value="primary" class="text-primary fw-bold">Primary (Biru)</option>
                                    <option value="secondary" class="text-secondary fw-bold">Secondary (Abu-abu)</option>
                                    <option value="success" class="text-success fw-bold">Success (Hijau)</option>
                                    <option value="danger" class="text-danger fw-bold">Danger (Merah)</option>
                                    <option value="warning" class="text-warning fw-bold">Warning (Kuning)</option>
                                    <option value="info" class="text-info fw-bold">Info (Biru Muda)</option>
                                    <option value="dark" class="text-dark fw-bold">Dark (Hitam)</option>
                                </select>
                            </div> --}}
                        </div>
                        <hr class="border-light">
                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('kategori') }}" class="btn btn-light text-muted fw-bold px-4 rounded-3">
                                <i class="bi bi-arrow-left me-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary fw-bold px-4 rounded-3 shadow-sm">
                                <i class="bi bi-save me-1"></i> Simpan Kategori
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
        // Script sederhana untuk preview icon secara real-time
        document.addEventListener('DOMContentLoaded', function() {
            const iconInput = document.getElementById('icon');
            const iconPreview = document.getElementById('icon-preview');

            iconInput.addEventListener('input', function() {
                // Hapus 'bi-' jika user mengetiknya double, lalu tambahkan kembali
                let val = this.value.trim();
                if (!val.startsWith('bi-')) val = 'bi-' + val; // Optional: auto fix prefix
                // Atau biarkan user mengetik full class
                iconPreview.className = 'bi ' + this.value;
            });
        });
    </script>
@endsection
