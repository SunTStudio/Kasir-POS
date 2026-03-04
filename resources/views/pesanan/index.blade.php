@extends('layouts.main')
@section('content')
    <div class="card">
        <div class="card-body p-4">
            <div class="head  align-items-center mb-4 ">
                {{-- tanggal harin ini format hari, tgl bulan tahun --}}
                <div class="d-flex justify-content-between align-items-center">
                    <form action="" method="GET">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-white border-end-0"><i class="bi bi-calendar3"></i></span>
                            <input type="date" name="date" class="form-control border-start-0 fw-medium text-secondary"
                                value="{{ request('date', date('Y-m-d')) }}" onchange="this.form.submit()">
                        </div>
                    </form>
                    <div class="d-flex gap-2">
                        <div class="input-group input-group-sm" style="width: 250px;">
                            <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control border-start-0"
                                placeholder="Cari No. Pesanan atau Meja...">
                        </div>
                        <a href="{{ route('pesanan.create') }}" class="btn btn-primary btn-sm px-3">
                            <i class="bi bi-plus-lg me-1"></i> Buat Pesanan
                        </a>
                    </div>
                </div>
                <hr>
                <h5 class="card-title">List Order</h5>
                <div class="d-flex gap-2 flex-wrap">
                    {{-- tombol all, baru, dimasak, siap, selesai, batal,dll --}}
                    <button class="btn btn-sm btn-dark rounded px-3">
                        All <span class="badge bg-white text-dark ms-1">30</span>
                    </button>
                    <button class="btn btn-sm btn-outline-primary rounded px-3">
                        Baru <span class="badge bg-primary text-white ms-1">30</span>
                    </button>
                    <button class="btn btn-sm btn-outline-warning rounded px-3">
                        Dimasak <span class="badge bg-warning text-dark ms-1">30</span>
                    </button>
                    <button class="btn btn-sm btn-outline-success rounded px-3">
                        Siap <span class="badge bg-success text-white ms-1">30</span>
                    </button>
                    <button class="btn btn-sm btn-outline-secondary rounded px-3">
                        Selesai <span class="badge bg-secondary text-white ms-1">30</span>
                    </button>
                    <button class="btn btn-sm btn-outline-danger rounded px-3">
                        Batal <span class="badge bg-danger text-white ms-1">30</span>
                    </button>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col col-lg-3">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="head-order">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="fw-bold mb-0">Order #ORD-20231001-001</h6>
                                        <small class="text-muted"><i class="bi bi-clock me-1"></i>10:30 AM</small>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-primary-subtle text-primary rounded-pill px-3">Baru</span>
                                        <div class="mt-1">
                                            <span class="badge bg-light text-dark border fw-normal"><i
                                                    class="bi bi-grid-fill me-1 text-primary"></i> Meja 5</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="order-items mb-3">
                                    <div class="d-flex justify-content-between small mb-1">
                                        <span>2x Nasi Goreng Spesial</span>
                                        <span class="text-muted">Rp 50.000</span>
                                    </div>
                                    <div class="d-flex justify-content-between small mb-1">
                                        <span>1x Es Teh Manis</span>
                                        <span class="text-muted">Rp 5.000</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center border-top pt-3">
                                    <div>
                                        <small class="text-muted d-block">Total Tagihan</small>
                                        <span class="fw-bold text-primary">Rp 55.000</span>
                                    </div>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></button>
                                        <button class="btn btn-sm btn-outline-primary"><i
                                                class="bi bi-printer"></i></button>
                                        <button class="btn btn-sm btn-success text-white">Proses <i
                                                class="bi bi-arrow-right ms-1"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-lg-3">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="head-order">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="fw-bold mb-0">Order #ORD-20231001-001</h6>
                                        <small class="text-muted"><i class="bi bi-clock me-1"></i>10:30 AM</small>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-primary-subtle text-primary rounded-pill px-3">Baru</span>
                                        <div class="mt-1">
                                            <span class="badge bg-light text-dark border fw-normal"><i
                                                    class="bi bi-grid-fill me-1 text-primary"></i> Meja 5</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="order-items mb-3">
                                    <div class="d-flex justify-content-between small mb-1">
                                        <span>2x Nasi Goreng Spesial</span>
                                        <span class="text-muted">Rp 50.000</span>
                                    </div>
                                    <div class="d-flex justify-content-between small mb-1">
                                        <span>1x Es Teh Manis</span>
                                        <span class="text-muted">Rp 5.000</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center border-top pt-3">
                                    <div>
                                        <small class="text-muted d-block">Total Tagihan</small>
                                        <span class="fw-bold text-primary">Rp 55.000</span>
                                    </div>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></button>
                                        <button class="btn btn-sm btn-outline-primary"><i
                                                class="bi bi-printer"></i></button>
                                        <button class="btn btn-sm btn-success text-white">Proses <i
                                                class="bi bi-arrow-right ms-1"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-lg-3">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="head-order">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="fw-bold mb-0">Order #ORD-20231001-001</h6>
                                        <small class="text-muted"><i class="bi bi-clock me-1"></i>10:30 AM</small>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-primary-subtle text-primary rounded-pill px-3">Baru</span>
                                        <div class="mt-1">
                                            <span class="badge bg-light text-dark border fw-normal"><i
                                                    class="bi bi-grid-fill me-1 text-primary"></i> Meja 5</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="order-items mb-3">
                                    <div class="d-flex justify-content-between small mb-1">
                                        <span>2x Nasi Goreng Spesial</span>
                                        <span class="text-muted">Rp 50.000</span>
                                    </div>
                                    <div class="d-flex justify-content-between small mb-1">
                                        <span>1x Es Teh Manis</span>
                                        <span class="text-muted">Rp 5.000</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center border-top pt-3">
                                    <div>
                                        <small class="text-muted d-block">Total Tagihan</small>
                                        <span class="fw-bold text-primary">Rp 55.000</span>
                                    </div>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-secondary"><i
                                                class="bi bi-eye"></i></button>
                                        <button class="btn btn-sm btn-outline-primary"><i
                                                class="bi bi-printer"></i></button>
                                        <button class="btn btn-sm btn-success text-white">Proses <i
                                                class="bi bi-arrow-right ms-1"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-lg-3">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="head-order">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="fw-bold mb-0">Order #ORD-20231001-001</h6>
                                        <small class="text-muted"><i class="bi bi-clock me-1"></i>10:30 AM</small>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-primary-subtle text-primary rounded-pill px-3">Baru</span>
                                        <div class="mt-1">
                                            <span class="badge bg-light text-dark border fw-normal"><i
                                                    class="bi bi-grid-fill me-1 text-primary"></i> Meja 5</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="order-items mb-3">
                                    <div class="d-flex justify-content-between small mb-1">
                                        <span>2x Nasi Goreng Spesial</span>
                                        <span class="text-muted">Rp 50.000</span>
                                    </div>
                                    <div class="d-flex justify-content-between small mb-1">
                                        <span>1x Es Teh Manis</span>
                                        <span class="text-muted">Rp 5.000</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center border-top pt-3">
                                    <div>
                                        <small class="text-muted d-block">Total Tagihan</small>
                                        <span class="fw-bold text-primary">Rp 55.000</span>
                                    </div>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-secondary"><i
                                                class="bi bi-eye"></i></button>
                                        <button class="btn btn-sm btn-outline-primary"><i
                                                class="bi bi-printer"></i></button>
                                        <button class="btn btn-sm btn-success text-white">Proses <i
                                                class="bi bi-arrow-right ms-1"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-lg-3">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="head-order">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="fw-bold mb-0">Order #ORD-20231001-001</h6>
                                        <small class="text-muted"><i class="bi bi-clock me-1"></i>10:30 AM</small>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-primary-subtle text-primary rounded-pill px-3">Baru</span>
                                        <div class="mt-1">
                                            <span class="badge bg-light text-dark border fw-normal"><i
                                                    class="bi bi-grid-fill me-1 text-primary"></i> Meja 5</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="order-items mb-3">
                                    <div class="d-flex justify-content-between small mb-1">
                                        <span>2x Nasi Goreng Spesial</span>
                                        <span class="text-muted">Rp 50.000</span>
                                    </div>
                                    <div class="d-flex justify-content-between small mb-1">
                                        <span>1x Es Teh Manis</span>
                                        <span class="text-muted">Rp 5.000</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center border-top pt-3">
                                    <div>
                                        <small class="text-muted d-block">Total Tagihan</small>
                                        <span class="fw-bold text-primary">Rp 55.000</span>
                                    </div>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-secondary"><i
                                                class="bi bi-eye"></i></button>
                                        <button class="btn btn-sm btn-outline-primary"><i
                                                class="bi bi-printer"></i></button>
                                        <button class="btn btn-sm btn-success text-white">Proses <i
                                                class="bi bi-arrow-right ms-1"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-lg-3">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="head-order">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="fw-bold mb-0">Order #ORD-20231001-001</h6>
                                        <small class="text-muted"><i class="bi bi-clock me-1"></i>10:30 AM</small>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-primary-subtle text-primary rounded-pill px-3">Baru</span>
                                        <div class="mt-1">
                                            <span class="badge bg-light text-dark border fw-normal"><i
                                                    class="bi bi-grid-fill me-1 text-primary"></i> Meja 5</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="order-items mb-3">
                                    <div class="d-flex justify-content-between small mb-1">
                                        <span>2x Nasi Goreng Spesial</span>
                                        <span class="text-muted">Rp 50.000</span>
                                    </div>
                                    <div class="d-flex justify-content-between small mb-1">
                                        <span>1x Es Teh Manis</span>
                                        <span class="text-muted">Rp 5.000</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center border-top pt-3">
                                    <div>
                                        <small class="text-muted d-block">Total Tagihan</small>
                                        <span class="fw-bold text-primary">Rp 55.000</span>
                                    </div>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-secondary"><i
                                                class="bi bi-eye"></i></button>
                                        <button class="btn btn-sm btn-outline-primary"><i
                                                class="bi bi-printer"></i></button>
                                        <button class="btn btn-sm btn-success text-white">Proses <i
                                                class="bi bi-arrow-right ms-1"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-lg-3">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="head-order">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="fw-bold mb-0">Order #ORD-20231001-001</h6>
                                        <small class="text-muted"><i class="bi bi-clock me-1"></i>10:30 AM</small>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-primary-subtle text-primary rounded-pill px-3">Baru</span>
                                        <div class="mt-1">
                                            <span class="badge bg-light text-dark border fw-normal"><i
                                                    class="bi bi-grid-fill me-1 text-primary"></i> Meja 5</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="order-items mb-3">
                                    <div class="d-flex justify-content-between small mb-1">
                                        <span>2x Nasi Goreng Spesial</span>
                                        <span class="text-muted">Rp 50.000</span>
                                    </div>
                                    <div class="d-flex justify-content-between small mb-1">
                                        <span>1x Es Teh Manis</span>
                                        <span class="text-muted">Rp 5.000</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center border-top pt-3">
                                    <div>
                                        <small class="text-muted d-block">Total Tagihan</small>
                                        <span class="fw-bold text-primary">Rp 55.000</span>
                                    </div>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-secondary"><i
                                                class="bi bi-eye"></i></button>
                                        <button class="btn btn-sm btn-outline-primary"><i
                                                class="bi bi-printer"></i></button>
                                        <button class="btn btn-sm btn-success text-white">Proses <i
                                                class="bi bi-arrow-right ms-1"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-lg-3">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="head-order">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="fw-bold mb-0">Order #ORD-20231001-001</h6>
                                        <small class="text-muted"><i class="bi bi-clock me-1"></i>10:30 AM</small>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-primary-subtle text-primary rounded-pill px-3">Baru</span>
                                        <div class="mt-1">
                                            <span class="badge bg-light text-dark border fw-normal"><i
                                                    class="bi bi-grid-fill me-1 text-primary"></i> Meja 5</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="order-items mb-3">
                                    <div class="d-flex justify-content-between small mb-1">
                                        <span>2x Nasi Goreng Spesial</span>
                                        <span class="text-muted">Rp 50.000</span>
                                    </div>
                                    <div class="d-flex justify-content-between small mb-1">
                                        <span>1x Es Teh Manis</span>
                                        <span class="text-muted">Rp 5.000</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center border-top pt-3">
                                    <div>
                                        <small class="text-muted d-block">Total Tagihan</small>
                                        <span class="fw-bold text-primary">Rp 55.000</span>
                                    </div>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-secondary"><i
                                                class="bi bi-eye"></i></button>
                                        <button class="btn btn-sm btn-outline-primary"><i
                                                class="bi bi-printer"></i></button>
                                        <button class="btn btn-sm btn-success text-white">Proses <i
                                                class="bi bi-arrow-right ms-1"></i></button>
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
