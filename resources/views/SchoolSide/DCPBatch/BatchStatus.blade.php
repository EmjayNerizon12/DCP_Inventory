{{-- filepath: c:\Users\Em-jay\dcp_inventory_system\resources\views\SchoolSide\DCPBatch\Items.blade.php --}}

@extends('layout.SchoolSideLayout')

@section('title', 'Batch Items')

@section('content')


    <div class="p-6">


        {{-- Check if we're in display mode (all data submitted) --}}
        @php
            $displayMode =
                ($batchStatus->coc_status === 'yes' || $batchStatus->coc_status === 'no') &&
                ($batchStatus->delivery_receipt_status === 'yes' || $batchStatus->delivery_receipt_status === 'no') &&
                ($batchStatus->invoice_receipt_status === 'yes' || $batchStatus->invoice_receipt_status === 'no') &&
                ($batchStatus->training_acceptance_status === 'yes' ||
                    $batchStatus->training_acceptance_status === 'no') &&
                ($batchStatus->iar_value === 'with IAR' || $batchStatus->iar_value === 'without IAR') &&
                ($batchStatus->itr_value === 'with ITR' || $batchStatus->itr_value === 'without ITR');
        @endphp


        <div class="flex justify-start items-center mb-4 space-x-2">
            <div
                class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                <button onclick="window.location.href='/School/dcp-batch'" class="btn-submit  p-1 rounded-full">
                    <svg fill="currentColor" class="w-8 h-8" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 472.615 472.615" xml:space="preserve">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <g>
                                <g>
                                    <path
                                        d="M167.158,117.315l-0.001-77.375L0,193.619l167.157,153.679v-68.555c200.338,0.004,299.435,153.932,299.435,153.932 c3.951-19.967,6.023-40.609,6.023-61.736C472.615,196.295,341.8,117.315,167.158,117.315z">
                                    </path>
                                </g>
                            </g>
                        </g>
                    </svg>
                </button>
            </div>
            <div class="tracking-wide">
                <h1 class="page-title">
                    School DCP Batch Status & Files
                </h1>
                <div class="page-subtitle">This is required to comply with the DCP Regulations.
                </div>
            </div>

        </div>


        <h2 class="text-lg font-medium text-gray-800 mb-4 flex items-center gap-2">

            @if ($displayMode)
                <div class="flex justify-start my-2">
                    <button title="Ready for Batch Submission" type="button"
                        class="btn-green hover:bg-green-600 flex items-center h-8 py-1 px-4 rounded-full">
                        Status (Completed)
                    </button>

                </div>
            @else
                <div class="flex justify-start my-2">
                    <button title="Complete the Following" type="button"
                        class="btn-cancel hover:bg-gray-400 flex items-center h-8 py-1 px-4 rounded-full">
                        Status (Not Completed)
                    </button>

                </div>
            @endif
        </h2>

        {{-- EDIT MODAL FILES --}}
        @include('SchoolSide.DCPBatch.partials.BatchFiles._modalEdit')





        @if ($displayMode)
            <script>
                const statusSelect = document.getElementById('status');
                const fileWrapper = document.getElementById('file-wrapper');

                statusSelect.addEventListener('change', function() {
                    if (this.value === 'yes') {
                        document.getElementById('code_wrapper').classList.remove('hidden');

                        fileWrapper.classList.remove('hidden'); // show
                    } else {
                        document.getElementById('code_wrapper').classList.add('hidden');

                        fileWrapper.classList.add('hidden'); // hide
                    }
                });

                function openModal(type, status, file, code, date) {
                    const modal = document.getElementById('edit-modal');
                    const title = document.getElementById('title');
                    const statusSelect = document.getElementById('status');
                    const currentFile = document.getElementById('current-file');
                    let file_type = '';
                    if (type === "Certificate of Completion") {
                        document.getElementById('type').value = "certificate-completion";
                        file_type = 'certificate-completion';
                        statusSelect.value = status;
                    } else if (type === "Delivery Receipt") {
                        document.getElementById('type').value = "delivery-receipt";
                        file_type = 'delivery-receipt';
                        statusSelect.value = status;
                    } else if (type === "Invoice Receipt") {
                        document.getElementById('type').value = "invoice-receipt";
                        file_type = 'invoice-receipt';
                        statusSelect.value = status;
                    } else if (type === "Training Acceptance") {
                        document.getElementById('type').value = "training-acceptance";
                        file_type = 'training-acceptance';
                        statusSelect.value = status;
                    } else if (type == "ITR") {
                        document.getElementById('type').value = "itr";
                        file_type = 'itr';
                        if (status == "with ITR") {
                            document.getElementById('code_wrapper').classList.remove('hidden');
                            statusSelect.value = "yes";
                            document.getElementById('title_2').textContent = type;
                            document.getElementById('title_3').textContent = type;
                            document.getElementById('code').value = code;
                            document.getElementById('date').value = date;

                        } else {

                            statusSelect.value = "no";
                        }

                    } else if (type == "IAR") {
                        document.getElementById('type').value = "iar";
                        file_type = 'iar';
                        if (status == "with IAR") {
                            document.getElementById('code_wrapper').classList.remove('hidden');
                            statusSelect.value = "yes";
                            document.getElementById('code').value = code;
                            document.getElementById('title_3').textContent = type;
                            document.getElementById('title_2').textContent = type;
                            document.getElementById('date').value = date;

                        } else {

                            statusSelect.value = "no";
                        }
                    }

                    modal.classList.remove('hidden');
                    title.textContent = type;

                    // Show current file if exists
                    if (file) {
                        currentFile.innerHTML =
                            `View current file:<a class="text-blue-600 underline font-medium " href="/certificates/${file_type}/${file}" target="_blank"> ${file}</a>`;
                        fileWrapper.classList.remove('hidden'); // show

                    } else {
                        currentFile.textContent = "";
                    }
                }
            </script>
            @include('SchoolSide.DCPBatch.partials.BatchFiles._showFiles')
        @else
            {{-- INSERT MODE - Show form inputs --}}
            @include('SchoolSide.DCPBatch.partials.BatchFiles._formSubmitFiles')
        @endif

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            toggleFileInput('delivery_receipt');
            toggleFileInput('training_acceptance');
            toggleFileInput('invoice_receipt');
            toggleFileInput('cert_completion');
            toggleIARFields();
            toggleITRFields();
        });

        function toggleFileInput(name) {
            const select = document.getElementById(`${name}_status`);
            const inputWrapper = document.getElementById(`${name}_input`);
            if (!inputWrapper || !select) return;
            inputWrapper.classList.toggle('hidden', select.value !== 'yes');
        }

        function toggleIARFields() {
            const select = document.getElementById('iar_status');
            const fields = document.getElementById('iar_fields');
            if (!fields || !select) return;
            fields.classList.toggle('hidden', select.value !== 'yes');
        }

        function toggleITRFields() {
            const select = document.getElementById('itr_status');
            const fields = document.getElementById('itr_fields');
            if (!fields || !select) return;
            fields.classList.toggle('hidden', select.value !== 'yes');
        }

        function toggleEditMode() {
            // You can implement this to switch back to edit mode
            // This would typically involve reloading the page with edit=true parameter
            // or making an AJAX call to switch modes
            window.location.href = window.location.href + '?edit=true';
        }
    </script>
@endsection
