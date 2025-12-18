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
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
            background:
                linear-gradient(
                    rgba(20, 160, 133, 0.85),
                    rgba(30, 190, 110, 0.85)
                ),
                url("https://images.unsplash.com/photo-1584515933487-779824d29309");
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-wrapper {
            width: 100%;
            max-width: 420px;
            z-index: 2;
        }

        .logo-box {
            text-align: center;
            margin-bottom: 1.2rem;
        }

        .logo-box img {
            height: 75px;
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-container {
            background: rgba(255, 255, 255, 0.96);
            border-radius: 18px;
            padding: 2.8rem;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.25);
        }

        .login-title {
            font-weight: 700;
            color: #1e8449;
            text-align: center;
            margin-bottom: 1.8rem;
        }

        .form-label {
            font-weight: 600;
            color: #2c3e50;
        }

        .form-control {
            border-radius: 10px;
            padding: 0.8rem 1rem;
        }

        .form-control:focus {
            border-color: #2ecc71;
            box-shadow: 0 0 0 0.2rem rgba(46, 204, 113, 0.25);
        }

        .btn-login {
            background: linear-gradient(135deg, #27ae60, #2ecc71);
            width: 100%;
            padding: 0.8rem;
            color: white;
            font-weight: 600;
            border-radius: 10px;
            border: none;
            transition: 0.3s;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #1e8449, #27ae60);
            transform: translateY(-1px);
        }

        .register-link a {
            color: #27ae60;
            font-weight: 700;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .alert {
            border-radius: 10px;
        }
    </style>
</head>

<body>

    <div class="login-wrapper">

        {{-- LOGO --}}
        <div class="logo-box">
            <a href="{{ route('dashboard') }}" class="navbar-brand mx-auto text-center">
                <img src="{{ asset('assets-guest/images/logo1.png') }}" alt="Logo" height="200">
            </a>
        </div>

        <div class="login-container">

            <h2 class="login-title">
                <i class="fas fa-leaf me-2"></i>
                Login Sistem Inventaris
            </h2>

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
                    <label class="form-label">
                        <i class="fas fa-envelope me-2 text-success"></i>Email
                    </label>
                    <input type="email" name="email" class="form-control"
                           value="{{ old('email') }}" placeholder="Masukkan email" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">
                        <i class="fas fa-lock me-2 text-success"></i>Password
                    </label>
                    <input type="password" name="password" class="form-control"
                           placeholder="Masukkan password" required>
                </div>

                <button type="submit" class="btn btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i> Login
                </button>

                <div class="text-center mt-4 register-link">
                    <p>Belum punya akun?
                        <a href="/auth/register">Daftar di sini</a>
                    </p>
                </div>

            </form>

        </div>
    </div>

    {{-- JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
