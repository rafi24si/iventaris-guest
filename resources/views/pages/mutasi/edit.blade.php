@extends('layouts.guest.app')

@section('content')
<section class="pt-120 pb-80">
    <div class="container-custom">

        {{-- HEADER --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-center mb-50">
                    <h2>Edit Mutasi Aset</h2>
                    <p>Perbarui informasi mutasi aset <strong>{{ $mutasi->aset->nama_aset }}</strong>.</p>
                </div>
            </div>
        </div>

        {{-- MAIN CARD --}}
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12">
                <div class="card shadow-lg border-0 rounded-3">

                    {{-- CARD HEADER --}}
                    <div class="card-header bg-warning text-white p-4 rounded-top-3">
                        <h4 class="card-title mb-0">
                            <i class="bi bi-pencil-square me-2"></i> Edit Mutasi Aset
                        </h4>
                    </div>

                    <div class="card-body p-4 p-lg-5">

                        {{-- ERROR MESSAGE --}}
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show">
                                <h4 class="alert-heading">
                                    <i class="bi bi-exclamation-triangle-fill me-2"></i> Validasi Gagal!
                                </h4>
                                <ul class="mb-0">
                                    @foreach($errors->all() as $err)
                                        <li>{{ $err }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        {{-- FORM --}}
                        <form action="{{ route('mutasi.update', $mutasi->mutasi_id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">

                                {{-- LEFT SIDE --}}
                                <div class="col-md-6">
                                    <h5 class="mb-3 text-primary border-bottom pb-2">Informasi Aset</h5>

                                    {{-- PILIH ASET --}}
                                    <div class="mb-3">
                                        <label class="form-label">
                                            <i class="bi bi-box-seam me-2"></i>Pilih Aset
                                        </label>
                                        <select name="aset_id" class="form-select" required>
                                            @foreach($aset as $a)
                                                <option value="{{ $a->aset_id }}"
                                                    {{ old('aset_id', $mutasi->aset_id) == $a->aset_id ? 'selected' : '' }}>
                                                    {{ $a->nama_aset }} ({{ $a->kode_aset }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- TANGGAL --}}
                                    <div class="mb-3">
                                        <label class="form-label">
                                            <i class="bi bi-calendar-date-fill me-2"></i>Tanggal Mutasi
                                        </label>
                                        <input type="date" name="tanggal" class="form-control"
                                               value="{{ old('tanggal', $mutasi->tanggal) }}" required>
                                    </div>

                                </div>

                                {{-- RIGHT SIDE --}}
                                <div class="col-md-6">
                                    <h5 class="mb-3 text-primary border-bottom pb-2">Detail Mutasi</h5>

                                    {{-- JENIS MUTASI --}}
                                    <div class="mb-3">
                                        <label class="form-label">
                                            <i class="bi bi-shuffle me-2"></i>Jenis Mutasi
                                        </label>
                                        <select name="jenis_mutasi" class="form-select" required>
                                            <option value="Pemindahan"
                                                {{ old('jenis_mutasi', $mutasi->jenis_mutasi) == 'Pemindahan' ? 'selected' : '' }}>
                                                Pemindahan
                                            </option>
                                            <option value="Penghapusan"
                                                {{ old('jenis_mutasi', $mutasi->jenis_mutasi) == 'Penghapusan' ? 'selected' : '' }}>
                                                Penghapusan
                                            </option>
                                        </select>
                                    </div>

                                    {{-- KETERANGAN --}}
                                    <div class="mb-3">
                                        <label class="form-label">
                                            <i class="bi bi-card-text me-2"></i>Keterangan
                                        </label>
                                        <textarea name="keterangan" class="form-control" rows="4">{{ old('keterangan', $mutasi->keterangan) }}</textarea>
                                    </div>

                                </div>
                            </div>

                            <hr class="mt-4">

                            {{-- BUTTON --}}
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('mutasi.index') }}" class="main-btn border-btn me-3">
                                    <i class="bi bi-arrow-left me-1"></i> Batal
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
@endsection
