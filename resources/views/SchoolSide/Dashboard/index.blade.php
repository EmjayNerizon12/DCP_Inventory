{{-- filepath: resources/views/SchoolSide/dashboard.blade.php --}}

@extends('layout.SchoolSideLayout')

@section('title', 'DCPMS Dashboard')

@section('content')
    <input type="hidden" id="school_id" value="{{ Auth::guard('school')->user()->school->pk_school_id }}">
    <div class="md:p-6 p-2">
        <div class="bg-white shadow mb-4 p-6 flex items-center justify-between border border-gray-300 rounded-md  ">
            <!-- Left: Title -->
            <div class="space-y-2">
                <div class=" truncate overflow-hidden whitespace-nowrap max-w-full md:max-w-4xs">
                    <div class="text-sm font-semibold tracking-wider truncate overflow-hidden whitespace-nowrap  ">
                        DCP Management System
                    </div>
                    <hr class="md:h-0.5 h-0.25 bg-black border-0 rounded">
                    <div class="division-name uppercase font-bold text-black md:text-lg truncate text-sm whitespace-nowrap">
                        Schools Division Office
                    </div>
                    <div class="san-carlos md:text-sm text-xs text-black font-normal uppercase">
                        San Carlos City
                    </div>
                </div>

                <div class="flex gap-2">
                    <img class="h-14 w-auto rounded-lg object-contain  " src="{{ asset('icon/bagong-pilipinas.jpg') }}"
                        alt="">
                    <img class="h-14 w-auto rounded-full object-contain border border-gray-300 shadow-md"
                        src="{{ asset('icon/sdo-logo.png') }}" alt="">
                    <img class="h-14  md:hidden block  w-auto rounded-full object-contain border border-gray-300 shadow-md"
                        src="{{ asset('icon/logo.png') }}" alt="">
                    <img class="h-14 w-14 rounded-full object-cover border border-gray-300 shadow-md"
                        src="{{ Auth::guard('school')->user()->school->image_path ? asset('school-logo/' . Auth::guard('school')->user()->school->image_path) : asset('icon/logo.png') }}"
                        alt="SDO Logo">


                </div>
            </div>
            <div class="flex flex-row gap-2">

                <div>
                    <img class="h-32 md:block hidden p-1 border border-gray-300 shadow-md w-32 rounded-full object-contain"
                        src="{{ asset('icon/sdo-logo.png') }}" alt="SDO Logo">
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
            <div class="dashboard-title tracking-wider font-medium">School Information Preview</div>
            <div class="spinner-container my-10" id="spinner-container">
                <div class="spinner-md"></div>
            </div>


            <div id="equipment-card-info" class="hidden"></div>
            <div id="learner-card-info" class="hidden"></div>
            <div id="dcp-card-info" class="hidden"></div>
            <div id="condition-table-list" class="hidden overflow-x-auto"></div>
            <div id="dcp-card-products" class="hidden overflow-x-auto"></div>
            <div id="dcp-card-package-type" class="hidden overflow-x-auto"></div>
        </div>
        @include('SchoolSide.Dashboard.partials._script')
    </div>

@endsection
