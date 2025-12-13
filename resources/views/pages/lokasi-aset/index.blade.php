@extends('layouts.guest.app')

@section('content')
    <section class="pt-120 pb-80">
        <div class="container-custom">

            {{-- TITLE --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center mb-50">
                        <h2>Data Lokasi Aset</h2>
                        <p>Informasi lokasi aset lengkap beserta foto/denah.</p>
                    </div>
                </div>
            </div>

            {{-- SUCCESS MESSAGE --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {!! session('success') !!}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- ===================== --}}
            {{-- STATISTIK --}}
            {{-- ===================== --}}
            <div class="row mb-5">
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-number">{{ $lokasiAset->total() }}</div>
                        <div class="stats-label">Total Lokasi Aset</div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="stats-card" style="background:linear-gradient(135deg,#43e97b,#38f9d7);">
                        <div class="stats-number">
                            {{ $lokasiAset->filter(fn($l) => $l->media->count() > 0)->count() }}
                        </div>
                        <div class="stats-label">Memiliki Foto</div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="stats-card" style="background:linear-gradient(135deg,#f093fb,#f5576c);">
                        <div class="stats-number">
                            {{ $lokasiAset->filter(fn($l) => $l->media->count() == 0)->count() }}
                        </div>
                        <div class="stats-label">Tidak Ada Foto</div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="stats-card" style="background:linear-gradient(135deg,#4facfe,#00f2fe);">
                        <div class="stats-number">
                            {{ $lokasiAset->unique('aset_id')->count() }}
                        </div>
                        <div class="stats-label">Total Aset Berlokasi</div>
                    </div>
                </div>
            </div>

            {{-- ===================== --}}
            {{-- SEARCH & FILTER --}}
            {{-- ===================== --}}
            <form method="GET" action="{{ route('lokasi-aset.index') }}">
                <div class="row mb-4 align-items-end">

                    <div class="col-md-3">
                        <a href="{{ route('lokasi-aset.create') }}" class="main-btn btn-hover btn-sm">
                            <i class="fas fa-plus"></i> Tambah Lokasi
                        </a>
                    </div>

                    {{-- SEARCH --}}
                    <div class="col-md-3">
                        <input type="text" name="search" class="form-control" placeholder="Cari aset / lokasi..."
                            value="{{ request('search') }}">
                    </div>

                    {{-- FILTER FOTO --}}
                    <div class="col-md-3">
                        <select name="has_media" class="form-select">
                            <option value="">Semua Foto</option>
                            <option value="1" {{ request('has_media') == '1' ? 'selected' : '' }}>Ada Foto</option>
                            <option value="0" {{ request('has_media') == '0' ? 'selected' : '' }}>Tidak Ada Foto
                            </option>
                        </select>
                    </div>

                    {{-- BUTTON --}}
                    <div class="col-md-3 text-end">
                        <button class="btn btn-primary btn-sm">
                            <i class="fas fa-search"></i> Cari
                        </button>
                        <a href="{{ route('lokasi-aset.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-sync"></i> Reset
                        </a>
                    </div>

                </div>
            </form>

            {{-- ===================== --}}
            {{-- LIST LOKASI --}}
            {{-- ===================== --}}
            <div class="row">
                @forelse ($lokasiAset as $lokasi)
                    @php
                        $media = $lokasi->media->first();
                        $placeholder = asset('assets-guest/images/placeholder-aset.png');

                        $fotoPath =
                            $media && file_exists(public_path('storage/' . $media->file_name))
                                ? asset('storage/' . $media->file_name)
                                : $placeholder;
                    @endphp

                    <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
                        <div class="card warga-card">

                            {{-- HEADER --}}
                            <div class="warga-header text-center">
                                <div class="warga-avatar mx-auto">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </div>

                                <h5 class="mb-1">{{ $lokasi->aset->nama_aset ?? 'Aset Tidak Ditemukan' }}</h5>
                                <p class="opacity-75">Kode: {{ $lokasi->aset->kode_aset ?? '-' }}</p>
                            </div>

                            {{-- INFO --}}
                            <div class="warga-info">

                                <div class="info-item">
                                    <strong>Lokasi</strong><br>
                                    {{ $lokasi->lokasi_text ?? '-' }}
                                </div>

                                <div class="info-item">
                                    <strong>RT / RW</strong><br>
                                    RT {{ $lokasi->rt }} / RW {{ $lokasi->rw }}
                                </div>

                                <div class="info-item">
                                    <strong>Keterangan</strong><br>
                                    {{ $lokasi->keterangan ?? '-' }}
                                </div>

                                {{-- FOTO --}}
                                <div class="info-item">
                                    <strong>Foto / Denah</strong><br>
                                    <img src="{{ $fotoPath }}" class="img-thumbnail mt-2"
                                        style="height:150px;width:100%;object-fit:cover;border-radius:10px;">
                                </div>

                            </div>

                            {{-- ACTION --}}
                            <div class="action-buttons">
                                <div class="row g-2">

                                    {{-- DETAIL --}}
                                    <div class="col-12">
                                        <a href="{{ route('lokasi-aset.show', $lokasi->lokasi_id) }}"
                                            class="btn btn-info btn-sm text-white w-100">
                                            <i class="fas fa-eye me-1"></i> Detail
                                        </a>
                                    </div>

                                    {{-- EDIT --}}
                                    <div class="col-6">
                                        <a href="{{ route('lokasi-aset.edit', $lokasi->lokasi_id) }}"
                                            class="btn btn-warning btn-sm text-white w-100">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </a>
                                    </div>

                                    {{-- HAPUS --}}
                                    <div class="col-6">
                                        <form action="{{ route('lokasi-aset.destroy', $lokasi->lokasi_id) }}"
                                            method="POST" onsubmit="return confirm('Hapus lokasi aset ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm w-100">
                                                <i class="fas fa-trash me-1"></i> Hapus
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            </div>


                        </div>
                    </div>

                @empty
                    <div class="col-12 text-center text-muted">
                        <h4>Belum ada lokasi aset</h4>
                    </div>
                @endforelse
            </div>

            {{-- PAGINATION --}}
            <div class="mt-3">
                {{ $lokasiAset->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </section>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
@endsection
