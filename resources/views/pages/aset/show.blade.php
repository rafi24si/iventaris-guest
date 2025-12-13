@extends('layouts.guest.app')

@section('content')
<section class="pt-120 pb-80">
    <div class="container-custom">

        {{-- TITLE --}}
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="section-title text-center">
                    <h2>Detail Aset</h2>
                    <p>Informasi lengkap aset <strong>{{ $aset->nama_aset }}</strong></p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">

                <div class="card shadow-sm">

                    {{-- HEADER --}}
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-box me-2"></i> {{ $aset->nama_aset }}
                        </h5>
                    </div>

                    <div class="card-body p-4">

                        <div class="row">

                            {{-- FOTO ASET --}}
                            <div class="col-md-5 text-center">
                                @php
                                    $foto = optional($aset->media->first())->file_name;
                                @endphp

                                <img src="{{ $foto ? asset('storage/'.$foto) : 'https://via.placeholder.com/400x250?text=Tidak+Ada+Foto' }}"
                                     class="img-fluid rounded mb-3"
                                     style="max-height:250px;object-fit:cover;">
                            </div>

                            {{-- DETAIL --}}
                            <div class="col-md-7">
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="40%">Kode Aset</th>
                                        <td>{{ $aset->kode_aset }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Aset</th>
                                        <td>{{ $aset->nama_aset }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kategori</th>
                                        <td>{{ $aset->kategoriAset->nama ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Perolehan</th>
                                        <td>{{ \Carbon\Carbon::parse($aset->tgl_perolehan)->format('d M Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nilai Perolehan</th>
                                        <td>Rp {{ number_format($aset->nilai_perolehan,0,',','.') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kondisi</th>
                                        <td>
                                            <span class="badge bg-info">
                                                {{ $aset->kondisi }}
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                        </div>

                        {{-- BUTTON --}}
                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('aset.index') }}" class="main-btn border-btn me-2">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>

                            <a href="{{ route('aset.edit', $aset->aset_id) }}"
                               class="main-btn btn-hover">
                                <i class="fas fa-edit me-1"></i> Edit Aset
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
</section>
@endsection
