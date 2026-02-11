 <div id="add-equipment-modal" class="modal hidden">
     <div class="modal-content super-large-modal thin-scroll">

         <form method="POST" action="{{ route('SchoolEquipment.store') }}">
             @csrf
             @method('POST')
             <div class="flex flex-col items-center justify-center gap-0">

                 <div class="w-full flex flex-row items-center justify-center">
                     <div
                         class="h-16 w-16 bg-white p-3 border border-gray-300 shadow-lg rounded-full flex items-center justify-center">
                         <div class="text-white bg-blue-600 p-2 rounded-full">
                             <svg fill="currentColor" class="h-10 w-10" version="1.1" id="Capa_1"
                                 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 viewBox="0 0 390 390" xml:space="preserve">
                                 <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                 <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                 <g id="SVGRepo_iconCarrier">
                                     <g>
                                         <path
                                             d="M383.408,84.898H132.23v31.332h231.238v166.805H132.23v41.225h42.014l-29.597,28.516c-0.978,0.942-1.53,2.242-1.53,3.601 v6.396c0,2.761,2.238,5,5,5h151.375c2.762,0,5-2.239,5-5v-6.396c0-1.358-0.553-2.658-1.531-3.601l-29.597-28.516h110.044 c3.64,0,6.592-2.951,6.592-6.596V91.49C390,87.85,387.048,84.898,383.408,84.898z M223.803,297.552 c4.008,0,7.254,3.247,7.254,7.254c0,4.006-3.246,7.254-7.254,7.254c-4.003,0-7.25-3.248-7.25-7.254 C216.553,300.799,219.8,297.552,223.803,297.552z">
                                         </path>
                                         <path
                                             d="M101.607,22.228H8.076C3.615,22.228,0,25.843,0,30.304v329.059c0,4.461,3.615,8.076,8.076,8.076h93.531 c4.461,0,8.076-3.615,8.076-8.076V30.304C109.684,25.843,106.068,22.228,101.607,22.228z M46.168,63.251 c0-0.705,0.571-1.277,1.277-1.277H62.24c0.705,0,1.277,0.572,1.277,1.277v127.422c0,0.706-0.572,1.278-1.277,1.278H47.445 c-0.706,0-1.277-0.572-1.277-1.278V63.251z M62.439,257.647c0,4.195-3.4,7.598-7.598,7.598c-4.196,0-7.598-3.402-7.598-7.598 c0-4.196,3.401-7.598,7.598-7.598C59.039,250.049,62.439,253.45,62.439,257.647z M54.842,318.288 c-9.877,0-17.885-8.007-17.885-17.885c0-9.877,8.008-17.885,17.885-17.885c9.877,0,17.885,8.008,17.885,17.885 C72.727,310.281,64.719,318.288,54.842,318.288z">
                                         </path>
                                     </g>
                                 </g>
                             </svg>
                         </div>
                     </div>
                 </div>
                 <div class="text-center">
                     <div class="page-title">Equipment Information</div>
                     <div class="page-subtitle">Encode the information needed for the equipment</div>
                 </div>
             </div>
             @include('SchoolSide.SchoolEquipment.partials._addEquipmentForm')

             <div class="flex gap-2  w-full md:justify-end justify-center">
                 <button type="button" onclick="closeModal()"
                     class="btn-cancel md:w-auto w-full px-4 py-1 rounded">Cancel</button>
                 <button type="submit" class="btn-submit px-4 py-1 rounded  md:w-auto w-full">Save
                     Equipment</button>
             </div>
         </form>

     </div>
 </div>
 <div id="edit-equipment-modal" class="modal hidden">
     <div class="modal-content super-large-modal  thin-scroll">

         <form id="editEquipmentForm" method="POST">
             @csrf
             @method('PUT')
             <div class="flex flex-col items-center justify-center gap-0">

                 <div class="w-full flex flex-row items-center justify-center">
                     <div
                         class="h-16 w-16 bg-white p-3 border border-gray-300 shadow-lg rounded-full flex items-center justify-center">
                         <div class="text-white bg-green-600 p-2 rounded-full">
                             <svg fill="currentColor" class="h-10 w-10" version="1.1" id="Capa_1"
                                 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 viewBox="0 0 390 390" xml:space="preserve">
                                 <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                 <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                 <g id="SVGRepo_iconCarrier">
                                     <g>
                                         <path
                                             d="M383.408,84.898H132.23v31.332h231.238v166.805H132.23v41.225h42.014l-29.597,28.516c-0.978,0.942-1.53,2.242-1.53,3.601 v6.396c0,2.761,2.238,5,5,5h151.375c2.762,0,5-2.239,5-5v-6.396c0-1.358-0.553-2.658-1.531-3.601l-29.597-28.516h110.044 c3.64,0,6.592-2.951,6.592-6.596V91.49C390,87.85,387.048,84.898,383.408,84.898z M223.803,297.552 c4.008,0,7.254,3.247,7.254,7.254c0,4.006-3.246,7.254-7.254,7.254c-4.003,0-7.25-3.248-7.25-7.254 C216.553,300.799,219.8,297.552,223.803,297.552z">
                                         </path>
                                         <path
                                             d="M101.607,22.228H8.076C3.615,22.228,0,25.843,0,30.304v329.059c0,4.461,3.615,8.076,8.076,8.076h93.531 c4.461,0,8.076-3.615,8.076-8.076V30.304C109.684,25.843,106.068,22.228,101.607,22.228z M46.168,63.251 c0-0.705,0.571-1.277,1.277-1.277H62.24c0.705,0,1.277,0.572,1.277,1.277v127.422c0,0.706-0.572,1.278-1.277,1.278H47.445 c-0.706,0-1.277-0.572-1.277-1.278V63.251z M62.439,257.647c0,4.195-3.4,7.598-7.598,7.598c-4.196,0-7.598-3.402-7.598-7.598 c0-4.196,3.401-7.598,7.598-7.598C59.039,250.049,62.439,253.45,62.439,257.647z M54.842,318.288 c-9.877,0-17.885-8.007-17.885-17.885c0-9.877,8.008-17.885,17.885-17.885c9.877,0,17.885,8.008,17.885,17.885 C72.727,310.281,64.719,318.288,54.842,318.288z">
                                         </path>
                                     </g>
                                 </g>
                             </svg>
                         </div>
                     </div>
                 </div>
                 <div class="text-center">
                     <div class="page-title">Edit Equipment Information</div>
                     <div class="page-subtitle">Encode the information needed for the equipment</div>
                 </div>
             </div>
             @include('SchoolSide.SchoolEquipment.partials._editEquipmentForm')

             <div class="flex md:justify-end justify-center gap-2 w-full">
                 <button type="button" onclick="closeModal()"
                     class=" md:w-auto w-full py-1 px-4 btn-cancel rounded  ">Cancel</button>
                 <button type="submit" class=" py-1 px-4 btn-green md:w-auto w-full rounded">Update
                     Equipment</button>
             </div>
         </form>

     </div>
 </div>
 <script>
     function openModal() {
         const modal = document.getElementById('add-equipment-modal');
         modal.classList.remove('hidden');
         document.body.classList.add('overflow-hidden');
     }

     function closeModal() {
         const modal = document.getElementById('add-equipment-modal');
         modal.classList.add('hidden');

         const editModal = document.getElementById('edit-equipment-modal');
         editModal.classList.add('hidden');
         document.body.classList.remove('overflow-hidden');
     }
     const baseUrl = "{{ url('School/SchoolEquipment') }}";

     function showEditModal(id, property_number, old_property_number, serial_number, equipment_item_id,
         unit_of_measure_id, manufacturer_id, model, specifications, supplier_or_distributor, category_id,
         classification_id, non_dcp, dcp_batch_id, pmp_reference_no, gl_sl_code, uacs_code, acquisition_cost,
         acquisition_date, mode_of_acquisition_id, source_of_acquisition_id, donor, source_of_fund_id,
         allotment_class_id, remarks) {
         // Assign values to form inputs
         document.getElementById('id').value = id ?? '';
         document.getElementById('property_number').value = property_number ?? '';
         document.getElementById('old_property_number').value = old_property_number ?? '';
         document.getElementById('serial_number').value = serial_number ?? '';
         document.getElementById('equipment_item_id').value = equipment_item_id ?? '';
         document.getElementById('unit_of_measure_id').value = unit_of_measure_id ?? '';
         document.getElementById('manufacturer_id').value = manufacturer_id ?? '';
         document.getElementById('model').value = model ?? '';
         document.getElementById('specifications').value = specifications ?? '';
         document.getElementById('supplier_or_distributor').value = supplier_or_distributor ?? '';
         document.getElementById('category_id').value = category_id ?? '';
         document.getElementById('classification_id').value = classification_id ?? '';
         document.getElementById('dcp_batch_id').value = dcp_batch_id ?? '';
         document.getElementById('pmp_reference_no').value = pmp_reference_no ?? '';
         document.getElementById('gl_sl_code').value = gl_sl_code ?? '';
         document.getElementById('uacs_code').value = uacs_code ?? '';
         document.getElementById('acquisition_cost').value = acquisition_cost ?? '';
         document.getElementById('acquisition_date').value = acquisition_date ?? '';
         document.getElementById('mode_of_acquisition_id').value = mode_of_acquisition_id ?? '';
         document.getElementById('source_of_acquisition_id').value = source_of_acquisition_id ?? '';
         document.getElementById('donor').value = donor ?? '';
         document.getElementById('source_of_fund_id').value = source_of_fund_id ?? '';
         document.getElementById('allotment_class_id').value = allotment_class_id ?? '';
         document.getElementById('remarks').value = remarks ?? '';

         console.log('VALUE OF PROPERTY: ' + document.getElementById('property_number').value)
         // Radio buttons for Non DCP
         if (non_dcp == 1) {
             document.getElementById('non_dcp_yes').checked = true;
         } else {
             document.getElementById('non_dcp_no').checked = true;
         }
         document.getElementById('editEquipmentForm').action = "{{ route('SchoolEquipment.update', ':id') }}".replace(
             ':id', id);


         const modal = document.getElementById('edit-equipment-modal');
         modal.classList.remove('hidden');
         document.body.classList.add('overflow-hidden');
     }
 </script>
