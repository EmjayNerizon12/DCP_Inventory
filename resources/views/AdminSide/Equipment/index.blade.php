 @extends('layout.Admin-Side')
 <title>@yield('title', 'DCP Dashboard')</title>

 @section('content')
     <style>
         th {
             text-transform: uppercase;
             letter-spacing: 0.05rem
         }

         td {
             letter-spacing: 0.05rem
         }

         button {
             letter-spacing: 0.05rem;
             font-weight: 500 !important;
             border-radius: 5px !important;
         }
     </style>
     <div class=" md:my-5 mx-0 my-0">
         <div class=" flex justify-start gap-2 items-center mb-2">

             <div
                 class="h-16 w-16 bg-white p-3 border border-gzray-300 shadow-lg rounded-full flex items-center justify-center">
                 <div class="text-white bg-blue-600 p-2 rounded-full">
                     <svg fill="currentColor" class="h-10 w-10" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 507.901 507.901" xml:space="preserve"
                         stroke="currentColor" stroke-width="8.126416">
                         <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                         <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                         <g id="SVGRepo_iconCarrier">
                             <g>
                                 <g>
                                     <path
                                         d="M493.9,68.251H14.1c-7.8,0-14.1,6.3-14.1,14.1v126.4c0,7.8,6.3,14.1,14.1,14.1h9.6c7.2,120.8,107.8,216.8,230.3,216.8 s223-96,230.2-216.8h9.6c7.8,0,14.1-6.3,14.1-14.1v-126.4C508,74.551,501.7,68.251,493.9,68.251z M254,411.451 c-107,0-194.9-83.4-202-188.6h404C448.8,328.051,361,411.451,254,411.451z M479.6,194.651H28.2v-98.2h183.4v24.6 c0,7.8,6.3,14.1,14.1,14.1s14.1-6.3,14.1-14.1v-24.6H268v56.9c0,7.8,6.3,14.1,14.1,14.1c7.8,0,14.1-6.3,14.1-14.1v-56.9h183.4 V194.651z">
                                     </path>
                                 </g>
                             </g>
                             <g>
                                 <g>
                                     <path
                                         d="M254,263.951c-29.4,0-53.3,23.9-53.3,53.3c0,29.4,23.9,53.3,53.3,53.3c29.4,0,53.3-23.9,53.3-53.3 C307.3,287.851,283.4,263.951,254,263.951z M254,342.351c-13.9,0-25.1-11.2-25.1-25.1c0-13.9,11.3-25.1,25.1-25.1 s25.1,11.2,25.1,25.1C279.1,331.151,267.9,342.351,254,342.351z">
                                     </path>
                                 </g>
                             </g>
                         </g>
                     </svg>
                 </div>
             </div>

             <div style="letter-spacing: 0.05rem">
                 <h2 class="text-2xl font-bold text-gray-800 uppercase">Biometric and CCTV Equipment Details</h2>
                 <div class="text-lg text-gray-600 ">Create, View, Edit and Remove Details</div>

             </div>
         </div>
         <div class="grid md:grid-cols-2 grid-cols-1 md:gap-4 gap-2  mb-10">

             {{-- CCTV CAMERA TYPE   --}}
             @include('AdminSide.Equipment.Crud.cctv')

             {{-- BIOMETRIC TYPE --}}
             @include('AdminSide.Equipment.Crud.biometric')

             {{-- POWERSOURCE  --}}
             @include('AdminSide.Equipment.Crud.powersource')

             {{-- INSTALLER --}}
             @include('AdminSide.Equipment.Crud.installer')

             {{-- BRAND MODEL --}}
             @include('AdminSide.Equipment.Crud.brandmodel')

             {{-- LOCATION  --}}
             @include('AdminSide.Equipment.Crud.location')

             {{-- INCHARGE  --}}
             @include('AdminSide.Equipment.Crud.incharge')

         </div>
     </div>
     <br><br>
     @include('AdminSide.Equipment.Crud.modal')

     <script>
         function deleteFunction(id, type) {
             if (confirm("Are you sure you want to delete this " + type + "?")) {
                 let actionUrl = "{{ route('equipment.delete', [':id', ':type']) }}";
                 actionUrl = actionUrl.replace(':id', id).replace(':type', type);

                 document.getElementById('delete-form').action = actionUrl;
                 document.getElementById('delete-form').submit();
             }
         }

         function openModal(type) {
             document.getElementById('modal-form').action = "{{ route('equipment.store') }}";
             if (type == "camera_type") {
                 document.getElementById('overall-modal').classList.remove('hidden')
                 document.getElementById('modal-title').textContent = "Create and Save ";
                 document.getElementById('modal-subtitle').textContent = " CCTV Camera type";
                 document.getElementById('target').value = type;
             } else if (type == "biometric_type") {
                 document.getElementById('overall-modal').classList.remove('hidden')
                 document.getElementById('modal-title').textContent = "Create and Save ";
                 document.getElementById('modal-subtitle').textContent = "Biometric Authentication type";
                 document.getElementById('target').value = type;
             } else if (type == "powersource") {
                 document.getElementById('overall-modal').classList.remove('hidden')
                 document.getElementById('modal-title').textContent = "Create and Save ";
                 document.getElementById('modal-subtitle').textContent = "Equipment Power Source  ";
                 document.getElementById('target').value = type;
             } else if (type == "incharge") {
                 document.getElementById('overall-modal').classList.remove('hidden')

                 document.getElementById('modal-title').textContent = "Create and Save ";
                 document.getElementById('modal-subtitle').textContent = "Person Incharge to the Equipment ";
                 document.getElementById('target').value = type;
             } else if (type == "location") {
                 document.getElementById('overall-modal').classList.remove('hidden')
                 document.getElementById('modal-title').textContent = "Create and Save ";
                 document.getElementById('modal-subtitle').textContent = "Equipment Location";
                 document.getElementById('target').value = type;
             } else if (type == "brand") {
                 document.getElementById('overall-modal').classList.remove('hidden')
                 document.getElementById('modal-title').textContent = "Create and Save ";
                 document.getElementById('modal-subtitle').textContent = "Equipment Brand/Model";
                 document.getElementById('target').value = type;
             } else if (type == "installer") {
                 document.getElementById('overall-modal').classList.remove('hidden')
                 document.getElementById('modal-title').textContent = "Create and Save ";
                 document.getElementById('modal-subtitle').textContent = "Equipment Installer/Contractor";
                 document.getElementById('target').value = type;
             }
         }

         function openEditModal(id, name, type) {
             console.log(id + " " + name + " " + type);
             document.getElementById('edit-modal-form').action = "{{ route('equipment.update') }}";
             document.getElementById('edit-overall-modal').classList.remove('hidden');
             if (type === "powersource") {
                 document.getElementById('edit-overall-modal').classList.remove('hidden')
                 document.getElementById('edit-modal-title').textContent = "Edit and Save ";
                 document.getElementById('edit-modal-subtitle').textContent = "Equipment Power Source";
                 document.getElementById('edit_target').value = type;
                 document.getElementById('edit_id').value = id;
                 document.getElementById('edit_name').value = name;
             } else if (type === "camera_type") {
                 document.getElementById('edit-overall-modal').classList.remove('hidden')
                 document.getElementById('edit-modal-title').textContent = "Edit and Save ";
                 document.getElementById('edit-modal-subtitle').textContent = " CCTV Camera type";
                 document.getElementById('edit_target').value = type;
                 document.getElementById('edit_id').value = id;
                 document.getElementById('edit_name').value = name;
             } else if (type === "biometric_type") {
                 document.getElementById('edit-overall-modal').classList.remove('hidden')
                 document.getElementById('edit-modal-title').textContent = "Edit and Save ";
                 document.getElementById('edit-modal-subtitle').textContent = "Biometric Authentication type";
                 document.getElementById('edit_target').value = type;
                 document.getElementById('edit_id').value = id;
                 document.getElementById('edit_name').value = name;
             } else if (type === "incharge") {
                 document.getElementById('edit-overall-modal').classList.remove('hidden')
                 document.getElementById('edit-modal-title').textContent = "Edit and Save ";
                 document.getElementById('edit-modal-subtitle').textContent = "Person Incharge to the Equipment ";
                 document.getElementById('edit_target').value = type;
                 document.getElementById('edit_id').value = id;
                 document.getElementById('edit_name').value = name;
             } else if (type === "location") {
                 document.getElementById('edit-overall-modal').classList.remove('hidden')
                 document.getElementById('edit-modal-title').textContent = "Edit and Save ";
                 document.getElementById('edit-modal-subtitle').textContent = "Equipment Location";
                 document.getElementById('edit_target').value = type;
                 document.getElementById('edit_id').value = id;
                 document.getElementById('edit_name').value = name;
             } else if (type === "brand") {
                 document.getElementById('edit-overall-modal').classList.remove('hidden')
                 document.getElementById('edit-modal-title').textContent = "Edit and Save ";
                 document.getElementById('edit-modal-subtitle').textContent = "Equipment Brand/Model";
                 document.getElementById('edit_target').value = type;
                 document.getElementById('edit_id').value = id;
                 document.getElementById('edit_name').value = name;
             } else if (type === "installer") {
                 document.getElementById('edit-overall-modal').classList.remove('hidden')
                 document.getElementById('edit-modal-title').textContent = "Edit and Save ";
                 document.getElementById('edit-modal-subtitle').textContent = "Equipment Installer/Contractor";
                 document.getElementById('edit_target').value = type;
                 document.getElementById('edit_id').value = id;
                 document.getElementById('edit_name').value = name;
             }
         }

         function closeModal() {
             document.getElementById('overall-modal').classList.add('hidden')
         }

         function closeEditModal() {
             document.getElementById('edit-overall-modal').classList.add('hidden')
         }
     </script>
 @endsection
