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
                        <button class="btn btn-secondary w-100 mb-3 btn-sm"><i class="bi bi-plus-lg me-1"></i>Tambah
                            Reservasi</button>

                        {{-- Card Reservasi Item --}}
                        <div class="card border-0 shadow-sm mb-3 rounded-3 overflow-hidden">
                            <div class="d-flex align-items-stretch">
                                {{-- Kolom Waktu --}}
                                <div class="bg-secondary text-white p-2 d-flex flex-column justify-content-center align-items-center text-center"
                                    style="min-width: 75px;">
                                    <i class="bi bi-clock mb-1"></i>
                                    <span class="fw-bold lh-1">12:00</span>
                                    <span class="small text-white-50" style="font-size: 0.7rem;">PM</span>
                                </div>
                                {{-- Kolom Detail --}}
                                <div class="p-2 flex-grow-1 bg-white">
                                    <div class="d-flex justify-content-between align-items-start mb-1">
                                        <h6 class="fw-bold mb-0 text-dark text-truncate"
                                            style="max-width: 110px; font-size: 0.95rem;">John Doe</h6>
                                        <span
                                            class="badge bg-success-subtle text-success border border-success-subtle rounded-pill"
                                            style="font-size: 0.65rem;">Dibayar</span>
                                    </div>
                                    <div class="d-flex align-items-center text-muted mb-2">
                                        <i class="bi bi-whatsapp text-success me-1" style="font-size: 0.8rem;"></i>
                                        <span class="small" style="font-size: 0.75rem;">0812-3456-7890</span>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <div
                                            class="badge bg-light text-secondary border fw-normal d-flex align-items-center px-2">
                                            <i class="bi bi-people-fill me-1 text-primary"></i> 4 Org
                                        </div>
                                        <div
                                            class="badge bg-light text-secondary border fw-normal d-flex align-items-center px-2">
                                            <i class="bi bi-grid-fill me-1 text-primary"></i> Meja 1
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card border-0 shadow-sm mb-3 rounded-3 overflow-hidden">
                            <div class="d-flex align-items-stretch">
                                {{-- Kolom Waktu --}}
                                <div class="bg-success text-white p-2 d-flex flex-column justify-content-center align-items-center text-center"
                                    style="min-width: 75px;">
                                    <i class="bi bi-check-lg mb-1"></i>
                                    <span class="fw-bold lh-1" style="font-size: 0.8rem;">Tersedia</span>
                                </div>
                                {{-- Kolom Detail --}}
                                <div class="p-2 flex-grow-1 bg-white">
                                    <div class="d-flex justify-content-between align-items-start mb-1">
                                        <h6 class="fw-bold mb-0 text-dark text-truncate"
                                            style="max-width: 110px; font-size: 0.95rem;">Meja #2</h6>
                                        <span
                                            class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill"
                                            style="font-size: 0.65rem;">Kosong</span>
                                    </div>
                                    <div class="d-flex align-items-center text-muted mb-2">
                                        <span class="small" style="font-size: 0.75rem;">Siap digunakan</span>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <div
                                            class="badge bg-light text-secondary border fw-normal d-flex align-items-center px-2">
                                            <i class="bi bi-people-fill me-1 text-primary"></i> 2 Org
                                        </div>
                                        <div
                                            class="badge bg-light text-secondary border fw-normal d-flex align-items-center px-2">
                                            <i class="bi bi-grid-fill me-1 text-primary"></i> Meja 2
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card border-0 shadow-sm mb-3 rounded-3 overflow-hidden">
                            <div class="d-flex align-items-stretch">
                                {{-- Kolom Waktu --}}
                                <div class="bg-secondary text-white p-2 d-flex flex-column justify-content-center align-items-center text-center"
                                    style="min-width: 75px;">
                                    <i class="bi bi-clock mb-1"></i>
                                    <span class="fw-bold lh-1">13:30</span>
                                    <span class="small text-white-50" style="font-size: 0.7rem;">PM</span>
                                </div>
                                {{-- Kolom Detail --}}
                                <div class="p-2 flex-grow-1 bg-white">
                                    <div class="d-flex justify-content-between align-items-start mb-1">
                                        <h6 class="fw-bold mb-0 text-dark text-truncate"
                                            style="max-width: 110px; font-size: 0.95rem;">John Doe</h6>
                                        <span
                                            class="badge bg-success-subtle text-success border border-success-subtle rounded-pill"
                                            style="font-size: 0.65rem;">Dibayar</span>
                                    </div>
                                    <div class="d-flex align-items-center text-muted mb-2">
                                        <i class="bi bi-whatsapp text-success me-1" style="font-size: 0.8rem;"></i>
                                        <span class="small" style="font-size: 0.75rem;">0812-3456-7890</span>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <div
                                            class="badge bg-light text-secondary border fw-normal d-flex align-items-center px-2">
                                            <i class="bi bi-people-fill me-1 text-primary"></i> 4 Org
                                        </div>
                                        <div
                                            class="badge bg-light text-secondary border fw-normal d-flex align-items-center px-2">
                                            <i class="bi bi-grid-fill me-1 text-primary"></i> Meja 1
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card border-0 shadow-sm mb-3 rounded-3 overflow-hidden">
                            <div class="d-flex align-items-stretch">
                                {{-- Kolom Waktu --}}
                                <div class="bg-success text-white p-2 d-flex flex-column justify-content-center align-items-center text-center"
                                    style="min-width: 75px;">
                                    <i class="bi bi-check-lg mb-1"></i>
                                    <span class="fw-bold lh-1" style="font-size: 0.8rem;">Tersedia</span>
                                </div>
                                {{-- Kolom Detail --}}
                                <div class="p-2 flex-grow-1 bg-white">
                                    <div class="d-flex justify-content-between align-items-start mb-1">
                                        <h6 class="fw-bold mb-0 text-dark text-truncate"
                                            style="max-width: 110px; font-size: 0.95rem;">Meja #4</h6>
                                        <span
                                            class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill"
                                            style="font-size: 0.65rem;">Kosong</span>
                                    </div>
                                    <div class="d-flex align-items-center text-muted mb-2">
                                        <span class="small" style="font-size: 0.75rem;">Siap digunakan</span>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <div
                                            class="badge bg-light text-secondary border fw-normal d-flex align-items-center px-2">
                                            <i class="bi bi-people-fill me-1 text-primary"></i> 6 Org
                                        </div>
                                        <div
                                            class="badge bg-light text-secondary border fw-normal d-flex align-items-center px-2">
                                            <i class="bi bi-grid-fill me-1 text-primary"></i> Meja 4
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card border-0 shadow-sm mb-3 rounded-3 overflow-hidden">
                            <div class="d-flex align-items-stretch">
                                {{-- Kolom Waktu --}}
                                <div class="bg-secondary text-white p-2 d-flex flex-column justify-content-center align-items-center text-center"
                                    style="min-width: 75px;">
                                    <i class="bi bi-clock mb-1"></i>
                                    <span class="fw-bold lh-1">12:00</span>
                                    <span class="small text-white-50" style="font-size: 0.7rem;">PM</span>
                                </div>
                                {{-- Kolom Detail --}}
                                <div class="p-2 flex-grow-1 bg-white">
                                    <div class="d-flex justify-content-between align-items-start mb-1">
                                        <h6 class="fw-bold mb-0 text-dark text-truncate"
                                            style="max-width: 110px; font-size: 0.95rem;">John Doe</h6>
                                        <span
                                            class="badge bg-success-subtle text-success border border-success-subtle rounded-pill"
                                            style="font-size: 0.65rem;">Dibayar</span>
                                    </div>
                                    <div class="d-flex align-items-center text-muted mb-2">
                                        <i class="bi bi-whatsapp text-success me-1" style="font-size: 0.8rem;"></i>
                                        <span class="small" style="font-size: 0.75rem;">0812-3456-7890</span>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <div
                                            class="badge bg-light text-secondary border fw-normal d-flex align-items-center px-2">
                                            <i class="bi bi-people-fill me-1 text-primary"></i> 4 Org
                                        </div>
                                        <div
                                            class="badge bg-light text-secondary border fw-normal d-flex align-items-center px-2">
                                            <i class="bi bi-grid-fill me-1 text-primary"></i> Meja 1
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                {{-- tempat jadi bisa di teras, di dalam dll --}}
                                <span class="btn btn-sm btn btn-outline-secondary  border border-secondary-subtle ">Lantai
                                    1</span>
                                <span class="btn btn-sm btn btn-outline-secondary  border border-secondary-subtle ">Lantai
                                    2</span>
                                <span
                                    class="btn btn-sm btn btn-outline-secondary  border border-success-subtle ">Teras</span>
                            </div>
                        </div>
                        <hr>
                        <div class="manajement">
                            <div class="row g-4">
                                {{-- Meja 1: Tersedia (4 Kursi) --}}
                                <div class="col-6 col-lg-3">
                                    <div class="meja-wrapper status-available d-flex flex-column align-items-center">
                                        <div class="d-flex gap-3 mb-1">
                                            <i class="fas fa-chair chair-icon rotate-180"></i>
                                            <i class="fas fa-chair chair-icon rotate-180"></i>
                                        </div>
                                        <div class="meja-content w-100 py-3">
                                            <h5 class="fw-bold mb-0">Meja 1</h5>
                                            <span class="meja-info">4 Kursi</span>
                                        </div>
                                        <div class="d-flex gap-3 mt-1">
                                            <i class="fas fa-chair chair-icon"></i>
                                            <i class="fas fa-chair chair-icon"></i>
                                        </div>
                                    </div>
                                </div>

                                {{-- Meja 2: Terisi (2 Kursi) --}}
                                <div class="col-6 col-lg-3">
                                    <div class="meja-wrapper status-occupied d-flex flex-column align-items-center">
                                        <div class="d-flex gap-3 mb-1">
                                            <i class="fas fa-chair chair-icon rotate-180 active"></i>
                                        </div>
                                        <div class="meja-content w-100 py-3">
                                            <h5 class="fw-bold mb-0">Meja 2</h5>
                                            <span class="meja-info"><i class="bi bi-clock-history me-1"></i>00:45</span>
                                        </div>
                                        <div class="d-flex gap-3 mt-1">
                                            <i class="fas fa-chair chair-icon active"></i>
                                        </div>
                                    </div>
                                </div>

                                {{-- Meja 3: Reservasi (6 Kursi) --}}
                                <div class="col-12 col-lg-3">
                                    <div class="meja-wrapper status-reserved d-flex flex-column align-items-center">
                                        <div class="d-flex gap-4 mb-1">
                                            <i class="fas fa-chair chair-icon rotate-180"></i>
                                            <i class="fas fa-chair chair-icon rotate-180"></i>
                                            <i class="fas fa-chair chair-icon rotate-180"></i>
                                        </div>
                                        <div class="meja-content w-100 py-3">
                                            <h5 class="fw-bold mb-0">Meja 3</h5>
                                            <span class="meja-info">Rsrv: 19:00 (Ahmad)</span>
                                        </div>
                                        <div class="d-flex gap-4 mt-1">
                                            <i class="fas fa-chair chair-icon"></i>
                                            <i class="fas fa-chair chair-icon"></i>
                                            <i class="fas fa-chair chair-icon"></i>
                                        </div>
                                    </div>
                                </div>

                                {{-- Meja 4: Tersedia (2 Kursi Kiri Kanan) --}}
                                <div class="col-6 col-lg-3">
                                    <div
                                        class="meja-wrapper status-available d-flex align-items-center justify-content-center h-100">
                                        <div class="d-flex flex-column gap-2 me-1">
                                            <i class="fas fa-chair chair-icon rotate-90"></i>
                                        </div>
                                        <div class="meja-content flex-grow-1 py-4 px-2">
                                            <h5 class="fw-bold mb-0">Meja 4</h5>
                                            <span class="meja-info">2 Kursi</span>
                                        </div>
                                        <div class="d-flex flex-column gap-2 ms-1">
                                            <i class="fas fa-chair chair-icon rotate-270"></i>
                                        </div>
                                    </div>
                                </div>

                                {{-- Meja 5: Tersedia (4 Kursi) --}}
                                <div class="col-6 col-lg-3">
                                    <div class="meja-wrapper status-available d-flex flex-column align-items-center">
                                        <div class="d-flex gap-3 mb-1">
                                            <i class="fas fa-chair chair-icon rotate-180"></i>
                                            <i class="fas fa-chair chair-icon rotate-180"></i>
                                        </div>
                                        <div class="meja-content w-100 py-3">
                                            <h5 class="fw-bold mb-0">Meja 5</h5>
                                            <span class="meja-info">4 Kursi</span>
                                        </div>
                                        <div class="d-flex gap-3 mt-1">
                                            <i class="fas fa-chair chair-icon"></i>
                                            <i class="fas fa-chair chair-icon"></i>
                                        </div>
                                    </div>
                                </div>

                                {{-- Meja 6: Terisi (4 Kursi) --}}
                                <div class="col-6 col-lg-3">
                                    <div class="meja-wrapper status-occupied d-flex flex-column align-items-center">
                                        <div class="d-flex gap-3 mb-1">
                                            <i class="fas fa-chair chair-icon rotate-180 active"></i>
                                            <i class="fas fa-chair chair-icon rotate-180 active"></i>
                                        </div>
                                        <div class="meja-content w-100 py-3">
                                            <h5 class="fw-bold mb-0">Meja 6</h5>
                                            <span class="meja-info"><i class="bi bi-clock-history me-1"></i>01:15</span>
                                        </div>
                                        <div class="d-flex gap-3 mt-1">
                                            <i class="fas fa-chair chair-icon active"></i>
                                            <i class="fas fa-chair chair-icon active"></i>
                                        </div>
                                    </div>
                                </div>

                                {{-- Meja 7: Tersedia (2 Kursi) --}}
                                <div class="col-6 col-lg-3">
                                    <div class="meja-wrapper status-available d-flex flex-column align-items-center">
                                        <div class="d-flex gap-3 mb-1">
                                            <i class="fas fa-chair chair-icon rotate-180"></i>
                                        </div>
                                        <div class="meja-content w-100 py-3">
                                            <h5 class="fw-bold mb-0">Meja 7</h5>
                                            <span class="meja-info">2 Kursi</span>
                                        </div>
                                        <div class="d-flex gap-3 mt-1">
                                            <i class="fas fa-chair chair-icon"></i>
                                        </div>
                                    </div>
                                </div>

                                {{-- Meja 8: Reservasi (4 Kursi) --}}
                                <div class="col-6 col-lg-3">
                                    <div class="meja-wrapper status-reserved d-flex flex-column align-items-center">
                                        <div class="d-flex gap-3 mb-1">
                                            <i class="fas fa-chair chair-icon rotate-180"></i>
                                            <i class="fas fa-chair chair-icon rotate-180"></i>
                                        </div>
                                        <div class="meja-content w-100 py-3">
                                            <h5 class="fw-bold mb-0">Meja 8</h5>
                                            <span class="meja-info">Rsrv: 20:00 (Budi)</span>
                                        </div>
                                        <div class="d-flex gap-3 mt-1">
                                            <i class="fas fa-chair chair-icon"></i>
                                            <i class="fas fa-chair chair-icon"></i>
                                        </div>
                                    </div>
                                </div>

                                {{-- Meja 9: Tersedia (6 Kursi) --}}
                                <div class="col-12 col-lg-3">
                                    <div class="meja-wrapper status-available d-flex flex-column align-items-center">
                                        <div class="d-flex gap-4 mb-1">
                                            <i class="fas fa-chair chair-icon rotate-180"></i>
                                            <i class="fas fa-chair chair-icon rotate-180"></i>
                                            <i class="fas fa-chair chair-icon rotate-180"></i>
                                        </div>
                                        <div class="meja-content w-100 py-3">
                                            <h5 class="fw-bold mb-0">Meja 9</h5>
                                            <span class="meja-info">6 Kursi</span>
                                        </div>
                                        <div class="d-flex gap-4 mt-1">
                                            <i class="fas fa-chair chair-icon"></i>
                                            <i class="fas fa-chair chair-icon"></i>
                                            <i class="fas fa-chair chair-icon"></i>
                                        </div>
                                    </div>
                                </div>

                                {{-- Meja 10: Terisi (2 Kursi Kiri Kanan) --}}
                                <div class="col-6 col-lg-3">
                                    <div class="meja-wrapper status-occupied d-flex align-items-center justify-content-center h-100">
                                        <div class="d-flex flex-column gap-2 me-1">
                                            <i class="fas fa-chair chair-icon rotate-90 active"></i>
                                        </div>
                                        <div class="meja-content flex-grow-1 py-4 px-2">
                                            <h5 class="fw-bold mb-0">Meja 10</h5>
                                            <span class="meja-info"><i class="bi bi-clock-history me-1"></i>00:20</span>
                                        </div>
                                        <div class="d-flex flex-column gap-2 ms-1">
                                            <i class="fas fa-chair chair-icon rotate-270 active"></i>
                                        </div>
                                    </div>
                                </div>

                                {{-- Meja 11: Tersedia (4 Kursi) --}}
                                <div class="col-6 col-lg-3">
                                    <div class="meja-wrapper status-available d-flex flex-column align-items-center">
                                        <div class="d-flex gap-3 mb-1">
                                            <i class="fas fa-chair chair-icon rotate-180"></i>
                                            <i class="fas fa-chair chair-icon rotate-180"></i>
                                        </div>
                                        <div class="meja-content w-100 py-3">
                                            <h5 class="fw-bold mb-0">Meja 11</h5>
                                            <span class="meja-info">4 Kursi</span>
                                        </div>
                                        <div class="d-flex gap-3 mt-1">
                                            <i class="fas fa-chair chair-icon"></i>
                                            <i class="fas fa-chair chair-icon"></i>
                                        </div>
                                    </div>
                                </div>

                                {{-- Meja 12: Tersedia (4 Kursi) --}}
                                <div class="col-6 col-lg-3">
                                    <div class="meja-wrapper status-available d-flex flex-column align-items-center">
                                        <div class="d-flex gap-3 mb-1">
                                            <i class="fas fa-chair chair-icon rotate-180"></i>
                                            <i class="fas fa-chair chair-icon rotate-180"></i>
                                        </div>
                                        <div class="meja-content w-100 py-3">
                                            <h5 class="fw-bold mb-0">Meja 12</h5>
                                            <span class="meja-info">4 Kursi</span>
                                        </div>
                                        <div class="d-flex gap-3 mt-1">
                                            <i class="fas fa-chair chair-icon"></i>
                                            <i class="fas fa-chair chair-icon"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
