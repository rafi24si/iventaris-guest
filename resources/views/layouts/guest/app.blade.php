{{-- import { AiOutlineWhatsApp } from "react-icons/ai"; --}}


<!DOCTYPE html>
<html class="no-js" lang="">

<head>
    <!-- CSS Start-->
    @include('layouts.guest.css')

</head>
<!-- FONT AWESOME (WAJIB UNTUK ICON) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<body>
    <!-- ========================= preloader start ========================= -->
    <div class="preloader">
        <div class="loader">
            <div class="spinner">
                <div class="spinner-container">
                    <div class="spinner-rotator">
                        <div class="spinner-left">
                            <div class="spinner-circle"></div>
                        </div>
                        <div class="spinner-right">
                            <div class="spinner-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- preloader end -->

    <!-- ========================= header start ========================= -->
    @include('layouts.guest.header')
    <!-- ========================= header end ========================= -->

    <!-- Start Main Content -->
    @yield('content')
    {{-- end main content --}}

    <!-- ========================= footer start ========================= -->
    @include('layouts.guest.footer')
    <!-- ========================= footer end ========================= -->

    <!-- ========================= scroll-top ========================= -->
    <a href="https://wa.me/6289620842942?text=Halo%20Admin,%20saya%20mau%20bertanya" class="whatsapp-float" img
        src="{{ asset('assets-guest/images/logo/whatsapp.png') }}" target="_blank">
        <i class="lni lni-whatsapp"></i>
    </a>

    {{-- JSS start --}}
    @include('layouts.guest.js')
    {{-- JSS End --}}
</body>

</html>
