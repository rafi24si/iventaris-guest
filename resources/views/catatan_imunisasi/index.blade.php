@extends('layouts.guest.app')

@section('content')

{{-- HEADER --}}
<section class="pt-80 pb-60"
    style="background:linear-gradient(135deg,#1e8449,#27ae60);">
    <div class="container text-white">
        <h2 class="fw-bold mb-2">
            <i class="fas fa-syringe me-2"></i>
            Catatan Imunisasi
        </h2>
        <p class="mb-0">Riwayat imunisasi warga dan arsip kartu imunisasi</p>
    </div>
</section>

{{-- CONTENT --}}
<section class="pt-60 pb-100" style="background:#f0fdf4;">
    <div class="container">

        {{-- ACTION & FILTER --}}
        <form method="GET" class="row g-2 align-items-end mb-4">

            <div class="col-md-3">
                <a href="{{ route('catatan-imunisasi.create') }}"
                   class="btn btn-success w-100">
                    <i class="fas fa-plus-circle me-1"></i>
                    Tambah Imunisasi
                </a>
            </div>

            <div class="col-md-4">
                <label class="form-label fw-semibold">
                    <i class="fas fa-search me-1"></i> Cari Jenis Vaksin
                </label>
                <input type="text"
                       name="search"
                       class="form-control"
                       placeholder="BCG, Polio, DPT, Campak..."
                       value="{{ request('search') }}">
            </div>

            <div class="col-md-3">
                <label class="form-label fw-semibold">
                    <i class="fas fa-user me-1"></i> Warga
                </label>
                <select name="warga_id" class="form-select">
                    <option value="">Semua Warga</option>
                    @foreach($wargas as $w)
                        <option value="{{ $w->warga_id }}"
                            {{ request('warga_id')==$w->warga_id?'selected':'' }}>
                            {{ $w->nama }}
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

            @forelse($imunisasis as $imunisasi)
            <div class="col-xl-4 col-lg-6 col-md-6">

                <div class="card imunisasi-card h-100 border-0 shadow-sm">

                    {{-- FOTO KARTU --}}
                    @if($imunisasi->media->first())
                        <img src="{{ asset('storage/catatan_imunisasi/'.$imunisasi->media->first()->file_name) }}"
                             class="card-img-top"
                             style="height:180px;object-fit:cover"
                             alt="Kartu Imunisasi">
                    @else
                        <div class="d-flex align-items-center justify-content-center bg-light"
                             style="height:180px;">
                            <div class="text-muted text-center">
                                <i class="fas fa-image fa-2x mb-1"></i><br>
                                Tidak Ada Kartu
                            </div>
                        </div>
                    @endif

                    <div class="card-body p-4">

                        {{-- VAKSIN --}}
                        <span class="badge bg-success mb-2">
                            <i class="fas fa-syringe me-1"></i>
                            {{ $imunisasi->jenis_vaksin }}
                        </span>

                        {{-- WARGA --}}
                        <h5 class="fw-bold text-success mb-1">
                            <i class="fas fa-user me-2"></i>
                            {{ $imunisasi->warga->nama }}
                        </h5>

                        <p class="text-muted mb-3">
                            <i class="fas fa-id-card me-1"></i>
                            NIK: {{ $imunisasi->warga->no_ktp }}
                        </p>

                        {{-- INFO --}}
                        <ul class="list-unstyled small mb-0">
                            <li class="mb-1">
                                <i class="fas fa-calendar-day text-success me-2"></i>
                                {{ $imunisasi->tanggal->format('d M Y') }}
                            </li>
                            <li class="mb-1">
                                <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                {{ $imunisasi->lokasi ?? '-' }}
                            </li>
                            <li>
                                <i class="fas fa-user-md text-primary me-2"></i>
                                {{ $imunisasi->nakes ?? '-' }}
                            </li>
                        </ul>

                    </div>

                    {{-- ACTION --}}
                    <div class="card-footer bg-white border-0 px-4 pb-4">
                        <div class="d-flex gap-2">

                            <a href="{{ route('catatan-imunisasi.show',$imunisasi->imunisasi_id) }}"
                               class="btn btn-outline-success btn-sm w-100">
                                <i class="fas fa-eye me-1"></i> Detail
                            </a>

                            <a href="{{ route('catatan-imunisasi.edit',$imunisasi->imunisasi_id) }}"
                               class="btn btn-outline-primary btn-sm w-100">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>

                            <form method="POST"
                                  action="{{ route('catatan-imunisasi.destroy',$imunisasi->imunisasi_id) }}"
                                  class="w-100"
                                  onsubmit="return confirm('Hapus catatan imunisasi ini?')">
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
                    <i class="fas fa-syringe fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Belum ada data imunisasi</h5>
                </div>
            @endforelse

        </div>

        {{-- PAGINATION --}}
        <div class="mt-5 d-flex justify-content-center">
            {{ $imunisasis->links('pagination::bootstrap-5') }}
        </div>

    </div>
</section>

{{-- STYLE --}}
<style>
.imunisasi-card {
    border-top: 5px solid #27ae60;
    border-radius: 14px;
    transition: .35s ease;
}
.imunisasi-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 18px 35px rgba(0,0,0,.15);
}
</style>

@endsection
