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
    <title>Registrasi Masyarakat </title>

    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="images/favicon.png" />
    <link href="public/template/assets/css/style.css" rel="stylesheet">

</head>
<style>
    /* Untuk Chrome, Safari, Edge, Opera */
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Untuk Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    {{-- <div class="text-center mb-3">
										<a href="index.html"><img src="public/template/assets/logo/logo-polsek.jpg " width="80px" alt=""></a>
									</div> --}}
                                    <div class="mb-2">
                                        <h2 class="text-center fw-bold">Registrasi</h2>
                                    </div>
                                    <form action="{{ route('registrasi.store') }}" method="POST">
                                        @csrf

                                        <!-- Nama Lengkap -->
                                        <div class="mb-2">
                                            <label><strong>Nama Lengkap</strong></label>
                                            <input type="text" name="nama_lengkap"
                                                class="form-control @error('nama_lengkap') is-invalid @enderror"
                                                placeholder="Masukkan Nama Lengkap" value="{{ old('nama_lengkap') }}">
                                            @error('nama_lengkap')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Jenis Kelamin -->
                                        <div class="mb-2">
                                            <label class="mb-1"><strong>Jenis Kelamin</strong></label>
                                            <select name="jenis_kelamin"
                                                class="form-select @error('jenis_kelamin') is-invalid @enderror">
                                                <option disabled selected>Pilih jenis kelamin</option>
                                                <option value="Laki-Laki"
                                                    {{ old('jenis_kelamin') == 'Laki-Laki' ? 'selected' : '' }}>
                                                    Laki-Laki</option>
                                                <option value="Perempuan"
                                                    {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                                    Perempuan</option>
                                            </select>
                                            @error('jenis_kelamin')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Tanggal Lahir -->
                                        <div class="mb-2">
                                            <label><strong>Tanggal Lahir</strong></label>
                                            <input type="date" name="tanggal_lahir"
                                                class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                                value="{{ old('tanggal_lahir') }}">
                                            @error('tanggal_lahir')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- No HP -->
                                        <div class="mb-2">
                                            <label><strong>No HP</strong></label>
                                            <input type="number" name="no_hp"
                                                class="form-control @error('no_hp') is-invalid @enderror"
                                                placeholder="08**********" value="{{ old('no_hp') }}">
                                            @error('no_hp')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Username -->
                                        <div class="mb-2">
                                            <label><strong>Username</strong></label>
                                            <input type="text" name="username"
                                                class="form-control @error('username') is-invalid @enderror"
                                                placeholder="Masukkan Username" value="{{ old('username') }}">
                                            @error('username')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Password -->
                                        <div class="mb-2">
                                            <label><strong>Password</strong></label>
                                            <input type="password" name="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="*********">
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                                        </div>
                                    </form>

                                    <div class="new-account mt-2">
                                        <p>Sudah punya akun? <a class="text-primary" href="/">Login sekarang</a>
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
