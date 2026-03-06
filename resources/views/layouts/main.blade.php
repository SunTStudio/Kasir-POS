<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin POS Restoran</title>

    <!-- Menggunakan Bootstrap 5 (CDN untuk kemudahan, bisa diganti asset lokal) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Font Awesome (Public CDN) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- DataTables & Responsive CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

    <style>
        body {
            background-color: #f3f4f6;
            /* Abu-abu muda modern */
            font-family: 'Poppins', sans-serif;
            font-size: 0.85rem;
            padding-top: 80px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.95) !important;
        }

        .nav-link {
            font-weight: 500;
            color: #555;
            transition: color 0.2s;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #0d6efd;
        }
    </style>
    @yield('style')
</head>

<body>
    <!-- Navbar Fixed Top -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm fixed-top">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold text-primary" href="{{ route('dashboard') }}">
                <i class="bi bi-shop me-2"></i>Resto POS
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                            href="{{ route('dashboard') }}"><i class="bi bi-speedometer2 me-1"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pesanan.create') ? 'active' : '' }}"
                            href="{{ route('pesanan.create') }}"><i class="bi bi-cart4 me-1"></i> POS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pesanan') ? 'active' : '' }}"
                            href="{{ route('pesanan') }}"><i class="bi bi-list-ul me-1"></i> Pesanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('manajement.meja') ? 'active' : '' }}"
                            href="{{ route('manajement.meja') }}"><i class="bi bi-grid-3x3-gap me-1"></i> Meja</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('produk*') || request()->routeIs('kategori*') || request()->routeIs('jenis.order*') ? 'active' : '' }}"
                            href="#" id="navbarDropdownMenu" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="bi bi-collection me-1"></i> Master Data
                        </a>
                        <ul class="dropdown-menu border-0 shadow-sm" aria-labelledby="navbarDropdownMenu">
                            <li><a class="dropdown-item" href="{{ route('produk') }}">Daftar Menu</a></li>
                            <li><a class="dropdown-item" href="{{ route('kategori') }}">Kategori</a></li>
                            <li><a class="dropdown-item" href="{{ route('jenis.order') }}">Jenis Order</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('keuangan') ? 'active' : '' }}"
                            href="{{ route('keuangan') }}"><i class="bi bi-cash-coin me-1"></i> Laporan</a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-secondary" href="#" id="navbarDropdownUser"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i> Hi, Admin
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm"
                            aria-labelledby="navbarDropdownUser">
                            <li><a class="dropdown-item" href="{{ route('profile') }}"><i
                                        class="bi bi-gear me-2"></i>Pengaturan</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item text-danger" href="{{ route('logout') }}"><i
                                        class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container-fluid px-4 mb-5">
        @yield('content')
    </div>

    <footer class="py-4 bg-white mt-auto border-top">
        <div class="container-fluid px-4 justify-content-center">
            <div class="d-flex align-items-center justify-content-center small">
                <div class="text-muted text-center">Copyright &copy; SunStudio {{ date('Y') }}</div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery & DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

    <!-- Core theme JS-->
    @yield('script')
</body>

</html>
