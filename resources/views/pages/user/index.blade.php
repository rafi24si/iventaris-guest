@extends('layouts.guest.app')

@section('content')
<section class="pt-120 pb-80">
    <div class="container">

        {{-- JUDUL --}}
        <div class="mb-4">
            <h2 class="fw-bold">Data User Sistem</h2>
            <p class="text-muted">Manajemen pengguna sistem</p>
        </div>

        {{-- ACTION BAR : SEARCH & FILTER --}}
        <div class="row mb-4">
            <div class="col-12">
                <form method="GET" action="{{ route('user.index') }}">
                    <div class="row g-2 align-items-end">

                        {{-- SEARCH --}}
                        <div class="col-md-4">
                            <label class="form-label small">Cari User</label>
                            <input type="text"
                                name="search"
                                class="form-control form-control-sm"
                                placeholder="Nama atau email..."
                                value="{{ request('search') }}">
                        </div>

                        {{-- FILTER ROLE --}}
                        <div class="col-md-3">
                            <label class="form-label small">Role</label>
                            <select name="role" class="form-select form-select-sm">
                                <option value="">Semua Role</option>
                                <option value="admin" {{ request('role')=='admin'?'selected':'' }}>Admin</option>
                                <option value="petugas" {{ request('role')=='petugas'?'selected':'' }}>Petugas</option>
                                <option value="user" {{ request('role')=='user'?'selected':'' }}>User</option>
                            </select>
                        </div>

                        {{-- FILTER EMAIL VERIFIED --}}
                        <div class="col-md-3">
                            <label class="form-label small">Status Email</label>
                            <select name="email_verified_at" class="form-select form-select-sm">
                                <option value="">Semua</option>
                                <option value="verified" {{ request('email_verified_at')=='verified'?'selected':'' }}>
                                    Terverifikasi
                                </option>
                                <option value="unverified" {{ request('email_verified_at')=='unverified'?'selected':'' }}>
                                    Belum Verifikasi
                                </option>
                            </select>
                        </div>

                        {{-- BUTTON --}}
                        <div class="col-md-2 d-flex gap-1">
                            <button type="submit" class="btn btn-primary btn-sm w-100">
                                <i class="fas fa-search"></i>
                            </button>
                            <a href="{{ route('user.index') }}" class="btn btn-secondary btn-sm w-100">
                                <i class="fas fa-sync"></i>
                            </a>
                        </div>

                    </div>
                </form>
            </div>
        </div>

        {{-- BUTTON TAMBAH USER --}}
        <div class="mb-3">
            <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah User
            </a>
        </div>

        {{-- TABLE --}}
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="5%">#</th>
                        <th width="10%">Foto</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th width="10%">Role</th>
                        <th width="20%" class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($dataUser as $index => $user)
                        <tr>
                            <td>{{ $dataUser->firstItem() + $index }}</td>

                            {{-- FOTO --}}
                            <td class="text-center">
                                <img src="{{ $user->getPhotoUrl() }}"
                                     class="rounded-circle"
                                     style="width:45px;height:45px;object-fit:cover;">
                            </td>

                            {{-- NAMA --}}
                            <td>
                                <strong>{{ $user->name }}</strong><br>
                                <small class="text-muted">
                                    Bergabung {{ $user->created_at->format('d M Y') }}
                                </small>
                            </td>

                            {{-- EMAIL --}}
                            <td>{{ $user->email }}</td>

                            {{-- ROLE --}}
                            <td>
                                <span class="badge bg-info text-uppercase">
                                    {{ $user->role ?? 'user' }}
                                </span>
                            </td>

                            {{-- AKSI --}}
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">

                                    {{-- DETAIL --}}
                                    <a href="{{ route('user.show', $user->id) }}"
                                       class="btn btn-info btn-sm text-white"
                                       title="Detail User">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    {{-- EDIT --}}
                                    <a href="{{ route('user.edit', $user->id) }}"
                                       class="btn btn-warning btn-sm text-white"
                                       title="Edit User">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    {{-- HAPUS --}}
                                    <form action="{{ route('user.destroy', $user->id) }}"
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm"
                                            title="Hapus User"
                                            onclick="return confirm('Yakin hapus user {{ $user->name }}?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                Belum ada data user
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        <div class="mt-3">
            {{ $dataUser->links('pagination::bootstrap-5') }}
        </div>

    </div>

    {{-- FONT AWESOME --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</section>
@endsection
