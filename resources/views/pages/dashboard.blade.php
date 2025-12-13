@extends('layouts.guest.app')

@section('content')
{{-- main content start --}}
	<section id="home" class="hero-section pt-120 pb-80">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-xl-6 col-lg-6 col-md-10">
					<div class="hero-content">
						<h1>Sistem Manajemen Inventaris dan Aset Desa</h1>
						<p class="mt-3">Platform digital terintegrasi untuk mengelola dan memantau seluruh inventaris serta aset desa secara efisien, transparan, dan akurat.</p>
						<a href="#about" class="main-btn btn-hover border-btn mt-4">Pelajari Lebih Lanjut</a>
					</div>
				</div>
				<div class="col-xxl-6 col-xl-6 col-lg-6">
					<div class="hero-image text-center text-lg-end pt-5 pt-lg-0">
						<img style="width: auto; height: auto; max-width: 100%;" src="{{asset('assets-guest/images/hero/ang-aset.png') }}" alt="Sistem Manajemen Inventaris">
					</div>
				</div>
			</div>
		</div>
	</section>
	<hr>

	<section id="about" class="about-section pt-120 pb-80">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 order-last order-lg-first">
					<div class="hero-image text-center text-lg-end pt-5 pt-lg-0">
						<img style="width: auto; height: auto; max-width: 100%;" src="{{asset('assets-guest/images/about/perencanaan-aset.png') }}" alt="Pelacakan Aset Desa">
					</div>
				</div>
				<div class="col-lg-6">
					<div class="about-content-wrapper">
						<div class="section-title">
                            {{-- Judul dan Deskripsi Ditinggikan --}}
							<h2 class="mb-20">Sistem Terpadu Pengelolaan Aset Desa</h2>
							<p class="mb-30">Sistem Bina Desa dirancang khusus untuk membantu pemerintah desa dalam mengelola inventaris dan aset secara digital. Dengan sistem ini, setiap barang inventaris dan aset desa dapat tercatat, terpantau, dan terlacak dengan mudah, mengurangi resiko kehilangan dan meningkatkan akuntabilitas pengelolaan barang milik desa.</p>

                            {{-- Fitur Utama Disesuaikan --}}
							<h4 class="mt-4 mb-3">Fitur Utama Sistem:</h4>
							<ul class="list-unstyled">
								<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Katalogisasi inventaris lengkap</li>
								<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Pelacakan kondisi dan lokasi aset</li>
								<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Pencatatan pemeliharaan berkala</li>
								<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Laporan real-time kondisi aset</li>

							</ul>

							<a href="{{ route('aset.index') }}" class="main-btn btn-hover border-btn mt-5"> Aset Sistem</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<hr>

	<section id="benefits" class="benefits-section pt-120 pb-80" style="background-color: #f8f9fa;">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-xxl-5 col-xl-6 col-lg-7 col-md-10">
					<div class="section-title text-center mb-50"> {{-- Menambahkan mb-50 untuk jarak --}}
						<h2>Manfaat Penggunaan Sistem</h2>
						<p>Keuntungan implementasi sistem manajemen inventaris dan aset digital</p>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-6">
					<div class="benefit-item d-flex mb-4 p-3 border rounded shadow-sm bg-white">
						<div class="icon flex-shrink-0">
							<i class="fas fa-search-dollar fa-2x text-primary"></i>
						</div>
						<div class="content ms-4">
							<h4>Transparansi Pengelolaan</h4>
							<p class="mb-0">Setiap transaksi dan pergerakan aset tercatat rapi dan dapat diakses oleh pihak yang berwenang</p>
						</div>
					</div>

					<div class="benefit-item d-flex mb-4 p-3 border rounded shadow-sm bg-white">
						<div class="icon flex-shrink-0">
							<i class="fas fa-chart-line fa-2x text-primary"></i>
						</div>
						<div class="content ms-4">
							<h4>Efisiensi Operasional</h4>
							<p class="mb-0">Mengurangi waktu pencarian aset dan mempermudah proses inventarisasi tahunan</p>
						</div>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="benefit-item d-flex mb-4 p-3 border rounded shadow-sm bg-white">
						<div class="icon flex-shrink-0">
							<i class="fas fa-shield-alt fa-2x text-primary"></i>
						</div>
						<div class="content ms-4">
							<h4>Pengamanan Aset</h4>
							<p class="mb-0">Meminimalisir resiko kehilangan dan penyalahgunaan aset desa</p>
						</div>
					</div>

					<div class="benefit-item d-flex mb-4 p-3 border rounded shadow-sm bg-white">
						<div class="icon flex-shrink-0">
							<i class="fas fa-file-invoice-dollar fa-2x text-primary"></i>
						</div>
						<div class="content ms-4">
							<h4>Akuntabilitas Keuangan</h4>
							<p class="mb-0">Laporan keuangan yang akurat terkait nilai dan penyusutan aset</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	{{-- main content end --}}
@endsection
