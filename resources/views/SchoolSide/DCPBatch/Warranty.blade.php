@extends('layout.SchoolSideLayout')

<title>@yield('title', 'Warranty Status of Items')</title>

@section('content')
    <div class="p-6">

        @if ($warranty)
            <div class="flex flex-row justify-start items-start gap-2 w-full">
                <div class="inline-flex  items-center text-blue-600  text-base font-semibold hover:underline  ">

                    <div
                        class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                        <button onclick="window.history.back()" class="  btn-submit  p-1 rounded-full">
                            <svg fill="currentColor" class="w-8 h-8" version="1.1" id="Layer_1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                viewBox="0 0 472.615 472.615" xml:space="preserve">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <g>
                                        <g>
                                            <path
                                                d="M167.158,117.315l-0.001-77.375L0,193.619l167.157,153.679v-68.555c200.338,0.004,299.435,153.932,299.435,153.932 c3.951-19.967,6.023-40.609,6.023-61.736C472.615,196.295,341.8,117.315,167.158,117.315z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class=" w-full">

                    <div class="page-title">
                        Warranty of DCP Product
                    </div>
                    <div class="page-subtitle">
                        Monitor the warranty status of your DCP items
                    </div>

                </div>
            </div>
            <div
                class="bg-white   w-full border border-gray-300 rounded-sm p-6 shadow-lg hover:shadow-xl transition-all duration-300">

                <div class="flex justify-between">

                    <div class="mb-3">
                        <p class="text-sm font-semibold text-gray-500">Batch</p>

                        <h2 class="text-xl font-bold text-green-700">
                            {{ $warranty?->batchItem?->dcpBatch?->batch_label ?? 'N/A' }}
                        </h2>
                    </div>
                    <div class="mb-5 md:block hidden">
                        @php
                            $status = $warranty?->status?->name ?? null;

                        @endphp

                        <button
                            class="px-4 py-1 rounded {{ $status === 'Expired' ? 'btn-delete hover:bg-red-600' : 'btn-green hover:bg-green-600' }}">

                            {{ $status ?? 'N/A' }}
                        </button>

                        {{-- <p class="text-sm font-semibold text-gray-500 mt-1">Warranty Status</p> --}}
                    </div>
                </div>
                <div class="mb-3">
                    <h2 class="text-xl font-bold text-green-700">
                        <p class="text-sm font-semibold text-gray-500">Product/Item</p>

                        {{ $warranty->batchItem->dcpItemType->name ?? 'N/A' }}
                    </h2>
                </div>

                <!-- Serial Number -->
                <div class="mb-3">
                    <p class="text-sm font-semibold text-gray-500">Serial Number</p>

                    <p class="text-lg font-semibold text-blue-700 tracking-wide">
                        {{ $warranty->batchItem->generated_code ?? 'N/A' }}
                    </p>
                </div>

                <!-- Warranty Status Badge -->


                <!-- Start / End Dates -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-1  text-base text-center mb-3">
                    <div class="bg-green-200 p-2 border border-gray-800">
                        <p class="text-gray-800 font-medium">Start Date</p>
                        <p class="text-gray-800">
                            {{ \Carbon\Carbon::parse($warranty->warranty_start_date ?? null)->format('M d, Y') }}
                        </p>
                    </div>
                    <div class="bg-red-200 p-2 border border-gray-800">
                        <p class="text-gray-800 font-medium">End Date</p>
                        <p class="text-gray-800">
                            {{ \Carbon\Carbon::parse($warranty->warranty_end_date ?? null)->format('M d, Y') }}
                        </p>
                    </div>
                    <div class="bg-blue-200 p-2 border border-gray-800">
                        <p class="text-gray-800 font-medium">Remaining</p>
                        @php

                            $endDate = \Carbon\Carbon::parse($warranty->warranty_end_date ?? null);
                            $now = \Carbon\Carbon::now();
                            $diff = $now->diff($endDate);
                        @endphp

                        <p class="text-gray-800 font-semibold text-lg">
                            {{ $diff->y }}years, {{ $diff->m }}months, {{ $diff->d }}days

                        </p>
                    </div>
                </div>


            </div>
        @else
            <div class="text-center text-gray-500 text-lg mt-12 font-[Verdana]">
                No warranty records found.
            </div>
        @endif
    </div>
@endsection
