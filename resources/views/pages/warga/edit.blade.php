@extends('layouts.guest.app')

@section('content')
	<!-- Main content start -->
	<section id="form-warga" class="cta-section pt-130 pb-100">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section-title text-center mb-50">
						<h2 class="mb-20">Edit Data Warga</h2>
						<p class="mb-30">Ubah data warga sesuai dengan informasi terbaru</p>
					</div>
				</div>
			</div>

			<div class="row justify-content-center">
				<div class="col-lg-8">
					<div class="card shadow-sm">
						<div class="card-body p-5">
							<form action="{{ route('warga.update', $dataWarga->warga_id) }}" method="POST">
								@method('PUT')
								@csrf
								<div class="row">
									<div class="col-md-6">
										<div class="mb-3">
											<label for="no_ktp" class="form-label">No KTP *</label>
											<input type="text" id="no_ktp" name="no_ktp" class="form-control" value="{{ $dataWarga->no_ktp }}" required>
										</div>

										<div class="mb-3">
											<label for="nama" class="form-label">Nama Lengkap *</label>
											<input type="text" id="nama" name="nama" class="form-control" value="{{ $dataWarga->nama }}" required>
										</div>

										<div class="mb-3">
											<label for="jenis_kelamin" class="form-label">Jenis Kelamin *</label>
											<select id="jenis_kelamin" name="jenis_kelamin" class="form-select" required>
												<option value="">-- Pilih --</option>
												<option value="Laki-laki" {{ $dataWarga->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
												<option value="Perempuan" {{ $dataWarga->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
											</select>
										</div>
									</div>

									<div class="col-md-6">
										<div class="mb-3">
											<label for="agama" class="form-label">Agama *</label>
											<select id="agama" name="agama" class="form-select" required>
												<option value="">-- Pilih --</option>
												<option value="Islam" {{ $dataWarga->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
												<option value="Kristen" {{ $dataWarga->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
												<option value="Katolik" {{ $dataWarga->agama == 'Katolik' ? 'selected' : '' }}>Katolik</option>
												<option value="Hindu" {{ $dataWarga->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
												<option value="Buddha" {{ $dataWarga->agama == 'Buddha' ? 'selected' : '' }}>Buddha</option>
												<option value="Konghucu" {{ $dataWarga->agama == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
											</select>
										</div>

										<div class="mb-3">
											<label for="pekerjaan" class="form-label">Pekerjaan</label>
											<input type="text" id="pekerjaan" name="pekerjaan" class="form-control" value="{{ $dataWarga->pekerjaan }}">
										</div>

										<div class="mb-3">
											<label for="telp" class="form-label">No Telepon</label>
											<input type="text" id="telp" name="telp" class="form-control" value="{{ $dataWarga->telp }}">
										</div>

										<div class="mb-3">
											<label for="email" class="form-label">Email</label>
											<input type="email" id="email" name="email" class="form-control" value="{{ $dataWarga->email }}">
										</div>
									</div>
								</div>

								<div class="row mt-4">
									<div class="col-12 text-center">
										<button type="submit" class="btn btn-primary btn-sm">Update Data</button>
										<a href="{{ route('warga.index') }}" class="btn btn-secondary btn-sm">Batal</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- main content end -->
@endsection
