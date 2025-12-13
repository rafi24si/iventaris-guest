@extends('layouts.guest.app')

@section('content')
<section class="pt-120 pb-80">
    <div class="container-custom">

        <div class="card shadow-lg">
            <div class="card-header bg-info text-white">
                <h4>Detail Pemeliharaan</h4>
            </div>

            <div class="card-body">
                <p><strong>Aset:</strong> {{ $pemeliharaan->aset->nama_aset }}</p>
                <p><strong>Kode:</strong> {{ $pemeliharaan->aset->kode_aset }}</p>
                <p><strong>Tanggal:</strong> {{ $pemeliharaan->tanggal }}</p>
                <p><strong>Tindakan:</strong> {{ $pemeliharaan->tindakan }}</p>
                <p><strong>Biaya:</strong> Rp {{ number_format($pemeliharaan->biaya,0,',','.') }}</p>
                <p><strong>Pelaksana:</strong> {{ $pemeliharaan->pelaksana ?? '-' }}</p>

                @if($pemeliharaan->media->first())
                    <img src="{{ asset('storage/'.$pemeliharaan->media->first()->file_name) }}"
                         class="img-fluid rounded mt-3">
                @endif
            </div>

            <div class="card-footer text-end">
                <a href="{{ route('pemeliharaan.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
            </div>
        </div>

    </div>
</section>
@endsection
