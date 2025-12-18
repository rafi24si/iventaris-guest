@extends('layouts.guest.app')

@section('content')

{{-- HEADER --}}
<section class="pt-80 pb-60"
    style="background: linear-gradient(135deg,#1e8449,#27ae60);">
    <div class="container text-white">
        <h2 class="fw-bold mb-2">Edit Posyandu</h2>
        <p class="mb-0">Perbarui data Posyandu Desa</p>
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

                        <form action="{{ route('posyandu.update', $posyandu->posyandu_id) }}"
                              method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- NAMA --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Nama Posyandu
                                </label>
                                <input type="text" name="nama"
                                       class="form-control"
                                       value="{{ old('nama', $posyandu->nama) }}"
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
                                          required>{{ old('alamat', $posyandu->alamat) }}</textarea>
                            </div>

                            {{-- RT RW --}}
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label class="form-label fw-semibold">RT</label>
                                    <input type="text" name="rt"
                                           class="form-control"
                                           value="{{ old('rt', $posyandu->rt) }}"
                                           required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label fw-semibold">RW</label>
                                    <input type="text" name="rw"
                                           class="form-control"
                                           value="{{ old('rw', $posyandu->rw) }}"
                                           required>
                                </div>
                            </div>

                            {{-- KONTAK --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Kontak
                                </label>
                                <input type="text" name="kontak"
                                       class="form-control"
                                       value="{{ old('kontak', $posyandu->kontak) }}">
                            </div>

                            {{-- FOTO LAMA --}}
                            @php
                                $foto = $posyandu->fotoUtama();
                            @endphp

                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Foto Posyandu Saat Ini
                                </label>

                                <div class="mb-2">
                                    <img
                                        src="{{ $foto
                                            ? asset('storage/'.$foto->file_url)
                                            : 'https://via.placeholder.com/400x250?text=Posyandu' }}"
                                        class="img-fluid rounded shadow-sm"
                                        style="max-height:250px;object-fit:cover;">
                                </div>

                                <small class="text-muted">
                                    Upload foto baru jika ingin mengganti
                                </small>
                            </div>

                            {{-- FOTO BARU --}}
                            <div class="mb-4">
                                <label class="form-label fw-semibold">
                                    Ganti Foto Posyandu
                                </label>
                                <input type="file" name="foto"
                                       class="form-control">
                            </div>

                            {{-- ACTION --}}
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('posyandu.index') }}"
                                   class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i> Kembali
                                </a>

                                <button type="submit"
                                        class="btn btn-success px-4">
                                    <i class="fas fa-save me-1"></i> Update
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
