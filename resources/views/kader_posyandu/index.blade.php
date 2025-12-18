@extends('layouts.guest.app')

@section('content')

{{-- HEADER --}}
<section class="pt-80 pb-60"
    style="background: linear-gradient(135deg,#1e8449,#27ae60);">
    <div class="container text-white d-flex justify-content-between align-items-center">
        <div>
            <h2 class="fw-bold mb-2">
                <i class="fas fa-user-nurse me-2"></i>
                Kader Posyandu
            </h2>
            <p class="mb-0">Daftar kader yang bertugas pada setiap Posyandu</p>
        </div>

        {{-- CREATE BUTTON --}}
        <a href="{{ route('kader-posyandu.create') }}"
           class="btn btn-light fw-semibold">
            <i class="fas fa-user-plus me-1 text-success"></i>
            Tambah Kader
        </a>
    </div>
</section>

{{-- CONTENT --}}
<section class="pt-60 pb-100" style="background:#f0fdf4;">
    <div class="container">

        {{-- FILTER & SEARCH --}}
        <form method="GET" class="row g-2 mb-4 align-items-end">

            <div class="col-md-4">
                <label class="form-label fw-semibold">Cari Nama Kader</label>
                <input type="text" name="search"
                       class="form-control"
                       placeholder="Nama warga / peran"
                       value="{{ request('search') }}">
            </div>

            <div class="col-md-3">
                <label class="form-label fw-semibold">Posyandu</label>
                <select name="posyandu_id" class="form-select">
                    <option value="">-- Semua Posyandu --</option>
                    @foreach($posyandus as $p)
                        <option value="{{ $p->posyandu_id }}"
                            {{ request('posyandu_id') == $p->posyandu_id ? 'selected' : '' }}>
                            {{ $p->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label fw-semibold">Status</label>
                <select name="status" class="form-select">
                    <option value="">-- Semua --</option>
                    <option value="aktif" {{ request('status')=='aktif'?'selected':'' }}>Aktif</option>
                    <option value="nonaktif" {{ request('status')=='nonaktif'?'selected':'' }}>Nonaktif</option>
                </select>
            </div>

            <div class="col-md-2 d-grid">
                <button class="btn btn-success">
                    <i class="fas fa-filter me-1"></i> Filter
                </button>
            </div>
        </form>

        {{-- CARD GRID --}}
        <div class="row g-4">

            @forelse($kaders as $kader)
            <div class="col-xl-4 col-lg-6 col-md-6">

                <div class="card kader-card h-100 border-0 shadow-sm">

                    <div class="card-body p-4">

                        {{-- STATUS --}}
                        <div class="d-flex justify-content-between mb-2">
                            <span class="badge bg-success">
                                <i class="fas fa-clinic-medical me-1"></i>
                                {{ $kader->posyandu->nama }}
                            </span>

                            @if(!$kader->akhir_tugas || $kader->akhir_tugas >= now())
                                <span class="badge bg-primary">
                                    <i class="fas fa-check-circle me-1"></i> Aktif
                                </span>
                            @else
                                <span class="badge bg-secondary">
                                    <i class="fas fa-times-circle me-1"></i> Nonaktif
                                </span>
                            @endif
                        </div>

                        {{-- NAMA --}}
                        <h5 class="fw-bold text-success mb-1">
                            <i class="fas fa-user me-2"></i>
                            {{ $kader->warga->nama }}
                        </h5>

                        {{-- PERAN --}}
                        <p class="mb-3 text-muted">
                            <i class="fas fa-id-badge me-2"></i>
                            {{ $kader->peran }}
                        </p>

                        {{-- TANGGAL --}}
                        <ul class="list-unstyled small mb-0">
                            <li>
                                <i class="fas fa-calendar-alt me-2 text-success"></i>
                                Mulai: {{ $kader->mulai_tugas->format('d M Y') }}
                            </li>
                            <li>
                                <i class="fas fa-calendar-times me-2 text-danger"></i>
                                Akhir:
                                {{ $kader->akhir_tugas ? $kader->akhir_tugas->format('d M Y') : 'Masih Bertugas' }}
                            </li>
                        </ul>

                    </div>

                    {{-- ACTION --}}
                    <div class="card-footer bg-white border-0 px-4 pb-4">
                        <div class="d-flex gap-2">

                            <a href="{{ route('kader-posyandu.show',$kader->kader_id) }}"
                               class="btn btn-sm btn-outline-success w-100">
                                <i class="fas fa-eye me-1"></i> Detail
                            </a>

                            <a href="{{ route('kader-posyandu.edit',$kader->kader_id) }}"
                               class="btn btn-sm btn-outline-primary w-100">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>

                            <form method="POST"
                                  action="{{ route('kader-posyandu.destroy',$kader->kader_id) }}"
                                  onsubmit="return confirm('Hapus kader ini?')"
                                  class="w-100">
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
                    <i class="fas fa-user-nurse fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Data kader belum tersedia</h5>
                </div>
            @endforelse

        </div>

        {{-- PAGINATION --}}
        <div class="mt-5 d-flex justify-content-center">
            {{ $kaders->links() }}
        </div>

    </div>
</section>

{{-- STYLE --}}
<style>
.kader-card {
    border-top: 5px solid #27ae60;
    border-radius: 14px;
    transition: all .35s ease;
}

.kader-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,.15);
}
</style>

@endsection
