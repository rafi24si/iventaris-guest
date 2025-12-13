{{-- import { AiOutlineWhatsApp } from "react-icons/ai"; --}}


<!DOCTYPE html>
<html class="no-js" lang="">

<head>
    <!-- CSS Start-->
    @include('layouts.guest.css')

</head>

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
    <a href="https://wa.me/6289620842942?text=Halo%20Admin,%20saya%20mau%20bertanya" class="whatsapp-float" img src="{{ asset('assets-guest/images/logo/whatsapp.png') }}"
        target="_blank">
        <i class="lni lni-whatsapp"></i>
    </a>

    {{-- JSS start --}}
    @include('layouts.guest.js')
    {{-- JSS End --}}
</body>

</html>
