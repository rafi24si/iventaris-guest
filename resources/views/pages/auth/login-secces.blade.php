<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Berhasil - Sistem Inventaris</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #6cddfc 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            font-family: Arial, sans-serif;
        }
        .success-container {
            background: white;
            border-radius: 15px;
            padding: 3rem;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 500px;
            width: 100%;
        }
        .success-icon {
            font-size: 4rem;
            color: #28a745;
            margin-bottom: 1.5rem;
        }
        .btn-back {
            background: #2c3e50;
            border: none;
            padding: 10px 30px;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="success-container">
                    <div class="success-icon">

                    </div>

                    <h2 class="text-success mb-3">Login Berhasil!</h2>

                    @if(isset($success))
                        <div class="alert alert-success" role="alert">
                            {{ $success }}
                        </div>
                    @endif

                    <p class="text-muted mb-4">
                        Selamat! Anda berhasil login ke sistem inventaris.
                    </p>

                    <a href="/dashboard" class="btn btn-back btn-primary">Masuk ke Halaman Iventaris dan Aset</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
