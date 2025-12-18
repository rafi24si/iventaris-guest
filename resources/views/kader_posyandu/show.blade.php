@extends('layouts.guest.app')

@section('content')

{{-- HEADER --}}
<section class="pt-80 pb-60"
    style="background: linear-gradient(135deg,#1e8449,#27ae60);">
    <div class="container text-white">
        <h2 class="fw-bold mb-2">
            <i class="fas fa-user-nurse me-2"></i>
            Detail Kader Posyandu
        </h2>
        <p class="mb-0">Informasi lengkap data kader Posyandu</p>
    </div>
</section>

{{-- CONTENT --}}
<section class="pt-60 pb-100" style="background:#f0fdf4;">
    <div class="container">

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 p-lg-5">

                {{-- STATUS --}}
                <div class="mb-4">
                    @if(!$kader->akhir_tugas || $kader->akhir_tugas >= now())
                        <span class="badge bg-success fs-6">
                            <i class="fas fa-check-circle me-1"></i>
                            Aktif
                        </span>
                    @else
                        <span class="badge bg-secondary fs-6">
                            <i class="fas fa-times-circle me-1"></i>
                            Nonaktif
                        </span>
                    @endif
                </div>

                <div class="row g-4">

                    {{-- DATA WARGA --}}
                    <div class="col-md-6">
                        <h5 class="fw-bold text-success mb-3">
                            <i class="fas fa-user me-2"></i>
                            Data Warga
                        </h5>

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item bg-transparent">
                                <strong>Nama</strong><br>
                                {{ $kader->warga->nama }}
                            </li>
                            <li class="list-group-item bg-transparent">
                                <strong>No. KTP</strong><br>
                                {{ $kader->warga->no_ktp ?? '-' }}
                            </li>
                            <li class="list-group-item bg-transparent">
                                <strong>Kontak</strong><br>
                                {{ $kader->warga->telp ?? '-' }}
                            </li>
                        </ul>
                    </div>

                    {{-- DATA KADER --}}
                    <div class="col-md-6">
                        <h5 class="fw-bold text-success mb-3">
                            <i class="fas fa-id-badge me-2"></i>
                            Data Kader
                        </h5>

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item bg-transparent">
                                <strong>Peran</strong><br>
                                {{ $kader->peran }}
                            </li>
                            <li class="list-group-item bg-transparent">
                                <strong>Mulai Tugas</strong><br>
                                {{ $kader->mulai_tugas->format('d F Y') }}
                            </li>
                            <li class="list-group-item bg-transparent">
                                <strong>Akhir Tugas</strong><br>
                                {{ $kader->akhir_tugas
                                    ? $kader->akhir_tugas->format('d F Y')
                                    : 'Masih Bertugas' }}
                            </li>
                        </ul>
                    </div>

                    {{-- DATA POSYANDU --}}
                    <div class="col-12">
                        <h5 class="fw-bold text-success mb-3">
                            <i class="fas fa-clinic-medical me-2"></i>
                            Posyandu
                        </h5>

                        <div class="card border-0 bg-light">
                            <div class="card-body">
                                <p class="mb-1">
                                    <strong>Nama Posyandu:</strong>
                                    {{ $kader->posyandu->nama }}
                                </p>
                                <p class="mb-1">
                                    <strong>Alamat:</strong>
                                    {{ $kader->posyandu->alamat }}
                                </p>
                                <p class="mb-0">
                                    <strong>RT / RW:</strong>
                                    {{ $kader->posyandu->rt }} /
                                    {{ $kader->posyandu->rw }}
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- ACTION --}}
                <div class="mt-4 d-flex gap-2">
                    <a href="{{ route('kader-posyandu.edit', $kader->kader_id) }}"
                       class="btn btn-primary">
                        <i class="fas fa-edit me-1"></i> Edit
                    </a>

                    <a href="{{ route('kader-posyandu.index') }}"
                       class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>

            </div>
        </div>

    </div>
</section>

@endsection
