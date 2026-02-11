@extends('layout.SchoolSideLayout')
<title>
    @yield('title', 'DCP Inventory')</title>

@section('content')
    <div class="md:p-6 p-2">
        <div class="mb-4">
            <div class="page-title"> DCP Product </div>
            <div class="page-subtitle">{{ $item->generated_code }}
            </div>
        </div>
        @include('SchoolSide.components.print')
        <div class="mb-4 flex justify-start">


            <div
                class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                <button onclick="window.history.back()" class="  btn-submit  p-1 rounded-full">
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


            <div
                class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                <button class="  p-1 rounded-full theme-button" onclick="window.print()">
                    <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                        </g>
                        <g id="SVGRepo_iconCarrier">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d=" M17 7H7V6h10v1zm0 12H7v-6h10v6zm2-12V3H5v4H1v8.996C1 17.103 1.897 18 3.004
                                                                                                        18H5v3h14v-3h1.996A2.004 2.004 0 0 0 23 15.996V7h-4z"
                                fill="currentColor">
                            </path>
                        </g>
                    </svg>
                </button>
            </div>
        </div>

        <div class="font-medium tracking-wider overflow-x-auto md:shadow-none shadow-md " id="printableArea">
            <div id="print-header" style="display:none;" class="w-full flex flex-col justify-center items-center mb-4">

                <img class="h-24 w-24 object-cover rounded-full border-2 border-gray-300"
                    src="{{ Auth::guard('school')->user()->school->image_path ? asset('school-logo/' . Auth::guard('school')->user()->school->image_path) : asset('icon/logo.png') }}"
                    alt="">
                <div class="text-4xl font-bold text-gray-700">{{ Auth::guard('school')->user()->school->SchoolName }}
                </div>
                <div class="text-md text-gray-500">School Report - Generated on: <span id="current-time-date"></span></div>
            </div>
            <table class="w-full">
                <tbody>
                    <tr>
                        <td class="td-cell top-header" colspan="4">SCHOOL INFORMATION</td>
                    </tr>
                    <tr>
                        <td class="td-cell sub-header">School Name</td>
                        <td colspan="3" class="td-cell"> {{ $item->dcpBatch?->school?->SchoolID ?? 'N/A' }}
                            - {{ $item->dcpBatch?->school?->SchoolName ?? 'No School Found' }}

                        </td>
                    </tr>
                    <tr>
                        <td class="td-cell sub-header">School Level</td>
                        <td colspan="3" class="td-cell">{{ $item->dcpBatch?->school?->SchoolLevel ?? 'N/A' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="td-cell top-header" colspan="4">DCP PRODUCT INFORMATION</td>
                    </tr>
                    <tr>
                        <td class="td-cell sub-header">Product DCP Code</td>
                        <td colspan="3" class="td-cell">{{ $item->generated_code }}</td>
                    </tr>
                    <tr>
                        <td class="td-cell sub-header">Product Type</td>
                        <td colspan="3" class="td-cell">{{ $item->dcpItemType->name }}</td>
                    </tr>
                    <tr>
                        <td class="td-cell sub-header">Serial Number</td>
                        <td colspan="3" class="td-cell">{{ $item->serial_number ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="td-cell sub-header">Product Current Condition</td>
                        <td colspan="3" class="td-cell">
                            {{ $item->dcpItemCurrentCondition?->dcpCurrentCondition?->name ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="td-cell sub-header">DCP Batch</td>
                        <td colspan="3" class="td-cell">{{ $item->dcpBatch?->batch_label ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="td-cell sub-header">Delivery Date</td>
                        <td colspan="3" class="td-cell">
                            {{ $item->dcpBatch?->delivery_date ? \Carbon\Carbon::parse($item->dcpBatch?->delivery_date)->format('M d, Y') : '' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="td-cell sub-header">Quantity</td>
                        <td colspan="3" class="td-cell">{{ $item->quantity ?? '' }}</td>
                    </tr>

                    <tr>
                        <td class="td-cell sub-header">Unit Price</td>
                        <td colspan="3" class="td-cell">{{ $item->unit_price ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="td-cell sub-header">Unit Type</td>
                        <td colspan="3" class="td-cell">{{ $item->unit ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="td-cell sub-header">Brand</td>
                        <td colspan="3" class="td-cell">{{ $item->brand_details?->brand_name ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="td-cell top-header" colspan="4">PRODUCT DESIGNATION</td>
                    </tr>
                    <tr>
                        <td class="td-cell sub-header">Assigned User</td>
                        <td colspan="3" class="td-cell">{{ $item->dcpAssignedUsers?->dcpAssignedType->name ?? 'N/A' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="td-cell sub-header">User Type</td>
                        <td colspan="3" class="td-cell">{{ $item->dcpAssignedUsers?->assigned_user_name ?? 'N/A' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="td-cell sub-header">Date Assigned</td>
                        <td colspan="3" class="td-cell">
                            {{ $item->dcpAssignedUsers?->date_assigned ? \Carbon\Carbon::parse($item->dcpAssignedUsers?->date_assigned)->format('M d, Y') : 'N/A' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="td-cell sub-header">Location of the Item</td>
                        <td colspan="3" class="td-cell">
                            {{ $item->dcpBatchItemLocation?->dcpAssignedLocation->name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="td-cell top-header" colspan="4">FILES ATTACHED</td>

                    </tr>
                    <tr>
                        <td rowspan="4" class="td-cell sub-header">Inspection and Acceptance Report</td>
                        <td class="td-cell"><b>Code:</b> {{ $item->iar_ref_code ?? 'N/A' }}</td>
                        <td rowspan="4" class="td-cell sub-header">Inventory Transfer Report</td>
                        <td class="td-cell"><b>Code:</b> {{ $item->itr_ref_code ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="td-cell"><b>Status:</b> {{ $item->iar_value ?? 'N/A' }}</td>
                        <td class="td-cell"><b>Status: </b>{{ $item->itr_value ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="td-cell"><b>Date:</b>
                            {{ $item->iar_date ? \Carbon\Carbon::parse($item->iar_date)->format('M d, Y') : 'N/A' }}</td>
                        <td class="td-cell"><b>Date:</b>
                            {{ $item->itr_date ? \Carbon\Carbon::parse($item->itr_date)->format('M d, Y') : 'N/A' }}</td>
                    </tr>
                    <tr>

                        <td class="td-cell font-bold">FILE ATTACHED:
                            @if ($item->iar_file)
                                <span class="text-blue-600 underline">
                                    <a href="{{ asset("certificates/iar/{$item->iar_file}") }}"
                                        target="_blank">{{ $item->iar_file }}</a>
                                </span>
                            @else
                                No File Attached
                            @endif
                        </td>
                        <td class="td-cell font-bold">FILE ATTACHED: @if ($item->itr_file)
                                <span class="text-blue-600 underline">

                                    <a href="{{ asset("certificates/itr/{$item->itr_file}") }}"
                                        target="_blank">{{ $item->itr_file }}</a>
                                </span>
                            @else
                                No File Attached
                            @endif
                        </td>
                    </tr>


                    <tr>
                        <td rowspan="2" class="td-cell sub-header">Training Acceptance Report</td>
                        <td class="td-cell"><b>Status: </b>{{ $item->training_acceptance_status ?? 'N/A' }}</td>
                        <td rowspan="2" class="td-cell sub-header">Delivery Receipt</td>
                        <td class="td-cell"><b>Status:</b> {{ $item->delivery_receipt_status ?? 'N/A' }}</td>
                    </tr>
                    <tr>

                        <td class="td-cell font-bold">File Attached:
                            @if ($item->training_acceptance_file)
                                <span class="text-blue-600 underline">
                                    <a href="{{ asset("certificates/training-acceptance/{$item->training_acceptance_file}") }}"
                                        target="_blank">{{ $item->training_acceptance_file }}</a>
                                </span>
                            @else
                                No File Attached
                            @endif
                        </td>
                        <td class="td-cell font-bold">File Attached: @if ($item->delivery_receipt_file)
                                <span class="text-blue-600 underline">

                                    <a href="{{ asset("certificates/delivery-receipt/{$item->delivery_receipt_file}") }}"
                                        target="_blank">{{ $item->delivery_receipt_file }}</a>
                                </span>
                            @else
                                No File Attached
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td rowspan="2" class="td-cell sub-header">Invoice Receipt</td>
                        <td class="td-cell"><b>Status: </b>{{ $item->invoice_receipt_status ?? 'N/A' }}</td>
                        <td rowspan="2" class="td-cell sub-header">Certificate of Completion</td>
                        <td class="td-cell"><b>Status:</b> {{ $item->coc_status ?? 'N/A' }}</td>
                    </tr>
                    <tr>

                        <td class="td-cell font-bold">File Attached:
                            @if ($item->invoice_receipt_file)
                                <span class="text-blue-600 underline">
                                    <a href="{{ asset("certificates/invoice-receipt/{$item->invoice_receipt_file}") }}"
                                        target="_blank">{{ $item->invoice_receipt_file }}</a>
                                </span>
                            @else
                                No File Attached
                            @endif
                        </td>
                        <td class="td-cell font-bold">File Attached: @if ($item->certificate_of_completion)
                                <span class="text-blue-600 underline">

                                    <a href="{{ asset("certificates/certificate-completion/{$item->certificate_of_completion}") }}"
                                        target="_blank">{{ $item->certificate_of_completion }}</a>
                                </span>
                            @else
                                No File Attached
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="td-cell top-header" colspan="4">PRODUCT WARRANTY</td>
                    </tr>
                    <tr>
                        <td class="td-cell sub-header">Warranty Start Date</td>
                        <td class="td-cell">
                            {{ $item->dcpItemWarranties?->warranty_start_date ? \Carbon\Carbon::parse($item->dcpItemWarranties?->warranty_start_date)->format('M d, Y') : 'N/A' }}
                        </td>
                        <td class="td-cell sub-header">Warranty End Date</td>
                        <td class="td-cell">
                            {{ $item->dcpItemWarranties?->warranty_end_date ? \Carbon\Carbon::parse($item->dcpItemWarranties?->warranty_end_date)->format('M d, Y') : 'N/A' }}
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="2" class="td-cell sub-header">Warranty Contract Duration</td>
                        <td class="td-cell"> {{ $item->dcpItemWarranties?->warranty_contract ?? 'N/A' }}</td>
                        <td rowspan="2" class="td-cell sub-header">Status</td>
                        <td class="td-cell"> {{ $item->dcpItemWarranties?->status?->name ?? 'N/A' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
