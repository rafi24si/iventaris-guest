@extends('layouts.guest.app')

@section('content')

{{-- HEADER --}}
<section class="pt-80 pb-60"
    style="background: linear-gradient(135deg,#1e8449,#27ae60);">
    <div class="container text-white d-flex justify-content-between align-items-center">
        <div>
            <h2 class="fw-bold mb-2">
                <i class="fas fa-calendar-check me-2"></i>
                Jadwal Posyandu
            </h2>
            <p class="mb-0">Daftar jadwal kegiatan Posyandu Desa</p>
        </div>

        <a href="{{ route('jadwal-posyandu.create') }}" class="btn btn-light fw-semibold">
            <i class="fas fa-plus-circle text-success me-1"></i>
            Tambah Jadwal
        </a>
    </div>
</section>

{{-- CONTENT --}}
<section class="pt-60 pb-100" style="background:#f0fdf4;">
    <div class="container">

        {{-- ALERT --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- FILTER --}}
        <form method="GET" class="row g-2 mb-4 align-items-end">

            <div class="col-md-4">
                <label class="form-label fw-semibold">Posyandu</label>
                <select name="posyandu_id" class="form-select">
                    <option value="">-- Semua Posyandu --</option>
                    @foreach($posyandus as $p)
                        <option value="{{ $p->posyandu_id }}"
                            {{ request('posyandu_id')==$p->posyandu_id?'selected':'' }}>
                            {{ $p->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label fw-semibold">Tanggal</label>
                <input type="date" name="tanggal"
                       class="form-control"
                       value="{{ request('tanggal') }}">
            </div>

            <div class="col-md-2 d-grid">
                <button class="btn btn-success">
                    <i class="fas fa-filter me-1"></i> Filter
                </button>
            </div>

            <div class="col-md-2 d-grid">
                <a href="{{ route('jadwal-posyandu.index') }}" class="btn btn-secondary">
                    <i class="fas fa-sync"></i> Reset
                </a>
            </div>

        </form>

        {{-- CARD GRID --}}
        <div class="row g-4">

            @forelse($jadwals as $jadwal)
            <div class="col-xl-4 col-lg-6 col-md-6">

                <div class="card jadwal-card h-100 border-0 shadow-sm">

                    {{-- POSTER --}}
                    @php
                        $poster = $jadwal->media->first();
                    @endphp

                    <img
                        src="{{ $poster
                                ? asset('storage/jadwal_posyandu/'.$poster->file_name)
                                : 'https://via.placeholder.com/600x350?text=Jadwal+Posyandu' }}"
                        class="card-img-top"
                        style="height:200px;object-fit:cover;"
                        alt="Poster Jadwal">

                    <div class="card-body p-4">

                        {{-- POSYANDU --}}
                        <span class="badge bg-success mb-2">
                            <i class="fas fa-clinic-medical me-1"></i>
                            {{ $jadwal->posyandu->nama }}
                        </span>

                        {{-- TEMA --}}
                        <h5 class="fw-bold text-success mt-2">
                            {{ $jadwal->tema }}
                        </h5>

                        {{-- KETERANGAN --}}
                        <p class="text-muted mb-3">
                            {{ Str::limit($jadwal->keterangan, 90) ?? '-' }}
                        </p>

                        {{-- INFO --}}
                        <ul class="list-unstyled small mb-0">
                            <li>
                                <i class="fas fa-calendar-alt me-2 text-success"></i>
                                {{ $jadwal->tanggal->format('d M Y') }}
                            </li>
                        </ul>

                    </div>

                    {{-- ACTION --}}
                    <div class="card-footer bg-white border-0 px-4 pb-4">
                        <div class="d-flex gap-2">

                            <a href="{{ route('jadwal-posyandu.show',$jadwal->jadwal_id) }}"
                               class="btn btn-sm btn-outline-success w-100">
                                <i class="fas fa-eye me-1"></i> Detail
                            </a>

                            <a href="{{ route('jadwal-posyandu.edit',$jadwal->jadwal_id) }}"
                               class="btn btn-sm btn-outline-primary w-100">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>

                            <form method="POST"
                                  action="{{ route('jadwal-posyandu.destroy',$jadwal->jadwal_id) }}"
                                  onsubmit="return confirm('Hapus jadwal ini?')"
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
                    <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Belum ada jadwal Posyandu</h5>
                </div>
            @endforelse

        </div>

        {{-- PAGINATION --}}
        <div class="mt-5 d-flex justify-content-center">
            {{ $jadwals->links('pagination::bootstrap-5') }}
        </div>

    </div>
</section>

{{-- STYLE --}}
<style>
.jadwal-card {
    border-top: 5px solid #27ae60;
    border-radius: 14px;
    transition: .35s;
}

.jadwal-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,.15);
}
</style>

@endsection
