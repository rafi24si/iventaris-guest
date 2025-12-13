<header class="header">
    <div class="navbar-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">

                    <nav class="navbar navbar-expand-lg">

                        {{-- LOGO --}}
                        <a href="{{ route('dashboard') }}" class="navbar-brand mx-auto text-center">
                            <img src="{{ asset('assets-guest/images/logo/unnamed.png') }}" alt="Logo" height="45">
                        </a>

                        {{-- MOBILE BUTTON --}}
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                            <ul class="navbar-nav text-center">

                                {{-- MENU --}}
                                <li class="nav-item">
                                    <a href="{{ route('dashboard') }}"
                                        class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                                        Tentang
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('warga.index') }}"
                                        class="nav-link {{ request()->is('warga*') ? 'active' : '' }}">
                                        Warga
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('user.index') }}"
                                        class="nav-link {{ request()->is('user*') ? 'active' : '' }}">
                                        User
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('kategoriAset.index') }}"
                                        class="nav-link {{ request()->is('kategoriAset*') ? 'active' : '' }}">
                                        Kategori Aset
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('aset.index') }}"
                                        class="nav-link {{ request()->is('aset*') ? 'active' : '' }}">
                                        Aset
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('lokasi-aset.index') }}"
                                        class="nav-link {{ request()->is('lokasi-aset*') ? 'active' : '' }}">
                                        Lokasi Aset
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('pemeliharaan.index') }}"
                                        class="nav-link {{ request()->is('pemeliharaan*') ? 'active' : '' }}">
                                        Pemeliharaan
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('mutasi.index') }}"
                                        class="nav-link {{ request()->is('mutasi*') ? 'active' : '' }}">
                                        Mutasi
                                    </a>
                                </li>

                                {{-- ========================== --}}
                                {{-- PROFILE DROPDOWN --}}
                                {{-- ========================== --}}
                                @if (session('login'))
                                    @php
                                        $user = \App\Models\User::find(session('user_id'));

                                        $photoPath =
                                            $user &&
                                            $user->profile_photo &&
                                            file_exists(public_path('storage/' . $user->profile_photo))
                                                ? asset('storage/' . $user->profile_photo)
                                                : asset('assets-guest/images/default-avatar.png');
                                    @endphp

                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle d-flex align-items-center justify-content-center"
                                            role="button" data-bs-toggle="dropdown">

                                            <img src="{{ $photoPath }}" class="rounded-circle me-2" width="35"
                                                height="35" style="object-fit: cover;">

                                            <span>{{ session('user_name') }}</span>
                                        </a>

                                        <ul class="dropdown-menu dropdown-menu-end text-center">
                                            <li class="dropdown-header">
                                                <strong>{{ session('user_name') }}</strong><br>
                                                <small>Role: {{ session('user_role') }}</small>
                                            </li>

                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>

                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('user.show', session('user_id')) }}">
                                                    <i class="bi bi-person-circle me-2"></i> Profil Saya
                                                </a>
                                            </li>

                                            <li>
                                                <form action="{{ route('logout') }}" method="POST">
                                                    @csrf
                                                    <button class="dropdown-item text-danger">
                                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a href="{{ url('/auth') }}" class="nav-link">Login</a>
                                    </li>
                                @endif

                            </ul>
                        </div>

                    </nav>

                </div>
            </div>
        </div>
    </div>
</header>
