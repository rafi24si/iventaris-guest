@extends('layouts.guest.app')

@section('content')
    <!-- main content start -->
    <section id="form-pemeliharaan" class="cta-section pt-130 pb-100">
        <div class="container">

            {{-- JUDUL --}}
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center mb-50">
                        <h2 class="mb-20">Edit Data Pemeliharaan</h2>
                        <p class="mb-30">
                            Perbarui data pemeliharaan aset
                            <strong>{{ $pemeliharaan->aset->nama_aset }}</strong>
                        </p>
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

                            <form action="{{ route('pemeliharaan.update', $pemeliharaan->pemeliharaan_id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">

                                    {{-- KOLOM KIRI --}}
                                    <div class="col-md-6">

                                        <div class="mb-3">
                                            <label class="form-label">Aset *</label>
                                            <select name="aset_id" class="form-select" required>
                                                @foreach ($aset as $a)
                                                    <option value="{{ $a->aset_id }}"
                                                        {{ old('aset_id', $pemeliharaan->aset_id) == $a->aset_id ? 'selected' : '' }}>
                                                        {{ $a->nama_aset }} ({{ $a->kode_aset }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Tanggal Pemeliharaan *</label>
                                            <input type="date" name="tanggal" class="form-control"
                                                value="{{ old('tanggal', $pemeliharaan->tanggal) }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Tindakan *</label>
                                            <textarea name="tindakan" rows="3" class="form-control" required>{{ old('tindakan', $pemeliharaan->tindakan) }}</textarea>
                                        </div>

                                    </div>

                                    {{-- KOLOM KANAN --}}
                                    <div class="col-md-6">

                                        <div class="mb-3">
                                            <label class="form-label">Biaya (Rp) *</label>
                                            <input type="number" name="biaya" class="form-control"
                                                value="{{ old('biaya', $pemeliharaan->biaya) }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Pelaksana</label>
                                            <input type="text" name="pelaksana" class="form-control"
                                                value="{{ old('pelaksana', $pemeliharaan->pelaksana) }}">
                                        </div>

                                        {{-- FOTO --}}
                                        <div class="mb-3">
                                            <label class="form-label">Bukti Foto</label>
                                            <input type="file" name="media_file" class="form-control" accept="image/*">

                                            @php $media = $pemeliharaan->media->first(); @endphp

                                            <div class="mt-2">
                                                @if ($media)
                                                    <img src="{{ asset('storage/' . $media->file_name) }}"
                                                        class="img-thumbnail"
                                                        style="height:150px;width:100%;object-fit:cover;border-radius:10px;">
                                                @else
                                                    <img src="{{ asset('assets-admin/images/placeholder-aset.png') }}"
                                                        class="img-thumbnail"
                                                        style="height:150px;width:100%;object-fit:cover;border-radius:10px;">
                                                @endif
                                            </div>

                                            <small class="text-muted d-block mt-1">
                                                Kosongkan jika tidak ingin mengganti foto
                                            </small>
                                        </div>

                                    </div>
                                </div>

                                {{-- BUTTON --}}
                                <div class="d-flex justify-content-end mt-4">
                                    <a href="{{ route('pemeliharaan.index') }}" class="main-btn border-btn me-3">
                                        <i class="bi bi-arrow-left me-1"></i> Kembali
                                    </a>
                                    <button type="submit" class="main-btn btn-hover">
                                        <i class="bi bi-check-circle me-1"></i> Update Pemeliharaan
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
