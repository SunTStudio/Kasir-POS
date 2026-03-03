@extends('layouts.main')
@section('content')
    <div class="card">
        <div class="card-body p-4">
            <div class="head d-flex justify-content-between align-items-center mb-4 ">
                <h5 class="card-title">Point Of Sales (POS)</h5>
                <a href="" class="btn-sm btn btn-warning">+ New Order</a>
            </div>
            <div class="row justify-content-between">
                <div class="col-md-8 p-1">
                    <div class="bg-body-tertiary rounded p-3">
                        <div class="search">
                            {{-- buat input search, dan filter kategori dan terbaru dan telama --}}
                            <form action="#" method="GET" class="row g-2">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0" style="font-size: 0.8rem;">
                                            <i class="bi bi-search text-muted"></i>
                                        </span>
                                        <input type="text" name="search" class="form-control border-start-0"
                                            style="font-size: 0.8rem;" placeholder="Cari menu..."
                                            value="{{ request('search') }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <select name="category" class="form-select" style="font-size: 0.8rem;">
                                        <option value="">Semua Kategori</option>
                                        <option value="makanan" {{ request('category') == 'makanan' ? 'selected' : '' }}>
                                            Makanan</option>
                                        <option value="minuman" {{ request('category') == 'minuman' ? 'selected' : '' }}>
                                            Minuman</option>
                                        <option value="snack" {{ request('category') == 'snack' ? 'selected' : '' }}>
                                            Cemilan</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="sort" class="form-select" style="font-size: 0.8rem;">
                                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru
                                        </option>
                                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama
                                        </option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <hr>
                        {{-- ===================================================================================================== --}}
                        <div class="kategori d-flex align-items-center mb-3">
                            <div class="d-flex gap-2">
                                <a href="#" class="btn btn-success btn-sm rounded-pill px-3">Show All</a>
                                <a href="#" class="btn btn-outline-secondary btn-sm rounded-pill px-3">Makanan</a>
                                <a href="#" class="btn btn-outline-secondary btn-sm rounded-pill px-3">Minuman</a>
                                <a href="#" class="btn btn-outline-secondary btn-sm rounded-pill px-3">Cemilan</a>
                            </div>
                        </div>
                        <div class="produk">
                            <div class="row g-3">
                                @php
                                    $products = [
                                        [
                                            'id' => 1,
                                            'name' => 'Nasi Goreng Spesial',
                                            'category' => 'Makanan',
                                            'price' => 25000,
                                        ],
                                        [
                                            'id' => 2,
                                            'name' => 'Ayam Bakar Madu',
                                            'category' => 'Makanan',
                                            'price' => 30000,
                                        ],
                                        [
                                            'id' => 3,
                                            'name' => 'Mie Goreng Jawa',
                                            'category' => 'Makanan',
                                            'price' => 22000,
                                        ],
                                        [
                                            'id' => 4,
                                            'name' => 'Sate Ayam Madura',
                                            'category' => 'Makanan',
                                            'price' => 28000,
                                        ],
                                        [
                                            'id' => 5,
                                            'name' => 'Rendang Daging',
                                            'category' => 'Makanan',
                                            'price' => 35000,
                                        ],
                                        ['id' => 6, 'name' => 'Es Teh Manis', 'category' => 'Minuman', 'price' => 5000],
                                        [
                                            'id' => 7,
                                            'name' => 'Jus Jeruk Segar',
                                            'category' => 'Minuman',
                                            'price' => 12000,
                                        ],
                                        [
                                            'id' => 8,
                                            'name' => 'Kopi Susu Gula Aren',
                                            'category' => 'Minuman',
                                            'price' => 18000,
                                        ],
                                        ['id' => 9, 'name' => 'Es Campur', 'category' => 'Minuman', 'price' => 15000],
                                        [
                                            'id' => 10,
                                            'name' => 'Matcha Latte',
                                            'category' => 'Minuman',
                                            'price' => 20000,
                                        ],
                                        [
                                            'id' => 11,
                                            'name' => 'Pisang Goreng Keju',
                                            'category' => 'Cemilan',
                                            'price' => 15000,
                                        ],
                                        [
                                            'id' => 12,
                                            'name' => 'Roti Bakar Coklat',
                                            'category' => 'Cemilan',
                                            'price' => 12000,
                                        ],
                                        [
                                            'id' => 13,
                                            'name' => 'Kentang Goreng',
                                            'category' => 'Cemilan',
                                            'price' => 10000,
                                        ],
                                        [
                                            'id' => 14,
                                            'name' => 'Dimsum Ayam',
                                            'category' => 'Cemilan',
                                            'price' => 18000,
                                        ],
                                        ['id' => 15, 'name' => 'Churros', 'category' => 'Cemilan', 'price' => 16000],
                                    ];
                                @endphp
                                @foreach ($products as $product)
                                    <div class="col-6 col-md-3">
                                        <div class="card h-100 border-0 shadow-sm"
                                            style="border-radius: 12px; overflow: hidden;">
                                            <div class="position-relative">
                                                <img src="{{ asset('produk/sample.png') }}" class="card-img-top"
                                                    alt="..." style="height: 140px; object-fit: cover;">
                                                <span
                                                    class="badge bg-white text-dark position-absolute top-0 start-0 m-2 shadow-sm"
                                                    style="font-size: 0.75rem;">{{ $product['category'] }}</span>
                                            </div>
                                            <div class="card-body p-3 d-flex flex-column">
                                                <h6 class="card-title fw-bold mb-2 text-truncate">{{ $product['name'] }}
                                                </h6>
                                                <div class="mt-auto d-flex justify-content-between align-items-center">
                                                    <span class="fw-bold text-primary">Rp
                                                        {{ number_format($product['price'], 0, ',', '.') }}</span>
                                                    <button
                                                        class="btn btn-primary btn-sm rounded-circle d-flex align-items-center justify-content-center shadow-sm add-to-cart"
                                                        data-id="{{ $product['id'] }}" data-name="{{ $product['name'] }}"
                                                        data-price="{{ $product['price'] }}"
                                                        style="width: 32px; height: 32px; border: none;">
                                                        <i class="bi bi-plus-lg"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 p-1">
                    <div class="bg-body-tertiary rounded p-3">
                        <div class="search">
                            {{-- buat input search, dan filter kategori dan terbaru dan telama --}}
                            <form action="#" method="GET" class="row g-2">
                                <div class="col">
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0" style="font-size: 0.8rem;">
                                            <i class="bi bi-search text-muted"></i>
                                        </span>
                                        <input type="text" name="search" class="form-control border-start-0"
                                            style="font-size: 0.8rem;" placeholder="Cari menu..."
                                            value="{{ request('search') }}">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <hr>
                        <div class="checkout">
                            {{-- buatkan select untuk pilih meja --}}
                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <label class="small text-muted fw-bold mb-1">Dining Area</label>
                                    <div class="input-group shadow-sm">
                                        <span class="input-group-text bg-white border-end-0"><i
                                                class="bi bi-shop-window text-primary"></i></span>
                                        <select name="dining_area" id="dining_area" class="form-select border-start-0 ps-2"
                                            style="font-size: 0.85rem; cursor: pointer;">
                                            <option value="">Pilih Area</option>
                                            @for ($i = 1; $i <= 5; $i++)
                                                <option value="{{ $i }}">Area {{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="small text-muted fw-bold mb-1">No. Meja</label>
                                    <div class="input-group shadow-sm">
                                        <span class="input-group-text bg-white border-end-0"><i
                                                class="bi bi-hash text-primary"></i></span>
                                        <select name="table_number" id="table_number"
                                            class="form-select border-start-0 ps-2"
                                            style="font-size: 0.85rem; cursor: pointer;">
                                            <option value="">Pilih Meja</option>
                                            @for ($i = 1; $i <= 10; $i++)
                                                <option value="{{ $i }}">Meja {{ $i }}</option>
                                            @endfor
                                            <option value="takeaway" class="fw-bold text-success">Take Away</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <p class="fw-bold mb-3"><i class="bi bi-cart4 me-2"></i>Order #21</p>
                            <div id="cart-items" class="overflow-auto" style="max-height: 400px;">
                                <div class="text-center text-muted py-5">
                                    <i class="bi bi-cart-x display-1"></i>
                                    <p class="mt-2">Belum ada pesanan</p>
                                </div>
                            </div>
                            <div class="border-top pt-3 mt-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Subtotal</span>
                                    <span class="fw-bold" id="cart-subtotal">Rp 0</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Pajak (10%)</span>
                                    <span class="text-danger" id="cart-tax">Rp 0</span>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <span class="h5 fw-bold">Total</span>
                                    <span class="h5 fw-bold text-primary" id="cart-total">Rp 0</span>
                                </div>
                                <button class="btn btn-primary w-100 py-2 fw-bold" disabled id="btn-checkout"
                                    data-bs-toggle="modal" data-bs-target="#checkoutModal">
                                    <i class="bi bi-cash-coin me-2"></i> Proses Pembayaran
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal ===================================================================================================== --}}
    {{-- modal checkoutModal --}}
    <div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold" id="checkoutModalLabel">
                        <i class="bi bi-wallet2 me-2"></i>Pembayaran
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="text-center mb-4">
                        <p class="text-muted mb-1 small text-uppercase fw-bold">Total Tagihan</p>
                        <h2 class="fw-bold text-primary display-6" id="checkout-total">Rp 0</h2>
                    </div>

                    <div class="mb-3">
                        <label for="payment_amount" class="form-label fw-bold small text-muted">Uang Tunai</label>
                        <div class="input-group input-group-lg shadow-sm">
                            <span class="input-group-text bg-white text-muted border-end-0"><i
                                    class="bi bi-cash-stack"></i></span>
                            <input type="text" inputmode="numeric" class="form-control border-start-0 ps-2"
                                id="payment_amount" placeholder="0">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="change_amount" class="form-label fw-bold small text-muted">Kembalian</label>
                        <div class="input-group input-group-lg shadow-sm">
                            <span class="input-group-text bg-light text-muted border-end-0"><i
                                    class="bi bi-arrow-return-left"></i></span>
                            <input type="text" class="form-control bg-light border-start-0 ps-2 fw-bold text-success"
                                id="change_amount" placeholder="Rp 0" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0 px-4 pb-4">
                    <button type="button" class="btn btn-light text-muted fw-bold px-4" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg me-1"></i> Batal
                    </button>
                    <button type="button" class="btn btn-primary fw-bold px-4 flex-grow-1 shadow-sm"
                        data-bs-dismiss="modal">
                        <i class="bi bi-check-circle-fill me-2"></i> Bayar & Print Struk
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let cart = [];

        document.addEventListener('DOMContentLoaded', () => {
            const buttons = document.querySelectorAll('.add-to-cart');
            buttons.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const id = this.dataset.id;
                    const name = this.dataset.name;
                    const price = parseInt(this.dataset.price);
                    addToCart(id, name, price);
                });
            });

            // Logic Hitung Kembalian di Modal Checkout
            const checkoutBtn = document.getElementById('btn-checkout');
            const paymentInput = document.getElementById('payment_amount');
            const changeInput = document.getElementById('change_amount');
            const checkoutTotalEl = document.getElementById('checkout-total');

            checkoutBtn.addEventListener('click', function() {
                const total = this.dataset.total;
                checkoutTotalEl.innerText = formatRupiah(total);
                checkoutTotalEl.dataset.val = total;
                paymentInput.value = ''; // Reset input pembayaran
                changeInput.value = ''; // Reset input kembalian
            });

            paymentInput.addEventListener('input', function() {
                // Dapatkan nilai mentah dengan menghapus karakter non-digit (selain angka)
                let rawValue = this.value.replace(/\D/g, '');

                // Jika input kosong, reset kembalian dan nilai input
                if (rawValue === '') {
                    this.value = '';
                    changeInput.value = '';
                    return;
                }

                // Konversi nilai mentah ke integer untuk perhitungan
                const pay = parseInt(rawValue, 10);
                const total = parseInt(checkoutTotalEl.dataset.val || 0);

                // Hitung dan tampilkan kembalian
                const change = pay - total;
                changeInput.value = (change >= 0) ? formatRupiah(change) : 'Kurang ' + formatRupiah(
                    Math.abs(change));

                // Format ulang nilai input dengan pemisah ribuan (titik)
                this.value = pay.toLocaleString('id-ID');
            });
        });

        function addToCart(id, name, price) {
            const existingItem = cart.find(item => item.id === id);
            if (existingItem) {
                existingItem.qty++;
            } else {
                cart.push({
                    id,
                    name,
                    price,
                    qty: 1
                });
            }
            renderCart();
        }

        function renderCart() {
            const cartContainer = document.getElementById('cart-items');
            const subtotalEl = document.getElementById('cart-subtotal');
            const taxEl = document.getElementById('cart-tax');
            const totalEl = document.getElementById('cart-total');
            const checkoutBtn = document.getElementById('btn-checkout');

            cartContainer.innerHTML = '';
            let subtotal = 0;

            if (cart.length === 0) {
                cartContainer.innerHTML = `
                <div class="text-center text-muted py-5">
                    <i class="bi bi-cart-x display-1"></i>
                    <p class="mt-2">Belum ada pesanan</p>
                </div>`;
                checkoutBtn.disabled = true;
            } else {
                cart.forEach(item => {
                    subtotal += item.price * item.qty;
                    cartContainer.innerHTML += `
                    <div class="card mb-2 border-0 shadow-sm bg-white">
                        <div class="card-body p-2">
                            <div class="d-flex justify-content-between align-items-start mb-1">
                                <h6 class="mb-0 text-truncate" style="max-width: 160px;">${item.name}</h6>
                                <span class="fw-bold text-primary" style="font-size: 0.9rem;">${formatRupiah(item.price * item.qty)}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    ${formatRupiah(item.price)} ${item.qty > 1 ? '<span class="fw-bold text-dark ms-1">x ' + item.qty + '</span>' : ''}
                                </small>
                                <div class="d-flex align-items-center bg-light rounded shadow-sm px-1">
                                    <button class="btn btn-sm text-danger p-0 px-1" onclick="updateQty('${item.id}', -1)"><i class="bi bi-dash"></i></button>
                                    <span class="mx-2 fw-bold" style="font-size: 0.85rem; min-width: 20px; text-align: center;">${item.qty}</span>
                                    <button class="btn btn-sm text-success p-0 px-1" onclick="updateQty('${item.id}', 1)"><i class="bi bi-plus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                });
                checkoutBtn.disabled = false;
            }

            const tax = subtotal * 0.1;
            const total = subtotal + tax;

            subtotalEl.innerText = formatRupiah(subtotal);
            taxEl.innerText = formatRupiah(tax);
            totalEl.innerText = formatRupiah(total);
            checkoutBtn.dataset.total = total; // Simpan total ke tombol untuk diambil modal
        }

        window.updateQty = function(id, change) {
            const item = cart.find(i => i.id === id);
            if (item) {
                item.qty += change;
                if (item.qty <= 0) {
                    cart = cart.filter(i => i.id !== id);
                }
                renderCart();
            }
        }

        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(number);
        }
    </script>
@endsection
