@php
	$navLinks = [
	    ['label' => 'Dashboard', 'route' => 'school.dashboard', 'match' => 'School/dashboard'],
	    ['label' => ' DCP Batch', 'route' => 'school.dcp_batch', 'match' => 'School/dcp-batch'],
	    [
	        'label' => 'Product Inventory',
	        'route' => 'school.dcp_inventory',
	        'match' => 'School/DCPInventory',
	    ],
	    [
	        'label' => 'Non DCP',
	        'route' => 'schools.nondcpitem.index',
	        'match' => 'School/NonDCPItem/index',
	        'params' => [0],
	    ],
	    ['label' => 'Profile', 'route' => 'school.profile', 'match' => 'School/profile'],
	    [
	        'label' => 'Employee',
	        'route' => 'schools.employee.index',
	        'match' => 'School/Employee/index',
	        'params' => [0],
	    ],
	    [
	        'label' => 'Internet Service',
	        'route' => 'schools.isp.index',
	        'match' => 'School/ISP/index',
	        'params' => [0],
	    ],
	    [
	        'label' => 'CCTV Equip.',
	        'route' => 'schools.cctv.index',
	        'match' => 'School/CCTV/index',
	        'params' => [0],
	    ],
	    [
	        'label' => 'Biometrics Equip.',
	        'route' => 'schools.biometrics.index',
	        'match' => 'School/Biometrics/index',
	        'params' => [0],
	    ],
	    [
	        'label' => 'School Equip.',
	        'route' => 'SchoolEquipment.index',
	        'match' => 'School/SchoolEquipment',
	        'params' => [0],
	    ],
	];
@endphp

<header class="fixed top-0 left-0 right-0 z-50 shadow-md bg-gray-600">
	<div class="flex items-center justify-between space-x-4 px-4 py-3">
		<div class="flex items-center space-x-2">
			<button id="sidebarToggle" class="lg:hidden text-white shadow-none focus:outline-none">
				<svg id="hamburgerIcon" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
					fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
					<line x1="3" y1="12" x2="21" y2="12"></line>
					<line x1="3" y1="6" x2="21" y2="6"></line>
					<line x1="3" y1="18" x2="21" y2="18"></line>
				</svg>
				<svg id="closeIcon" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
					fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
					class="hidden">
					<line x1="18" y1="6" x2="6" y2="18"></line>
					<line x1="6" y1="6" x2="18" y2="18"></line>
				</svg>
			</button>

			<img id="school-logo"
				src="{{ Auth::guard('school')->user()->school->image_path
				    ? asset('school-logo/' . Auth::guard('school')->user()->school->image_path)
				    : asset('icon/logo.png') }}"
				class="h-10 w-10 md:w-14 md:h-14 rounded-full border border-gray-300 object-cover shadow-lg">

			<div class="truncate overflow-hidden whitespace-nowrap max-w-full md:max-w-xs">
				<div class="text-sm font-semibold tracking-wider text-white truncate">
					{{ Auth::guard('school')->user()->school->SchoolName ?? 'School Not Found' }}
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

		<div class="relative">
			<button id="userProfileBtn"
				class="flex items-center md:h-auto md:w-auto h-10 w-10 user-profile-btn dropdown-toggle text-white space-x-2">
				<img style="object-fit: cover;" src="{{ asset('icon/logo.png') }}" alt="User Icon" class="h-8 w-8 rounded-full">
				<span class="user-name md:inline-block hidden">ICT COORDINATOR</span>
				<svg class="w-6 h-6 md:block hidden transform transition-transform duration-300" fill="none"
					stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
				</svg>
			</button>

			<div id="userDropdownMenu"
				class="absolute right-0 mt-2 w-48 bg-white border border-gray-300 rounded-md shadow-lg py-1 hidden z-50 transition-all duration-200">
				<a href="{{ url('School/profile') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">School Profile</a>
				<a href="{{ url('School/Report/index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Reports</a>
				<a href="{{ url('logout') }}" onclick="return confirm('Are you sure you want to logout?');"
					class="block px-4 py-2 text-red-600 hover:bg-gray-100">
					Logout
				</a>
			</div>
		</div>
	</div>
</header>
@php
	$schoolTopLinks = array_slice($navLinks, 0, 3);
	$schoolOtherLinks = array_slice($navLinks, 3);
	$sidebarIcon =
	    '<svg viewBox="0 0 24 24" class="w-6 h-6 mr-2" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 4h7v7H4zM13 4h7v7h-7zM4 13h7v7H4zM13 13h7v7h-7z" fill="currentColor"/></svg>';
@endphp

<div id="sidebar" class="sidebar py-10">
	<div
		class="sidebar-title relative flex items-center gap-3 text-sm md:text-base px-4 py-3 mt-3 mx-2 rounded-xl font-semibold">
		<span class="title-icon">
			<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
					d="M9.75 17L4.5 12l5.25-5M14.25 17l5.25-5-5.25-5" />
			</svg>
		</span>
		DCP School Portal
	</div>
	<hr class="my-5 border-gray-200">

	<nav class="mt-4 space-y-1 sidebar-nav">
		@foreach ($schoolTopLinks as $link)
			<div class="tracking-wider mt-3">
				<a href="{{ route($link['route'], $link['params'] ?? []) }}"
					class="nav-link relative font-medium flex justify-start text-sm md:text-base mx-2 rounded-md transition-all {{ Request::is($link['match']) ? 'active' : '' }}">
					{!! $sidebarIcon !!}
					{{ trim($link['label']) }}
				</a>
			</div>
		@endforeach

		<div class="tracking-wider mt-3">
			<div class="category-label flex items-center gap-2 px-4 py-2 mx-2 mt-4 rounded-lg">
				<span class="category-icon">
					<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
						<path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V7l-6-4H4z" />
					</svg>
				</span>
				Other Details
			</div>
			@foreach ($schoolOtherLinks as $link)
				<a href="{{ route($link['route'], $link['params'] ?? []) }}"
					class="flex justify-start font-medium text-sm nav-link rounded-md md:text-base px-4 py-2 {{ Request::is($link['match']) ? 'active' : '' }}">
					{!! $sidebarIcon !!}
					{{ trim($link['label']) }}
				</a>
			@endforeach
		</div>
	</nav>
</div>
