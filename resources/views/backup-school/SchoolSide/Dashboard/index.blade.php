{{-- filepath: resources/views/SchoolSide/dashboard.blade.php --}}

@extends('layout.SchoolSideLayout')

@section('title', 'DCPMS Dashboard')

@section('content')

    <div class="p-6">
        <div class="bg-white shadow mb-4 p-6 flex items-center justify-between border border-gray-300 rounded-lg  ">
            <!-- Left: Title -->
            <div>
                <h1 class="text-2xl font-bold text-blue-600">
                    A Centralized ICT Package Management
                </h1>
                <p class="text-gray-500 text-lg mt-1">
                    for SDO San Carlos City Public Schools
                </p>
                <div class="flex">
                    <img class="h-16 w-auto rounded-lg object-contain" src="{{ asset('icon/bagong-pilipinas.jpg') }}"
                        alt="">
                    <img class="h-16 w-auto rounded-lg object-contain" src="{{ asset('icon/sdo-logo.png') }}" alt="">
                </div>
            </div>
            <div class="flex flex-row gap-2">

                <div>
                    <img class="h-32 md:block hidden p-1 border border-gray-300 shadow-md w-32 rounded-full object-contain"
                        src="{{ Auth::guard('school')->user()->school->image_path ? asset('school-logo/' . Auth::guard('school')->user()->school->image_path) : asset('icon/logo.png') }}"
                        alt="SDO Logo">
                </div>
                <div>
                    <img class="h-32 md:block hidden p-1 border border-gray-300 shadow-md w-32 rounded-full object-contain"
                        src="{{ asset('icon/logo.png') }}" alt="SDO Logo">
                </div>
            </div>


            @php
                $school = Auth::guard('school')->user()->school->SchoolName;
            @endphp

            @php
                App\Models\DCPItemWarrantyStatus::whereRaw('DATEDIFF(warranty_end_date, NOW()) < 0')->update([
                    'warranty_status_id' => 2,
                ]);
            @endphp

        </div>

        <div>
            <div class="dashboard-title">School's Dashboard</div>
            <div id="equipment-card-info"></div>
            <div id="learner-card-info"></div>
            <div id="dcp-card-info"></div>
            <div id="dcp-card-condition"></div>
            <div id="condition-table-list"></div>
            <div id="dcp-card-package-type"></div>
        </div>
        @include('SchoolSide.Dashboard.partials._script')
    </div>

@endsection
