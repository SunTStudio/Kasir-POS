@extends('layouts.main')
@section('style')
    <style>
        #head-meja {
            font-size: 1.25rem;
            font-weight: 400;
        }

        /* Custom Table Styles */
        .meja-wrapper {
            padding: 5px;
            transition: all 0.3s;
        }

        .meja-content {
            background-color: #fff;
            border: 1px solid #e3e6f0;
            border-radius: 12px;
            min-height: 90px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            position: relative;
            z-index: 5;
            transition: all 0.3s ease;
            width: 100%;
        }

        .chair-icon {
            color: #e3e6f0;
            font-size: 1.4rem;
            transition: color 0.3s;
            margin: 5px;
        }

        /* Status: Available (Tersedia) */
        .status-available .meja-content {
            border-color: #e3e6f0;
            background: #fff;
        }

        .status-available .meja-content h5 {
            color: #858796;
            font-weight: 600;
        }

        .status-available .chair-icon {
            color: #eaecf4;
        }

        .status-available:hover .chair-icon {
            color: #858796;
        }

        /* Status: Occupied (Terisi) */
        .status-occupied .meja-content {
            border-color: #212529;
            background: #212529;
        }

        .status-occupied .meja-content h5 {
            color: #fff;
        }

        .status-occupied .chair-icon {
            color: #495057;
        }

        .status-occupied .chair-icon.active {
            color: #212529;
        }

        /* Status: Reserved (Reservasi) */
        .status-reserved .meja-content {
            border-color: #858796;
            border-style: dashed;
            background: #f8f9fa;
        }

        .status-reserved .meja-content h5 {
            color: #5a5c69;
        }

        .status-reserved .chair-icon {
            color: #b7b9cc;
        }

        /* Utilities */
        .rotate-90 {
            transform: rotate(90deg);
        }

        .rotate-180 {
            transform: rotate(180deg);
        }

        .rotate-270 {
            transform: rotate(270deg);
        }

        .meja-info {
            font-size: 0.75rem;
            font-weight: 500;
            color: #858796;
            margin-top: 4px;
        }

        .status-occupied .meja-info {
            color: #d1d3e2;
        }

        .border-dashed {
            border-style: dashed !important;
        }
    </style>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    {{-- reservasi --}}
                    <div class="reservasi p-3 bg-light">
                        <select name="kategori-reservasi" id="" class="form-select">
                            <option value="">All</option>
                            <option value="">Reservasi</option>
                            <option value="">Makan Ditempat</option>
                            <option value="">Dibayar</option>
                            <option value="">Belum Dibayar</option>
                        </select>
                        {{-- tanggal hari ini, bisa di geser tanggalnya --}}
                        <div class="tanggal-reservasi mt-3 mb-3">
                            <input type="date" class="form-control" value="{{ date('Y-m-d') }}">
                        </div>
                        {{-- search customer floating name input --}}
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="bi bi-search "></i></span>
                            <input type="text" class="form-control" placeholder="Cari Customer" aria-label="Username"
                                aria-describedby="basic-addon1">
                        </div>
                        {{-- tambah tombol tambah reservasi --}}
                        {{-- <button class="btn btn-secondary w-100 mb-3 btn-sm"><i class="bi bi-plus-lg me-1"></i>Tambah
                            Reservasi / Permintaan</button> --}}

                        <div class="reservasi-items" style="max-height: 500px; overflow-y: auto;">
                            @php
                                $allReservations = collect();
                                foreach ($managementMejas as $meja) {
                                    foreach ($meja->reservasi_list as $reservasi) {
                                        $reservasi->meja_info = $meja;
                                        $allReservations->push($reservasi);
                                    }
                                }
                                $allReservations = $allReservations->sortBy('created_at');
                            @endphp

                            @forelse($allReservations as $reservasi)
                                @if ($reservasi->penjualan)
                                    <div class="card border-0 shadow-sm mb-3 rounded-3 overflow-hidden">
                                        <div class="d-flex align-items-stretch">
                                            {{-- Kolom Waktu --}}
                                            <div class="bg-secondary text-white p-2 d-flex flex-column justify-content-center align-items-center text-center"
                                                style="min-width: 75px;">
                                                <i class="bi bi-clock mb-1"></i>
                                                <span
                                                    class="fw-bold lh-1">{{ \Carbon\Carbon::parse($reservasi->created_at)->format('H:i') }}</span>
                                                <span class="small text-white-50"
                                                    style="font-size: 0.7rem;">{{ \Carbon\Carbon::parse($reservasi->created_at)->format('A') }}</span>
                                            </div>
                                            {{-- Kolom Detail --}}
                                            <div class="p-2 flex-grow-1 bg-white">
                                                <div class="d-flex justify-content-between align-items-start mb-1">
                                                    <h6 class="fw-bold mb-0 text-dark text-truncate"
                                                        style="max-width: 110px; font-size: 0.95rem;">
                                                        {{ $reservasi->penjualan->nama_pemesan }}</h6>
                                                    <div class="d-flex flex-column align-items-end gap-1">
                                                        {{-- @if ($reservasi->penjualan->status == 'paid')
                                                            <span
                                                                class="badge bg-success-subtle text-success border border-success-subtle rounded-pill"
                                                                style="font-size: 0.65rem;">Dibayar</span>
                                                        @else
                                                            <span
                                                                class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill"
                                                                style="font-size: 0.65rem;">Belum Bayar</span>
                                                        @endif --}}
                                                        {{-- Trigger Modal Status Meja --}}
                                                        <span onclick="openStatusModal({{ $reservasi->id }}, '{{ $reservasi->status }}')"
                                                            class="badge bg-info-subtle text-info border border-info-subtle rounded-pill cursor-pointer"
                                                            style="font-size: 0.65rem; cursor: pointer;">
                                                            {{ ucfirst(str_replace('_', ' ', $reservasi->status)) }}
                                                        </span>
                                                    </div>
                                                </div>
                                                @if ($reservasi->penjualan->no_telp)
                                                    <div class="d-flex align-items-center text-muted mb-2">
                                                        <i class="bi bi-whatsapp text-success me-1"
                                                            style="font-size: 0.8rem;"></i>
                                                        <span class="small"
                                                            style="font-size: 0.75rem;">{{ $reservasi->penjualan->no_telp }}</span>
                                                    </div>
                                                @endif
                                                {{-- no pesanan --}}
                                                <div class="d-flex align-items-center text-muted mb-2">
                                                    <i class="bi bi-receipt text-secondary me-1" style="font-size: 0.8rem;"></i>
                                                    <span class="small"
                                                        style="font-size: 0.75rem;">{{ $reservasi->penjualan->no_pesanan ?? 'No Pesanan' }}</span>
                                                </div>
                                                
                                                <div class="d-flex gap-2">
                                                    <div
                                                        class="badge bg-light text-secondary border fw-normal d-flex align-items-center px-2">
                                                        <i class="bi bi-people-fill me-1 text-primary"></i>
                                                        {{ $reservasi->jumlah }} Org
                                                    </div>
                                                    <div
                                                        class="badge bg-light text-secondary border fw-normal d-flex align-items-center px-2">
                                                        <i class="bi bi-grid-fill me-1 text-primary"></i>
                                                        {{ $reservasi->meja_info->name }}
                                                    </div>
                                                    {{-- area --}}
                                                    @if ($reservasi->meja_info->area)
                                                        <div
                                                            class="badge bg-light text-secondary border fw-normal d-flex align-items-center px-2">
                                                            <i class="bi bi-building me-1 text-primary"></i>
                                                            {{ $reservasi->meja_info->area->name }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @empty
                                <div class="text-center text-muted p-5">
                                    <i class="bi bi-calendar-x fs-2 d-block mb-2"></i>
                                    <h6 class="fw-bold">Tidak Ada Reservasi</h6>
                                    <p class="small">Belum ada data untuk hari ini.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    {{-- meja --}}
                    <div class="manajement-meja p-3">
                        <div class="head row">
                            <div class="col">
                                <p id="head-meja">Manajemen Meja</p>
                                <div class="status">
                                    <span
                                        class="badge bg-white text-secondary border border-secondary-subtle rounded-pill fw-normal"><i
                                            class="bi bi-check-lg me-1"></i>Tersedia</span>
                                    <span class="badge bg-dark text-white border border-dark rounded-pill fw-normal"><i
                                            class="bi bi-person-fill me-1"></i>Terisi</span>
                                    <span
                                        class="badge bg-light text-dark border border-dark border-dashed rounded-pill fw-normal"><i
                                            class="bi bi-clock me-1"></i>Reservasi</span>
                                </div>
                            </div>
                            <div class="col d-flex align-items-center gap-2 justify-content-end">
                                {{-- manage area --}}
                                <a href="{{ route('area') }}" class="btn btn-sm btn-outline-secondary rounded px-3">
                                    <i class="bi bi-gear me-1"></i>Manage Area
                                </a>
                                {{-- tombol tambah meja --}}
                                <a href="{{ route('manajement.meja.create') }}"
                                    class="btn btn-sm btn-outline-primary rounded px-3"><i
                                        class="bi bi-plus-lg me-1"></i>Tambah Meja</a>
                                {{-- tempat jadi bisa di teras, di dalam dll --}}
                                @foreach ($areas as $tempat)
                                    <span
                                        class="btn btn-sm btn-outline-secondary  border border-secondary-subtle ">{{ $tempat->name }}</span>
                                @endforeach

                            </div>
                        </div>
                        <hr>
                        <div class="manajement" style="max-height: 600px; overflow-y: auto; overflow-x: hidden;">
                            <div class="row g-4">
                                @foreach ($managementMejas as $meja)
                                    @php
                                        $kursi = $meja->jumlah_kursi;
                                        $terpakai = $meja->terpakai;
                                        $atas = ceil($kursi / 2);
                                        $bawah = floor($kursi / 2);
                                        $statusClass = $terpakai == $kursi ? 'status-occupied' : 'status-available';
                                    @endphp
                                    <div class="col-6 col-lg-3">
                                        <div
                                            class="meja-wrapper {{ $statusClass }} d-flex flex-column align-items-center">
                                            <div class="d-flex gap-2 mb-1">
                                                @for ($i = 0; $i < $atas; $i++)
                                                    <i
                                                        class="fas fa-chair chair-icon rotate-180 {{ $statusClass == 'status-occupied' ? 'active' : '' }}"></i>
                                                @endfor
                                            </div>
                                            <div class="meja-content w-100 py-3">
                                                <h5 class="fw-bold mb-0">{{ $meja->name }}</h5>
                                                <span class="meja-info">{{ $meja->jumlah_kursi }}/{{ $meja->terpakai }}
                                                    <i class="bi bi-people-fill"></i></span>
                                                @if ($meja->area)
                                                    <span class="meja-info small  d-block">{{ $meja->area->name }}</span>
                                                @endif
                                            </div>
                                            <div class="d-flex gap-2 mt-1">
                                                @for ($i = 0; $i < $bawah; $i++)
                                                    <i
                                                        class="fas fa-chair chair-icon {{ $statusClass == 'status-occupied' ? 'active' : '' }}"></i>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Update Status Akses Meja --}}
    <div class="modal fade" id="modalStatusAkses" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow">
                <div class="modal-header border-0 pb-0">
                    <h6 class="modal-title fw-bold">Status Meja</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formUpdateStatus">
                        <input type="hidden" id="akses_meja_id" name="id">
                        <div class="mb-3">
                            <select class="form-select form-select-sm" name="status" id="status_akses">
                                <option value="reservasi">Reservasi</option>
                                <option value="sedang_digunakan">Sedang Digunakan</option>
                                <option value="selesai">Selesai</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm w-100 rounded-3">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function openStatusModal(id, status) {
            document.getElementById('akses_meja_id').value = id;
            document.getElementById('status_akses').value = status;
            var myModal = new bootstrap.Modal(document.getElementById('modalStatusAkses'));
            myModal.show();
        }

        document.getElementById('formUpdateStatus').addEventListener('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            // Pastikan route 'akses_meja.update_status' sudah dibuat di web.php
            fetch('{{ route('akses_meja.update_status') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Gagal update status');
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
@endsection
