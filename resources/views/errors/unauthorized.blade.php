@extends('layouts.guest.app')

@section('content')
<div class="container text-center" style="padding: 100px 20px;">

    <h1 class="text-danger">
        <i class="bi bi-shield-lock-fill"></i> Akses Ditolak
    </h1>

    <p class="mt-3 fs-5">
        {{ $message ?? 'Anda tidak memiliki izin untuk membuka halaman ini.' }}
    </p>

    <a href="{{ route('dashboard') }}" class="btn btn-primary mt-4">
        Kembali ke Dashboard
    </a>

</div>
@endsection
