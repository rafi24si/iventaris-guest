@extends('layouts.guest.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

@section('content')
    <section class="pt-120 pb-80">
        <div class="container-custom">

            {{-- TITLE --}}
            <div class="section-title text-center mb-50">
                <h2>Data Pemeliharaan Aset</h2>
                <p>Riwayat pemeliharaan aset lengkap.</p>
            </div>

            {{-- SUCCESS --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- ===================== --}}
            {{-- STATISTIK PEMELIHARAAN --}}
            {{-- ===================== --}}
            <div class="row mb-5">

                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-number">{{ $pemeliharaan->total() }}</div>
                        <div class="stats-label">Total Pemeliharaan</div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="stats-card" style="background:linear-gradient(135deg,#43e97b,#38f9d7);">
                        <div class="stats-number">
                            {{ $pemeliharaan->filter(fn($p) => $p->media->count() > 0)->count() }}
                        </div>
                        <div class="stats-label">Memiliki Bukti Foto</div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="stats-card" style="background:linear-gradient(135deg,#f093fb,#f5576c);">
                        <div class="stats-number">
                            {{ $pemeliharaan->filter(fn($p) => $p->media->count() == 0)->count() }}
                        </div>
                        <div class="stats-label">Tanpa Foto</div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="stats-card" style="background:linear-gradient(135deg,#4facfe,#00f2fe);">
                        <div class="stats-number">
                            {{ $pemeliharaan->unique('aset_id')->count() }}
                        </div>
                        <div class="stats-label">Total Aset Dirawat</div>
                    </div>
                </div>

            </div>


            {{-- FILTER --}}
            <form method="GET" action="{{ route('pemeliharaan.index') }}">
                <div class="row mb-4 align-items-end">

                    <div class="col-md-3">
                        <a href="{{ route('pemeliharaan.create') }}" class="main-btn btn-hover btn-sm">
                            <i class="fas fa-plus"></i> Tambah
                        </a>
                    </div>

                    <div class="col-md-3">
                        <input type="text" name="search" class="form-control" placeholder="Cari aset / tindakan"
                            value="{{ request('search') }}">
                    </div>

                    <div class="col-md-3">
                        <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
                    </div>

                    <div class="col-md-3">
                        <select name="aset_id" class="form-select">
                            <option value="">Semua Aset</option>
                            @foreach ($aset as $a)
                                <option value="{{ $a->aset_id }}"
                                    {{ request('aset_id') == $a->aset_id ? 'selected' : '' }}>
                                    {{ $a->nama_aset }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 mt-2 text-end">
                        <button class="btn btn-primary btn-sm">
                            <i class="fas fa-search"></i> Cari
                        </button>
                        <a href="{{ route('pemeliharaan.index') }}" class="btn btn-secondary btn-sm">
                            Reset
                        </a>
                    </div>

                </div>
            </form>

            {{-- LIST --}}
            <div class="row">
                @forelse ($pemeliharaan as $item)
                    @php
                        $media = $item->media->first();
                        $foto = $media
                            ? asset('storage/' . $media->file_name)
                            : asset('assets-guest/images/placeholder-aset.png');
                    @endphp

                    <div class="col-md-4 mb-4">
                        <div class="card warga-card">

                            {{-- HEADER --}}
                            <div class="warga-header text-center">
                                <img src="{{ $foto }}" class="img-fluid rounded mb-3"
                                    style="height:160px; width:100%; object-fit:cover;">

                                <h5 class="mt-2">{{ $item->aset->nama_aset }}</h5>
                                <p class="opacity-75">Kode: {{ $item->aset->kode_aset }}</p>
                            </div>

                            {{-- DETAIL --}}
                            <div class="warga-info">

                                {{-- TANGGAL --}}
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="bi bi-calendar-event"></i>
                                    </div>
                                    <div class="info-content">
                                        <strong>Tanggal</strong><br>
                                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                    </div>
                                </div>

                                {{-- TINDAKAN --}}
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="bi bi-tools"></i>
                                    </div>
                                    <div class="info-content">
                                        <strong>Tindakan</strong><br>
                                        {{ $item->tindakan }}
                                    </div>
                                </div>

                                {{-- BIAYA --}}
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="bi bi-cash-stack"></i>
                                    </div>
                                    <div class="info-content">
                                        <strong>Biaya</strong><br>
                                        Rp {{ number_format($item->biaya, 0, ',', '.') }}
                                    </div>
                                </div>

                            </div>


                            {{-- BUTTON --}}
                            <div class="action-buttons mt-3">
                                <div class="row g-2">

                                    <div class="col-12">
                                        <a href="{{ route('pemeliharaan.show', $item->pemeliharaan_id) }}"
                                            class="btn btn-info btn-sm w-100 text-white">
                                            <i class="fas fa-eye me-1"></i> Detail
                                        </a>
                                    </div>

                                    <div class="col-6">
                                        <a href="{{ route('pemeliharaan.edit', $item->pemeliharaan_id) }}"
                                            class="btn btn-warning btn-sm w-100 text-white">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                    </div>

                                    <div class="col-6">
                                        <form method="POST"
                                            action="{{ route('pemeliharaan.destroy', $item->pemeliharaan_id) }}"
                                            onsubmit="return confirm('Hapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm w-100">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                @empty
                    <div class="col-12 text-center text-muted">
                        <h4>Belum ada data pemeliharaan</h4>
                    </div>
                @endforelse
            </div>

            {{-- PAGINATION --}}
            <div class="mt-3">
                {{ $pemeliharaan->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </section>
@endsection
