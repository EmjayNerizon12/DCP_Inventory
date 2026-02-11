 <script>
     document.addEventListener('DOMContentLoaded', function() {
         const sidebar = document.querySelector('.sidebar');
         const toggleBtn = document.getElementById('sidebarToggle');
         const hamburgerIcon = document.getElementById('hamburgerIcon');
         const closeIcon = document.getElementById('closeIcon');

         toggleBtn.addEventListener('click', function(e) {
             e.stopPropagation();

             if (window.innerWidth < 992) {
                 // MOBILE: use "show" class
                 sidebar.classList.toggle('show');
             } else {
                 // DESKTOP: toggle hidden if needed
                 sidebar.classList.toggle('hidden');
             }

             // toggle hamburger/cross icons
             hamburgerIcon.classList.toggle('hidden');
             closeIcon.classList.toggle('hidden');
         });

         // Close sidebar on clicking outside (mobile only)
         document.addEventListener('click', function(e) {
             if (window.innerWidth < 992) {
                 if (!sidebar.contains(e.target) && !toggleBtn.contains(e.target)) {
                     sidebar.classList.remove('show');
                     hamburgerIcon.classList.remove('hidden');
                     closeIcon.classList.add('hidden');
                 }
             }
         });

         // Optional: close sidebar on ESC
         document.addEventListener('keydown', function(e) {
             if (e.key === "Escape") {
                 if (window.innerWidth < 992) {
                     sidebar.classList.remove('show');
                     hamburgerIcon.classList.remove('hidden');
                     closeIcon.classList.add('hidden');
                 } else {
                     sidebar.classList.add('hidden');
                 }
             }
         });
     });
 </script>
