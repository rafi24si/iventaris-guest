@extends('layouts.guest.app')

@section('content')

{{-- HEADER --}}
<section class="pt-80 pb-60"
    style="background:linear-gradient(135deg,#1e8449,#27ae60);">
    <div class="container text-white">
        <h2 class="fw-bold mb-2">
            <i class="fas fa-edit me-2"></i>
            Edit Layanan Posyandu
        </h2>
        <p class="mb-0">Perbarui data pelayanan kesehatan warga</p>
    </div>
</section>

{{-- CONTENT --}}
<section class="pt-60 pb-100" style="background:#f0fdf4;">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">

                        {{-- ERROR --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $err)
                                        <li>{{ $err }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST"
                              action="{{ route('layanan-posyandu.update', $layanan->layanan_id) }}">
                            @csrf
                            @method('PUT')

                            {{-- JADWAL (LOCKED) --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-calendar-alt me-1 text-success"></i>
                                    Jadwal Posyandu
                                </label>
                                <input type="text"
                                       class="form-control"
                                       value="{{ $layanan->jadwal->tanggal->format('d M Y') }} - {{ $layanan->jadwal->posyandu->nama }}"
                                       disabled>
                            </div>

                            {{-- WARGA (LOCKED) --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-user me-1 text-success"></i>
                                    Warga
                                </label>
                                <input type="text"
                                       class="form-control"
                                       value="{{ $layanan->warga->nama }} - {{ $layanan->warga->no_ktp }}"
                                       disabled>
                            </div>

                            {{-- BERAT --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-weight me-1 text-success"></i>
                                    Berat Badan (kg)
                                </label>
                                <input type="number"
                                       step="0.1"
                                       name="berat"
                                       class="form-control"
                                       value="{{ old('berat', $layanan->berat) }}">
                            </div>

                            {{-- TINGGI --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-ruler-vertical me-1 text-success"></i>
                                    Tinggi Badan (cm)
                                </label>
                                <input type="number"
                                       step="0.1"
                                       name="tinggi"
                                       class="form-control"
                                       value="{{ old('tinggi', $layanan->tinggi) }}">
                            </div>

                            {{-- VITAMIN --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-capsules me-1 text-success"></i>
                                    Vitamin
                                </label>
                                <input type="text"
                                       name="vitamin"
                                       class="form-control"
                                       value="{{ old('vitamin', $layanan->vitamin) }}">
                            </div>

                            {{-- KONSELING --}}
                            <div class="mb-4">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-comments me-1 text-success"></i>
                                    Konseling
                                </label>
                                <textarea name="konseling"
                                          class="form-control"
                                          rows="4">{{ old('konseling', $layanan->konseling) }}</textarea>
                            </div>

                            {{-- ACTION --}}
                            <div class="d-flex gap-2">
                                <button class="btn btn-success px-4">
                                    <i class="fas fa-save me-1"></i> Update
                                </button>

                                <a href="{{ route('layanan-posyandu.index') }}"
                                   class="btn btn-secondary px-4">
                                    <i class="fas fa-arrow-left me-1"></i> Kembali
                                </a>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>
</section>

@endsection
