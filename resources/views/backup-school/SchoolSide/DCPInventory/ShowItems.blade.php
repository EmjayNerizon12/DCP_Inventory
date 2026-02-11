@extends('layout.SchoolSideLayout')
<title>@yield('title', 'DCP Inventory')</title>

@section('content')
    <div class="mx-5 my-5 px-5 max-w-full mx-auto">
        <a href="{{ route('school.dcp_inventory') }}"
            class="inline-flex  items-center text-blue-600 text-md font-semibold hover:underline mb-2">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            DCP Inventory
        </a>
        {{-- <div class="bg-white border border-gray-300 rounded-sm shadow-sm p-6 mb-8">
            @php
                $item_condition = collect();
                foreach ($items as $key => $item) {
                    $item_add = App\Models\DCPItemCondition::where(
                        'dcp_batch_item_id',
                        $item->pk_dcp_batch_items_id,
                    )->first();
                    $item_condition->push($item_add);
                }

            @endphp
            @foreach ($item_condition as $item)
                <table>
                    <thead>
                        <th>CONDITION</th>
                        <th>batch item id</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $item->current_condition_id }}</td>
                            <td>{{ $item->dcp_batch_item_id }}</td>
                        </tr>
                    </tbody>
                </table>
            @endforeach

        </div> --}}
        @foreach ($items as $item)
            @php
                $batch = \App\Models\DCPBatch::where('pk_dcp_batches_id', $item->dcp_batch_id)->first();
                $batchName = $batch ? $batch->batch_label : 'N/A';
                $batchDeliveryDate = $batch ? $batch->delivery_date : 'N/A';

                // File paths
                $iarPath = $item->iar_file ? asset("certificates/iar/{$item->iar_file}") : null;
                $itrPath = $item->itr_file ? asset("certificates/itr/{$item->itr_file}") : null;
                $cocPath = $item->certificate_of_completion
                    ? asset("certificates/certificate-completion/{$item->certificate_of_completion}")
                    : null;
                $trainingPath = $item->training_acceptance_file
                    ? asset("certificates/training-acceptance/{$item->training_acceptance_file}")
                    : null;
                $deliveryPath = $item->delivery_receipt_file
                    ? asset("certificates/delivery-receipt/{$item->delivery_receipt_file}")
                    : null;
                $invoicePath = $item->invoice_receipt_file
                    ? asset("certificates/invoice-receipt/{$item->invoice_receipt_file}")
                    : null;
            @endphp

            <div class="bg-white border border-gray-300 rounded-sm shadow-sm p-6 mb-8">
                <div class="border-b border-gray-200 pb-4 mb-6 flex md:flex-row flex-col justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800"> DCP Item </h2>
                        <p class="text-lg text-gray-600 mt-1"> <span
                                class=" text-gray-800 tracking-wider font-semibold text-xl">{{ $item->generated_code }}</span>
                        </p>
                    </div>
                    @php
                        $bg_color = '';

                        if (isset($item->dcpItemCurrentCondition->dcpCurrentCondition)) {
                            $condition_id =
                                $item->dcpItemCurrentCondition->dcpCurrentCondition->pk_dcp_current_conditions_id;

                            if ($condition_id == 1) {
                                $bg_color = 'bg-green-200';
                            } elseif ($condition_id == 2) {
                                $bg_color = 'bg-yellow-200';
                            } elseif ($condition_id == 3) {
                                $bg_color = 'bg-blue-200';
                            } elseif ($condition_id == 4) {
                                $bg_color = 'bg-red-200';
                            } elseif ($condition_id == 5) {
                                $bg_color = 'bg-indigo-200';
                            } elseif ($condition_id == 7) {
                                $bg_color = 'bg-gray-200';
                            } else {
                                $bg_color = 'bg-gray-50';
                            }
                        } else {
                            $bg_color = 'bg-white';
                        }
                    @endphp

                    <div>
                        Item Current Status
                        <div
                            class="font-semibold text-center text-gray-700 px-4 py-1 text-md border border-gray-800 {{ $bg_color }}">
                            {{ $item->dcpItemCurrentCondition->dcpCurrentCondition->name ?? 'N/A' }}

                        </div>
                    </div>

                </div>
                <div class=" col-span-2 md:col-span-1  flex   gap-2">

                </div>


                <div class="grid  grid-cols-2 gap-y-4 text-lg text-gray-800">
                    <div class="col-span-2 md:col-span-1  flex gap-2">
                        <div
                            class="flex  md:flex-row flex-col  md:justify-center justify-start md:items-center items-start gap-2">

                            <div class=" bg-gray-100 px-2 py-1   border border-gray-800"><b>Batch:</b> {{ $batchName }}
                            </div>
                            <div class=" bg-gray-100 px-2 py-1   border border-gray-800"><b>Delivery Date:</b>
                                {{ $batchDeliveryDate }}
                            </div>

                        </div>

                    </div>
                    <div class="grid md:grid-cols-2 grid-cols-1 col-span-2 gap-2  ">
                        <div>
                            <div class="md:col-span-2 col-span-1 flex gap-2 mb-2 ">
                                <div class="bg-green-200 border-gray-800 p-1 px-2 border">
                                    Product Information

                                </div>

                            </div>

                            <div class="grid grid-cols-1 col-span-1 gap-2 border border-gray-500 p-4">
                                <div class=" col-span-3 md:col-span-1  flex gap-2">
                                    <span class="font-semibold text-gray-700">Item:</span>
                                    @php
                                        $itemType = \App\Models\DCPItemTypes::where(
                                            'pk_dcp_item_types_id',
                                            $item->item_type_id,
                                        )->first();
                                        $itemTypeName = $itemType->name;
                                    @endphp
                                    {{ $itemTypeName }}
                                </div>


                                <div class="col-span-3 md:col-span-1 ">
                                    <span class="font-semibold text-gray-700">Quantity:</span> {{ $item->quantity }}
                                </div>
                                <div class="col-span-3 md:col-span-1 ">
                                    <span class="font-semibold text-gray-700">Unit Price:</span>
                                    &#8369; {{ number_format($item->unit_price, 2) }}
                                </div>
                                <div class="col-span-3 md:col-span-1 "><span
                                        class="font-semibold text-gray-700">Unit:</span>
                                    {{ trim($item->unit) }}</div>
                                <div class="col-span-3 md:col-span-1 "><span
                                        class="font-semibold text-gray-700">Brand:</span>
                                    @php
                                        $brand_name = \App\Models\DCPBatchItemBrand::where(
                                            'pk_dcp_batch_item_brands_id',
                                            $item->brand,
                                        )->value('brand_name');

                                    @endphp
                                    {{ $brand_name ?? 'N/A' }}
                                </div>
                                <div class="col-span-3 md:col-span-1 "><span class="font-semibold text-gray-700">Serial
                                        Number:</span>
                                    {{ $item->serial_number ?? 'N/A' }}
                                </div>



                            </div>
                        </div>
                        <div>


                            <div class="md:col-span-2 col-span-1 flex gap-2 mb-2 ">
                                <div class="bg-blue-200 border-gray-800 p-1 px-2 border">
                                    More Information

                                </div>

                            </div>
                            <div class="grid grid-cols-1 col-span-1 gap-2 border border-gray-500 p-4">

                                <div class="col-span-3 md:col-span-1 "><span class="font-semibold text-gray-700">Assigned
                                        User
                                        for
                                        this
                                        Item:</span>
                                    {{ $user_type ?? 'N/A' }} - {{ $user_name ?? 'N/A' }}</div>
                                <div class="col-span-3 md:col-span-1 "><span class="font-semibold text-gray-700">Location of
                                        the
                                        Item:</span>
                                    {{ $item_location ?? 'N/A' }} </div>
                                <div class="col-span-3 md:col-span-1 "><span class="font-semibold text-gray-700">Date
                                        Assigned:</span>
                                    {{ $user_date_assigned ?? 'N/A' }} </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-2">Files and Reports </div>

                    <div class="   col-span-2 border grid md:grid-cols-2 grid-cols-1 flex gap-2   ">
                        {{-- IAR Section --}}
                        <div class="grid grid-cols-3 gap-1   text-lg text-gray-800  ">
                            <div
                                class="col-span-3 bg-green-200 p-2 border border-gray-400 text-center font-semibold text-gray-700">
                                Inspection and Acceptance Report
                            </div>
                            <div class="col-span-3 grid md:grid-cols-3 grid-cols-1 gap-1">
                                <div class="bg-green-200 p-2 border border-gray-400">
                                    <span class="font-semibold text-gray-700">Ref Code:</span>
                                    {{ $item->iar_ref_code ?? 'N/A' }}
                                </div>
                                <div class="bg-green-200 p-2 border border-gray-400">
                                    <span class="font-semibold text-gray-700">Date:</span>
                                    {{ $item->iar_date ?? 'N/A' }}
                                </div>

                                @if ($iarPath)
                                    <div class="bg-green-200 p-2 border border-gray-400 col-span-1">
                                        <span class="font-semibold text-gray-700">File:</span>
                                        <a href="{{ $iarPath }}" class="text-blue-600 underline ml-1"
                                            target="_blank">View
                                            IAR
                                            File</a>
                                    </div>
                                @else
                                    <div class="bg-green-200 p-2 border border-gray-400 col-span-1">
                                        <span class="font-semibold text-gray-700">File:</span>
                                        N/A
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- ITR Section --}}
                        <div class="grid grid-cols-3 gap-1  text-lg text-gray-800  ">
                            <div
                                class="col-span-3 bg-yellow-100 p-2 border border-gray-400 text-center font-semibold text-gray-700">
                                Inventory Transfer Report
                            </div>
                            <div class="col-span-3 grid md:grid-cols-3 grid-cols-1 gap-1">

                                <div class="bg-yellow-100 p-2 border border-gray-400">
                                    <span class="font-semibold text-gray-700">Ref Code:</span>
                                    {{ $item->itr_ref_code ?? 'N/A' }}
                                </div>
                                <div class="bg-yellow-100 p-2 border border-gray-400">
                                    <span class="font-semibold text-gray-700">Date:</span>
                                    {{ $item->itr_date ?? 'N/A' }}
                                </div>
                                @if ($itrPath)
                                    <div class="bg-yellow-100 p-2 border border-gray-400 col-span-1">
                                        <span class="font-semibold text-gray-700">File:</span>
                                        <a href="{{ $itrPath }}" class="text-blue-600 underline ml-1"
                                            target="_blank">View
                                            ITR
                                            File</a>
                                    </div>
                                @else
                                    <div class="bg-yellow-100 p-2 border border-gray-400 col-span-1">
                                        <span class="font-semibold text-gray-700">File:</span>
                                        N/A
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-span-2">Files Uploaded </div>
                    <div class="grid md:grid-cols-3 grid-cols-1 col-span-2 gap-1   text-lg text-gray-800">
                        @php
                            $hasAnyFile =
                                $iarPath || $itrPath || $cocPath || $trainingPath || $deliveryPath || $invoicePath;
                        @endphp

                        {{-- Files --}}
                        @if ($hasAnyFile)
                            @if ($iarPath)
                                <div class="col-span-2 md:col-span-1 p-2   bg-gray-200 border border-gray-800"><span
                                        class="font-semibold text-gray-700">IAR
                                        File:</span>
                                    <a href="{{ $iarPath }}" class="text-blue-600 underline ml-1"
                                        target="_blank">View</a>
                                </div>
                            @endif

                            @if ($itrPath)
                                <div class="col-span-2 md:col-span-1  p-2   bg-gray-200 border border-gray-800"><span
                                        class="font-semibold text-gray-700">ITR
                                        File:</span>
                                    <a href="{{ $itrPath }}" class="text-blue-600 underline ml-1"
                                        target="_blank">View</a>
                                </div>
                            @endif

                            @if ($cocPath)
                                <div class="col-span-2 md:col-span-1  p-2   bg-gray-200 border border-gray-800"><span
                                        class="font-semibold text-gray-700">Certificate of
                                        Completion:</span>
                                    <a href="{{ $cocPath }}" class="text-blue-600 underline ml-1"
                                        target="_blank">View</a>
                                </div>
                            @endif

                            @if ($trainingPath)
                                <div class="col-span-2 md:col-span-1  p-2   bg-gray-200 border border-gray-800"><span
                                        class="font-semibold text-gray-700">Training
                                        Acceptance:</span>
                                    <a href="{{ $trainingPath }}" class="text-blue-600 underline ml-1"
                                        target="_blank">View</a>
                                </div>
                            @endif

                            @if ($deliveryPath)
                                <div class="col-span-2 md:col-span-1  p-2   bg-gray-200 border border-gray-800"><span
                                        class="font-semibold text-gray-700">Delivery
                                        Receipt:</span>
                                    <a href="{{ $deliveryPath }}" class="text-blue-600 underline ml-1"
                                        target="_blank">View</a>
                                </div>
                            @endif

                            @if ($invoicePath)
                                <div class="col-span-2 md:col-span-1  p-2   bg-gray-200 border border-gray-800"><span
                                        class="font-semibold text-gray-700">Invoice
                                        Receipt:</span>
                                    <a href="{{ $invoicePath }}" class="text-blue-600 underline ml-1"
                                        target="_blank">View</a>
                                </div>
                            @endif
                        @else
                            <div class="col-span-2 md:col-span-1  p-2 bg-gray-200 border border-gray-800">
                                Training
                                Acceptance Report : N/A
                            </div>
                            <div class="col-span-2 md:col-span-1   p-2  bg-gray-200  border border-gray-800">
                                Delivery
                                Receipt: N/A
                            </div>
                            <div class="col-span-2 md:col-span-1   p-2   bg-gray-200 border border-gray-800">
                                Invoice
                                Receipt: N/A
                            </div>
                            <div class="col-span-2 md:col-span-1   p-2   bg-gray-200 border border-gray-800">

                                Certificate of Completion: N/A
                            </div>
                        @endif
                    </div>
                    <div class="col-span-2">Item Warranty <span
                            class="inline-block px-4 py-1 rounded-full text-sm font-bold text-white
                                {{ $item->dcpItemWarranties->first()->status->name === 'Expired' ? 'bg-red-500' : 'bg-green-600' }}">
                            {{ $item->dcpItemWarranties->first()->status->name ?? 'N/A' }}
                        </span></div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-1 text-md text-center mb-3  col-span-2">
                        <div class="bg-green-200 p-2 border border-gray-800">
                            <p class="text-gray-800 font-medium">Start Date</p>

                            <p class="text-gray-800">
                                {{ \Carbon\Carbon::parse($item->dcpItemWarranties->first()->warranty_start_date)->format('M d, Y') }}
                            </p>
                        </div>
                        <div class="bg-red-200 p-2 border border-gray-800">
                            <p class="text-gray-800 font-medium">End Date</p>
                            <p class="text-gray-800">
                                {{ \Carbon\Carbon::parse($item->dcpItemWarranties->first()->warranty_end_date)->format('M d, Y') }}
                            </p>
                        </div>
                        <div class="bg-blue-200 p-2 border border-gray-800">
                            <p class="text-gray-800 font-medium">Remaining</p>
                            @php

                                $endDate = \Carbon\Carbon::parse($item->dcpItemWarranties->first()->warranty_end_date);
                                $now = \Carbon\Carbon::now();
                                $diff = $now->diff($endDate);
                            @endphp

                            <p class="text-gray-800 font-normal text-lg">
                                {{ $diff->y }}years, {{ $diff->m }}months, {{ $diff->d }}days

                            </p>
                        </div>
                    </div>


                </div>
            </div>
        @endforeach
    </div>
@endsection
