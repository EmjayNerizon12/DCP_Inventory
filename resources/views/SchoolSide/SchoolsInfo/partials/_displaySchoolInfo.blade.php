   <div class="max-w-full mb-10  sm:px-0 lg:px-0 pt-0">
       @if (Auth::guard('school')->user() && Auth::guard('school')->user()->school)
           <div>
               <!-- File upload for logo -->
               <div class="hidden" style="border:1px solid #ccc;width:100%"
                   class="w-full bg-white  rounded-md shadow-md overflow-hidden p-6 mt-1 mb-1">
                   <div class="flex justify-between">

                       <h3 class="text-2xl font-bold tracking-wider text-blue-600 mb-4 uppercase">School Information</h3>

                   </div>

                   <div><span class="font-semibold">School ID:</span>
                       {{ Auth::guard('school')->user()->school->SchoolID }}</div>
                   <div><span class="font-semibold">School Name:</span>
                       {{ Auth::guard('school')->user()->school->SchoolName }}</div>
                   <div class="mb-4"><span class="font-semibold">School Level:</span>
                       {{ Auth::guard('school')->user()->school->SchoolLevel }}
                   </div>

                   <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-gray-700">
                       <div class="flex flex-col">
                           <label class="mb-1 font-semibold text-gray-700">School Level</label>
                           <input type="text" id="SchoolLevelInput"
                               class="px-3 py-2 border border-gray-0 rounded bg-gray-100"
                               value="{{ Auth::guard('school')->user()->school->SchoolLevel }}" readonly>
                       </div>

                       <!-- District Dropdown -->
                       <div>
                           <label class="font-semibold">School Email Address:</label>
                           <input type="email" name="SchoolEmailAddress"
                               value="{{ Auth::guard('school')->user()->school->SchoolEmailAddress }}"
                               class="w-full border border-gray-300 rounded px-3 py-2" disabled />
                       </div>
                       <div>
                           <label class="font-semibold">Region:</label>
                           <input type="text" name="Region" value="Region I"
                               class="w-full border   rounded px-3 py-2" disabled />
                           <input type="hidden" name="Region" value="Region I" />
                       </div>
                       <div>
                           <label class="font-semibold">Province:</label>
                           <input type="text" name="Province" value="Pangasinan"
                               class="w-full border   rounded px-2 py-1" disabled />
                           <input type="hidden" name="Province" value="Pangasinan" />
                       </div>
                       <div>
                           <label class="font-semibold">City/Municipality:</label>
                           <input type="text" name="CityMunicipality" value="San Carlos City"
                               class="w-full border   rounded px-2 py-1" disabled />
                           <input type="hidden" name="CityMunicipality" value="San Carlos City" />
                       </div>
                       <div>
                           <label class="font-semibold">Division:</label>
                           <input type="text" name="Division" value="San Carlos City"
                               class="w-full border   rounded px-2 py-1" disabled />
                           <input type="hidden" name="Division" value="San Carlos City" />
                       </div>

                   </div>

               </div>


               <div class="md:mx-auto max-w-xl ">
                   <div class="page-title">School Information Form </div>
                   <div class="page-subtitle">Please fill out and submit the guided form</div>

               </div>
               <div class="flex flex-col max-w-xl mx-auto justify-center gap-2">
                   <div style="border:1px solid #ccc;width:100%"
                       class="w-full bg-white  rounded-md shadow-md overflow-hidden p-6 mt-1">
                       <form method="POST" action="{{ route('school.update.details') }}" enctype="multipart/form-data">
                           @csrf
                           <input type="text" value="{{ Auth::guard('school')->user()->school->pk_school_id }}"
                               name="pk_school_id" class="hidden" />


                           <div class="grid grid-cols-1  gap-0 text-gray-700">
                               <div class="flex flex-col hidden">
                                   <label class="mb-1 font-semibold text-gray-700">School Level</label>
                                   <input type="text" id="SchoolLevelInput"
                                       class="px-3 py-2 border border-gray-0 rounded bg-gray-100"
                                       value="{{ Auth::guard('school')->user()->school->SchoolLevel }}" readonly>
                               </div>

                               <!-- District Dropdown -->
                               <div class="hidden">
                                   <label class="font-semibold">School Email Address:</label>
                                   <input type="email" name="SchoolEmailAddress"
                                       value="{{ Auth::guard('school')->user()->school->SchoolEmailAddress }}"
                                       class="w-full border border-gray-300 rounded px-3 py-2" disabled />
                               </div>
                               <div class="hidden">
                                   <label class="font-semibold">Region:</label>
                                   <input type="text" name="Region" value="Region I"
                                       class="w-full border   rounded px-3 py-2" disabled />
                                   <input type="hidden" name="Region" value="Region I" />
                               </div>
                               <div class="hidden">
                                   <label class="font-semibold">Province:</label>
                                   <input type="text" name="Province" value="Pangasinan"
                                       class="w-full border   rounded px-2 py-1" disabled />
                                   <input type="hidden" name="Province" value="Pangasinan" />
                               </div>
                               <div class="hidden">
                                   <label class="font-semibold">City/Municipality:</label>
                                   <input type="text" name="CityMunicipality" value="San Carlos City"
                                       class="w-full border   rounded px-2 py-1" disabled />
                                   <input type="hidden" name="CityMunicipality" value="San Carlos City" />
                               </div>
                               <div class="hidden">
                                   <label class="font-semibold">Division:</label>
                                   <input type="text" name="Division" value="San Carlos City"
                                       class="w-full border   rounded px-2 py-1" disabled />
                                   <input type="hidden" name="Division" value="San Carlos City" />
                               </div>


                               <div class="col-span-1 grid overflow-hidden grid-cols-1 gap-2">
                                   <div class="col-span-1 ">
                                       <div>
                                           <h3 class="text-2xl font-semibold text-blue-700 ">1. School Details</h3>

                                       </div>
                                   </div>
                                   <div class="flex flex-col">
                                       <label for="SchoolAddress" class="mb-1 font-normal text-gray-700">School
                                           Complete
                                           Address</label>
                                       <textarea class="border border-gray-300 rounded px-2 py-2 w-full mb-1" name="SchoolAddress">{{ Auth::guard('school')->user()->school->SchoolAddress ?? '' }}</textarea>

                                   </div>
                                   <div>
                                       <label class="font-normal">Mobile No. 1
                                           <span class="text-red-500">*</span>
                                       </label>
                                       <input type="text" name="SchoolContactNumber"
                                           value="{{ Auth::guard('school')->user()->school->SchoolContactNumber }}"
                                           placeholder="+63 000 000 0000"
                                           class="w-full border border-gray-300 rounded px-3 py-2" />
                                   </div>
                                   <div>
                                       <label class="font-normal">Mobile No. 2
                                           <span class="text-red-500">Leave Blank if None</span>
                                       </label>
                                       <input type="text" name="SchoolContactNumber2"
                                           value="{{ Auth::guard('school')->user()->school->SchoolContactNumber2 }}"
                                           placeholder="+63 000 000 0000"
                                           class="w-full border border-gray-300 rounded px-3 py-2" />
                                   </div>
                                   <div>
                                       <label class="font-normal">Landline No.
                                           <span class="text-red-500">Leave Blank if None</span>
                                       </label>
                                       <input type="text" name="SchoolTelNumber"
                                           value="{{ Auth::guard('school')->user()->school->SchoolTelNumber }}"
                                           class="w-full border border-gray-300 rounded px-3 py-2" />
                                   </div>

                                   <div class="flex flex-col">
                                       <label for="District" class="mb-1 font-normal text-gray-700">District

                                           <span class="text-red-500">*</span>
                                       </label>
                                       <select name="District" id="District"
                                           class="px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
                                           <!-- Options will be populated by JS -->
                                       </select>
                                   </div>

                                   <div class="flex justify-start">

                                       <button type="submit" class="theme-button h-8 py-1 px-4 rounded-md">
                                           Save
                                           & Update
                                       </button>

                                   </div>
                               </div>
                           </div>
                       </form>

                   </div>
                   <div style="border:1px solid #ccc;width:100%"
                       class="w-full bg-white  rounded-md shadow-md overflow-hidden p-6 mt-1">

                       <h3 class="text-2xl font-semibold text-blue-700 mb-1">2. School Coordinates</h3>


                       <form class="w-full" action="{{ route('school.update.coordinates') }}" method="POST">
                           @csrf
                           @method('POST')
                           <div class="flex flex-col mb-2">
                               <label for="latitude" class="mb-1 font-normal text-gray-700">Latitude</label>
                               <input class="border border-gray-300 rounded px-2 py-2 w-full mb-1"
                                   value="{{ Auth::guard('school')->user()->school->schoolCoordinates->Latitude ?? '' }}"
                                   type="text" name="latitude" disabled>
                           </div>

                           <div class="flex-col mb-2">
                               <label for="longitude" class="mb-1 font-normal text-gray-700">Longitude</label>
                               <input class="border border-gray-300 rounded px-2 py-2 w-full mb-2"
                                   value="{{ Auth::guard('school')->user()->school->schoolCoordinates->Longitude ?? '' }}"
                                   type="text" name="longitude" disabled>
                           </div>
                           <div class="flex-col mb-2">
                               <label class="mb-1 font-normal text-gray-700">
                                   Is Considered Remote
                                   <span class="text-red-500">*</span>
                               </label>

                               @php
                                   $isRemote = optional(Auth::guard('school')->user()->school->schoolCoordinates)
                                       ->is_considered_remote;
                               @endphp

                               <div class="flex items-center gap-4">
                                   <label class="flex items-center gap-1">
                                       <input type="radio" name="is_considered_remote" value="1"
                                           {{ $isRemote === 1 ? 'checked' : '' }}>
                                       <span>True</span>
                                   </label>

                                   <label class="flex items-center gap-1">
                                       <input type="radio" name="is_considered_remote" value="0"
                                           {{ $isRemote === 0 ? 'checked' : '' }}>
                                       <span>False</span>
                                   </label>
                               </div>


                           </div>


                           <div class="flex-col mb-2">
                               <label for="uacs" class="mb-1 font-normal text-gray-700">UACS
                                   <span class="text-red-500">*</span>
                               </label>
                               <input class="border border-gray-300 rounded px-2 py-2 w-full mb-2"
                                   value="{{ Auth::guard('school')->user()->school->schoolCoordinates->uacs ?? '' }}"
                                   type="text" name="uacs">
                           </div>

                           <div class="flex justify-start">


                               <button type="submit" class="theme-button h-8 py-1 px-4 rounded-md">
                                   Save
                                   & Update
                               </button>

                           </div>

                       </form>
                   </div>

                   <div style="border:1px solid #ccc;width:100%"
                       class="w-full bg-white  rounded-md shadow-md overflow-hidden p-6 mt-1">

                       <h3 class="text-2xl font-semibold text-blue-700 mb-4">3. School Admin Information</h3>

                       <form action="{{ route('school.update.admin_details') }}" method="POST">
                           @csrf
                           @method('POST')

                           <div class="flex flex-col">
                               <label for="admin_position" class="mb-1 font-normal text-gray-700">
                                   Admin Position
                               </label>

                               <select name="admin_position"
                                   class="border border-gray-300 rounded px-2 py-2 w-full mb-1">
                                   <option value="">Select Admin Position</option>

                                   <option value="RO"
                                       {{ optional(Auth::guard('school')->user()->school)->admin_position === 'RO' ? 'selected' : '' }}>
                                       RO
                                   </option>

                                   <option value="SDO Chief"
                                       {{ optional(Auth::guard('school')->user()->school)->admin_position === 'SDO Chief' ? 'selected' : '' }}>
                                       SDO Chief
                                   </option>

                                   <option value="School Principal"
                                       {{ optional(Auth::guard('school')->user()->school)->admin_position === 'School Principal' ? 'selected' : '' }}>
                                       School Principal
                                   </option>

                                   <option value="Administrator"
                                       {{ optional(Auth::guard('school')->user()->school)->admin_position === 'Administrator' ? 'selected' : '' }}>
                                       Administrator
                                   </option>
                               </select>
                           </div>

                           <div class="flex flex-col">
                               <label for="admin_email" class="mb-1 font-normal text-gray-700">Admin Email
                                   Address</label>
                               <input class="border border-gray-300 rounded px-2 py-2 w-full mb-1"
                                   value="{{ Auth::guard('school')->user()->school->admin_email ?? '' }}"
                                   type="email" name="admin_email">
                           </div>
                           <div class="flex flex-col mb-4">
                               <label for="admin_mobile_no" class="mb-1 font-normal text-gray-700">Admin Mobile
                                   No.</label>
                               <input class="border border-gray-300 rounded px-2 py-2 w-full mb-1"
                                   value="{{ Auth::guard('school')->user()->school->admin_mobile_no ?? '' }}"
                                   type="text" name="admin_mobile_no">
                           </div>
                           <h3 class="text-xl font-semibold text-blue-700 ">Admin Staff Information</h3>
                           <div class="flex flex-col">
                               <label for="admin_staff_email" class="mb-1 font-normal text-gray-700">Admin Staff
                                   Email</label>
                               <input class="border border-gray-300 rounded px-2 py-2 w-full mb-1"
                                   value="{{ Auth::guard('school')->user()->school->admin_staff_email ?? '' }}"
                                   type="email" name="admin_staff_email">
                           </div>
                           <div class="flex flex-col mb-2">
                               <label for="admin_staff_mobile_no" class="mb-1 font-normal text-gray-700">Admin
                                   Staff
                                   Mobile
                                   No.</label>
                               <input class="border border-gray-300 rounded px-2 py-2 w-full mb-1"
                                   value="{{ Auth::guard('school')->user()->school->admin_staff_mobile_no ?? '' }}"
                                   type="text" name="admin_staff_mobile_no">
                           </div>
                           <div class="flex justify-start">


                               <button type="submit" class="theme-button h-8 py-1 px-4 rounded-md">
                                   Save
                                   & Update
                               </button>

                           </div>
                       </form>

                   </div>
                   <div style="border:1px solid #ccc;width:100%"
                       class="w-full bg-white  rounded-md shadow-md overflow-hidden p-6 mt-1">


                       <div class="flex justify-between">

                           <h3 class="text-2xl font-semibold text-blue-700 mb-4  ">4. School Information</h3>

                       </div>
                       <form class="w-full" action="{{ route('school.submit.non_teaching') }}" method="POST">
                           @csrf
                           @method('POST')
                           <div class="flex-col mb-2">
                               <label class="mb-1 font-normal text-gray-700">
                                   Has Network Administrator ?
                                   <span class="text-red-500">*</span>
                               </label>

                               @php
                                   $network = optional(Auth::guard('school')->user()->school)->has_network_admin;
                               @endphp

                               <div class="flex items-center gap-4">
                                   <label class="flex items-center gap-1">
                                       <input type="radio" name="has_network_admin" value="1"
                                           {{ $network == 1 ? 'checked' : '' }}>
                                       <span>True</span>
                                   </label>

                                   <label class="flex items-center gap-1">
                                       <input type="radio" name="has_network_admin" value="0"
                                           {{ $network == 0 ? 'checked' : '' }}>
                                       <span>False</span>
                                   </label>
                               </div>
                           </div>
                           <div class="flex-col mb-2">
                               <label class="mb-1 font-normal text-gray-700">
                                   Has Sufficient Bandwidth for Internet Needs?
                                   <span class="text-red-500">*</span>
                               </label>

                               @php
                                   $has_bandwidth = optional(Auth::guard('school')->user()->school)->has_bandwidth;
                               @endphp

                               <div class="flex items-center gap-4">
                                   <label class="flex items-center gap-1">
                                       <input type="radio" name="has_bandwidth" value="1"
                                           {{ $has_bandwidth == 1 ? 'checked' : '' }}>
                                       <span>True</span>
                                   </label>

                                   <label class="flex items-center gap-1">
                                       <input type="radio" name="has_bandwidth" value="0"
                                           {{ $has_bandwidth == 0 ? 'checked' : '' }}>
                                       <span>False</span>
                                   </label>
                               </div>


                           </div>


                           <div class="flex flex-col">
                               <label for="total_no_teaching" class="mb-1 font-normal text-gray-700">No.
                                   of
                                   Non-Teaching
                                   Staff</label>
                               <input class="border border-gray-300 rounded px-2 py-2 w-full mb-1"
                                   value="{{ Auth::guard('school')->user()->school->total_no_teaching ?? '' }}"
                                   type="text" name="total_no_teaching">
                           </div>

                           <div class="flex-col">
                               <label for="classroom_with_tv" class="mb-1 font-normal text-gray-700">No.
                                   of
                                   Classrooms
                                   with TV </label>
                               <input class="border border-gray-300 rounded px-2 py-2 w-full mb-2"
                                   value="{{ Auth::guard('school')->user()->school->classroom_with_tv ?? '' }}"
                                   type="text" name="classroom_with_tv">
                           </div>




                           <button type="submit" class="theme-button h-8 py-1 px-4 rounded-md">
                               @if (Auth::guard('school')->user()->school->total_no_teaching)
                                   Save & Update
                               @else
                                   Submit
                               @endif
                           </button>


                       </form>
                   </div>
               </div>
           </div>
       @else
           <div class="bg-white rounded-md shadow-md overflow-hidden p-6 text-center">
               <h3 class="text-lg font-semibold text-red-600 mb-4">No school information found for this
                   account.
               </h3>
               <p class="text-gray-600">Please contact your administrator to link your account to a
                   school.
               </p>
           </div>

       @endif
   </div>
