 <div id="add-details-modal" class="modal hidden">
     <div class="modal-content large-modal thin-scroll">

         <form action="{{ route('schools.isp.store') }}" method="POST">
             @csrf
             @method('POST')
             <div class="flex flex-col items-center justify-center gap-0">

                 <div class="w-full flex flex-row items-center justify-center">
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
                 <div class="text-center">
                     <div class="page-title">Internet Service Provider</div>
                     <div class="page-subtitle9">Information of School's Internet</div>
                 </div>
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
             <div class="grid md:grid-cols-2 grid-cols-1 gap-4">
                 <div class="mb-4 flex flex-col w-full">
                     <label for="isp_connection_type">Connection Type</label>
                     <select required name="isp_connection_type" class="border border-gray-600 rounded-sm py-1 px-2">
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
                     <select required name="isp_internet_quality" class="border border-gray-600 rounded-sm px-2 py-1"
                         id="">
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
                     <input required class="border border-gray-600 rounded-sm py-1 px-2" type="number" name="isp_ping">
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
                     <div
                         class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                         <button title="Insert Area" type="button" class="  btn-submit  p-1 rounded-full"
                             onclick="addArea()">
                             <svg class="w-8 h-8" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" fill="none">
                                 <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                 <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                 <g id="SVGRepo_iconCarrier">
                                     <path fill="currentColor" fill-rule="evenodd"
                                         d="M9 17a1 1 0 102 0v-6h6a1 1 0 100-2h-6V3a1 1 0 10-2 0v6H3a1 1 0 000 2h6v6z">
                                     </path>
                                 </g>
                             </svg>
                         </button>
                     </div>
                 </div>

                 <div class="flex flex-row items-center mt-4">
                     Selected Area/s:
                     <div id="selected-areas"></div>
                 </div>

             </div>
             <div class="flex flex-row md:justify-end justify-center  gap-2">

                 <button title="Show Edit Modal" type="button" onclick="closeISPDetailsModal()"
                     class="btn-cancel py-1 px-4 md:w-auto w-full rounded">
                     Cancel
                 </button>
                 <button title="Show Edit Modal" type="submit" class="btn-submit md:w-auto w-full py-1 px-4 rounded">
                     Save ISP Details
                 </button>


             </div>
         </form>

     </div>
 </div>
 <div id="edit-details-modal" class="modal   hidden ">
     <div class="modal-content large-modal ">
         <div>
             <form action="{{ route('schools.isp.update') }}" class="mt-2" method="POST">
                 @csrf
                 @method('PUT')
                 <div class="flex flex-col items-center justify-center gap-0">

                     <div class="w-full flex flex-row items-center justify-center">
                         <div
                             class="h-16 w-16 bg-white p-3 border border-gray-300 shadow-lg rounded-full flex items-center justify-center">
                             <div class="text-white bg-green-600 p-2 rounded-full">
                                 <svg class="h-10 w-10" fill="currentColor" viewBox="0 0 96 96"
                                     xmlns="http://www.w3.org/2000/svg">
                                     <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                     <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                     </g>
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
                     <div class="text-center">
                         <div class="page-title">Update Internet Service Provider</div>
                         <div class="page-subtitle">Information of School's Internet</div>
                     </div>
                 </div>
                 <input type="hidden" name="pk_isp_details_id" id="edit_pk_isp_details_id">
                 <div class="mb-4 flex flex-col">
                     @php
                         $isp_list = App\Models\ISP\ISPList::all();

                     @endphp
                     <label for="isp_list_id">Internet Service Provider</label>
                     <select required id="edit_isp_list_id" class="border border-gray-600 rounded-sm py-1 px-2"
                         name="isp_list_id">
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
                         <input id="edit_isp_ping" class="border border-gray-600 rounded-sm py-1 px-2" type="number"
                             name="isp_ping">
                     </div>
                 </div>





                 <div class="flex md:justify-end justify-center gap-2">

                     <button title="Show Edit Modal" type="button" onclick="closeEditModal()"
                         class="btn-cancel py-1 px-4 rounded md:w-auto w-full">
                         Cancel
                     </button>
                     <button title="Show Edit Modal" type="submit"
                         class="btn-green  whitespace-nowrap h-8 py-1 px-4 rounded md:w-auto w-full  ">
                         Update ISP Details
                     </button>



                 </div>

             </form>
         </div>
     </div>
 </div>
