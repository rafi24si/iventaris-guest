@extends('layouts.guest.app')

@section('content')

{{-- HEADER --}}
<section class="pt-80 pb-60"
    style="background:linear-gradient(135deg,#1e8449,#27ae60);">
    <div class="container text-white">
        <h2 class="fw-bold mb-2">
            <i class="fas fa-notes-medical me-2"></i>
            Detail Layanan Posyandu
        </h2>
        <p class="mb-0">Informasi lengkap pelayanan kesehatan warga</p>
    </div>
</section>

{{-- CONTENT --}}
<section class="pt-60 pb-100" style="background:#f0fdf4;">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-lg-9">

                <div class="card border-0 shadow-sm rounded-4">

                    <div class="card-body p-4">

                        {{-- BADGE POSYANDU --}}
                        <span class="badge bg-success mb-3">
                            <i class="fas fa-clinic-medical me-1"></i>
                            {{ $layanan->jadwal->posyandu->nama }}
                        </span>

                        {{-- NAMA WARGA --}}
                        <h3 class="fw-bold text-success mb-1">
                            <i class="fas fa-user me-2"></i>
                            {{ $layanan->warga->nama }}
                        </h3>

                        <p class="text-muted mb-4">
                            <i class="fas fa-id-card me-1"></i>
                            NIK: {{ $layanan->warga->no_ktp }}
                        </p>

                        {{-- INFO GRID --}}
                        <div class="row mb-4">

                            <div class="col-md-6 mb-3">
                                <div class="info-box">
                                    <i class="fas fa-calendar-day text-success"></i>
                                    <div>
                                        <small class="text-muted">Tanggal Posyandu</small><br>
                                        <strong>{{ $layanan->jadwal->tanggal->format('d F Y') }}</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="info-box">
                                    <i class="fas fa-tag text-success"></i>
                                    <div>
                                        <small class="text-muted">Tema Kegiatan</small><br>
                                        <strong>{{ $layanan->jadwal->tema }}</strong>
                                    </div>
                                </div>
                            </div>

                        </div>

                        {{-- HASIL LAYANAN --}}
                        <h5 class="fw-semibold mb-3">
                            <i class="fas fa-heartbeat me-1 text-success"></i>
                            Hasil Pemeriksaan
                        </h5>

                        <div class="row mb-4">

                            <div class="col-md-3 mb-3">
                                <div class="result-box">
                                    <i class="fas fa-weight text-primary"></i>
                                    <small>Berat</small>
                                    <strong>{{ $layanan->berat ?? '-' }} kg</strong>
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <div class="result-box">
                                    <i class="fas fa-ruler-vertical text-info"></i>
                                    <small>Tinggi</small>
                                    <strong>{{ $layanan->tinggi ?? '-' }} cm</strong>
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <div class="result-box">
                                    <i class="fas fa-capsules text-warning"></i>
                                    <small>Vitamin</small>
                                    <strong>{{ $layanan->vitamin ?? '-' }}</strong>
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <div class="result-box">
                                    <i class="fas fa-comments text-success"></i>
                                    <small>Konseling</small>
                                    <strong>{{ $layanan->konseling ? 'Ada' : 'Tidak' }}</strong>
                                </div>
                            </div>

                        </div>

                        {{-- KONSELING --}}
                        <div class="mb-4">
                            <h5 class="fw-semibold mb-2">
                                <i class="fas fa-comment-dots me-1 text-success"></i>
                                Catatan Konseling
                            </h5>
                            <p class="mb-0 text-muted">
                                {{ $layanan->konseling ?: 'Tidak ada catatan konseling.' }}
                            </p>
                        </div>

                        {{-- ACTION --}}
                        <div class="d-flex gap-2">
                            <a href="{{ route('layanan-posyandu.edit', $layanan->layanan_id) }}"
                               class="btn btn-success">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>

                            <a href="{{ route('layanan-posyandu.index') }}"
                               class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>
</section>

{{-- STYLE --}}
<style>
.info-box {
    display: flex;
    gap: 12px;
    align-items: flex-start;
    font-size: 14px;
}
.result-box {
    background: #fff;
    border-radius: 12px;
    padding: 16px;
    text-align: center;
    box-shadow: 0 4px 10px rgba(0,0,0,.08);
}
.result-box i {
    font-size: 22px;
    margin-bottom: 6px;
}
.result-box small {
    display: block;
    color: #777;
}
</style>

@endsection
