 @extends('layout.SchoolSideLayout')
 <title>
     @yield('title', 'DCP Dashboard')</title>

 @section('content')
     <div class="p-6">
        <input type="hidden" id="school_id" value="{{Auth::guard('school')->user()->school->pk_school_id}}">
         <div class="flex justify-start mb-2 space-x-4">
             <div
                 class="h-16 w-16 hidden bg-white p-3 border border-gray-300 shadow-lg rounded-full flex items-center justify-center">
                 <div class="text-white bg-blue-600 p-2 rounded-full">
                     <svg class="h-10 w-10" fill="currentColor" version="1.1" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 280.606 280.606" xmlns:xlink="http://www.w3.org/1999/xlink"
                         enable-background="new 0 0 280.606 280.606" transform="matrix(-1, 0, 0, 1, 0, 0)">
                         <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                         <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                         <g id="SVGRepo_iconCarrier">
                             <g>
                                 <path
                                     d="m278.161,191.032l-149.199-149.199c-3.89-3.89-10.253-3.89-14.143,0l-55.861,55.861c-3.89,3.89-3.89,10.411 0,14.302l14.098,14.256h-40.056v-23.317c0-5.5-4.44-9.683-9.94-9.683h-13c-5.5,0-10.06,4.183-10.06,9.683v79c0,5.5 4.56,10.317 10.06,10.317h13c5.5,0 9.94-4.817 9.94-10.317v-22.683h73.056l78.767,78.607c3.89,3.891 11.097,4.979 16.016,2.52l75.449-37.764c4.919-2.459 5.763-7.693 1.873-11.583zm-162.104-127.81c3.223-3.222 8.445-3.222 11.668-7.10543e-15 3.222,3.223 3.222,8.445 0,11.667-3.223,3.223-8.445,3.223-11.668,0.001-3.222-3.222-3.222-8.445 1.42109e-14-11.668zm53.349,135.373l-94.007-94.007 11.313-11.313 94.007,94.007-11.313,11.313z">
                                 </path>
                             </g>
                         </g>
                     </svg>
                 </div>
             </div>
             <div>
                 <div class="page-title">CCTV Information</div>
                 <div class="page-subtitle">Create, View, Edit and Remove
                     Details</div>


             </div>
         </div>
         
         <div class="flex justify-between items-center gap-4 ">

             <button title="Show Info Modal" type="button" onclick="renderAddCCTVModal(1)" class="btn-submit px-4 py-1 rounded">
                 Add CCTV Record
             </button>

             <div
                 class="action-button hidden">

                 <button class="btn-cancel  p-1 rounded-full" onclick="window.print()">
                     <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                         <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                         <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                         </g>
                         <g id="SVGRepo_iconCarrier">
                             <path fill-rule="evenodd" clip-rule="evenodd"
                                 d="M17 7H7V6h10v1zm0 12H7v-6h10v6zm2-12V3H5v4H1v8.996C1 17.103 1.897 18 3.004 18H5v3h14v-3h1.996A2.004 2.004 0 0 0 23 15.996V7h-4z"
                                 fill="currentColor"></path>
                         </g>
                     </svg>
                 </button>
                </div>
            </div>
            
        @include('SchoolSide.CCTV.partials._addCCTVModal')
        @include('SchoolSide.CCTV.partials._editCCTVModal')
        @include('SchoolSide.CCTV.partials.scripts')
        @include('SchoolSide.components.print')
         
        <div id="printableArea">
             @include('SchoolSide.components.print-header')
             @include('SchoolSide.CCTV.partials._tableCCTV')
         </div>
     </div>
    
 @endsection
