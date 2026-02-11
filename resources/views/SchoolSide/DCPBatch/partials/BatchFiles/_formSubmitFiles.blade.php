 <form action="{{ route('school.update.batch_status', ['batchId' => $batchId]) }}" method="POST"
     enctype="multipart/form-data">
     @csrf
     <div class="grid grid-cols-1 md:grid-cols-3 gap-3">

         {{-- DELIVERY RECEIPT --}}

         <div class="bg-blue-200 border   p-3">
             <label class="form-label">1. Delivery Receipt:</label>
             <select name="delivery_receipt_status" id="delivery_receipt_status" class="form-input"
                 onchange="toggleFileInput('delivery_receipt')" required>
                 <option value="">Select</option>
                 <option value="yes" {{ $batchStatus->delivery_receipt_status == 'yes' ? 'selected' : '' }}>
                     Yes</option>
                 <option value="no" {{ $batchStatus->delivery_receipt_status == 'no' ? 'selected' : '' }}>
                     No
                 </option>
             </select>

             <div id="delivery_receipt_input"
                 class="mt-2 {{ $batchStatus->delivery_receipt_status === 'yes' ? '' : 'hidden' }}">
                 @if ($batchStatus->delivery_receipt_status == 'yes' && !empty($batchStatus->delivery_receipt_file))
                     <p class="text-gray-800 font-semibold">Submitted File:</p>
                     <p class="text-sm text-blue-800 underline"><a
                             href="{{ asset('storage/' . $batchStatus->delivery_receipt_file) }}" target="_blank">View
                             File</a></p>
                 @else
                     <label class="form-label">Upload File:</label>
                     <input type="file" name="delivery_receipt_file" class="form-input bg-white" />
                 @endif
             </div>
         </div>

         {{-- TRAINING ACCEPTANCE --}}
         <div class="bg-green-200 border   p-3">
             <label class="form-label">2. Training Acceptance:</label>
             <select name="training_acceptance_status" id="training_acceptance_status" class="form-input"
                 onchange="toggleFileInput('training_acceptance')" required>
                 <option value="">Select</option>
                 <option value="yes" {{ $batchStatus->training_acceptance_status == 'yes' ? 'selected' : '' }}>Yes
                 </option>
                 <option value="no" {{ $batchStatus->training_acceptance_status == 'no' ? 'selected' : '' }}>
                     No</option>
             </select>

             <div id="training_acceptance_input"
                 class="mt-2 {{ $batchStatus->training_acceptance_status === 'yes' ? '' : 'hidden' }}">
                 @if ($batchStatus->training_acceptance_status == 'yes' && !empty($batchStatus->training_acceptance_file))
                     <p class="text-gray-800 font-semibold">Submitted File:</p>
                     <p class="text-sm text-blue-800 underline"><a
                             href="{{ asset('storage/' . $batchStatus->training_acceptance_file) }}"
                             target="_blank">View File</a></p>
                 @else
                     <label class="form-label">Upload File:</label>
                     <input type="file" name="training_acceptance_file" class="form-input bg-white" />
                 @endif
             </div>
         </div>

         {{-- INVOICE RECEIPT --}}
         <div class="bg-yellow-200 border   p-3">
             <label class="form-label">3. Invoice Receipt:</label>
             <select name="invoice_receipt_status" id="invoice_receipt_status" class="form-input"
                 onchange="toggleFileInput('invoice_receipt')"required>
                 <option value="">Select</option>
                 <option value="yes" {{ $batchStatus->invoice_receipt_status == 'yes' ? 'selected' : '' }}>
                     Yes</option>
                 <option value="no" {{ $batchStatus->invoice_receipt_status == 'no' ? 'selected' : '' }}>No
                 </option>
             </select>

             <div id="invoice_receipt_input"
                 class="mt-2 {{ $batchStatus->invoice_receipt_status === 'yes' ? '' : 'hidden' }}">
                 @if ($batchStatus->invoice_receipt_status == 'yes' && !empty($batchStatus->invoice_receipt_file))
                     <p class="text-gray-800 font-semibold">Submitted File:</p>
                     <p class="text-sm text-blue-800 underline"><a
                             href="{{ asset('storage/' . $batchStatus->invoice_receipt_file) }}" target="_blank">View
                             File</a></p>
                 @else
                     <label class="form-label">Upload File:</label>
                     <input type="file" name="invoice_receipt_file" class="form-input bg-white" />
                 @endif
             </div>
         </div>

         {{-- IAR SECTION --}}
         <div class="bg-red-200 border   p-3">
             <label class="form-label">4. IAR Status:</label>
             <select name="iar_value" id="iar_status" required class="form-input" onchange="toggleIARFields()">
                 <option value="">Select</option>
                 <option value="yes" {{ $batchStatus->iar_value == 'with IAR' ? 'selected' : '' }}>Yes
                 </option>
                 <option value="no" {{ $batchStatus->iar_value == 'without IAR' ? 'selected' : '' }}>No
                 </option>
             </select>

             <div id="iar_fields" class="mt-2 {{ $batchStatus->iar_value == 'with IAR' ? '' : 'hidden' }}">
                 <label class="form-label">IAR Ref Code:</label>
                 <input type="text" name="iar_ref_code"
                     class="border rounded px-3 py-2 w-full mb-2 text-gray-800 bg-white"
                     value="{{ $batchStatus->iar_ref_code ?? '' }}" />

                 <label class="form-label">IAR Date:</label>
                 <input type="date" name="iar_date"
                     class="border rounded px-3 py-2 w-full mb-2 text-gray-800 bg-white"
                     value="{{ $batchStatus->iar_date ?? '' }}" />

                 <label class="form-label">Upload IAR File:</label>
                 <input type="file" name="iar_file" class="border rounded px-3 py-2 w-full text-gray-800 bg-white" />

                 @if (!empty($batchStatus->iar_file))
                     <p class="text-sm text-gray-700 mt-1">Current file: {{ $batchStatus->iar_file }}</p>
                 @endif
             </div>
         </div>

         {{-- ITR SECTION --}}
         <div class="bg-purple-200 border   p-3">
             <label class="form-label">5. ITR Status:</label>
             <select name="itr_value" id="itr_status" required class="form-input" onchange="toggleITRFields()">
                 <option value="">Select</option>
                 <option value="yes" {{ $batchStatus->itr_value == 'with ITR' ? 'selected' : '' }}>Yes
                 </option>
                 <option value="no" {{ $batchStatus->itr_value == 'without ITR' ? 'selected' : '' }}>No
                 </option>
             </select>

             <div id="itr_fields" class="mt-2 {{ $batchStatus->itr_value == 'with ITR' ? '' : 'hidden' }}">
                 <label class="form-label">ITR Ref Code:</label>
                 <input type="text" name="itr_ref_code"
                     class="border rounded px-3 py-2 w-full mb-2 text-gray-800 bg-white"
                     value="{{ $batchStatus->itr_ref_code ?? '' }}" />

                 <label class="form-label">ITR Date:</label>
                 <input type="date" name="itr_date"
                     class="border rounded px-3 py-2 w-full mb-2 text-gray-800 bg-white"
                     value="{{ $batchStatus->itr_date ?? '' }}" />

                 <label class="form-label">Upload ITR File:</label>
                 <input type="file" name="itr_file"
                     class="border rounded px-3 py-2 w-full text-gray-800 bg-white" />

                 @if (!empty($batchStatus->itr_file))
                     <p class="text-sm text-gray-700 mt-1">Current file: {{ $batchStatus->itr_file }}</p>
                 @endif
             </div>
         </div>

         {{-- CERTIFICATE OF COMPLETION --}}
         <div class="bg-indigo-200 border   p-3">
             <label class="form-label">6. Certificate of Completion:</label>
             <select name="coc_status" id="cert_completion_status" class="form-input"
                 onchange="toggleFileInput('cert_completion')" required>
                 <option value="">Select</option>
                 <option value="yes" {{ $batchStatus->coc_status == 'yes' ? 'selected' : '' }}>Yes
                 </option>
                 <option value="no" {{ $batchStatus->coc_status == 'no' ? 'selected' : '' }}>No
                 </option>
             </select>

             <div id="cert_completion_input" class="mt-2 {{ $batchStatus->coc_status === 'yes' ? '' : 'hidden' }}">
                 @if ($batchStatus->coc_status == 'yes' && !empty($batchStatus->certificate_of_completion))
                     <p class="text-gray-800 font-semibold">Submitted File:</p>
                     <p class="text-sm text-blue-800 underline"><a
                             href="{{ asset('storage/' . $batchStatus->certificate_of_completion) }}"
                             target="_blank">View File</a></p>
                 @else
                     <label class="form-label">Upload File:</label>
                     <input type="file" name="certificate_of_completion" class="form-input bg-white" />
                 @endif
             </div>
         </div>
     </div>

     <div class="mt-4 flex md:justify-end justify-center gap-2">


         <button onclick="window.location.href='/School/dcp-batch'" type="button" title="Show Info Modal"
             class="btn-cancel md:w-auto w-full  h-8 py-1 px-4 rounded">
             Cancel
         </button>

         <button type="submit" title="Submit the Following"
             class="btn-submit md:w-auto w-full h-8 py-1 px-4 rounded">
             Save Files
         </button>

     </div>
 </form>
