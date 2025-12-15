@extends('layouts.guest.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

@section('content')
    <section class="pt-120 pb-80">
        <div class="container-custom">

            {{-- TITLE --}}
            <div class="section-title text-center mb-50">
                <h2>Data Mutasi Aset</h2>
                <p>Riwayat perubahan, pemindahan, atau penghapusan aset.</p>
            </div>

            {{-- SUCCESS --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {!! session('success') !!}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- ===================== --}}
            {{-- STATISTIK MUTASI ASET --}}
            {{-- ===================== --}}
            <div class="row mb-5">

                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-number">{{ $mutasi->total() }}</div>
                        <div class="stats-label">Total Mutasi</div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="stats-card" style="background:linear-gradient(135deg,#43e97b,#38f9d7);">
                        <div class="stats-number">
                            {{ $mutasi->where('jenis_mutasi', 'Pemindahan')->count() }}
                        </div>
                        <div class="stats-label">Pemindahan</div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="stats-card" style="background:linear-gradient(135deg,#f093fb,#f5576c);">
                        <div class="stats-number">
                            {{ $mutasi->where('jenis_mutasi', 'Penghapusan')->count() }}
                        </div>
                        <div class="stats-label">Penghapusan</div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="stats-card" style="background:linear-gradient(135deg,#4facfe,#00f2fe);">
                        <div class="stats-number">
                            {{ $mutasi->unique('aset_id')->count() }}
                        </div>
                        <div class="stats-label">Aset Termutasi</div>
                    </div>
                </div>

            </div>


            {{-- FILTER & SEARCH --}}
            <form method="GET" action="{{ route('mutasi.index') }}">
                <div class="row mb-4 align-items-end">

                    <div class="col-md-3">
                        <a href="{{ route('mutasi.create') }}" class="main-btn btn-hover btn-sm">
                            <i class="fas fa-plus me-1"></i> Tambah Mutasi
                        </a>
                    </div>

                    <div class="col-md-3">
                        <input type="text" name="search" class="form-control" placeholder="Cari aset / kode / jenis..."
                            value="{{ request('search') }}">
                    </div>

                    <div class="col-md-3">
                        <select name="jenis_mutasi" class="form-select">
                            <option value="">Semua Jenis</option>
                            <option value="Pemindahan" {{ request('jenis_mutasi') == 'Pemindahan' ? 'selected' : '' }}>
                                Pemindahan
                            </option>
                            <option value="Penghapusan" {{ request('jenis_mutasi') == 'Penghapusan' ? 'selected' : '' }}>
                                Penghapusan
                            </option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
                    </div>

                    <div class="col-12 mt-2 text-end">
                        <button class="btn btn-primary btn-sm">
                            <i class="fas fa-search"></i> Cari
                        </button>
                        <a href="{{ route('mutasi.index') }}" class="btn btn-secondary btn-sm">
                            Reset
                        </a>
                    </div>

                </div>
            </form>

            {{-- LIST MUTASI --}}
            <div class="row">
                @forelse ($mutasi as $m)
                    @php
                        $foto = optional($m->aset->media->first())->file_name
                            ? asset('storage/' . $m->aset->media->first()->file_name)
                            : asset('assets-guest/images/placeholder-aset.png');
                    @endphp

                    <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
                        <div class="card warga-card">

                            {{-- HEADER --}}
                            <div class="warga-header text-center">
                                <img src="{{ $foto }}" class="img-fluid rounded mb-3"
                                    style="height:160px; width:100%; object-fit:cover;">

                                <h5 class="mb-1">{{ $m->aset->nama_aset ?? '-' }}</h5>
                                <p class="opacity-75">Kode: {{ $m->aset->kode_aset ?? '-' }}</p>
                            </div>

                            {{-- DETAIL --}}
                            <div class="warga-info">

                                {{-- TANGGAL MUTASI --}}
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="bi bi-calendar-event"></i>
                                    </div>
                                    <div class="info-content">
                                        <strong>Tanggal Mutasi</strong><br>
                                        {{ \Carbon\Carbon::parse($m->tanggal)->format('d M Y') }}
                                    </div>
                                </div>

                                {{-- JENIS MUTASI --}}
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="bi bi-shuffle"></i>
                                    </div>
                                    <div class="info-content">
                                        <strong>Jenis Mutasi</strong><br>
                                        <span class="badge bg-primary">{{ $m->jenis_mutasi }}</span>
                                    </div>
                                </div>

                                {{-- KETERANGAN --}}
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="bi bi-card-text"></i>
                                    </div>
                                    <div class="info-content">
                                        <strong>Keterangan</strong><br>
                                        {{ $m->keterangan ?: '-' }}
                                    </div>
                                </div>

                            </div>


                            {{-- ACTION --}}
                            <div class="action-buttons mt-3">
                                <div class="row g-2">

                                    <div class="col-12">
                                        <a href="{{ route('mutasi.show', $m->mutasi_id) }}"
                                            class="btn btn-info btn-sm w-100 text-white">
                                            <i class="fas fa-eye me-1"></i> Detail
                                        </a>
                                    </div>

                                    <div class="col-6">
                                        <a href="{{ route('mutasi.edit', $m->mutasi_id) }}"
                                            class="btn btn-warning btn-sm w-100 text-white">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </a>
                                    </div>

                                    <div class="col-6">
                                        <form action="{{ route('mutasi.destroy', $m->mutasi_id) }}" method="POST"
                                            onsubmit="return confirm('Hapus data mutasi ini?')">
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
                        <h4>Belum ada data mutasi</h4>
                    </div>
                @endforelse
            </div>

            {{-- PAGINATION --}}
            <div class="mt-3">
                {{ $mutasi->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </section>
@endsection
