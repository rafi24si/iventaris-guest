@extends('layouts.guest.app')

@section('content')
    <section class="pt-120 pb-80">
        <div class="container">

            {{-- TITLE --}}
            <div class="section-title text-center mb-50">
                <h2>Data User Sistem</h2>
                <p>Manajemen pengguna sistem</p>
            </div>

            {{-- FILTER & SEARCH --}}
            <form method="GET" action="{{ route('user.index') }}">
                <div class="row mb-4 align-items-end">

                    <div class="col-md-3">
                        <a href="{{ route('user.create') }}" class="main-btn btn-hover btn-sm">
                            <i class="fas fa-user-plus me-1"></i> Tambah User
                        </a>
                    </div>

                    <div class="col-md-3">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama / email..."
                            value="{{ request('search') }}">
                    </div>

                    <div class="col-md-3">
                        <select name="role" class="form-select">
                            <option value="">Semua Role</option>
                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="petugas" {{ request('role') == 'petugas' ? 'selected' : '' }}>Petugas</option>
                            <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select name="email_verified_at" class="form-select">
                            <option value="">Status Email</option>
                            <option value="verified" {{ request('email_verified_at') == 'verified' ? 'selected' : '' }}>
                                Terverifikasi
                            </option>
                            <option value="unverified" {{ request('email_verified_at') == 'unverified' ? 'selected' : '' }}>
                                Belum Verifikasi
                            </option>
                        </select>
                    </div>

                    <div class="col-12 mt-2 text-end">
                        <button class="btn btn-primary btn-sm">
                            <i class="fas fa-search"></i> Cari
                        </button>
                        <a href="{{ route('user.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-sync"></i> Reset
                        </a>
                    </div>

                </div>
            </form>

            {{-- CARD LIST --}}
            <div class="row">

                @forelse ($dataUser as $user)
                    <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
                        <div class="card warga-card">

                            {{-- HEADER --}}
                            <div class="warga-header text-center">
                                <img src="{{ $user->getPhotoUrl() }}" class="rounded-circle mb-3"
                                    style="width:90px;height:90px;object-fit:cover;">

                                <h5 class="mb-1">{{ $user->name }}</h5>
                                <p class="opacity-75 mb-0">{{ $user->email }}</p>

                                <span class="badge bg-info text-uppercase mt-2">
                                    <i class="fas fa-user-shield me-1"></i>
                                    {{ $user->role ?? 'user' }}
                                </span>
                            </div>

                            {{-- INFO --}}
                            <div class="warga-info">

                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                    <div class="info-content">
                                        <strong>Bergabung</strong><br>
                                        {{ $user->created_at->format('d M Y') }}
                                    </div>
                                </div>

                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-envelope-circle-check"></i>
                                    </div>
                                    <div class="info-content">
                                        <strong>Status Email</strong><br>
                                        @if ($user->email_verified_at)
                                            <span class="text-success">Terverifikasi</span>
                                        @else
                                            <span class="text-danger">Belum Verifikasi</span>
                                        @endif
                                    </div>
                                </div>

                            </div>

                            {{-- ACTION BUTTON --}}
                            <div class="action-buttons mt-3">
                                <div class="row g-2">

                                    <div class="col-12">
                                        <a href="{{ route('user.show', $user->id) }}"
                                            class="btn btn-info btn-sm w-100 text-white">
                                            <i class="fas fa-eye me-1"></i> Detail
                                        </a>
                                    </div>

                                    <div class="col-6">
                                        <a href="{{ route('user.edit', $user->id) }}"
                                            class="btn btn-warning btn-sm w-100 text-white">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </a>
                                    </div>

                                    <div class="col-6">
                                        <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin hapus user {{ $user->name }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm w-100">
                                                <i class="fas fa-trash me-1"></i> Hapus
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted">
                        <h4>Belum ada data user</h4>
                    </div>
                @endforelse

            </div>

            {{-- PAGINATION --}}
            <div class="mt-3">
                {{ $dataUser->links('pagination::bootstrap-5') }}
            </div>

        </div>

        {{-- FONT AWESOME --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    </section>
@endsection
