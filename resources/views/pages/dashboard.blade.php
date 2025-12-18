@extends('layouts.guest.app')

@section('content')

{{-- ================= HERO SECTION ================= --}}
<section class="pt-120 pb-120"
    style="
        background:
        linear-gradient(135deg, rgba(16,185,129,.95), rgba(5,150,105,.95));
    ">
    <div class="container">
        <div class="row align-items-center">

            {{-- LEFT CONTENT --}}
            <div class="col-lg-6">
                <span class="badge bg-light text-success px-3 py-2 mb-3">
                    Sistem Informasi Posyandu
                </span>

                <h1 class="text-white fw-bold display-5">
                    Dashboard Posyandu Desa
                </h1>

                <p class="text-white fs-5 mt-4">
                    Sistem digital terpadu untuk pencatatan kesehatan ibu & anak,
                    pengelolaan kegiatan Posyandu, serta monitoring imunisasi
                    secara cepat, akurat, dan transparan.
                </p>

                <div class="d-flex gap-3 mt-4">
                    <a href="#statistik" class="btn btn-light btn-lg fw-semibold text-success">
                        📊 Lihat Statistik
                    </a>
                    <a href="#layanan" class="btn btn-outline-light btn-lg">
                        🚀 Layanan
                    </a>
                </div>
            </div>

            {{-- RIGHT SLIDER --}}
            <div class="col-lg-6 mt-5 mt-lg-0">
                <div id="heroCarousel" class="carousel slide shadow-lg rounded-4 overflow-hidden"
                    data-bs-ride="carousel" data-bs-interval="3000">

                    <div class="carousel-inner">
                        @php
                            $heroes = ['logo1.jpg.jpg','logo2.jpg.jpg','logo3,jpg.jpg','logo4.jpg.jpg','logo5.jpg.jpg'];
                        @endphp

                        @foreach ($heroes as $i => $img)
                            <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                                <img src="{{ asset('assets-guest/images/hero/'.$img) }}"
                                    class="d-block w-100"
                                    style="height:420px; object-fit:cover;"
                                    alt="Posyandu {{ $i+1 }}">
                            </div>
                        @endforeach
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ================= STATISTIK ================= --}}
<section id="statistik" class="pt-120 pb-100" style="background:#f0fdf4;">
    <div class="container">

        <div class="text-center mb-70">
            <h2 class="fw-bold text-success">Ringkasan Statistik Posyandu</h2>
            <p class="text-muted">Data real-time pelayanan kesehatan desa</p>
        </div>

        <div class="row g-4">
            @php
                $stats = [
                    ['icon'=>'users','title'=>'Warga Terdaftar','value'=>'1.250','color'=>'success'],
                    ['icon'=>'user-nurse','title'=>'Kader Posyandu','value'=>'18','color'=>'primary'],
                    ['icon'=>'calendar-check','title'=>'Jadwal Aktif','value'=>'12','color'=>'warning'],
                    ['icon'=>'syringe','title'=>'Data Imunisasi','value'=>'860','color'=>'danger'],
                ];
            @endphp

            @foreach ($stats as $s)
            <div class="col-md-3">
                <div class="card border-0 shadow-sm text-center p-4 h-100">
                    <div class="mb-3">
                        <i class="fas fa-{{ $s['icon'] }} fa-3x text-{{ $s['color'] }}"></i>
                    </div>
                    <h2 class="fw-bold">{{ $s['value'] }}</h2>
                    <p class="mb-0">{{ $s['title'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ================= LAYANAN ================= --}}
<section id="layanan" class="pt-120 pb-120">
    <div class="container">

        <div class="text-center mb-70">
            <h2 class="fw-bold text-success">Layanan Utama Posyandu</h2>
            <p class="text-muted">Akses cepat ke modul inti</p>
        </div>

        <div class="row g-4">
            @php
                $services = [
                    ['icon'=>'hospital','title'=>'Data Posyandu','desc'=>'Kelola data posyandu & dokumentasi'],
                    ['icon'=>'baby','title'=>'Balita & Ibu','desc'=>'Pantau tumbuh kembang balita'],
                    ['icon'=>'calendar-alt','title'=>'Jadwal Kegiatan','desc'=>'Manajemen jadwal posyandu'],
                    ['icon'=>'syringe','title'=>'Imunisasi','desc'=>'Riwayat imunisasi digital'],
                    ['icon'=>'file-medical','title'=>'Laporan','desc'=>'Rekap & laporan otomatis'],
                    ['icon'=>'user-shield','title'=>'Admin','desc'=>'Manajemen pengguna & akses'],
                ];
            @endphp

            @foreach ($services as $srv)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm p-4 text-center">
                    <i class="fas fa-{{ $srv['icon'] }} fa-3x text-success mb-3"></i>
                    <h5 class="fw-bold">{{ $srv['title'] }}</h5>
                    <p class="text-muted">{{ $srv['desc'] }}</p>
                    <a href="#" class="btn btn-outline-success btn-sm mt-auto">
                        Buka Modul →
                    </a>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>

{{-- ================= CTA ================= --}}
<section class="pt-120 pb-120 text-center"
    style="
        background:
        linear-gradient(135deg, rgba(5,150,105,.95), rgba(16,185,129,.95));
    ">
    <div class="container">
        <h2 class="text-white fw-bold">
            Bersama Posyandu, Wujudkan Generasi Sehat
        </h2>
        <p class="text-white fs-5 mt-3">
            Digitalisasi pelayanan demi kesehatan ibu dan anak
        </p>
        <a href="#" class="btn btn-light btn-lg fw-semibold text-success mt-4">
            🚀 Mulai Kelola Data
        </a>
    </div>
</section>

@endsection
