<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Sistem Inventaris</title>

    {{-- BOOTSTRAP --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- ICON --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            background:
                linear-gradient(
                    rgba(20, 160, 133, 0.85),
                    rgba(30, 190, 110, 0.85)
                ),
                url("https://images.unsplash.com/photo-1584515933487-779824d29309");
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .register-container {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 18px;
            padding: 3rem;
            width: 100%;
            max-width: 520px;
            box-shadow: 0 25px 60px rgba(0,0,0,0.3);
            animation: fadeIn 0.9s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(25px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .register-icon {
            font-size: 4rem;
            color: #27ae60;
            animation: pulse 1.8s infinite ease-in-out;
        }

        @keyframes pulse {
            0%,100% { transform: scale(1); opacity: 1; }
            50%     { transform: scale(1.15); opacity: 0.7; }
        }

        .register-title {
            font-weight: 700;
            color: #1e8449;
            margin-top: 0.5rem;
        }

        .form-label {
            font-weight: 600;
            color: #2c3e50;
        }

        .form-control, .form-select {
            padding: .8rem 1.2rem;
            border-radius: 10px;
            border: 1px solid #dcdcdc;
            transition: 0.3s;
        }

        .form-control:focus, .form-select:focus {
            border-color: #2ecc71;
            box-shadow: 0 0 8px rgba(46, 204, 113, 0.4);
        }

        .btn-register-custom {
            background: linear-gradient(135deg, #27ae60, #2ecc71);
            border: none;
            padding: .9rem;
            color: white;
            border-radius: 10px;
            width: 100%;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-register-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.25);
            background: linear-gradient(135deg, #1e8449, #27ae60);
        }

        .btn-login-link {
            display: block;
            background: #2c3e50;
            color: white;
            padding: .8rem;
            border-radius: 10px;
            text-align: center;
            font-weight: 600;
            transition: 0.3s;
            text-decoration: none;
        }

        .btn-login-link:hover {
            background: #1f2d3a;
            transform: translateY(-2px);
        }

        .alert {
            border-radius: 10px;
            animation: fadeIn 0.4s ease-out;
        }
    </style>
</head>

<body>

<div class="register-container">

    <div class="text-center mb-4">
        <i class="fas fa-user-plus register-icon"></i>
        <h1 class="register-title">Daftar Akun Baru</h1>
        <p class="text-muted mb-0">Sistem Kesehatan Dan Posyandu</p>
    </div>

    {{-- SUCCESS --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- ERROR --}}
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <ul class="mb-0 list-unstyled">
                @foreach($errors->all() as $error)
                    <li><i class="fas fa-times-circle me-2"></i>{{ $error }}</li>
                @endforeach
            </ul>
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="/auth/register" method="POST">
        @csrf

        {{-- NAME --}}
        <div class="mb-3">
            <label class="form-label">
                <i class="fas fa-user me-2 text-success"></i>Nama Lengkap
            </label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name') }}" required>
        </div>

        {{-- EMAIL --}}
        <div class="mb-3">
            <label class="form-label">
                <i class="fas fa-envelope me-2 text-success"></i>Email
            </label>
            <input type="email" name="email" class="form-control"
                   value="{{ old('email') }}" required>
        </div>

        {{-- ROLE --}}
        <div class="mb-3">
            <label class="form-label">
                <i class="fas fa-user-tag me-2 text-success"></i>Pilih Role
            </label>
            <select name="role" class="form-select" required>
                <option value="">-- Pilih Role --</option>
                <option value="admin">Admin</option>
                <option value="petugas">Petugas</option>
                <option value="user">User</option>
            </select>
        </div>

        {{-- PASSWORD --}}
        <div class="mb-3">
            <label class="form-label">
                <i class="fas fa-lock me-2 text-success"></i>Password
            </label>
            <input type="password" name="password" class="form-control" required>
        </div>

        {{-- CONFIRM --}}
        <div class="mb-4">
            <label class="form-label">
                <i class="fas fa-lock me-2 text-success"></i>Konfirmasi Password
            </label>
            <input type="password" name="password_confirmation"
                   class="form-control" required>
        </div>

        <button type="submit" class="btn btn-register-custom mb-3">
            <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
        </button>

        <a href="/auth" class="btn-login-link">
            <i class="fas fa-sign-in-alt me-2"></i>Sudah punya akun? Masuk
        </a>

    </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
