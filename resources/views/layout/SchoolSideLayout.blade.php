<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<meta name="school-logo"
			content="{{ Auth::guard('school')->user()->school->image_path
			    ? asset('school-logo/' . Auth::guard('school')->user()->school->image_path)
			    : asset('icon/logo.png') }}">
		<meta name="school-name" content=" {{ Auth::guard('school')->user()->school->SchoolName ?? 'School Not Found' }}">
		<title>@yield('title')</title>
		{{-- <link rel="icon" type="image/png"
        href="{{ Auth::guard('school')->user()->school->image_path ? asset('school-logo/' . Auth::guard('school')->user()->school->image_path) : asset('icon/logo.png') }}"> --}}

		@vite(['resources/css/app.css', 'resources/css/admin.css'])
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

		{{-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" /> --}}

	</head>
	<style>
		html {
			scroll-behavior: smooth;
		}

		body {
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
		}
	</style>
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

		    // [
		    //     'label' => 'Item Status',
		    //     'route' => 'schools.item.condition',
		    //     'match' => 'School/items-condition/0',
		    //     'params' => [0],
		    // ],
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
		    // [
		    //     'label' => 'School Reports',
		    //     'route' => 'schools.report.index',
		    //     'match' => 'School/Report/index',
		    //     'params' => [0],
		    // ],

		    // [
		    //     'label' => 'Packages',
		    //     'route' => 'schools.packages.info',
		    //     'match' => 'School/packages-info/0',
		    //     'params' => [0],
		    // ],
		];
	@endphp
	<style>
		/* Main University Name */
		.division-name {
			font-family: 'Trajan Pro', 'Times New Roman', serif;
			/* fallback to Times New Roman */
			/* or 600 if using semi-bold */
			/* all caps */
			/* adjust between 48-72px depending on your layout */
			letter-spacing: 2px;
			/* slightly spread letters for a formal feel */
			/* black text */
			/* centered in layout */
			margin: 0;
			line-height: 1.2;
		}

		/* Tagline Text */
		.san-carlos {
			font-family: 'Times New Roman', serif;
			/* adjust between 12-18px */
			letter-spacing: 1px;
			text-align: left;
			line-height: 1.2;
		}

		[x-cloak] {
			display: none !important;
		}

		/* Success checkmark animation */
		.success-icon {
			animation: scaleIn 0.5s ease-out, pulse 2s infinite 0.5s;
		}

		.checkmark {
			stroke-dasharray: 16;
			stroke-dashoffset: 16;
			animation: checkmark 0.6s ease-in-out 0.3s forwards;
		}

		@keyframes scaleIn {
			0% {
				transform: scale(0) rotate(-180deg);
				opacity: 0;
			}

			50% {
				transform: scale(1.2) rotate(-10deg);
			}

			100% {
				transform: scale(1) rotate(0deg);
				opacity: 1;
			}
		}

		@keyframes checkmark {
			0% {
				stroke-dashoffset: 16;
			}

			100% {
				stroke-dashoffset: 0;
			}
		}

		@keyframes pulse {

			0%,
			100% {
				box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.4);
			}

			50% {
				box-shadow: 0 0 0 10px rgba(34, 197, 94, 0);
			}
		}

		/* Error icon animation */
		.error-icon {
			animation: shake 0.6s ease-in-out, errorPulse 2s infinite 0.6s;
		}

		.warning-lines {
			stroke-dasharray: 12;
			stroke-dashoffset: 12;
			animation: drawLine 0.4s ease-out 0.2s forwards;
		}

		.warning-dot {
			opacity: 0;
			animation: fadeInDot 0.3s ease-out 0.6s forwards;
		}

		@keyframes shake {

			0%,
			20%,
			40%,
			60%,
			80%,
			100% {
				transform: translateX(0) scale(1);
			}

			10%,
			30%,
			50%,
			70%,
			90% {
				transform: translateX(-3px) scale(1.05);
			}
		}

		@keyframes drawLine {
			0% {
				stroke-dashoffset: 12;
			}

			100% {
				stroke-dashoffset: 0;
			}
		}

		@keyframes fadeInDot {
			0% {
				opacity: 0;
				transform: scale(0);
			}

			100% {
				opacity: 1;
				transform: scale(1);
			}
		}

		@keyframes errorPulse {

			0%,
			100% {
				box-shadow: 0 0 0 0 rgba(220, 38, 38, 0.4);
			}

			50% {
				box-shadow: 0 0 0 10px rgba(220, 38, 38, 0);
			}
		}

		/* Modal entrance animation */
		.modal-enter {
			animation: modalSlideIn 0.4s ease-out;
		}

		@keyframes modalSlideIn {
			0% {
				opacity: 0;
				transform: translateY(-20px) scale(0.95);
			}

			100% {
				opacity: 1;
				transform: translateY(0) scale(1);
			}
		}

		/* Button hover effects */
		.btn-hover {
			transition: all 0.2s ease;
		}

		.btn-hover:hover {
			transform: translateY(-1px);
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
		}
	</style>

	<body class="antialiased bg-white flex flex-col min-h-screen thin-scroll">
		<header class="bg-gray-600 text-white fixed top-0 z-50 shadow-md w-full">

			<div class="w-full md:py-2 py-1 px-4">
				<div class="flex justify-between items-center w-full">

					<!-- Left Side -->
					<div class="flex items-center space-x-2">

						<!-- Toggle button (works on all screen sizes) -->
						<button id="menuToggle" class="text-white border-none focus:outline-none shadow-none">

							<svg id="iconHamburger" viewBox="0 0 24 24" class="w-6 h-6 block" fill="none"
								xmlns="http://www.w3.org/2000/svg">
								<path d="M4 6H20M4 12H20M4 18H20" stroke="currentColor" stroke-width="2" stroke-linecap="round"
									stroke-linejoin="round" />
							</svg>

							<svg id="iconClose" viewBox="0 0 32 32" class="w-6 h-6 hidden" fill="currentColor"
								xmlns="http://www.w3.org/2000/svg">
								<path d="M18.8,16l5.5-5.5c0.8-0.8,0.8-2,0-2.8
																								C24,7.3,23.5,7,23,7c-0.5,0-1,0.2-1.4,0.6L16,13.2l-5.5-5.5
																								c-0.8-0.8-2.1-0.8-2.8,0C7.3,8,7,8.5,7,9.1s0.2,1,0.6,1.4
																								l5.5,5.5l-5.5,5.5C7.3,21.9,7,22.4,7,23c0,0.5,0.2,1,0.6,1.4
																								C8,24.8,8.5,25,9,25c0.5,0,1-0.2,1.4-0.6l5.5-5.5l5.5,5.5
																								c0.8,0.8,2.1,0.8,2.8,0c0.8-0.8,0.8-2.1,0-2.8L18.8,16z" />
							</svg>
						</button>

						<img id="school-logo"
							src="{{ Auth::guard('school')->user()->school->image_path
							    ? asset('school-logo/' . Auth::guard('school')->user()->school->image_path)
							    : asset('icon/logo.png') }}"
							class="h-10 w-10 md:w-14 md:h-14 rounded-full border border-gray-300 object-cover shadow-lg">

						<div class=" truncate overflow-hidden whitespace-nowrap max-w-full md:max-w-4xs">
							<div class="text-sm font-semibold tracking-wider truncate overflow-hidden whitespace-nowrap  ">
								{{ Auth::guard('school')->user()->school->SchoolName ?? 'School Not Found' }}
							</div>
							<hr class="md:h-0.5 h-0.25 bg-white border-0 rounded">
							<div class="division-name uppercase font-bold text-white md:text-lg truncate text-sm whitespace-nowrap">
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
							<span class="user-name  md:inline-block hidden">ICT COORDINATOR</span>
							<svg class="w-6 h-6 md:block hidden transform transition-transform duration-300" fill="none"
								stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
							</svg>
						</button>

						<!-- Dropdown menu -->
						<div id="userDropdownMenu"
							class="absolute right-0 mt-2 w-48 bg-white border border-gray-300 rounded-md shadow-lg py-1 hidden z-50 transition-all duration-200">
							<a href="{{ url('School/profile') }}" class="block px-4 py-2 text-gray-700 hover:bg-green-50">School Profile</a>
							<a href="{{ url('School/Report/index') }}" class="block px-4 py-2 text-gray-700 hover:bg-green-50">Reports</a>
							<a href="{{ url('logout') }}" onclick="return confirm('Are you sure you want to logout?');"
								class="block px-4 py-2 text-red-600 hover:bg-red-50">
								Logout
							</a>

						</div>
					</div>
				</div>
			</div>
			<style>
				.user-profile-btn {
					background: rgba(255, 255, 255, 0.15);
					border: 1px solid rgba(255, 255, 255, 0.3);
					border-radius: 30px;
					color: white;
					display: flex;
					align-items: center;
					padding: 5px;
					transition: all 0.2s;
				}

				.user-profile-btn:hover {
					background: rgba(255, 255, 255, 0.25);
				}

				.user-profile-btn img {
					border-radius: 50%;
					border: 2px solid rgba(255, 255, 255, 0.5);
				}

				.user-profile-btn .user-name {
					font-weight: 500;
					margin-right: 5px;
					max-width: 120px;
					white-space: nowrap;
					overflow: hidden;
					text-overflow: ellipsis;
				}
			</style>
			<script>
				document.getElementById('userProfileBtn').addEventListener('click', function() {
					document.getElementById('userDropdownMenu').classList.toggle('hidden');
				});
			</script>
			<!-- Navigation (GENERAL) -->
			<nav id="mainNav" class="hidden px-4 py-2 flex-wrap gap-1 justify-center bg-gray-600">

				@foreach ($navLinks as $link)
					<a href="{{ route($link['route'], $link['params'] ?? []) }}"
						class="px-5 py-1 rounded-sm h-auto tracking-wide font-semibold md:text-base text-sm transition
                {{ Request::is($link['match']) ? 'bg-blue-500 text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
						{{ $link['label'] }}
					</a>
				@endforeach

			</nav>
		</header>

		<main class="flex-grow mt-15">

			<!-- Success Modal -->
			<div x-data="{ open: @if ($errors->any() || session('error') || session('success')) true @else false @endif }" x-show="open" class="modal items-center justify-center" x-cloak>

				<div
					class="modal-content relative p-6 space-y-2 text-lg small-modal flex flex-col items-center justify-center modal-enter">

					<div
						class="h-10 w-10 absolute right-2 hidden top-2 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

						<button type="button" title="Close" class="btn-cancel p-1 rounded-full" x-on:click="open = false">
							<svg fill="currentColor" class="w-6 h-6" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
								<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
								<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
								<g id="SVGRepo_iconCarrier">
									<path
										d="M18.8,16l5.5-5.5c0.8-0.8,0.8-2,0-2.8l0,0C24,7.3,23.5,7,23,7c-0.5,0-1,0.2-1.4,0.6L16,13.2l-5.5-5.5 c-0.8-0.8-2.1-0.8-2.8,0C7.3,8,7,8.5,7,9.1s0.2,1,0.6,1.4l5.5,5.5l-5.5,5.5C7.3,21.9,7,22.4,7,23c0,0.5,0.2,1,0.6,1.4 C8,24.8,8.5,25,9,25c0.5,0,1-0.2,1.4-0.6l5.5-5.5l5.5,5.5c0.8,0.8,2.1,0.8,2.8,0c0.8-0.8,0.8-2.1,0-2.8L18.8,16z">
									</path>
								</g>
							</svg>
						</button>
					</div>
					<!-- Close Button -->
					{{-- <button @click="open = false"
                    class="absolute top-2 right-2 w-8 h-8 rounded-full bg-gray-200 text-gray-600 hover:bg-gray-300 transition-colors">✕</button> --}}

					<!-- SUCCESS MODAL -->
					@if (session('success'))
						<!-- Icon -->
						<div class="flex justify-center">
							<div class="w-14 h-14 rounded-full bg-white  text-green-600 flex items-center justify-center success-icon">
								<svg class=" w-12 h-12" viewBox="0 0 600 600" version="1.1" id="svg9724" sodipodi:docname="check-circle.svg"
									inkscape:version="1.2.2 (1:1.2.2+202212051550+b0a8486541)"
									xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape"
									xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns="http://www.w3.org/2000/svg"
									xmlns:svg="http://www.w3.org/2000/svg" fill="currentColor">
									<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
									<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
									<g id="SVGRepo_iconCarrier">
										<defs id="defs9728"></defs>
										<sodipodi:namedview id="namedview9726" pagecolor="#ffffff" bordercolor="#666666" borderopacity="1.0"
											inkscape:showpageshadow="2" inkscape:pageopacity="0.0" inkscape:pagecheckerboard="0"
											inkscape:deskcolor="#d1d1d1" showgrid="true" inkscape:zoom="0.42059315" inkscape:cx="175.942"
											inkscape:cy="626.49618" inkscape:window-width="1920" inkscape:window-height="1009" inkscape:window-x="0"
											inkscape:window-y="1080" inkscape:window-maximized="1" inkscape:current-layer="g10449" showguides="true">
											<inkscape:grid type="xygrid" id="grid9972" originx="0" originy="0">
											</inkscape:grid>
										</sodipodi:namedview>
										<g id="g10449" transform="matrix(0.95173205,0,0,0.95115787,13.901174,12.168794)"
											style="stroke-width:1.05103">
											<g id="path10026" inkscape:transform-center-x="-0.59233046" inkscape:transform-center-y="-20.347403"
												transform="matrix(1.3807551,0,0,1.2700888,273.60014,263.99768)"></g>
											<g id="g11314" transform="matrix(1.5092301,0,0,1.3955555,36.774048,-9.4503933)"
												style="stroke-width:50.6951"></g>
											<path id="path501"
												style="color:currentColor;fill:currentColor;stroke-linecap:round;stroke-linejoin:round;-inkscape-stroke:none"
												d="m 573.78125,71.326172 c -11.14983,0.0041 -21.84136,4.437288 -29.72266,12.324219 L 269.17773,358.69727 201.88007,226.17417 c -16.41326,-16.42281 -43.03211,-16.43069 -59.45508,-0.0176 -16.42281,16.41326 -16.43068,43.03211 -0.0176,59.45508 l 97.034,162.277 c 16.42109,16.42734 43.05156,16.42734 59.47265,0 L 603.53125,143.08789 c 16.41439,-16.4232 16.40651,-43.04355 -0.0176,-59.457031 -7.88689,-7.88216 -18.58202,-12.308309 -29.73242,-12.304687 z M 297.41602,-12.826172 C 216.90703,-11.965911 137.45719,19.625316 77.640625,79.496094 -23.103069,180.33109 -43.683279,336.82447 27.546875,460.31055 98.777031,583.79662 244.53398,644.23617 382.17383,607.32227 519.81368,570.40835 615.82422,445.15088 615.82422,302.57422 c -1.6e-4,-23.21855 -18.82247,-42.04086 -42.04102,-42.04102 -23.21931,-9.2e-4 -42.04281,18.82171 -42.04297,42.04102 0,104.9608 -70.10118,196.38166 -171.34765,223.53515 C 259.14611,553.26287 152.80736,509.18649 100.38086,418.29883 47.954364,327.41117 62.989814,213.1262 137.12305,138.92578 211.25628,64.725365 325.35936,49.693075 416.14258,102.1543 c 20.1039,11.61703 45.81879,4.73687 57.43554,-15.367191 C 485.19415,66.68416 478.31507,40.97088 458.21289,29.353516 408.08311,0.38483622 352.50111,-13.414771 297.41602,-12.826172 Z"
												sodipodi:nodetypes="scccccccccsssssscccssscscs"></path>
										</g>
									</g>
								</svg>
							</div>
						</div>

						<!-- Content -->
						<div class="text-lg font-bold text-green-600">SUCCESS</div>

						<div class="text-gray-600 px-4 md:text-base text-sm text-center">
							{{ session('success') }}
						</div>

						<!-- Footer -->
						<div>
							<button @click="open = false" type="button" class="btn-green rounded-full py-1 px-4 ">Continue</button>
						</div>

						<!-- ERROR MODAL -->
					@elseif ($errors->any() || session('error'))
						<!-- Icon -->
						<div class="flex justify-center ">
							<div class="w-14 h-14 rounded-full text-red-600 bg-white flex items-center justify-center error-icon">
								<svg class="w-14 h-14" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:cc="http://creativecommons.org/ns#"
									xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:svg="http://www.w3.org/2000/svg"
									xmlns="http://www.w3.org/2000/svg" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
									xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" viewBox="0 0 400 400.00001" id="svg2"
									version="1.1" inkscape:version="0.91 r13725" sodipodi:docname="error.svg" fill="currentColor">
									<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
									<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
									<g id="SVGRepo_iconCarrier">
										<defs id="defs4"></defs>
										<sodipodi:namedview id="base" pagecolor="#ffffff" bordercolor="currentColor" borderopacity="1.0"
											inkscape:pageopacity="0.0" inkscape:pageshadow="2" inkscape:zoom="0.98994949" inkscape:cx="244.49048"
											inkscape:cy="180.68004" inkscape:document-units="px" inkscape:current-layer="layer1" showgrid="false"
											units="px" showguides="true" inkscape:guide-bbox="true" inkscape:window-width="1920"
											inkscape:window-height="1056" inkscape:window-x="1920" inkscape:window-y="24"
											inkscape:window-maximized="1">
											<sodipodi:guide position="200.71429,121.42857" orientation="1,0" id="guide23298"></sodipodi:guide>
										</sodipodi:namedview>
										<metadata id="metadata7">
											<rdf:rdf>
												<cc:work rdf:about="">
													<dc:format>image/svg+xml</dc:format>
													<dc:type rdf:resource="http://purl.org/dc/dcmitype/StillImage">
													</dc:type>
													<dc:title> </dc:title>
												</cc:work>
											</rdf:rdf>
										</metadata>
										<g inkscape:label="Capa 1" inkscape:groupmode="layer" id="layer1" transform="translate(0,-652.36216)">
											<path
												style="color:currentColor;font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:medium;line-height:normal;font-family:sans-serif;text-indent:0;text-align:start;text-decoration:none;text-decoration-line:none;text-decoration-style:solid;text-decoration-color:currentColor;letter-spacing:normal;word-spacing:normal;text-transform:none;direction:ltr;block-progression:tb;writing-mode:lr-tb;baseline-shift:baseline;text-anchor:start;white-space:normal;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:currentColor;solid-opacity:1;fill:currentColor;fill-opacity:1;fill-rule:nonzero;stroke:none;stroke-width:24.99999809;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate"
												d="M 200,652.36214 C 89.691101,652.36214 -5e-7,742.05324 -5e-7,852.36214 -5e-7,962.67104 89.691101,1052.3622 200,1052.3622 c 110.3089,0 200,-89.69116 200,-200.00006 0,-110.3089 -89.6911,-200 -200,-200 z m 0,25 c 96.7979,0 175,78.2021 175,175 0,96.7979 -78.2021,175.00006 -175,175.00006 -96.7979,0 -175,-78.20216 -175,-175.00006 0,-96.7979 78.2021,-175 175,-175 z m -92.4785,64.8438 -17.677799,17.6777 92.478499,92.4785 -92.478499,92.4785 17.677799,17.6778 92.4785,-92.4785 92.4785,92.4785 17.6777,-17.6778 -92.4785,-92.4785 92.4785,-92.4785 -17.6777,-17.6777 L 200,834.68444 Z"
												id="error" inkscape:connector-curvature="0" sodipodi:nodetypes="ssssssssssccccccccccccc">
												<title id="title23607">error</title>
											</path>
										</g>
									</g>
								</svg>
							</div>
						</div>

						<!-- Content -->
						<h2 class=" text-lg font-bold text-red-600">ERROR</h2>
						<p class="text-gray-600 px-4 md:text-base text-sm text-center">
							@if (session('error'))
								{{ session('error') }}
							@else
								Please fix the following issues:
								<ul class=" list-disc list-inside text-base text-center text-red-700 mx-5">
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							@endif
						</p>

						<!-- Footer -->
						<div>
							<button @click="open = false" type="button" class="btn-delete rounded-full px-4 py-1">Continue</button>
						</div>
					@endif
				</div>
			</div>

			@yield('content')
			<div id="status-modal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

				<div
					class="modal-content relative p-6 space-y-2 text-lg small-modal flex flex-col items-center justify-center bg-white rounded-lg">

					<!-- Icon -->
					<div id="modal-icon"></div>

					<!-- Title -->
					<h2 id="modal-title" class="text-lg font-bold"></h2>

					<!-- Message -->
					<div id="modal-message" class="text-gray-600 px-4 md:text-base text-sm text-center"></div>

					<!-- Footer -->
					<div>
						<button onclick="document.getElementById('status-modal').classList.add('hidden');"
							class="btn-green rounded-full py-1 px-4">
							Continue
						</button>
					</div>

				</div>
			</div>

			<script>
				function renderLoadingOnTable() {
					return `
                    <div class="spinner-container my-10" id="spinner-container">
                        <div class="spinner-md"></div>
                    </div> 
                `;
				}

				function addOverflow() {
					document.body.classList.remove('overflow-hidden');
				}

				function removeOverflow() {
					document.body.classList.add('overflow-hidden');
				}

				function toggleCollapse(containerId, index) {
					const collapse = document.getElementById(containerId);
					const toggleButton = document.getElementById(`toggle-button-${index}`)
					if (!collapse) {
						return;
					}
					collapse.classList.toggle('hidden'); // just show/hide
					if (collapse.classList.contains('hidden')) {
						// Section is now hidden → show dashboard icon
						toggleButton.innerHTML = `@include('SchoolSide.components.svg.dashboard-sm')`;
					} else {
						// Section is now visible → show area icon
						toggleButton.innerHTML = `@include('SchoolSide.components.svg.cross-sm')`;
					}

				}

				function scrollTo(id) {
					const element = document.getElementById(id);
					if (element) {
						element.scrollIntoView({
							behavior: 'smooth', // smooth sliding
							block: 'start' // align element at top
						});
					}
				}

				function resetButton(button, text) {
					button.disabled = false;
					button.innerHTML = text;
				}

				function buttonLoading(button) {
					button.disabled = true;

					button.innerHTML = `
                <div class="spinner-container w-full">
                    <span class="spinner-xs">
                    </span>
                </div>`;
				}

				function clearErrors() {
					document.querySelectorAll('.error').forEach(el => {
						el.textContent = '';
					});
				}

				function handleErrors(errors) {
					document.querySelectorAll('[data-error]').forEach(el => el.innerText = '');

					for (const field in errors) {
						const errorDiv = document.querySelector(`[data-error="${field}"]`);
						if (errorDiv) {
							errorDiv.innerText = errors[field][0];
						}
					}
				}

				function renderStatusModal(data) {
					const modal = document.getElementById('status-modal');
					const icon = document.getElementById('modal-icon');
					const titleEl = document.getElementById('modal-title');
					const messageEl = document.getElementById('modal-message');
					if (data.success) {
						messageEl.innerHTML = data.message;

						titleEl.textContent = 'SUCCESS';
						titleEl.className = 'text-lg font-bold text-green-600';
						icon.innerHTML = `
                    <div class="flex justify-center">
                        <div
                            class="w-14 h-14 rounded-full bg-white  text-green-600 flex items-center justify-center success-icon">
                            <svg class=" w-12 h-12" viewBox="0 0 600 600" version="1.1" id="svg9724"
                                sodipodi:docname="check-circle.svg"
                                inkscape:version="1.2.2 (1:1.2.2+202212051550+b0a8486541)"
                                xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape"
                                xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
                                xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg"
                                fill="currentColor">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <defs id="defs9728"></defs>
                                    <sodipodi:namedview id="namedview9726" pagecolor="#ffffff" bordercolor="#666666"
                                        borderopacity="1.0" inkscape:showpageshadow="2" inkscape:pageopacity="0.0"
                                        inkscape:pagecheckerboard="0" inkscape:deskcolor="#d1d1d1" showgrid="true"
                                        inkscape:zoom="0.42059315" inkscape:cx="175.942" inkscape:cy="626.49618"
                                        inkscape:window-width="1920" inkscape:window-height="1009"
                                        inkscape:window-x="0" inkscape:window-y="1080" inkscape:window-maximized="1"
                                        inkscape:current-layer="g10449" showguides="true">
                                        <inkscape:grid type="xygrid" id="grid9972" originx="0" originy="0">
                                        </inkscape:grid>
                                    </sodipodi:namedview>
                                    <g id="g10449"
                                        transform="matrix(0.95173205,0,0,0.95115787,13.901174,12.168794)"
                                        style="stroke-width:1.05103">
                                        <g id="path10026" inkscape:transform-center-x="-0.59233046"
                                            inkscape:transform-center-y="-20.347403"
                                            transform="matrix(1.3807551,0,0,1.2700888,273.60014,263.99768)"></g>
                                        <g id="g11314"
                                            transform="matrix(1.5092301,0,0,1.3955555,36.774048,-9.4503933)"
                                            style="stroke-width:50.6951"></g>
                                        <path id="path501"
                                            style="color:currentColor;fill:currentColor;stroke-linecap:round;stroke-linejoin:round;-inkscape-stroke:none"
                                            d="m 573.78125,71.326172 c -11.14983,0.0041 -21.84136,4.437288 -29.72266,12.324219 L 269.17773,358.69727 201.88007,226.17417 c -16.41326,-16.42281 -43.03211,-16.43069 -59.45508,-0.0176 -16.42281,16.41326 -16.43068,43.03211 -0.0176,59.45508 l 97.034,162.277 c 16.42109,16.42734 43.05156,16.42734 59.47265,0 L 603.53125,143.08789 c 16.41439,-16.4232 16.40651,-43.04355 -0.0176,-59.457031 -7.88689,-7.88216 -18.58202,-12.308309 -29.73242,-12.304687 z M 297.41602,-12.826172 C 216.90703,-11.965911 137.45719,19.625316 77.640625,79.496094 -23.103069,180.33109 -43.683279,336.82447 27.546875,460.31055 98.777031,583.79662 244.53398,644.23617 382.17383,607.32227 519.81368,570.40835 615.82422,445.15088 615.82422,302.57422 c -1.6e-4,-23.21855 -18.82247,-42.04086 -42.04102,-42.04102 -23.21931,-9.2e-4 -42.04281,18.82171 -42.04297,42.04102 0,104.9608 -70.10118,196.38166 -171.34765,223.53515 C 259.14611,553.26287 152.80736,509.18649 100.38086,418.29883 47.954364,327.41117 62.989814,213.1262 137.12305,138.92578 211.25628,64.725365 325.35936,49.693075 416.14258,102.1543 c 20.1039,11.61703 45.81879,4.73687 57.43554,-15.367191 C 485.19415,66.68416 478.31507,40.97088 458.21289,29.353516 408.08311,0.38483622 352.50111,-13.414771 297.41602,-12.826172 Z"
                                            sodipodi:nodetypes="scccccccccsssssscccssscscs"></path>
                                    </g>
                                </g>
                            </svg>
                        </div>
                    </div>`;
					} else {
						titleEl.textContent = 'ERROR';
						messageEl.innerHTML = data.errors;

						titleEl.className = 'text-lg font-bold text-red-600';
						icon.innerHTML = `
                   <div class="flex justify-center ">
                        <div
                            class="w-14 h-14 rounded-full text-red-600 bg-white flex items-center justify-center error-icon">
                            <svg class="w-14 h-14" xmlns:dc="http://purl.org/dc/elements/1.1/"
                                xmlns:cc="http://creativecommons.org/ns#"
                                xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
                                xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg"
                                xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
                                xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape"
                                viewBox="0 0 400 400.00001" id="svg2" version="1.1"
                                inkscape:version="0.91 r13725" sodipodi:docname="error.svg" fill="currentColor">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <defs id="defs4"></defs>
                                    <sodipodi:namedview id="base" pagecolor="#ffffff" bordercolor="currentColor"
                                        borderopacity="1.0" inkscape:pageopacity="0.0" inkscape:pageshadow="2"
                                        inkscape:zoom="0.98994949" inkscape:cx="244.49048" inkscape:cy="180.68004"
                                        inkscape:document-units="px" inkscape:current-layer="layer1" showgrid="false"
                                        units="px" showguides="true" inkscape:guide-bbox="true"
                                        inkscape:window-width="1920" inkscape:window-height="1056"
                                        inkscape:window-x="1920" inkscape:window-y="24"
                                        inkscape:window-maximized="1">
                                        <sodipodi:guide position="200.71429,121.42857" orientation="1,0"
                                            id="guide23298"></sodipodi:guide>
                                    </sodipodi:namedview>
                                    <metadata id="metadata7">
                                        <rdf:rdf>
                                            <cc:work rdf:about="">
                                                <dc:format>image/svg+xml</dc:format>
                                                <dc:type rdf:resource="http://purl.org/dc/dcmitype/StillImage">
                                                </dc:type>
                                                <dc:title> </dc:title>
                                            </cc:work>
                                        </rdf:rdf>
                                    </metadata>
                                    <g inkscape:label="Capa 1" inkscape:groupmode="layer" id="layer1"
                                        transform="translate(0,-652.36216)">
                                        <path
                                            style="color:currentColor;font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:medium;line-height:normal;font-family:sans-serif;text-indent:0;text-align:start;text-decoration:none;text-decoration-line:none;text-decoration-style:solid;text-decoration-color:currentColor;letter-spacing:normal;word-spacing:normal;text-transform:none;direction:ltr;block-progression:tb;writing-mode:lr-tb;baseline-shift:baseline;text-anchor:start;white-space:normal;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:currentColor;solid-opacity:1;fill:currentColor;fill-opacity:1;fill-rule:nonzero;stroke:none;stroke-width:24.99999809;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate"
                                            d="M 200,652.36214 C 89.691101,652.36214 -5e-7,742.05324 -5e-7,852.36214 -5e-7,962.67104 89.691101,1052.3622 200,1052.3622 c 110.3089,0 200,-89.69116 200,-200.00006 0,-110.3089 -89.6911,-200 -200,-200 z m 0,25 c 96.7979,0 175,78.2021 175,175 0,96.7979 -78.2021,175.00006 -175,175.00006 -96.7979,0 -175,-78.20216 -175,-175.00006 0,-96.7979 78.2021,-175 175,-175 z m -92.4785,64.8438 -17.677799,17.6777 92.478499,92.4785 -92.478499,92.4785 17.677799,17.6778 92.4785,-92.4785 92.4785,92.4785 17.6777,-17.6778 -92.4785,-92.4785 92.4785,-92.4785 -17.6777,-17.6777 L 200,834.68444 Z"
                                            id="error" inkscape:connector-curvature="0"
                                            sodipodi:nodetypes="ssssssssssccccccccccccc">
                                            <title id="title23607">error</title>
                                        </path>
                                    </g>
                                </g>
                            </svg>
                        </div>
                    </div>`;
					}

					modal.classList.remove('hidden');
					modal.classList.add('flex');
				}

				function closeModal() {
					const modal = document.getElementById('status-modal');
					modal.classList.add('hidden');
					modal.classList.remove('flex');
				}


				function formatNumber(num, decimals = 2) {
					if (num === null || num === undefined || num === '0.00') return '0.00';

					return Number(num).toLocaleString(undefined, {
						minimumFractionDigits: decimals,
						maximumFractionDigits: decimals
					});
				}

				function formatDate(dateString) {
					if (!dateString) return '';

					const date = new Date(dateString);

					if (isNaN(date)) return 'Invalid Date';

					return date.toLocaleDateString('en-US', {
						year: 'numeric',
						month: 'long',
						day: 'numeric'
					});
				}

				function openComponentModal(id) {
					document.getElementById(id).classList.remove('hidden');
					document.body.classList.add('overflow-hidden');
				}

				function closeComponentModal(id) {
					document.getElementById(id).classList.add('hidden');
					document.body.classList.remove('overflow-hidden');
					clearErrors();
				}
			</script>
		</main>
	</body>
	<!-- Add Alpine.js -->
	<script src="//unpkg.com/alpinejs" defer></script>
	<script>
		const toggleBtn = document.getElementById('menuToggle');
		const nav = document.getElementById('mainNav');
		const hamburger = document.getElementById('iconHamburger');
		const closeIcon = document.getElementById('iconClose');

		toggleBtn.addEventListener('click', () => {
			nav.classList.toggle('hidden');
			nav.classList.toggle('flex');

			hamburger.classList.toggle('hidden');
			closeIcon.classList.toggle('hidden');
		});
	</script>

</html>
