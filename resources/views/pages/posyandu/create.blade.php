@extends('layouts.guest.app')

@section('content')

{{-- HEADER --}}
<section class="pt-80 pb-60"
    style="background: linear-gradient(135deg,#1e8449,#27ae60);">
    <div class="container text-white">
        <h2 class="fw-bold mb-2">Tambah Posyandu</h2>
        <p class="mb-0">Input data Posyandu Desa</p>
    </div>
</section>

{{-- FORM --}}
<section class="pt-60 pb-100" style="background:#f0fdf4;">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">

                        {{-- ALERT ERROR --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('posyandu.store') }}"
                              method="POST"
                              enctype="multipart/form-data">
                            @csrf

                            {{-- NAMA --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Nama Posyandu
                                </label>
                                <input type="text" name="nama"
                                       class="form-control"
                                       value="{{ old('nama') }}"
                                       placeholder="Contoh: Posyandu Melati"
                                       required>
                            </div>

                            {{-- ALAMAT --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Alamat Lengkap
                                </label>
                                <textarea name="alamat"
                                          class="form-control"
                                          rows="3"
                                          placeholder="Alamat Posyandu"
                                          required>{{ old('alamat') }}</textarea>
                            </div>

                            {{-- RT RW --}}
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label class="form-label fw-semibold">RT</label>
                                    <input type="text" name="rt"
                                           class="form-control"
                                           value="{{ old('rt') }}"
                                           required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label fw-semibold">RW</label>
                                    <input type="text" name="rw"
                                           class="form-control"
                                           value="{{ old('rw') }}"
                                           required>
                                </div>
                            </div>

                            {{-- KONTAK --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Kontak (Opsional)
                                </label>
                                <input type="text" name="kontak"
                                       class="form-control"
                                       value="{{ old('kontak') }}"
                                       placeholder="No. HP / Telepon">
                            </div>

                            {{-- FOTO --}}
                            <div class="mb-4">
                                <label class="form-label fw-semibold">
                                    Foto Posyandu
                                </label>
                                <input type="file" name="foto"
                                       class="form-control">
                                <small class="text-muted">
                                    JPG / PNG • Maks 2MB
                                </small>
                            </div>

                            {{-- ACTION --}}
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('posyandu.index') }}"
                                   class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i> Kembali
                                </a>

                                <button type="submit"
                                        class="btn btn-success px-4">
                                    <i class="fas fa-save me-1"></i> Simpan
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>
</section>

@endsection
