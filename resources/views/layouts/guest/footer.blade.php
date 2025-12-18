<footer class="footer pt-120 pb-40"
    style="
        background: linear-gradient(135deg, #1e8449, #27ae60);
        color: #ffffff;
    ">

    <div class="container">
        <div class="row">

            {{-- LOGO & DESKRIPSI --}}
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 mb-5">
                <div class="footer-widget">
                    <div class="logo mb-3">
                        <a href="{{ route('dashboard') }}">
                            <img src="{{ asset('assets-guest/images/logo1.png') }}"
                                 alt="logo" height="220" class="me-2">
                        </a>
                    </div>
                    <p style="opacity: .9;">
                        Sistem Informasi Posyandu Desa untuk mendukung
                        pelayanan kesehatan ibu dan anak secara digital,
                        terintegrasi, dan berkelanjutan.
                    </p>
                </div>
            </div>

            {{-- MENU --}}
            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 mb-5">
                <div class="footer-widget">
                    <h4 class="fw-bold mb-3 text-white">Menu</h4>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a class="footer-link" href="{{ route('dashboard') }}">
                                <i class="fas fa-home me-2"></i>Home
                            </a>
                        </li>
                        <li class="mb-2">
                            <a class="footer-link" href="{{ route('warga.index') }}">
                                <i class="fas fa-users me-2"></i>Warga
                            </a>
                        </li>
                        <li class="mb-2">
                            <a class="footer-link" href="{{ route('user.index') }}">
                                <i class="fas fa-user-cog me-2"></i>User
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- FITUR --}}
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 mb-5">
                <div class="footer-widget">
                    <h4 class="fw-bold mb-3 text-white">Fitur</h4>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a class="footer-link" href="{{ route('warga.index') }}">
                                <i class="fas fa-database me-2"></i>Lihat Data
                            </a>
                        </li>
                        <li class="mb-2">
                            <a class="footer-link" href="{{ route('warga.create') }}">
                                <i class="fas fa-plus-circle me-2"></i>Tambah Data
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- KONTAK --}}
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 mb-5">
                <div class="footer-widget">
                    <h4 class="fw-bold mb-3 text-white">Kontak</h4>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            Kantor Desa
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-phone me-2"></i>
                            (000) 123-456
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-envelope me-2"></i>
                            posyandu@desa.id
                        </li>
                    </ul>
                </div>
            </div>

        </div>

        <hr style="border-color: rgba(255,255,255,.2);">

        {{-- COPYRIGHT --}}
        <div class="row">
            <div class="col text-center">
                <p class="mb-0" style="opacity:.85;">
                    © {{ date('Y') }} Sistem Posyandu Desa • Dibangun untuk pelayanan kesehatan masyarakat
                </p>
            </div>
        </div>
    </div>
</footer>

{{-- STYLE TAMBAHAN --}}
<style>
    .footer-link {
        color: #e8f8f5;
        text-decoration: none;
        transition: all .3s ease;
    }

    .footer-link:hover {
        color: #ffffff;
        padding-left: 5px;
    }
</style>
