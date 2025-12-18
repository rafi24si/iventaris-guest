@extends('layouts.guest.app')

@section('content')

{{-- HERO POSYANDU --}}
<section class="hero-section pt-120 pb-120"
    style="
        background:
        linear-gradient(135deg, rgba(22,160,133,.9), rgba(39,174,96,.9)),
        url('https://gobleg-buleleng.desa.id/index.php/first/artikel/695-Kegiatan-Posyandu-Mawar-Putih');
        background-size: cover;
        background-position: center;
    ">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <span class="badge bg-light text-success mb-3 px-3 py-2">
                    Sistem Informasi Posyandu
                </span>
                <h1 class="text-white fw-bold display-5">
                    Dashboard Posyandu Desa
                </h1>
                <p class="text-white mt-4 fs-5">
                    Sistem digital terpadu untuk pencatatan kesehatan ibu dan anak,
                    pengelolaan kegiatan Posyandu, serta monitoring imunisasi
                    secara akurat, cepat, dan transparan.
                </p>
                <a href="#statistik" class="main-btn btn-hover mt-4">
                    Lihat Statistik
                </a>
            </div>
            <div class="col-lg-5 text-center mt-5 mt-lg-0">
                <img class="img-fluid rounded-4 shadow-lg"
                     src="https://images.unsplash.com/photo-1580281657521-6f6a0a5a6e6e"
                     alt="Kegiatan Posyandu">
            </div>
        </div>
    </div>
</section>

{{-- STATISTIK --}}
<section id="statistik" class="pt-120 pb-100"
    style="background: linear-gradient(180deg, #ecfdf5, #ffffff);">
    <div class="container">
        <div class="section-title text-center mb-70">
            <h2 class="text-success">Ringkasan Data Posyandu</h2>
            <p>Gambaran umum layanan Posyandu Desa</p>
        </div>

        <div class="row g-4">
            @php
                $stats = [
                    ['icon'=>'users','color'=>'success','title'=>'Warga Terdaftar','value'=>'1.250'],
                    ['icon'=>'user-nurse','color'=>'primary','title'=>'Kader Posyandu','value'=>'18'],
                    ['icon'=>'calendar-check','color'=>'warning','title'=>'Jadwal Aktif','value'=>'12'],
                    ['icon'=>'syringe','color'=>'danger','title'=>'Data Imunisasi','value'=>'860'],
                ];
            @endphp

            @foreach($stats as $s)
            <div class="col-md-3">
                <div class="card border-0 shadow-sm text-center p-4 h-100"
                     style="border-top:5px solid var(--bs-{{ $s['color'] }});">
                    <i class="fas fa-{{ $s['icon'] }} fa-3x text-{{ $s['color'] }} mb-3"></i>
                    <h2 class="fw-bold">{{ $s['value'] }}</h2>
                    <p class="mb-0">{{ $s['title'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- PROFIL POSYANDU --}}
<section class="pt-120 pb-100">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <img class="img-fluid rounded-4 shadow"
                     src="https://images.unsplash.com/photo-1603398938378-e54b5f8d2b3b"
                     alt="Profil Posyandu">
            </div>
            <div class="col-lg-6 mt-5 mt-lg-0">
                <h2 class="text-success fw-bold">
                    Profil Posyandu Desa
                </h2>
                <p class="mt-3">
                    Posyandu Desa merupakan layanan kesehatan berbasis masyarakat
                    yang berfokus pada pemantauan tumbuh kembang balita,
                    kesehatan ibu hamil, serta pencegahan penyakit melalui imunisasi.
                </p>
                <ul class="list-unstyled mt-4">
                    <li class="mb-2">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        Pelayanan kesehatan rutin
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        Kader terlatih & bersertifikat
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        Pendataan terintegrasi digital
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- MENU LAYANAN --}}
<section class="pt-120 pb-120"
    style="background: linear-gradient(180deg, #f0fdf4, #ffffff);">
    <div class="container">
        <div class="section-title text-center mb-70">
            <h2 class="text-success">Layanan Utama Posyandu</h2>
            <p>Akses cepat ke modul inti Posyandu</p>
        </div>

        <div class="row g-4">
            @php
                $menus = [
                    ['title'=>'Data Posyandu','img'=>'1576765607924-3f7b0f1a02a3','desc'=>'Kelola data Posyandu dan dokumentasi.'],
                    ['title'=>'Jadwal & Layanan','img'=>'1588776814546-1f4d0bca2d0a','desc'=>'Jadwal kegiatan dan layanan balita.'],
                    ['title'=>'Imunisasi','img'=>'1603398938378-e54b5f8d2b3b','desc'=>'Riwayat imunisasi dan kartu digital.'],
                ];
            @endphp

            @foreach($menus as $m)
            <div class="col-lg-4">
                <div class="card h-100 border-0 shadow-sm">
                    <img class="card-img-top"
                         src="https://images.unsplash.com/photo-{{ $m['img'] }}"
                         alt="{{ $m['title'] }}">
                    <div class="card-body">
                        <h4 class="text-success">{{ $m['title'] }}</h4>
                        <p>{{ $m['desc'] }}</p>
                        <a href="#" class="main-btn btn-hover btn-sm">
                            Buka Modul
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="pt-120 pb-120 text-center"
    style="
        background:
        linear-gradient(135deg, rgba(39,174,96,.95), rgba(22,160,133,.95)),
        url('https://images.unsplash.com/photo-1588776814546-1f4d0bca2d0a');
        background-size: cover;
    ">
    <div class="container">
        <h2 class="text-white fw-bold">
            Bersama Posyandu, Wujudkan Generasi Sehat
        </h2>
        <p class="text-white mt-3 fs-5">
            Sistem digital membantu kader dan desa
            memberikan pelayanan kesehatan terbaik.
        </p>
        <a href="#" class="main-btn btn-hover mt-4">
            Mulai Kelola Data
        </a>
    </div>
</section>

@endsection
