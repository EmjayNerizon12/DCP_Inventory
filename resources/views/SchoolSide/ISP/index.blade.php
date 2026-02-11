 @extends('layout.SchoolSideLayout')
 <title>
     @yield('title', 'DCP Dashboard')</title>

 @section('content')
     <div class="md:p-6 p-2">
         <input type="hidden" id="school_id" value="{{ Auth::guard('school')->user()->school->pk_school_id }}">
         <div class="flex justify-start mb-4 space-x-4">
             <div
                 class="h-16 w-16 hidden bg-white p-3 border border-gray-300 shadow-lg rounded-full flex items-center justify-center">
                 <div class="text-white bg-blue-600 p-2 rounded-full">
                     <svg class="h-10 w-10" fill="currentColor" viewBox="0 0 96 96" xmlns="http://www.w3.org/2000/svg">
                         <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                         <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                         <g id="SVGRepo_iconCarrier">
                             <title></title>
                             <g>
                                 <path d="M48,60A12,12,0,1,0,60,72,12.0081,12.0081,0,0,0,48,60Z"></path>
                                 <path
                                     d="M22.6055,46.6289A5.9994,5.9994,0,1,0,31.1133,55.09a24.2258,24.2258,0,0,1,33.7734,0,5.9512,5.9512,0,0,0,4.2539,1.77,6,6,0,0,0,4.2539-10.23C59.7773,32.918,36.2227,32.918,22.6055,46.6289Z">
                                 </path>
                                 <path
                                     d="M90.27,29.7773a59.1412,59.1412,0,0,0-84.539,0,5.9994,5.9994,0,1,0,8.5312,8.4375c18.1172-18.3281,49.3594-18.3281,67.4766,0A5.9994,5.9994,0,1,0,90.27,29.7773Z">
                                 </path>
                             </g>
                         </g>
                     </svg>
                 </div>
             </div>
             <div>

                 <div class="page-title">
                     Internet Service Provider
                 </div>
                 <div class="page-subtitle">The following is the list of ISP information for your school.</div>
             </div>


         </div>
         <div class="flex gap-2 mb-4">
             <div
                 class="action-button">

                 <button id="btnDiv1" onclick="showDiv1()" class="btn-submit rounded-full flex p-1  ">
                     @include('SchoolSide.components.svg.dashboard_w_8')
                
                 </button>
             </div>
             <div
                 class="action-button">

                 <button id="btnDiv2" onclick="showDiv2()" class="btn-gray rounded-full flex p-1  ">
                     @include('SchoolSide.components.svg.report_w_8')

                 </button>
             </div>
         </div>
         <div id="divContainer1">
             <div class="flex justify-start my-2">
                 <button title="Show Info Modal" type="button" onclick="openISPDetailsModal()" class="theme-button">
                     Add New ISP
                 </button>
             </div>
             <div id="internetCardContainer">
             </div>
         </div>
         <div id="divContainer2" class="hidden">
             <div id="actionContainer"></div>
             <div id="printableArea">
                 @include('SchoolSide.components.print-header')
                 <div class="overflow-x-auto shadow-md">
                     <div id="report-container">
                     </div>
                 </div>
             </div>
         </div>
     </div>
     @include('SchoolSide.ISP.partials.scripts')
     @include('SchoolSide.components.print')
     @include('SchoolSide.ISP.partials._areaModals')
     @include('SchoolSide.ISP.partials._internetModals')
     @include('SchoolSide.ISP.partials._infoModals')
     @include('SchoolSide.ISP.partials._showInfo')
     @include('SchoolSide.ISP.partials._showArea')
     @include('SchoolSide.components._scriptSwitchButton')
     {{-- FROM ISP QUESTION FOLDER --}}
     @include('SchoolSide.ISP.partials._tableReportandModal')
 @endsection
