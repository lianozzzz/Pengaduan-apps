<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lupa Password</title>
    <link href="{{ asset('public/template/assets/css/style.css') }}" rel="stylesheet">
</head>
<body class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="auth-form">
                            <h4 class="text-center mb-4">Reset Password</h4>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    {{ implode(', ', $errors->all()) }}
                                </div>
                            @endif

                            <form action="{{ route('password.manual.update') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label>No HP</label>
                                    <input type="text" name="no_hp" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Username</label>
                                    <input type="text" name="username" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Password Baru</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" class="form-control" required>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                                </div>
                            </form>

                            <div class="text-center mt-3">
                                <a href="{{ route('login') }}">Kembali ke Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
