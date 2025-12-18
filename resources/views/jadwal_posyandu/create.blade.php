@extends('layouts.guest.app')

@section('content')

{{-- HEADER --}}
<section class="pt-80 pb-60"
    style="background: linear-gradient(135deg,#1e8449,#27ae60);">
    <div class="container text-white">
        <h2 class="fw-bold mb-2">
            <i class="fas fa-calendar-plus me-2"></i>
            Tambah Jadwal Posyandu
        </h2>
        <p class="mb-0">Input jadwal kegiatan Posyandu Desa</p>
    </div>
</section>

{{-- CONTENT --}}
<section class="pt-60 pb-100" style="background:#f0fdf4;">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-lg-8">

                {{-- CARD --}}
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">

                        {{-- ERROR --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('jadwal-posyandu.store') }}"
                              method="POST"
                              enctype="multipart/form-data">
                            @csrf

                            {{-- POSYANDU --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-clinic-medical me-1 text-success"></i>
                                    Posyandu
                                </label>
                                <select name="posyandu_id"
                                        class="form-select"
                                        required>
                                    <option value="">-- Pilih Posyandu --</option>
                                    @foreach($posyandus as $p)
                                        <option value="{{ $p->posyandu_id }}"
                                            {{ old('posyandu_id')==$p->posyandu_id?'selected':'' }}>
                                            {{ $p->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- TANGGAL --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-calendar-day me-1 text-success"></i>
                                    Tanggal Kegiatan
                                </label>
                                <input type="date"
                                       name="tanggal"
                                       class="form-control"
                                       value="{{ old('tanggal') }}"
                                       required>
                            </div>

                            {{-- TEMA --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-tag me-1 text-success"></i>
                                    Tema Kegiatan
                                </label>
                                <input type="text"
                                       name="tema"
                                       class="form-control"
                                       placeholder="Contoh: Penimbangan Balita"
                                       value="{{ old('tema') }}"
                                       required>
                            </div>

                            {{-- KETERANGAN --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-align-left me-1 text-success"></i>
                                    Keterangan
                                </label>
                                <textarea name="keterangan"
                                          rows="4"
                                          class="form-control"
                                          placeholder="Keterangan tambahan (opsional)">{{ old('keterangan') }}</textarea>
                            </div>

                            {{-- POSTER --}}
                            <div class="mb-4">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-image me-1 text-success"></i>
                                    Poster Kegiatan
                                </label>
                                <input type="file"
                                       name="poster"
                                       class="form-control"
                                       accept="image/*"
                                       onchange="previewPoster(event)">
                                <small class="text-muted">Format JPG / PNG (max 2MB)</small>

                                {{-- PREVIEW --}}
                                <div class="mt-3 text-center">
                                    <img id="posterPreview"
                                         src="https://via.placeholder.com/600x350?text=Preview+Poster"
                                         class="img-fluid rounded shadow-sm"
                                         style="max-height:250px;">
                                </div>
                            </div>

                            {{-- ACTION --}}
                            <div class="d-flex gap-2">
                                <button class="btn btn-success px-4">
                                    <i class="fas fa-save me-1"></i> Simpan
                                </button>

                                <a href="{{ route('jadwal-posyandu.index') }}"
                                   class="btn btn-secondary px-4">
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

{{-- SCRIPT PREVIEW --}}
<script>
function previewPoster(event) {
    const reader = new FileReader();
    reader.onload = function(){
        document.getElementById('posterPreview').src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>

@endsection
