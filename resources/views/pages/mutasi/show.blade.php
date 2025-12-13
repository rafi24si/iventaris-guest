@extends('layouts.guest.app')

@section('content')
<section class="pt-120 pb-80">
    <div class="container-custom">

        {{-- TITLE --}}
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2>Detail Mutasi Aset</h2>
                <p class="text-muted">
                    Informasi lengkap mutasi aset
                    <strong>{{ $mutasi->aset->nama_aset ?? '-' }}</strong>
                </p>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">

                <div class="card shadow-sm">
                    <div class="card-body p-5">

                        {{-- FOTO ASET --}}
                        @php
                            $foto = optional($mutasi->aset->media->first())->file_name
                                ? asset('storage/' . $mutasi->aset->media->first()->file_name)
                                : asset('assets-guest/images/placeholder-aset.png');
                        @endphp

                        <div class="text-center mb-4">
                            <img src="{{ $foto }}"
                                 class="img-fluid rounded"
                                 style="max-height:300px; width:100%; object-fit:cover;">
                        </div>

                        <div class="row">

                            {{-- DATA ASET --}}
                            <div class="col-md-6">
                                <h5 class="border-bottom pb-2 mb-3">Data Aset</h5>

                                <p><strong>Nama Aset:</strong><br>
                                    {{ $mutasi->aset->nama_aset ?? '-' }}
                                </p>

                                <p><strong>Kode Aset:</strong><br>
                                    {{ $mutasi->aset->kode_aset ?? '-' }}
                                </p>

                                <p><strong>Kategori:</strong><br>
                                    {{ $mutasi->aset->kategoriAset->nama ?? '-' }}
                                </p>
                            </div>

                            {{-- DATA MUTASI --}}
                            <div class="col-md-6">
                                <h5 class="border-bottom pb-2 mb-3">Detail Mutasi</h5>

                                <p><strong>Tanggal Mutasi:</strong><br>
                                    {{ \Carbon\Carbon::parse($mutasi->tanggal)->format('d M Y') }}
                                </p>

                                <p><strong>Jenis Mutasi:</strong><br>
                                    <span class="badge bg-primary">
                                        {{ $mutasi->jenis_mutasi }}
                                    </span>
                                </p>

                                <p><strong>Keterangan:</strong><br>
                                    {{ $mutasi->keterangan ?: '-' }}
                                </p>
                            </div>

                        </div>

                        <hr class="my-4">

                        {{-- BUTTON --}}
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('mutasi.index') }}"
                               class="main-btn border-btn me-2">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>

                            <a href="{{ route('mutasi.edit', $mutasi->mutasi_id) }}"
                               class="main-btn btn-hover">
                                <i class="bi bi-pencil"></i> Edit Mutasi
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
</section>
@endsection
