<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Resto POS</title>
    <!-- Custom fonts for this template-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- select2 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- <link rel="stylesheet" href="{{ asset('css/login.css') }}"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f0f2f5;
            background-image: radial-gradient(circle at 10% 20%, rgb(242, 235, 243) 0%, rgb(234, 241, 249) 90%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-login {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .login-image {
            background: linear-gradient(135deg, #754223 0%, #a05a32 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .login-image::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('{{ asset('image_login.png') }}') center/cover no-repeat;
            opacity: 0.2;
            mix-blend-mode: overlay;
        }

        .form-section {
            padding: 3rem;
            background: #fff;
        }

        .form-control {
            border-radius: 10px;
            padding: 0.8rem 1rem;
            background-color: #f8f9fa;
            border: 1px solid #eee;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #754223;
            background-color: #fff;
        }

        .btn-primary-custom {
            background-color: #754223;
            border-color: #754223;
            border-radius: 10px;
            padding: 0.8rem;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s;
        }

        .btn-primary-custom:hover {
            background-color: #5e341b;
            border-color: #5e341b;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(117, 66, 35, 0.2);
        }

        .social-icons a {
            width: 35px;
            height: 35px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #f1f1f1;
            color: #555;
            text-decoration: none;
            margin: 0 5px;
            transition: all 0.3s;
        }

        .lead {
            font-size: 0.8rem;
        }

        .social-icons a:hover {
            background: #754223;
            color: #fff;
        }

        @media (max-width: 991px) {
            .login-image {
                display: none;
            }

            .form-section {
                padding: 2rem;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card card-login">
                    <div class="row g-0">
                        <!-- Left Side (Image) -->
                        <div class="col-lg-6 login-image">
                            <div class="text-center text-white p-5 position-relative" style="z-index: 1;">
                                <i class="bi bi-shop display-1 mb-4"></i>
                                <h2 class="fw-bold mb-3">Resto POS</h2>
                                <p class="lead">Sistem Manajemen Restoran Terintegrasi.</p>
                            </div>
                        </div>

                        <!-- Right Side (Form) -->
                        <div class="col-lg-6">
                            <div class="form-section h-100 d-flex flex-column justify-content-center">
                                <div class="text-center mb-4">
                                    <h3 class="fw-bold text-dark">Selamat Datang!</h3>
                                    <p class="text-muted">Silahkan login untuk melanjutkan</p>
                                </div>

                                <form method="POST" action="{{ route('login.post') }}" id="loginForm">
                                    @csrf
                                    <div class="mb-4">
                                        <label class="form-label text-muted small fw-bold">EMAIL</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-transparent border-end-0 text-muted"><i
                                                    class="fas fa-envelope"></i></span>
                                            <input type="email" name="email"
                                                class="form-control border-start-0 ps-0"
                                                placeholder="Masukkan email Anda" required>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label text-muted small fw-bold">PASSWORD</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-transparent border-end-0 text-muted"><i
                                                    class="fas fa-lock"></i></span>
                                            <input type="password" name="password"
                                                class="form-control border-start-0 ps-0"
                                                placeholder="Masukkan password Anda" required>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="remember">
                                            <label class="form-check-label small text-muted" for="remember">Ingat
                                                Saya</label>
                                        </div>
                                        <a href="#" class="small text-decoration-none"
                                            style="color: #754223;">Lupa Password?</a>
                                    </div>

                                    <button type="submit" class="btn btn-primary-custom mb-4 text-white"
                                        id="loginBtn">
                                        LOGIN
                                    </button>

                                    {{-- <div class="text-center">
                                        <p class="small text-muted mb-3">Atau masuk dengan</p>
                                        <div class="social-icons">
                                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                                            <a href="#"><i class="fab fa-google"></i></a>
                                            <a href="#"><i class="fab fa-twitter"></i></a>
                                        </div>
                                    </div> --}}
                                </form>

                                {{-- registrasi --}}
                                {{-- <div class="text-center mt-4">
                                    <p class="small text-muted">Belum punya akun?
                                        <a href="{{ route('register') }}" class="text-decoration-none fw-bold"
                                            style="color: #754223;">Daftar Sekarang</a>
                                    </p>
                                </div> --}}


                                <div class="text-center mt-5">
                                    <small class="text-muted">&copy; {{ date('Y') }} Resto POS. All rights
                                        reserved.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        @endif

        // Disable button on submit to prevent double click
        $('#loginForm').on('submit', function() {
            let btn = $('#loginBtn');
            btn.prop('disabled', true);
            btn.html('<i class="fas fa-spinner fa-spin me-2"></i> Loading...');
        });
    </script>
</body>

</html>
