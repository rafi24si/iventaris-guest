@extends('layouts.guest.app')

@section('content')

{{-- HEADER --}}
<section class="pt-80 pb-60"
    style="background:linear-gradient(135deg,#1e8449,#27ae60);">
    <div class="container text-white">
        <h2 class="fw-bold mb-2">
            <i class="fas fa-syringe me-2"></i>
            Edit Catatan Imunisasi
        </h2>
        <p class="mb-0">Perbarui data imunisasi warga</p>
    </div>
</section>

{{-- CONTENT --}}
<section class="pt-60 pb-100" style="background:#f0fdf4;">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">

                        <form method="POST"
                              action="{{ route('catatan-imunisasi.update', $imunisasi->imunisasi_id) }}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- WARGA --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-user me-1 text-success"></i>
                                    Warga
                                </label>
                                <select class="form-select" disabled>
                                    <option>
                                        {{ $imunisasi->warga->nama }} ({{ $imunisasi->warga->no_ktp }})
                                    </option>
                                </select>
                                <small class="text-muted">
                                    Warga tidak dapat diubah
                                </small>
                            </div>

                            {{-- JENIS VAKSIN --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-syringe me-1 text-success"></i>
                                    Jenis Vaksin
                                </label>
                                <input type="text"
                                       name="jenis_vaksin"
                                       class="form-control @error('jenis_vaksin') is-invalid @enderror"
                                       value="{{ old('jenis_vaksin', $imunisasi->jenis_vaksin) }}"
                                       required>
                                @error('jenis_vaksin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- TANGGAL --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-calendar-day me-1 text-success"></i>
                                    Tanggal Imunisasi
                                </label>
                                <input type="date"
                                       name="tanggal"
                                       class="form-control @error('tanggal') is-invalid @enderror"
                                       value="{{ old('tanggal', $imunisasi->tanggal->format('Y-m-d')) }}"
                                       required>
                                @error('tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- LOKASI --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-map-marker-alt me-1 text-success"></i>
                                    Lokasi
                                </label>
                                <input type="text"
                                       name="lokasi"
                                       class="form-control"
                                       value="{{ old('lokasi', $imunisasi->lokasi) }}">
                            </div>

                            {{-- NAKES --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-user-md me-1 text-success"></i>
                                    Tenaga Kesehatan
                                </label>
                                <input type="text"
                                       name="nakes"
                                       class="form-control"
                                       value="{{ old('nakes', $imunisasi->nakes) }}">
                            </div>

                            {{-- KARTU IMUNISASI --}}
                            <div class="mb-4">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-image me-1 text-success"></i>
                                    Ganti Kartu Imunisasi (Opsional)
                                </label>

                                @if($imunisasi->media->first())
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/catatan_imunisasi/'.$imunisasi->media->first()->file_name) }}"
                                             class="img-fluid rounded shadow"
                                             style="max-height:200px">
                                    </div>
                                @endif

                                <input type="file"
                                       name="kartu"
                                       class="form-control"
                                       accept="image/*">
                                <small class="text-muted">
                                    Upload jika ingin mengganti kartu
                                </small>
                            </div>

                            {{-- ACTION --}}
                            <div class="d-flex gap-2 justify-content-end">
                                <a href="{{ route('catatan-imunisasi.index') }}"
                                   class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i>
                                    Kembali
                                </a>

                                <button class="btn btn-success">
                                    <i class="fas fa-save me-1"></i>
                                    Simpan Perubahan
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>
</section>

@endsection
