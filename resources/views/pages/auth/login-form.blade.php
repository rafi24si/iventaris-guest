<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Inventaris Aset Desa</title>

    {{-- BOOTSTRAP --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- ICON --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #1abc9c 0%, #3498db 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .login-wrapper {
            width: 100%;
            max-width: 420px;
        }

        .logo-box {
            text-align: center;
            margin-bottom: 1rem;
        }

        .logo-box img {
            height: 75px;
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .login-container {
            background: white;
            border-radius: 15px;
            padding: 2.8rem;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25);
        }

        .login-title {
            font-weight: 700;
            color: #2c3e50;
            text-align: center;
            margin-bottom: 1.8rem;
        }

        .form-control {
            border-radius: 8px;
            padding: 0.75rem 1rem;
        }

        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52,152,219,0.25);
        }

        .btn-login {
            background: #3498db;
            width: 100%;
            padding: 0.75rem;
            color: white;
            font-weight: 600;
            border-radius: 8px;
            border: none;
        }

        .btn-login:hover {
            background: #2980b9;
        }

        .register-link a {
            color: #3498db;
            font-weight: bold;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="login-wrapper">

        {{-- LOGO (seperti di INDEX) --}}
        <div class="logo-box">
            <a href="{{ route('dashboard') }}" class="navbar-brand mx-auto text-center">
                <img src="{{ asset('assets-guest/images/logo/unnamed.png') }}" alt="Logo">
            </a>
        </div>

        <div class="login-container">

            <h2 class="login-title">Masuk ke Sistem Inventaris</h2>

            {{-- ALERT SUCCESS --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- ALERT ERROR --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <ul class="mb-0 list-unstyled">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- FORM LOGIN --}}
            <form action="/auth/login" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-envelope me-2"></i>Email</label>
                    <input type="email" name="email" class="form-control"
                           value="{{ old('email') }}" placeholder="Masukkan email" required>
                </div>

                <div class="mb-4">
                    <label class="form-label"><i class="fas fa-lock me-2"></i>Password</label>
                    <input type="password" name="password" class="form-control"
                           placeholder="Masukkan password" required>
                </div>

                <button type="submit" class="btn btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i> Login
                </button>

                <div class="text-center mt-4 register-link">
                    <p>Belum punya akun? <a href="/auth/register">Daftar di sini</a></p>
                </div>

            </form>

        </div>
    </div>

    {{-- JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
