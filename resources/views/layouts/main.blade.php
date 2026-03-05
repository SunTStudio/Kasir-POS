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
            overflow-x: hidden;
            background-color: #f3f4f6;
            /* Abu-abu muda modern */
            font-family: 'Poppins', sans-serif;
            font-size: 0.8rem;
        }

        #wrapper {
            display: flex;
        }

        #sidebar-wrapper {
            min-height: 100vh;
            margin-left: -16rem;
            transition: margin .25s ease-out;
            width: 16rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            z-index: 10;
        }

        #sidebar-wrapper .sidebar-heading {
            padding: 0.875rem 1.25rem;
            font-size: 1.2rem;
            font-weight: 700;
        }

        #sidebar-wrapper .list-group {
            width: 16rem;
        }

        #page-content-wrapper {
            min-width: 100vw;
            width: 100%;
        }

        /* Custom Style untuk Menu Sidebar Minimalis */
        .list-group-item {
            border: none;
            padding: 1rem 1.5rem;
            font-weight: 500;
            color: #5a5c69;
            transition: all 0.3s ease-in-out;
        }

        .list-group-item:hover {
            background-color: #eef2ff;
            color: #2e59d9;
            padding-left: 1.75rem;
            box-shadow: inset 5px 0 0 #2e59d9;
        }

        body.sb-sidenav-toggled #wrapper #sidebar-wrapper {
            margin-left: 0;
        }

        @media (min-width: 768px) {
            #sidebar-wrapper {
                margin-left: 0;
            }

            #page-content-wrapper {
                min-width: 0;
                width: 100%;
            }

            body.sb-sidenav-toggled #wrapper #sidebar-wrapper {
                margin-left: -16rem;
            }
        }
    </style>
    @yield('style')
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white border-end" id="sidebar-wrapper">
            <div class="sidebar-heading border-bottom bg-white text-primary"><i class="bi bi-shop me-2"></i>Resto POS
                Admin</div>
            <div class="list-group list-group-flush">
                <a class="list-group-item list-group-item-action bg-white" href="{{ route('dashboard') }}"><i
                        class="bi bi-speedometer2 me-2"></i>Dashboard</a>
                <a class="list-group-item list-group-item-action bg-white" href="{{ route('pesanan.create') }}"><i
                        class="bi bi-cart4 me-2"></i>Buat Pesanan (POS)</a>
                <a class="list-group-item list-group-item-action bg-white" href="{{ route('manajement.meja') }}"><i
                        class="bi bi-grid-3x3-gap me-2"></i>Manajemen Meja</a>
                        {{-- list pesanan --}} 
                <a class="list-group-item list-group-item-action bg-white" href="{{ route('pesanan') }}"><i
                        class="bi bi-list-ul me-2"></i>List Pesanan</a>
                <a class="list-group-item list-group-item-action bg-white" href="{{ route('produk') }}"><i
                        class="bi bi-book me-2"></i>Daftar Menu</a>
                <a class="list-group-item list-group-item-action bg-white" href="{{ route('keuangan') }}"><i
                        class="bi bi-cash-coin me-2"></i>Laporan Keuangan</a>
                        {{-- kategori --}}

                <a class="list-group-item list-group-item-action bg-white" href="{{ route('kategori') }}"><i
                        class="bi bi-tags me-2"></i>Kategori</a>
                        {{-- jenis Order --}}
                <a class="list-group-item list-group-item-action bg-white" href="{{ route('jenis.order') }}"><i
                        class="bi bi-card-list me-2"></i>Jenis Order</a>
                <a class="list-group-item list-group-item-action bg-white" href="{{ route('profile') }}"><i
                        class="bi bi-gear me-2"></i>Pengaturan</a> 
            </div>
        </div>

        <!-- Page Content Wrapper -->
        <div id="page-content-wrapper">
            <!-- Top Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
                <div class="container-fluid">
                    <button class="btn btn-light text-secondary" id="sidebarToggle">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                            <li class="nav-item active"><a class="nav-link text-secondary" href="#!"><i
                                        class="bi bi-house-door me-1"></i>Home</a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-secondary" id="navbarDropdown" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false"><i class="bi bi-person-circle me-1"></i>Hi, Admin</a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#!"><i class="bi bi-person me-2"></i>Profile</a>
                                    <a class="dropdown-item" href="#!"><i
                                            class="bi bi-sliders me-2"></i>Settings</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#!"><i
                                            class="bi bi-box-arrow-right me-2"></i>Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="container-fluid px-4 py-4">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery & DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

    <!-- Core theme JS-->
    <script>
        window.addEventListener('DOMContentLoaded', event => {
            const sidebarToggle = document.body.querySelector('#sidebarToggle');
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', event => {
                    event.preventDefault();
                    document.body.classList.toggle('sb-sidenav-toggled');
                });
            }
        });
    </script>
    @yield('script')
</body>

</html>
