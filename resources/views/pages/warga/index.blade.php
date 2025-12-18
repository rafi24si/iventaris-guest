@extends('layouts.guest.app')

@section('content')

{{-- HEADER --}}
<section class="pt-80 pb-60"
    style="background: linear-gradient(135deg,#1e8449,#27ae60);">
    <div class="container text-white d-flex justify-content-between align-items-center">
        <div>
            <h2 class="fw-bold mb-2">
                <i class="fas fa-users me-2"></i>
                Data Warga Desa
            </h2>
            <p class="mb-0">Kelola data warga desa secara rapi dan informatif</p>
        </div>

        <a href="{{ route('warga.create') }}" class="btn btn-light fw-semibold">
            <i class="fas fa-user-plus text-success me-1"></i>
            Tambah Warga
        </a>
    </div>
</section>

{{-- CONTENT --}}
<section class="pt-60 pb-100" style="background:#f0fdf4;">
    <div class="container">

        {{-- ALERT --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {!! session('success') !!}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- STATISTIK --}}
        <div class="row mb-5 g-3">
            <div class="col-md-3">
                <div class="stats-card bg-success">
                    <div class="stats-number">{{ $dataWarga->count() }}</div>
                    <div class="stats-label">Total Warga</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card bg-primary">
                    <div class="stats-number">{{ $dataWarga->where('jenis_kelamin','Laki-laki')->count() }}</div>
                    <div class="stats-label">Laki-laki</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card bg-info">
                    <div class="stats-number">{{ $dataWarga->where('jenis_kelamin','Perempuan')->count() }}</div>
                    <div class="stats-label">Perempuan</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card bg-warning text-dark">
                    <div class="stats-number">{{ $dataWarga->whereNotNull('pekerjaan')->count() }}</div>
                    <div class="stats-label">Memiliki Pekerjaan</div>
                </div>
            </div>
        </div>

        {{-- FILTER --}}
        <form method="GET" action="{{ route('warga.index') }}" class="row g-2 mb-4">

            <div class="col-md-4">
                <input type="text" name="search" class="form-control"
                       placeholder="Cari nama / NIK"
                       value="{{ request('search') }}">
            </div>

            <div class="col-md-3">
                <select name="jenis_kelamin" class="form-select">
                    <option value="">Semua Jenis Kelamin</option>
                    <option value="Laki-laki" {{ request('jenis_kelamin')=='Laki-laki'?'selected':'' }}>Laki-laki</option>
                    <option value="Perempuan" {{ request('jenis_kelamin')=='Perempuan'?'selected':'' }}>Perempuan</option>
                </select>
            </div>

            <div class="col-md-2 d-grid">
                <button class="btn btn-success">
                    <i class="fas fa-filter me-1"></i> Filter
                </button>
            </div>

            <div class="col-md-2 d-grid">
                <a href="{{ route('warga.index') }}" class="btn btn-secondary">
                    <i class="fas fa-sync"></i> Reset
                </a>
            </div>

        </form>

        {{-- CARD GRID --}}
        <div class="row g-4">

            @forelse ($dataWarga as $item)
            <div class="col-xl-4 col-lg-6 col-md-6">

                <div class="card warga-card h-100 border-0 shadow-sm">

                    {{-- HEADER --}}
                    <div class="warga-header text-center">
                        <div class="avatar-circle">
                            <i class="fas fa-user"></i>
                        </div>
                        <h5 class="mb-1 fw-bold">{{ $item->nama }}</h5>
                        <p class="small opacity-75 mb-0">NIK: {{ $item->no_ktp }}</p>
                    </div>

                    {{-- INFO --}}
                    <div class="card-body">

                        <div class="info-row">
                            <i class="fas fa-venus-mars text-success"></i>
                            <div>
                                <small>Jenis Kelamin</small><br>
                                <strong>{{ $item->jenis_kelamin }}</strong>
                            </div>
                        </div>

                        <div class="info-row">
                            <i class="fas fa-praying-hands text-success"></i>
                            <div>
                                <small>Agama</small><br>
                                <strong>{{ $item->agama }}</strong>
                            </div>
                        </div>

                        <div class="info-row">
                            <i class="fas fa-briefcase text-success"></i>
                            <div>
                                <small>Pekerjaan</small><br>
                                <strong>{{ $item->pekerjaan ?: 'Tidak bekerja' }}</strong>
                            </div>
                        </div>

                        <div class="info-row">
                            <i class="fas fa-phone text-success"></i>
                            <div>
                                <small>Telepon</small><br>
                                <strong>{{ $item->telp ?: '-' }}</strong>
                            </div>
                        </div>

                        <div class="info-row">
                            <i class="fas fa-envelope text-success"></i>
                            <div>
                                <small>Email</small><br>
                                <strong>{{ $item->email ?: '-' }}</strong>
                            </div>
                        </div>

                    </div>

                    {{-- ACTION --}}
                    <div class="card-footer bg-white border-0 px-3 pb-3">
                        <div class="d-flex gap-2">

                            <a href="{{ route('warga.edit',$item->warga_id) }}"
                               class="btn btn-sm btn-outline-primary w-100">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>

                            <form method="POST"
                                  action="{{ route('warga.destroy',$item->warga_id) }}"
                                  onsubmit="return confirm('Hapus data warga ini?')"
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
                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Belum ada data warga</h5>
                </div>
            @endforelse

        </div>

        {{-- PAGINATION --}}
        <div class="mt-5 d-flex justify-content-center">
            {{ $dataWarga->links('pagination::bootstrap-5') }}
        </div>

    </div>
</section>

{{-- STYLE --}}
<style>
.stats-card {
    padding: 25px;
    border-radius: 14px;
    color: white;
    text-align: center;
    font-weight: bold;
}

.stats-number {
    font-size: 30px;
}

.warga-card {
    border-top: 5px solid #27ae60;
    border-radius: 14px;
    transition: .35s;
}

.warga-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,.15);
}

.warga-header {
    background: linear-gradient(135deg,#1e8449,#27ae60);
    color: white;
    padding: 25px;
    border-radius: 14px 14px 0 0;
}

.avatar-circle {
    width: 70px;
    height: 70px;
    background: rgba(255,255,255,.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 10px;
    font-size: 28px;
}

.info-row {
    display: flex;
    gap: 12px;
    margin-bottom: 12px;
    font-size: 14px;
}
</style>

@endsection
