<div id="edit-overall-modal" class="modal  hidden">
    <div class="modal-content large-modal">
        <form action="{{ route('schools.equipment.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="flex flex-col gap-2 justify-center w-full">
                <div class="w-full flex flex-row items-center justify-center">

                    <div
                        class="h-16 w-16 bg-white p-3 border border-gray-300 shadow-lg rounded-full flex items-center justify-center">
                        <div class="text-white bg-green-600 p-2 rounded-full">
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
                <div class="text-center">

                    <h2 class="font-bold text-2xl text-gray-800" id="edit-modal-title">Update Information</h2>
                    <h3 class="font-normal text-lg text-gray-800 mb-4">Save Information for Reports</h3>
                </div>
            </div>
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

                <div id="for-cctv">
                    <label for="edit_e_cctv_type">CCTV Camera Type</label>
                    <select class=" px-2 py-1 w-full border border-gray-400 rounded-sm mb-2" name="edit_e_cctv_type"
                        id="edit_e_cctv_type">
                        <option value="">Select</option>

                        @foreach ($cctv_type as $e_cctv_type)
                            <option value="{{ $e_cctv_type->pk_e_cctv_camera_type_id }}">
                                {{ $e_cctv_type->name }}
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
                    <select class=" px-2 py-1 w-full border border-gray-400 rounded-sm mb-2" name="edit_e_power_source"
                        id="edit_e_power_source">
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
                    <input class="px-2 py-1 w-full border border-gray-400 rounded-sm mb-2" type="number" step="0.01"
                        name="edit_total_amount" id="edit_total_amount" placeholder="₱ 0.00">
                </div>

                <div>
                    <label for="edit_e_installer">Installer</label>
                    <select class="px-2 py-1 w-full border border-gray-400 rounded-sm mb-2 " name="edit_e_installer"
                        id="edit_e_installer">
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
                    <select class=" px-2 py-1 w-full border border-gray-400 rounded-sm mb-2" name="edit_e_incharge"
                        id="edit_e_incharge">
                        <option value="">Select</option>
                        @foreach ($equipment_incharge as $e_incharge)
                            <option value="{{ $e_incharge->pk_equipment_incharge_id }}">{{ $e_incharge->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex md:justify-end justify-center gap-2 mt-4">
                <button type="button" onclick="closeModal(3)"
                    class="btn-cancel px-6 py-1 md:w-auto w-full   rounded   ">
                    Cancel
                </button>
                <button type="submit" class="btn-green md:w-auto w-full px-4 py-1  rounded   ">
                    Update Details
                </button>
            </div>

        </form>
    </div>
</div>
