@extends('layouts.guest.app')

@section('content')
<section class="pt-120 pb-80">
    <div class="container">

        {{-- TITLE --}}
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2>Detail Lokasi Aset</h2>
                <p class="text-muted">
                    Informasi lengkap lokasi untuk aset
                    <strong>{{ $lokasiAset->aset->nama_aset ?? '-' }}</strong>
                </p>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">

                <div class="card shadow-sm">
                    <div class="card-body p-5">

                        {{-- FOTO / DENAH --}}
                        @php
                            $media = $lokasiAset->media->first();
                            $foto = $media
                                ? asset('storage/' . $media->file_name)
                                : asset('assets-admin/images/placeholder-aset.png');
                        @endphp

                        <div class="text-center mb-4">
                            <img src="{{ $foto }}"
                                 class="img-fluid rounded"
                                 style="max-height:300px; width:100%; object-fit:cover;">
                        </div>

                        <div class="row">

                            {{-- KOLOM KIRI --}}
                            <div class="col-md-6">
                                <h5 class="mb-3 border-bottom pb-2">Data Aset</h5>

                                <p>
                                    <strong>Nama Aset</strong><br>
                                    {{ $lokasiAset->aset->nama_aset ?? '-' }}
                                </p>

                                <p>
                                    <strong>Kode Aset</strong><br>
                                    {{ $lokasiAset->aset->kode_aset ?? '-' }}
                                </p>

                                <p>
                                    <strong>Kategori</strong><br>
                                    {{ $lokasiAset->aset->kategoriAset->nama ?? '-' }}
                                </p>
                            </div>

                            {{-- KOLOM KANAN --}}
                            <div class="col-md-6">
                                <h5 class="mb-3 border-bottom pb-2">Detail Lokasi</h5>

                                <p>
                                    <strong>Lokasi</strong><br>
                                    {{ $lokasiAset->lokasi_text ?? '-' }}
                                </p>

                                <p>
                                    <strong>RT / RW</strong><br>
                                    RT {{ $lokasiAset->rt }} / RW {{ $lokasiAset->rw }}
                                </p>

                                <p>
                                    <strong>Keterangan</strong><br>
                                    {{ $lokasiAset->keterangan ?? '-' }}
                                </p>
                            </div>

                        </div>

                        <hr class="my-4">

                        {{-- BUTTON --}}
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('lokasi-aset.index') }}"
                               class="main-btn border-btn me-2">
                                <i class="bi bi-arrow-left me-1"></i> Kembali
                            </a>

                            <a href="{{ route('lokasi-aset.edit', $lokasiAset->lokasi_id) }}"
                               class="main-btn btn-hover">
                                <i class="bi bi-pencil me-1"></i> Edit Lokasi
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
</section>
@endsection
