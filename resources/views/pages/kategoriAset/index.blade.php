@extends('layouts.guest.app')

@section('content')
    <section class="pt-120 pb-80">
        <div class="container-custom">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center mb-50">
                        {{-- JUDUL DAN DESKRIPSI UNTUK KATEGORI ASET --}}
                        <h2>Kategori Aset Desa</h2>
                        <p>Kelola kategori aset dengan tampilan yang informatif</p>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {!! session('success') !!}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row mb-5">
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-number">{{ $kategoriAset->count() }}</div>
                        <div class="stats-label">Total Kategori</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                        {{-- Contoh: Kategori dengan Deskripsi --}}
                        <div class="stats-number">{{ $kategoriAset->where('deskripsi', '!=', '')->count() }}</div>
                        <div class="stats-label">Kategori Berdeskripsi</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                        {{-- Contoh: Total Kode Unik --}}
                        <div class="stats-number">{{ $kategoriAset->count() }}</div>
                        <div class="stats-label">Total Kode Unik</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                        {{-- Contoh: Statistik Keempat (Created Bulan Ini) --}}
                        <div class="stats-number">{{ $kategoriAset->where('created_at', '>=', now()->subMonth())->count() }}
                        </div>
                        <div class="stats-label">Baru Bulan Ini</div>
                    </div>
                </div>
            </div>

            <form method="GET" action="{{ route('kategoriAset.index') }}">
                <div class="row mb-4 align-items-end">

                    {{-- TOMBOL TAMBAH --}}
                    <div class="col-md-3">
                        <a href="{{ route('kategoriAset.create') }}" class="main-btn btn-hover btn-sm">
                            <i class="fas fa-plus me-1"></i> Tambah Kategori Aset
                        </a>
                    </div>

                    {{-- SEARCH --}}
                    <div class="col-md-6">
                        <input type="text" name="search" class="form-control"
                            placeholder="Cari nama atau kode kategori..." value="{{ request('search') }}">
                    </div>

                    {{-- BUTTON --}}
                    <div class="col-md-3 text-end">
                        <button class="btn btn-primary btn-sm">
                            <i class="fas fa-search me-1"></i> Cari
                        </button>
                        <a href="{{ route('kategoriAset.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-sync"></i> Reset
                        </a>
                    </div>

                </div>
            </form>


            <div class="table-responsive">
                <form method="GET" action="{{ route('kategoriAset.index') }}" class="mb-3">
                    <div class="row">
                        <div class="col-md-3">
                            <select name="deskripsi_filter" class="form-select" onchange="this.form.submit()">
                                <option value="">Semua Deskripsi</option>
                                <option value="ada" {{ request('deskripsi_filter') == 'ada' ? 'selected' : '' }}>Ada
                                    Deskripsi</option>
                                <option value="tidak_ada"
                                    {{ request('deskripsi_filter') == 'tidak_ada' ? 'selected' : '' }}>Tidak Ada Deskripsi
                                </option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>

            <div class="row" id="kategoriContainer">
                @forelse ($kategoriAset as $kategori)
                    <div class="col-xl-4 col-lg-6 col-md-6 mb-4 kategori-item">
                        <div class="card warga-card">
                            <div class="warga-header text-center">
                                <div class="warga-avatar mx-auto">
                                    <i class="lni lni-layers"></i> {{-- Icon Kategori --}}
                                </div>
                                <h5 class="mb-1 text-truncate">{{ $kategori->nama }}</h5>
                                <p class="mb-0 opacity-75">Kode: <strong
                                        class="text-primary">{{ $kategori->kode }}</strong>
                                </p>
                            </div>

                            <div class="warga-info">
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="lni lni-notepad"></i>
                                    </div>
                                    <div class="info-content">
                                        <strong>Deskripsi</strong><br>
                                        {{ Str::limit($kategori->deskripsi, 50) ?: 'Tidak ada deskripsi' }}
                                    </div>
                                </div>

                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="lni lni-calendar"></i>
                                    </div>
                                    <div class="info-content">
                                        <strong>Dibuat Pada</strong><br>
                                        {{ $kategori->created_at->format('d M Y H:i') }}
                                    </div>
                                </div>

                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="lni lni-reload"></i>
                                    </div>
                                    <div class="info-content">
                                        <strong>Terakhir Diperbarui</strong><br>
                                        {{ $kategori->updated_at->format('d M Y H:i') }}
                                    </div>
                                </div>
                            </div>

                            <div class="action-buttons">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="{{ route('kategoriAset.edit', $kategori->kategori_id) }}"
                                            class="btn btn-warning btn-sm text-white w-100">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <form action="{{ route('kategoriAset.destroy', $kategori->kategori_id) }}"
                                            method="POST" class="d-inline w-100">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm w-100"
                                                onclick="return confirm('Yakin ingin menghapus kategori aset: {{ $kategori->nama }}?')">
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
                                <h4 class="text-muted">Belum ada data kategori aset</h4>
                                <p class="text-muted">Mulai dengan menambahkan kategori pertama</p>
                                <a href="{{ route('kategoriAset.create') }}" class="main-btn btn-hover">
                                    <i class="lni lni-plus"></i> Tambah Kategori Pertama
                                </a>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="mt-3">
                {{ $kategoriAset->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </section>
    {{-- end main content --}}

    @push('scripts')
        <script>
            // Search functionality
            document.getElementById('searchInput').addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                const kategoriItems = document.querySelectorAll('.kategori-item');

                kategoriItems.forEach(item => {
                    // Mencari di nama dan kode
                    const kategoriNama = item.querySelector('.warga-header h5').textContent.toLowerCase();
                    // Ambil kode dari elemen <p>
                    const kategoriKode = item.querySelector('.warga-header p').textContent.toLowerCase();

                    if (kategoriNama.includes(searchTerm) || kategoriKode.includes(searchTerm)) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        </script>
    @endpush
@endsection
