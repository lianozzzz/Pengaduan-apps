<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Dompet : Payment Admin Template" />
    <meta property="og:title" content="Dompet : Payment Admin Template" />
    <meta property="og:description" content="Dompet : Payment Admin Template" />
    <meta property="og:image" content="https://dompet.dexignlab.com/xhtml/social-image.png" />
    <meta name="format-detection" content="telephone=no">

    <!-- PAGE TITLE HERE -->
    <title>Pengaduan Masyarakat</title>

    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="images/favicon.png" />
    <link href="public/template/assets/css/style.css" rel="stylesheet">

</head>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <div class="text-center mb-3">
                                        <a href="index.html"><img
                                                src="public/template/assets/logo/logo-polsek.jpg " width="80px"
                                                alt=""></a>
                                    </div>
                                    <div class="mb-4 ">
                                        <h4 class="text-center fw-bold">Selamat Datang di Sistem Pengaduan</h4>
                                        <h4 class="text-center fw-bold">Masyarakat Bukit Kapur</h4>
                                        @if (session('success'))
                                            <div class="alert alert-secondary alert-dismissible text-dark fade show mt-3 fw-bold"
                                                role="alert">
                                                {{ session('success') }}
                                                <button type="secondary" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif
                                    </div>
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <h6 class="fw-bold text-start mb-4">SILAKAN LOGIN!!</h6>

                                        {{-- Username --}}
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Username</strong></label>
                                            <input type="text" name="username" value="{{ old('username') }}" required
                                                autofocus class="form-control @error('username') is-invalid @enderror"
                                                placeholder="Masukkan username">
                                            @error('username')
                                                <span class="invalid-feedback d-block"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>

                                        {{-- Password --}}
                                        <div class="mb-4">
                                            <label class="mb-1"><strong>Password</strong></label>
                                            <input type="password" name="password" required
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="*********">
                                            @error('password')
                                                <span class="invalid-feedback d-block"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>

                                        {{-- Tombol Login --}}
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                                        </div>
                                    </form>

                                    <div class="new-account mt-3">
                                        <p>Belum punya akun? <a class="text-primary"
                                                href="{{ route('index.registrasi') }}">Registrasi sekarang</a>
                                        </p>
                                        <p>
                                            <a class="text-danger" href="{{ route('forgot.password') }}">Lupa Password?</a>
                                        </p>
                                    </div>

                            
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="public/template/assets/vendor/global/global.min.js"></script>
    <script src="public/template/assets/js/custom.min.js"></script>
    <script src="public/template/assets/js/dlabnav-init.js"></script>

</body>

</html>
