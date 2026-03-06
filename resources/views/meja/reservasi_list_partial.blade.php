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
