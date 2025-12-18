@extends('layouts.guest.app')

@section('content')
    {{-- HEADER --}}
    <section class="pt-80 pb-60" style="background:linear-gradient(135deg,#1e8449,#27ae60);">
        <div class="container text-white">
            <h2 class="fw-bold mb-2">
                <i class="fas fa-syringe me-2"></i>
                Tambah Catatan Imunisasi
            </h2>
            <p class="mb-0">Input data imunisasi warga secara lengkap dan akurat</p>
        </div>
    </section>

    {{-- CONTENT --}}
    <section class="pt-60 pb-100" style="background:#f0fdf4;">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-8">

                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">

                            <form method="POST" action="{{ route('catatan-imunisasi.store') }}"
                                enctype="multipart/form-data">
                                @csrf

                                {{-- WARGA --}}
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        <i class="fas fa-user me-1 text-success"></i>
                                        Warga
                                    </label>
                                    <select name="warga_id" class="form-select @error('warga_id') is-invalid @enderror"
                                        required>
                                        <option value="">-- Pilih Warga --</option>
                                        @foreach ($wargas as $w)
                                            <option value="{{ $w->warga_id }}"
                                                {{ old('warga_id') == $w->warga_id ? 'selected' : '' }}>
                                                {{ $w->nama }} ({{ $w->no_ktp }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('warga_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- JENIS VAKSIN --}}
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        <i class="fas fa-syringe me-1 text-success"></i>
                                        Jenis Vaksin
                                    </label>

                                    <select name="jenis_vaksin"
                                        class="form-select @error('jenis_vaksin') is-invalid @enderror" required>
                                        <option value="">-- Pilih Jenis Vaksin --</option>

                                        @php
                                            $vaksins = [
                                                'BCG',
                                                'Polio 1',
                                                'Polio 2',
                                                'Polio 3',
                                                'Polio 4',
                                                'DPT 1',
                                                'DPT 2',
                                                'DPT 3',
                                                'Campak',
                                                'MR (Measles Rubella)',
                                                'Hepatitis B',
                                                'Hib',
                                                'PCV',
                                                'Rotavirus',
                                                'Lainnya',
                                            ];
                                        @endphp

                                        @foreach ($vaksins as $vaksin)
                                            <option value="{{ $vaksin }}"
                                                {{ old('jenis_vaksin') == $vaksin ? 'selected' : '' }}>
                                                {{ $vaksin }}
                                            </option>
                                        @endforeach
                                    </select>

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
                                    <input type="date" name="tanggal"
                                        class="form-control @error('tanggal') is-invalid @enderror"
                                        value="{{ old('tanggal') }}" required>
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

                                    <select name="lokasi" class="form-select">
                                        <option value="">-- Pilih Lokasi --</option>

                                        <option value="Posyandu" {{ old('lokasi') == 'Posyandu' ? 'selected' : '' }}>
                                            Posyandu
                                        </option>

                                        <option value="Puskesmas" {{ old('lokasi') == 'Puskesmas' ? 'selected' : '' }}>
                                            Puskesmas
                                        </option>
                                    </select>
                                </div>


                                {{-- NAKES --}}
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        <i class="fas fa-user-md me-1 text-success"></i>
                                        Tenaga Kesehatan
                                    </label>
                                    <input type="text" name="nakes" class="form-control" value="{{ old('nakes') }}"
                                        placeholder="Nama bidan / perawat">
                                </div>

                                {{-- KARTU IMUNISASI --}}
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">
                                        <i class="fas fa-image me-1 text-success"></i>
                                        Kartu Imunisasi (Opsional)
                                    </label>
                                    <input type="file" name="kartu" class="form-control" accept="image/*">
                                    <small class="text-muted">
                                        Format JPG/PNG, maksimal 2MB
                                    </small>
                                </div>

                                {{-- ACTION --}}
                                <div class="d-flex gap-2 justify-content-end">
                                    <a href="{{ route('catatan-imunisasi.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left me-1"></i>
                                        Kembali
                                    </a>

                                    <button class="btn btn-success">
                                        <i class="fas fa-save me-1"></i>
                                        Simpan Imunisasi
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
