@extends('layouts.main')

@push('styles')
    {{-- DataTables CSS sudah ada di main layout --}}
@endpush

@section('content')
    <div class="card">
        <div class="card-body p-2 p-md-4">
            <div class="head d-flex justify-content-between align-items-center mb-3 mb-md-4 ">
                <h5 class="card-title">Point Of Sales (POS)</h5>
                <a href="" class="btn-sm btn btn-warning">+ New Order</a>
            </div>
            <div class="row justify-content-between">
                <div class="col-md-8 p-1">
                    <div class="bg-body-tertiary rounded p-3">
                        <div class="search">
                            {{-- buat input search, dan filter kategori dan terbaru dan telama --}}
                            <form action="{{ route('pesanan.create') }}" method="GET" class="row g-2">
                                <div class="col-12">
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
                            <div class="kategori d-flex align-items-center mb-3 mt-2">
                                <div class="d-flex gap-2 overflow-auto flex-nowrap w-100 pb-2">
                                    <button type="button"
                                        class="btn btn-success btn-sm rounded-pill px-3 category-filter text-nowrap flex-shrink-0"
                                        data-category="all">Show All</button>
                                    @foreach ($kategoris as $kat)
                                        <button type="button"
                                            class="btn btn-outline-secondary btn-sm rounded-pill px-3 category-filter text-nowrap flex-shrink-0"
                                            data-category="{{ $kat->id }}">{{ $kat->name }}</button>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <hr>
                        {{-- ===================================================================================================== --}}

                        <div class="produk">
                            <div class="row g-3">
                                @foreach ($produks as $product)
                                    <div class="col-6 col-md-3 product-item" data-category="{{ $product->kategori_id }}">
                                        <div class="card h-100 border-0 shadow-sm"
                                            style="border-radius: 12px; overflow: hidden;">
                                            <div class="position-relative">
                                                @if ($product->gambar)
                                                    <img src="{{ asset('img/produk/' . $product->gambar) }}"
                                                        class="card-img-top" alt="{{ $product->name }}"
                                                        style="height: 120px; object-fit: cover;">
                                                @else
                                                    <div class="bg-light d-flex align-items-center justify-content-center"
                                                        style="height: 120px;">
                                                        <i class="bi bi-image text-muted display-6"></i>
                                                    </div>
                                                @endif
                                                <span
                                                    class="badge bg-white text-dark position-absolute top-0 start-0 m-2 shadow-sm"
                                                    style="font-size: 0.75rem;">{{ $product->kategori->name ?? 'Umum' }}</span>
                                            </div>
                                            <div class="card-body p-3 d-flex flex-column">
                                                <h6 class="card-title fw-bold mb-2 text-truncate"
                                                    style="font-size: 0.9rem;">{{ $product->name }}
                                                </h6>
                                                <div class="mt-auto d-flex justify-content-between align-items-center">
                                                    <span class="fw-bold text-primary" style="font-size: 0.85rem;">Rp
                                                        {{ number_format($product->harga, 0, ',', '.') }}</span>
                                                    <button
                                                        class="btn btn-primary btn-sm rounded-circle d-flex align-items-center justify-content-center shadow-sm add-to-cart"
                                                        data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                                                        data-price="{{ $product->harga }}"
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
                                <div class="col col-lg-6" id="meja-container">

                                    <label class="small text-muted fw-bold mb-1">No. Meja</label>

                                    <button type="button"
                                        class="btn bg-white border w-100 text-start d-flex justify-content-between align-items-center"
                                        data-bs-toggle="modal" data-bs-target="#modalPilihMeja">
                                        <span id="selected-meja-text" class="text-truncate">Pilih Meja</span>
                                        <i class="bi bi-grid-3x3-gap"></i>
                                    </button>
                                    {{-- Input hidden tidak diperlukan disini karena akan digenerate saat submit di modal checkout --}}

                                </div>
                                {{-- pilih jenis pemesanan (take way atau dine in atau reservasi) --}}
                                <div class="col col-lg-6">
                                    <label class="small text-muted fw-bold mb-1">Jenis Pemesanan</label>
                                    <div class="input-group shadow-sm">
                                        <span class="input-group-text bg-white border-end-0"><i
                                                class="bi bi-bag-fill"></i></span>
                                        <select name="jenis_id_display" id="jenis_id_display"
                                            class="form-select border-start-0 ps-2"
                                            style="font-size: 0.85rem; cursor: pointer;">
                                            <option value="">Pilih Jenis</option>
                                            <option value="dine_in" data-name="dine in">Dine In</option>
                                            <option value="take_away" data-name="takeaway">Take Away</option>
                                            <option value="reservasi" data-name="{{ strtolower('Reservasi') }}">Reservasi
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <p class="fw-bold mb-3"><i class="bi bi-cart4 me-2"></i>Order #21</p>
                            <div id="cart-items" class="overflow-auto" style="max-height: 50vh;">
                                <div class="text-center text-muted py-5">
                                    <i class="bi bi-cart-x fs-3"></i>
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
                <form action="{{ route('pesanan.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="cart_items" id="cart_items_input">
                    <input type="hidden" name="jenis_id" id="jenis_id_modal">

                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title fw-bold" id="checkoutModalLabel">
                            <i class="bi bi-wallet2 me-2"></i>Konfirmasi Pesanan
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="text-center mb-4">
                            <p class="text-muted mb-1 small text-uppercase fw-bold">Total Tagihan</p>
                            <h2 class="fw-bold text-primary fs-2" id="checkout-total">Rp 0</h2>
                            {{-- input hidden untuk menyimpan total tagihan --}}
                            <input type="hidden" name="total_tagihan" id="total_tagihan">
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted">Nama Pemesan</label>
                                <input type="text" name="nama_pemesan" class="form-control" required>
                            </div>
                            <div class="col-md-6" id="no-telp-container">
                                <label class="form-label fw-bold small text-muted">No. Telepon</label>
                                <input type="text" name="no_telp" class="form-control">
                            </div>
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-md-6" id="jumlah-orang-container">
                                <label class="form-label fw-bold small text-muted">Jumlah Orang</label>
                                <input type="number" name="jumlah_orang" class="form-control" value="1"
                                    min="1">
                            </div>
                        </div>

                        <div class="mb-3" id="waktu-pesanan-container">
                            <label class="form-label fw-bold small text-muted">Waktu Pesanan</label>
                            <select name="waktu_pesanan" id="waktu_pesanan" class="form-select">
                                <option value="sekarang">Sekarang (Langsung)</option>
                                <option value="reservasi">Reservasi (Nanti)</option>
                            </select>
                        </div>

                        <div class="mb-3 d-none" id="tanggal_reservasi_container">
                            <label class="form-label fw-bold small text-muted">Tanggal & Jam</label>
                            <input type="datetime-local" name="tanggal_pemesanan" id="tanggal_pemesanan"
                                class="form-control">
                        </div>

                        {{-- Optional: Payment Simulation (Client Side Only for now as Controller doesn't take payment) --}}
                        <div class="mb-3">
                            <label for="payment_amount" class="form-label fw-bold small text-muted">Uang Tunai
                                (Opsional)</label>
                            <div class="input-group input-group-lg shadow-sm">
                                <span class="input-group-text bg-white text-muted border-end-0"><i
                                        class="bi bi-cash-stack"></i></span>
                                <input type="text" name="payment_amount" inputmode="numeric"
                                    class="form-control border-start-0 ps-2" id="payment_amount" placeholder="0">
                            </div>
                            <div class="form-text text-end text-success fw-bold" id="change_text"></div>
                        </div>

                    </div>
                    <div class="modal-footer border-top-0 px-4 pb-4">
                        <button type="button" class="btn btn-light text-muted fw-bold px-4" data-bs-dismiss="modal">
                            <i class="bi bi-x-lg me-1"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-primary fw-bold px-4 flex-grow-1 shadow-sm">
                            <i class="bi bi-check-circle-fill me-2"></i> Simpan Pesanan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Pilih Meja dengan DataTables --}}
    <div class="modal fade" id="modalPilihMeja" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pilih Meja</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="tableMeja" style="width:100%">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center" width="50">Pilih</th>
                                    <th>Nama Meja</th>
                                    <th>Area</th>
                                    <th width="100">Jml Orang</th>
                                    <th>Kapasitas</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mejas as $meja)
                                    <tr>
                                        <td class="text-center">
                                            <input type="checkbox" class="form-check-input meja-checkbox"
                                                value="{{ $meja->id }}" data-name="Meja {{ $meja->name }}"
                                                {{ $meja->kapasitas == 'Penuh' ? 'disabled' : '' }}>
                                        </td>
                                        <td>Meja {{ $meja->name }}</td>
                                        <td>{{ $meja->area->name ?? 'Area Umum' }}</td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm meja-jumlah"
                                                min="1" value="1" style="width: 80px;"
                                                {{ $meja->kapasitas == 'Penuh' ? 'disabled' : '' }}>
                                        </td>
                                        <td>{{ $meja->jumlah_kursi }} Kursi</td>
                                        <td>
                                            @if ($meja->kapasitas == 'Penuh')
                                                <span class="badge bg-danger">Penuh</span>
                                            @else
                                                <span class="badge bg-success">{{ $meja->kapasitas }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="btnSimpanMeja">Simpan
                        Pilihan</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let cart = [];
        let tableMeja;

        $(document).ready(function() {

            // Init DataTable Meja
            tableMeja = $('#tableMeja').DataTable({
                paging: false,
                scrollY: '300px',
                scrollCollapse: true,
                searching: true,
                info: false,
                autoWidth: false
            });

            $('#modalPilihMeja').on('shown.bs.modal', function() {
                tableMeja.columns.adjust();
            });

            // Handle tombol Simpan di Modal Meja
            $('#btnSimpanMeja').on('click', function() {
                updateSelectedMejaDisplay();
                validateCheckoutButton();
            });

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
            const changeText = document.getElementById('change_text');
            const checkoutTotalEl = document.getElementById('checkout-total');
            // total_tagihan
            const totalTagihanInput = document.getElementById('total_tagihan');
            const cartItemsInput = document.getElementById('cart_items_input');
            const jumlahOrangInput = document.querySelector('input[name="jumlah_orang"]');
            const modalForm = document.querySelector('#checkoutModal form');

            checkoutBtn.addEventListener('click', function() {
                const total = this.dataset.total;
                checkoutTotalEl.innerText = formatRupiah(total);
                checkoutTotalEl.dataset.val = total;
                totalTagihanInput.value = total;

                // Sync Data to Form
                cartItemsInput.value = JSON.stringify(cart);

                // Handle multiple mejas
                // Remove existing meja_id inputs to avoid duplication
                modalForm.querySelectorAll('input[name="meja_id[]"]').forEach(el => el.remove());
                modalForm.querySelectorAll('input[name^="meja_input"]').forEach(el => el.remove());

                // Ambil dari checkbox yang tercentang di DataTable
                // Gunakan API DataTable untuk mengambil node (aman jika nanti paging diaktifkan)
                let selectedMejas = [];
                let totalOrangMeja = 0;

                tableMeja.$('input.meja-checkbox:checked').each(function() {
                    let row = $(this).closest('tr');
                    let jumlahInput = row.find('.meja-jumlah').val();
                    let jumlah = parseInt(jumlahInput) || 1;

                    selectedMejas.push({
                        id: $(this).val(),
                        jumlah: jumlah
                    });
                    totalOrangMeja += jumlah;
                });

                // Jika ada meja yang dipilih, update input jumlah orang di modal checkout
                if (selectedMejas.length > 0) {
                    jumlahOrangInput.value = totalOrangMeja;
                }

                // Buat input hidden untuk dikirim ke controller
                selectedMejas.forEach((item, index) => {
                    // Kirim array struct: meja_input[0][id] dan meja_input[0][jumlah]
                    $('<input>').attr({
                        type: 'hidden',
                        name: `meja_input[${index}][id]`,
                        value: item.id
                    }).appendTo(modalForm);
                    $('<input>').attr({
                        type: 'hidden',
                        name: `meja_input[${index}][jumlah]`,
                        value: item.jumlah
                    }).appendTo(modalForm);
                });
            });

            paymentInput.addEventListener('input', function() {
                // Dapatkan nilai mentah dengan menghapus karakter non-digit (selain angka)
                let rawValue = this.value.replace(/\D/g, '');

                // Jika input kosong, reset kembalian dan nilai input
                if (rawValue === '') {
                    this.value = '';
                    changeText.innerText = '';
                    return;
                }

                // Konversi nilai mentah ke integer untuk perhitungan
                const pay = parseInt(rawValue, 10);
                const total = parseInt(checkoutTotalEl.dataset.val || 0);

                // Hitung dan tampilkan kembalian
                const change = pay - total;
                changeText.innerText = (change >= 0) ? 'Kembalian: ' + formatRupiah(change) : 'Kurang: ' +
                    formatRupiah(Math.abs(change));

                // Format ulang nilai input dengan pemisah ribuan (titik)
                this.value = pay.toLocaleString('id-ID');
            });

            // Logic Waktu Pesanan
            const waktuSelect = document.getElementById('waktu_pesanan');
            const tglContainer = document.getElementById('tanggal_reservasi_container');
            const tglInput = document.getElementById('tanggal_pemesanan');

            waktuSelect.addEventListener('change', function() {
                if (this.value === 'reservasi') {
                    tglContainer.classList.remove('d-none');
                    tglInput.required = true;
                } else {
                    tglContainer.classList.add('d-none');
                    tglInput.required = false;
                }
            });

            // Logic Filter Kategori (DOM)
            const categoryButtons = document.querySelectorAll('.category-filter');
            const productItems = document.querySelectorAll('.product-item');

            categoryButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Reset active class
                    categoryButtons.forEach(btn => {
                        btn.classList.remove('btn-success');
                        btn.classList.add('btn-outline-secondary');
                    });
                    // Set active class
                    this.classList.remove('btn-outline-secondary');
                    this.classList.add('btn-success');

                    const category = this.getAttribute('data-category');
                    productItems.forEach(item => {
                        const itemCategory = item.getAttribute('data-category');
                        if (category === 'all' || itemCategory === category) {
                            item.classList.remove('d-none');
                        } else {
                            item.classList.add('d-none');
                        }
                    });
                });
            });

            // Logic Jenis Pesanan (Dine In, Take Away, Reservasi)
            const jenisDisplay = document.getElementById('jenis_id_display');
            const jenisModal = document.getElementById('jenis_id_modal');
            const mejaContainer = document.getElementById('meja-container');
            const noTelpContainer = document.getElementById('no-telp-container');
            const jumlahOrangContainer = document.getElementById('jumlah-orang-container');
            const waktuPesananContainer = document.getElementById('waktu-pesanan-container');

            jenisDisplay.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const typeName = (selectedOption.getAttribute('data-name') || '').toLowerCase();

                // Sync selection to modal
                jenisModal.value = this.value;

                // Reset Visibility
                mejaContainer.classList.remove('d-none');
                noTelpContainer.classList.remove('d-none');
                jumlahOrangContainer.classList.remove('d-none');
                waktuPesananContainer.classList.remove('d-none');

                // Logic based on type name
                if (typeName.includes('take away') || typeName.includes('takeaway')) {
                    // Take Away: Hide Meja, Jumlah Orang, No Telp, Waktu
                    mejaContainer.classList.add('d-none');
                    jumlahOrangContainer.classList.add('d-none');
                    noTelpContainer.classList.add('d-none');

                    // Deselect all tables
                    tableMeja.$('input.meja-checkbox').prop('checked', false);
                    updateSelectedMejaDisplay();

                    // Set waktu to sekarang and hide
                    waktuSelect.value = 'sekarang';
                    waktuSelect.dispatchEvent(new Event('change'));
                    waktuPesananContainer.classList.add('d-none');

                } else if (typeName.includes('reservasi')) {
                    // Reservasi: Show All (Meja, Telp, Jumlah, Waktu)
                    // Force waktu to reservasi
                    waktuSelect.value = 'reservasi';
                    waktuSelect.dispatchEvent(new Event('change'));

                } else {
                    // Dine In (Default): Show Meja, Jumlah. Hide Telp.
                    noTelpContainer.classList.add('d-none');

                    // Set waktu to sekarang and hide
                    waktuSelect.value = 'sekarang';
                    waktuSelect.dispatchEvent(new Event('change'));
                    waktuPesananContainer.classList.add('d-none');
                }
                validateCheckoutButton();
            });
        });

        function updateSelectedMejaDisplay() {
            let selectedNames = [];
            tableMeja.$('input.meja-checkbox:checked').each(function() {
                selectedNames.push($(this).data('name'));
            });

            const displayEl = document.getElementById('selected-meja-text');
            if (selectedNames.length > 0) {
                displayEl.innerText = selectedNames.join(', ');
                displayEl.classList.add('text-primary', 'fw-bold');
            } else {
                displayEl.innerText = 'Pilih Meja';
                displayEl.classList.remove('text-primary', 'fw-bold');
            }
        }

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
                    <i class="bi bi-cart-x fs-3"></i>
                    <p class="mt-2">Belum ada pesanan</p>
                </div>`;
                // checkoutBtn.disabled = true;
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
                // checkoutBtn.disabled = false;
            }

            const tax = subtotal * 0.1;
            const total = subtotal + tax;

            subtotalEl.innerText = formatRupiah(subtotal);
            taxEl.innerText = formatRupiah(tax);
            totalEl.innerText = formatRupiah(total);
            checkoutBtn.dataset.total = total; // Simpan total ke tombol untuk diambil modal
            validateCheckoutButton();
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

        function validateCheckoutButton() {
            const btn = document.getElementById('btn-checkout');
            if (!btn) return;

            const cartValid = cart.length > 0;
            const jenisSelect = document.getElementById('jenis_id_display');
            const jenisValue = jenisSelect ? jenisSelect.value : '';
            const jenisValid = jenisValue !== "";

            let mejaValid = false;

            if (jenisValid) {
                const selectedOption = jenisSelect.options[jenisSelect.selectedIndex];
                const typeName = (selectedOption.getAttribute('data-name') || '').toLowerCase();

                if (typeName.includes('take away') || typeName.includes('takeaway')) {
                    mejaValid = true;
                } else if (typeof tableMeja !== 'undefined') {
                    mejaValid = tableMeja.$('input.meja-checkbox:checked').length > 0;
                }
            }

            btn.disabled = !(cartValid && jenisValid && mejaValid);
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
