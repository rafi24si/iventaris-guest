@extends('layouts.guest.app')

@section('content')

{{-- HEADER --}}
<section class="pt-80 pb-60"
    style="background: linear-gradient(135deg,#1e8449,#27ae60);">
    <div class="container text-white">
        <h2 class="fw-bold mb-2">Detail Posyandu</h2>
        <p class="mb-0">Informasi lengkap Posyandu Desa</p>
    </div>
</section>

{{-- CONTENT --}}
<section class="pt-60 pb-100" style="background:#f0fdf4;">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-lg-9">

                <div class="card border-0 shadow-sm">

                    {{-- FOTO --}}
                    @php
                        $foto = $posyandu->fotoUtama();
                    @endphp

                    <img
                        src="{{ $foto
                            ? asset('storage/'.$foto->file_url)
                            : 'https://via.placeholder.com/1200x450?text=Posyandu' }}"
                        class="card-img-top"
                        style="max-height:350px;object-fit:cover;"
                        alt="Foto Posyandu">

                    <div class="card-body p-4">

                        {{-- TITLE --}}
                        <h3 class="fw-bold text-success mb-3">
                            {{ $posyandu->nama }}
                        </h3>

                        {{-- INFO GRID --}}
                        <div class="row mb-4">

                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-map-marker-alt text-success me-3 mt-1"></i>
                                    <div>
                                        <h6 class="fw-semibold mb-1">Alamat</h6>
                                        <p class="mb-0 text-muted">
                                            {{ $posyandu->alamat }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-home text-success me-3 mt-1"></i>
                                    <div>
                                        <h6 class="fw-semibold mb-1">RT / RW</h6>
                                        <p class="mb-0 text-muted">
                                            RT {{ $posyandu->rt }} / RW {{ $posyandu->rw }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-phone text-success me-3 mt-1"></i>
                                    <div>
                                        <h6 class="fw-semibold mb-1">Kontak</h6>
                                        <p class="mb-0 text-muted">
                                            {{ $posyandu->kontak ?? '-' }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>

                        {{-- META --}}
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <span class="badge bg-success">
                                    Dibuat: {{ $posyandu->created_at->format('d M Y') }}
                                </span>
                            </div>
                            <div class="col-md-6 text-md-end mt-2 mt-md-0">
                                <span class="badge bg-secondary">
                                    Update: {{ $posyandu->updated_at->format('d M Y') }}
                                </span>
                            </div>
                        </div>

                        {{-- ACTION --}}
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('posyandu.index') }}"
                               class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>

                            <a href="{{ route('posyandu.edit', $posyandu->posyandu_id) }}"
                               class="btn btn-success">
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
