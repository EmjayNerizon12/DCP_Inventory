 <div class="grid grid-cols-1 md:grid-cols-3 gap-2">

     <div class="bg-blue-200 border flex flex-col justify-between border-gray-800 p-3 ">
         <div class="form-label">1. Delivery Receipt: <span
                 class="font-medium">{{ ucfirst($batchStatus->delivery_receipt_status) }}</span></div>
         @if ($batchStatus->delivery_receipt_status === 'yes' && $batchStatus->delivery_receipt_file)
             <p class="form-label mt-2">Submitted File: <a
                     href="{{ asset('certificates/delivery-receipt/' . $batchStatus->delivery_receipt_file) }}"
                     class="text-sm text-blue-800 underline" target="_blank">{{ $batchStatus->delivery_receipt_file }}</a>
             </p>
         @endif


         <div class="flex justify-end items-end my-2">
             <div
                 class="h-10 w-auto bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">
                 <button type="button"
                     onclick="openModal('Delivery Receipt','{{ $batchStatus->delivery_receipt_status }}','{{ $batchStatus->delivery_receipt_file }}','N/A','N/A')"
                     class="btn-submit h-8 py-1 px-4 rounded-full">
                     Edit Delivery Receipt
                 </button>
             </div>
         </div>



     </div>
     <div class="bg-green-200 border border-gray-800 flex flex-col justify-between p-3">
         <label class="form-label">2. Training Acceptance: <span
                 class="font-medium ">{{ ucfirst($batchStatus->training_acceptance_status) }}</span></label>
         @if ($batchStatus->training_acceptance_status === 'yes' && $batchStatus->training_acceptance_file)
             <p class="mt-2 form-label">Submitted File: <a
                     href="{{ asset('certificates/training-acceptance/' . $batchStatus->training_acceptance_file) }}"
                     class="text-sm text-blue-800 underline"
                     target="_blank">{{ $batchStatus->training_acceptance_file }}</a></p>
         @endif


         <div class="flex justify-end items-end my-2">
             <div
                 class="h-10 w-auto bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">
                 <button type="button"
                     onclick="openModal('Training Acceptance','{{ $batchStatus->training_acceptance_status }}','{{ $batchStatus->training_acceptance_file }}','N/A','N/A')"
                     class="btn-green h-8 py-1 px-4 rounded-full">
                     Edit Training Acceptance Report
                 </button>

             </div>
         </div>

     </div>
     <div class="bg-yellow-200 flex flex-col justify-between border border-gray-800 p-3">
         <label class="form-label">3. Invoice Receipt: <span
                 class="font-medium">{{ ucfirst($batchStatus->invoice_receipt_status) }}</span></label>
         @if ($batchStatus->invoice_receipt_status === 'yes' && $batchStatus->invoice_receipt_file)
             <p class="form-label mt-2">Submitted File: <a
                     href="{{ asset('certificates/invoice-receipt/' . $batchStatus->invoice_receipt_file) }}"
                     class="text-sm text-blue-800 underline"
                     target="_blank">{{ $batchStatus->invoice_receipt_file }}</a>
             </p>
         @endif

         <div class="flex justify-end items-end my-2">
             <div
                 class="h-10 w-auto bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">
                 <button type="button"
                     onclick="openModal('Invoice Receipt','{{ $batchStatus->invoice_receipt_status }}','{{ $batchStatus->invoice_receipt_file }}','N/A','N/A')"
                     class="btn-update h-8 py-1 px-4 rounded-full">
                     Edit Training Acceptance Report
                 </button>

             </div>
         </div>

     </div>
     <div class="bg-red-200 border border-gray-800 flex flex-col justify-between p-3">
         <label class="form-label">4. Inventory Acceptance Report (IAR): <span
                 class="font-medium">{{ $batchStatus->iar_value ? ucfirst(str_replace('_', ' ', $batchStatus->iar_value)) : 'Not Set' }}</span></label>
         @if ($batchStatus->iar_value === 'with IAR')
             <div class="mt-2 space-y-2">
                 <p class="form-label">IAR Ref Code:
                     {{ $batchStatus->iar_ref_code ?? 'Not provided' }}</p>
                 <p class="form-label">IAR Date:
                     {{ $batchStatus->iar_date ? date('F j, Y', strtotime($batchStatus->iar_date)) : 'Not provided' }}
                 </p>
                 @if ($batchStatus->iar_file)
                     <p class="form-label">IAR File: <a
                             href="{{ asset('certificates/iar/' . $batchStatus->iar_file) }}"
                             class="text-sm text-blue-800 underline" target="_blank">{{ $batchStatus->iar_file }}</a>
                     </p>
                 @endif

             </div>
         @endif

         <div class="flex justify-end items-end my-2">
             <div
                 class="h-10 w-auto bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">
                 <button type="button"
                     onclick="openModal('IAR','{{ $batchStatus->iar_value }}','{{ $batchStatus->iar_file }}','{{ $batchStatus->iar_ref_code }}','{{ $batchStatus->iar_date }}')"
                     class="btn-delete h-8 py-1 px-4 rounded-full">
                     Edit Inventory Acceptance Report
                 </button>

             </div>
         </div>
     </div>
     <div class="bg-purple-200 border border-gray-800 flex flex-col justify-between p-3">
         <label class="form-label">5. Inventory Transfer Report (ITR): <span
                 class="font-medium">{{ $batchStatus->itr_value ? ucfirst(str_replace('_', ' ', $batchStatus->itr_value)) : 'Not Set' }}</span></label>
         @if ($batchStatus->itr_value === 'with ITR')
             <div class="mt-2 space-y-2">
                 <p class="form-label">ITR Ref Code:
                     {{ $batchStatus->itr_ref_code ?? 'Not provided' }}</p>
                 <p class="form-label">ITR Date:
                     {{ $batchStatus->itr_date ? date('F j, Y', strtotime($batchStatus->itr_date)) : 'Not provided' }}
                 </p>
                 @if ($batchStatus->itr_file)
                     <p class="form-label">ITR File: <a
                             href="{{ asset('certificates/itr/' . $batchStatus->itr_file) }}"
                             class="text-sm text-blue-800 underline" target="_blank">{{ $batchStatus->itr_file }}</a>
                     </p>
                 @endif
             </div>
         @endif

         <div class="flex justify-end items-end my-2">
             <div
                 class="h-10 w-auto bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">
                 <button type="button"
                     onclick="openModal('ITR','{{ $batchStatus->itr_value }}','{{ $batchStatus->itr_file }}','{{ $batchStatus->itr_ref_code }}','{{ $batchStatus->itr_date }}')"
                     class="btn-purple h-8 py-1 px-4 rounded-full">
                     Edit Inventory Transfer Report
                 </button>
             </div>
         </div>
     </div>

     <div class="bg-indigo-200 border border-gray-800 p-3 flex flex-col justify-between">
         <div>

             <label class="form-label">6. Certificate of Completion: <span
                     class="font-medium">{{ ucfirst($batchStatus->coc_status) }}</span></label>
             @if ($batchStatus->coc_status === 'yes' && $batchStatus->certificate_of_completion)
                 <p class="form-label mt-2">Submitted File: <a
                         href="{{ asset('certificates/certificate-completion/' . $batchStatus->certificate_of_completion) }}"
                         class="text-sm text-blue-800 underline"
                         target="_blank">{{ $batchStatus->certificate_of_completion }}</a></p>
             @endif
         </div>

         <div class="flex justify-end items-end my-2">
             <div
                 class="h-10 w-auto bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">
                 <button type="button"
                     onclick="openModal('Certificate of Completion','{{ $batchStatus->coc_status }}','{{ $batchStatus->certificate_of_completion }}','N/A','N/A')"
                     class="btn-indigo h-8 py-1 px-4 rounded-full">
                     Edit Certificate of Completion
                 </button>
             </div>
         </div>
     </div>

 </div>

 <div class="flex md:justify-end justify-start my-2">
     <button title="Show Info Modal" onclick="window.location.href='/School/dcp-batch'"
         class="btn-cancel md:w-auto w-full py-1 px-4 rounded">
         Close
     </button>

 </div>
