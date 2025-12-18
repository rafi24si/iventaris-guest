@extends('layouts.guest.app')

@section('content')

{{-- HEADER --}}
<section class="pt-80 pb-60"
    style="background: linear-gradient(135deg,#1e8449,#27ae60);">
    <div class="container text-white">
        <h2 class="fw-bold mb-2">
            <i class="fas fa-calendar-alt me-2"></i>
            Detail Jadwal Posyandu
        </h2>
        <p class="mb-0">Informasi lengkap kegiatan Posyandu</p>
    </div>
</section>

{{-- CONTENT --}}
<section class="pt-60 pb-100" style="background:#f0fdf4;">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-lg-9">

                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                    {{-- POSTER --}}
                    @php
                        $poster = $jadwal->media->first();
                    @endphp

                    <div class="bg-light text-center p-4">
                        <img
                            src="{{ $poster
                                    ? asset('storage/jadwal_posyandu/'.$poster->file_name)
                                    : 'https://via.placeholder.com/800x450?text=Poster+Jadwal+Posyandu' }}"
                            class="img-fluid rounded shadow-sm"
                            style="max-height:400px;object-fit:cover;"
                            alt="Poster Jadwal">
                    </div>

                    {{-- BODY --}}
                    <div class="card-body p-4">

                        {{-- POSYANDU --}}
                        <span class="badge bg-success mb-3">
                            <i class="fas fa-clinic-medical me-1"></i>
                            {{ $jadwal->posyandu->nama }}
                        </span>

                        {{-- TEMA --}}
                        <h3 class="fw-bold text-success mb-3">
                            {{ $jadwal->tema }}
                        </h3>

                        {{-- INFO GRID --}}
                        <div class="row mb-4">

                            <div class="col-md-6 mb-3">
                                <div class="info-box">
                                    <i class="fas fa-calendar-day text-success"></i>
                                    <div>
                                        <small class="text-muted">Tanggal Kegiatan</small><br>
                                        <strong>{{ $jadwal->tanggal->format('d F Y') }}</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="info-box">
                                    <i class="fas fa-map-marker-alt text-success"></i>
                                    <div>
                                        <small class="text-muted">Lokasi Posyandu</small><br>
                                        <strong>{{ $jadwal->posyandu->alamat ?? '-' }}</strong>
                                    </div>
                                </div>
                            </div>

                        </div>

                        {{-- KETERANGAN --}}
                        <div class="mb-4">
                            <h5 class="fw-semibold mb-2">
                                <i class="fas fa-align-left me-1 text-success"></i>
                                Keterangan
                            </h5>
                            <p class="mb-0 text-muted">
                                {{ $jadwal->keterangan ?: 'Tidak ada keterangan tambahan.' }}
                            </p>
                        </div>

                        {{-- ACTION --}}
                        <div class="d-flex gap-2">
                            <a href="{{ route('jadwal-posyandu.edit', $jadwal->jadwal_id) }}"
                               class="btn btn-success">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>

                            <a href="{{ route('jadwal-posyandu.index') }}"
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
</style>

@endsection
