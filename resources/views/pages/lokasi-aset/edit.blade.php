@extends('layouts.guest.app')

@section('content')
    <!-- main content start -->
    <section id="form-lokasi-aset" class="cta-section pt-130 pb-100">
        <div class="container">

            {{-- JUDUL --}}
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center mb-50">
                        <h2 class="mb-20">Edit Lokasi Aset</h2>
                        <p class="mb-30">
                            Perbarui lokasi aset
                            <strong>{{ $lokasiAset->aset->nama_aset }}</strong>
                        </p>
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

                            <form action="{{ route('lokasi-aset.update', $lokasiAset->lokasi_id) }}"
                                  method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">

                                    {{-- KOLOM KIRI --}}
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Pilih Aset *</label>
                                            <select name="aset_id" class="form-select" required>
                                                <option value="">-- Pilih Aset --</option>
                                                @foreach ($aset as $a)
                                                    <option value="{{ $a->aset_id }}"
                                                        {{ old('aset_id', $lokasiAset->aset_id) == $a->aset_id ? 'selected' : '' }}>
                                                        {{ $a->nama_aset }} ({{ $a->kode_aset }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Lokasi (Deskripsi) *</label>
                                            <input type="text" name="lokasi_text"
                                                class="form-control"
                                                value="{{ old('lokasi_text', $lokasiAset->lokasi_text) }}"
                                                required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Keterangan</label>
                                            <textarea name="keterangan"
                                                class="form-control"
                                                rows="3">{{ old('keterangan', $lokasiAset->keterangan) }}</textarea>
                                        </div>
                                    </div>

                                    {{-- KOLOM KANAN --}}
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">RT *</label>
                                            <input type="number" name="rt"
                                                class="form-control"
                                                value="{{ old('rt', $lokasiAset->rt) }}"
                                                required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">RW *</label>
                                            <input type="number" name="rw"
                                                class="form-control"
                                                value="{{ old('rw', $lokasiAset->rw) }}"
                                                required>
                                        </div>
                                    </div>
                                </div>

                                {{-- FOTO --}}
                                <hr class="my-4">

                                <div class="mb-3">
                                    <label class="form-label">Foto / Denah Lokasi (Opsional)</label>

                                    {{-- FOTO LAMA --}}
                                    @if ($lokasiAset->media->first())
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $lokasiAset->media->first()->file_name) }}"
                                                 style="height:150px; border-radius:10px; object-fit:cover;">
                                        </div>
                                    @else
                                        <p class="text-muted">Belum ada foto.</p>
                                    @endif

                                    <input type="file" name="media_file" class="form-control" accept="image/*">

                                    <small class="text-muted">
                                        JPG / PNG (Max 2MB)
                                    </small>

                                    {{-- PREVIEW FOTO BARU --}}
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
                                    <a href="{{ route('lokasi-aset.index') }}" class="main-btn border-btn me-3">
                                        <i class="bi bi-arrow-left me-1"></i> Kembali
                                    </a>
                                    <button type="submit" class="main-btn btn-hover">
                                        <i class="bi bi-save me-1"></i> Simpan Perubahan
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
