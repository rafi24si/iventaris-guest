@extends('layouts.guest.app')

@section('content')

{{-- HEADER --}}
<section class="pt-80 pb-60"
    style="background: linear-gradient(135deg,#1e8449,#27ae60);">
    <div class="container text-white">
        <h2 class="fw-bold mb-2">
            <i class="fas fa-user-plus me-2"></i>
            Tambah Kader Posyandu
        </h2>
        <p class="mb-0">Form pendaftaran kader Posyandu Desa</p>
    </div>
</section>

{{-- FORM --}}
<section class="pt-60 pb-100" style="background:#f0fdf4;">
    <div class="container">

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 p-lg-5">

                {{-- ERROR --}}
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('kader-posyandu.store') }}">
                    @csrf

                    <div class="row g-3">

                        {{-- POSYANDU --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-clinic-medical me-1"></i>
                                Posyandu
                            </label>
                            <select name="posyandu_id" class="form-select" required>
                                <option value="">-- Pilih Posyandu --</option>
                                @foreach($posyandus as $posyandu)
                                    <option value="{{ $posyandu->posyandu_id }}"
                                        {{ old('posyandu_id') == $posyandu->posyandu_id ? 'selected' : '' }}>
                                        {{ $posyandu->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- WARGA --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-user me-1"></i>
                                Warga
                            </label>
                            <select name="warga_id" class="form-select" required>
                                <option value="">-- Pilih Warga --</option>
                                @foreach($wargas as $warga)
                                    <option value="{{ $warga->warga_id }}"
                                        {{ old('warga_id') == $warga->warga_id ? 'selected' : '' }}>
                                        {{ $warga->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- PERAN --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-id-badge me-1"></i>
                                Peran
                            </label>
                            <input type="text" name="peran"
                                   class="form-control"
                                   placeholder="Contoh: Ketua, Sekretaris, Kader Imunisasi"
                                   value="{{ old('peran') }}"
                                   required>
                        </div>

                        {{-- MULAI TUGAS --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-calendar-check me-1"></i>
                                Mulai Tugas
                            </label>
                            <input type="date" name="mulai_tugas"
                                   class="form-control"
                                   value="{{ old('mulai_tugas', date('Y-m-d')) }}"
                                   required>
                        </div>

                    </div>

                    {{-- ACTION --}}
                    <div class="mt-4 d-flex gap-2">
                        <button class="btn btn-success px-4">
                            <i class="fas fa-save me-1"></i> Simpan
                        </button>

                        <a href="{{ route('kader-posyandu.index') }}"
                           class="btn btn-secondary px-4">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                    </div>

                </form>

            </div>
        </div>

    </div>
</section>

@endsection
