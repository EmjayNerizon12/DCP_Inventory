{{-- filepath: c:\Users\Em-jay\dcp_inventory_system\resources\views\SchoolSide\DCPBatch\Items.blade.php --}}

@extends('layout.SchoolSideLayout')

@section('title', 'Batch Items')

@section('content')
    <style>
        input,
        select {
            border: 1px solid #282828;
        }
    </style>

    <div style="transform:translateY(1rem)" class=" p-0 mx-5 ">

        <a href="{{ route('school.dcp_batch') }}"
            class="inline-flex bg-blue-600 shadow uppercase rounded items-center justify-center text-white px-2 py-1 tracking-wider  text-md font-medium  mb-2">

            <div>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </div>
            <div>
                Return
            </div>
        </a>
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
    @if ($batch_approved != 'APPROVED')
        <div id="print-qr-section" style="display:none;">
            <div style="width:210mm;min-height:297mm;padding:0;margin:0;">
                <h2 style="text-align:center;font-size:24px;margin:16px 0;">Batch Items QR Codes</h2>
                <div
                    style="
                        display: grid;
                        grid-template-columns: repeat(5, 1fr);
                        gap: 0;
                        width: 140%;
                        margin: 0;
                        padding: 0;">
                    @foreach ($items as $item)
                        <div style="padding:0;box-sizing:border-box;page-break-inside:avoid;">
                            <div style="border:1px solid #ccc;padding:10px;text-align:center;">
                                <div>
                                    @php
                                        $url = url("/School/DCPInventory/{$item->generated_code}");
                                        $svg = SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')
                                            ->size(120)
                                            ->generate($url);
                                    @endphp
                                    {!! $svg !!}
                                </div>
                                <div style="font-size:14px;margin-top:8px;">
                                    <b>{{ $item->generated_code }}</b><br>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class=" rounded-sm overflow-hidden    mx-5 my-5">
            {{-- <div class=" px-2 ">
                <h2 class="text-2xl font-semibold text-gray-800   text-blue-600">School DCP Batch Item</h2>
                <p class="mb-2 tracking-wide    ">Encode the serial number of the item and other important information.</p>
            </div> --}}
            @php
                $batch_items = App\Models\DCPBatchItem::where('dcp_batch_id', $batchId)->get();

                $completed_count = $batch_items
                    ->filter(function ($b) {
                        return isset($b->brand) &&
                            $b->dcpItemCurrentCondition &&
                            $b->dcpItemCurrentCondition->current_condition_id;
                    })
                    ->count();

                $isCompleted = $batch_items->count() > 0 && $completed_count === $batch_items->count();
            @endphp


            <div class="  px-2 flex md:flex-row flex-col gap-2">
                <div
                    class="rounded-md bg-white border border-gray-300  w-full  px-4  shadow-sm p-2 transition duration-300 
                  ">

                    <!-- Header -->
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold tracking-wide text-gray-700 uppercase">Encoding Progress</h2>
                        <span
                            class="text-md px-3 py-1 rounded-full  whitespace-nowrap
                        {{ $isCompleted ? 'bg-green-500 text-white' : 'bg-blue-500 text-white' }}">
                            {{ $isCompleted ? 'Completed' : 'In Progress' }}
                        </span>
                    </div>

                    <!-- Progress Bar -->
                    <div class="w-full bg-gray-300 rounded-full h-3 mb-4">
                        <div class="h-3 rounded-full 
                        {{ $isCompleted ? 'bg-green-500' : 'bg-blue-500' }}"
                            style="width: {{ $batch_items->count() > 0 ? ($completed_count / $batch_items->count()) * 100 : 0 }}%">
                        </div>
                    </div>

                    <!-- Stats -->
                    <div class="flex justify-between items-center text-lg text-gray-600  font-medium">
                        <span>{{ $completed_count }} / {{ $batch_items->count() }} Items</span>
                        <span>{{ round(($completed_count / max($batch_items->count(), 1)) * 100, 0) }}%</span>
                    </div>
                </div>
                <div
                    class="bg-white w-full   border border-gray-300 rounded-md p-6 flex flex-col  sm:items-center sm:justify-between gap-4">
                    <!-- Left: Batch Label -->
                    <div class="tracking-wide font-medium">
                        <h2 class="text-xl  text-gray-800">
                            Product Code:
                            <span class="text-blue-600">{{ $batch->batch_label ?? '' }}</span>
                        </h2>
                    </div>

                    <div>
                        <button type="button" onclick="printAllQRCodes()"
                            class="px-4 py-2 rounded uppercase tracking-wider shadow font-medium text-white bg-blue-500 hover:bg-blue-600 transition duration-200 shadow-sm">
                            Print All QR Codes
                        </button>
                    </div>
                    <!-- Right: Action Button -->

                </div>



            </div>
        </div>



        <div class="overflow-hidden p-2 mx-5  ">


            <!-- Place this somewhere above your table, e.g. after <h2> -->
            <div id="result" class="hidden mt-4">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded flex items-center gap-2"
                    role="alert">
                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    <span id="result-message"></span>
                </div>
            </div>
            <div class="font-medium tracking-wider text-gray-800">Click to Open</div>

            <div class="overflow-x-auto">
                <table class="min-w-full   text-left   table-fixed font-medium  text-gray-700 mb-4"
                    style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif  ">
                    <tbody class="  divide-y divide-gray-200 space-y-6">
                        @forelse($items as $index => $item)
                            <tr>
                                <td style="height: 30px; "></td>
                            </tr>

                            <tr>
                                <td x-data="{ open: false }" colspan="13"
                                    class="px-4 py-3 shadow bg-white border border-gray-300">
                                    <form id="dcp_update_form_{{ $item->pk_dcp_batch_items_id }}" method="POST"
                                        action="{{ route('school.dcp_items.update', $item->pk_dcp_batch_items_id) }}"
                                        enctype="multipart/form-data" class="space-y-4">
                                        @csrf
                                        @method('PUT')
                                        <span style="font-bold ">{{ $index + 1 }}.</span>
                                        @php

                                            $status_button = '';
                                            $status_button_bg = ' ';
                                            $condition_current =
                                                $item->dcpItemCurrentCondition->current_condition_id ?? 0;

                                        @endphp
                                        <span id="status-badge-{{ $item->pk_dcp_batch_items_id }}"
                                            class="{{ $condition_current && $item->brand ? 'bg-green-600 px-2 py-1  text-white shadow rounded tracking-wide font-medium' : 'text-gray-600' }} ">
                                            {{ $condition_current && $item->brand ? 'Completed' : 'Not Completed' }}
                                        </span>
                                        {{-- Header --}}
                                        {{-- transform scale-100 hover:scale-105 transition duration-200  --}}
                                        <div @click="open = !open"
                                            class="flex items-center  flex-col font-bold cursor-pointer tracking-wider  text-center md:text-2xl text-md pb-0 ">

                                            {{ $item->generated_code }}







                                            <div style="font-family:'Verdana', Geneva, Tahoma, sans-serif;"
                                                class="text-sm text-gray-600">
                                                @php
                                                    $item_type = DB::table('dcp_item_types')
                                                        ->where('pk_dcp_item_types_id', $item->item_type_id)
                                                        ->first();
                                                @endphp
                                                ({{ $item_type->name }})
                                            </div>
                                            <div>
                                                <span class="text-gray-600 text-sm font-normal"
                                                    style="font-family:'Verdana', Geneva, Tahoma, sans-serif;">Unit
                                                    Price:
                                                    &#8369; {{ number_format($item->unit_price, 2) }}</span>

                                            </div>


                                        </div>

                                        {{-- Flex container: QR + Inputs + Buttons --}}
                                        <div x-show="open" x-transition
                                            class="flex flex-col md:flex-row items-start md:items-end md:space-x-6">
                                            {{-- QR on the left --}}


                                            {{-- Inputs + Buttons on the right --}}
                                            <div class="flex-1 space-y-4">
                                                {{-- First row: inputs --}}
                                                <div class="grid grid-cols-1 md:grid-cols-4 gap-2">
                                                    <div>
                                                        <label class="font-semibold">Quantity:</label>
                                                        <input type="number" name="quantity" value="{{ $item->quantity }}"
                                                            class="border rounded px-3 py-2 w-full" disabled />
                                                        <div class="text-blue-600 text-sm">View Only</div>

                                                    </div>
                                                    <div>
                                                        <label class="font-semibold">Current Condition:</label>
                                                        <select name="condition_id" class="border rounded px-3 py-2 w-full">
                                                            <option value="">Select Condition</option>
                                                            @foreach ($conditions as $cond)
                                                                @php
                                                                    $condition_is =
                                                                        $item->dcpItemCurrentCondition
                                                                            ->current_condition_id ?? 0;

                                                                @endphp
                                                                <option value="{{ $cond->pk_dcp_current_conditions_id }}"
                                                                    {{ $condition_is == $cond->pk_dcp_current_conditions_id ? 'selected' : '' }}>
                                                                    {{ $cond->pk_dcp_current_conditions_id }} -
                                                                    {{ $cond->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <div class="text-red-600 text-sm">Required</div>

                                                    </div>
                                                    <div>
                                                        <label class="font-semibold">Brand:</label>
                                                        {{-- <input type="text" name="brand" value="{{ $item->brand }}"
                                                            class="border rounded px-3 py-2 w-full" /> --}}
                                                        @php
                                                            if ($item->brand) {
                                                                $readonly = 'disabled';
                                                            } else {
                                                                # code...
                                                                $readonly = '';
                                                            }
                                                        @endphp
                                                        <select name="brand" {{ $readonly }}
                                                            class="border rounded px-3 py-2 w-full" id="">
                                                            <option value="" {{ $item->brand ? '' : 'selected' }}>
                                                                Select Brand</option>
                                                            @foreach ($brand_list as $brand)
                                                                <option
                                                                    {{ $item->brand == $brand->pk_dcp_batch_item_brands_id ? 'selected' : '' }}
                                                                    value="{{ $brand->pk_dcp_batch_item_brands_id }}">
                                                                    {{ $brand->brand_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="text-blue-600 text-sm">View Only</div>
                                                    </div>
                                                    <div>
                                                        <label class="font-semibold">Serial Number: </label>
                                                        <input type="text" name="serial_number"
                                                            id="selectedSerialNumber_{{ $item->pk_dcp_batch_items_id }}"
                                                            value="{{ $item->serial_number }}"
                                                            class="border rounded px-3 py-2 w-full" />
                                                        <div class="text-red-600 text-sm">Leave Blank if no serial
                                                            number</div>

                                                    </div>
                                                </div>

                                                {{-- Second row: action buttons --}}
                                                <div class="flex space-x-2">


                                                    <button type="button"
                                                        onclick="update({{ $item->pk_dcp_batch_items_id }})"
                                                        id="status-button-{{ $item->pk_dcp_batch_items_id }}"
                                                        class="px-4 py-1 text-md text-white rounded shadow tracking-wider   font-medium uppercase {{ $condition_current && $item->brand ? 'bg-yellow-300 text-gray-800 hover:bg-yellow-400' : 'bg-blue-600 hover:bg-blue-700' }}">
                                                        {{ $condition_current && $item->brand ? 'Update' : 'Submit' }}
                                                    </button>
                                                    <a href="/School/DCPInventory/{{ $item->generated_code }}"
                                                        title="Show in Inventory"
                                                        class="px-4 py-2 text-md font-semibold text-white bg-gray-200 border border-gray-300 shadow rounded  ">
                                                        <div class="flex items-center ">
                                                            <svg class="h-6 " viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                    stroke-linejoin="round"></g>
                                                                <g id="SVGRepo_iconCarrier">
                                                                    <path d="M3.17004 7.43994L12 12.5499L20.77 7.46991"
                                                                        stroke="#292D32" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                    </path>
                                                                    <path d="M12 21.6099V12.5399" stroke="#292D32"
                                                                        stroke-width="1.5" stroke-linecap="round"
                                                                        stroke-linejoin="round"></path>
                                                                    <path
                                                                        d="M21.61 12.83V9.17C21.61 7.79 20.62 6.11002 19.41 5.44002L14.07 2.48C12.93 1.84 11.07 1.84 9.92999 2.48L4.59 5.44002C3.38 6.11002 2.39001 7.79 2.39001 9.17V14.83C2.39001 16.21 3.38 17.89 4.59 18.56L9.92999 21.52C10.5 21.84 11.25 22 12 22C12.75 22 13.5 21.84 14.07 21.52"
                                                                        stroke="#292D32" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                    </path>
                                                                    <path
                                                                        d="M19.2 21.4C20.9673 21.4 22.4 19.9673 22.4 18.2C22.4 16.4327 20.9673 15 19.2 15C17.4327 15 16 16.4327 16 18.2C16 19.9673 17.4327 21.4 19.2 21.4Z"
                                                                        stroke="#292D32" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                    </path>
                                                                    <path d="M23 22L22 21" stroke="#292D32"
                                                                        stroke-width="1.5" stroke-linecap="round"
                                                                        stroke-linejoin="round"></path>
                                                                </g>
                                                            </svg>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0 mb-4 md:mb-0 mt-3 md:mt-0">
                                                @php
                                                    $url = url("/School/DCPInventory/{$item->generated_code}");
                                                    $svg = SimpleSoftwareIO\QrCode\Facades\QrCode::format(
                                                        'svg',
                                                    )->generate($url);
                                                    $base64QrCode = base64_encode($svg);
                                                @endphp
                                                <div class="p-2 border-2 border-dashed border-gray-300">
                                                    <img src="data:image/svg+xml;base64,{{ $base64QrCode }}"
                                                        class="w-28 h-28" alt="QR Code">
                                                    <p class="text-center text-sm mt-1">Scan to show</p>
                                                </div>
                                            </div>
                                        </div>


                                        {{-- Success message --}}
                                        <div id="result_{{ $item->pk_dcp_batch_items_id }}"
                                            class="hidden mt-2 bg-green-100 border border-green-400 text-green-700 px-3 py-2 rounded flex items-center gap-2 text-md">
                                            <svg class="w-4 h-4 mr-1 text-green-600" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                            </svg>
                                            <span id="result-message-{{ $item->pk_dcp_batch_items_id }}"></span>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="13" class="text-center py-4 text-gray-500">
                                    No items found for this batch.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
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
    <script>
        function update(itemId) {
            const form = document.getElementById('dcp_update_form_' + itemId);
            const formData = new FormData(form);
            // Delivery Condition
            if (formData.get('condition_id') === '2' || formData.get('condition_id') === '3') {


            }
            fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }

                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show success message inside this form
                        const resultDiv = document.getElementById('result_' + itemId);
                        const resultMsg = document.getElementById('result-message-' + itemId);
                        resultMsg.innerText = "Item updated successfully!";
                        resultDiv.classList.remove('hidden');
                        const serialInput = document.getElementById('selectedSerialNumber_' + itemId);
                        serialInput.classList.remove('border-red-500');

                        const statusBadge = document.getElementById('status-badge-' + itemId);
                        if (statusBadge) {
                            statusBadge.innerText = "Completed";
                            statusBadge.classList.remove('text-gray-600');
                            statusBadge.classList.add('bg-green-600', 'text-white', 'px-2', 'py-1', 'rounded');
                        }

                        // ✅ Update button
                        const statusButton = document.getElementById('status-button-' + itemId);
                        if (statusButton) {
                            statusButton.innerText = "Update";
                            statusButton.classList.remove('bg-blue-600');
                            statusButton.classList.add('bg-yellow-300');
                        }


                    } else {
                        const serialInput = document.getElementById('selectedSerialNumber_' + itemId);
                        serialInput.value = '';
                        serialInput.classList.add('border-red-500'); // highlight as error
                        alert('Error: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while updating the item.');
                });
        }
    </script>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php foreach($items as $item): ?>
        toggleIARInputs(<?= $item->pk_dcp_batch_items_id ?>);
        toggleITRInputs(<?= $item->pk_dcp_batch_items_id ?>);
        <?php endforeach; ?>
    });

    function toggleIARInputs(id) {
        var iarValue = document.getElementById('iar_value_' + id).value;
        var refCode = document.getElementById('iar_ref_code_' + id);
        var date = document.getElementById('iar_date_' + id);
        if (iarValue !== 'with IAR') {
            refCode.disabled = true;
            date.disabled = true;
        } else {
            refCode.disabled = false;
            date.disabled = false;
        }
    }



    document.addEventListener('DOMContentLoaded', function() {
        // Generate an array of item IDs using Blade/PHP and pass to JS
        const itemIds = <?php json_encode($items->pluck('pk_dcp_batch_items_id')); ?>;
        itemIds.forEach(function(id) {
            toggleIARInputs(id);
            toggleITRInputs(id);
        });
    });
</script>
<script src="//unpkg.com/alpinejs" defer></script>
