@extends('layouts.guest.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

@section('content')
    <section class="pt-120 pb-80">
        <div class="container-custom">

            {{-- TITLE --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center mb-50">
                        <h2>Data Aset Inventaris</h2>
                        <p>Daftar lengkap semua aset yang terdata dalam bentuk kartu.</p>
                    </div>
                </div>
            </div>

            {{-- MESSAGE --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {!! session('success') !!}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- STATS (TIDAK DIUBAH) --}}
            <div class="row mb-5">
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-number">{{ $aset->count() }}</div>
                        <div class="stats-label">Total Aset</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card" style="background:linear-gradient(135deg,#43e97b,#38f9d7);">
                        <div class="stats-number">{{ $aset->where('kondisi', 'Baik')->count() }}</div>
                        <div class="stats-label">Baik</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card" style="background:linear-gradient(135deg,#f093fb,#f5576c);">
                        <div class="stats-number">{{ $aset->where('kondisi', 'Rusak Ringan')->count() }}</div>
                        <div class="stats-label">Rusak Ringan</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card" style="background:linear-gradient(135deg,#4facfe,#00f2fe);">
                        <div class="stats-number">{{ $aset->where('kondisi', 'Rusak Berat')->count() }}</div>
                        <div class="stats-label">Rusak Berat</div>
                    </div>
                </div>
            </div>

            {{-- ACTION BAR --}}
            <form method="GET" action="{{ route('aset.index') }}">
                <div class="row mb-4 align-items-end">

                    <div class="col-md-3">
                        <a href="{{ route('aset.create') }}" class="main-btn btn-hover btn-sm">
                            <i class="fas fa-plus me-1"></i> Tambah Aset
                        </a>
                    </div>

                    {{-- SEARCH --}}
                    <div class="col-md-3">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama / kode aset..."
                            value="{{ request('search') }}">
                    </div>

                    {{-- FILTER KONDISI --}}
                    <div class="col-md-3">
                        <select name="kondisi" class="form-select">
                            <option value="">Semua Kondisi</option>
                            <option value="Baik" {{ request('kondisi') == 'Baik' ? 'selected' : '' }}>Baik</option>
                            <option value="Rusak Ringan" {{ request('kondisi') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak
                                Ringan</option>
                            <option value="Rusak Berat" {{ request('kondisi') == 'Rusak Berat' ? 'selected' : '' }}>Rusak
                                Berat</option>
                        </select>
                    </div>

                    {{-- FILTER KATEGORI --}}
                    <div class="col-md-3">
                        <select name="kategori_id" class="form-select">
                            <option value="">Semua Kategori</option>
                            @foreach ($kategoriAset as $kat)
                                <option value="{{ $kat->kategori_id }}"
                                    {{ request('kategori_id') == $kat->kategori_id ? 'selected' : '' }}>
                                    {{ $kat->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- BUTTON --}}
                    <div class="col-md-12 mt-2 text-end">
                        <button class="btn btn-primary btn-sm">
                            <i class="fas fa-search"></i> Cari
                        </button>
                        <a href="{{ route('aset.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-sync"></i> Reset
                        </a>
                    </div>
                </div>
            </form>

            {{-- CARD LIST --}}
            <div class="row">
                @forelse ($aset as $item)
                    @php
                        $foto = optional($item->media->first())->file_name;

                        // ✅ Placeholder lokal (AMAN offline)
                        $placeholder = asset('assets-guest/images/placeholder-aset.png');

                        // ✅ Cek file foto benar-benar ada
                        $fotoPath =
                            $foto && file_exists(public_path('storage/' . $foto))
                                ? asset('storage/' . $foto)
                                : $placeholder;
                    @endphp

                    <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
                        <div class="card warga-card">

                            {{-- FOTO --}}
                            <div class="warga-header text-center">
                                <img src="{{ $fotoPath }}" class="img-fluid rounded mb-3"
                                    style="height:160px; width:100%; object-fit:cover;">
                                <h5>{{ $item->nama_aset }}</h5>
                                <p class="opacity-75">Kode: {{ $item->kode_aset }}</p>
                            </div>

                            {{-- DETAIL --}}
                            <div class="warga-info">

                                {{-- KATEGORI --}}
                                <div class="info-item d-flex align-items-start gap-2 mb-2">
                                    <div class="info-icon">
                                        <i class="bi bi-tags-fill"></i>
                                    </div>
                                    <div class="info-content">
                                        <strong>Kategori</strong><br>
                                        <span>{{ $item->kategoriAset->nama ?? '-' }}</span>
                                    </div>
                                </div>

                                {{-- NILAI --}}
                                <div class="info-item d-flex align-items-start gap-2 mb-2">
                                    <div class="info-icon">
                                        <i class="bi bi-cash-stack"></i>
                                    </div>
                                    <div class="info-content">
                                        <strong>Nilai</strong><br>
                                        <span>Rp {{ number_format($item->nilai_perolehan, 0, ',', '.') }}</span>
                                    </div>
                                </div>

                                {{-- TANGGAL --}}
                                <div class="info-item d-flex align-items-start gap-2">
                                    <div class="info-icon">
                                        <i class="bi bi-calendar-event"></i>
                                    </div>
                                    <div class="info-content">
                                        <strong>Tanggal</strong><br>
                                        <span>{{ \Carbon\Carbon::parse($item->tgl_perolehan)->format('d M Y') }}</span>
                                    </div>
                                </div>

                            </div>


                            {{-- BUTTONS --}}
                            <div class="action-buttons text-center">
                                <div class="d-flex justify-content-center gap-2">

                                    {{-- DETAIL --}}
                                    <a href="{{ route('aset.show', $item->aset_id) }}"
                                        class="btn btn-info btn-sm text-white px-3">
                                        <i class="fas fa-eye me-1"></i> Detail
                                    </a>

                                    {{-- EDIT --}}
                                    <a href="{{ route('aset.edit', $item->aset_id) }}"
                                        class="btn btn-warning btn-sm text-white px-3">
                                        <i class="fas fa-pen me-1"></i> Edit
                                    </a>

                                    {{-- HAPUS --}}
                                    <form action="{{ route('aset.destroy', $item->aset_id) }}" method="POST"
                                        onsubmit="return confirm('Hapus aset {{ $item->nama_aset }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm px-3">
                                            <i class="fas fa-trash me-1"></i> Hapus
                                        </button>
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted">
                        <h4>Belum ada data aset</h4>
                    </div>
                @endforelse
            </div>

            <div class="mt-3">
                {{ $aset->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </section>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
@endsection
