@extends('layout.Admin-Side')

<title>@yield('title', 'DCP Dashboard')</title>



@section('content')
    {{-- <div class="mt-5 mx-5 bg-white shadow-md rounded-xl border border-gray-300 px-6 py-4 flex justify-between">
        <div class="w-full flex flex-col items-start justify-center">
            <div class="text-lg md:text-4xl font-bold text-gray-700 ">e-DCP Hub - Admin Panel</div>
            <div class="text-md md:text-2xl font-semibold text-gray-700 ">Welcome back, Admin</div>
            <div class="text-sm md:text-lg text-gray-500">
                <span id="current-date-time">Jun 24, 2025 at 9:19 PM</span>
                <script>
                    function updateDateTime() {
                        const now = new Date();
                        const options = {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric',
                            hour: 'numeric',
                            minute: 'numeric',
                            second: 'numeric',
                            hour12: true
                        };
                        const formattedDateTime = now.toLocaleString('en-US', options);
                        document.getElementById('current-date-time').textContent = formattedDateTime;
                    }
                    updateDateTime();
                    setInterval(updateDateTime, 1000);
                </script>
            </div>
        </div>
        <div>
            <img src="{{ asset('icon/logo.png') }}" class="md:w-40 w-24" alt="">

        </div>
    </div> --}}
    <div class="p-2 md:mx-5 md:my-5 mx-0 my-0">
        <div class="rounded-lg overflow-hidden  py-2">

            <div class="grid md:grid-cols-4 grid-cols-2 gap-4 mb-4">

                <!-- Total Schools -->
                <div class="bg-white shadow-md rounded-md border border-gray-300 p-5 flex flex-col justify-between">
                    <div class="flex flex-col space-y-0 w-full gap-4 items-center justify-center">

                        <div class="dashboard-icon-container">
                            <div class="  bg-blue-600 dashboard-icon">
                                <svg class="w-10 h-10" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M21 10L12 5L3 10L12 15L21 10Z" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M6 11.5V17.5L12 21L18 17.5V11.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M21 10V17" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>


                        <div class="w-full">
                            <p class="dashboard-card-label">Total Number of Schools</p>
                            <h3 class="dashboard-card-value">{{ $totalSchools }}</h3>
                        </div>
                        <div class="flex justify-end items-center ">
                            <a href="{{ url('Schools/index') }}"
                                class="md:text-lg text-sm  shadow-md text-white bg-blue-600 hover:bg-blue-700 text-center rounded px-2 py-1 w-24">
                                Schools
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Total Batches -->
                <div class="bg-white shadow-md rounded-md border border-gray-300 p-5 flex flex-col justify-between">
                    <div class="flex flex-col   w-full gap-4 items-center justify-center">

                        <div class="dashboard-icon-container">
                            <div class="bg-green-600 dashboard-icon">
                                <!-- Clipboard Icon -->
                                <svg class="w-10 h-10" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M12 12V21" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M20 8L12 12L4 8" stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M11 2.6L19 7C20 7.6 20 8 20 9V16C20 17 20 17.6 19 18L12 22L5 18C4 17.6 4 17 4 16V9C4 8 4 7.6 5 7L11 2.6Z"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                        <div class="w-full">
                            <p class="dashboard-card-label">Total DCP Batch
                            </p>
                            <h3 class="dashboard-card-value">
                                {{ $totalBatches }}</h3>
                        </div>

                        <div class="flex justify-end items-center  ">
                            <a href="{{ url('Admin/DCPBatch/index') }}"
                                class="md:text-lg text-sm shadow-md text-white bg-green-600 hover:bg-green-700 text-center rounded px-2 py-1 w-24">
                                Batches
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Total Items -->
                <div class="bg-white shadow-md rounded-md   border border-gray-300 p-5 flex flex-col justify-between">
                    <div class="flex flex-col w-full gap-4 items-center justify-center">
                        <div class="dashboard-icon-container">

                            <div class="bg-yellow-500 dashboard-icon">
                                <!-- Archive Icon -->
                                <svg class="w-10 h-10" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M3 7H21V10H3V7Z" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M5 10H19V18C19 19 18 20 17 20H7C6 20 5 19 5 18V10Z" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M9 14H15" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                        <div class="w-full">
                            <p class="dashboard-card-label">Total DCP Items</p>
                            <h3 class="dashboard-card-value">{{ $totalItems }}</h3>
                        </div>

                        <div class="flex justify-end items-center ">
                            <a href="{{ url('item-type') }}"
                                class="md:text-lg text-sm shadow-md text-white bg-yellow-500 hover:bg-yellow-600 text-center rounded px-2 py-1 w-24">
                                Items
                            </a>
                        </div>
                    </div>
                </div>
                <div class="bg-white shadow-md rounded-md border border-gray-300 p-5 flex flex-col justify-between">
                    <div class="flex flex-col w-full gap-4 items-center justify-center">
                        <div class="dashboard-icon-container">

                            <div class="bg-red-600 text-white dashboard-icon">
                                <!-- Cube Icon -->
                                <svg class="md:w-10 md:h-10 w-8 h-8" fill="none" stroke="white" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path d="M12 3L3 8V16L12 21L21 16V8L12 3Z" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M3.5 7.8L12 12.5L20.5 7.8" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M12 12.5V21" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                        <div class="w-full">
                            <p class="dashboard-card-label">Total DCP Package</p>
                            <h3 class="dashboard-card-value">{{ $totalPackages }}</h3>
                        </div>

                        <div class="flex justify-end items-center ">
                            <a href="{{ url('package-type/create') }}"
                                class="md:text-lg text-sm shadow-md  text-white bg-red-600 hover:bg-red-700 text-center rounded px-2 py-1 w-24">
                                Packages
                            </a>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div style="letter-spacing: 0.05rem" class="md:text-xl text-lg font-semibold text-gray-800  my-2 mt-5">School
            Equipments Summary</div>
        <div class="grid grid-cols-2 md:grid-cols-4 md:gap-2 gap-2   my-2 ">
            <!-- Total Schools Card -->
            <div class="bg-white rounded-sm border border-gray-300 shadow-md p-1 text-center">
                <div class="bg-blue-600 h-full text-white p-4 text-center">

                    <h2 class="md:text-lg  text-md font-semibold  ">Total Number of Schools</h2>
                    <p id="total_schools" class="md:text-2xl text-2xl font-bold mt-3">--</p>
                </div>
            </div>
            <!-- ISP Card -->
            <div class="bg-white rounded-sm shadow-md p-1 border border-gray-300 text-center">
                <div style="background-color:#F7931E;" class="  h-full text-white p-4 text-center">

                    <h2 class="md:text-lg  text-md font-semibold  ">Total Number of Schools with Internet </h2>
                    <p id="isp_count" class="md:text-2xl text-2xl font-bold  mt-3">--</p>
                </div>
            </div>

            <!-- Biometric Card -->
            <div class="bg-white rounded-sm shadow-md p-1 border border-gray-300 text-center">
                <div style="background-color:#8DC63F;" class="  h-full text-white p-4 text-center">

                    <h2 class="md:text-lg  text-md font-semibold  ">Total Number of Schools with Biometrics</h2>
                    <p id="biometric_count" class="md:text-xl text-2xl font-bold  mt-3">--</p>
                </div>
            </div>
            <!-- CCTV Card -->
            <div class="bg-white rounded-sm shadow-md border border-gray-300 p-1 text-center">
                <div style="background-color:#4CAF50;" class="  h-full text-white p-4 text-center">

                    <h2 class="md:text-lg  text-md font-semibold ">Total Number of Schools with CCTV</h2>
                    <p id="cctv_count" class="md:text-xl text-2xl  font-bold  mt-3">--</p>
                </div>
            </div>

        </div>
        {{-- <div class="mx-5 my-1 bg-white border border-gray-300 shadow-xl rounded-lg overflow-hidden p-6">

        <div class="flex flex-col md:flex-row items-center justify-between gap-5">
            <div class="items-center justify-center">
                <h2 class="text-2xl text-center font-bold text-gray-800 mb-4" style="font-weight: 600">Inventory Management
                    System</h2>
                <div class="flex  items-center justify-center md:items-start md:justify-start md:mx-0">
                    <img src="{{ asset('icon/logo.png') }}" width="70" height="70" alt="">
                    <img src="{{ asset('icon/bagong-pilipinas.jpg') }}" width="70" height="70" alt="">
                </div>
                <div class="text-center md:text-left md:mx-0">
                    <h3 class="text-lg font-semibold text-gray-700">
                        Schools Division Office
                    </h3>
                    <p>
                        San Carlos City, Pangasinan
                    </p>
                </div>

            </div>
            <style>
                @keyframes float {

                    0%,
                    100% {
                        transform: translateY(0);
                    }

                    50% {
                        transform: translateY(-10px);
                    }
                }

                .animate-float {
                    animation: float 2.5s ease-in-out infinite;
                }
            </style>

            <img src="{{ asset('icon/logo-dcpinventory.jpg') }}" alt="DCP Logo"
                class="rounded-full border-2 border-blue-600 shadow-lg animate-float" width="200" height="200">

        </div>

    </div> --}}

        <!-- Card Container -->
        <div style="letter-spacing: 0.05rem" class="md:text-xl text-lg font-semibold text-gray-800 my-2 mt-5">DCP Batch
            Items Summary</div>
        <div class="grid grid-cols-1 overflow-x-auto">
            <div id="card-condition-container" class="grid md:grid-cols-3 grid-cols-2 md:gap-4 gap-2 mb-2    ">

            </div>
            <table class="w-full bg-white  border-collapse border border-gray-300 mt-3" style="letter-spacing: 0.05rem">
                <thead class="bg-white">
                    <tr>
                        <th class="px-4 py-3 border border-gray-300 uppercase">Condition</th>
                        <th class="px-4 py-3 border border-gray-300 uppercase">Count</th>
                        <th class="px-4 py-3 border border-gray-300 uppercase">Visualization</th>
                    </tr>
                </thead>
                <tbody id="condition-table"></tbody>
            </table>

            <style>
                .progress-container {
                    width: 100%;
                    background: #e5e7eb;
                    /* gray-300 */
                    border-radius: 6px;
                    height: 20px;
                    overflow: hidden;
                }

                .progress-bar {
                    height: 100%;
                    border-radius: 6px;
                    transition: width 0.4s ease;
                }
            </style>
        </div>


        <style>
            .tab-active {
                background-color: #1D4ED8;
                /* bg-blue-700 */
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
                border: 1px solid #ccc;
                /* text-white */
                color: white;
                /* scale-105 */
                /* shadow-md */
                transition: all 0.2s ease;
                /* smooth animation */
            }

            .tab-inactive {
                background-color: white;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
                border: 1px solid #ccc;
                /* bg-blue-600 */
                color: black;
                /* text-white */
                opacity: 0.95;
                /* opacity-95 */
                transition: all 0.2s ease;
                /* smooth animation */
            }

            .tab-btn:hover {
                scale: 1.05;
                /* hover:bg-blue-500 */
            }
        </style>


        <div class="space-y-5 my-5">

            <!-- TAB BUTTONS -->
            <div class="flex overflow-x-auto gap-3 mb-4" style="letter-spacing: 0.05rem">
                <button id="btn-item" class="tab-btn tab-active px-5 py-2 rounded-md  font-medium text-md">
                    DCP Product
                </button>

                <button id="btn-package" class="tab-btn tab-inactive px-5 py-2 rounded-md   font-medium  text-md">
                    DCP Package to School
                </button>

                <button id="btn-school" class="tab-btn tab-inactive px-5 py-2 rounded-md  font-medium  text-md">
                    DCP Batch to School
                </button>
            </div>

            <!-- TAB CONTENT 1 -->
            <div id="tab-item" class="tab-content">
                <div class="bg-white border border-gray-300 rounded-lg shadow-md p-6">
                    <div class="flex md:flex-row flex-col gap-4">
                        <div class="w-full">
                            <div class="h-[400px]"><canvas id="myPieChart"></canvas></div>
                        </div>
                        <div class="w-full">
                            <table class="border-collapse w-full table-auto" style="letter-spacing:0.05rem">
                                <thead class="bg-white sticky top-0">
                                    <tr>
                                        <th class="px-4 py-2 border border-gray-300 uppercase">Item Type</th>
                                        <th class="px-4 py-2 border border-gray-300 uppercase">Count</th>
                                    </tr>
                                </thead>
                                <tbody id="item-type-table"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB CONTENT 2 -->
            <div id="tab-package" class="tab-content hidden">
                <div class="bg-white border border-gray-300 rounded-lg shadow-md p-6">
                    <div class="flex md:flex-row flex-col gap-4">
                        <div class="w-full">
                            <div class="h-[400px]"><canvas id="pie_package"></canvas></div>
                        </div>
                        <div class="overflow-y-auto shadow-md w-full">
                            <table class="border-collapse w-full" style="letter-spacing:0.05rem">
                                <thead class="bg-white sticky top-0">
                                    <tr>
                                        <th class="px-4 py-2 border border-gray-300 uppercase">Package Code</th>
                                        <th class="px-4 py-2 border border-gray-300 uppercase">Package Name</th>
                                        <th class="px-4 py-2 border border-gray-300 uppercase">Total Package Acquired</th>
                                    </tr>
                                </thead>
                                <tbody id="package-type-table"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB CONTENT 3 -->
            <div id="tab-school" class="tab-content hidden">
                <div class="bg-white border border-gray-300 rounded-lg shadow-md p-6">
                    <div class="h-[400px] overflow-y-auto">
                        <canvas id="school_pie"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @include('AdminSide.Dashboard.partials._script')
@endsection
