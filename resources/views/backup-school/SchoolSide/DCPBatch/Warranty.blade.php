@extends('layout.SchoolSideLayout')

<title>@yield('title', 'Warranty Status of Items')</title>

@section('content')
    <div class="  my-5 mx-5 max-w-full  px-4     font-[Verdana]">
        @if ($warranties->count())
            <div class="flex flex-col justify-center items-center w-full">

                @foreach ($warranties as $warranty)
                    <div class="border-1 w-full">
                        <a onclick="history.back()"
                            class="inline-flex border-1 items-center cursor-pointer text-blue-600 w-full text-left text-md font-semibold hover:underline">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                            </svg>
                            DCP Item
                        </a>
                        <h2 class="text-2xl  border-1 w-full font-bold text-blue-700  text-left">Warranty of DCP Item</h2>
                        <p class="mb-2 w-full border-1 text-left">Monitor the warranty status of your DCP items</p>
                    </div>

                    <div
                        class="bg-white   w-full border border-gray-300 rounded-sm p-6 shadow-lg hover:shadow-xl transition-all duration-300">
                        <!-- Item Type -->

                        {{-- <div class="mb-3">
                            <h2 class="text-xl font-bold text-blue-700">
                                {{ $warranty->batchItem->dcpBatch->school->SchoolName ?? 'N/A' }}
                            </h2>
                            <p class="text-sm text-gray-500">School</p>
                        </div> --}}

                        <div class="flex justify-between">

                            <div class="mb-3">
                                <h2 class="text-xl font-bold text-green-700">
                                    {{ $warranty->batchItem->dcpBatch->batch_label ?? 'N/A' }}
                                </h2>
                                <p class="text-sm font-semibold text-gray-500">Batch</p>
                            </div>
                            <div class="mb-5">
                                <span
                                    class="inline-block px-4 py-1 rounded-full text-sm font-bold text-white
                                {{ $warranty->status->name === 'Expired' ? 'bg-red-500' : 'bg-green-600' }}">
                                    {{ $warranty->status->name ?? 'N/A' }}
                                </span>
                                {{-- <p class="text-sm font-semibold text-gray-500 mt-1">Warranty Status</p> --}}
                            </div>
                        </div>
                        <div class="mb-3">
                            <h2 class="text-xl font-bold text-green-700">
                                {{ $warranty->batchItem->dcpItemType->name ?? 'N/A' }}
                            </h2>
                            <p class="text-sm font-semibold text-gray-500">Product/Item</p>
                        </div>

                        <!-- Serial Number -->
                        <div class="mb-3">
                            <p class="text-lg font-semibold text-blue-700 tracking-wide">
                                {{ $warranty->batchItem->generated_code ?? 'N/A' }}
                            </p>
                            <p class="text-sm font-semibold text-gray-500">Serial Number</p>
                        </div>

                        <!-- Warranty Status Badge -->


                        <!-- Start / End Dates -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-1 text-md text-center mb-3">
                            <div class="bg-green-200 p-2 border border-gray-800">
                                <p class="text-gray-800 font-medium">Start Date</p>
                                <p class="text-gray-800">
                                    {{ \Carbon\Carbon::parse($warranty->warranty_start_date)->format('M d, Y') }}
                                </p>
                            </div>
                            <div class="bg-red-200 p-2 border border-gray-800">
                                <p class="text-gray-800 font-medium">End Date</p>
                                <p class="text-gray-800">
                                    {{ \Carbon\Carbon::parse($warranty->warranty_end_date)->format('M d, Y') }}
                                </p>
                            </div>
                            <div class="bg-blue-200 p-2 border border-gray-800">
                                <p class="text-gray-800 font-medium">Remaining</p>
                                @php

                                    $endDate = \Carbon\Carbon::parse($warranty->warranty_end_date);
                                    $now = \Carbon\Carbon::now();
                                    $diff = $now->diff($endDate);
                                @endphp

                                <p class="text-gray-800 font-semibold text-lg">
                                    {{ $diff->y }}years, {{ $diff->m }}months, {{ $diff->d }}days

                                </p>
                            </div>
                        </div>


                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center text-gray-500 text-lg mt-12 font-[Verdana]">
                No warranty records found.
            </div>
        @endif
    </div>
@endsection
