@extends('layouts.guest.app')

@section('content')
    {{-- HEADER --}}
    <section class="pt-80 pb-60" style="background: linear-gradient(135deg,#1e8449,#27ae60);">
        <div class="container text-white">
            <h2 class="fw-bold mb-2">Data Posyandu</h2>
            <p class="mb-0">Daftar Posyandu Desa beserta informasi dan dokumentasi</p>
        </div>
    </section>

    {{-- CONTENT --}}
    <section class="pt-60 pb-100" style="background:#f0fdf4;">
        <div class="container">

            {{-- SEARCH & FILTER --}}
            <form method="GET" class="row g-2 mb-4 align-items-end">

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Pencarian</label>
                    <input type="text" name="search" class="form-control" placeholder="Cari nama / alamat / kontak"
                        value="{{ request('search') }}">
                </div>

                <div class="col-md-2">
                    <label class="form-label fw-semibold">RT</label>
                    <input type="text" name="rt" class="form-control" value="{{ request('rt') }}">
                </div>

                <div class="col-md-2">
                    <label class="form-label fw-semibold">RW</label>
                    <input type="text" name="rw" class="form-control" value="{{ request('rw') }}">
                </div>

                <div class="col-md-4">
                    <button class="btn btn-success">
                        <i class="fas fa-search me-1"></i> Filter
                    </button>
                    <a href="{{ route('posyandu.index') }}" class="btn btn-secondary">
                        Reset
                    </a>
                    <a href="{{ route('posyandu.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i> Tambah
                    </a>
                </div>
            </form>

            {{-- CARD GRID --}}
            {{-- CARD GRID --}}
            <div class="row g-4">

                @forelse($posyandus as $posyandu)
                    <div class="col-xl-4 col-lg-6 col-md-6">

                        <div class="card h-100 border-0 shadow-sm posyandu-card">

                            {{-- FOTO --}}
                            @php
                                $foto = $posyandu->fotoUtama();
                            @endphp

                            <div class="posyandu-image-wrapper">
                                <img src="{{ $foto ? asset('storage/' . $foto->file_name) : 'https://via.placeholder.com/600x400?text=Posyandu' }}"
                                    alt="Foto Posyandu" class="posyandu-image">
                            </div>

                            <div class="card-body p-4">

                                {{-- TITLE --}}
                                <h5 class="fw-bold text-success mb-2">
                                    <i class="fas fa-clinic-medical me-2"></i>
                                    {{ $posyandu->nama }}
                                </h5>

                                {{-- ALAMAT --}}
                                <p class="text-muted mb-3 small">
                                    <i class="fas fa-map-marker-alt me-2 text-success"></i>
                                    {{ $posyandu->alamat }}
                                </p>

                                {{-- BADGE RT RW --}}
                                <div class="d-flex gap-2 mb-3">
                                    <span class="badge rounded-pill bg-success">
                                        <i class="fas fa-home me-1"></i> RT {{ $posyandu->rt }}
                                    </span>
                                    <span class="badge rounded-pill bg-success">
                                        <i class="fas fa-building me-1"></i> RW {{ $posyandu->rw }}
                                    </span>
                                </div>

                                {{-- KONTAK --}}
                                <div class="mb-2">
                                    <span class="badge bg-light text-success border">
                                        <i class="fas fa-phone-alt me-1"></i>
                                        {{ $posyandu->kontak ?? 'Tidak ada kontak' }}
                                    </span>
                                </div>

                            </div>

                            {{-- ACTION --}}
                            <div class="card-footer bg-white border-0 px-4 pb-4">
                                <div class="d-flex justify-content-between">

                                    <a href="{{ route('posyandu.show', $posyandu->posyandu_id) }}"
                                        class="btn btn-sm btn-outline-success w-100 me-1">
                                        <i class="fas fa-eye me-1"></i> Detail
                                    </a>

                                    <a href="{{ route('posyandu.edit', $posyandu->posyandu_id) }}"
                                        class="btn btn-sm btn-outline-primary w-100 mx-1">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a>

                                    <form method="POST" action="{{ route('posyandu.destroy', $posyandu->posyandu_id) }}"
                                        onsubmit="return confirm('Hapus data Posyandu?')" class="w-100 ms-1">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger w-100">
                                            <i class="fas fa-trash me-1"></i> Hapus
                                        </button>
                                    </form>

                                </div>
                            </div>

                        </div>

                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="fas fa-clinic-medical fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Data Posyandu belum tersedia</h5>
                    </div>
                @endforelse

            </div>


            {{-- PAGINATION --}}
            <div class="mt-5 d-flex justify-content-center">
                {{ $posyandus->links() }}
            </div>

        </div>
    </section>

    {{-- STYLE --}}
    <style>
        .posyandu-card {
            border-top: 5px solid #27ae60;
            border-radius: 14px;
            transition: all .35s ease;
        }

        .posyandu-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, .15);
        }

        .posyandu-image-wrapper {
            height: 200px;
            overflow: hidden;
            border-top-left-radius: 14px;
            border-top-right-radius: 14px;
        }

        .posyandu-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .5s ease;
        }

        .posyandu-card:hover .posyandu-image {
            transform: scale(1.08);
        }
    </style>
@endsection
