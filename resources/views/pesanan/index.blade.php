@extends('layouts.main')
@section('content')
    <div class="card">
        <div class="card-body p-4">
            <div class="head  align-items-center mb-4 ">
                {{-- tanggal harin ini format hari, tgl bulan tahun --}}
                <form action="{{ route('pesanan') }}" method="GET">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="input-group input-group-sm" style="max-width: 200px;">
                            <span class="input-group-text bg-white border-end-0"><i class="bi bi-calendar3"></i></span>
                            <input type="date" name="date"
                                class="form-control border-start-0 fw-medium text-secondary"
                                value="{{ request('date', date('Y-m-d')) }}" onchange="this.form.submit()">
                        </div>
                        <div class="d-flex gap-2">
                            <div class="input-group input-group-sm" style="width: 250px;">
                                <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                                <input type="text" name="search" class="form-control border-start-0"
                                    placeholder="Cari No. Pesanan atau Meja..." value="{{ request('search') }}">
                            </div>
                            <a href="{{ route('pesanan.create') }}" class="btn btn-primary btn-sm px-3">
                                <i class="bi bi-plus-lg me-1"></i> Buat Pesanan
                            </a>
                        </div>
                    </div>
                </form>
                <hr>
                <h5 class="card-title">Daftar Pesanan</h5>
                <div class="d-flex gap-2 flex-wrap">
                    {{-- tombol all, baru, dimasak, siap, selesai, batal,dll --}}
                    <button class="btn btn-sm btn-dark rounded px-3 filter-btn" data-status="all" data-color="dark">
                        All <span class="badge bg-white text-dark border border-dark ms-1">{{ $penjualanans->count() }}</span>
                    </button>
                    <button class="btn btn-sm btn-outline-primary rounded px-3 filter-btn" data-status="pending" data-color="primary">
                        Baru <span
                            class="badge bg-white text-dark border border-primary ms-1">{{ $penjualanans->where('status', 'pending')->count() }}</span>
                    </button>
                    <button class="btn btn-sm btn-outline-warning rounded px-3 filter-btn" data-status="cooking" data-color="warning">
                        Dimasak <span
                            class="badge bg-white text-dark border border-warning ms-1">{{ $penjualanans->where('status', 'cooking')->count() }}</span>
                    </button>
                    <button class="btn btn-sm btn-outline-success rounded px-3 filter-btn" data-status="served" data-color="success">
                        Siap <span
                            class="badge bg-white text-dark border border-success ms-1">{{ $penjualanans->where('status', 'served')->count() }}</span>
                    </button>
                    <button class="btn btn-sm btn-outline-secondary rounded px-3 filter-btn" data-status="paid" data-color="secondary">
                        Selesai <span
                            class="badge bg-white text-dark border border-secondary ms-1">{{ $penjualanans->where('status', 'paid')->count() }}</span>
                    </button>
                    <button class="btn btn-sm btn-outline-danger rounded px-3 filter-btn" data-status="cancelled" data-color="danger">
                        Batal <span
                            class="badge bg-white text-dark border border-danger ms-1">{{ $penjualanans->where('status', 'cancelled')->count() }}</span>
                    </button>
                </div>
            </div>
            <hr>
            @php
                $statusGroups = [
                    'pending' => ['label' => 'Baru', 'color' => 'primary'],
                    'cooking' => ['label' => 'Dimasak', 'color' => 'warning'],
                    'served' => ['label' => 'Siap', 'color' => 'success'],
                    'paid' => ['label' => 'Selesai', 'color' => 'secondary'],
                    'cancelled' => ['label' => 'Batal', 'color' => 'danger'],
                ];
            @endphp

            @foreach ($statusGroups as $statusKey => $group)
                @php
                    $groupOrders = $penjualanans->where('status', $statusKey);
                @endphp

                @if ($groupOrders->count() > 0)
                    <div class="mb-4 status-section" data-status="{{ $statusKey }}">
                        <h6 class="fw-bold text-{{ $group['color'] }} border-bottom pb-2 mb-3">
                            {{ $group['label'] }}
                            <span
                                class="badge bg-{{ $group['color'] }} text-white ms-1">{{ $groupOrders->count() }}</span>
                        </h6>
                        <div class="row">
                            @foreach ($groupOrders as $penjualan)
                                <div class="col col-lg-3">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="head-order">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <div>
                                                        <h6 class="fw-bold mb-0">Pesanan #{{ $penjualan->no_pesanan }}</h6>
                                                        <small class="text-muted"><i
                                                                class="bi bi-clock me-1"></i>{{ \Carbon\Carbon::parse($penjualan->tanggal_pemesanan)->format('h:i A') }}</small>
                                                    </div>
                                                    <div class="text-end">
                                                        @php
                                                            $statusColor = match ($penjualan->status) {
                                                                'pending' => 'primary',
                                                                'cooking' => 'warning',
                                                                'served' => 'success',
                                                                'paid' => 'secondary',
                                                                'cancelled' => 'danger',
                                                                default => 'secondary',
                                                            };
                                                            $statusLabel = match ($penjualan->status) {
                                                                'pending' => 'Baru',
                                                                'cooking' => 'Dimasak',
                                                                'served' => 'Siap',
                                                                'paid' => 'Selesai',
                                                                'cancelled' => 'Batal',
                                                                default => ucfirst($penjualan->status),
                                                            };
                                                        @endphp
                                                        <span
                                                            class="badge bg-{{ $statusColor }}-subtle text-{{ $statusColor }} rounded-pill px-3">{{ $statusLabel }}</span>
                                                        <div class="mt-1 d-flex flex-wrap gap-1 justify-content-end">
                                                            @forelse ($penjualan->meja_details as $meja)
                                                                <span class="badge bg-light text-dark border fw-normal">
                                                                    <i class="bi bi-geo-alt-fill me-1 text-danger"></i>
                                                                    {{ $meja->area_name }} | <i class="fas fa-chair chair-icon"></i>{{ $meja->table_name }}
                                                                </span>
                                                            @empty
                                                                <span
                                                                    class="badge bg-light text-dark border fw-normal">-</span>
                                                            @endforelse
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- nama pemesan --}}
                                                @if ($penjualan->nama_pemesan)
                                                    <div class="d-flex align-items-center text-muted mb-2">
                                                        <i class="bi bi-person text-secondary me-1"
                                                            style="font-size: 0.8rem;"></i>
                                                        <span class="small"
                                                            style="font-size: 0.75rem;">{{ $penjualan->nama_pemesan }}</span>
                                                    </div>
                                                @endif

                                                <div class="order-items mb-3">
                                                    @foreach ($penjualan->itemPenjualanan as $item)
                                                        <div class="d-flex justify-content-between small mb-1">
                                                            <span>{{ $item->jumlah }}x
                                                                {{ optional($item->produk)->name ?? 'Item' }}</span>
                                                            <span class="text-muted">Rp
                                                                {{ number_format($item->harga * $item->jumlah, 0, ',', '.') }}</span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="border-top pt-2 mt-2">
                                                    @php
                                                        $subtotal = $penjualan->itemPenjualanan->sum(function ($item) {
                                                            return $item->jumlah * $item->harga;
                                                        });
                                                        $tax = $subtotal * 0.1;
                                                        $grandTotal = $subtotal + $tax;
                                                    @endphp
                                                    <div class="d-flex justify-content-between small mb-1">
                                                        <span class="text-muted">Subtotal</span>
                                                        <span class="fw-medium">Rp
                                                            {{ number_format($subtotal, 0, ',', '.') }}</span>
                                                    </div>
                                                    <div class="d-flex justify-content-between small mb-2">
                                                        <span class="text-muted">PPN (10%)</span>
                                                        <span class="text-danger">Rp
                                                            {{ number_format($tax, 0, ',', '.') }}</span>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <small class="text-muted d-block"
                                                                style="font-size: 0.7rem;">Total Bayar</small>
                                                            <span class="fw-bold text-primary fs-6">Rp
                                                                {{ number_format($grandTotal, 0, ',', '.') }}</span>
                                                        </div>
                                                        <div class="btn-group">

                                                            <a href="{{ route('pesanan.struk', $penjualan->id) }}"
                                                                target="_blank" class="btn btn-sm btn-outline-primary"><i
                                                                    class="bi bi-printer"></i></a>
                                                            <button type="button" class="btn btn-sm btn-success text-white"
                                                                data-bs-toggle="modal" data-bs-target="#updateStatusModal"
                                                                data-url="{{ route('pesanan.update.status', $penjualan->id) }}"
                                                                data-status="{{ $penjualan->status }}"
                                                                data-no="{{ $penjualan->no_pesanan }}">Proses <i
                                                                    class="bi bi-arrow-right ms-1"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach



        </div>
    </div>

    {{-- Modal Update Status --}}
    <div class="modal fade" id="updateStatusModal" tabindex="-1" aria-labelledby="updateStatusModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="updateStatusForm" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateStatusModalLabel">Perbarui Status <span id="modalNoPesanan"
                                class="fw-bold"></span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="statusSelect" class="form-label">Pilih Status</label>
                            <select name="status" id="statusSelect" class="form-select">
                                <option value="pending">Baru</option>
                                <option value="cooking">Dimasak</option>
                                <option value="served">Siap</option>
                                <option value="paid">Selesai</option>
                                <option value="cancelled">Batal</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const updateStatusModal = document.getElementById('updateStatusModal');
            if (updateStatusModal) {
                const form = updateStatusModal.querySelector('#updateStatusForm');

                updateStatusModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const url = button.getAttribute('data-url');
                    const status = button.getAttribute('data-status');
                    const no = button.getAttribute('data-no');

                    const select = updateStatusModal.querySelector('#statusSelect');
                    const noSpan = updateStatusModal.querySelector('#modalNoPesanan');

                    form.setAttribute('data-url', url);
                    select.value = status;
                    noSpan.textContent = '#' + no;
                });

                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const url = this.getAttribute('data-url');
                    const formData = new FormData(this);

                    fetch(url, {
                            method: 'POST',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                window.location.reload();
                            } else {
                                alert(data.error || 'Gagal memperbarui status');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan pada server');
                        });
                });
            }

            // Filter Logic
            const filterBtns = document.querySelectorAll('.filter-btn');
            const statusSections = document.querySelectorAll('.status-section');

            filterBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const status = this.getAttribute('data-status');
                    const color = this.getAttribute('data-color');

                    // Reset all buttons
                    filterBtns.forEach(b => {
                        const bColor = b.getAttribute('data-color');
                        b.classList.remove(`btn-${bColor}`);
                        b.classList.add(`btn-outline-${bColor}`);
                    });

                    // Activate clicked button
                    this.classList.remove(`btn-outline-${color}`);
                    this.classList.add(`btn-${color}`);

                    // Filter sections
                    statusSections.forEach(section => {
                        if (status === 'all' || section.getAttribute('data-status') === status) {
                            section.classList.remove('d-none');
                        } else {
                            section.classList.add('d-none');
                        }
                    });
                });
            });
        });
    </script>
@endsection
