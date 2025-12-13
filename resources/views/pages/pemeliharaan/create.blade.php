@extends('layouts.guest.app')

@section('content')
<!-- main content start -->
<section id="form-pemeliharaan" class="cta-section pt-130 pb-100">
    <div class="container">

        {{-- JUDUL --}}
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center mb-50">
                    <h2 class="mb-20">Tambah Data Pemeliharaan</h2>
                    <p class="mb-30">Isi form berikut untuk mencatat pemeliharaan aset</p>
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
                            <div class="alert alert-danger alert-dismissible fade show">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('pemeliharaan.store') }}"
                              method="POST"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="row">

                                {{-- KOLOM KIRI --}}
                                <div class="col-md-6">

                                    <div class="mb-3">
                                        <label class="form-label">Aset *</label>
                                        <select name="aset_id" class="form-select" required>
                                            <option value="">-- Pilih Aset --</option>
                                            @foreach ($aset as $a)
                                                <option value="{{ $a->aset_id }}"
                                                    {{ old('aset_id') == $a->aset_id ? 'selected' : '' }}>
                                                    {{ $a->nama_aset }} ({{ $a->kode_aset }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Pemeliharaan *</label>
                                        <input type="date"
                                               name="tanggal"
                                               class="form-control"
                                               value="{{ old('tanggal') }}"
                                               required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Tindakan *</label>
                                        <textarea name="tindakan"
                                                  rows="3"
                                                  class="form-control"
                                                  required>{{ old('tindakan') }}</textarea>
                                    </div>

                                </div>

                                {{-- KOLOM KANAN --}}
                                <div class="col-md-6">

                                    <div class="mb-3">
                                        <label class="form-label">Biaya (Rp) *</label>
                                        <input type="number"
                                               name="biaya"
                                               class="form-control"
                                               value="{{ old('biaya') }}"
                                               required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Pelaksana</label>
                                        <input type="text"
                                               name="pelaksana"
                                               class="form-control"
                                               value="{{ old('pelaksana') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Bukti Foto</label>
                                        <input type="file"
                                               name="media_file"
                                               class="form-control"
                                               accept="image/*">
                                        <small class="text-muted">
                                            JPG / PNG (Max 2MB)
                                        </small>

                                        {{-- PREVIEW --}}
                                        <img id="previewImg"
                                             class="mt-3 d-none"
                                             style="height:150px;border-radius:10px;object-fit:cover;">
                                    </div>

                                </div>
                            </div>

                            {{-- SCRIPT PREVIEW FOTO --}}
                            <script>
                                document.querySelector('input[name="media_file"]').addEventListener('change', function(e) {
                                    const img = document.getElementById('previewImg');
                                    img.src = URL.createObjectURL(e.target.files[0]);
                                    img.classList.remove('d-none');
                                });
                            </script>

                            {{-- BUTTON --}}
                            <div class="d-flex justify-content-end mt-4">
                                <a href="{{ route('pemeliharaan.index') }}"
                                   class="main-btn border-btn me-3">
                                    <i class="bi bi-arrow-left me-1"></i> Kembali
                                </a>
                                <button type="submit" class="main-btn btn-hover">
                                    <i class="bi bi-save me-1"></i> Simpan Pemeliharaan
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
