@extends('layout.SchoolSideLayout')
<title>@yield('title', 'DCP Inventory')</title>

@section('content')
    <input type="hidden" id="school_id" value="{{ Auth::guard('school')->user()->school->pk_school_id }}">
    <div class="md:p-6 p-2 ">
        <div class="flex  flex-row  justify-start   mb-4  md:space-x-4">
            <div class=" flex hidden justify-center items-start">
                <div
                    class="h-16 w-16 bg-white p-3 border border-gray-300 shadow-lg rounded-full flex items-center justify-center">
                    <div class="text-white bg-blue-600 p-2 rounded-full">
                        <svg class="h-10 w-10" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            class="bi bi-box-seam">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z">
                                </path>
                            </g>
                        </svg>
                    </div>
                </div>
            </div>
            <div>
                <div class="page-title">

                    DCP School Product Inventory
                </div>

                <div class="page-subtitle">List of Products Acquired
                </div>
            </div>
        </div>
        <div class="flex md:flex-row flex-col justify-between items-center md:mb-0 mb-4 space-y-2">
            <div class="w-full flex flex-col  ">
                <label class="text-md text-gray-700 font-medium tracking-wider">Search Product</label>
                <div class="flex flex-row gap-2">

                    <input type="text" id="searchBatchItem" placeholder="Search for items..."
                        class="form-input max-w-sm">
                    <button type="button" id="btnSearch" onclick="searchBatchItems()"
                        class="theme-button w-auto">Search</button>
                </div>
            </div>

            <div class="flex justify-start md:w-auto w-full">
                <div
                    class="h-10 w-auto bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center md:justify-center justify-start">
                    <button title="Show Info Modal" type="button"
                        onclick="window.location.href='{{ url('School/items-condition/0') }}'"
                        class="btn-submit h-8 whitespace-nowrap py-1 px-4 rounded-full">
                        Product Condition
                    </button>
                </div>
            </div>
        </div>

        <div class="spinner-container" id="spinner-container">
            <div class="spinner-lg"></div>
        </div>
        <div id="table-container"
            class="overflow-x-auto hidden thin-scroll h-auto max-h-[70vh] rounded-sm shadow-[0_8px_30px_rgba(0,0,0,0.12)] border border-gray-200 ">
            <table class="min-w-full w-full md:w-full bg-white    ">
                <thead class="text-left  ">
                    <tr>
                        <td class="top-header" colspan="6">Product Inventory</td>
                    </tr>
                    <tr>
                        <th class="sub-header tracking-wider  ">
                            No.
                        </th>
                        <th class="sub-header tracking-wider  ">
                            Product Code
                        </th>
                        {{-- <th class=" tracking-wider px-4 py-2 font-semibold border-b border-gray-500 text-gray-800 ">Warranty
                        </th> --}}
                        <th class="sub-header tracking-wider  ">
                            Batch Label</th>

                        <th class=" sub-header tracking-wider  ">
                            Product
                        </th>
                        <th class=" sub-header tracking-wider  ">
                            Brand
                        </th>
                        <th class="sub-header tracking-wider                                      ">
                            Product Information</th>
                    </tr>
                </thead>
                <tbody class="tracking-wide" id="batchItemsTableBody">
                    @include('SchoolSide.DCPInventory.partials._itemTableBody')
                </tbody>
            </table>
        </div>
    </div>


    @include('SchoolSide.DCPInventory.partials.searchScript')
@endsection
