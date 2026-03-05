@extends('layouts.main')
@section('style')
    <style>
        .stat-card {
            transition: all 0.3s ease;
            border: none;
            border-radius: 16px;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
        }

        .icon-box {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 1.2rem;
        }

        .table-custom th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.7rem;
            letter-spacing: 0.5px;
            color: #858796;
            background-color: #f8f9fc;
            border-bottom: 1px solid #e3e6f0;
        }

        .table-custom td {
            vertical-align: middle;
            font-size: 0.8rem;
            padding: 0.75rem;
        }

        .progress-thin {
            height: 6px;
            border-radius: 3px;
        }
    </style>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">Dashboard Overview</h4>
            <p class="text-muted small mb-0">Ringkasan statistik restoran hari ini, {{ date('d F Y') }}</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-white bg-white border shadow-sm btn-sm text-secondary">
                <i class="bi bi-download me-1"></i> Export Report
            </button>
            <div class="input-group input-group-sm shadow-sm" style="width: 200px;">
                <span class="input-group-text bg-white border-end-0"><i class="bi bi-calendar3"></i></span>
                <input type="date" class="form-control border-start-0 fw-medium text-secondary"
                    value="{{ date('Y-m-d') }}">
            </div>
        </div>
    </div>

    {{-- Stats Row --}}
    <div class="row g-3 mb-4">
        {{-- Card 1: Omset --}}
        <div class="col-6 col-lg-3">
            <div class="card stat-card shadow-sm h-100">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <p class="text-muted small fw-bold text-uppercase mb-1">Total Omset (Hari Ini)</p>
                            <h5 class="fw-bold text-dark mb-0">Rp {{ number_format($pendapatan, 0, ',', '.') }}</h5>
                        </div>
                        <div class="icon-box bg-success-subtle text-success">
                            <i class="bi bi-currency-dollar"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Card 2: Total Order --}}
        <div class="col-6 col-lg-3">
            <div class="card stat-card shadow-sm h-100">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <p class="text-muted small fw-bold text-uppercase mb-1">Total Pesanan</p>
                            <h5 class="fw-bold text-dark mb-0">{{ $totalPesanan }} Order</h5>
                        </div>
                        <div class="icon-box bg-primary-subtle text-primary">
                            <i class="bi bi-receipt"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Card 3: Rata-rata Transaksi --}}
        <div class="col-6 col-lg-3">
            <div class="card stat-card shadow-sm h-100">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            @php
                                $rataRata = $totalPesanan > 0 ? $pendapatan / $totalPesanan : 0;
                            @endphp
                            <p class="text-muted small fw-bold text-uppercase mb-1">Rata-rata Transaksi</p>
                            <h5 class="fw-bold text-dark mb-0">Rp {{ number_format($rataRata, 0, ',', '.') }}</h5>
                        </div>
                        <div class="icon-box bg-info-subtle text-info">
                            <i class="bi bi-wallet2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Card 4: Meja Terisi --}}
        <div class="col-6 col-lg-3">
            <div class="card stat-card shadow-sm h-100">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <p class="text-muted small fw-bold text-uppercase mb-1">Ketersediaan Meja</p>
                            <h5 class="fw-bold text-dark mb-0">{{ $mejaTerpakai }} / {{ $totalMeja }} <span
                                    class="fw-normal small">Terisi</span></h5>
                        </div>
                        <div class="icon-box bg-warning-subtle text-warning">
                            <i class="bi bi-grid-fill"></i>
                        </div>
                    </div>
                    @php
                        $okupansi = $totalMeja > 0 ? ($mejaTerpakai / $totalMeja) * 100 : 0;
                    @endphp
                    {{-- <div class="progress progress-thin mt-2">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $okupansi }}%"
                            aria-valuenow="{{ $okupansi }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div> --}}
                    {{-- <div class="mt-1 small text-muted">{{ round($okupansi) }}% Okupansi</div> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        {{-- Chart Section --}}
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-4 mb-4">
                <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 fw-bold text-primary">Grafik Pendapatan (Minggu Ini)</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle text-muted" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-three-dots-vertical"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area" style="height: 300px;">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- Recent Orders Table --}}
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 fw-bold text-primary">Pesanan Terbaru</h6>
                    <a href="{{ route('pesanan') }}" class="small text-decoration-none">Lihat Semua &rarr;</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-custom table-hover mb-0 align-middle">
                        <thead>
                            <tr>
                                <th class="ps-4">Order ID</th>
                                <th>Pelanggan</th>
                                <th>Menu</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th class="text-end pe-4">Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentOrders as $order)
                                <tr>
                                    <td class="ps-4 fw-bold text-primary">{{ $order->no_pesanan }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-2 text-secondary"
                                                style="width: 30px; height: 30px;"><i class="bi bi-person-fill"></i>
                                            </div>
                                            <div>
                                                <span class="d-block fw-medium">{{ $order->nama_pemesan }}</span>
                                                <small class="text-muted">Meja
                                                    {{ $order->meja->name ?? 'N/A' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td><small class="text-muted">
                                            @if ($order->penjualans->isNotEmpty())
                                                {{ $order->penjualans->first()->produk->name ?? 'Item' }}{{ $order->penjualans->count() > 1 ? ', ...' : '' }}
                                            @else
                                                -
                                            @endif
                                        </small></td>
                                    <td class="fw-bold">Rp
                                        {{ number_format($order->payment->jumlah ?? 0, 0, ',', '.') }}</td>
                                    <td>
                                        @php
                                            $statusLabel = match ($order->status) {
                                                'pending' => 'Baru',
                                                'cooking' => 'Dimasak',
                                                'served' => 'Siap',
                                                'paid' => 'Selesai',
                                                'cancelled' => 'Batal',
                                                default => ucfirst($order->status),
                                            };
                                            $badgeClass = match ($order->status) {
                                                'pending' => 'bg-primary-subtle text-primary',
                                                'cooking' => 'bg-warning-subtle text-warning',
                                                'served' => 'bg-info-subtle text-info',
                                                'paid' => 'bg-success-subtle text-success',
                                                'cancelled' => 'bg-danger-subtle text-danger',
                                                default => 'bg-secondary-subtle text-secondary',
                                            };
                                        @endphp
                                        <span
                                            class="badge {{ $badgeClass }} rounded-pill px-3">{{ $statusLabel }}</span>
                                    </td>
                                    <td class="text-end pe-4 text-muted small">
                                        {{ $order->created_at->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        Belum ada pesanan hari ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Right Column --}}
        <div class="col-lg-4">
            {{-- Top Products --}}
            <div class="card shadow-sm border-0 rounded-4 mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h6 class="m-0 fw-bold text-primary">Menu Terlaris</h6>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse ($topMenus as $item)
                            <div class="list-group-item border-0 px-4 py-3">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="fw-medium small">{{ $item->produk->name ?? 'Produk Dihapus' }}</span>
                                    <span class="small fw-bold text-secondary">{{ $item->total_sold }} Terjual</span>
                                </div>
                                @php
                                    $maxSold = $topMenus->first()->total_sold ?? 0;
                                    $percentage = $maxSold > 0 ? ($item->total_sold / $maxSold) * 100 : 0;
                                @endphp
                                <div class="progress progress-thin bg-light">
                                    <div class="progress-bar bg-primary" role="progressbar"
                                        style="width: {{ $percentage }}%"></div>
                                </div>
                            </div>
                        @empty
                            <div class="list-group-item border-0 px-4 py-5 text-center">
                                <span class="text-muted small">
                                    Belum ada data menu terlaris hari ini.
                                </span>
                            </div>
                        @endforelse
                    </div>
                </div>
                <div class="card-footer bg-white border-0 text-center py-3">
                    <a href="#" class="small text-decoration-none">Lihat Laporan Menu &rarr;</a>
                </div>
            </div>

            {{-- Order Type Stats --}}
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-white border-0 py-3">
                    <h6 class="m-0 fw-bold text-primary">Tipe Pesanan</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-center mb-4" style="height: 200px;">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="d-flex justify-content-center gap-3 text-center small">
                        <div>
                            <span class="d-block text-muted">Dine In</span>
                            <span class="fw-bold text-primary"><i class="bi bi-circle-fill small me-1"></i> 65%</span>
                        </div>
                        <div>
                            <span class="d-block text-muted">Take Away</span>
                            <span class="fw-bold text-success"><i class="bi bi-circle-fill small me-1"></i> 25%</span>
                        </div>
                        <div>
                            <span class="d-block text-muted">Delivery</span>
                            <span class="fw-bold text-info"><i class="bi bi-circle-fill small me-1"></i> 10%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{-- Chart.js CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data from controller
        const orderTypesData = @json($orderTypes->values());
        const orderTypesLabels = @json($orderTypes->keys());
        const pieChartColors = ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b'];

        // Area Chart (Pendapatan)
        const ctx = document.getElementById('myAreaChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: [2500000, 3200000, 2800000, 4100000, 3900000, 5500000, 4500000],
                    backgroundColor: 'rgba(78, 115, 223, 0.05)',
                    borderColor: 'rgba(78, 115, 223, 1)',
                    pointRadius: 3,
                    pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                    pointBorderColor: 'rgba(78, 115, 223, 1)',
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: 'rgba(78, 115, 223, 1)',
                    pointHoverBorderColor: 'rgba(78, 115, 223, 1)',
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        }
                    },
                    y: {
                        grid: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        },
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });

        // Pie Chart (Tipe Pesanan)
        const ctxPie = document.getElementById('myPieChart').getContext('2d');
        new Chart(ctxPie, {
            type: 'doughnut',
            data: {
                labels: orderTypesLabels,
                datasets: [{
                    data: orderTypesData,
                    backgroundColor: pieChartColors,
                    hoverBackgroundColor: pieChartColors.map(color => Chart.helpers.color(color).saturate(
                        0.5).darken(0.1).rgbString()),
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                plugins: {
                    legend: {
                        display: false
                    }
                },
                cutout: '75%',
            },
        });
    </script>
@endsection
