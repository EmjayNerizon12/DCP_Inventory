 @extends('layout.SchoolSideLayout')
 <title>
     @yield('title', 'DCP Dashboard')</title>

 @section('content')
     <div class="my-10 mx-5">
         <div id="add-cctv-modal"
             class="modal inset-0 fixed  overflow-y-auto  bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
             <div class="modal-content p-4 bg-white rounded-md">
                 <form action="{{ route('schools.equipment.store') }}" method="POST">
                     @csrf
                     @method('POST')
                     <h2 class="font-bold text-2xl text-gray-800">CCTV Information</h2>
                     <h3 class="font-normal text-lg text-gray-800 mb-4">Save Information for Reports</h3>
                     <div>
                         <label for="e_type"></label>
                         <select class="hidden " name="selected_equipment" id="selected_equipment_cctv">
                             @foreach ($equipment_type as $e_type)
                                 <option value="{{ $e_type->pk_equipment_type_id }}">{{ $e_type->name }}</option>
                             @endforeach
                         </select>
                     </div>
                     <div class="grid md:grid-cols-2 grid-cols-1 gap-2">



                         <div>
                             <label for="e_brand">Brand/Model</label>
                             <select required class="px-2 py-1 w-full border border-gray-400 rounded-sm mb-2" name="e_brand"
                                 id="">
                                 <option value="">Select</option>

                                 @foreach ($equipment_brand_model as $e_brand)
                                     <option value="{{ $e_brand->pk_equipment_brand_model_id }}">{{ $e_brand->name }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>

                         <div>
                             <label for="e_cctv_type">CCTV Camera Type</label>
                             <select required class=" px-2 py-1 w-full border border-gray-400 rounded-sm mb-2"
                                 name="e_cctv_type" id="">
                                 <option value="">Select</option>

                                 @foreach ($cctv_type as $e_cctv_type)
                                     <option value="{{ $e_cctv_type->pk_e_cctv_camera_type_id }}">
                                         {{ $e_cctv_type->name }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>

                         <div>
                             <label for="no_of_cctv">Total No. of Camera</label>
                             <input required class="px-2 py-1 w-full border border-gray-400 rounded-sm mb-2" type="text"
                                 name="no_of_cctv" id="no_of_cctv" placeholder="0">
                         </div>
                         <div>
                             <label for="e_power_source">Power Source</label>
                             <select required class=" px-2 py-1 w-full border border-gray-400 rounded-sm mb-2"
                                 name="e_power_source" id="">
                                 <option value="">Select</option>

                                 @foreach ($equipment_power_source as $e_power_source)
                                     <option value="{{ $e_power_source->pk_equipment_power_source_id }}">
                                         {{ $e_power_source->name }}</option>
                                 @endforeach
                             </select>
                         </div>
                         <div>
                             <label for="e_location">Location</label>
                             <select required class=" px-2 py-1 w-full border border-gray-400 rounded-sm mb-2"
                                 name="e_location">
                                 <option value="">Select</option>

                                 @foreach ($equipment_location as $e_location)
                                     <option value="{{ $e_location->pk_equipment_location_id }}">{{ $e_location->name }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>
                         <div>
                             <label for="date_installed">Date Installed</label>
                             <input required class="px-2 py-1 w-full border border-gray-400 rounded-sm mb-2" type="date"
                                 name="date_installed" id="date_installed">
                         </div>
                         <div>
                             <label for="total_amount">Total Amount</label>
                             <input required class="px-2 py-1 w-full border border-gray-400 rounded-sm mb-2" type="number"
                                 step="0.01" name="total_amount" id="total_amount" placeholder="₱ 0.00">
                         </div>

                         <div>
                             <label for="e_installer">Installer</label>
                             <select required class="px-2 py-1 w-full border border-gray-400 rounded-sm mb-2 "
                                 name="e_installer" id="">
                                 <option value="">Select</option>

                                 @foreach ($equipment_installer as $e_installer)
                                     <option value="{{ $e_installer->pk_equipment_installer_id }}">
                                         {{ $e_installer->name }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>
                         <div>
                             <label for="no_of_functional">Total No. of Functional</label>
                             <input required class="px-2 py-1 w-full border border-gray-400 rounded-sm mb-2" type="number"
                                 name="no_of_functional" placeholder="0">
                         </div>
                         <div>
                             <label for="e_incharge">Person In Charge</label>
                             <select required class=" px-2 py-1 w-full border border-gray-400 rounded-sm mb-2"
                                 name="e_incharge" id="">
                                 <option value="">Select</option>
                                 @foreach ($equipment_incharge as $e_incharge)
                                     <option value="{{ $e_incharge->pk_equipment_incharge_id }}">{{ $e_incharge->name }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>
                     </div>

                     <div class="flex justify-end gap-2 mt-4">
                         <button type="submit"
                             class="bg-blue-500 text-white px-6 py-1   tracking-wider font-medium rounded shadow ">
                             Submit
                         </button>
                         <button type="button" onclick="closeModal(1)"
                             class="bg-gray-500  tracking-wider font-medium rounded shadow  text-white px-6 py-1 rounded">
                             Cancel
                         </button>
                     </div>

                 </form>
             </div>
         </div>

         <div id="edit-overall-modal"
             class="modal inset-0 fixed  overflow-y-auto  bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
             <div class="modal-content p-4 bg-white rounded-md">
                 <form action="{{ route('schools.equipment.update') }}" method="POST">
                     @csrf
                     @method('PUT')
                     <h2 class="font-bold text-2xl text-gray-800" id="edit-modal-title">Update CCTV Information</h2>
                     <h3 class="font-normal text-lg text-gray-800 mb-4">Save Information for Reports</h3>
                     <input type="hidden" name="edit_primary_key" id="edit_primary_key">


                     <div class="grid md:grid-cols-2 grid-cols-1 gap-2">


                         <input type="hidden" id="target" name="target">
                         <div>
                             <label for="edit_e_brand">Brand/Model</label>
                             <select class="px-2 py-1 w-full border border-gray-400 rounded-sm mb-2" name="edit_e_brand"
                                 id="edit_e_brand">
                                 <option value="">Select</option>

                                 @foreach ($equipment_brand_model as $e_brand)
                                     <option value="{{ $e_brand->pk_equipment_brand_model_id }}">{{ $e_brand->name }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>

                         <div id="for-cctv" class="hidden">
                             <label for="edit_e_cctv_type">CCTV Camera Type</label>
                             <select class=" px-2 py-1 w-full border border-gray-400 rounded-sm mb-2"
                                 name="edit_e_cctv_type" id="edit_e_cctv_type">
                                 <option value="">Select</option>

                                 @foreach ($cctv_type as $e_cctv_type)
                                     <option value="{{ $e_cctv_type->pk_e_cctv_camera_type_id }}">
                                         {{ $e_cctv_type->name }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>

                         <div id="for-biometric" class="hidden">
                             <label for="edit_e_biometric_type">Biometric Authentication Type</label>
                             <select class=" px-2 py-1 w-full border border-gray-400 rounded-sm mb-2"
                                 name="edit_e_biometric_type" id="edit_e_biometric_type">
                                 <option value="">Select</option>

                                 @foreach ($biometric_type as $e_bio_type)
                                     <option value="{{ $e_bio_type->pk_e_biometric_type_id }}">
                                         {{ $e_bio_type->name }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>

                         <div>
                             <label for="edit_no_of_unit">Total No. of Camera</label>
                             <input class="px-2 py-1 w-full border border-gray-400 rounded-sm mb-2" type="text"
                                 name="edit_no_of_unit" id="edit_no_of_unit" placeholder="0">
                         </div>
                         <div>
                             <label for="edit_e_power_source">Power Source</label>
                             <select class=" px-2 py-1 w-full border border-gray-400 rounded-sm mb-2"
                                 name="edit_e_power_source" id="edit_e_power_source">
                                 <option value="">Select</option>

                                 @foreach ($equipment_power_source as $e_power_source)
                                     <option value="{{ $e_power_source->pk_equipment_power_source_id }}">
                                         {{ $e_power_source->name }}</option>
                                 @endforeach
                             </select>
                         </div>
                         <div>
                             <label for="edit_e_location">Location</label>
                             <select class=" px-2 py-1 w-full border border-gray-400 rounded-sm mb-2" id="edit_e_location"
                                 name="edit_e_location">
                                 <option value="">Select</option>

                                 @foreach ($equipment_location as $e_location)
                                     <option value="{{ $e_location->pk_equipment_location_id }}">{{ $e_location->name }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>
                         <div>
                             <label for="edit_date_installed">Date Installed</label>
                             <input class="px-2 py-1 w-full border border-gray-400 rounded-sm mb-2" type="date"
                                 name="edit_date_installed" id="edit_date_installed">
                         </div>
                         <div>
                             <label for="edit_total_amount">Total Amount</label>
                             <input class="px-2 py-1 w-full border border-gray-400 rounded-sm mb-2" type="number"
                                 step="0.01" name="edit_total_amount" id="edit_total_amount" placeholder="₱ 0.00">
                         </div>

                         <div>
                             <label for="edit_e_installer">Installer</label>
                             <select class="px-2 py-1 w-full border border-gray-400 rounded-sm mb-2 "
                                 name="edit_e_installer" id="edit_e_installer">
                                 <option value="">Select</option>

                                 @foreach ($equipment_installer as $e_installer)
                                     <option value="{{ $e_installer->pk_equipment_installer_id }}">
                                         {{ $e_installer->name }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>
                         <div>
                             <label for="edit_no_of_functional">Total No. of Functional</label>
                             <input class="px-2 py-1 w-full border border-gray-400 rounded-sm mb-2" type="number"
                                 name="edit_no_of_functional" id="edit_no_of_functional" placeholder="0">
                         </div>
                         <div>
                             <label for="edit_e_incharge">Person In Charge</label>
                             <select class=" px-2 py-1 w-full border border-gray-400 rounded-sm mb-2"
                                 name="edit_e_incharge" id="edit_e_incharge">
                                 <option value="">Select</option>
                                 @foreach ($equipment_incharge as $e_incharge)
                                     <option value="{{ $e_incharge->pk_equipment_incharge_id }}">{{ $e_incharge->name }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>
                     </div>

                     <div class="flex justify-end gap-2 mt-4">
                         <button type="submit"
                             class="bg-blue-500 text-white px-6 py-1  tracking-wider font-medium rounded shadow ">
                             Update
                         </button>
                         <button type="button" onclick="closeModal(3)"
                             class="bg-gray-500 text-white px-6 py-1  tracking-wider font-medium rounded shadow ">
                             Cancel
                         </button>
                     </div>

                 </form>
             </div>
         </div>

         <div id="add-biometric-modal"
             class="modal inset-0 fixed  overflow-y-auto  bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
             <div class="modal-content p-4 bg-white rounded-md">
                 <form action="{{ route('schools.equipment.store') }}" method="POST">
                     @csrf
                     @method('POST')
                     <h2 class="font-bold text-2xl text-gray-800">Biometrics Equipment Information</h2>
                     <h3 class="font-normal text-lg text-gray-800 mb-4">Save Information for Reports</h3>
                     <div>
                         <label for="e_type"></label>
                         <select class="hidden " name="selected_equipment" id="selected_equipment_biometric">
                             @foreach ($equipment_type as $e_type)
                                 <option value="{{ $e_type->pk_equipment_type_id }}">{{ $e_type->name }}</option>
                             @endforeach
                         </select>
                     </div>
                     <div class="grid md:grid-cols-2 grid-cols-1 gap-2">



                         <div>
                             <label for="e_brand">Brand/Model</label>
                             <select required class="px-2 py-1 w-full border border-gray-400 rounded-sm mb-2"
                                 name="e_brand" id="">
                                 <option value="">Select</option>

                                 @foreach ($equipment_brand_model as $e_brand)
                                     <option value="{{ $e_brand->pk_equipment_brand_model_id }}">{{ $e_brand->name }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>

                         <div>
                             <label for="e_biometric_type">Biometric Authentication Type</label>
                             <select required class=" px-2 py-1 w-full border border-gray-400 rounded-sm mb-2"
                                 name="e_biometric_type" id="">
                                 <option value="">Select</option>

                                 @foreach ($biometric_type as $e_biometric_type)
                                     <option value="{{ $e_biometric_type->pk_e_biometric_type_id }}">
                                         {{ $e_biometric_type->name }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>

                         <div>
                             <label for="no_of_cctv">Total No. of Biometric</label>
                             <input required class="px-2 py-1 w-full border border-gray-400 rounded-sm mb-2"
                                 type="text" name="no_of_cctv" id="no_of_cctv" placeholder="0">
                         </div>
                         <div>
                             <label for="e_power_source">Power Source</label>
                             <select required class=" px-2 py-1 w-full border border-gray-400 rounded-sm mb-2"
                                 name="e_power_source" id="">
                                 <option value="">Select</option>

                                 @foreach ($equipment_power_source as $e_power_source)
                                     <option value="{{ $e_power_source->pk_equipment_power_source_id }}">
                                         {{ $e_power_source->name }}</option>
                                 @endforeach
                             </select>
                         </div>
                         <div>
                             <label for="e_location">Location</label>
                             <select required class=" px-2 py-1 w-full border border-gray-400 rounded-sm mb-2"
                                 name="e_location">
                                 <option value="">Select</option>

                                 @foreach ($equipment_location as $e_location)
                                     <option value="{{ $e_location->pk_equipment_location_id }}">{{ $e_location->name }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>
                         <div>
                             <label for="date_installed">Date Installed</label>
                             <input required class="px-2 py-1 w-full border border-gray-400 rounded-sm mb-2"
                                 type="date" name="date_installed" id="date_installed">
                         </div>
                         <div>
                             <label for="total_amount">Total Amount</label>
                             <input required class="px-2 py-1 w-full border border-gray-400 rounded-sm mb-2"
                                 type="number" step="0.01" name="total_amount" id="total_amount"
                                 placeholder="₱ 0.00">
                         </div>

                         <div>
                             <label for="e_installer">Installer</label>
                             <select required class="px-2 py-1 w-full border border-gray-400 rounded-sm mb-2 "
                                 name="e_installer" id="">
                                 <option value="">Select</option>

                                 @foreach ($equipment_installer as $e_installer)
                                     <option value="{{ $e_installer->pk_equipment_installer_id }}">
                                         {{ $e_installer->name }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>
                         <div>
                             <label for="no_of_functional">Total No. of Functional</label>
                             <input required class="px-2 py-1 w-full border border-gray-400 rounded-sm mb-2"
                                 type="number" name="no_of_functional" placeholder="0">
                         </div>
                         <div>
                             <label for="e_incharge">Person In Charge</label>
                             <select required class=" px-2 py-1 w-full border border-gray-400 rounded-sm mb-2"
                                 name="e_incharge" id="">
                                 <option value="">Select</option>
                                 @foreach ($equipment_incharge as $e_incharge)
                                     <option value="{{ $e_incharge->pk_equipment_incharge_id }}">{{ $e_incharge->name }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>
                     </div>

                     <div class="flex justify-end gap-2 mt-4">
                         <button type="submit"
                             class="bg-blue-500 text-white px-6 py-1  tracking-wider font-medium rounded shadow ">
                             Submit
                         </button>
                         <button type="button" onclick="closeModal(2)"
                             class="bg-gray-500 text-white px-6 py-1  tracking-wider font-medium rounded shadow ">
                             Cancel
                         </button>
                     </div>

                 </form>
             </div>
         </div>





         <script>
             function openEditModal(type, id, brand, total_object, object_type, powersource, location, total_amount, installer,
                 functional, incharge, date_installed) {
                 console.log(id, brand, total_object, object_type, powersource, location, total_amount, installer,
                     functional, incharge, "DATE", date_installed);
                 if (type == 'cctv') {
                     document.getElementById("edit-overall-modal").classList.remove('hidden');
                     document.getElementById('for-cctv').classList.remove('hidden');
                     document.getElementById('edit-modal-title').textContent = "Update CCTV Details";
                     document.getElementById('edit_primary_key').value = id;
                     document.getElementById('edit_e_brand').value = brand;
                     document.getElementById('edit_no_of_unit').value = total_object;
                     document.getElementById('edit_e_cctv_type').value = object_type;
                     document.getElementById('edit_e_power_source').value = powersource;
                     document.getElementById('edit_e_location').value = location;
                     document.getElementById('edit_total_amount').value = total_amount;
                     document.getElementById('edit_e_installer').value = installer;
                     document.getElementById('edit_no_of_functional').value = functional;
                     document.getElementById('edit_e_incharge').value = incharge;
                     document.getElementById('edit_date_installed').value = date_installed;
                     document.getElementById('target').value = 'cctv';

                 } else if (type == 'biometrics') {
                     document.getElementById("edit-overall-modal").classList.remove('hidden');

                     document.getElementById('for-biometric').classList.remove('hidden');
                     document.getElementById('edit-modal-title').textContent = "Update Biometric Details";
                     document.getElementById('edit_primary_key').value = id;
                     document.getElementById('edit_e_brand').value = brand;
                     document.getElementById('edit_no_of_unit').value = total_object;
                     document.getElementById('edit_e_biometric_type').value = object_type;
                     document.getElementById('edit_e_power_source').value = powersource;
                     document.getElementById('edit_e_location').value = location;
                     document.getElementById('edit_total_amount').value = total_amount;
                     document.getElementById('edit_e_installer').value = installer;
                     document.getElementById('edit_no_of_functional').value = functional;
                     document.getElementById('edit_e_incharge').value = incharge;
                     document.getElementById('edit_date_installed').value = date_installed;
                     document.getElementById('target').value = 'biometric';

                 }


             }

             function openModal(type) {
                 if (type == '1') {
                     document.getElementById('add-cctv-modal').classList.remove('hidden')

                     document.getElementById('selected_equipment_cctv').value = type;
                 } else if (type == '2') {
                     document.getElementById('selected_equipment_biometric').value = type;
                     document.getElementById('add-biometric-modal').classList.remove('hidden')

                 }
             }

             function closeModal(type) {
                 if (type == '1') {

                     document.getElementById('add-cctv-modal').classList.add('hidden')
                 } else if (type == '2') {

                     document.getElementById('add-biometric-modal').classList.add('hidden')
                 } else if (type == '3') {
                     document.getElementById('edit-overall-modal').classList.add('hidden')
                 }

             }

             function deleteFunction(id, type) {
                 if (confirm("Are you sure you want to delete this record?")) {
                     fetch('/School/Equipment/delete/' + id + '/' + type, {
                             method: 'DELETE',
                             headers: {
                                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                             }
                         })
                         .then(response => {
                             if (response.ok) {
                                 alert('Record deleted successfully!');
                                 location.reload();
                             } else {
                                 alert('Failed to delete record.');
                             }
                         })
                         .catch(error => console.error('Error:', error));
                 }

             }
         </script>


         <div class="px-5 py-5  mb-2 bg-white rounded-md border border-gray-300">
             <div class="flex justify-between">
                 <div>
                     <div class="text-2xl font-bold text-gray-700   ">School's CCTV Details</div>
                     <div class="text-md font-normal text-gray-600 mb-2  tracking-wide">Create, View, Edit and Remove
                         Details</div>
                     <div>
                         <button onclick="openModal(1)"
                             class="bg-blue-600 text-white  tracking-wider font-medium rounded shadow  py-1 px-4 mb-2"> Add
                             New
                             Record</button>
                     </div>

                 </div>
                 <div
                     class="h-16 w-16 bg-white p-3 border border-gray-300 shadow-lg rounded-full flex items-center justify-center">
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

             </div>
             <div class="overflow-x-auto ">
                 @if ($cctv_info->isNotEmpty())
                     <div class="grid gap-4">
                         @foreach ($cctv_info as $index => $info)
                             <div class="border border-gray-400 rounded-lg shadow p-4 bg-white tracking-wider">
                                 <div class="flex justify-between items-center  border-b border-gray-400 pb-2 mb-3">
                                     <h3 class="font-semiboldtext-gray-700">CCTV No.{{ $index + 1 }}</h3>
                                     <span
                                         class="text-sm text-gray-500">{{ $info->equipment_details->date_installed ?? '' }}</span>
                                 </div>

                                 <div class="grid grid-cols-2 md:grid-cols-5 gap-3 text-md">
                                     <div>
                                         <span class="font-semibold">Brand / Model:</span>
                                         <p>{{ $info->equipment_details->brand_model->name ?? '' }}</p>
                                     </div>
                                     <div>
                                         <span class="font-semibold">No. of Cameras:</span>
                                         <p>{{ $info->no_of_units ?? '' }}</p>
                                     </div>
                                     <div>
                                         <span class="font-semibold">Camera Type:</span>
                                         <p>{{ $info->cctv_type->name ?? '' }}</p>
                                     </div>
                                     <div>
                                         <span class="font-semibold">Power Source:</span>
                                         <p>{{ $info->equipment_details->powersource->name ?? '' }}</p>
                                     </div>
                                     <div>
                                         <span class="font-semibold">Location:</span>
                                         <p>{{ $info->equipment_details->location->name ?? '' }}</p>
                                     </div>
                                     <div>
                                         <span class="font-semibold">Total Amount:</span>
                                         <p>{{ $info->equipment_details->total_amount ?? '' }}</p>
                                     </div>
                                     <div>
                                         <span class="font-semibold">Installer/Contractor:</span>
                                         <p>{{ $info->equipment_details->installer->name ?? '' }}</p>
                                     </div>
                                     <div>
                                         @php
                                             $percentage = ($info->no_of_functional / $info->no_of_units) * 100;
                                         @endphp
                                         <span class="font-semibold">Functional Cameras:</span>
                                         <p>{{ $info->no_of_functional ?? '' }}/{{ $info->no_of_units ?? '' }} -
                                             {{ $percentage . '%' ?? '' }}</p>

                                     </div>
                                     <div>
                                         <span class="font-semibold">Person In-Charge:</span>
                                         <p>{{ $info->equipment_details->incharge->name ?? '' }}</p>
                                     </div>
                                     <div>
                                         <button type="button"
                                             onclick="openEditModal('cctv',{{ $info->equipment_details->pk_equipment_details_id }},{{ $info->equipment_details->brand_model->pk_equipment_brand_model_id }},{{ $info->no_of_units }},{{ $info->cctv_type->pk_e_cctv_camera_type_id }},{{ $info->equipment_details->powersource->pk_equipment_power_source_id }},{{ $info->equipment_details->location->pk_equipment_location_id }},{{ $info->equipment_details->total_amount }},{{ $info->equipment_details->installer->pk_equipment_installer_id }},{{ $info->no_of_functional }}, {{ $info->equipment_details->incharge->pk_equipment_incharge_id }},'{{ $info->equipment_details->date_installed }}')"
                                             class="text-blue-600 border border-blue-600  hover:bg-blue-600 hover:text-white  tracking-wider font-medium rounded shadow  py-1 px-4">Edit
                                             Data</button>
                                         <button onclick="deleteFunction({{ $info->pk_e_cctv_details_id }},'cctv')"
                                             class=" text-red-600 border border-red-600  hover:bg-red-600 hover:text-white  tracking-wider font-medium rounded shadow  py-1 px-4">Remove</button>

                                     </div>
                                 </div>
                             </div>
                         @endforeach
                     </div>
                 @else
                     <div class="text-center  text-md font-normal text-gray-600">
                         No CCTV Details Available.
                     </div>
                 @endif

             </div>

         </div>


         <div class="px-5 py-5 bg-white mb-4 rounded-md border border-gray-300">
             <div class="flex justify-between">
                 <div>
                     <div class="text-2xl font-bold text-gray-700   ">School's Biometric Details</div>
                     <div class="text-md font-normal text-gray-600 mb-2 tracking-wide ">Create, View, Edit and Remove
                         Details</div>
                     <div>
                         <button onclick="openModal(2)"
                             class="bg-blue-600 text-white  tracking-wider font-medium rounded shadow  mb-2 py-1 px-4"> Add
                             New
                             Record</button>
                     </div>
                 </div>
                 <div
                     class="h-16 w-16 bg-white p-3 border border-gray-300 shadow-lg rounded-full flex items-center justify-center">
                     <div class="text-white bg-blue-600 p-2 rounded-full">
                         <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 32 32" version="1.1"
                             xmlns="http://www.w3.org/2000/svg">
                             <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                             <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                             <g id="SVGRepo_iconCarrier">
                                 <title>fingerprint</title>
                                 <path
                                     d="M5.796 6.587c2.483-2.099 5.629-3.486 9.084-3.812l0.066-0.005c4.263 0 8.188 1.446 11.312 3.874l-0.042-0.031c0.121 0.087 0.271 0.138 0.434 0.138 0.415 0 0.751-0.336 0.751-0.751 0-0.251-0.123-0.473-0.312-0.609l-0.002-0.002c-3.327-2.569-7.556-4.118-12.147-4.118-0.028 0-0.055 0-0.083 0h0.004c-3.847 0.349-7.287 1.856-10.029 4.166l0.027-0.022c-0.174 0.139-0.284 0.35-0.284 0.587 0 0.414 0.336 0.75 0.75 0.75 0.178 0 0.342-0.062 0.471-0.166l-0.001 0.001zM28.555 11.495c-4.166-4.572-8.404-6.891-12.602-6.891h-0.044c-4.184 0.017-8.378 2.336-12.468 6.895-0.119 0.132-0.192 0.308-0.192 0.501 0 0.414 0.336 0.75 0.75 0.75 0.222 0 0.421-0.096 0.558-0.249l0.001-0.001c3.794-4.23 7.615-6.382 11.356-6.396 3.796-0.025 7.647 2.139 11.53 6.4 0.138 0.151 0.335 0.245 0.555 0.245 0.414 0 0.75-0.336 0.75-0.75 0-0.195-0.074-0.372-0.196-0.505l0.001 0.001zM22.68 27.684c-1.684-0.444-3.106-1.387-4.139-2.657l-0.011-0.014c-1.034-1.355-1.692-3.047-1.792-4.887l-0.001-0.023c-0.048-0.381-0.37-0.672-0.759-0.672-0.022 0-0.043 0.001-0.065 0.003l0.003-0c-0.381 0.040-0.675 0.358-0.675 0.746 0 0.027 0.001 0.053 0.004 0.079l-0-0.003c0.137 2.165 0.912 4.126 2.136 5.724l-0.018-0.025c1.245 1.532 2.94 2.654 4.882 3.169l0.065 0.015c0.056 0.015 0.12 0.023 0.185 0.023h0c0.414-0 0.75-0.336 0.75-0.75 0-0.348-0.237-0.641-0.559-0.725l-0.005-0.001zM20.094 9.35c-1.252-0.502-2.703-0.793-4.222-0.793-0.586 0-1.162 0.043-1.725 0.127l0.064-0.008c-2.143 0.362-4.029 1.268-5.569 2.571l0.017-0.014c-2.242 1.836-3.847 4.374-4.482 7.275l-0.016 0.086c-0.093 0.436-0.166 0.871-0.228 1.369-0.029 0.323-0.046 0.7-0.046 1.080 0 2.965 1.012 5.694 2.709 7.86l-0.021-0.028c0.139 0.172 0.349 0.281 0.585 0.281 0.414 0 0.75-0.336 0.75-0.75 0-0.178-0.062-0.342-0.166-0.47l0.001 0.001c-1.473-1.869-2.363-4.257-2.363-6.854 0-0.348 0.016-0.692 0.047-1.032l-0.003 0.044q0.076-0.601 0.201-1.189c0.578-2.645 2.001-4.892 3.966-6.501l0.020-0.016c1.324-1.122 2.963-1.912 4.767-2.222l0.060-0.008c0.429-0.064 0.923-0.1 1.426-0.1 1.33 0 2.6 0.255 3.764 0.718l-0.069-0.024c3.107 1.2 5.481 3.696 6.492 6.807l0.022 0.077c0.549 1.778 0.705 4.901-0.43 6.142-0.348 0.34-0.823 0.549-1.348 0.549-0.219 0-0.43-0.037-0.626-0.104l0.014 0.004c-0.743-0.197-1.382-0.57-1.893-1.073l0.001 0.001c-0.376-0.309-0.674-0.699-0.869-1.144l-0.008-0.020c-0.108-0.36-0.171-0.774-0.171-1.202 0-0.031 0-0.061 0.001-0.092l-0 0.005c0-0.009 0-0.019 0-0.029 0-0.555-0.076-1.093-0.217-1.603l0.010 0.042c-0.527-1.406-1.684-2.466-3.118-2.849l-0.032-0.007c-0.463-0.172-0.997-0.272-1.555-0.272-0.344 0-0.679 0.038-1.001 0.11l0.030-0.006c-0.913 0.269-1.685 0.784-2.262 1.469l-0.006 0.007c-0.679 0.705-1.167 1.597-1.38 2.592l-0.006 0.035c-0.008 0.137-0.013 0.297-0.013 0.458 0 2.243 0.889 4.278 2.333 5.773l-0.002-0.002c1.365 1.634 2.84 3.086 4.444 4.385l0.060 0.047c0.13 0.113 0.301 0.181 0.489 0.181 0.414 0 0.75-0.336 0.75-0.75 0-0.231-0.104-0.437-0.268-0.575l-0.001-0.001c-1.586-1.282-2.993-2.664-4.257-4.17l-0.038-0.047c-1.249-1.225-2.024-2.93-2.024-4.816 0-0.075 0.001-0.15 0.004-0.224l-0 0.011c0.168-0.742 0.528-1.383 1.024-1.889l-0.001 0.001c0.389-0.476 0.907-0.833 1.499-1.022l0.023-0.006c0.181-0.037 0.389-0.059 0.602-0.059 0.394 0 0.771 0.073 1.119 0.206l-0.021-0.007c0.993 0.249 1.786 0.941 2.17 1.847l0.008 0.021c0.090 0.346 0.141 0.744 0.141 1.154 0 0.018-0 0.036-0 0.054l0-0.003c-0 0.019-0 0.042-0 0.064 0 0.602 0.096 1.182 0.273 1.725l-0.011-0.039c0.287 0.702 0.722 1.291 1.269 1.752l0.007 0.006c0.699 0.676 1.574 1.174 2.549 1.421l0.039 0.008c0.285 0.087 0.612 0.137 0.951 0.137 0.956 0 1.819-0.399 2.431-1.040l0.001-0.001c1.689-1.846 1.359-5.639 0.756-7.596-1.175-3.631-3.878-6.475-7.332-7.815l-0.084-0.029zM9.269 20.688c0.052-2.064 1.027-3.89 2.526-5.088l0.013-0.010c0.574-0.489 1.234-0.901 1.95-1.208l0.050-0.019c0.8-0.349 1.732-0.552 2.712-0.552 1.095 0 2.131 0.254 3.053 0.705l-0.041-0.018c2.115 1.295 3.505 3.594 3.505 6.217 0 0.112-0.003 0.224-0.008 0.335l0.001-0.016c0.020 0.399 0.348 0.715 0.75 0.715 0.415 0 0.751-0.336 0.751-0.751 0-0.011-0-0.021-0.001-0.032l0 0.002c0.006-0.117 0.009-0.254 0.009-0.392 0-3.165-1.727-5.926-4.29-7.394l-0.042-0.022c-1.078-0.535-2.347-0.848-3.69-0.848-1.187 0-2.317 0.245-3.342 0.686l0.055-0.021c-0.915 0.389-1.703 0.88-2.401 1.475l0.013-0.011c-1.823 1.479-2.999 3.694-3.073 6.186l-0 0.012c0.125 3.937 1.87 7.444 4.586 9.893l0.012 0.011c0.134 0.128 0.317 0.207 0.518 0.207 0.414 0 0.75-0.336 0.75-0.75 0-0.213-0.089-0.406-0.232-0.543l-0-0c-2.434-2.174-3.998-5.277-4.134-8.746l-0.001-0.023z">
                                 </path>
                             </g>
                         </svg>
                     </div>
                 </div>

             </div>
             <div class="overflow-x-auto ">

                 @if ($biometric_info->isNotEmpty())
                     <div class="grid gap-4">
                         @foreach ($biometric_info as $index => $info)
                             <div class="border border-gray-400 rounded-lg shadow p-4 bg-white tracking-wider">
                                 <div class="flex justify-between items-center border-b border-gray-400 pb-2 mb-2">
                                     <h3 class="font-semibold text-gray-700">Biometric No.{{ $index + 1 }}</h3>
                                     <span
                                         class="text-sm text-gray-500">{{ $info->equipment_details->date_installed ?? '' }}</span>
                                 </div>

                                 <div class="grid grid-cols-2 md:grid-cols-5 gap-3 text-md">
                                     <div>
                                         <span class="font-semibold">Brand / Model:</span>
                                         <p>{{ $info->equipment_details->brand_model->name ?? '' }}</p>
                                     </div>
                                     <div>
                                         <span class="font-semibold">No. of Biometrics:</span>
                                         <p>{{ $info->no_of_units ?? '' }}</p>
                                     </div>
                                     <div>
                                         <span class="font-semibold">Authentication Type:</span>
                                         <p>{{ $info->biometric_type->name ?? '' }}</p>
                                     </div>
                                     <div>
                                         <span class="font-semibold">Power Source:</span>
                                         <p>{{ $info->equipment_details->powersource->name ?? '' }}</p>
                                     </div>
                                     <div>
                                         <span class="font-semibold">Location:</span>
                                         <p>{{ $info->equipment_details->location->name ?? '' }}</p>
                                     </div>
                                     <div>
                                         <span class="font-semibold">Total Amount:</span>
                                         <p>{{ $info->equipment_details->total_amount ?? '' }}</p>
                                     </div>
                                     <div>
                                         <span class="font-semibold">Installer/Contractor:</span>
                                         <p>{{ $info->equipment_details->installer->name ?? '' }}</p>
                                     </div>
                                     <div>
                                         @php
                                             $percentage = ($info->no_of_functional / $info->no_of_units) * 100;

                                         @endphp
                                         <span class="font-semibold">Functional Biometrics:</span>
                                         <p>{{ $info->no_of_functional ?? '' }}/{{ $info->no_of_units ?? '' }} -
                                             {{ $percentage . '%' ?? '' }}</p>
                                     </div>
                                     <div>
                                         <span class="font-semibold">Person In-Charge:</span>
                                         <p>{{ $info->equipment_details->incharge->name ?? '' }}</p>
                                     </div>
                                     <div>
                                         <button
                                             onclick="openEditModal('biometrics', {{ $info->equipment_details->pk_equipment_details_id }},{{ $info->equipment_details->brand_model->pk_equipment_brand_model_id }},{{ $info->no_of_units }},{{ $info->biometric_type->pk_e_biometric_type_id }},{{ $info->equipment_details->powersource->pk_equipment_power_source_id }},{{ $info->equipment_details->location->pk_equipment_location_id }},{{ $info->equipment_details->total_amount }},{{ $info->equipment_details->installer->pk_equipment_installer_id }},{{ $info->no_of_functional }}, {{ $info->equipment_details->incharge->pk_equipment_incharge_id }},'{{ $info->equipment_details->date_installed }}')"
                                             class="text-blue-600 border border-blue-600  hover:bg-blue-600 hover:text-white  tracking-wider font-medium rounded shadow  py-1 px-4">Edit
                                             Data</button>
                                         <button
                                             onclick="deleteFunction({{ $info->pk_e_biometric_details_id }},'biometrics')"
                                             class=" text-red-600 border border-red-600  hover:bg-red-600 hover:text-white  tracking-wider font-medium rounded shadow  py-1 px-4">Remove</button>

                                     </div>
                                 </div>
                             </div>
                         @endforeach
                     </div>
                 @else
                     <div class="text-center  text-md font-normal text-gray-600">
                         No Biometric Details Available.
                     </div>
                 @endif
             </div>
         </div>

     </div>
 @endsection
