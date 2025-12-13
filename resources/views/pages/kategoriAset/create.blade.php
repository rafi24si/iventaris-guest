@extends('layouts.guest.app')

@section('content')
    <!-- Main Content start -->
    <section class="pt-120 pb-80">
        <div class="container-custom">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center mb-50">
                        <h2>Tambah Kategori Aset</h2>
                        <p>Isi form berikut untuk menambah kategori aset baru</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card card-form">
                        <div class="card-body p-5">
                            <form action="{{ route('kategoriAset.store') }}" method="POST">
                                @csrf

                                <div class="mb-4">
                                    <label for="nama" class="form-label fw-bold">Nama Kategori</label>
                                    <input type="text"
                                        class="form-control form-control-lg @error('nama') is-invalid @enderror"
                                        id="nama" name="nama" value="{{ old('nama') }}"
                                        placeholder="Masukkan nama kategori" required>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="kode" class="form-label fw-bold">Kode Unik</label>
                                    <input type="text"
                                        class="form-control form-control-lg @error('kode') is-invalid @enderror"
                                        id="kode" name="kode" value="{{ old('kode') }}"
                                        placeholder="Masukkan kode unik (contoh: ELEK, KNDG, BNGN)" required>
                                    <div class="form-text">Kode harus unik dan tidak boleh sama dengan kategori lain</div>
                                    @error('kode')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="4"
                                        placeholder="Masukkan deskripsi kategori (opsional)">{{ old('deskripsi') }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-end">
                                <a href="{{ route('kategoriAset.index') }}" class="main-btn border-btn me-3">
                                    <i class="bi bi-arrow-left me-1"></i> Kembali
                                </a>
                                <button type="submit" class="main-btn btn-hover">
                                    <i class="bi bi-save me-1"></i> Simpan Aset
                                </button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Main Content end -->
@endsection
