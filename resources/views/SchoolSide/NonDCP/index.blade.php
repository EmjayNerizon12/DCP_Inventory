@extends('layout.SchoolSideLayout')

<title>
    @yield('title', 'DCP Dashboard')</title>

@section('content')
    <div class="md:p-6 p-2 ">
        <div class="flex justify-start space-x-4">

            <div>

                <div class="page-title">Non DCP Items</div>
                <div class="page-subtitle">eg. Computer, Laptop, Smart TV - Unit
                    Price, Date
                    Acquired
                </div>

            </div>

        </div>
        <div class="flex justify-start my-2">

            <button title="Show Info Modal" type="button" onclick="openModal()" class="theme-button py-1 px-4 rounded">
                Add New Item
            </button>

        </div>
        <div class="overflow-x-auto">
            <table class="table-auto  border border-gray-800 w-full table-collapse">
                <thead>
                    <tr>
                        <td class="top-header" colspan="9">NON DCP ITEMS</td>
                    </tr>
                    <tr>
                        <th class="sub-header text-center">
                            No. </th>

                        <th class="sub-header text-center">
                            Item - Description </th>
                        <th class="sub-header text-center">
                            Unit - Price </th>
                        <th class="sub-header text-center">
                            Date Acquired </th>
                        <th class="sub-header text-center">
                            Functional </th>
                        <th class="sub-header text-center">
                            Fund Source </th>
                        <th class="sub-header text-center">
                            Item Holder - Location </th>
                        <th class="sub-header text-center">
                            Remarks</th>
                        <th class="sub-header text-center">
                            Action</th>

                    </tr>
                </thead>
                <tbody class="tracking-wider">

                    @forelse ($non_dcp as $index => $item)
                        <tr>
                            <td class="td-cell text-center">
                                {{ $index + 1 }}</td>
                            <td class="td-cell text-center">{{ $item->item_description }}
                            </td>
                            <td class="td-cell text-center">{{ $item->unit_price }}</td>

                            <td class="td-cell text-center">
                                {{ \Carbon\Carbon::parse($item->date_acquired)->format('F j, Y') }}
                            </td>



                            <td class="td-cell text-center">{{ $item->total_functional }}
                                /
                                {{ $item->total_item }}</td>
                            <td class="td-cell text-center">
                                {{ $item->fund_source->name ?? 'N/A' }}
                            </td>
                            <td class="td-cell text-center">
                                {{ $item->item_holder_and_location ?? 'N/A' }}</td>
                            <td class="td-cell text-center">{{ $item->remarks }}</td>
                            <td class="td-cell text-center">
                                <div class="flex flex-row gap-2 justify-center">


                                    <div
                                        class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                                        <button title="Edit ISP" class="btn-update p-1 rounded-full"
                                            onclick='editModal(
                                        {{ $item->pk_non_dcp_item_id }},
                                        @json($item->item_description),
                                        {{ $item->unit_price }},
                                        "{{ $item->date_acquired }}",
                                        {{ $item->total_functional }},
                                        {{ $item->total_item }},
                                        {{ $item->fund_source_id }},
                                        @json($item->item_holder_and_location),
                                        @json($item->remarks)
                                      )'>
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
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                        </path>
                                                    </g>
                                                </g>
                                            </svg>
                                        </button>
                                    </div>
                                    <div
                                        class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                                        <button type="button" title="Remove ISP"
                                            onclick="deleteItem({{ $item->pk_non_dcp_item_id }})"
                                            class="btn-delete p-1 rounded-full">
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
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4 text-gray-500">No Non DCP items found for your
                                school.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @include('SchoolSide.NonDCP.partials._modalAdd')
    @include('SchoolSide.NonDCP.partials._modalEdit')
    @include('SchoolSide.NonDCP.partials._script')
@endsection
