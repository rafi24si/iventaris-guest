<footer class="footer pt-120">
     <div class="container">
         <div class="row">
             <div class="col-xl-3 col-lg-4 col-md-6 col-sm-10">
                 <div class="footer-widget">
                     <div class="logo">
                         <a href="{{ route('dashboard') }}"> <img src="{{ asset('assets-guest/images/logo/unnamed.png') }}"
                                 alt="logo" height="80" class="me-2"> </a>
                     </div>

                 </div>
             </div>
             <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 offset-xl-1">
                 <div class="footer-widget">
                     <h3>Menu</h3>
                     <ul class="links">
                         <li><a href="{{ route('dashboard') }}">Home</a></li>
                         <li><a href="{{ route('warga.index') }}"> Warga</a></li>
                         <li><a href="{{ route('kategoriAset.index') }}">Kategori Aset</a></li>
                         <li><a href="{{ route('user.index') }}"> User</a></li>
                     </ul>
                 </div>
             </div>
             <div class="col-xl-3 col-lg-2 col-md-6 col-sm-6">
                 <div class="footer-widget">
                     <h3>Fitur</h3>
                     <ul class="links">
                         <li><a href="{{ route('warga.index') }}">Lihat Data</a></li>
                         <li><a href="{{ route('warga.create') }}">Tambah Data</a></li>
                         <li><a href="{{ route('kategoriAset.index') }}">Lihat Kategori</a></li>
                         <li><a href="{{ route('kategoriAset.create') }}">Tambah Kategori</a></li>
                     </ul>
                 </div>
             </div>


