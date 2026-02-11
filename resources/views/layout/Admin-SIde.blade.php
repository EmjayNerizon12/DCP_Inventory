<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('icon/logo.png') }}">

    @vite(['resources/css/app.css', 'resources/css/admin.css', 'resources/js/app.js'])

</head>

<body class="antialiased bg-gray-50 flex min-h-screen">
    @include('layout.partials.Admin._style')
    @include('layout.partials.Admin.header')
    @include('layout.partials.Admin.sidebar')
    @include('layout.partials.Admin._script')


    <div class="main-content" id="content">
        {{-- Flash messages --}}
        @if ($errors->any())
            <div class="mb-4">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <ul class="mt-2 list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            </div>
        @endif

        @if (session('success'))
            <div class="mb-4">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        {{-- Page-specific content --}}
        @yield('content')

    </div>

</body>

</html>
