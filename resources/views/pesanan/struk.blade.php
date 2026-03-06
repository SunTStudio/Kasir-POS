<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk #{{ $penjualan->no_pesanan }}</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
            color: #000;
            margin: 0;
            padding: 10px;
            max-width: 300px;
            /* Lebar standar kertas thermal 80mm */
            margin: 0 auto;
        }

        .text-center {
            text-align: center;
        }

        .text-end {
            text-align: right;
        }

        .d-flex {
            display: flex;
            justify-content: space-between;
        }

        .fw-bold {
            font-weight: bold;
        }

        .mb-1 {
            margin-bottom: 5px;
        }

        .border-bottom {
            border-bottom: 1px dashed #000;
            margin: 10px 0;
        }

        .no-print {
            margin-top: 20px;
            text-align: center;
        }

        .btn-print {
            padding: 5px 10px;
            cursor: pointer;
            background: #eee;
            border: 1px solid #ccc;
        }

        @media print {
            .no-print {
                display: none;
            }

            body {
                padding: 0;
                margin: 0;
            }
        }
    </style>
</head>

<body onload="window.print()">

    <div class="text-center">
        <h3 class="fw-bold mb-1" style="margin-top: 0;">RESTO POS</h3>
        <p style="margin: 0;">Jl. Rasa Nusantara No. 88</p>
        <p style="margin: 0;">Telp: 0812-3456-7890</p>
    </div>

    <div class="border-bottom"></div>

    <div>
        <div class="d-flex">
            <span>No: {{ $penjualan->no_pesanan }}</span>
            <span>{{ date('d/m/y H:i', strtotime($penjualan->created_at)) }}</span>
        </div>
        <div>Pemesan: {{ $penjualan->nama_pemesan }}</div>
        <div>Meja: {{ $penjualan->meja->name ?? 'Take Away' }}</div>
    </div>

    <div class="border-bottom"></div>

    @foreach ($penjualan->penjualans as $item)
        <div class="d-flex" style="margin-bottom: 2px;">
            <span>{{ $item->jumlah }}x {{ $item->produk->name ?? 'Item' }}</span>
            <span>{{ number_format($item->harga * $item->jumlah, 0, ',', '.') }}</span>
        </div>
    @endforeach

    <div class="border-bottom"></div>

    @php
        $subtotal = $penjualan->penjualans->sum(fn($i) => $i->harga * $i->jumlah);
        $tax = $subtotal * 0.1;
        $grandTotal = $subtotal + $tax;
    @endphp

    <div class="d-flex">
        <span>Subtotal</span>
        <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
    </div>
    <div class="d-flex">
        <span>PPN (10%)</span>
        <span>Rp {{ number_format($tax, 0, ',', '.') }}</span>
    </div>
    <div class="d-flex fw-bold" style="font-size: 14px;">
        <span>TOTAL</span>
        <span>Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
    </div>

    <div class="border-bottom"></div>

    <div class="text-center">
        <p>Terima Kasih<br>Silahkan Datang Kembali</p>
    </div>

    <div class="no-print">
        <button class="btn-print" onclick="window.print()">Cetak / Simpan PDF</button>
    </div>

</body>

</html>
