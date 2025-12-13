@extends('layouts.guest.app')

@section('content')
    <!-- Main Content start -->
    <section class="pt-120 pb-80">
        <div class="container-custom">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center mb-50">
                        <h2>Edit Kategori Aset</h2>
                        <p>Ubah data kategori aset yang dipilih</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card card-form">
                        <div class="card-body p-5">
                            <form action="{{ route('kategoriAset.update', $kategoriAset->kategori_id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-4">
                                    <label for="nama" class="form-label fw-bold">Nama Kategori</label>
                                    <input type="text"
                                        class="form-control form-control-lg @error('nama') is-invalid @enderror"
                                        id="nama" name="nama" value="{{ old('nama', $kategoriAset->nama) }}"
                                        placeholder="Masukkan nama kategori" required>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="kode" class="form-label fw-bold">Kode Unik</label>
                                    <input type="text"
                                        class="form-control form-control-lg @error('kode') is-invalid @enderror"
                                        id="kode" name="kode" value="{{ old('kode', $kategoriAset->kode) }}"
                                        placeholder="Masukkan kode unik" required>
                                    @error('kode')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="4"
                                        placeholder="Masukkan deskripsi kategori">{{ old('deskripsi', $kategoriAset->deskripsi) }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                    <a href="{{ route('kategoriAset.index') }}" class="btn btn-secondary btn-sm">
                                        <i class="fas fa-arrow-left me-1"></i>Kembali
                                    </a>
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fas fa-save me-1"></i>Update Kategori
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Main Content start -->
@endsection
