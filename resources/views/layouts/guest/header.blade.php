<header class="header">
    <div class="navbar-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">

                    <nav class="navbar navbar-expand-lg">

                        {{-- LOGO --}}
                        <a href="{{ route('dashboard') }}" class="navbar-brand mx-auto text-center">
                            <img src="{{ asset('assets-guest/images/logo1.png') }}" alt="Logo" height="100">
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
                                <ul class="navbar-nav d-flex align-items-center nav-icon-style">

                                    <li class="nav-item">
                                        <a href="{{ route('dashboard') }}"
                                            class="nav-link nav-icon {{ request()->is('dashboard') ? 'active' : '' }}">
                                            <i class="fas fa-info-circle"></i>
                                            <span>Tentang</span>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ route('warga.index') }}"
                                            class="nav-link nav-icon {{ request()->is('warga*') ? 'active' : '' }}">
                                            <i class="fas fa-users"></i>
                                            <span>Warga</span>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ route('user.index') }}"
                                            class="nav-link nav-icon {{ request()->is('user*') ? 'active' : '' }}">
                                            <i class="fas fa-user-shield"></i>
                                            <span>User</span>
                                        </a>
                                    </li>

                                    <li class="nav-item dropdown">
                                        <a class="nav-link nav-icon dropdown-toggle {{ request()->is('posyandu*') ? 'active' : '' }}"
                                            href="#" data-bs-toggle="dropdown">
                                            <i class="fas fa-clinic-medical"></i>
                                            <span>Posyandu</span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="{{ route('posyandu.index') }}">Data
                                                    Posyandu</a></li>
                                            <li><a class="dropdown-item" href="{{ route('posyandu.create') }}">Tambah
                                                    Posyandu</a></li>
                                        </ul>
                                    </li>

                                    <li class="nav-item dropdown">
                                        <a class="nav-link nav-icon dropdown-toggle {{ request()->is('kader-posyandu*') ? 'active' : '' }}"
                                            href="#" data-bs-toggle="dropdown">
                                            <i class="fas fa-user-nurse"></i>
                                            <span>Kader</span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item"
                                                    href="{{ route('kader-posyandu.index') }}">Data Kader</a></li>
                                            <li><a class="dropdown-item"
                                                    href="{{ route('kader-posyandu.create') }}">Tambah Kader</a></li>
                                        </ul>
                                    </li>

                                    <li class="nav-item dropdown">
                                        <a class="nav-link nav-icon dropdown-toggle {{ request()->is('jadwal-posyandu*') ? 'active' : '' }}"
                                            href="#" data-bs-toggle="dropdown">
                                            <i class="fas fa-calendar-alt"></i>
                                            <span>Jadwal</span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item"
                                                    href="{{ route('jadwal-posyandu.index') }}">Data Jadwal</a></li>
                                            <li><a class="dropdown-item"
                                                    href="{{ route('jadwal-posyandu.create') }}">Tambah Jadwal</a></li>
                                        </ul>
                                    </li>

                                    <li class="nav-item dropdown">
                                        <a class="nav-link nav-icon dropdown-toggle {{ request()->is('catatan-imunisasi*') ? 'active' : '' }}"
                                            href="#" data-bs-toggle="dropdown">
                                            <i class="fas fa-syringe"></i>
                                            <span>Imunisasi</span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item"
                                                    href="{{ route('catatan-imunisasi.index') }}">Data Imunisasi</a>
                                            </li>
                                            <li><a class="dropdown-item"
                                                    href="{{ route('catatan-imunisasi.create') }}">Tambah Imunisasi</a>
                                            </li>
                                        </ul>
                                    </li>

                                </ul>


                                {{-- ========================== --}}
                                {{-- PROFILE DROPDOWN --}}
                                {{-- ========================== --}}
                                @if (session('login'))
                                    @php
                                        $user = \App\Models\User::find(session('user_id'));

                                        $photoPath = asset('assets-guest/images/placeholder-aset.png');

                                        if (
                                            $user &&
                                            $user->profile_photo &&
                                            file_exists(public_path('storage/' . $user->profile_photo))
                                        ) {
                                            $photoPath = asset('storage/' . $user->profile_photo);
                                        }
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
