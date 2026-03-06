@foreach ($managementMejas as $meja)
    @php
        $kursi = $meja->jumlah_kursi;
        $terpakai = $meja->terpakai;
        $atas = ceil($kursi / 2);
        $bawah = floor($kursi / 2);
        $statusClass = $terpakai >= $kursi ? 'status-occupied' : 'status-available';
        // Jika ada reservasi tapi belum penuh/dipakai, bisa ditambahkan logika status-reserved disini
        $seatCounter = 0;
    @endphp
    <div class="col-6 col-lg-3">
        <div class="meja-wrapper {{ $statusClass }} d-flex flex-column align-items-center">
            <div class="d-flex gap-2 mb-1">
                @for ($i = 0; $i < $atas; $i++)
                    @php
                        $isOccupied = $seatCounter < $terpakai;
                        $seatCounter++;
                    @endphp
                    <i class="fas fa-chair chair-icon rotate-180 {{ $isOccupied ? 'text-dark' : '' }}"></i>
                @endfor
            </div>
            <div class="meja-content w-100 py-3">
                <h5 class="fw-bold mb-0">{{ $meja->name }}</h5>
                <span class="meja-info">{{ $meja->jumlah_kursi }}/{{ $meja->terpakai }}
                    <i class="bi bi-people-fill"></i></span>
                @if ($meja->area)
                    <span class="meja-info small  d-block"><i class="bi bi-building"></i>{{ $meja->area->name }}</span>
                @endif
            </div>
            <div class="d-flex gap-2 mt-1">
                @for ($i = 0; $i < $bawah; $i++)
                    @php
                        $isOccupied = $seatCounter < $terpakai;
                        $seatCounter++;
                    @endphp
                    <i class="fas fa-chair chair-icon {{ $isOccupied ? 'text-dark' : '' }}"></i>
                @endfor
            </div>
        </div>
    </div>
@endforeach
