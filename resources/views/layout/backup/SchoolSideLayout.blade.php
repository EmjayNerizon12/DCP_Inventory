<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>
    {{-- <link rel="icon" type="image/png"
        href="{{ Auth::guard('school')->user()->school->image_path ? asset('school-logo/' . Auth::guard('school')->user()->school->image_path) : asset('icon/logo.png') }}"> --}}

    @vite(['resources/css/app.css', 'resources/css/admin.css', 'resources/js/app.js'])

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
        ['label' => 'School Information ', 'route' => 'school.profile', 'match' => 'School/profile'],
        ['label' => ' DCP Batch ', 'route' => 'school.dcp_batch', 'match' => 'School/dcp-batch'],
        [
            'label' => ' Inventory',
            'route' => 'school.dcp_inventory',
            'match' => 'School/DCPInventory',
        ],

        // [
        //     'label' => 'Item Status',
        //     'route' => 'schools.item.condition',
        //     'match' => 'School/items-condition/0',
        //     'params' => [0],
        // ],
        [
            'label' => 'Internet',
            'route' => 'schools.isp.index',
            'match' => 'School/ISP/index',
            'params' => [0],
        ],

        [
            'label' => 'CCTV',
            'route' => 'schools.cctv.index',
            'match' => 'School/CCTV/index',
            'params' => [0],
        ],
        [
            'label' => 'Biometrics ',
            'route' => 'schools.biometrics.index',
            'match' => 'School/Biometrics/index',
            'params' => [0],
        ],
        [
            'label' => 'Equipment',
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
        [
            'label' => 'Identity',
            'route' => 'schools.employee.index',
            'match' => 'School/Employee/index',
            'params' => [0],
        ],

        [
            'label' => 'Non DCP',
            'route' => 'schools.nondcpitem.index',
            'match' => 'School/NonDCPItem/index',
            'params' => [0],
        ],
        [
            'label' => 'Packages',
            'route' => 'schools.packages.info',
            'match' => 'School/packages-info/0',
            'params' => [0],
        ],
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
                            <path d="M4 6H20M4 12H20M4 18H20" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
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

                    <img src="{{ Auth::guard('school')->user()->school->image_path
                        ? asset('school-logo/' . Auth::guard('school')->user()->school->image_path)
                        : asset('icon/logo.png') }}"
                        class="h-10 w-10 md:w-14 md:h-14 rounded-full object-cover shadow-lg">

                    <div class=" truncate overflow-hidden whitespace-nowrap max-w-full md:max-w-4xs">
                        <div class="text-sm font-semibold tracking-wider truncate overflow-hidden whitespace-nowrap  ">
                            {{ Auth::guard('school')->user()->school->SchoolName ?? 'School Not Found' }}
                        </div>
                        <hr class="md:h-0.5 h-0.25 bg-white border-0 rounded">
                        <div
                            class="division-name uppercase font-bold text-white md:text-lg truncate text-sm whitespace-nowrap">
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
                        <img style="object-fit: cover;" src="{{ asset('icon/logo.png') }}" alt="User Icon"
                            class="h-8 w-8 rounded-full">
                        <span class="user-name  md:inline-block hidden">ICT COORDINATOR</span>
                        <svg class="w-6 h-6 md:block hidden transform transition-transform duration-300" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown menu -->
                    <div id="userDropdownMenu"
                        class="absolute right-0 mt-2 w-48 bg-white border border-gray-300 rounded-md shadow-lg py-1 hidden z-50 transition-all duration-200">
                        <a href="{{ url('School/profile') }}"
                            class="block px-4 py-2 text-gray-700 hover:bg-green-50">School Profile</a>
                        <a href="{{ url('School/Report/index') }}"
                            class="block px-4 py-2 text-gray-700 hover:bg-green-50">Reports</a>
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
                    class="px-5 py-1 rounded-sm h-auto tracking-wide font-semibold md:text-md text-sm transition
                {{ Request::is($link['match']) ? 'bg-blue-500 text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                    {{ $link['label'] }}
                </a>
            @endforeach

            <a href="{{ url('logout') }}" onclick="return confirm('Are you sure you want to logout?');"
                class="px-5 py-1 rounded-sm h-auto tracking-wide font-semibold md:text-md text-sm transition bg-white text-gray-700 hover:bg-gray-50">
                SchoolLogin
            </a>

        </nav>
    </header>
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




    <!-- Add Alpine.js -->
    <script src="//unpkg.com/alpinejs" defer></script>



    <style>
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


    <main class="flex-grow mt-18">

        <!-- Success Modal -->
        <div x-data="{ open: @if ($errors->any() || session('error') || session('success')) true @else false @endif }" x-show="open" class="modal items-center justify-center" x-cloak>

            <div class="modal-content p-4 text-lg small-modal flex flex-col items-center justify-center modal-enter">

                <!-- Close Button -->
                {{-- <button @click="open = false"
                    class="absolute top-2 right-2 w-8 h-8 rounded-full bg-gray-200 text-gray-600 hover:bg-gray-300 transition-colors">✕</button> --}}

                <!-- SUCCESS MODAL -->
                @if (session('success'))
                    <!-- Icon -->
                    <div class="flex justify-center mt-6">
                        <div class="w-16 h-16 rounded-full bg-green-600 flex items-center justify-center success-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path class="checkmark" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>

                    <!-- Content -->
                    <h2 class="mt-4 text-lg font-bold text-green-600">SUCCESS</h2>

                    <p class="text-gray-600 px-6 mt-2 text-md text-center">
                        {{ session('success') }}
                    </p>

                    <!-- Footer -->
                    <div class="mt-6 py-3">
                        <button @click="open = false" type="button"
                            class="text-white bg-green-600 rounded-full py-2 px-4 font-medium btn-hover">Continue</button>
                    </div>

                    <!-- ERROR MODAL -->
                @elseif ($errors->any() || session('error'))
                    <!-- Icon -->
                    <div class="flex justify-center mt-6">
                        <div class="w-16 h-16 rounded-full bg-red-600 flex items-center justify-center error-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path class="warning-lines" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="3" d="M12 9v2" />
                                <path class="warning-dot" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="3" d="M12 17h.01" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Content -->
                    <h2 class="mt-4 text-lg font-bold text-red-600">ERROR</h2>
                    <p class="text-gray-600 px-6 mt-2 text-md text-center">
                        @if (session('error'))
                            {{ session('error') }}
                        @else
                            Please fix the following issues:
                            <ul class="mt-2 list-disc list-inside text-md text-center text-red-700 mx-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </p>

                    <!-- Footer -->
                    <div class="mt-6 py-3">
                        <button @click="open = false" type="button"
                            class="text-white bg-red-600 rounded-full px-4 py-2 font-medium btn-hover">Continue</button>
                    </div>
                @endif
            </div>
        </div>


        @yield('content')
    </main>


    <!-- Footer -->
    {{-- <footer class="bg-white border-t border-gray-200 mt-2">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            <div class="text-center text-sm text-gray-500">
                <p>
                    &copy; 2025 Department of Education. National Inventory Data
                    Collection System.
                </p>
            </div>
        </div>
    </footer> --}}
</body>

</html>
