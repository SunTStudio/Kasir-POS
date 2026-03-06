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
                <div class="col-md-4 col-lg-4">
                    {{-- reservasi --}}
                    <div class="reservasi p-3 bg-light">
                        <select name="kategori-reservasi" id="filter-kategori" class="form-select">
                            <option value="all">All</option>
                            <option value="reservasi">Reservasi</option>
                            <option value="dine_in">Dine In</option>
                        </select>
                        {{-- tanggal hari ini, bisa di geser tanggalnya --}}
                        <div class="tanggal-reservasi mt-3 mb-3">
                            <input type="date" id="filter-date" class="form-control"
                                value="{{ request('date', date('Y-m-d')) }}">
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

                        <div class="reservasi-items" id="reservasi-list-container"
                            style="max-height: 500px; overflow-y: auto;">
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
                            @include('meja.reservasi_list_partial')
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-lg-8">
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
                                <button class="btn btn-sm btn-dark border border-secondary-subtle filter-area-btn"
                                    data-id="all">All</button>
                                @foreach ($areas as $tempat)
                                    <button
                                        class="btn btn-sm btn-outline-secondary border border-secondary-subtle filter-area-btn"
                                        data-id="{{ $tempat->id }}">{{ $tempat->name }}</button>
                                @endforeach

                            </div>
                        </div>
                        <hr>
                        <div class="manajement" style="max-height: 600px; overflow-y: auto; overflow-x: hidden;">
                            <div class="row g-4" id="meja-list-container">
                                @include('meja.list_partial')
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
                                <option value="pending">Pending</option>
                                <option value="reservasi">Reservasi</option>
                                <option value="digunakan">Digunakan</option>
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

        // AJAX Filter Area & Date
        document.addEventListener('DOMContentLoaded', function() {
            const filterButtons = document.querySelectorAll('.filter-area-btn');
            const dateInput = document.getElementById('filter-date');
            const kategoriSelect = document.getElementById('filter-kategori');
            const container = document.getElementById('meja-list-container');
            const reservasiContainer = document.getElementById('reservasi-list-container');

            function fetchData(areaId, date, kategori) {
                fetch(`{{ route('manajement.meja.filter') }}?area_id=${areaId}&date=${date}&kategori=${kategori}`)
                    .then(response => response.json())
                    .then(data => {
                        container.innerHTML = data.meja_html;
                        reservasiContainer.innerHTML = data.reservasi_html;
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                        container.innerHTML =
                            '<div class="col-12 text-center text-danger">Gagal memuat data meja.</div>';
                    });
            }

            filterButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Visual feedback: set active class
                    filterButtons.forEach(b => {
                        b.classList.remove('btn-dark', 'text-white');
                        b.classList.add('btn-outline-secondary');
                    });
                    this.classList.remove('btn-outline-secondary');
                    this.classList.add('btn-dark', 'text-white');

                    const areaId = this.getAttribute('data-id');
                    const date = dateInput.value;
                    const kategori = kategoriSelect.value;
                    fetchData(areaId, date, kategori);
                });
            });

            dateInput.addEventListener('change', function() {
                // Ambil area yang sedang aktif
                const activeBtn = document.querySelector('.filter-area-btn.btn-dark');
                const areaId = activeBtn ? activeBtn.getAttribute('data-id') : 'all';
                const date = this.value;
                const kategori = kategoriSelect.value;
                fetchData(areaId, date, kategori);
            });

            kategoriSelect.addEventListener('change', function() {
                const activeBtn = document.querySelector('.filter-area-btn.btn-dark');
                const areaId = activeBtn ? activeBtn.getAttribute('data-id') : 'all';
                const date = dateInput.value;
                const kategori = this.value;
                fetchData(areaId, date, kategori);
            });
        });
    </script>
@endsection
