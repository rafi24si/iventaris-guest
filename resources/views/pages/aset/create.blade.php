@extends('layouts.guest.app')

@section('content')
    <!-- main content start -->
    <section id="form-aset" class="cta-section pt-130 pb-100">
        <div class="container">

            {{-- JUDUL --}}
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center mb-50">
                        <h2 class="mb-20">Tambah Data Aset</h2>
                        <p class="mb-30">Isi form berikut untuk menambahkan data aset baru</p>
                    </div>
                </div>
            </div>

            {{-- FORM --}}
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card shadow-sm">
                        <div class="card-body p-5">

                            {{-- ERROR --}}
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <form action="{{ route('aset.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">

                                    {{-- KOLOM KIRI --}}
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Kode Aset *</label>
                                            <input type="text" name="kode_aset" class="form-control"
                                                value="{{ old('kode_aset') }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Nama Aset *</label>
                                            <input type="text" name="nama_aset" class="form-control"
                                                value="{{ old('nama_aset') }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Kategori *</label>
                                            <select name="kategori_id" class="form-select" required>
                                                <option value="">-- Pilih Kategori --</option>
                                                @foreach ($kategoriAset as $kategori)
                                                    <option value="{{ $kategori->kategori_id }}"
                                                        {{ old('kategori_id') == $kategori->kategori_id ? 'selected' : '' }}>
                                                        {{ $kategori->nama }} ({{ $kategori->kode }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    {{-- KOLOM KANAN --}}
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Tanggal Perolehan *</label>
                                            <input type="date" name="tgl_perolehan" class="form-control"
                                                value="{{ old('tgl_perolehan') }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Nilai Perolehan (Rp) *</label>
                                            <input type="number" name="nilai_perolehan" class="form-control"
                                                value="{{ old('nilai_perolehan') }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Kondisi *</label>
                                            <select name="kondisi" class="form-select" required>
                                                <option value="">-- Pilih Kondisi --</option>
                                                <option value="Baik" {{ old('kondisi') == 'Baik' ? 'selected' : '' }}>Baik
                                                </option>
                                                <option value="Rusak Ringan"
                                                    {{ old('kondisi') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan
                                                </option>
                                                <option value="Rusak Berat"
                                                    {{ old('kondisi') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                {{-- FOTO ASET --}}
                                <hr class="my-4">

                                <div class="mb-3">
                                    <label class="form-label">Foto Aset (Opsional)</label>
                                    <input type="file" name="media_file" class="form-control" accept="image/*">

                                    <small class="text-muted">
                                        JPG / PNG (Max 2MB)
                                    </small>

                                    {{-- PREVIEW --}}
                                    <img id="previewImg" class="mt-3 d-none"
                                        style="height:150px; border-radius:10px; object-fit:cover;">
                                </div>

                                {{-- SCRIPT PREVIEW --}}
                                <script>
                                    document.querySelector('input[name="media_file"]').addEventListener('change', function(e) {
                                        let img = document.getElementById('previewImg');
                                        img.src = URL.createObjectURL(e.target.files[0]);
                                        img.classList.remove('d-none');
                                    });
                                </script>

                                {{-- BUTTON --}}
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('aset.index') }}" class="main-btn border-btn me-3">
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
    <!-- main content end -->
@endsection
