<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Sistem Inventaris</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #12c2e9 0%, #c471ed 50%, #f64f59 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Poppins, sans-serif;
            animation: bgMove 10s infinite alternate ease-in-out;
        }

        @keyframes bgMove {
            0% { background-position: left; }
            100% { background-position: right; }
        }

        .register-container {
            background: white;
            border-radius: 18px;
            padding: 3rem;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.25);
            animation: fadeIn 1s ease-out, float 4s ease-in-out infinite;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(25px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        @keyframes float {
            0%,100% { transform: translateY(0); }
            50%     { transform: translateY(-10px); }
        }

        .register-icon {
            font-size: 4rem;
            color: #f64f59;
            animation: pulse 1.8s infinite ease-in-out;
        }

        @keyframes pulse {
            0%,100% { transform: scale(1); opacity: 1; }
            50%     { transform: scale(1.15); opacity: 0.7; }
        }

        .register-title {
            font-weight: 700;
            color: #2c3e50;
        }

        .form-control, .form-select {
            padding: .75rem 1.2rem;
            border-radius: 10px;
            border: 1px solid #dcdcdc;
            transition: 0.3s;
        }

        .form-control:focus, .form-select:focus {
            border-color: #f64f59;
            box-shadow: 0 0 8px rgba(246,79,89,0.5);
        }

        .btn-register-custom {
            background: linear-gradient(135deg, #f64f59, #c471ed);
            border: none;
            padding: .9rem;
            color: white;
            border-radius: 10px;
            width: 100%;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-register-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.25);
        }

        .btn-login-link {
            display: block;
            background: #34495e;
            color: white;
            padding: .8rem;
            border-radius: 10px;
            text-align: center;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-login-link:hover {
            background: #2c3e50;
            transform: translateY(-3px);
        }

        .alert {
            animation: fadeIn 0.5s ease-out;
        }
    </style>

</head>
<body>

<div class="register-container">

    <div class="text-center mb-4">
        <i class="fas fa-user-plus register-icon"></i>
        <h1 class="register-title">Buat Akun Baru</h1>
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
            <label class="form-label"><i class="fas fa-user me-2"></i>Nama Lengkap</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        {{-- EMAIL --}}
        <div class="mb-3">
            <label class="form-label"><i class="fas fa-envelope me-2"></i>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        {{-- ROLE --}}
        <div class="mb-3">
            <label class="form-label"><i class="fas fa-user-tag me-2"></i>Pilih Role</label>
            <select name="role" class="form-select" required>
                <option value="">-- Pilih Role --</option>
                <option value="admin">Admin</option>
                <option value="petugas">Petugas</option>
                <option value="user">User</option>
            </select>
        </div>

        {{-- PASSWORD --}}
        <div class="mb-3">
            <label class="form-label"><i class="fas fa-lock me-2"></i>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        {{-- CONFIRM --}}
        <div class="mb-4">
            <label class="form-label"><i class="fas fa-lock me-2"></i>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
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
