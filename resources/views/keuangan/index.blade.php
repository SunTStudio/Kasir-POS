@extends('layouts.main')

@section('content')
    <div class="container-fluid px-0">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold text-dark mb-1">Laporan Keuangan</h4>
                <p class="text-muted small mb-0">Ringkasan pendapatan harian, bulanan, dan tahunan.</p>
            </div>
            <button class="btn btn-outline-primary btn-sm rounded-3">
                <i class="bi bi-download me-1"></i> Export Laporan
            </button>
        </div>

        {{-- Filter Tanggal --}}
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-3">
                <form action="{{ route('keuangan') }}" method="GET" class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label for="start_date" class="form-label fw-bold small text-muted">Dari Tanggal</label>
                        <input type="date" class="form-control" id="start_date" name="start_date"
                            value="{{ request('start_date') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="end_date" class="form-label fw-bold small text-muted">Sampai Tanggal</label>
                        <input type="date" class="form-control" id="end_date" name="end_date"
                            value="{{ request('end_date') }}">
                    </div>
                    <div class="col-md-auto">
                        <button type="submit" class="btn btn-primary fw-bold px-4 rounded-3">
                            <i class="bi bi-filter me-1"></i> Tampilkan
                        </button>
                        <a href="{{ route('keuangan') }}" class="btn btn-outline-secondary rounded-3 ms-1">Reset</a>
                    </div>
                </form>
            </div>
        </div>

        {{-- Kartu Ringkasan --}}
        <div class="row g-4 mb-4">
            {{-- Harian --}}
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 bg-primary text-white h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="mb-1 opacity-75">Pendapatan Hari Ini</p>
                                <h3 class="fw-bold mb-0">Rp {{ number_format($dailyRevenue, 0, ',', '.') }}</h3>
                            </div>
                            <div class="bg-white bg-opacity-25 rounded-3 p-2">
                                <i class="bi bi-calendar-day fs-4"></i>
                            </div>
                        </div>
                        <div class="mt-3 small opacity-75">
                            <i class="bi bi-clock me-1"></i> Update terakhir: {{ now()->format('H:i') }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bulanan --}}
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 bg-success text-white h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="mb-1 opacity-75">Pendapatan Bulan Ini</p>
                                <h3 class="fw-bold mb-0">Rp {{ number_format($monthlyRevenue, 0, ',', '.') }}</h3>
                            </div>
                            <div class="bg-white bg-opacity-25 rounded-3 p-2">
                                <i class="bi bi-calendar-month fs-4"></i>
                            </div>
                        </div>
                        <div class="mt-3 small opacity-75">
                            <i class="bi bi-graph-up-arrow me-1"></i> {{ now()->format('F Y') }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tahunan --}}
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 bg-info text-white h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="mb-1 opacity-75">Total Tahun Ini</p>
                                <h3 class="fw-bold mb-0">Rp {{ number_format($yearlyRevenue, 0, ',', '.') }}</h3>
                            </div>
                            <div class="bg-white bg-opacity-25 rounded-3 p-2">
                                <i class="bi bi-wallet2 fs-4"></i>
                            </div>
                        </div>
                        <div class="mt-3 small opacity-75">
                            <i class="bi bi-calendar3 me-1"></i> Tahun {{ now()->format('Y') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabel Transaksi Terbaru --}}
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="fw-bold mb-0 text-dark">Transaksi Terakhir</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4 py-3">ID Pesanan</th>
                                <th class="py-3">Tanggal</th>
                                <th class="py-3">Total</th>
                                <th class="py-3">Status</th>
                                <th class="pe-4 py-3 text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentTransactions as $transaksi)
                                <tr>
                                    <td class="ps-4 fw-bold">#{{ $transaksi->id }}</td>
                                    <td>{{ $transaksi->created_at->format('d M Y, H:i') }}</td>
                                    <td class="fw-bold text-success">Rp
                                        {{ number_format($transaksi->total_amount, 0, ',', '.') }}</td>
                                    <td>
                                        @if ($transaksi->status == 'paid')
                                            <span
                                                class="badge bg-success-subtle text-success rounded-pill px-3">Selesai</span>
                                        @elseif($transaksi->status == 'pending')
                                            <span
                                                class="badge bg-warning-subtle text-warning rounded-pill px-3">Pending</span>
                                        @elseif($transaksi->status == 'cancelled')
                                            <span class="badge bg-danger-subtle text-danger rounded-pill px-3">Batal</span>
                                        @else
                                            <span
                                                class="badge bg-secondary-subtle text-secondary rounded-pill px-3">{{ ucfirst($transaksi->status) }}</span>
                                        @endif
                                    </td>
                                    <td class="pe-4 text-end">
                                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-3"
                                            data-bs-toggle="modal" data-bs-target="#detailModal-{{ $transaksi->id }}">
                                            Detail
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">Belum ada transaksi data.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Detail Transaksi --}}
    @foreach ($recentTransactions as $transaksi)
        <div class="modal fade" id="detailModal-{{ $transaksi->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm"> {{-- Tambah modal-sm agar ramping seperti struk --}}
                <div class="modal-content rounded-4 border-0 shadow">
                    <div class="modal-body p-0">
                        {{-- Tampilan Struk --}}
                        <div class="p-4"
                            style="font-family: 'Courier New', Courier, monospace; background-color: #fff; color: #000;">

                            {{-- Header Struk --}}
                            <div class="text-center mb-3">
                                <h5 class="fw-bold mb-1">RESTO POS</h5>
                                <p class="mb-0 small">Jl. Rasa Nusantara No. 88</p>
                                <p class="mb-0 small">Telp: 0812-3456-7890</p>
                            </div>

                            {{-- Garis Putus-putus --}}
                            <div class="border-bottom border-dark border-1 mb-2" style="border-style: dashed !important;">
                            </div>

                            {{-- Info Transaksi --}}
                            <div class="small mb-2">
                                <div class="d-flex justify-content-between">
                                    <span>No: {{ $transaksi->no_pesanan ?? $transaksi->id }}</span>
                                    <span>{{ $transaksi->created_at->format('d/m/y H:i') }}</span>
                                </div>
                                <div>Pemesan: {{ $transaksi->nama_pemesan ?? 'Umum' }}</div>
                            </div>

                            <div class="border-bottom border-dark border-1 mb-2" style="border-style: dashed !important;">
                            </div>

                            {{-- Item Pesanan --}}
                            <div class="small mb-3">
                                @foreach ($transaksi->penjualans as $item)
                                    <div class="d-flex justify-content-between mb-1">
                                        <span>{{ $item->jumlah }}x
                                            {{ $item->produk->nama_produk ?? 'Produk' }}</span>
                                        <span>{{ number_format($item->harga * $item->jumlah, 0, ',', '.') }}</span>
                                    </div>
                                @endforeach
                            </div>

                            <div class="border-bottom border-dark border-1 mb-2" style="border-style: dashed !important;">
                            </div>

                            {{-- Total --}}
                            <div class="d-flex justify-content-between fw-bold mb-1">
                                <span>TOTAL</span>
                                <span>Rp {{ number_format($transaksi->total_amount, 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between small mb-1">
                                <span>Tunai</span>
                                <span>Rp {{ number_format($transaksi->total_amount, 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between small mb-3">
                                <span>Kembali</span>
                                <span>Rp 0</span>
                            </div>

                            <div class="border-bottom border-dark border-1 mb-3" style="border-style: dashed !important;">
                            </div>

                            {{-- Footer Struk --}}
                            <div class="text-center small">
                                <p class="mb-0">Terima Kasih</p>
                                <p class="mb-0">Silahkan Datang Kembali</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 justify-content-center bg-light rounded-bottom-4">
                        <button type="button" class="btn btn-sm btn-secondary rounded-3 px-3"
                            data-bs-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-sm btn-primary rounded-3 px-3" onclick="window.print()"><i
                                class="bi bi-printer me-1"></i> Cetak</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
