{{-- filepath: c:\Users\Em-jay\dcp_inventory_system\resources\views\SchoolSide\DCPBatch\Items.blade.php --}}

@extends('layout.SchoolSideLayout')

@section('title', 'Batch Items')

@section('content')


    <div class="p-6">

        <div class="flex flex-row gap-2 items-start justify-start">

            <div>

                <div class="page-title">
                    DCP Batch Items:
                </div>
                <div class="page-subtitle">
                    {{ $batch->batch_label ?? '' }}
                </div>
            </div>
        </div>
        @if ($batchId)
            <input type="hidden" name="" id="batchId" value={{ $batchId }}>

            @include('SchoolSide.DCPBatch.partials.Item.printAllQR')
            @include('SchoolSide.DCPBatch.partials.Item._itemProgressContainer')


            <div class="flex justify-start gap-2">

                <div
                    class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                    <button onclick="window.location.href='/School/dcp-batch'" class="btn-submit  p-1 rounded-full">
                        <svg fill="currentColor" class="w-8 h-8" version="1.1" id="Layer_1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            viewBox="0 0 472.615 472.615" xml:space="preserve">
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

                <div
                    class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                    <button class="btn-submit p-1 rounded-full" onclick="printAllQRCodes()">
                        <svg viewBox="0 0 24 24" class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M3 9h6V3H3zm1-5h4v4H4zm1 1h2v2H5zm10 4h6V3h-6zm1-5h4v4h-4zm1 1h2v2h-2zM3 21h6v-6H3zm1-5h4v4H4zm1 1h2v2H5zm15 2h1v2h-2v-3h1zm0-3h1v1h-1zm0-1v1h-1v-1zm-10 2h1v4h-1v-4zm-4-7v2H4v-1H3v-1h3zm4-3h1v1h-1zm3-3v2h-1V3h2v1zm-3 0h1v1h-1zm10 8h1v2h-2v-1h1zm-1-2v1h-2v2h-2v-1h1v-2h3zm-7 4h-1v-1h-1v-1h2v2zm6 2h1v1h-1zm2-5v1h-1v-1zm-9 3v1h-1v-1zm6 5h1v2h-2v-2zm-3 0h1v1h-1v1h-2v-1h1v-1zm0-1v-1h2v1zm0-5h1v3h-1v1h-1v1h-1v-2h-1v-1h3v-1h-1v-1zm-9 0v1H4v-1zm12 4h-1v-1h1zm1-2h-2v-1h2zM8 10h1v1H8v1h1v2H8v-1H7v1H6v-2h1v-2zm3 0V8h3v3h-2v-1h1V9h-1v1zm0-4h1v1h-1zm-1 4h1v1h-1zm3-3V6h1v1z">
                                </path>
                                <path fill="none" d="M0 0h24v24H0z"></path>
                            </g>
                        </svg>
                    </button>
                </div>



                <div
                    class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                    <button class="btn-submit p-1 rounded-full" onclick="openProgressModal()">
                        <svg fill="currentColor" class="w-8 h-8" viewBox="0 0 14 14" role="img" focusable="false"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M 1.23379,9.0821203 C 1.01494,8.9761203 1,8.8432203 1,7.0019203 c 0,-1.8649 0.0133,-1.9758 0.2495,-2.0834 0.18499,-0.084 11.31601,-0.084 11.501,0 0.23622,0.1076 0.2495,0.2185 0.2495,2.0834 0,1.8648 -0.0133,1.9757 -0.2495,2.0833 -0.17686,0.081 -11.35009,0.077 -11.51671,0 z m 10.90907,-2.0802 0,-1.2858 -5.14286,0 -5.14286,0 0,1.2858 0,1.2857 5.14286,0 5.14286,0 0,-1.2857 z m -9.85715,0 0,-0.8572 0.64286,0 0.64286,0 0,0.8572 0,0.8571 -0.64286,0 -0.64286,0 0,-0.8571 z m 1.71429,0 0,-0.8572 0.64286,0 0.64285,0 0,0.8572 0,0.8571 -0.64285,0 -0.64286,0 0,-0.8571 z m 1.71429,0 0,-0.8572 0.64285,0 0.64286,0 0,0.8572 0,0.8571 -0.64286,0 -0.64285,0 0,-0.8571 z m 1.71428,0 0,-0.8572 0.64286,0 0.64286,0 0,0.8572 0,0.8571 -0.64286,0 -0.64286,0 0,-0.8571 z">
                                </path>
                            </g>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="overflow-hidden space-y-4">
                <div class="spinner-container">
                    <div class="spinner-lg" id="spinner">

                    </div>
                </div>
                <div class="overflow-x-auto hidden" id="tableContainer">
                    <div class="font-medium tracking-wider text-gray-800 text-right w-full">Tap to Open</div>
                    <table class="min-w-full   text-left   table-fixed font-medium  text-gray-700 mb-4"
                        style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif  ">
                        <tbody id="tableBodyItem" class=" divide-y divide-gray-200 space-y-6">

                        </tbody>

                    </table>


                </div>
                <div class="flex w-full justify-center items-center">
                    <button id="loadMore" class="btn-submit rounded-md flex justify-center w-32 px-4 py-2 mt-3">
                        Load More
                    </button>
                </div>
                @include('SchoolSide.DCPBatch.partials.Item._script')
            </div>
        @else
            <div
                class="mx-5 my-5 flex flex-row justify-between bg-white rounded border border-gray-300 shadow-xl  p-6  px-auto ">

                <div>
                    <h2 class="text-2xl font-bold text-blue-700">Batch: {{ $batchName }}</h2>
                    <h2 class="text-2xl font-bold text-gray-800  ">Check Status of the Items.</h2>
                    <span class="text-gray-600">This batch has been approved by admin.</span>
                    <div class="mt-5"> <span class="text-sm text-gray-600">Click here. </span>

                        <a href="{{ route('school.dcp_item_status', $batchId) }}"
                            class="px-4 py-1 ml-2 text-md font-semibold text-white bg-blue-600 rounded hover:bg-blue-700">DCP
                            Batch
                            Status</a>
                    </div>
                </div>

                <div class="h-32 w-32 md:block hidden text-blue-600">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M20.5 7.27783L12 12.0001M12 12.0001L3.49997 7.27783M12 12.0001L12 21.5001M14 20.889L12.777 21.5684C12.4934 21.726 12.3516 21.8047 12.2015 21.8356C12.0685 21.863 11.9315 21.863 11.7986 21.8356C11.6484 21.8047 11.5066 21.726 11.223 21.5684L3.82297 17.4573C3.52346 17.2909 3.37368 17.2077 3.26463 17.0893C3.16816 16.9847 3.09515 16.8606 3.05048 16.7254C3 16.5726 3 16.4013 3 16.0586V7.94153C3 7.59889 3 7.42757 3.05048 7.27477C3.09515 7.13959 3.16816 7.01551 3.26463 6.91082C3.37368 6.79248 3.52345 6.70928 3.82297 6.54288L11.223 2.43177C11.5066 2.27421 11.6484 2.19543 11.7986 2.16454C11.9315 2.13721 12.0685 2.13721 12.2015 2.16454C12.3516 2.19543 12.4934 2.27421 12.777 2.43177L20.177 6.54288C20.4766 6.70928 20.6263 6.79248 20.7354 6.91082C20.8318 7.01551 20.9049 7.13959 20.9495 7.27477C21 7.42757 21 7.59889 21 7.94153L21 12.5001M7.5 4.50008L16.5 9.50008M16 18.0001L18 20.0001L22 16.0001"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                        </g>
                    </svg>
                </div>


            </div>
        @endif
    </div>

    <script>
        function printAllQRCodes() {
            const printContents = document.getElementById('print-qr-section').innerHTML;
            const printWindow = window.open('', '', 'height=900,width=1500');
            printWindow.document.write('<html><head><title>Print QR Codes</title>');
            printWindow.document.write(
                '<style>@media print { body { margin:0;  } }</style>');
            printWindow.document.write('</head><body>');
            printWindow.document.write(printContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.focus();
            setTimeout(() => {
                printWindow.print();
                printWindow.close();
            }, 500);
        }
    </script>

    <script>
        async function update(itemId) {
            try {
                const statusButton = document.getElementById('status-button-' + itemId);
                const resultDiv = document.getElementById('result_' + itemId);
                resultDiv.classList.add('hidden');
                const form = document.getElementById(`dcp_update_form_${itemId}`);
                form.action = `/School/dcp-batch/${itemId}`;
                // Delivery Condition
                const formData = new FormData(form);
                formData.append('_method', 'PUT');
                if (!form.checkValidity()) {
                    // this will show browser messages for required fields
                    form.reportValidity();
                    return; // stop execution
                }
                statusButton.innerHTML =
                    '<div class="w-6 h-6 border-4 border-gray-200 border-t-white rounded-full animate-spin"></div>';


                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content,
                        'Accept': 'application/json'
                    }

                })
                const data = await response.json();
                if (data.success) {


                    // Show success message inside this form
                    const resultMsg = document.getElementById('result-message-' + itemId);
                    resultMsg.innerText = "Item updated successfully!";
                    resultDiv.classList.remove('hidden');
                    const serialInput = document.getElementById('selectedSerialNumber_' + itemId);
                    serialInput.classList.remove('border-red-500');

                    const completedStatusBadge = document.getElementById('ok_status_badge_' + itemId);
                    const notCompletedStatusBadge = document.getElementById('not_status_badge_' + itemId);

                    completedStatusBadge.classList.remove('hidden');
                    notCompletedStatusBadge.classList.add('hidden');


                    // ✅ Update button
                    if (statusButton) {
                        statusButton.innerText = "Update";
                        statusButton.classList.remove('btn-submit');
                        statusButton.classList.add('btn-green');
                    }



                } else {
                    const serialInput = document.getElementById('selectedSerialNumber_' + itemId);
                    serialInput.value = '';
                    serialInput.classList.add('border-red-500'); // highlight as error
                    alert('Error: ' + (data.message || 'Unknown error'));
                    console.error(data)
                }

            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred while updating the item.');
            }
        }
    </script>
@endsection
<script>
    // document.addEventListener('DOMContentLoaded', function() {
    //     <?php foreach($items as $item): ?>
    //     toggleIARInputs(<?= $item->pk_dcp_batch_items_id ?>);
    //     toggleITRInputs(<?= $item->pk_dcp_batch_items_id ?>);
    //     <?php endforeach; ?>
    // });

    // function toggleIARInputs(id) {
    //     var iarValue = document.getElementById('iar_value_' + id).value;
    //     var refCode = document.getElementById('iar_ref_code_' + id);
    //     var date = document.getElementById('iar_date_' + id);
    //     if (iarValue !== 'with IAR') {
    //         refCode.disabled = true;
    //         date.disabled = true;
    //     } else {
    //         refCode.disabled = false;
    //         date.disabled = false;
    //     }
    // }



    // document.addEventListener('DOMContentLoaded', function() {
    //     // Generate an array of item IDs using Blade/PHP and pass to JS
    //     const itemIds = @json($items->pluck('pk_dcp_batch_items_id'));
    //     itemIds.forEach(function(id) {
    //         toggleIARInputs(id);
    //         toggleITRInputs(id);
    //     });
    // });
</script>
<script src="//unpkg.com/alpinejs" defer></script>
