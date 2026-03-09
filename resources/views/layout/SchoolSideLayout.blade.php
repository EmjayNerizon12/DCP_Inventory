<!DOCTYPE html>
<html lang="en">

	<head>
		@php
			$schoolUser = Auth::guard('school')->user();
			$school = $schoolUser?->school;
			$defaultLogo = asset('icon/logo.png');
			$schoolLogo = $school?->image_path ? asset('school-logo/' . $school->image_path) : $defaultLogo;
			$faviconVersion = urlencode(($school?->image_path ?? 'default') . '-' . ($school?->updated_at?->timestamp ?? 0));
		@endphp

		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<meta name="school-logo" content="{{ $schoolLogo }}">
		<meta name="school-name" content="{{ $school->SchoolName ?? 'School Not Found' }}">
		<title>{{ $school->SchoolName ?? 'School Not Found' }}</title>
		<link id="app-favicon" rel="icon" type="image/png" href="{{ $schoolLogo }}?v={{ $faviconVersion }}">
		<link rel="shortcut icon" type="image/png" href="{{ $schoolLogo }}?v={{ $faviconVersion }}">
		<script>
			(function() {
				const preferred = @json($schoolLogo . '?v=' . $faviconVersion);
				const fallback = @json($defaultLogo);
				const img = new Image();
				img.onload = function() {
					const icon = document.getElementById('app-favicon');
					if (icon) icon.href = preferred;
				};
				img.onerror = function() {
					const icon = document.getElementById('app-favicon');
					if (icon) icon.href = fallback;
				};
				img.src = preferred;
			})();
		</script>

		@vite(['resources/css/app.css', 'resources/css/admin.css'])
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

		{{-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" /> --}}
	</head>

	@include('layout.partials.School.styles')

	<body class="antialiased bg-gray-50 flex min-h-screen thin-scroll">
		@include('layout.partials.School.header-sidebar')

		<main class="main-content" id="content">
			@include('layout.partials.School.flash-status-modals')
			@yield('content')
			@include('layout.partials.School.helpers-script')
		</main>
	</body>

	@include('layout.partials.School.layout-script')

</html>
