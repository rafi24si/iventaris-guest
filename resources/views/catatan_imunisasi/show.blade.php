@extends('layouts.guest.app')

@section('content')

{{-- HEADER --}}
<section class="pt-80 pb-60"
    style="background:linear-gradient(135deg,#1e8449,#27ae60);">
    <div class="container text-white">
        <h2 class="fw-bold mb-2">
            <i class="fas fa-syringe me-2"></i>
            Detail Catatan Imunisasi
        </h2>
        <p class="mb-0">Informasi lengkap imunisasi warga</p>
    </div>
</section>

{{-- CONTENT --}}
<section class="pt-60 pb-100" style="background:#f0fdf4;">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">

                        {{-- WARGA --}}
                        <div class="mb-4">
                            <h5 class="fw-bold text-success mb-3">
                                <i class="fas fa-user me-2"></i> Data Warga
                            </h5>

                            <table class="table table-borderless mb-0">
                                <tr>
                                    <th width="180">Nama</th>
                                    <td>: {{ $imunisasi->warga->nama }}</td>
                                </tr>
                                <tr>
                                    <th>NIK</th>
                                    <td>: {{ $imunisasi->warga->no_ktp }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td>: {{ $imunisasi->warga->jenis_kelamin }}</td>
                                </tr>
                            </table>
                        </div>

                        <hr>

                        {{-- IMUNISASI --}}
                        <div class="mb-4">
                            <h5 class="fw-bold text-success mb-3">
                                <i class="fas fa-syringe me-2"></i> Data Imunisasi
                            </h5>

                            <table class="table table-borderless mb-0">
                                <tr>
                                    <th width="180">
                                        <i class="fas fa-vial me-1 text-success"></i>
                                        Jenis Vaksin
                                    </th>
                                    <td>: {{ $imunisasi->jenis_vaksin }}</td>
                                </tr>
                                <tr>
                                    <th>
                                        <i class="fas fa-calendar-day me-1 text-success"></i>
                                        Tanggal
                                    </th>
                                    <td>: {{ $imunisasi->tanggal->format('d M Y') }}</td>
                                </tr>
                                <tr>
                                    <th>
                                        <i class="fas fa-map-marker-alt me-1 text-success"></i>
                                        Lokasi
                                    </th>
                                    <td>: {{ $imunisasi->lokasi ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>
                                        <i class="fas fa-user-md me-1 text-success"></i>
                                        Tenaga Kesehatan
                                    </th>
                                    <td>: {{ $imunisasi->nakes ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>

                        <hr>

                        {{-- KARTU IMUNISASI --}}
                        <div class="mb-4">
                            <h5 class="fw-bold text-success mb-3">
                                <i class="fas fa-id-card me-2"></i> Kartu Imunisasi
                            </h5>

                            @if($imunisasi->media->first())
                                <img src="{{ asset('storage/catatan_imunisasi/'.$imunisasi->media->first()->file_name) }}"
                                     class="img-fluid rounded shadow"
                                     alt="Kartu Imunisasi">
                            @else
                                <p class="text-muted">
                                    <i class="fas fa-image me-1"></i>
                                    Tidak ada kartu imunisasi
                                </p>
                            @endif
                        </div>

                        {{-- ACTION --}}
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('catatan-imunisasi.index') }}"
                               class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>

                            <a href="{{ route('catatan-imunisasi.edit', $imunisasi->imunisasi_id) }}"
                               class="btn btn-primary">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
</section>

@endsection
