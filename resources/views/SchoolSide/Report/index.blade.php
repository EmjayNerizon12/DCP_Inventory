 @extends('layout.SchoolSideLayout')
 <title>
     @yield('title', 'DCP Dashboard')</title>

 @section('content')
     <div class="p-6 space-y-4">


         <div class="space-x-4">
             <div class="page-title">School DCP Report Page</div>
             <div class="page-subtitle">Generate accurate information of the DCP Batches received.</div>

         </div>
         <div class="bg-white   p-6 border border-gray-300 rounded-lg shadow-md">

             <div class="text-2xl font-bold text-blue-700 mb-4">School Reports Generation</div>
             <div class="mt-4">
                 <div class="text-base text-gray-700 border-b border-gray-400  " style="width:fit-content">The list below must
                     be
                     completed and submitted to process your report.</div>
                 <div class="mt-4 ">


                     <!-- DCP Batch Received -->
                     <div class="text-base text-gray-700">
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


                     <div class="text-base text-gray-700">
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

                     <div class="text-base text-gray-700">
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
                     <div class="text-base text-gray-700">
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
                     <div class="text-base text-gray-700">
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
                     <div class="text-base text-gray-700">
                         <b>CCTV Details -</b>
                         @if ($CCTVDetails->isEmpty())
                             <span class="text-red-600  hover:underline"> <a
                                     href="{{ route('schools.equipment.index') }}">(No
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
             <div>
                 <button class="theme-button px-4 py-1 rounded-md" onclick="printDiv('printArea')">Print
                     Report</button>
             </div>
             <div id="printArea" class="bg-white my-2   p-6    border border-gray-300 rounded-lg shadow-md">

                 <style>
                     @media print {

                         table,
                         th,
                         td {
                             -webkit-print-color-adjust: exact;
                             /* Chrome, Safari */
                             print-color-adjust: exact;
                             /* Firefox */
                         }

                         /* Optional: ensure borders and text colors are printed */
                         th,
                         td {
                             border: 1px solid #333;
                             color: #000;
                             /* text color */
                             background-color: white;
                             /* cell background */
                         }

                         * {
                             -webkit-print-color-adjust: exact;
                             /* Chrome/Safari */
                             print-color-adjust: exact;
                             /* Firefox */
                         }

                         .top-header {
                             background-color: #01378E !important;
                             color: white !important;
                         }

                         .sub-header {
                             background-color: #E5E7EB !important;
                             color: black !important;
                         }

                         #print-header {
                             display: flex !important;
                         }

                         .secondary-header {
                             background-color: #FDE68A !important;
                             color: black !important;
                         }

                         .button-container {
                             display: none !important;
                         }

                     }
                 </style>
                 <div class="flex flex-col justify-center items-center mb-4">

                     <img class="h-24 w-24 object-cover rounded-full border-2 border-gray-300"
                         src="{{ Auth::guard('school')->user()->school->image_path ? asset('school-logo/' . Auth::guard('school')->user()->school->image_path) : asset('icon/logo.png') }}"
                         alt="">
                     <div class="text-4xl font-bold text-gray-700">{{ Auth::guard('school')->user()->school->SchoolName }}
                     </div>
                     <div class="text-base text-gray-500">School Report - Generated on: <span id="current-time-date"></span>
                     </div>
                 </div>
                 {{-- SCHOOL PROFILE --}}
                 <div class="mb-5">
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
                                 <div>Latitude: {{ Auth::guard('school')->user()->school->schoolCoordinates->Latitude }}
                                 </div>
                                 <div>Longitude: {{ Auth::guard('school')->user()->school->schoolCoordinates->Longitude }}
                                 </div>
                             </div>
                         </div>

                     </div>
                 </div>
                 {{-- current statistics --}}
                 <div class="mb-5">
                     <div class="text-lg text-gray-800 font-bold">Current Statistics</div>
                     <hr>
                     <table class="w-full my-2">
                         <thead>
                             <tr>
                                 <td colspan="8" class="top-header text-base">
                                     School Statistics

                                 </td>
                             </tr>
                         </thead>
                         <tbody>
                             @include('SchoolSide.Report.includes._tbodyCurrentStatistics')
                         </tbody>
                     </table>

                 </div>
                 {{-- SCHOOL PERSONNEL TABLE --}}
                 <div class="mb-5 overflow-x-auto">
                     <div class="text-lg text-gray-800 font-bold">School Personnel</div>
                     <hr>
                     <div class="flex justify-center gap-4 mt-2">
                         <table class="table-auto border-collapse w-full">
                             <thead class="border border-gray-300 bg-gray-200">
                                 <tr>
                                     <td colspan="3" class="top-header">Personnels</td>
                                 </tr>
                                 <tr>
                                     <td class="sub-header text-base"> Name</td>
                                     {{-- <td class="px-4 py-2 text-white"> Position</td> --}}
                                     <td class="sub-header text-base"> Contact</td>
                                     <td class="sub-header text-base"> Role</td>
                                     {{-- <td class="px-4 py-2 text-white"> Last Login</td> --}}
                                 </tr>
                             </thead>
                             <tbody>
                                 @include('SchoolSide.Report.includes._tbodyPersonnel')
                             </tbody>
                         </table>
                     </div>
                 </div>
                 {{-- INTERNET CONNECTIVITY  --}}
                 <div class="mb-5">
                     <div class="text-lg text-gray-800 font-bold">Internet Connectivity: </div>
                     <hr>
                     @if ($ISP->isEmpty())
                         <div class="text-center  text-base font-normal text-gray-600">No Internet Service Provider Details
                             Available.</div>
                     @else
                         <div class="grid grid-cols-1 justify-center gap-4 mt-2">
                             @foreach ($ISP as $isp_details)
                                 <div class="  space-y-1  py-2 overflow-x-auto">
                                     <table class="table-auto border-collapse w-full  ">

                                         <thead>

                                         </thead>
                                         <tbody>

                                             <tr>
                                                 <td class="top-header text-base" colspan="8">
                                                     {{ $loop->iteration }}. {{ $isp_details->ispList->name ?? '' }}
                                                 </td>
                                             </tr>
                                             <tr>
                                                 <td colspan="8" class="secondary-header text-base">
                                                     Internet Service Provider Details
                                                 </td>
                                             </tr>
                                             <tr>
                                                 <th class="sub-header text-base">Provider</th>
                                                 <th class="sub-header text-base">Connection </th>
                                                 <th class="sub-header text-base">Purpose</th>
                                                 <th class="sub-header text-base">Quality</th>
                                                 <th class="sub-header text-base whitespace-nowrap">Upload (Mbps)</th>
                                                 <th class="sub-header text-base whitespace-nowrap">Download (Mbps)</th>
                                                 <th class="sub-header text-base whitespace-nowrap">Ping (ms)</th>
                                                 <th class="sub-header text-base    ">Areas Available</th>

                                             </tr>


                                             <tr>
                                                 <td class="td-cell tracking-wide">
                                                     {{ $isp_details->ispList->name ?? '' }}</td>
                                                 <td class="td-cell tracking-wide">
                                                     {{ $isp_details->ispConnectionType->name ?? '' }}</td>
                                                 <td class="td-cell tracking-wide">
                                                     @php
                                                         $isp_details->isp_purpose_id = App\Models\ISP\ISPPurpose::where(
                                                             'pk_isp_purpose_id',
                                                             $isp_details->isp_purpose_id,
                                                         )->value('name');
                                                     @endphp
                                                     {{ $isp_details->isp_purpose_id ?? '' }}</td>
                                                 <td class="td-cell tracking-wide">
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
                                                     <td class="td-cell tracking-wide">
                                                         {{ $speed->upload }}
                                                     </td>
                                                     <td class="td-cell tracking-wide">{{ $speed->download }}</td>
                                                     <td class="td-cell tracking-wide">{{ $speed->ping }}</td>
                                                 @endforeach
                                                 <td class="td-cell tracking-wide">
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

                                             <tr>
                                                 <td class="secondary-header text-base" colspan="8">
                                                     Internet Status
                                                 </td>
                                             </tr>
                                             <tr>
                                                 <td colspan="2" class="sub-header text-base">ISP</td>
                                                 <td colspan="6" class="sub-header text-base">Status</td>
                                             </tr>
                                             <tr>
                                                 <td colspan="2" class="td-cell text-base">Available ISP:</td>
                                                 <td colspan="6" class="td-cell text-base">None</td>
                                             </tr>

                                             <tr>
                                                 <td colspan="2" class="td-cell text-base ">Current Subscription:</td>
                                                 <td colspan="6" class="td-cell text-base ">
                                                     {{ $isp_details->ispList->name ?? '' }}</td>
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
                                             <tr>
                                                 <td colspan="2" class="td-cell text-base">Used in Administration:</td>
                                                 <td colspan="6" class="td-cell text-base">{{ $used_in_admin }}</td>
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
                                             <tr>
                                                 <td colspan="2" class="td-cell text-base">Used in Classroom
                                                     Instruction:
                                                 </td>
                                                 <td colspan="6" class="td-cell text-base">{{ $used_in_classroom }}
                                                 </td>
                                             </tr>
                                             <tr>
                                                 <td colspan="2" class="td-cell text-base">DICT Free WIFI Recipient:
                                                 </td>
                                                 <td colspan="6" class="td-cell text-base">No</td>
                                             </tr>

                                             @php
                                                 $isp_area_details = App\Models\ISP\ISPAreaDetails::where(
                                                     'isp_details_id',
                                                     $isp_details->pk_isp_details_id,
                                                 )->get();
                                             @endphp

                                             <tr>
                                                 <td colspan="8" class="secondary-header text-base">
                                                     Internet Availability Areas
                                                 </td>
                                             </tr>
                                             <tr>

                                                 <td colspan="8" class="sub-header text-base">Area Coverage</td>
                                             </tr>

                                             @foreach ($isp_area_details as $area)
                                                 <tr>

                                                     <td colspan="8" class="td-cell text-base">

                                                         {{ $loop->iteration }}. {{ $area->ispAreaAvailable->name ?? '' }}
                                                     </td>
                                                 </tr>
                                             @endforeach



                                         </tbody>
                                     </table>
                                 </div>
                             @endforeach
                         </div>
                     @endif
                 </div>
                 {{-- CCTV DETAILS --}}
                 <div class="mb-5">
                     <div class="text-lg text-gray-800 font-bold">CCTV Details: </div>
                     <hr>
                     @if ($CCTVDetails->isEmpty())
                         <div class="text-center  text-base font-normal text-gray-600">No CCTV Details
                             Available.</div>
                     @else
                         <div class="grid grid-cols-1 justify-center gap-4 mt-2">
                             <table class="w-full border-collapse border text-base">

                                 <thead class="bg-gray-200">
                                     <tr>
                                         <td colspan="11" class="top-header">CCTV Information</td>
                                     </tr>
                                     <tr>
                                         <th class="sub-header text-center text-base">No.</th>

                                         <th class="sub-header text-base">Brand/Model</th>
                                         <th class="sub-header text-base">No. of Cameras</th>
                                         <th class="sub-header text-base">Camera Type</th>
                                         <th class="sub-header text-base">Power Source</th>
                                         <th class="sub-header text-base">Location</th>
                                         <th class="sub-header text-base">Total Amount</th>
                                         <th class="sub-header text-base">Installer/Contractor</th>
                                         <th class="sub-header text-base">Functional Camera</th>
                                         <th class="sub-header text-base">Person-in-charge</th>
                                         <th class="sub-header text-base">Date Installed</th>

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
                 <div class="mb-5">
                     <div class="text-lg text-gray-800 font-bold">Biometrics Details: </div>
                     <hr>
                     @if ($BiometricDetails->isEmpty())
                         <div class="text-center  text-base font-normal text-gray-600">No Biometrics Details
                             Available.</div>
                     @else
                         <div class="grid grid-cols-1 justify-center gap-4 mt-2">
                             <table class="w-full border-collapse border text-base">

                                 <thead class="bg-gray-200">
                                     <tr>
                                         <td colspan="11" class="top-header">Biometrics Information</td>
                                     </tr>
                                     <tr>
                                         <th class="sub-header text-center text-base">No.</th>

                                         <th class="sub-header text-base">Brand/Model</th>
                                         <th class="sub-header text-base">No. of Cameras</th>
                                         <th class="sub-header text-base">Camera Type</th>
                                         <th class="sub-header text-base">Power Source</th>
                                         <th class="sub-header text-base">Location</th>
                                         <th class="sub-header text-base">Total Amount</th>
                                         <th class="sub-header text-base">Installer/Contractor</th>
                                         <th class="sub-header text-base">Functional Camera</th>
                                         <th class="sub-header text-base">Person-in-charge</th>
                                         <th class="sub-header text-base">Date Installed</th>

                                     </tr>
                                 </thead>
                                 @foreach ($BiometricDetails as $biometrics)
                                     <tbody>
                                         <tr>
                                             <td class="text-center px-2 py-1 border">{{ $loop->iteration }}</td>
                                             <td class="text-center px-2 py-1 border">
                                                 {{ $biometrics->equipment_details->brand_model->name }}</td>

                                             <td class="text-center px-2 py-1 border">{{ $biometrics->no_of_units }}</td>
                                             <td class="text-center px-2 py-1 border">
                                                 {{ $biometrics->biometric_type->name }}
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
                     <div class="mb-5 overflow-x-auto ">
                         <div class="text-lg text-gray-800 font-bold">DCP Deliveries </div>
                         <hr>
                         <table class="table-auto border-collapse w-full mt-2">
                             <thead>
                                 <tr>
                                     <td colspan="11" class="top-header">DCP Deliveries</td>
                                 </tr>
                                 <tr class="border border-gray-300 bg-gray-200">
                                     <th class="sub-header text-base"> No. </th>
                                     <th class="sub-header text-base"> Batch</th>
                                     <th class="sub-header text-base"> Year</th>
                                     <th class="sub-header text-base whitespace-nowrap"> Delivery Date</th>
                                     {{-- <td class="text-base text-gray-700 font-normal px-5"> Number of Packages</td> --}}
                                     <th class="sub-header text-base"> Total Cost</th>
                                     <th class="sub-header text-base"> Batch Summary</th>
                                     <th class="sub-header text-base"> Disposal Status</th>
                                     <th class="sub-header text-base"> Attachment</th>

                                 </tr>
                             </thead>
                             <tbody>
                                 @include('SchoolSide.Report.includes._tbodyDCPDeliveries')
                             </tbody>
                         </table>
                     </div>

                     {{-- DCP STATUS --}}
                     <div class="mb-5 overflow-x-auto">
                         <div class="text-lg text-gray-800 font-bold  ">DCP Status</div>
                         <hr>
                         @foreach ($batches as $index => $batch)
                             @php
                                 $batch_items = App\Models\DCPBatchItem::where(
                                     'dcp_batch_id',
                                     $batch->pk_dcp_batches_id,
                                 )
                                     ->get()
                                     ->groupBy('item_type_id');
                             @endphp
                             <div class="text-lg text-gray-800 font-semibold mt-2">{{ $loop->iteration }}. Batch:
                                 {{ $batch->batch_label }}</div>
                             <table class="w-full border-collapse border text-base mb-5">
                                 <thead class="bg-gray-200">
                                     <tr>
                                         <th class="sub-header text-center text-base">No.</th>

                                         <th class="sub-header text-base">Item Type</th>
                                         <th class="sub-header text-base">Unit Price</th>
                                         <th class="sub-header text-base">Total Cost</th>
                                         <th class="sub-header text-base">Functional</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     @include('SchoolSide.Report.includes._tbodyDCPStatus')
                                 </tbody>
                             </table>
                         @endforeach
                     </div>
                 @endif
                 {{-- NON DCP ITEMS  --}}
                 @if ($non_dcp->isNotEmpty())
                     <div class="mb-5 overflow-x-auto">
                         <div class="text-lg text-gray-800 font-bold">Non DCP Items</div>
                         <hr>
                         <table class="w-full border-collapse border text-base mt-2">

                             <thead class="bg-gray-200">
                                 <tr>
                                     <td colspan="8" class="top-header text-base">
                                         <b>Non DCP Items</b>
                                     </td>
                                 </tr>
                                 <tr>
                                     <th class="sub-header text-center text-base">No.</th>

                                     <th class="sub-header text-base">Item Description</th>
                                     <th class="sub-header text-base">Unit Price</th>
                                     <th class="sub-header text-base">Date Acquired</th>
                                     <th class="sub-header text-base">Functional</th>
                                     <th class="sub-header text-base">Fund Source</th>
                                     <th class="sub-header text-base">Imte Holder - Location</th>
                                     <th class="sub-header text-base">Remarks</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @include('SchoolSide.Report.includes._tbodyNonDCP')
                             </tbody>
                         </table>
                     </div>
                 @endif
                 <div class="grid grid-cols-1 gap-4">
                     <div class="text-base">Prepared By:</div>
                     <div class="flex flex-row   gap-5 w-full">
                         <div class="text-base   w-full">
                             <div class="text-base text-center">{{ Auth::guard('school')->user()->school->PrincipalName }}
                             </div>
                             <div class="text-sm border-t-2 border-gray-900 text-center">SIGNATURE OVER PRINTED NAME</div>
                             <div class="text-base  text-center">School Head</div>
                         </div>
                         <div class="text-base   w-full">
                             <div class="text-base text-center ">{{ Auth::guard('school')->user()->school->ICTName }}
                             </div>
                             <div class="text-sm border-t-2 border-gray-900 text-center">SIGNATURE OVER PRINTED NAME</div>
                             <div class="text-base  text-center">ICT Coordinator</div>
                         </div>
                         <div class="text-base   w-full">
                             <div class="text-base text-center">{{ Auth::guard('school')->user()->school->CustodianName }}
                             </div>
                             <div class="text-sm border-t-2 border-gray-900 text-center">SIGNATURE OVER PRINTED NAME</div>
                             <div class="text-base text-center ">Property Custodian</div>
                         </div>
                     </div>

                 </div>
                 <div class="grid grid-cols-1 gap-4">
                     <div class="text-base">Validated By:</div>
                     <div class="grid grid-cols-3   gap-5 w-full">
                         <div class="text-base   w-full">
                             <div class="text-base text-center mt-2">NORMAN A. FLORES</div>
                             <div class="text-sm border-t-2 border-gray-900 text-center"></div>
                             <div class="text-base  text-center">Information Technology Officer I</div>
                         </div>
                     </div>

                 </div>

                 <div class="grid grid-cols-1 gap-4 mt-5">
                     <div class="grid grid-cols-3   gap-5 w-full">
                         <div></div>
                         <div class="text-base   w-full">
                             <div class="text-base">Noted:</div>
                             <div class="text-base text-center mt-2">DIOSDADO I. CAYABYAB, CESO VI</div>
                             <div class="text-sm border-t-2 border-gray-900 text-center"></div>
                             <div class="text-base  text-center">Schools Division Superintendent</div>
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
     </div>
 @endsection
