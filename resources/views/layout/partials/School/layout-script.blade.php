	<!-- Add Alpine.js -->
	<script src="//unpkg.com/alpinejs" defer></script>
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			const sidebar = document.querySelector('.sidebar');
			const toggleBtn = document.getElementById('sidebarToggle');
			const hamburgerIcon = document.getElementById('hamburgerIcon');
			const closeIcon = document.getElementById('closeIcon');
			const userProfileBtn = document.getElementById('userProfileBtn');
			const userDropdownMenu = document.getElementById('userDropdownMenu');

			if (userProfileBtn && userDropdownMenu) {
				userProfileBtn.addEventListener('click', function() {
					userDropdownMenu.classList.toggle('hidden');
				});
			}

			if (!sidebar || !toggleBtn || !hamburgerIcon || !closeIcon) return;

			toggleBtn.addEventListener('click', function(e) {
				e.stopPropagation();

				if (window.innerWidth < 992) {
					sidebar.classList.toggle('show');
				} else {
					sidebar.classList.toggle('hidden');
				}

				hamburgerIcon.classList.toggle('hidden');
				closeIcon.classList.toggle('hidden');
			});

			document.addEventListener('click', function(e) {
				if (window.innerWidth < 992) {
					if (!sidebar.contains(e.target) && !toggleBtn.contains(e.target)) {
						sidebar.classList.remove('show');
						hamburgerIcon.classList.remove('hidden');
						closeIcon.classList.add('hidden');
					}
				}
			});

			document.addEventListener('keydown', function(e) {
				if (e.key === 'Escape') {
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
