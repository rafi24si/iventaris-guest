@extends('layouts.guest.app')

@section('content')
<!-- main content start -->
<section id="form-mutasi" class="cta-section pt-130 pb-100">
    <div class="container">

        {{-- JUDUL --}}
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center mb-50">
                    <h2 class="mb-20">Tambah Data Mutasi Aset</h2>
                    <p class="mb-30">
                        Catat perubahan status, pemindahan, atau penghapusan aset
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

                        <form action="{{ route('mutasi.store') }}" method="POST">
                            @csrf

                            <div class="row">

                                {{-- KOLOM KIRI --}}
                                <div class="col-md-6">

                                    {{-- ASET --}}
                                    <div class="mb-3">
                                        <label class="form-label">
                                            <i class="bi bi-box-seam me-1"></i> Aset *
                                        </label>
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

                                    {{-- TANGGAL --}}
                                    <div class="mb-3">
                                        <label class="form-label">
                                            <i class="bi bi-calendar-date me-1"></i> Tanggal Mutasi *
                                        </label>
                                        <input type="date"
                                               name="tanggal"
                                               class="form-control"
                                               value="{{ old('tanggal') }}"
                                               required>
                                    </div>

                                </div>

                                {{-- KOLOM KANAN --}}
                                <div class="col-md-6">

                                    {{-- JENIS MUTASI --}}
                                    <div class="mb-3">
                                        <label class="form-label">
                                            <i class="bi bi-shuffle me-1"></i> Jenis Mutasi *
                                        </label>
                                        <select name="jenis_mutasi" class="form-select" required>
                                            <option value="">-- Pilih Jenis Mutasi --</option>
                                            <option value="Pemindahan"
                                                {{ old('jenis_mutasi') == 'Pemindahan' ? 'selected' : '' }}>
                                                Pemindahan
                                            </option>
                                            <option value="Penghapusan"
                                                {{ old('jenis_mutasi') == 'Penghapusan' ? 'selected' : '' }}>
                                                Penghapusan
                                            </option>
                                        </select>
                                    </div>

                                    {{-- KETERANGAN --}}
                                    <div class="mb-3">
                                        <label class="form-label">
                                            <i class="bi bi-card-text me-1"></i> Keterangan
                                        </label>
                                        <textarea name="keterangan"
                                                  class="form-control"
                                                  rows="4">{{ old('keterangan') }}</textarea>
                                    </div>

                                </div>
                            </div>

                            {{-- BUTTON --}}
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('mutasi.index') }}" class="main-btn border-btn me-3">
                                    <i class="bi bi-arrow-left me-1"></i> Kembali
                                </a>
                                <button type="submit" class="main-btn btn-hover">
                                    <i class="bi bi-save me-1"></i> Simpan Mutasi
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
