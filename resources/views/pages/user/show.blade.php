@extends('layouts.guest.app')

@section('content')
<!-- main content start -->
<section class="cta-section pt-130 pb-100">
    <div class="container">

        {{-- JUDUL --}}
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center mb-50">
                    <h2 class="mb-20">Detail User</h2>
                    <p class="mb-30">Informasi lengkap data user</p>
                </div>
            </div>
        </div>

        {{-- CARD --}}
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-body p-5">

                        {{-- FOTO --}}
                        <div class="text-center mb-4">
                            <img src="{{ $user->getPhotoUrl() }}"
                                 class="rounded-circle mb-3"
                                 style="width:130px;height:130px;object-fit:cover;">
                            <h4 class="mb-0">{{ $user->name }}</h4>
                            <span class="badge bg-info text-uppercase mt-2">
                                {{ $user->role ?? 'user' }}
                            </span>
                        </div>

                        <hr>

                        {{-- DETAIL --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <strong>Email</strong>
                                <p class="mb-0">{{ $user->email }}</p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>Status Email</strong>
                                <p class="mb-0">
                                    @if ($user->email_verified_at)
                                        <span class="badge bg-success">Terverifikasi</span>
                                    @else
                                        <span class="badge bg-warning">Belum Verifikasi</span>
                                    @endif
                                </p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>Bergabung Sejak</strong>
                                <p class="mb-0">
                                    {{ $user->created_at->format('d M Y') }}
                                </p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>Terakhir Update</strong>
                                <p class="mb-0">
                                    {{ $user->updated_at->format('d M Y') }}
                                </p>
                            </div>
                        </div>

                        {{-- BUTTON --}}
                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('user.index') }}" class="main-btn border-btn me-3">
                                <i class="bi bi-arrow-left me-1"></i> Kembali
                            </a>

                            <a href="{{ route('user.edit', $user->id) }}" class="main-btn btn-hover">
                                <i class="bi bi-pencil-square me-1"></i> Edit User
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- main content end -->
@endsection
