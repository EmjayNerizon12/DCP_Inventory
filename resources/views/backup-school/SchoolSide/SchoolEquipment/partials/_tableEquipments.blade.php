@foreach ($school_equipments as $equipment)
    <div id="equipment-print-{{ $equipment->id }}">


        <table class="table w-full border-collapse">

            <tbody>

                <tr>
                    <td colspan="6" class="top-header">
                        <span class="uppercase">Equipment No.</span>
                        {{ $loop->iteration }}

                    </td>
                </tr>
                {{-- <tr>
                    <td class="sub-header ">Equipment No.</td>
                    <td colspan="5" class="td-cell  w-1/6">{{ $loop->iteration }}</td>

                </tr> --}}
                <tr>
                    <td colspan="6" class="secondary-header text-center ">
                        Basic Information</td>
                </tr>

                {{-- ROW 1 --}}
                <tr>
                    <td class="sub-header ">Property No.</td>
                    <td class="td-cell  w-1/6">{{ $equipment->property_number }}</td>

                    <td class="sub-header ">Previous Property No.
                    </td>
                    <td class="td-cell  w-1/6">{{ $equipment->old_property_number }}</td>

                    <td class="sub-header ">Serial No.</td>
                    <td class="td-cell  w-1/6">{{ $equipment->serial_number }}</td>
                </tr>

                {{-- ROW 2 --}}
                <tr>
                    <td class="sub-header ">Item</td>
                    <td class="td-cell  w-1/6">{{ $equipment->equipmentItem?->name }}</td>

                    <td class="sub-header ">Unit of Measure</td>
                    <td class="td-cell  w-1/6">{{ $equipment->unitOfMeasure?->name }}</td>

                    <td class="sub-header ">Manufacturer</td>
                    <td class="td-cell  w-1/6">{{ $equipment->manufacturer?->name }}</td>
                </tr>

                {{-- ROW 3 --}}
                <tr>
                    <td class="sub-header ">Model</td>
                    <td class="td-cell  w-1/6">{{ $equipment->model }}</td>

                    <td class="sub-header ">Specification</td>
                    <td class="td-cell  w-1/6">{{ $equipment->specifications }}</td>

                    <td class="sub-header ">Supplier / Distributor
                    </td>
                    <td class="td-cell  w-1/6">{{ $equipment->supplier_or_distributor }}</td>
                </tr>
                <tr>

                    <td class="sub-header ">Category</td>
                    <td class="td-cell  w-1/6">{{ $equipment->category?->name }}</td>

                    <td class="sub-header ">Classification</td>
                    <td class="td-cell  w-1/6">{{ $equipment->classification?->name }}</td>
                    <td class="sub-header ">Estimated Useful Life
                    </td>
                    <td class="td-cell  w-1/6">{{ $equipment->estimated_useful_life }}</td>
                </tr>
                <tr>
                    <td colspan="6" class="secondary-header text-center ">
                        DCP Batch</td>
                </tr>
                <tr>
                    <td class="sub-header ">DCP Batch </td>
                    <td colspan="3" class="td-cell  w-1/6">
                        {{ $equipment->dcp_batch_id ? $equipment->dcpBatch?->batch_label : 'This equipment is Non-DCP Equipment' }}

                    </td>
                    <td class="sub-header ">Non-DCP</td>
                    <td class="td-cell  w-1/6">{{ $equipment->non_dcp ? 'Yes' : 'No' }}</td>

                </tr>
                <tr>
                    <td class="sub-header ">DCP Package </td>
                    <td colspan="3" class="td-cell  w-1/6">

                        <div class="@if ($equipment->dcp_batch_id) block @else hidden @endif">


                            {{ $equipment->dcpBatch?->dcpPackageType?->name }}


                        </div>
                    </td>
                    <td class="border border-gray-600 bg-gray-100 px-3 py-2 w-1/6">



                        Package Year:

                    </td>
                    <td class="td-cell  w-1/6">

                        <div class="@if ($equipment->dcp_batch_id) block @else hidden @endif">


                            {{ $equipment->dcpBatch?->budget_year }}

                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="secondary-header text-center ">
                        Reference/Financial</td>
                </tr>

                {{-- ROW 4 --}}
                <tr>
                    {{-- <td class="sub-header ">DCP Batch </td>
                    <td class="td-cell  w-1/6">
                        {{ $equipment->dcp_batch_id ? $equipment->dcpBatch?->batch_label : 'Non DCP Equipment' }}

                        <div>
                            <span class="font-bold">Package Name:</span>
                            {{ $equipment->dcpBatch?->dcpPackageType?->name }}
                        </div>
                        <div>
                            <span class="font-bold">Package Year:</span>
                            {{ $equipment->dcpBatch?->budget_year }}
                        </div>
                    </td> --}}
                    <td class="sub-header ">PMP Reference No.</td>
                    <td class="td-cell  w-1/6">{{ $equipment->pmp_reference_no }}</td>
                    <td class="sub-header ">GL-SL Code</td>
                    <td class="td-cell  w-1/6">{{ $equipment->gl_sl_code }}</td>

                    <td class="sub-header ">UACS</td>
                    <td class="td-cell  w-1/6">{{ $equipment->uacs_code }}</td>
                </tr>

                <tr>
                    <td colspan="6" class="secondary-header text-center ">
                        Acquisition Details</td>
                </tr>
                {{-- ROW 6 --}}
                <tr>
                    <td class="sub-header ">Acquisition Cost</td>
                    <td class="td-cell  w-1/6 text-right">
                        {{ number_format($equipment->acquisition_cost, 2) }}</td>
                    <td class="sub-header ">Acquisition Date</td>
                    <td class="td-cell  w-1/6">
                        {{ optional($equipment->acquisition_date)->format('F j, Y') }}</td>
                    <td class="sub-header ">Mode of Acquistion
                    </td>
                    <td class="td-cell  w-1/6">{{ $equipment->modeOfAcquisition?->name }}</td>
                </tr>
                <tr>
                    <td class="sub-header ">Source of Acquistion
                    </td>
                    <td class="td-cell  w-1/6">{{ $equipment->sourceOfAcquisition?->name }}
                    </td>


                    <td class="sub-header ">Donor</td>
                    <td class="td-cell  w-1/6">{{ $equipment->donor }}</td>
                    <td rowspan="2" class="sub-header ">Source
                        of Fund
                    </td>
                    <td rowspan="2" class="td-cell  w-1/6">
                        {{ $equipment->sourceOfFund?->name }}
                    </td>

                </tr>

                {{-- ROW 7 --}}
                <tr>

                    <td class="sub-header ">Allotment Class</td>
                    <td class="td-cell  w-1/6">{{ $equipment->allotmentClass?->name }}</td>

                    <td class="sub-header ">Remarks</td>
                    <td colspan="1" class="td-cell  w-1/6">{{ $equipment->remarks }}</td>
                </tr>
                <tr>
                    <td colspan="6" class="secondary-header text-center ">
                        Supporting Documents</td>
                </tr>
                @forelse (\App\Models\SchoolEquipment\SchoolEquipmentDocument::where('school_equipment_id', $equipment->id)->get() as $document)
                    <tr>
                        <td class="sub-header ">Document Type</td>
                        <td class="td-cell  w-1/6">{{ $document->documentType?->name }}</td>
                        <td class="sub-header ">Document No.</td>
                        <td colspan="3" class="td-cell  w-1/6">
                            <div class="flex flex-row justify-between items-center">

                                {{ $document->document_number }}

                                <div class="flex flex-row gap-1 justify-center items-start">


                                    <div
                                        class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                                        <button title="Insert Document" type="button"
                                            onclick="openDocumentModal({{ $equipment->id }})"
                                            class="text-white bg-blue-600 hover:bg-blue-700 p-1 rounded-full">
                                            <svg class="w-8 h-8" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                                                fill="none">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                </g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path fill="currentColor" fill-rule="evenodd"
                                                        d="M9 17a1 1 0 102 0v-6h6a1 1 0 100-2h-6V3a1 1 0 10-2 0v6H3a1 1 0 000 2h6v6z">
                                                    </path>
                                                </g>
                                            </svg>
                                        </button>
                                    </div>

                                    <div
                                        class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                                        <button title="Edit Document" type="button"
                                            onclick="showDocumentEditModal({{ $document->id }}, {{ $document->document_type_id }}, '{{ $document->document_number }}')"
                                            class="btn-update p-1 rounded-full">
                                            <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                </g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <g id="Edit / Edit_Pencil_Line_02">
                                                        <path id="Vector"
                                                            d="M4 20.0001H20M4 20.0001V16.0001L14.8686 5.13146L14.8704 5.12976C15.2652 4.73488 15.463 4.53709 15.691 4.46301C15.8919 4.39775 16.1082 4.39775 16.3091 4.46301C16.5369 4.53704 16.7345 4.7346 17.1288 5.12892L18.8686 6.86872C19.2646 7.26474 19.4627 7.46284 19.5369 7.69117C19.6022 7.89201 19.6021 8.10835 19.5369 8.3092C19.4628 8.53736 19.265 8.73516 18.8695 9.13061L18.8686 9.13146L8 20.0001L4 20.0001Z"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                        </path>
                                                    </g>
                                                </g>
                                            </svg>
                                        </button>
                                    </div>
                                    <form action="{{ route('school-equipment-document.destroy', $document->id) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this document?');"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div
                                            class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                                            <button type="submit" title="Remove Document"
                                                class="text-white bg-red-600 hover:bg-red-700 p-1 rounded-full">
                                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <path
                                                            d="M5.755,20.283,4,8H20L18.245,20.283A2,2,0,0,1,16.265,22H7.735A2,2,0,0,1,5.755,20.283ZM21,4H16V3a1,1,0,0,0-1-1H9A1,1,0,0,0,8,3V4H3A1,1,0,0,0,3,6H21a1,1,0,0,0,0-2Z">
                                                        </path>
                                                    </g>
                                                </svg>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </td>
                    @empty
                    <tr>
                        <td colspan="6" class="border border-gray-600 text-center text-gray-500 px-10 py-3 italic">
                            <div class="flex flex-row justify-between items-center">

                                No Document Attached

                                <div class="flex flex-row gap-1 justify-center items-start">

                                    <div
                                        class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                                        <button title="Insert Supporting Document" type="button"
                                            onclick="openDocumentModal({{ $equipment->id }})"
                                            class="text-white bg-blue-600 hover:bg-blue-700 p-1 rounded-full">
                                            <svg class="w-8 h-8" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg" fill="none">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                </g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path fill="currentColor" fill-rule="evenodd"
                                                        d="M9 17a1 1 0 102 0v-6h6a1 1 0 100-2h-6V3a1 1 0 10-2 0v6H3a1 1 0 000 2h6v6z">
                                                    </path>
                                                </g>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforelse
                <tr>
                    <td colspan="6" class="secondary-header text-center ">
                        Equipment Accountability</td>
                </tr>
                @forelse (\App\Models\SchoolEquipment\SchoolEquipmentAccountabilty::where('school_equipment_id', $equipment->id)->get() as $accountable)
                    <tr>
                        <td class="sub-header ">Accountable Officer
                            (Employee)
                        </td>
                        <td class="td-cell  w-1/6">{{ $accountable->accountableEmployee?->fname }}
                            {{ $accountable->accountableEmployee?->mname }}
                            {{ $accountable->accountableEmployee?->lname }}
                            {{ $accountable->accountableEmployee?->suffix_name }}</td>
                        </td>
                        <td class="sub-header ">End User

                        </td>
                        <td class="td-cell  w-1/6">

                            @forelse ($accountable->endUser as $user)
                                {{ $user->fname }} {{ $user->mname }} {{ $user->lname }} {{ $user->suffix }}
                            @empty
                            @endforelse
                        </td>
                        <td class="sub-header ">Accountable Officer
                            (Employee)
                        </td>
                        <td class="td-cell  w-1/6">{{ $accountable->receiverType?->name }}
                        </td>
                        </td>
                    </tr>


                    <tr>
                        <td class="sub-header ">Date Assigned/Received
                            (Accountable Officer)
                        </td>
                        <td class="td-cell  w-1/6">
                            {{ \Carbon\Carbon::parse($accountable?->date_assigned_to_accountable_employee)->format('F j, Y') }}
                        </td>
                        </td>
                        <td class="sub-header ">Date
                            Assigned/Received (End User)

                        </td>
                        <td class="td-cell  w-1/6">

                            @forelse ($accountable->endUser as $user)
                                {{ \Carbon\Carbon::parse($user->date_assigned)->format('F j, Y') }}
                            @empty
                            @endforelse
                        </td>
                        <td class="sub-header ">Date Received
                            (Receiver)
                        </td>
                        <td class="td-cell  w-1/6">
                            {{ \Carbon\Carbon::parse($accountable->date_received)->format('F j, Y') }}
                        </td>
                        </td>
                    </tr>
                    <tr>
                        <td class="sub-header "> Transaction Type
                        </td>
                        <td colspan="5" class="td-cell  w-1/6">
                            {{ $accountable->transactionType?->name }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="border border-gray-600 text-center text-gray-500 py-3 italic">
                            No record found
                        </td>

                    </tr>
                @endforelse
                <tr>
                    <td colspan="6" class="secondary-header text-center ">
                        Equipment Status</td>
                </tr>
                @forelse (\App\Models\SchoolEquipment\SchoolEquipmentStatus::where('school_equipment_id', $equipment->id)->get() as $status)
                    <tr>
                        <td class="sub-header ">Start of Warranty
                        </td>
                        <td class="td-cell  w-1/6">
                            {{ \Carbon\Carbon::parse($status->start_warranty_date)->format('F j, Y') }}</td>
                        </td>
                        <td class="sub-header ">End of Warranty
                        </td>
                        <td class="td-cell  w-1/6">
                            {{ \Carbon\Carbon::parse($status->end_warranty_date)->format('F j, Y') }}</td>

                        <td class="sub-header ">Non Functional
                        </td>
                        <td class="td-cell  w-1/6">
                            {{ $status->non_functional == 1 ? 'Yes' : 'No' }}
                        </td>

                    </tr>
                    <tr>
                        <td class="sub-header ">Equipment Location
                        </td>
                        <td class="td-cell  w-1/6">
                            {{ $status->equipment_location }}
                        </td>
                        <td class="sub-header ">Equipment Condition
                        </td>
                        <td class="td-cell  w-1/6">
                            {{ $status->equipmentCondition?->name }}
                        </td>
                        <td class="sub-header ">Accountability
                            Disposition Status
                        </td>
                        <td class="td-cell  w-1/6">
                            {{ $status->dispositionStatus?->name }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="border border-gray-600 text-center text-gray-500 py-3 italic">
                            No record found
                        </td>

                    </tr>
                @endforelse
                <tr>
                    <td colspan="6" class="py-2" style="border:none !important">
                        <div class="flex flex-row gap-1 justify-end items-start">
                            <div
                                class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                                <button class="btn-update p-1 rounded-full"
                                    onclick="showEditModal(
                                    {{ $equipment->id }},
                                    '{{ $equipment->property_number }}',
                                    '{{ $equipment->old_property_number }}',
                                    '{{ $equipment->serial_number }}',
                                    '{{ $equipment->equipment_item_id }}',
                                    '{{ $equipment->unit_of_measure_id }}',
                                    '{{ $equipment->manufacturer_id }}',
                                    '{{ $equipment->model }}',
                                    '{{ $equipment->specifications }}',
                                    '{{ $equipment->supplier_or_distributor }}',
                                    '{{ $equipment->category_id }}',
                                    '{{ $equipment->classification_id }}',
                                    '{{ $equipment->non_dcp }}',
                                    '{{ $equipment->dcp_batch_id }}',
                                    '{{ $equipment->pmp_reference_no }}',
                                    '{{ $equipment->gl_sl_code }}',
                                    '{{ $equipment->uacs_code }}',
                                    '{{ $equipment->acquisition_cost }}',
                                    '{{ $equipment->acquisition_date }}',
                                    '{{ $equipment->mode_of_acquisition_id }}',
                                    '{{ $equipment->source_of_acquisition_id }}',
                                    '{{ $equipment->donor }}',
                                    '{{ $equipment->source_of_fund_id }}',
                                    '{{ $equipment->allotment_class_id }}',
                                    '{{ $equipment->remarks }}'
                                        )">
                                    <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <g id="Edit / Edit_Pencil_Line_02">
                                                <path id="Vector"
                                                    d="M4 20.0001H20M4 20.0001V16.0001L14.8686 5.13146L14.8704 5.12976C15.2652 4.73488 15.463 4.53709 15.691 4.46301C15.8919 4.39775 16.1082 4.39775 16.3091 4.46301C16.5369 4.53704 16.7345 4.7346 17.1288 5.12892L18.8686 6.86872C19.2646 7.26474 19.4627 7.46284 19.5369 7.69117C19.6022 7.89201 19.6021 8.10835 19.5369 8.3092C19.4628 8.53736 19.265 8.73516 18.8695 9.13061L18.8686 9.13146L8 20.0001L4 20.0001Z"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                </path>
                                            </g>
                                        </g>
                                    </svg>
                                </button>
                            </div>

                            <form action="{{ route('SchoolEquipment.destroy', $equipment->id) }}"
                                onsubmit="return confirm('Are you sure you want to delete this equipment?');"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <div
                                    class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                                    <button type="submit"
                                        class="text-white bg-red-600 hover:bg-red-700 p-1 rounded-full">
                                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path
                                                    d="M5.755,20.283,4,8H20L18.245,20.283A2,2,0,0,1,16.265,22H7.735A2,2,0,0,1,5.755,20.283ZM21,4H16V3a1,1,0,0,0-1-1H9A1,1,0,0,0,8,3V4H3A1,1,0,0,0,3,6H21a1,1,0,0,0,0-2Z">
                                                </path>
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                            </form>
                            <div
                                class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                                <button id="btnPerson-{{ $equipment->id }}" title="User Accountabiliy"
                                    onclick="showUserList({{ $equipment->id }})"
                                    class="text-white bg-blue-600 hover:bg-blue-700 p-1 rounded-full">
                                    <svg class="w-8 h-8" viewBox="-102.4 -102.4 1228.80 1228.80"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path fill="currentColor"
                                                d="M288 320a224 224 0 1 0 448 0 224 224 0 1 0-448 0zm544 608H160a32 32 0 0 1-32-32v-96a160 160 0 0 1 160-160h448a160 160 0 0 1 160 160v96a32 32 0 0 1-32 32z">
                                            </path>
                                        </g>
                                    </svg>
                                </button>

                            </div>
                            <div
                                class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                                <button class="theme-button p-1 rounded-full"
                                    onclick="printEquipment({{ $equipment->id }})">
                                    <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M17 7H7V6h10v1zm0 12H7v-6h10v6zm2-12V3H5v4H1v8.996C1 17.103 1.897 18 3.004 18H5v3h14v-3h1.996A2.004 2.004 0 0 0 23 15.996V7h-4z"
                                                fill="currentColor"></path>
                                        </g>
                                    </svg>
                                </button>
                            </div>
                            <div
                                class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                                <button id="btnStatus-{{ $equipment->id }}" title="Equipment Status"
                                    onclick="showStatusModal({{ $equipment->id }})"
                                    class="btn-cancel p-1 rounded-full">
                                    <svg fill="currentColor" class="w-8 h-8" viewBox="0 0 1000 1000"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path
                                                d="M500 70q-117 0-217 59-97 57-154 154-59 100-59 217t59 217q57 97 154 154 100 59 217 59t217-59q97-57 154-154 59-100 59-217t-59-217q-57-97-154-154-100-59-217-59zm0 108q79 0 148 36t114.5 99.5T819 455h-69q-12 0-25.5-6.5T704 432l-86-114q-7-10-17.5-10T583 318L417 540q-7 9-17.5 9t-17.5-9l-46-61q-7-10-20.5-17t-24.5-7H181q11-78 56.5-141.5T352 214t148-36zm0 644q-79 0-148-36t-114.5-99.5T181 545h69q12 0 25.5 7t20.5 16l86 115q7 9 17.5 9t17.5-9l166-222q7-10 17.5-10t17.5 10l46 61q7 9 20.5 16t24.5 7h110q-11 78-56.5 141.5T648 786t-148 36z">
                                            </path>
                                        </g>
                                    </svg>
                                </button>

                            </div>

                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endforeach
<script>
    var currentDate = new Date();
    var options = {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
    };
    var formattedDate = currentDate.toLocaleDateString(undefined, options);
    document.querySelectorAll('.current-time-date').forEach(el => {
        el.textContent = formattedDate;
    });
</script>
