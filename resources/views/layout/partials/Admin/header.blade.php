  <header class="fixed top-0 left-0 right-0 z-99 shadow-md" style="background-color: rgb(1, 55, 142);">
      <div class="flex items-center justify-between space-x-4 px-4 py-3">

          <!-- Left: Hamburger + Logo + Title -->
          <div class="flex items-center space-x-2">

              <!-- Hamburger / Close button (Mobile only) -->
              <button id="sidebarToggle" class="md:hidden text-white shadow-none focus:outline-none">
                  <!-- Hamburger icon -->
                  <svg id="hamburgerIcon" xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                      viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round">
                      <line x1="3" y1="12" x2="21" y2="12"></line>
                      <line x1="3" y1="6" x2="21" y2="6"></line>
                      <line x1="3" y1="18" x2="21" y2="18"></line>
                  </svg>
                  <!-- Close icon (hidden by default) -->
                  <svg id="closeIcon" xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                      viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round" class="hidden">
                      <line x1="18" y1="6" x2="6" y2="18"></line>
                      <line x1="6" y1="6" x2="18" y2="18"></line>
                  </svg>
              </button>

              <!-- Logo -->
              <img src="{{ asset('icon/sdo-logo.png') }}"
                  class="h-10 w-10 md:w-18 md:h-18 rounded-full object-cover shadow-lg">

              <!-- Title & Info -->
              <div class="truncate overflow-hidden whitespace-nowrap max-w-full md:max-w-xs">
                  <div class="text-sm font-semibold tracking-wider text-white truncate">
                      DCP Management System
                  </div>
                  <hr class="md:h-0.5 h-0.25 bg-white border-0 rounded">
                  <div class="division-name uppercase font-bold text-white md:text-lg truncate">
                      Schools Division Office
                  </div>
                  <div class="san-carlos md:text-sm text-xs text-white font-normal uppercase">
                      San Carlos City
                  </div>
              </div>

          </div>

          <!-- Right: User Profile Dropdown -->
          <div class="relative">
              <button id="userProfileBtn"
                  class="flex items-center md:h-auto md:w-auto h-10 w-10 user-profile-btn dropdown-toggle text-white space-x-2">
                  <img style="object-fit: cover;" src="{{ asset('icon/logo.png') }}" alt="User Icon"
                      class="h-8 w-8 rounded-full">
                  <span class="user-name">NORMAN A. FLORES</span>
                  <svg class="w-6 h-6 md:block hidden transform transition-transform duration-300" fill="none"
                      stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                  </svg>
              </button>

              <!-- Dropdown menu -->
              <div id="userDropdownMenu"
                  class="absolute right-0 mt-2 w-48 bg-white border border-gray-300 rounded-md shadow-lg py-1 hidden z-50 transition-all duration-200">
                  <a href="{{ route('admin.account.index') }}"
                      class="block px-4 py-2 text-gray-700 hover:bg-green-50">Account</a>
                  <a href="{{ route('admin.reports.index') }}"
                      class="block px-4 py-2 text-gray-700 hover:bg-green-50">Reports</a>
                  <a href="{{ url('logout') }}" class="block px-4 py-2 text-red-600 hover:bg-red-50">Logout</a>
              </div>
          </div>
      </div>
  </header>
  <script>
      document.getElementById('userProfileBtn').addEventListener('click', function() {
          document.getElementById('userDropdownMenu').classList.toggle('hidden');
      });
  </script>
