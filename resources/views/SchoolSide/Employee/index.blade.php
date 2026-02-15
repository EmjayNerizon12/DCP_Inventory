@extends('layout.SchoolSideLayout')
<title>
    @yield('title', 'DCP Dashboard')</title>

@section('content')
    {{-- ===== Add Employee Modal ===== --}}
    {{-- Add Employee Modal --}}

    @include('SchoolSide.Employee.partials._modalAdd')

    {{-- ===== Edit Employee Modal ===== --}}
    @include('SchoolSide.Employee.partials._modalEdit')

    @include('SchoolSide.Employee.partials._modalEmployeeInfo')

    <input type="hidden" id="school_id" value="{{ Auth::guard('school')->user()->school->pk_school_id }}">
    <input type="hidden" id="school_name" value="{{ Str::slug(Auth::guard('school')->user()->school->SchoolName, '_') }}">

    <div class="md:p-6 p-2">
        <div class="flex justify-start space-x-4 mb-2">

            <div
                class="h-16 w-16 hidden bg-white p-3 border border-gray-300 shadow-lg rounded-full flex items-center justify-center">
                <div class="text-white bg-blue-600 p-2 rounded-full">
                    @include('SchoolSide.components.svg.employee-lg')
                </div>
            </div>
            <div>
                <div class="page-title">Digital Identity</div>
                <div class="page-subtitle">School's Personnel/Employee Complete Information</div>

            </div>
        </div>
          <div class="flex gap-2 mb-4">
             <div class="action-button">
                 <button id="btnDiv1" onclick="showDiv1()" class="btn-submit rounded-full flex p-1  ">
                     @include('SchoolSide.components.svg.user-sm')
                 </button>
             </div>
             <div
                 class="action-button">

                 <button id="btnDiv2" onclick="showDiv2()" class="btn-gray rounded-full flex p-1  ">
                     @include('SchoolSide.components.svg.card-sm')

                 </button>
             </div>
         </div>
        <div class="spinner-container my-4 hidden" id="card-spinner">
            <div class="spinner-md"></div>
        </div>
        <div id="divContainer2">
            <div id="card-container" class="grid grid-cols-2 md:grid-cols-6 gap-3 my-2 hidden"></div>
        </div>
        <div id="divContainer1">

        <div class="flex sm:flex-row flex-col justify-between gap-2  ">
            <div class="w-full">

                <div class="flex justify-start gap-2 w-full  ">

                    <input placeholder="Search by Name or Employee Number" type="text"
                        class="form-input w-base max-w-sm md:text-base text-xs " id="searchTerm">
                    <button type="button" class="btn-submit px-4 py-1 rounded" id="search"
                        onclick="searchEmployee()">Search</button>
                </div>
            </div>
            <div class="flex flex-col justify-start">
                <div>
                    <button title="Show Info Modal" type="button" onclick="openModal()"
                        class="btn-submit px-4 py-1 rounded w-auto">
                        Add Employee
                    </button>
                </div>
            </div>

        </div>

        <div class="overflow-y-auto text-base">
            <div id="employeeTable" class="hidden">
            </div>
        </div>
        <div class="spinner-container my-4" id="spinner-container">
            <div class="spinner-md"></div>
        </div>
    </div>
</div>
@include('SchoolSide.components._scriptSwitchButton')

    @include('SchoolSide.Employee.partials._script')
@endsection
