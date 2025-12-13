@extends('layouts.guest.app')

@section('content')
    <!-- main content start -->
    <section id="form-warga" class="cta-section pt-130 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center mb-50">
                        <h2 class="mb-20">Tambah Data Warga</h2>
                        <p class="mb-30">Isi form berikut untuk menambahkan data warga baru</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-sm">
                        <div class="card-body p-5">
                            <form action="{{ route('warga.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="no_ktp" class="form-label">No KTP *</label>
                                            <input type="text" id="no_ktp" name="no_ktp" class="form-control"
                                                value="{{ old('no_ktp') }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama Lengkap *</label>
                                            <input type="text" id="nama" name="nama" class="form-control"
                                                value="{{ old('nama') }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin *</label>
                                            <select id="jenis_kelamin" name="jenis_kelamin" class="form-select" required>
                                                <option value="">-- Pilih --</option>
                                                <option value="Laki-laki"
                                                    {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                                                </option>
                                                <option value="Perempuan"
                                                    {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="agama" class="form-label">Agama *</label>
                                            <select id="agama" name="agama" class="form-select" required>
                                                <option value="">-- Pilih --</option>
                                                <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam
                                                </option>
                                                <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>
                                                    Kristen</option>
                                                <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>
                                                    Katolik</option>
                                                <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu
                                                </option>
                                                <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>
                                                    Buddha</option>
                                                <option value="Konghucu"
                                                    {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                            <input type="text" id="pekerjaan" name="pekerjaan" class="form-control"
                                                value="{{ old('pekerjaan') }}">
                                        </div>

                                        <div class="mb-3">
                                            <label for="telp" class="form-label">No Telepon</label>
                                            <input type="text" id="telp" name="telp" class="form-control"
                                                value="{{ old('telp') }}">
                                        </div>

                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" id="email" name="email" class="form-control"
                                                value="{{ old('email') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('warga.index') }}" class="main-btn border-btn me-3">
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
    <!--main content end -->
@endsection
