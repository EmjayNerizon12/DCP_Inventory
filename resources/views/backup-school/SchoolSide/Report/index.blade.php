 @extends('layout.SchoolSideLayout')
 <title>
     @yield('title', 'DCP Dashboard')</title>

 @section('content')
     <div class="bg-white my-10 mx-5  p-6    border border-gray-300 rounded-lg shadow-md">

         <div class="text-2xl font-bold text-blue-700 mb-4">School Reports Generation</div>
         <div class="mt-4">
             <div class="text-md text-gray-700 border-b border-gray-400  " style="width:fit-content">The list below must be
                 completed and submitted to process your report.</div>
             <div class="mt-4 ">


                 <!-- DCP Batch Received -->
                 <div class="text-md text-gray-700">
                     <b> DCP Batch Received -</b>

                     @if ($batches->isEmpty())
                         <span class="text-red-600 hover:underline">

                             <a href="{{ route('school.dcp_batch') }}">(No Record)</a>
                         </span>
                     @else
                         <span class="text-green-600 hover:underline ">
                             <a href="{{ route('school.dcp_batch') }}">({{ $batches->count() }} Batches Received)</a>
                         </span>
                     @endif
                 </div>


                 <div class="text-md text-gray-700">
                     <b>School Officials Information -</b>

                     @php
                         $is_complete = '';
                         $principal_name = Auth::guard('school')->user()->school->PrincipalName;
                         $principal_contact = Auth::guard('school')->user()->school->PrincipalContact;
                         $principal_email = Auth::guard('school')->user()->school->PrincipalEmail;

                         $ict_name = Auth::guard('school')->user()->school->ICTName;
                         $ict_contact = Auth::guard('school')->user()->school->ICTContact;
                         $ict_email = Auth::guard('school')->user()->school->ICTEmail;

                         $custodian_name = Auth::guard('school')->user()->school->CustodianName;
                         $custodian_contact = Auth::guard('school')->user()->school->CustodianContact;
                         $custodian_email = Auth::guard('school')->user()->school->CustodianEmail;

                         if ($principal_name && $principal_contact && $principal_email) {
                             $is_complete = 'Yes';
                         } else {
                             $is_complete = 'No';
                         }
                     @endphp
                     @if ($is_complete == 'No')
                         <span class="text-red-600 hover:underline">
                             <a href="{{ route('school.profile') }}">(There are missing information needed)</a></span>
                     @else
                         <span class="text-green-600 hover:underline ">

                             <a href="{{ route('school.profile') }}">(Information Completed)</a>
                         </span>
                     @endif
                 </div>

                 <div class="text-md text-gray-700">
                     <b> School Statistics </b>(eg. No. of Learners, No. of Teachers) -
                     @php
                         $school_data = App\Models\SchoolData::where(
                             'pk_school_id',
                             Auth::guard('school')->user()->school->pk_school_id,
                         )->first();
                         $is_complete_school_data = '';
                         if ($school_data) {
                             $is_complete_school_data = 'Yes';
                         } else {
                             $is_complete_school_data = 'No';
                         }
                     @endphp
                     @if ($is_complete_school_data == 'Yes')
                         <span class="text-green-600 hover:underline ">
                             <a href="{{ route('school.profile') }}">(Information Completed)</a>
                         </span>
                     @else
                         <span class="text-red-600 hover:underline">

                             <a href="{{ route('school.profile') }}">(No Record)</a>
                         </span>
                     @endif
                 </div>


                 <!-- Internet Service Provider -->
                 <div class="text-md text-gray-700">
                     <b>Internet Service Provider -</b>

                     @if ($ISP->isEmpty())
                         <span class="text-red-600  hover:underline">
                             <a href="{{ route('schools.isp.index') }}">(No Record Found)</a>
                         </span>
                     @else
                         <span class="text-green-600 hover:underline">
                             <a href="{{ route('schools.isp.index') }}">(Information Complete)</a>


                         </span>
                     @endif
                 </div>

                 <!-- Biometric Details -->
                 <div class="text-md text-gray-700">
                     <b>Biometric Details -</b>
                     @if ($BiometricDetails->isEmpty())
                         <span class="text-red-600 ">

                             <a href="{{ route('schools.equipment.index') }}">(No Record)</a></span>
                     @else
                         <span class="text-green-600 hover:underline">
                             <a href="{{ route('schools.equipment.index') }}">(Information Completed)</a></span>
                         </span>
                     @endif
                 </div>

                 <!-- CCTV Details -->
                 <div class="text-md text-gray-700">
                     <b>CCTV Details -</b>
                     @if ($CCTVDetails->isEmpty())
                         <span class="text-red-600  hover:underline"> <a href="{{ route('schools.equipment.index') }}">(No
                                 Record Found)</a></span>
                     @else
                         <span class="text-green-600 hover:underline"><a
                                 href="{{ route('schools.equipment.index') }}">(Information Completed)</a></span>
                     @endif
                 </div>


             </div>

         </div>

     </div>


     @if (!$batches->isEmpty())
         <div class="  mx-5"> <button class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700"
                 onclick="printDiv('printArea')">Print
                 Report</button>
         </div>
         <div id="printArea" class="bg-white my-2 mx-5  p-6    border border-gray-300 rounded-lg shadow-md">
             <style>
                 @media print {
                     thead tr th {
                         background-color: #eeeeee !important;
                         /* Blue background */
                         border: 1px solid #cecece !important;
                         color: #303030 !important;
                         /* White text */
                         -webkit-print-color-adjust: exact !important;
                         print-color-adjust: exact !important;
                     }
                 }
             </style>
             <div class="flex flex-col justify-center items-center mb-4">

                 <img class="h-24 w-24 object-cover rounded-full border-2 border-gray-300"
                     src="{{ Auth::guard('school')->user()->school->image_path ? asset('school-logo/' . Auth::guard('school')->user()->school->image_path) : asset('icon/logo.png') }}"
                     alt="">
                 <div class="text-4xl font-bold text-gray-700">{{ Auth::guard('school')->user()->school->SchoolName }}
                 </div>
                 <div class="text-md text-gray-500">School Report - Generated on: <span id="current-time-date"></span></div>
             </div>
             {{-- SCHOOL PROFILE --}}
             <div class="mb-10">
                 <div class="text-lg text-gray-800 font-bold">School Profile</div>
                 <hr>
                 <div class="grid md:grid-cols-2 grid-cols-1 gap-4 mt-2">
                     <div class="grid grid-cols-2   px-2 rounded">
                         <div class="font-semibold   ">School ID:</div>
                         <div>{{ Auth::guard('school')->user()->school->SchoolID }}</div>
                     </div>
                     <div class="grid grid-cols-2   px-2 rounded">
                         <div class="font-semibold   ">School Name:</div>
                         <div>{{ Auth::guard('school')->user()->school->SchoolName }}</div>
                     </div>
                     <div class="grid grid-cols-2   px-2 rounded">
                         <div class="font-semibold   ">School District:</div>
                         <div>{{ Auth::guard('school')->user()->school->District }}</div>
                     </div>


                     <div class="grid grid-cols-2   px-2 rounded">
                         <div class="font-semibold   ">School Accesibility:</div>
                         <div>Non-Remote School </div>
                     </div>
                     <div class="grid grid-cols-2   px-2 rounded">
                         <div class="font-semibold   ">School Categories:</div>
                         <div>UIs</div>
                     </div>
                     <div class="grid grid-cols-2   px-2 rounded">
                         <div class="font-semibold   ">School Offerings:</div>
                         <div>{{ Auth::guard('school')->user()->school->SchoolLevel }}</div>
                     </div>
                     <div class="grid grid-cols-2   px-2 rounded">
                         <div class="font-semibold   ">School Address:</div>
                         <div class="flex flex-col gap-1">
                             <div>Latitude: {{ Auth::guard('school')->user()->school->schoolCoordinates->Latitude }}</div>
                             <div>Longitude: {{ Auth::guard('school')->user()->school->schoolCoordinates->Longitude }}
                             </div>
                         </div>
                     </div>

                 </div>
             </div>
             {{-- current statistics --}}
             <div class="mb-10">
                 <div class="text-lg text-gray-800 font-bold">Current Statistics</div>
                 <hr>

                 <div class="grid md:grid-cols-2 grid-cols-1 gap-4">
                     <div class="grid grid-cols-2   px-2 rounded">
                         <div class="font-semibold">Total Classrooms: </div>
                         <div>
                             @php
                                 $total_classrooms = App\Models\SchoolData::where(
                                     'pk_school_id',
                                     Auth::guard('school')->user()->school->pk_school_id,
                                 )->sum('Classrooms');
                                 echo $total_classrooms;
                             @endphp
                         </div>
                     </div>
                     <div class="grid grid-cols-2   px-2 rounded">
                         <div class="font-semibold">Classrooms with Smart TV: </div>
                         <div>
                             {{ Auth::guard('school')->user()->school->classroom_with_tv }}
                         </div>
                     </div>
                     <div class="grid grid-cols-2   px-2 rounded">
                         <div class="font-semibold">Total Enrollment: </div>
                         <div>
                             @php
                                 $total_learners = App\Models\SchoolData::where(
                                     'pk_school_id',
                                     Auth::guard('school')->user()->school->pk_school_id,
                                 )->sum('RegisteredLearners');
                                 echo $total_learners;
                             @endphp
                         </div>
                     </div>
                     <div class="grid grid-cols-2   px-2 rounded">
                         <div class="font-semibold">Total Teachers: </div>
                         <div>
                             @php
                                 $total_teachers = App\Models\SchoolData::where(
                                     'pk_school_id',
                                     Auth::guard('school')->user()->school->pk_school_id,
                                 )->sum('Teachers');
                                 echo $total_teachers;
                             @endphp
                             {{-- {{ Auth::guard('school')->user()->school->schoolData->RegisteredLearners }} --}}
                         </div>
                     </div>
                     <div class="grid grid-cols-2   px-2 rounded">
                         <div class="font-semibold">Total Non-Teaching: </div>
                         <div>
                             {{ Auth::guard('school')->user()->school->total_no_teaching }}
                         </div>
                     </div>
                     <div class="grid grid-cols-2   px-2 rounded">
                         <div class="font-semibold">Smart TV Ratio: </div>
                         <div>
                             @php

                                 $total_classrooms = App\Models\SchoolData::where(
                                     'pk_school_id',
                                     Auth::guard('school')->user()->school->pk_school_id,
                                 )->sum('Classrooms');

                                 if ($total_classrooms != 0) {
                                     $smart_tv = Auth::guard('school')->user()->school->classroom_with_tv;
                                     $ratio = ($smart_tv / $total_classrooms) * 100;
                                 } else {
                                     $ratio = 0;
                                 }

                             @endphp
                             {{ number_format($ratio, 2) }}% of classrooms have Smart TVs
                         </div>

                     </div>

                 </div>
             </div>
             {{-- SCHOOL PERSONNEL TABLE --}}
             <div class="mb-10 overflow-x-auto">
                 <div class="text-lg text-gray-800 font-bold">School Personnel</div>
                 <hr>
                 <div class="flex justify-center gap-4 mt-2">
                     <table class="table-auto border-collapse w-full">
                         <thead class="border border-gray-300 bg-gray-200">
                             <tr>
                                 <td class="px-4 py-2 text-black"> Name</td>
                                 {{-- <td class="px-4 py-2 text-white"> Position</td> --}}
                                 <td class="px-4 py-2 text-black"> Contact</td>
                                 <td class="px-4 py-2 text-black"> Role</td>
                                 {{-- <td class="px-4 py-2 text-white"> Last Login</td> --}}
                             </tr>
                         </thead>
                         <tbody>
                             <tr>
                                 <td class="border border-gray-300 px-4 py-2">
                                     {{ Auth::guard('school')->user()->school->PrincipalName }}</td>
                                 {{-- <td class="border border-gray-300 px-4 py-2"> {{ Auth::guard('school')->user()->school->PrincipalName  }}</td> --}}
                                 <td class="border border-gray-300 px-4 py-2">
                                     {{ Auth::guard('school')->user()->school->PrincipalContact }}</td>
                                 <td class="border border-gray-300 px-4 py-2"> School Head</td>
                                 {{-- <td class="border border-gray-300 px-4 py-2"> {{ Auth::guard('school')->user()->last_login_at ? Auth::guard('school')->user()->last_login_at->format('F j, Y, g:i a') : 'Never' }}</td> --}}
                             </tr>
                             <tr>
                                 <td class="border border-gray-300 px-4 py-2">
                                     {{ Auth::guard('school')->user()->school->ICTName }}</td>
                                 <td class="border border-gray-300 px-4 py-2">
                                     {{ Auth::guard('school')->user()->school->ICTContact }}</td>
                                 <td class="border border-gray-300 px-4 py-2"> ICT Coordinator</td>


                             </tr>
                             <tr>
                                 <td class="border border-gray-300 px-4 py-2">
                                     {{ Auth::guard('school')->user()->school->CustodianName }}</td>
                                 <td class="border border-gray-300 px-4 py-2">
                                     {{ Auth::guard('school')->user()->school->CustodianContact }}</td>
                                 <td class="border border-gray-300 px-4 py-2"> Property Custodian</td>


                             </tr>
                         </tbody>
                     </table>
                 </div>
             </div>
             {{-- INTERNET CONNECTIVITY  --}}
             <div class="mb-10">
                 <div class="text-lg text-gray-800 font-bold">Internet Connectivity: </div>

                 @if ($ISP->isEmpty())
                     <div class="text-center  text-md font-normal text-gray-600">No Internet Service Provider Details
                         Available.</div>
                 @else
                     <div class="grid grid-cols-1 justify-center gap-4 mt-2">
                         @foreach ($ISP as $isp_details)
                             <div class="border border-gray-300 px-4 py-2 overflow-x-auto">
                                 <div class="text-lg text-gray-700 font-semibold">Internet Status: </div>
                                 <hr>
                                 <table class="table-auto border-collapse w-full mb-2">
                                     <tr class="border border-gray-300 px-5 py-1">
                                         <td class="px-5">Available ISP:</td>
                                         <td class="px-5">None</td>
                                     </tr>
                                     <tr class="border border-gray-300 px-5 py-1">
                                         <td class="px-5 ">Current Subscription:</td>
                                         <td class="px-5 ">{{ $isp_details->ispList->name ?? '' }}</td>
                                     </tr>
                                     @if ($isp_details->isp_purpose_id == 1 || $isp_details->isp_purpose_id == 3)
                                         @php
                                             $used_in_admin = 'Yes';
                                         @endphp
                                     @else
                                         @php
                                             $used_in_admin = 'No';
                                         @endphp
                                     @endif
                                     <tr class="border border-gray-300 px-5 py-1">
                                         <td class="px-5">Used in Administration:</td>
                                         <td class="px-5">{{ $used_in_admin }}</td>
                                     </tr>
                                     @if ($isp_details->isp_purpose_id == 1 || $isp_details->isp_purpose_id == 2)
                                         @php
                                             $used_in_classroom = 'Yes';
                                         @endphp
                                     @else
                                         @php
                                             $used_in_classroom = 'No';
                                         @endphp
                                     @endif
                                     <tr class="border border-gray-300 px-5 py-1">
                                         <td class="px-5">Used in Classroom Instruction:</td>
                                         <td class="px-5">{{ $used_in_classroom }}</td>
                                     </tr>
                                     <tr class="border border-gray-300 px-5 py-1">
                                         <td class="px-5">DICT Free WIFI Recipient:</td>
                                         <td class="px-5">No</td>
                                     </tr>
                                 </table>
                                 @php
                                     $isp_area_details = App\Models\ISP\ISPAreaDetails::where(
                                         'isp_details_id',
                                         $isp_details->pk_isp_details_id,
                                     )->get();
                                 @endphp
                                 <div class="text-md font-semibold text-gray-700 mb-2 ">Internet Availability Areas:

                                     <div class="font-normal  ">
                                         @foreach ($isp_area_details as $area)
                                             {{ $area->ispAreaAvailable->name ?? '' }}@if (!$loop->last)
                                                 ,
                                             @endif
                                         @endforeach
                                     </div>
                                 </div>

                                 <div class="text-md font-semibold text-gray-700 mb-2  ">Internet Service Provider Details
                                 </div>
                                 <table class="mb-4">
                                     <thead class="border border-gray-300 bg-gray-200">
                                         <tr>
                                             <th class="px-4 py-2 text-black">Provider</th>
                                             <th class="px-4 py-2 text-black">Connection </th>
                                             <th class="px-4 py-2 text-black">Purpose</th>
                                             <th class="px-4 py-2 text-black">Quality</th>
                                             <th class="px-4 py-2 text-black whitespace-nowrap">Upload (Mbps)</th>
                                             <th class="px-4 py-2 text-black whitespace-nowrap">Download (Mbps)</th>
                                             <th class="px-4 py-2 text-black whitespace-nowrap">Ping (ms)</th>
                                             <th class="px-4 py-2 text-black    ">Areas Available</th>

                                         </tr>
                                     </thead>
                                     <tbody>

                                         <tr>
                                             <td class="border border-gray-300 px-4 py-2">
                                                 {{ $isp_details->ispList->name ?? '' }}</td>
                                             <td class="border border-gray-300 px-4 py-2">
                                                 {{ $isp_details->ispConnectionType->name ?? '' }}</td>
                                             <td class="border border-gray-300 px-4 py-2">
                                                 @php
                                                     $isp_details->isp_purpose_id = App\Models\ISP\ISPPurpose::where(
                                                         'pk_isp_purpose_id',
                                                         $isp_details->isp_purpose_id,
                                                     )->value('name');
                                                 @endphp
                                                 {{ $isp_details->isp_purpose_id ?? '' }}</td>
                                             <td class="border border-gray-300 px-4 py-2">
                                                 {{ $isp_details->ispInternetQuality->name ?? '' }}</td>
                                             @php
                                                 $speed_results = App\Models\ISP\ISPSpeedTest::where(
                                                     'isp_details_id',
                                                     $isp_details->pk_isp_details_id,
                                                 )->get();

                                                 if ($speed_results->isEmpty()) {
                                                     $isp_details->ispSpeedTest = (object) [
                                                         'upload' => 'No Speed Test Result',
                                                         'download' => 'No Speed Test Result',
                                                         'ping' => 'No Speed Test Result',
                                                     ];
                                                 }

                                             @endphp
                                             @foreach ($speed_results as $speed)
                                                 <td class="border border-gray-300 px-4 py-2">
                                                     {{ $speed->upload }}
                                                 </td>
                                                 <td class="border border-gray-300 px-4 py-2">{{ $speed->download }}</td>
                                                 <td class="border border-gray-300 px-4 py-2">{{ $speed->ping }}</td>
                                             @endforeach
                                             <td class="border border-gray-300 px-4 py-2">
                                                 @php
                                                     $isp_area_details = App\Models\ISP\ISPAreaDetails::where(
                                                         'isp_details_id',
                                                         $isp_details->pk_isp_details_id,
                                                     )->get();

                                                 @endphp
                                                 @foreach ($isp_area_details as $area)
                                                     {{ $area->ispAreaAvailable->name ?? '' }}@if (!$loop->last)
                                                         ,
                                                     @endif
                                                 @endforeach
                                             </td>

                                         </tr>

                                     </tbody>
                                 </table>
                             </div>
                         @endforeach
                     </div>
                 @endif
             </div>
             {{-- CCTV DETAILS --}}
             <div class="mb-10">
                 <div class="text-lg text-gray-800 font-bold">CCTV Details: </div>
                 @if ($CCTVDetails->isEmpty())
                     <div class="text-center  text-md font-normal text-gray-600">No CCTV Details
                         Available.</div>
                 @else
                     <div class="grid grid-cols-1 justify-center gap-4 mt-2">
                         <table class="w-full border-collapse border text-md">

                             <thead class="bg-gray-200">
                                 <tr>
                                     <th class="border text-center py-1">No.</th>

                                     <th class="border px-2 py-1">Brand/Model</th>
                                     <th class="border px-2 py-1">No. of Cameras</th>
                                     <th class="border px-2 py-1">Camera Type</th>
                                     <th class="border px-2 py-1">Power Source</th>
                                     <th class="border px-2 py-1">Location</th>
                                     <th class="border px-2 py-1">Total Amount</th>
                                     <th class="border px-2 py-1">Installer/Contractor</th>
                                     <th class="border px-2 py-1">Functional Camera</th>
                                     <th class="border px-2 py-1">Person-in-charge</th>
                                     <th class="border px-2 py-1">Date Installed</th>

                                 </tr>
                             </thead>
                             @foreach ($CCTVDetails as $cctv)
                                 <tbody>
                                     <tr>
                                         <td class="text-center px-2 py-1 border">{{ $loop->iteration }}</td>
                                         <td class="text-center px-2 py-1 border">
                                             {{ $cctv->equipment_details->brand_model->name }}</td>

                                         <td class="text-center px-2 py-1 border">{{ $cctv->no_of_units }}</td>
                                         <td class="text-center px-2 py-1 border">{{ $cctv->cctv_type->name }}</td>
                                         <td class="text-center px-2 py-1 border">
                                             {{ $cctv->equipment_details->powersource->name }}</td>
                                         <td class="text-center px-2 py-1 border">
                                             {{ $cctv->equipment_details->location->name }}</td>
                                         <td class="text-center px-2 py-1 border">
                                             &#8369;{{ number_format($cctv->equipment_details->total_amount, 2) }}</td>
                                         <td class="text-center px-2 py-1 border">
                                             {{ $cctv->equipment_details->installer->name }}</td>
                                         <td class="text-center px-2 py-1 border">{{ $cctv->no_of_functional }}</td>
                                         <td class="text-center px-2 py-1 border">
                                             {{ $cctv->equipment_details->incharge->name }}</td>
                                         <td class="text-center px-2 py-1 border">
                                             {{ \Carbon\Carbon::parse($cctv->equipment_details->date_installed)->format('M d, Y') ?? $cctv->equipment_details->date_installed }}
                                         </td>

                                     </tr>
                                 </tbody>
                             @endforeach

                         </table>

                     </div>
                 @endif

             </div>
             {{-- BIOMETRICS DETAILS  --}}
             <div class="mb-10">
                 <div class="text-lg text-gray-800 font-bold">Biometrics Details: </div>
                 @if ($BiometricDetails->isEmpty())
                     <div class="text-center  text-md font-normal text-gray-600">No Biometrics Details
                         Available.</div>
                 @else
                     <div class="grid grid-cols-1 justify-center gap-4 mt-2">
                         <table class="w-full border-collapse border text-md">

                             <thead class="bg-gray-200">
                                 <tr>
                                     <th class="border text-center py-1">No.</th>

                                     <th class="border px-2 py-1">Brand/Model</th>
                                     <th class="border px-2 py-1">No. of Cameras</th>
                                     <th class="border px-2 py-1">Camera Type</th>
                                     <th class="border px-2 py-1">Power Source</th>
                                     <th class="border px-2 py-1">Location</th>
                                     <th class="border px-2 py-1">Total Amount</th>
                                     <th class="border px-2 py-1">Installer/Contractor</th>
                                     <th class="border px-2 py-1">Functional Camera</th>
                                     <th class="border px-2 py-1">Person-in-charge</th>
                                     <th class="border px-2 py-1">Date Installed</th>

                                 </tr>
                             </thead>
                             @foreach ($BiometricDetails as $biometrics)
                                 <tbody>
                                     <tr>
                                         <td class="text-center px-2 py-1 border">{{ $loop->iteration }}</td>
                                         <td class="text-center px-2 py-1 border">
                                             {{ $biometrics->equipment_details->brand_model->name }}</td>

                                         <td class="text-center px-2 py-1 border">{{ $biometrics->no_of_units }}</td>
                                         <td class="text-center px-2 py-1 border">{{ $biometrics->biometric_type->name }}
                                         </td>
                                         <td class="text-center px-2 py-1 border">
                                             {{ $biometrics->equipment_details->powersource->name }}</td>
                                         <td class="text-center px-2 py-1 border">
                                             {{ $biometrics->equipment_details->location->name }}</td>
                                         <td class="text-center px-2 py-1 border">
                                             &#8369;{{ number_format($biometrics->equipment_details->total_amount, 2) }}
                                         </td>
                                         <td class="text-center px-2 py-1 border">
                                             {{ $biometrics->equipment_details->installer->name }}</td>
                                         <td class="text-center px-2 py-1 border">{{ $cctv->no_of_functional }}</td>
                                         <td class="text-center px-2 py-1 border">
                                             {{ $biometrics->equipment_details->incharge->name }}</td>
                                         <td class="text-center px-2 py-1 border">
                                             {{ \Carbon\Carbon::parse($biometrics->equipment_details->date_installed)->format('M d, Y') ?? $cctv->equipment_details->date_installed }}
                                         </td>

                                     </tr>
                                 </tbody>
                             @endforeach

                         </table>

                     </div>
                 @endif

             </div>
             @if ($batches->isNotEmpty())
                 {{-- DCP DELIVERIES --}}
                 <div class="mb-10 overflow-x-auto ">
                     <div class="text-lg text-gray-800 font-bold">DCP Deliveries </div>

                     <table class="table-auto border-collapse w-full">
                         <thead>
                             <tr class="border border-gray-300 bg-gray-200">
                                 <th class="text-md text-gray-800 font-bold px-5"> No. </th>
                                 <th class="text-md text-gray-800 font-bold px-5"> Batch</th>
                                 <th class="text-md text-gray-800 font-bold px-5"> Year</th>
                                 <th class="text-md text-gray-800 font-bold px-5 whitespace-nowrap"> Delivery Date</th>
                                 {{-- <td class="text-md text-gray-700 font-normal px-5"> Number of Packages</td> --}}
                                 <th class="text-md text-gray-800 font-bold px-5"> Total Cost</th>
                                 <th class="text-md text-gray-800 font-bold px-5"> Batch Summary</th>
                                 <th class="text-md text-gray-800 font-bold px-5"> Disposal Status</th>
                                 <th class="text-md text-gray-800 font-bold px-5"> Attachment</th>

                             </tr>
                         </thead>
                         <tbody>
                             @foreach ($batches as $index => $batch)
                                 <tr class="border border-gray-300 px-5 py-1">
                                     <td class="px-5 border py-1"> {{ $index + 1 }}</td>
                                     <td class="px-5  border  py-1"> {{ $batch->batch_label }}</td>
                                     <td class="px-5  border  py-1"> {{ $batch->budget_year }}</td>
                                     <td class="px-5  border  py-1">
                                         {{ \Carbon\Carbon::parse($batch->delivery_date)->format('F j, Y') ?? $batch->delivery_date }}
                                     </td>
                                     {{-- <td class="px-5">  1</td> --}}
                                     @php
                                         $batch_items_price = App\Models\DCPBatchItem::where(
                                             'dcp_batch_id',
                                             $batch->pk_dcp_batches_id,
                                         )->sum('unit_price');
                                         $total_functional = App\Models\DCPBatchItem::where(
                                             'dcp_batch_id',
                                             $batch->pk_dcp_batches_id,
                                         )
                                             ->where('item_status', '1')
                                             ->count();
                                         $total_items = App\Models\DCPBatchItem::where(
                                             'dcp_batch_id',
                                             $batch->pk_dcp_batches_id,
                                         )->count();
                                         $percentage = $total_items > 0 ? ($total_functional / $total_items) * 100 : 0;

                                     @endphp
                                     <td class="px-5 border   py-1 whitespace-nowrap">&#8369;
                                         {{ number_format($batch_items_price, 2) }}
                                     </td>
                                     <td class="px-5   border py-1">Functional: {{ $total_functional }} out of
                                         {{ $total_items }}
                                         ({{ $percentage }}%)
                                     </td>
                                     <td class="px-5  border  py-1"> No Status Available</td>
                                     <td class="px-5  border  py-1"> None</td>


                                 </tr>
                             @endforeach
                         </tbody>
                     </table>
                 </div>

                 {{-- DCP STATUS --}}
                 <div class="mb-10 overflow-x-auto">
                     <div class="text-lg text-gray-800 font-bold mb-2">DCP Status</div>
                     @foreach ($batches as $index => $batch)
                         @php
                             $batch_items = App\Models\DCPBatchItem::where('dcp_batch_id', $batch->pk_dcp_batches_id)
                                 ->get()
                                 ->groupBy('item_type_id');
                             //  dd($batch_items);
                             //  if ($batch_items->isEmpty()) {
                             //      echo "<span class='text-red-600'>(No Record)</span>";
                             //  } else {
                             //      echo "<span class='text-green-600'>(Information Completed)</span>";
                             //  }
                         @endphp
                         <div class="text-lg text-gray-800 font-semibold">{{ $loop->iteration }}. Batch:
                             {{ $batch->batch_label }}</div>
                         <table class="w-full border-collapse border text-md mb-10">
                             <thead class="bg-gray-200">
                                 <tr>
                                     <th class="border text-center py-1">No.</th>

                                     <th class="border px-2 py-1">Item Type</th>
                                     <th class="border px-2 py-1">Unit Price</th>
                                     <th class="border px-2 py-1">Total Cost</th>
                                     <th class="border px-2 py-1">Functional</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @foreach ($batch_items as $typeId => $items)
                                     @php
                                         // get item type name
                                         $name = App\Models\DCPItemTypes::where('pk_dcp_item_types_id', $typeId)->value(
                                             'name',
                                         );

                                         // sum of unit prices
                                         $totalSum = $items->sum('unit_price');

                                         // join unit prices into one string
                                         $unitPrice = $items->first()->unit_price ?? 0;
                                         $status = $items->first()->item_status ?? '';

                                         // join statuses
                                         $totalCount = $items->count();
                                         $functionalCnt = $items->where('item_status', 1)->count();
                                         $percentage = $totalCount > 0 ? ($functionalCnt / $totalCount) * 100 : 0;
                                     @endphp
                                     <tr>
                                         <td class="border px-2 py-1 text-center">{{ $loop->iteration }}</td>
                                         <td class="border px-2 py-1 font-semibold">{{ $name ?? 'N/A' }}</td>
                                         <td class="border px-2 py-1 whitespace-nowrap">
                                             ₱{{ number_format($unitPrice, 2) }}
                                         </td>
                                         <td class="border px-2 py-1 whitespace-nowrap">₱{{ number_format($totalSum, 2) }}
                                         </td>
                                         <td class="border px-2 py-1">{{ $functionalCnt }} / {{ $totalCount }}
                                             ({{ $percentage }}%)
                                         </td>
                                     </tr>
                                 @endforeach
                                 @php
                                     $total_items = App\Models\DCPBatchItem::where(
                                         'dcp_batch_id',
                                         $batch->pk_dcp_batches_id,
                                     )->count();
                                     $total_functional = App\Models\DCPBatchItem::where(
                                         'dcp_batch_id',
                                         $batch->pk_dcp_batches_id,
                                     )
                                         ->where('item_status', '1')
                                         ->count();
                                     $overall_percentage =
                                         $total_items > 0 ? ($total_functional / $total_items) * 100 : 0;
                                     $total_items = App\Models\DCPBatchItem::where(
                                         'dcp_batch_id',
                                         $batch->pk_dcp_batches_id,
                                     )->count();
                                     $total_price = App\Models\DCPBatchItem::where(
                                         'dcp_batch_id',
                                         $batch->pk_dcp_batches_id,
                                     )->sum('unit_price');
                                     $overall_percentage =
                                         $total_items > 0 ? ($total_functional / $total_items) * 100 : 0;
                                 @endphp
                                 <tr class="bg-gray-100">
                                     <td class="  px-2 py-1 font-bold">TOTAL</td>
                                     <td></td>
                                     <td></td>
                                     <td class="border px-2 py-1 font-bold"> ₱{{ number_format($total_price, 2) }}</td>
                                     <td class="border px-2 py-1 font-bold" class="text-sm font-semibold">
                                         {{ $total_functional }} / {{ $total_items }}
                                         {{ $overall_percentage }}%</td>
                                 </tr>
                             </tbody>
                         </table>
                     @endforeach
                 </div>
             @endif
             {{-- NON DCP ITEMS  --}}
             @if ($non_dcp->isNotEmpty())
                 <div class="mb-10 overflow-x-auto">
                     <div class="text-lg text-gray-800 font-bold">Non DCP Items</div>
                     <table class="w-full border-collapse border text-md">

                         <thead class="bg-gray-200">
                             <tr>
                                 <th class="border text-center py-1">No.</th>

                                 <th class="border px-2 py-1">Item Description</th>
                                 <th class="border px-2 py-1">Unit Price</th>
                                 <th class="border px-2 py-1">Date Acquired</th>
                                 <th class="border px-2 py-1">Functional</th>
                                 <th class="border px-2 py-1">Fund Source</th>
                                 <th class="border px-2 py-1">Imte Holder - Location</th>
                                 <th class="border px-2 py-1">Remarks</th>
                             </tr>
                         </thead>
                         @foreach ($non_dcp as $item)
                             <tr>
                                 <td class="border px-2 py-1 text-center">{{ $loop->iteration }}</td>
                                 <td class="border px-2 py-1">{{ $item->item_description }}</td>
                                 <td class="border px-2 py-1 ">&#8369;
                                     {{ number_format($item->unit_price, 2) }}</td>
                                 <td class="border px-2 py-1 ">
                                     {{ \Carbon\Carbon::parse($item->date_acquired)->format('M d, Y') ?? $item->date_acquired }}
                                 </td>
                                 <td class="border px-2 py-1 ">{{ $item->total_functional }}/{{ $item->total_item }}</td>
                                 <td class="border px-2 py-1 ">{{ $item->fund_source->name }}</td>
                                 <td class="border px-2 py-1 ">{{ $item->item_holder_and_location }}</td>
                                 <td class="border px-2 py-1 ">{{ $item->remarks }}</td>
                             </tr>
                         @endforeach
                         </tbody>
                     </table>
                 </div>
             @endif
             <div class="grid grid-cols-1 gap-4">
                 <div class="text-md">Prepared By:</div>
                 <div class="flex flex-row   gap-5 w-full">
                     <div class="text-md   w-full">
                         <div class="text-md text-center">{{ Auth::guard('school')->user()->school->PrincipalName }}</div>
                         <div class="text-sm border-t-2 border-gray-900 text-center">SIGNATURE OVER PRINTED NAME</div>
                         <div class="text-md  text-center">School Head</div>
                     </div>
                     <div class="text-md   w-full">
                         <div class="text-md text-center ">{{ Auth::guard('school')->user()->school->ICTName }}</div>
                         <div class="text-sm border-t-2 border-gray-900 text-center">SIGNATURE OVER PRINTED NAME</div>
                         <div class="text-md  text-center">ICT Coordinator</div>
                     </div>
                     <div class="text-md   w-full">
                         <div class="text-md text-center">{{ Auth::guard('school')->user()->school->CustodianName }}</div>
                         <div class="text-sm border-t-2 border-gray-900 text-center">SIGNATURE OVER PRINTED NAME</div>
                         <div class="text-md text-center ">Property Custodian</div>
                     </div>
                 </div>

             </div>
             <div class="grid grid-cols-1 gap-4">
                 <div class="text-md">Validated By:</div>
                 <div class="grid grid-cols-3   gap-5 w-full">
                     <div class="text-md   w-full">
                         <div class="text-md text-center mt-2">NORMAN A. FLORES</div>
                         <div class="text-sm border-t-2 border-gray-900 text-center"></div>
                         <div class="text-md  text-center">Information Technology Officer I</div>
                     </div>
                 </div>

             </div>

             <div class="grid grid-cols-1 gap-4 mt-5">
                 <div class="grid grid-cols-3   gap-5 w-full">
                     <div></div>
                     <div class="text-md   w-full">
                         <div class="text-md">Noted:</div>
                         <div class="text-md text-center mt-2">DIOSDADO I. CAYABYAB, CESO VI</div>
                         <div class="text-sm border-t-2 border-gray-900 text-center"></div>
                         <div class="text-md  text-center">Schools Division Superintendent</div>
                     </div>
                     <div></div>
                 </div>

             </div>






             <script>
                 document.addEventListener('DOMContentLoaded', function() {
                     var currentDate = new Date();
                     var options = {
                         year: 'numeric',
                         month: 'long',
                         day: 'numeric',
                         hour: '2-digit',
                         minute: '2-digit',
                         second: '2-digit'
                     };
                     var formattedDate = currentDate.toLocaleDateString(undefined, options);
                     document.getElementById('current-time-date').textContent = formattedDate;
                 });
             </script>
         </div>
     @else
         <div class="text-center text-gray-500">No DCP Received found.</div>
     @endif
     <script>
         function printDiv(divId) {
             let printContents = document.getElementById(divId).innerHTML;
             let originalContents = document.body.innerHTML;

             document.body.innerHTML = printContents;
             window.print();
             document.body.innerHTML = originalContents;
         }
     </script>
 @endsection
