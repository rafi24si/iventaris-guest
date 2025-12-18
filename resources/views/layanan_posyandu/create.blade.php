@extends('layouts.guest.app')

@section('content')

    {{-- HEADER --}}
    <section class="pt-80 pb-60" style="background:linear-gradient(135deg,#1e8449,#27ae60);">
        <div class="container text-white">
            <h2 class="fw-bold mb-2">
                <i class="fas fa-notes-medical me-2"></i>
                Tambah Layanan Posyandu
            </h2>
            <p class="mb-0">Input data pelayanan kesehatan warga</p>
        </div>
    </section>

    {{-- CONTENT --}}
    <section class="pt-60 pb-100" style="background:#f0fdf4;">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-8">

                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body p-4">

                            {{-- ERROR --}}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $err)
                                            <li>{{ $err }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('layanan-posyandu.store') }}">
                                @csrf

                                {{-- JADWAL --}}
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        <i class="fas fa-calendar-alt me-1 text-success"></i>
                                        Jadwal Posyandu
                                    </label>
                                    <select name="jadwal_id" class="form-select" required>
                                        <option value="">-- Pilih Jadwal --</option>
                                        @foreach ($jadwals as $j)
                                            <option value="{{ $j->jadwal_id }}"
                                                {{ old('jadwal_id') == $j->jadwal_id ? 'selected' : '' }}>
                                                {{ $j->tanggal->format('d M Y') }}
                                                - {{ $j->posyandu->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- WARGA --}}
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        <i class="fas fa-user me-1 text-success"></i>
                                        Warga
                                    </label>
                                    <select name="warga_id" class="form-select" required>
                                        <option value="">-- Pilih Warga --</option>
                                        @foreach ($warga as $w)
                                            <option value="{{ $w->warga_id }}"
                                                {{ old('warga_id') == $w->warga_id ? 'selected' : '' }}>
                                                {{ $w->nama }} - {{ $w->no_ktp }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- BERAT --}}
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        <i class="fas fa-weight me-1 text-success"></i>
                                        Berat Badan (kg)
                                    </label>
                                    <input type="number" step="0.1" name="berat" class="form-control"
                                        value="{{ old('berat') }}" placeholder="Contoh: 12.5">
                                </div>

                                {{-- TINGGI --}}
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        <i class="fas fa-ruler-vertical me-1 text-success"></i>
                                        Tinggi Badan (cm)
                                    </label>
                                    <input type="number" step="0.1" name="tinggi" class="form-control"
                                        value="{{ old('tinggi') }}" placeholder="Contoh: 85">
                                </div>

                                {{-- VITAMIN --}}
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        <i class="fas fa-capsules me-1 text-success"></i>
                                        Vitamin
                                    </label>
                                    <select name="vitamin" class="form-select">
                                        <option value="">-- Pilih Vitamin --</option>

                                        <option value="Vitamin A" {{ old('vitamin') == 'Vitamin A' ? 'selected' : '' }}>
                                            Vitamin A
                                        </option>

                                        <option value="Tablet Tambah Darah"
                                            {{ old('vitamin') == 'Tablet Tambah Darah' ? 'selected' : '' }}>
                                            Tablet Tambah Darah
                                        </option>

                                        <option value="Vitamin C" {{ old('vitamin') == 'Vitamin C' ? 'selected' : '' }}>
                                            Vitamin C
                                        </option>

                                        <option value="Vitamin D" {{ old('vitamin') == 'Vitamin D' ? 'selected' : '' }}>
                                            Vitamin D
                                        </option>

                                        <option value="Vitamin B Kompleks"
                                            {{ old('vitamin') == 'Vitamin B Kompleks' ? 'selected' : '' }}>
                                            Vitamin B Kompleks
                                        </option>

                                        <option value="Zinc" {{ old('vitamin') == 'Zinc' ? 'selected' : '' }}>
                                            Zinc
                                        </option>

                                        <option value="Kalsium" {{ old('vitamin') == 'Kalsium' ? 'selected' : '' }}>
                                            Kalsium
                                        </option>

                                        <option value="Asam Folat" {{ old('vitamin') == 'Asam Folat' ? 'selected' : '' }}>
                                            Asam Folat
                                        </option>

                                        <option value="PMT (Pemberian Makanan Tambahan)"
                                            {{ old('vitamin') == 'PMT (Pemberian Makanan Tambahan)' ? 'selected' : '' }}>
                                            PMT (Pemberian Makanan Tambahan)
                                        </option>

                                        <option value="Lainnya" {{ old('vitamin') == 'Lainnya' ? 'selected' : '' }}>
                                            Lainnya
                                        </option>
                                    </select>
                                </div>


                                {{-- KONSELING --}}
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">
                                        <i class="fas fa-comments me-1 text-success"></i>
                                        Konseling
                                    </label>
                                    <textarea name="konseling" class="form-control" rows="4" placeholder="Catatan konseling">{{ old('konseling') }}</textarea>
                                </div>

                                {{-- ACTION --}}
                                <div class="d-flex gap-2">
                                    <button class="btn btn-success px-4">
                                        <i class="fas fa-save me-1"></i> Simpan
                                    </button>

                                    <a href="{{ route('layanan-posyandu.index') }}" class="btn btn-secondary px-4">
                                        <i class="fas fa-arrow-left me-1"></i> Kembali
                                    </a>
                                </div>

                            </form>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

@endsection
