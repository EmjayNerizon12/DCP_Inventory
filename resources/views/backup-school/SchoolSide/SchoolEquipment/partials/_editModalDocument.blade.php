 <div id="edit-document-modal" class="modal   hidden">
     <div class="modal-content small-modal">

         <form id="editDocumentForm" method="POST">
             @csrf
             @method('PUT')
             <div class="flex flex-col items-center justify-center gap-0">

                 <div class="w-full flex flex-row items-center justify-center">
                     <div
                         class="h-16 w-16 bg-white p-3 border border-gray-300 shadow-lg rounded-full flex items-center justify-center">
                         <div class="text-white bg-green-600 p-2 rounded-full">
                             <svg class="w-10 h-10" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                 <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                 <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                 <g id="SVGRepo_iconCarrier">
                                     <path fill-rule="evenodd" clip-rule="evenodd"
                                         d="M6 1C4.34315 1 3 2.34315 3 4V20C3 21.6569 4.34315 23 6 23H18C19.6569 23 21 21.6569 21 20V8.82843C21 8.03278 20.6839 7.26972 20.1213 6.70711L15.2929 1.87868C14.7303 1.31607 13.9672 1 13.1716 1H6ZM5 4C5 3.44772 5.44772 3 6 3H12V8C12 9.10457 12.8954 10 14 10H19V20C19 20.5523 18.5523 21 18 21H6C5.44772 21 5 20.5523 5 20V4ZM18.5858 8L14 3.41421V8H18.5858Z"
                                         fill="currentColor"></path>
                                 </g>
                             </svg>
                         </div>
                     </div>
                 </div>
                 <div class="text-center">
                     <div class="page-title">Supporting Document</div>
                     <div class="page-subtitle">Document for School Equipment</div>
                 </div>
             </div>
             <div class="grid grid-cols-1 gap-4 mb-4">
                 <input type="hidden" name="id" id="document_id">
                 <div>
                     <label for="document_type_id">Supporting Document Type <span
                             class="text-red-600">(required)</span></label>
                     <select name="document_type_id" id="document_type_id"
                         class="w-full border border-gray-400 rounded px-2 py-1">
                         <option value="">Select</option>
                         @foreach (App\Models\SchoolEquipment\SchoolEquipmentDocumentType::all() as $type)
                             <option value="{{ $type->id }}">
                                 {{ $type->name }}
                             </option>
                         @endforeach
                     </select>
                 </div>
                 <div>
                     <label for="document_number">Document No. <span class="text-red-600">(required)</span></label>
                     <input type="text" id="document_number" name="document_number"
                         class="w-full border border-gray-400 rounded px-2 py-1">
                 </div>

             </div>

             <div class="flex gap-2 md:justify-end justify-center ">
                 <button type="button" onclick="closeDocumentModal()"
                     class="btn-cancel w-full py-1 px-4 w-autorounded  ">Cancel</button>
                 <button type="submit" class="btn-green md:w-auto w-full  py-1 px-4  rounded  ">Update
                     Document</button>
             </div>
         </form>

     </div>
 </div>
 <script>
     const documentBaseUrl = "{{ url('School/school-equipment-document') }}";

     function showDocumentEditModal(id, document_type_id, document_number) {
         // Assign values to form inputs
         console.log(id, document_type_id, document_number);
         document.getElementById('document_id').value = id ?? '';
         document.getElementById('document_type_id').value = document_type_id ?? '';
         document.getElementById('document_number').value = document_number ?? '';

         const modal = document.getElementById('edit-document-modal');
         modal.classList.remove('hidden');
         const form = document.getElementById('editDocumentForm');
         form.action = documentBaseUrl + '/' + id;
     }
 </script>
