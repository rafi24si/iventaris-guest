@extends('layouts.guest.app')

@section('content')
<section class="pt-120 pb-80">
    <div class="container">

        <div class="section-title text-center mb-50">
            <h2>Profil Saya</h2>
            <p>Kelola informasi akun dan keamanan Anda.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">

                {{-- ALERT --}}
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card shadow-lg p-4">

                    {{-- FOTO PROFIL --}}
                    <div class="text-center mb-3">

                        <img src="{{ $user->profile_photo
                                ? asset('storage/' . $user->profile_photo)
                                : asset('assets-guest/images/default-avatar.png') }}"
                             class="rounded-circle mb-3"
                             width="120" height="120"
                             style="object-fit: cover;">

                        <h4>{{ $user->name }}</h4>
                        <p class="text-muted mb-1">{{ $user->email }}</p>
                        <p class="badge bg-primary">{{ strtoupper($user->role) }}</p>
                    </div>

                    <hr>

                    {{-- FORM UPDATE PROFILE --}}
                    <h5 class="mb-3">Update Informasi Profil</h5>

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control" name="name"
                                   value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email"
                                   value="{{ old('email', $user->email) }}" required>
                        </div>

                        <div class="mb-3">
                            <label>Foto Profil</label>
                            <input type="file" class="form-control" name="profile_photo" accept="image/*">
                            <small class="text-muted">Opsional, max 2MB</small>
                        </div>

                        <button class="btn btn-primary w-100">Simpan Perubahan</button>
                    </form>

                    <hr>

                    {{-- FORM UPDATE PASSWORD --}}
                    <h5 class="mb-3">Ganti Password</h5>

                    <form action="{{ route('profile.updatePassword') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label>Password Lama</label>
                            <input type="password" class="form-control" name="old_password" required>
                        </div>

                        <div class="mb-3">
                            <label>Password Baru</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>

                        <div class="mb-3">
                            <label>Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" name="password_confirmation" required>
                        </div>

                        <button class="btn btn-warning w-100">Update Password</button>
                    </form>

                </div>

            </div>
        </div>

    </div>
</section>
@endsection
