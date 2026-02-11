 @extends('layout.SchoolSideLayout')
 <title>
     @yield('title', 'DCP Dashboard')</title>

 @section('content')
     <div class="my-10 mx-5">
         <div>

             <div class="bg-white py-5 px-5 rounded-lg border border-gray-300">
                 <div class="flex justify-between">
                     <div>
                         <h2 class="font-bold text-2xl text-gray-800">Schools Internet Service Provider Information</h2>
                         <h2 class="font-normal text-lg text-gray-600">Bulletin</h2>
                         <button onclick="openISPDetailsModal()"
                             class="bg-blue-600 text-white rounded  tracking-wider font-medium shadow  py-1 px-4">
                             Create ISP Details

                         </button>
                     </div>

                     <div
                         class="h-16 w-16 bg-white p-3 border border-gray-300 shadow-lg rounded-full flex items-center justify-center">
                         <div class="text-white bg-blue-600 p-2 rounded-full">
                             <svg class="h-10 w-10" fill="currentColor" viewBox="0 0 96 96"
                                 xmlns="http://www.w3.org/2000/svg">
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
                 </div>
                 <div class="mt-2   py-4 overflow-x-auto">
                     @if ($isp_content->isNotEmpty())
                         <table class="table-auto border border-gray-300 w-full border-collapse ">
                             <thead class="bg-gray-100 border border-gray-300 sticky top-0 z-10">
                                 <tr>
                                     <td class=" tracking-wider whitespace-nowrap   py-2 px-2 font-semibold  text-gray-800">
                                         No.</td>
                                     <td
                                         class=" tracking-wider  whitespace-nowrap    py-2 px-2 font-semibold   text-gray-800 text-center ">
                                         Service
                                         Provider</th>
                                     <td
                                         class=" tracking-wider  whitespace-nowrap    py-2 px-2 font-semibold  text-gray-800 text-center ">
                                         Connection Type
                                     </td>
                                     <td
                                         class=" tracking-wider  whitespace-nowrap    py-2 px-2 font-semibold  text-gray-800 text-center ">
                                         Purpose</ttdh>
                                     <td
                                         class=" tracking-wider  whitespace-nowrap    py-2 px-2 font-semibold   text-gray-800 text-center ">
                                         Speed Test
                                     </td>
                                     <td
                                         class=" tracking-wider  whitespace-nowrap    py-2 px-2 font-semibold text-gray-800 text-center  ">
                                         Internet Quality
                                     </td>
                                     <td
                                         class=" tracking-wider  whitespace-nowrap    py-2 px-2 font-semibold   text-gray-800 text-center  ">
                                         Areas Available
                                     </td>
                                     <td
                                         class=" tracking-wider  whitespace-nowrap    py-2 px-2 font-semibold text-gray-800 text-center  ">
                                         Action</td>
                                 </tr>
                             </thead>
                             <tbody class="tracking-wide">
                                 @foreach ($isp_content as $index => $content)
                                     <tr>
                                         <td class="py-2 px-2 border border-gray-300 py-2 text-center">{{ $index + 1 }}
                                         </td>
                                         <td class="py-2 px-2 border border-gray-300 py-2 text-center">
                                             {{ $content->isp_name }}
                                         </td>
                                         <td class="py-2 px-2 border border-gray-300 py-2 text-center">
                                             {{ $content->connection_type_name }}</td>
                                         <td class="py-2 px-2 border border-gray-300 py-2 text-center " style="width: 20%">
                                             @php
                                                 $purpose = App\Models\ISP\ISPPurpose::where(
                                                     'pk_isp_purpose_id',
                                                     $content->isp_purpose_id,
                                                 )->value('name');

                                             @endphp
                                             {{ $purpose ?? '' }}</td>
                                         <td class="py-2 px-2 border border-gray-300 py-2 text-center">

                                             <div class="flex flex-col">
                                                 <div class="font-normal">Upload: {{ $content->upload }} mbps</div>
                                                 <div class="font-normal">Download: {{ $content->download }} mbps</div>
                                                 <div class="font-normal">Ping: {{ $content->ping }} mbps</div>

                                             </div>

                                         </td>
                                         <td class="py-2 px-2 border border-gray-300 py-2 text-center">
                                             {{ $content->quality }}</td>


                                         <td class="py-2 px-2 border border-gray-300 py-2 text-center">
                                             <div class="flex flex-col">
                                                 <div class="  text-left mb-2">

                                                     <button type="button"
                                                         onclick="showInsertArea({{ $content->id }}    )"
                                                         class="bg-blue-600 tracking-wider font-medium shadow text-white   py-1 px-2 rounded hover:bg-blue-600  ">Insert
                                                         Area</button>
                                                 </div>
                                                 @foreach ($content->areas as $area)
                                                     <div
                                                         class="flex md:flex-row flex-col justify-between md:gap-5 gap-2 border border-gray-300 px-2 py-1 rounded-sm shadow-sm mb-1">
                                                         <div class="font-normal whitespace-nowrap"
                                                             data-id="{{ $area['id'] }}">

                                                             {{ $area['name'] }}


                                                         </div>
                                                         <div class="flex flex-row gap-2">
                                                             <button type="button"
                                                                 onclick="editAreaModal({{ $content->id }}, {{ $area['id'] }})"
                                                                 class="text-blue-600 tracking-wider font-medium hover:text-blue-800">Edit
                                                             </button>
                                                             <button type="button"
                                                                 onclick="deleteArea({{ $content->id }}, {{ $area['id'] }})"
                                                                 class="text-red-600 tracking-wider font-medium hover:text-red-800">Remove
                                                             </button>
                                                         </div>
                                                     </div>
                                                 @endforeach
                                             </div>



                                         </td>
                                         <td class="py-2 px-2 border border-gray-300   text-center">

                                             <div class="flex flex-col gap-2 w-full">
                                                 <div> <button
                                                         onclick='editISPDetailsModal({{ $content->id }}, {{ $content->list_id }}, {{ $content->connection_type_id }}, {{ $content->quality_id }} ,{{ $content->upload }},{{ $content->download }},{{ $content->ping }}, "{{ $content->isp_purpose_id ?? '' }}",
                                             @json($content->areas))'
                                                         class="bg-yellow-300 w-full text-center  tracking-wider font-medium shadow text-black whitespace-nowrap px-2 py-1 rounded   hover:bg-yellow-400">Edit
                                                     </button></div>

                                                 <div> <button type="button" onclick="deleteISP({{ $content->id }})"
                                                         class="bg-red-600 w-full text-center tracking-wider font-medium shadow text-white whitespace-nowrap px-2 py-1 rounded   hover:bg-red-800">Remove</button>
                                                 </div>
                                             </div>

                                         </td>

                                     </tr>
                                 @endforeach
                             </tbody>

                         </table>
                     @else
                         <div class="text-center  text-md font-normal text-gray-600">
                             No ISP Details Available.
                         </div>
                     @endif
                 </div>
             </div>
             <script>
                 function editAreaModal(isp_details_id, area_id) {
                     document.getElementById('edit_area_modal').classList.remove('hidden');
                     document.getElementById('isp_details_id').value = isp_details_id;
                     document.getElementById('isp_area_available_id').value = area_id;
                     document.getElementById('old_isp_area_id').value = area_id;
                 }

                 function deleteArea(isp_details_id, area_id) {
                     if (confirm("Are you sure you want to delete this area?")) {
                         $.ajax({
                             url: '{{ url('School/ISP/delete-area') }}/' + isp_details_id + '/' + area_id,
                             type: 'DELETE', // 👈 use DELETE
                             data: {
                                 _token: '{{ csrf_token() }}' // 👈 CSRF token is required
                             },
                             success: function(response) {
                                 console.log(response.message);
                                 location.reload();
                             },
                             error: function(xhr) {
                                 console.log('Error: ' + xhr.responseText);
                             }
                         });
                     }

                 }
             </script>

             <div id="insert_area_modal"
                 class="modal inset-0 fixed  overflow-y-auto  bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
                 <div class="modal-content bg-white rounded-sm px-4 md:w-1/4 w-full mx-5  ">
                     <form action="{{ route('schools.isp.add.area') }}" class="mt-2" method="POST">
                         @csrf
                         @method('POST')
                         <h2 class="font-bold text-2xl">Insert ISP Area</h2>
                         <input type="hidden" name="insert_isp_details_id" id="insert_isp_details_id">
                         <div class="mb-2">
                             <label for="insert_isp_area_available_id">ISP Area of Connection</label>
                             <select class="border border-gray-400 rounded-md py-1 px-2 w-full" required
                                 name="insert_isp_area_available_id" id="insert_isp_area_available_id">
                                 @php
                                     $isp_area = App\Models\ISP\ISPAreaAvailable::all();

                                 @endphp
                                 <option value="">Select Area</option>
                                 @foreach ($isp_area as $area)
                                     <option value="{{ $area->pk_isp_area_available_id }}">{{ $area->name }}</option>
                                 @endforeach
                             </select>
                         </div>
                         <div class="flex flex-row gap-2">
                             <button type="submit"
                                 class="w-full bg-blue-600 rounded tracking-wider font-medium shadow px-2 py-1 text-white">Save
                                 Area</button>
                             <button type="button"
                                 class="w-full bg-gray-400 hover:bg-gray-500 rounded tracking-wider font-medium shadow  px-2 py-1 text-white"
                                 onclick="closeInsertAreaModal(1)">Cancel</button>
                         </div>
                     </form>
                 </div>
             </div>
             <div id="edit_area_modal"
                 class="modal inset-0 fixed  overflow-y-auto  bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
                 <div class="modal-content bg-white px-4 md:w-1/4 w-full mx-5">
                     <form action="{{ route('schools.isp.update.area') }}" class="mt-2" method="POST">
                         @csrf
                         @method('PUT')
                         <h2 class="font-bold text-2xl">Edit ISP Area</h2>

                         <div class="mb-2">
                             <input type="hidden" id="old_isp_area_id" name="old_isp_area_id">
                             <input type="hidden" id="isp_details_id" name="isp_details_id">
                             <label for="isp_area">ISP Area of Connection</label>
                             <select class="border border-gray-400 px-2 py-1 w-full rounded-sm" required
                                 name="isp_area_available_id" id="isp_area_available_id">
                                 <option value="" selected>Select area</option>
                                 @php
                                     $isp_area = App\Models\ISP\ISPAreaAvailable::all();
                                 @endphp
                                 @foreach ($isp_area as $area)
                                     <option value="{{ $area->pk_isp_area_available_id }}">{{ $area->name }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>
                         <div class="flex flex-row gap-2">
                             <button type="submit"
                                 class="w-full bg-yellow-300 hover:bg-yellow-400 text-gray-800 py-1 px-4 rounded  tracking-wider font-medium shadow ">Update</button>
                             <button type="button"
                                 class="w-full bg-gray-400 hover:bg-gray-500 text-white py-1 px-4 rounded  tracking-wider font-medium shadow "
                                 onclick="closeEditAreaModal()">Cancel</button>
                         </div>
                     </form>
                 </div>
             </div>

             <div id="add-details-modal"
                 class="modal inset-0 fixed  overflow-y-auto  bg-black bg-opacity-40 flex items-center justify-center z-50 hidden py-10">
                 <div
                     class="bg-white rounded-lg   shadow-lg w-full max-w-lg md:max-w-2xl lg:max-w-3xl p-6 mx-4 md:mx-0 overflow-y-auto max-h-[90vh]">
                     <div>
                         <form action="{{ route('schools.isp.store') }}" method="POST">
                             @csrf
                             @method('POST')
                             <div class="font-bold text-xl">
                                 Internet Service Provider Information
                             </div>
                             <div class="mb-4 flex flex-col">
                                 @php
                                     $isp_list = App\Models\ISP\ISPList::all();

                                 @endphp
                                 <label for="isp_list_id">Internet Service Provider</label>
                                 <select required class="border border-gray-600 rounded-sm py-1 px-2" name="isp_list_id">
                                     <option value="" selected>Select ISP</option>
                                     @foreach ($isp_list as $list)
                                         <option value="{{ $list->pk_isp_list_id }}">{{ $list->name }}</option>
                                     @endforeach


                                 </select>
                             </div>
                             <div class="flex md:flex-row flex-col gap-4">
                                 <div class="mb-4 flex flex-col w-full">
                                     <label for="isp_connection_type">Connection Type</label>
                                     <select required name="isp_connection_type"
                                         class="border border-gray-600 rounded-sm py-1 px-2">
                                         <option value="" selected>Select type</option>
                                         @php
                                             $isp_conn = App\Models\ISP\ISPConnectionType::all();

                                         @endphp
                                         @foreach ($isp_conn as $type)
                                             <option value="{{ $type->pk_isp_connection_type_id }}">{{ $type->name }}
                                             </option>
                                         @endforeach
                                     </select>
                                 </div>
                                 <div class="mb-4 flex flex-col w-full">
                                     <label for="isp_internet_quality">Internet Quality</label>
                                     <select required name="isp_internet_quality"
                                         class="border border-gray-600 rounded-sm px-2 py-1" id="">
                                         <option value="" selected>Select</option>
                                         @php
                                             $internetQuality = App\Models\ISP\ISPInternetQuality::all();

                                         @endphp
                                         @foreach ($internetQuality as $quality)
                                             <option value="{{ $quality->pk_isp_internet_quality_id }}">
                                                 {{ $quality->name }}
                                             </option>
                                         @endforeach
                                     </select>
                                 </div>
                             </div>

                             <div class="mb-4 flex flex-col">
                                 <label for="isp_purpose">Purpose</label>

                                 @php
                                     $isp_purpose = App\Models\ISP\ISPPurpose::all();
                                 @endphp
                                 <select required name="isp_purpose" class="border border-gray-600 rounded-sm py-1 px-2"
                                     id="isp_purpose">
                                     <option value="">Select Purpose</option>
                                     @foreach ($isp_purpose as $purpose)
                                         <option value="{{ $purpose->pk_isp_purpose_id }}">{{ $purpose->name }}</option>
                                     @endforeach
                                 </select>
                             </div>

                             <div class="font-bold text-xl">
                                 Speed Test Results
                             </div>
                             <div class="flex md:flex-row flex-col gap-4">
                                 <div class="mb-2 flex flex-col">
                                     <label for="isp_upload">Upload</label>
                                     <input required class="border border-gray-600 rounded-sm py-1 px-2" type="number"
                                         name="isp_upload">
                                 </div>
                                 <div class="mb-2 flex flex-col">
                                     <label for="isp_download">Download</label>
                                     <input required class="border border-gray-600 rounded-sm py-1 px-2" type="number"
                                         name="isp_download">
                                 </div>
                                 <div class="mb-4 flex flex-col">
                                     <label for="isp_ping">Ping</label>
                                     <input required class="border border-gray-600 rounded-sm py-1 px-2" type="number"
                                         name="isp_ping">
                                 </div>
                             </div>
                             @php
                                 $isp_area = App\Models\ISP\ISPAreaAvailable::all();
                             @endphp
                             <div class="mb-4 flex flex-col">
                                 <label for="isp_area">ISP Area of Connection</label>
                                 <div class="flex flex-row gap-2">
                                     <select required class="border border-gray-600 px-2 py-1 rounded-sm" name="isp_area"
                                         id="isp_area">
                                         <option value="" selected>Select area</option>
                                         @foreach ($isp_area as $area)
                                             <option value="{{ $area->pk_isp_area_available_id }}">{{ $area->name }}
                                             </option>
                                         @endforeach

                                     </select>
                                     <button type="button" onclick="addArea()"
                                         class="bg-blue-600 rounded  tracking-wider font-medium shadow  px-2 py-1 text-white ">
                                         Add Area
                                     </button>
                                 </div>

                                 <div class="flex flex-row items-center mt-4">
                                     Selected Area/s:
                                     <div id="selected-areas"></div>
                                 </div>

                             </div>
                             <div class="flex gap-2">
                                 <button type="submit"
                                     class="bg-blue-600   tracking-wider font-medium shadow  text-white px-4 py-1 rounded ">Save
                                     ISP
                                     Details
                                 </button>
                                 <button type="button" onclick="closeISPDetailsModal()"
                                     class="bg-gray-400 text-white py-1 px-4 font-normal rounded  tracking-wider font-medium shadow ">
                                     Cancel
                                 </button>
                             </div>

                         </form>
                     </div>
                 </div>
             </div>
             <div id="edit-details-modal"
                 class="modal inset-0 fixed  overflow-y-auto  bg-black bg-opacity-40 flex items-center justify-center z-50 hidden py-10">
                 <div
                     class="bg-white rounded-lg   shadow-lg w-full max-w-lg md:max-w-2xl lg:max-w-3xl px-6 mx-4 md:mx-0 overflow-y-auto max-h-[90vh]">
                     <div>
                         <form action="{{ route('schools.isp.update') }}" class="mt-2" method="POST">
                             @csrf
                             @method('PUT')
                             <div class="font-bold text-2xl ">
                                 Internet Service Provider Information
                             </div>
                             <div class="font-normal text-gray-500 text-md mb-4">Update ISP Details</div>
                             <input type="hidden" name="pk_isp_details_id" id="edit_pk_isp_details_id">
                             <div class="mb-4 flex flex-col">
                                 @php
                                     $isp_list = App\Models\ISP\ISPList::all();

                                 @endphp
                                 <label for="isp_list_id">Internet Service Provider</label>
                                 <select required id="edit_isp_list_id"
                                     class="border border-gray-600 rounded-sm py-1 px-2" name="isp_list_id">
                                     <option value="" selected>Select ISP</option>
                                     @foreach ($isp_list as $list)
                                         <option value="{{ $list->pk_isp_list_id }}">{{ $list->name }}</option>
                                     @endforeach


                                 </select>
                             </div>
                             <div class="flex md:flex-row flex-col gap-4">
                                 <div class="mb-4 flex flex-col w-full">
                                     <label for="isp_connection_type">Connection Type</label>
                                     <select required id="edit_isp_connection_type_id" name="isp_connection_type"
                                         class="border border-gray-600 rounded-sm py-1 px-2">
                                         <option value="" selected>Select type</option>
                                         @php
                                             $isp_conn = App\Models\ISP\ISPConnectionType::all();

                                         @endphp
                                         @foreach ($isp_conn as $type)
                                             <option value="{{ $type->pk_isp_connection_type_id }}">{{ $type->name }}
                                             </option>
                                         @endforeach
                                     </select>
                                 </div>
                                 <div class="mb-4 flex flex-col w-full">
                                     <label for="isp_internet_quality">Internet Quality</label>
                                     <select required name="isp_internet_quality" id="edit_isp_internet_quality_id"
                                         class="border border-gray-600 rounded-sm px-2 py-1" id="">
                                         <option value="" selected>Select</option>
                                         @php
                                             $internetQuality = App\Models\ISP\ISPInternetQuality::all();

                                         @endphp
                                         @foreach ($internetQuality as $quality)
                                             <option value="{{ $quality->pk_isp_internet_quality_id }}">
                                                 {{ $quality->name }}
                                             </option>
                                         @endforeach
                                     </select>
                                 </div>
                             </div>

                             <div class="mb-4 flex flex-col">
                                 <label for="isp_purpose">Purpose</label>

                                 <select required class="border border-gray-600 rounded-sm py-1 px-2" name="isp_purpose"
                                     id="edit_isp_purpose">
                                     <option value="" selected>Select</option>
                                     @php
                                         $purpose = App\Models\ISP\ISPPurpose::all();

                                     @endphp
                                     @foreach ($purpose as $purp)
                                         <option value="{{ $purp->pk_isp_purpose_id }}">{{ $purp->name }}</option>
                                     @endforeach
                                 </select>

                             </div>

                             <div class="font-bold text-xl">
                                 Speed Test Results
                             </div>
                             <div class="flex md:flex-row flex-col gap-4">
                                 <div class="mb-2 flex flex-col">
                                     <label for="isp_upload">Upload</label>
                                     <input id="edit_isp_upload" class="border border-gray-600 rounded-sm py-1 px-2"
                                         type="number" name="isp_upload">
                                 </div>
                                 <div class="mb-2 flex flex-col">
                                     <label for="isp_download">Download</label>

                                     <input id="edit_isp_download" class="border border-gray-600 rounded-sm py-1 px-2"
                                         type="number" name="isp_download">
                                 </div>
                                 <div class="mb-4 flex flex-col">
                                     <label for="isp_ping">Ping</label>
                                     <input id="edit_isp_ping" class="border border-gray-600 rounded-sm py-1 px-2"
                                         type="number" name="isp_ping">
                                 </div>
                             </div>





                             <div class="flex gap-2">
                                 <button type="submit"
                                     class="bg-yellow-300 hover:bg-yellow-400 font-normal text-gray-800 px-4 py-1 rounded  tracking-wider font-medium shadow ">Update
                                     ISP
                                     Details
                                 </button>
                                 <button type="button" onclick="closeEditModal()"
                                     class="bg-gray-400 hover:bg-gray-500 text-white py-1 px-4 font-normal rounded  tracking-wider font-medium shadow ">
                                     Cancel
                                 </button>
                             </div>

                         </form>
                     </div>
                 </div>
             </div>
             <script>
                 function showInsertArea(isp_details_id) {
                     document.getElementById('insert_area_modal').classList.remove('hidden');
                     document.getElementById('insert_isp_details_id').value = isp_details_id;
                 }

                 function closeEditModal() {
                     document.getElementById('edit-details-modal').classList.add('hidden');
                 }

                 function editISPDetailsModal(isp_id, isp_list, isp_connection_type, isp_internet_quality, isp_upload,
                     isp_download,
                     isp_ping, isp_purpose, areas) {
                     document.getElementById('edit-details-modal').classList.remove('hidden');
                     document.getElementById('edit_pk_isp_details_id').value = isp_id
                     document.getElementById('edit_isp_list_id').value = isp_list
                     document.getElementById('edit_isp_connection_type_id').value = isp_connection_type;
                     document.getElementById('edit_isp_internet_quality_id').value = isp_internet_quality;
                     document.getElementById('edit_isp_purpose').value = isp_purpose;
                     document.getElementById('edit_isp_upload').value = isp_upload;
                     document.getElementById('edit_isp_download').value = isp_download;
                     document.getElementById('edit_isp_ping').value = isp_ping;


                 }

                 function openISPDetailsModal() {
                     document.getElementById('add-details-modal').classList.remove('hidden');
                 }

                 function closeISPDetailsModal() {
                     document.getElementById('add-details-modal').classList.add('hidden');

                 }
             </script>
         </div>
     </div>


     <script>
         let areas = [];

         function closeInsertAreaModal() {
             document.getElementById('insert_area_modal').classList.add('hidden');
         }

         function closeEditAreaModal() {
             document.getElementById('edit_area_modal').classList.add('hidden');
         }

         function addArea() {
             let dropdown = document.getElementById('isp_area');
             let selected_area = dropdown.value;
             let selected_text = dropdown.options[dropdown.selectedIndex].text;
             if (selected_area && !areas.includes(selected_area)) {
                 areas.push(selected_area);
                 document.getElementById('selected-areas').innerHTML =
                     areas.map(a => {
                         let optionText = dropdown.querySelector(`option[value="${a}"]`).text;
                         return ` <span class="px-2 py-1 bg-gray-200 rounded inline-block m-1">
                            ${optionText}
                        </span>
                          <input type="hidden" name="areas[]" value="${a}">`;
                     }).join("");
             }


         }

         function deleteISP(pk_isp_details_id) {
             if (confirm("Are you sure you want to delete this ISP?")) {
                 console.log(pk_isp_details_id);
                 $.ajax({
                     url: '{{ url('/School/ISP/delete/') }}/' + pk_isp_details_id,
                     type: 'DELETE', // 👈 use DELETE
                     data: {
                         _token: '{{ csrf_token() }}' // 👈 CSRF token is required
                     },
                     success: function(response) {
                         console.log(response.message);
                         location.reload();
                     },
                     error: function(xhr) {
                         console.log('Error: ' + xhr.responseText);
                     }
                 });
             }
         }
     </script>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 @endsection
