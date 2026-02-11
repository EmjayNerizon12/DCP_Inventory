 @extends('layout.SchoolSideLayout')
 <title>
     @yield('title', 'DCP Dashboard')</title>

 @section('content')

     <script>
         function toggleCollapse(index) {
             const collapse = document.getElementById(`isp-container-${index}`);
             if (!collapse) return;
             collapse.classList.toggle('hidden'); // just show/hide
         }
     </script>
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
                 class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                 <button id="btnDiv1" onclick="showDiv1()" class="btn-submit rounded-full flex p-1  ">
                     <svg viewBox="0 0 24 24" class="w-8 h-8" fill="none" xmlns="http://www.w3.org/2000/svg">
                         <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                         <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                         <g id="SVGRepo_iconCarrier">
                             <path
                                 d="M9 4L9 20M15 4L15 20M3 9H21M3 15H21M6.2 20H17.8C18.9201 20 19.4802 20 19.908 19.782C20.2843 19.5903 20.5903 19.2843 20.782 18.908C21 18.4802 21 17.9201 21 16.8V7.2C21 6.0799 21 5.51984 20.782 5.09202C20.5903 4.71569 20.2843 4.40973 19.908 4.21799C19.4802 4 18.9201 4 17.8 4H6.2C5.07989 4 4.51984 4 4.09202 4.21799C3.71569 4.40973 3.40973 4.71569 3.21799 5.09202C3 5.51984 3 6.07989 3 7.2V16.8C3 17.9201 3 18.4802 3.21799 18.908C3.40973 19.2843 3.71569 19.5903 4.09202 19.782C4.51984 20 5.07989 20 6.2 20Z"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                             </path>
                         </g>
                     </svg>
                 </button>
             </div>
             <div
                 class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                 <button id="btnDiv2" onclick="showDiv2()" class="  btn-cancel rounded-full flex p-1  ">
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
             <div class="overflow-x-auto">
                 @if ($isp_content->isNotEmpty())
                     @foreach ($isp_content as $index => $content)
                         <div class=" border border-gray-400 p-6  my-4 ">

                             <div class="cursor-pointer  flex flex-col justify-center text-center 
                                 cursor-pointer text-center relative
                                  "
                                 onclick="toggleCollapse({{ $loop->iteration }})">

                                 <div class="grid w-full  grid-cols-2 gap-0">
                                     <div class="text-base text-left   font-medium tracking-wider  ">
                                         {{ $loop->iteration }}.
                                     </div>

                                     <div class="flex  justify-end ">

                                         <button
                                             class="btn-submit w-auto px-2 rounded py-0 font-normal text-base hover:bg-blue-600">
                                             &#8369;
                                             {{ number_format(isset($content->ispInfo[0]) ? $content->ispInfo[0]->cost_per_month : 0, 2) }}</button>
                                     </div>
                                 </div>



                                 <div class="scale-100 hover:scale-103 transition mb-2">

                                     <div class="text-center  whitespace-nowrap">
                                         Tap to Open/CLose
                                     </div>

                                     <div class="md:text-2xl text-md font-bold underline uppercase">
                                         {{ $content->ispList->name }}

                                     </div>

                                     <div class="text-base">
                                         {{ $content->ispConnectionType?->name }}
                                     </div>
                                 </div>
                             </div>
                             <div id="isp-container-{{ $loop->iteration }}" class="hidden space-y-4">
                                 <div class="flex w-full flex-row gap-1 justify-center items-start  ">

                                     <div
                                         class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                                         <button title="Insert Area" class="btn-submit p-1 rounded-full"
                                             onclick="showInsertArea({{ $content->id }})">

                                             @include('SchoolSide.components.svg.area_w_8')

                                         </button>
                                     </div>
                                     <div
                                         class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                                         <button title="Edit ISP" class="btn-update p-1 rounded-full"
                                             onclick='editISPDetailsModal({{ $content->pk_isp_details_id }},
                                                          {{ $content->isp_list_id }}, {{ $content->isp_connection_type_id }},
                                                          {{ $content->isp_internet_quality_id }} ,{{ $content->ispSpeedTest[0]->upload }},{{ $content->ispSpeedTest[0]->download }},
                                                           {{ $content->ispSpeedTest[0]->ping }}, "{{ $content->isp_purpose_id ?? '' }}",
                                                            @json($content->ispAreaDetails))'>
                                             @include('SchoolSide.components.svg.edit_w_8')

                                         </button>
                                     </div>
                                     <div
                                         class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                                         <button type="button" title="Remove ISP" onclick="deleteISP({{ $content->id }})"
                                             class="btn-delete p-1 rounded-full">
                                             @include('SchoolSide.components.svg.delete_w_8')


                                         </button>
                                     </div>
                                     <div
                                         class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">
                                         @php
                                             $if_exist = App\Models\ISPInfo\ISPInfo::where(
                                                 'school_internet_id',
                                                 $content->pk_isp_details_id,
                                             )->first();

                                         @endphp
                                         <button title="Internet Information"
                                             onclick="{{ $if_exist ? "showTableInfo($content->pk_isp_details_id)" : "showInfoModal($content->pk_isp_details_id)" }}"
                                             class="{{ $if_exist ? 'theme-button' : 'btn-cancel' }} p-1 rounded-full">
                                             <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                 <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                 <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                     stroke-linejoin="round"></g>
                                                 <g id="SVGRepo_iconCarrier">
                                                     <path fill-rule="evenodd" clip-rule="evenodd"
                                                         d="M13.6 3H10V6.6H13.6V3ZM13.6 10.2H10V21H13.6V10.2Z"
                                                         fill="currentColor">
                                                     </path>
                                                 </g>
                                             </svg>
                                         </button>

                                     </div>
                                 </div>
                                 <div class="overflow-x-auto">
                                     <table class="table-auto w-full border ">

                                         <thead>
                                             <tr>
                                                 <td colspan="8" class="top-header">
                                                     INTERNET SERVICE PROVIDER
                                                 </td>
                                             </tr>
                                             <tr>

                                                 <td class="sub-header   text-center tracking-wider">

                                                     Provider</th>
                                                 <td class=" sub-header   text-center tracking-wider">
                                                     Connection
                                                 </td>
                                                 <td class=" sub-header   text-center tracking-wider">
                                                     Purpose</ttdh>
                                                 <td class="sub-header   text-center tracking-wider">
                                                     Speed Test
                                                 </td>
                                                 <td class=" sub-header    text-center tracking-wider">
                                                     Quality
                                                 </td>
                                                 <td class="sub-header   text-center  tracking-wider">
                                                     Area Covered
                                                 </td>

                                             </tr>
                                         </thead>
                                         <tbody class="tracking-wide">

                                             <tr>

                                                 <td class="td-cell">
                                                     {{ $content->ispList?->name ?? '' }}
                                                 </td>
                                                 <td class="td-cell">
                                                     {{ $content->ispConnectionType?->name ?? '' }}</td>
                                                 <td class="td-cell" style="width: 20%">

                                                     {{ $content->ispPurpose->name }}</td>
                                                 <td class="td-cell">

                                                     <div class="flex flex-col">
                                                         <div class="font-normal">Upload:
                                                             {{ $content->ispSpeedTest[0]->upload }}
                                                             mbps
                                                         </div>
                                                         <div class="font-normal">Download:
                                                             {{ $content->ispSpeedTest[0]->download }}
                                                             mbps
                                                         </div>
                                                         <div class="font-normal">Ping:
                                                             {{ $content->ispSpeedTest[0]->ping }}
                                                             mbps
                                                         </div>

                                                     </div>

                                                 </td>
                                                 <td class="td-cell">
                                                     {{ $content->ispInternetQuality->name }}</td>


                                                 <td class="td-cell">
                                                     <div class="flex flex-col">
                                                         <div class="  text-left mb-2">
                                                             <div class="flex justify-start  ">

                                                                 <button title="Show Info Modal" type="button"
                                                                     onclick="showInsertArea({{ $content->id }}) "
                                                                     class="btn-submit rounded-sm px-2 py-0">
                                                                     Insert Area
                                                                 </button>

                                                             </div>
                                                         </div>
                                                         @foreach ($content->ispAreaDetails as $area)
                                                             <div
                                                                 class="flex md:flex-row flex-col justify-between md:gap-5 gap-2 border border-gray-300 px-2 py-1 rounded-sm shadow-sm mb-1">
                                                                 <div class="font-normal whitespace-nowrap"
                                                                     data-id="{{ $area->ispAreaAvailable->pk_isp_area_available_id }}">

                                                                     {{ $area?->ispAreaAvailable?->name }}


                                                                 </div>
                                                                 <div class="flex flex-row gap-2">
                                                                     <button type="button"
                                                                         onclick="editAreaModal({{ $content->pk_isp_details_id }}, {{ $area->ispAreaAvailable->pk_isp_area_available_id }})"
                                                                         class="btn-update px-2 py-0 rounded-sm">Edit
                                                                     </button>
                                                                     <button type="button"
                                                                         onclick="deleteArea({{ $content->pk_isp_details_id }}, {{ $area->ispAreaAvailable->pk_isp_area_available_id }})"
                                                                         class="btn-delete px-2 py-0 rounded-sm">Remove
                                                                     </button>
                                                                 </div>
                                                             </div>
                                                         @endforeach
                                                     </div>



                                                 </td>


                                             </tr>
                                         </tbody>
                                     </table>
                                 </div>
                             </div>
                         </div>
                     @endforeach
                 @else
                     <div class="text-center  text-base font-normal text-gray-600">
                         No ISP Details Available.
                     </div>
                 @endif
             </div>
         </div>
         <div id="divContainer2" class="hidden">
             <div id="actionContainer"></div>
             <div id="printableArea">
                 @include('SchoolSide.components.print-header')

                 <div id="report-container">
                 </div>
             </div>
         </div>
     </div>
     @include('SchoolSide.ISPQ._tableReport')
     @include('SchoolSide.components.print')
     @include('SchoolSide.ISP.partials._areaModal')
     @include('SchoolSide.ISP.partials._detailsModal')
     @include('SchoolSide.ISP.partials._modalAddInfo')
     @include('SchoolSide.ISP.partials._modalEditInfo')
     @include('SchoolSide.ISP.partials._tableInfo')
     @include('SchoolSide.ISP.partials.scripts')
     @include('SchoolSide.components._scriptSwitchButton')

 @endsection
