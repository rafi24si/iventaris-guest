@extends('layouts.guest.app')

@section('content')

{{-- HEADER --}}
<section class="pt-80 pb-60"
    style="background: linear-gradient(135deg,#1e8449,#27ae60);">
    <div class="container text-white d-flex justify-content-between align-items-center">
        <div>
            <h2 class="fw-bold mb-2">
                <i class="fas fa-users me-2"></i>
                Data User Sistem
            </h2>
            <p class="mb-0">Manajemen pengguna sistem</p>
        </div>

        <a href="{{ route('user.create') }}" class="btn btn-light fw-semibold">
            <i class="fas fa-user-plus text-success me-1"></i> Tambah User
        </a>
    </div>
</section>

{{-- CONTENT --}}
<section class="pt-60 pb-100" style="background:#f0fdf4;">
    <div class="container">

        {{-- FILTER --}}
        <form method="GET" action="{{ route('user.index') }}" class="row g-2 mb-4">

            <div class="col-md-4">
                <input type="text" name="search" class="form-control"
                       placeholder="Cari nama / email"
                       value="{{ request('search') }}">
            </div>

            <div class="col-md-3">
                <select name="role" class="form-select">
                    <option value="">Semua Role</option>
                    <option value="admin" {{ request('role')=='admin'?'selected':'' }}>Admin</option>
                    <option value="petugas" {{ request('role')=='petugas'?'selected':'' }}>Petugas</option>
                    <option value="user" {{ request('role')=='user'?'selected':'' }}>User</option>
                </select>
            </div>

            <div class="col-md-3">
                <select name="email_verified_at" class="form-select">
                    <option value="">Status Email</option>
                    <option value="verified" {{ request('email_verified_at')=='verified'?'selected':'' }}>
                        Terverifikasi
                    </option>
                    <option value="unverified" {{ request('email_verified_at')=='unverified'?'selected':'' }}>
                        Belum Verifikasi
                    </option>
                </select>
            </div>

            <div class="col-md-2 d-grid">
                <button class="btn btn-success">
                    <i class="fas fa-filter me-1"></i> Filter
                </button>
            </div>

        </form>

        {{-- CARD LIST --}}
        <div class="row g-4">

            @forelse ($dataUser as $user)
            <div class="col-xl-4 col-lg-6 col-md-6">

                <div class="card user-card h-100 border-0 shadow-sm">

                    {{-- HEADER --}}
                    <div class="user-header text-center">
                        <img src="{{ $user->getPhotoUrl() }}"
                             class="rounded-circle mb-3 user-avatar">

                        <h5 class="mb-1 fw-bold">{{ $user->name }}</h5>
                        <p class="small opacity-75 mb-1">{{ $user->email }}</p>

                        <span class="badge bg-success text-uppercase">
                            <i class="fas fa-user-shield me-1"></i>
                            {{ $user->role ?? 'user' }}
                        </span>
                    </div>

                    {{-- INFO --}}
                    <div class="card-body pt-3">

                        <div class="info-row">
                            <i class="fas fa-calendar-alt text-success"></i>
                            <div>
                                <strong>Bergabung</strong><br>
                                {{ $user->created_at->format('d M Y') }}
                            </div>
                        </div>

                        <div class="info-row">
                            <i class="fas fa-envelope-circle-check text-success"></i>
                            <div>
                                <strong>Status Email</strong><br>
                                @if($user->email_verified_at)
                                    <span class="text-success">Terverifikasi</span>
                                @else
                                    <span class="text-danger">Belum Verifikasi</span>
                                @endif
                            </div>
                        </div>

                    </div>

                    {{-- ACTION --}}
                    <div class="card-footer bg-white border-0 px-3 pb-3">
                        <div class="d-flex gap-2">

                            <a href="{{ route('user.show',$user->id) }}"
                               class="btn btn-sm btn-outline-success w-100">
                                <i class="fas fa-eye me-1"></i> Detail
                            </a>

                            <a href="{{ route('user.edit',$user->id) }}"
                               class="btn btn-sm btn-outline-primary w-100">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>

                            <form method="POST"
                                  action="{{ route('user.destroy',$user->id) }}"
                                  onsubmit="return confirm('Hapus user {{ $user->name }}?')"
                                  class="w-100">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger w-100">
                                    <i class="fas fa-trash me-1"></i> Hapus
                                </button>
                            </form>

                        </div>
                    </div>

                </div>

            </div>
            @empty
                <div class="col-12 text-center text-muted py-5">
                    <i class="fas fa-users fa-3x mb-3"></i>
                    <h5>Belum ada data user</h5>
                </div>
            @endforelse

        </div>

        {{-- PAGINATION --}}
        <div class="mt-5 d-flex justify-content-center">
            {{ $dataUser->links('pagination::bootstrap-5') }}
        </div>

    </div>
</section>

{{-- STYLE --}}
<style>
.user-card {
    border-top: 5px solid #27ae60;
    border-radius: 14px;
    transition: all .35s ease;
}

.user-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,.15);
}

.user-header {
    background: linear-gradient(135deg,#1e8449,#27ae60);
    color: white;
    padding: 30px 20px;
    border-top-left-radius: 14px;
    border-top-right-radius: 14px;
}

.user-avatar {
    width: 90px;
    height: 90px;
    object-fit: cover;
    border: 3px solid #fff;
}

.info-row {
    display: flex;
    gap: 12px;
    margin-bottom: 12px;
    font-size: 14px;
}
</style>

@endsection
