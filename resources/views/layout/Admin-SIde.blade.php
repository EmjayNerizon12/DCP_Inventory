<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<title>@yield('title')</title>
		<meta name="school-logo" content="{{ asset('icon/logo.png') }}">
		<link rel="icon" type="image/png" href="{{ asset('icon/logo.png') }}">

		@vite(['resources/css/app.css', 'resources/css/admin.css', 'resources/js/admin.js']);

	</head>

		<body class="antialiased bg-gray-50 flex min-h-screen">
			@include('layout.partials.Admin._style')
			@include('layout.partials.Admin.helpers-script')
			@include('layout.partials.Admin.header')
			@include('layout.partials.Admin.sidebar')
			@include('layout.partials.Admin._script')
			@include('AdminSide.partials.print-style')

		<div class="main-content" id="content">

				<div id="status-notification-container" class="fixed top-0 right-0 z-99 p-4 space-y-3 w-fit">
				@if (session('success'))
					<div class="flex items-icenter justify-between relative p-2 bg-white border border-gray-200 rounded-md shadow-lg">
						<div class="flex items-center gap-3 mr-5">
							<div class="flex items-center justify-center w-6 h-6 rounded-full text-green-600 text-base">
								<svg viewBox="0 0 24 24" class="w-6 h-6" fill="none" xmlns="http://www.w3.org/2000/svg">
									<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
									<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
									<g id="SVGRepo_iconCarrier">
										<path d="M7 13L10 16L17 9" stroke="currentColor" stroke-width="2" stroke-linecap="round"
											stroke-linejoin="round"></path>
										<circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2" stroke-linecap="round"
											stroke-linejoin="round"></circle>
									</g>
								</svg>
							</div>
							<p class="text-base font-medium text-gray-800">{{ session('success') }}</p>
						</div>
						<button onclick="this.parentElement.remove()" class="text-gray-800 hover:text-gray-600 w-6 h-6 shadow-none">
							<svg fill="currentColor" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
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
					@elseif (session('error'))
						<div class="flex items-icenter justify-between relative p-2 bg-white border border-gray-200 rounded-md shadow-lg">
							<div class="flex items-center gap-3 mr-5">
								<div class="flex items-center justify-center w-6 h-6 rounded-full text-red-600 text-base">
									<svg viewBox="0 0 24 24" class="w-6 h-6" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M12 8V13" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
										<path d="M12 16H12.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
										<circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2" />
									</svg>
								</div>
								<p class="text-base font-medium text-gray-800">{{ session('error') }}</p>
							</div>
							<button onclick="this.parentElement.remove()" class="text-gray-800 hover:text-gray-600 w-6 h-6 shadow-none">
								<svg fill="currentColor" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
									<path
										d="M18.8,16l5.5-5.5c0.8-0.8,0.8-2,0-2.8l0,0C24,7.3,23.5,7,23,7c-0.5,0-1,0.2-1.4,0.6L16,13.2l-5.5-5.5 c-0.8-0.8-2.1-0.8-2.8,0C7.3,8,7,8.5,7,9.1s0.2,1,0.6,1.4l5.5,5.5l-5.5,5.5C7.3,21.9,7,22.4,7,23c0,0.5,0.2,1,0.6,1.4 C8,24.8,8.5,25,9,25c0.5,0,1-0.2,1.4-0.6l5.5-5.5l5.5,5.5c0.8,0.8,2.1,0.8,2.8,0c0.8-0.8,0.8-2.1,0-2.8L18.8,16z">
									</path>
								</svg>
							</button>
						</div>
					@endif

			</div>
			{{-- Flash messages --}}
			@if ($errors->any())
				<div class="mb-2">
					<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
						<ul class="mt-2 list-disc list-inside text-sm">
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				</div>
			@endif

				{{-- session('error') toast rendered above --}}

			{{-- Page-specific content --}}
			@yield('content')

		</div>

	</body>
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			if (typeof renderIcons === 'function') {
				renderIcons();
			}
		});
	</script>

</html>
