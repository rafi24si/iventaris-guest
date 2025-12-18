@extends('layouts.guest.app')

@section('content')

{{-- HEADER --}}
<section class="pt-80 pb-60"
    style="background:linear-gradient(135deg,#1e8449,#27ae60);">
    <div class="container text-white">
        <h2 class="fw-bold mb-2">
            <i class="fas fa-stethoscope me-2"></i>
            Layanan Posyandu
        </h2>
        <p class="mb-0">Pencatatan layanan kesehatan ibu & anak</p>
    </div>
</section>

{{-- CONTENT --}}
<section class="pt-60 pb-100" style="background:#f0fdf4;">
    <div class="container">

        {{-- ACTION + FILTER --}}
        <form method="GET" class="row g-2 align-items-end mb-4">

            <div class="col-md-3">
                <a href="{{ route('layanan-posyandu.create') }}"
                   class="btn btn-success w-100">
                    <i class="fas fa-plus-circle me-1"></i>
                    Tambah Layanan
                </a>
            </div>

            <div class="col-md-4">
                <label class="form-label fw-semibold">
                    <i class="fas fa-search me-1"></i> Cari Warga
                </label>
                <input type="text"
                       name="search"
                       class="form-control"
                       placeholder="Nama / NIK"
                       value="{{ request('search') }}">
            </div>

            <div class="col-md-3">
                <label class="form-label fw-semibold">
                    <i class="fas fa-calendar me-1"></i> Jadwal
                </label>
                <select name="jadwal_id" class="form-select">
                    <option value="">Semua Jadwal</option>
                    @foreach($jadwals as $j)
                        <option value="{{ $j->jadwal_id }}"
                            {{ request('jadwal_id')==$j->jadwal_id?'selected':'' }}>
                            {{ $j->tanggal->format('d M Y') }} - {{ $j->posyandu->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <button class="btn btn-primary w-100">
                    <i class="fas fa-filter me-1"></i> Filter
                </button>
            </div>
        </form>

        {{-- CARD GRID --}}
        <div class="row g-4">

            @forelse($layanans as $layanan)
            <div class="col-xl-4 col-lg-6 col-md-6">

                <div class="card layanan-card h-100 border-0 shadow-sm">

                    <div class="card-body p-4">

                        {{-- POSYANDU --}}
                        <span class="badge bg-success mb-2">
                            <i class="fas fa-clinic-medical me-1"></i>
                            {{ $layanan->jadwal->posyandu->nama }}
                        </span>

                        {{-- NAMA WARGA --}}
                        <h5 class="fw-bold text-success mb-1">
                            <i class="fas fa-user me-2"></i>
                            {{ $layanan->warga->nama }}
                        </h5>

                        <p class="text-muted mb-3">
                            <i class="fas fa-id-card me-1"></i>
                            NIK: {{ $layanan->warga->no_ktp }}
                        </p>

                        {{-- INFO --}}
                        <ul class="list-unstyled small mb-3">
                            <li class="mb-1">
                                <i class="fas fa-calendar-day text-success me-2"></i>
                                {{ $layanan->jadwal->tanggal->format('d M Y') }}
                            </li>
                            <li class="mb-1">
                                <i class="fas fa-weight text-primary me-2"></i>
                                Berat: {{ $layanan->berat ?? '-' }} kg
                            </li>
                            <li class="mb-1">
                                <i class="fas fa-ruler-vertical text-info me-2"></i>
                                Tinggi: {{ $layanan->tinggi ?? '-' }} cm
                            </li>
                            <li class="mb-1">
                                <i class="fas fa-capsules text-warning me-2"></i>
                                Vitamin: {{ $layanan->vitamin ?? '-' }}
                            </li>
                        </ul>

                        {{-- KONSELING --}}
                        <p class="small text-muted mb-0">
                            <i class="fas fa-comments me-1"></i>
                            {{ $layanan->konseling ?: 'Tidak ada konseling' }}
                        </p>

                    </div>

                    {{-- ACTION --}}
                    <div class="card-footer bg-white border-0 px-4 pb-4">
                        <div class="d-flex gap-2">

                            <a href="{{ route('layanan-posyandu.show',$layanan->layanan_id) }}"
                               class="btn btn-outline-success btn-sm w-100">
                                <i class="fas fa-eye me-1"></i> Detail
                            </a>

                            <a href="{{ route('layanan-posyandu.edit',$layanan->layanan_id) }}"
                               class="btn btn-outline-primary btn-sm w-100">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>

                            <form method="POST"
                                  action="{{ route('layanan-posyandu.destroy',$layanan->layanan_id) }}"
                                  class="w-100"
                                  onsubmit="return confirm('Hapus layanan ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm w-100">
                                    <i class="fas fa-trash me-1"></i> Hapus
                                </button>
                            </form>

                        </div>
                    </div>

                </div>

            </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="fas fa-notes-medical fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Belum ada data layanan</h5>
                </div>
            @endforelse

        </div>

        {{-- PAGINATION --}}
        <div class="mt-5 d-flex justify-content-center">
            {{ $layanans->links('pagination::bootstrap-5') }}
        </div>

    </div>
</section>

{{-- STYLE --}}
<style>
.layanan-card {
    border-top: 5px solid #27ae60;
    border-radius: 14px;
    transition: .35s ease;
}
.layanan-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 18px 35px rgba(0,0,0,.15);
}
</style>

@endsection
