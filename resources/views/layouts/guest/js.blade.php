 <script src="{{ asset('assets-guest/js/bootstrap-5.0.0-beta2.min.js') }}"></script>
 <script src="{{ asset('assets-guest/js/main.js') }}"></script>

 <script>
     // Search functionality
     document.getElementById('searchInput').addEventListener('input', function(e) {
         const searchTerm = e.target.value.toLowerCase();
         const wargaItems = document.querySelectorAll('.warga-item');

         wargaItems.forEach(item => {
             const nama = item.querySelector('h5').textContent.toLowerCase();
             const nik = item.querySelector('.warga-header p').textContent.toLowerCase();

             if (nama.includes(searchTerm) || nik.includes(searchTerm)) {
                 item.style.display = 'block';
             } else {
                 item.style.display = 'none';
             }
         });
     });

     // Auto-hide alert
     setTimeout(function() {
         const alert = document.querySelector('.alert');
         if (alert) {
             alert.style.opacity = '0';
             setTimeout(() => alert.remove(), 300);
         }
     }, 5000);
 </script>
