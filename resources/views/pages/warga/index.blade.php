@extends('layouts.guest.app')

@section('content')
    <!-- Start Main Content -->
    <section class="pt-120 pb-80">
        <div class="container-custom">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center mb-50">
                        <h2>Data Warga Desa</h2>
                        <p>Kelola data warga dengan tampilan yang lebih informatif</p>
                    </div>
                </div>
            </div>


            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {!! session('success') !!}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Statistics Row -->
            <div class="row mb-5">
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-number">{{ $dataWarga->count() }}</div>
                        <div class="stats-label">Total Warga</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                        <div class="stats-number">{{ $dataWarga->where('jenis_kelamin', 'Laki-laki')->count() }}</div>
                        <div class="stats-label">Warga Laki-laki</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                        <div class="stats-number">{{ $dataWarga->where('jenis_kelamin', 'Perempuan')->count() }}</div>
                        <div class="stats-label">Warga Perempuan</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                        <div class="stats-number">{{ $dataWarga->where('pekerjaan', '!=', '')->count() }}</div>
                        <div class="stats-label">Memiliki Pekerjaan</div>
                    </div>
                </div>
            </div>

            <!-- Tambah Kategori dan Search Box -->
            <div class="row mb-4 align-items-center">
                <div class="col-md-6">
                    <a href="{{ route('warga.create') }}" class="main-btn btn-hover btn-sm">
                        <i class="fas fa-plus me-1"></i>Tambah Data Warga
                    </a>
                </div>
                <div class="col-md-6">
                    <div class="search-box">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h5 class="mb-0">Cari Warga</h5>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Ketik nama atau NIK anda..."
                                    id="searchInput">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <form method="GET" action="{{ route('warga.index') }}" class="mb-3">
                        <div class="row">
                            <div class="col-md-2">
                                <select name="jenis_kelamin" class="form-select" onchange="this.form.submit()">
                                    <option value="">All</option>
                                    <option value="Laki-Laki"
                                        {{ request('jenis_kelamin') == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                    <option value="Perempuan"
                                        {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                    </option>
                                </select>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

            <!-- Warga Cards -->
            <div class="row" id="wargaContainer">
                @forelse ($dataWarga as $item)
                    <div class="col-xl-4 col-lg-6 col-md-6 mb-4 warga-item">
                        <div class="card warga-card">
                            <div class="warga-header text-center">
                                <div class="warga-avatar mx-auto">
                                    <i class="lni lni-warga"></i>
                                </div>
                                <h5 class="mb-1">{{ $item->nama }}</h5>
                                <p class="mb-0 opacity-75">NIK: {{ $item->no_ktp }}</p>
                            </div>

                            <div class="warga-info">

                                <div class="info-item d-flex align-items-start">
                                    <div class="info-icon">
                                        <i class="lni lni-user"></i>
                                    </div>
                                    <div class="info-content">
                                        <small class="text-muted">Jenis Kelamin</small><br>
                                        <strong>{{ $item->jenis_kelamin }}</strong>
                                    </div>
                                </div>

                                <div class="info-item d-flex align-items-start">
                                    <div class="info-icon">
                                        <i class="lni lni-star"></i>
                                    </div>
                                    <div class="info-content">
                                        <small class="text-muted">Agama</small><br>
                                        <strong>{{ $item->agama }}</strong>
                                    </div>
                                </div>

                                <div class="info-item d-flex align-items-start">
                                    <div class="info-icon">
                                        <i class="lni lni-briefcase"></i>
                                    </div>
                                    <div class="info-content">
                                        <small class="text-muted">Pekerjaan</small><br>
                                        <strong>{{ $item->pekerjaan ?: 'Tidak bekerja' }}</strong>
                                    </div>
                                </div>

                                <div class="info-item d-flex align-items-start">
                                    <div class="info-icon">
                                        <i class="lni lni-phone"></i>
                                    </div>
                                    <div class="info-content">
                                        <small class="text-muted">Telepon</small><br>
                                        <strong>{{ $item->telp ?: '-' }}</strong>
                                    </div>
                                </div>

                                <div class="info-item d-flex align-items-start">
                                    <div class="info-icon">
                                        <i class="lni lni-envelope"></i>
                                    </div>
                                    <div class="info-content">
                                        <small class="text-muted">Email</small><br>
                                        <strong>{{ $item->email ?: '-' }}</strong>
                                    </div>
                                </div>

                            </div>


                            <div class="action-buttons">
                                <div class="row">
                                    <div class="col-6">
                                        {{-- Route disesuaikan ke user.edit dengan $user->id --}}
                                        <a href="{{ route('warga.edit', $item->warga_id) }}"
                                            class="btn btn-warning btn-sm text-white w-100">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        {{-- Route disesuaikan ke user.destroy dengan $user->id --}}
                                        <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST"
                                            class="d-inline w-100">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm w-100"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus warga: {{ $item->name }}?')">
                                                <i class="fas fa-trash me-1"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="card text-center py-5">
                            <div class="card-body">
                                <i class="lni lni-inbox display-1 text-muted mb-3"></i>
                                <h4 class="text-muted">Belum ada data warga</h4>
                                <p class="text-muted">Mulai dengan menambahkan data warga pertama</p>
                                <a href="{{ route('warga.create') }}" class="main-btn btn-hover">
                                    <i class="lni lni-plus"></i> Tambah Warga Pertama
                                </a>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="mt-3">
                {{ $dataWarga->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </section>
    {{-- end main content --}}
@endsection
