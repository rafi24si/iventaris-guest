@extends('layouts.guest.app')

@section('content')
<!-- main content start -->
<section id="form-user" class="cta-section pt-130 pb-100">
    <div class="container">

        {{-- JUDUL --}}
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center mb-50">
                    <h2 class="mb-20">Tambah Data User</h2>
                    <p class="mb-30">Isi form berikut untuk menambahkan user baru</p>
                </div>
            </div>
        </div>

        {{-- FORM --}}
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-body p-5">

                        {{-- ERROR --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('user.store') }}"
                              method="POST"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                {{-- KOLOM KIRI --}}
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Lengkap *</label>
                                        <input type="text" name="name"
                                            class="form-control"
                                            value="{{ old('name') }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Email *</label>
                                        <input type="email" name="email"
                                            class="form-control"
                                            value="{{ old('email') }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Role *</label>
                                        <select name="role" class="form-select" required>
                                            <option value="">-- Pilih Role --</option>
                                            <option value="admin" {{ old('role')=='admin'?'selected':'' }}>Admin</option>
                                            <option value="petugas" {{ old('role')=='petugas'?'selected':'' }}>Petugas</option>
                                            <option value="user" {{ old('role')=='user'?'selected':'' }}>User</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- KOLOM KANAN --}}
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Password *</label>
                                        <input type="password"
                                            name="password"
                                            class="form-control"
                                            required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Konfirmasi Password *</label>
                                        <input type="password"
                                            name="password_confirmation"
                                            class="form-control"
                                            required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Foto Profil</label>
                                        <input type="file"
                                            name="profile_photo"
                                            class="form-control"
                                            accept="image/*">
                                        <small class="text-muted">
                                            JPG / PNG (Max 2MB)
                                        </small>
                                    </div>
                                </div>
                            </div>

                            {{-- BUTTON --}}
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('user.index') }}" class="main-btn border-btn me-3">
                                    <i class="bi bi-arrow-left me-1"></i> Kembali
                                </a>
                                <button type="submit" class="main-btn btn-hover">
                                    <i class="bi bi-save me-1"></i> Simpan User
                                </button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- main content end -->
@endsection
