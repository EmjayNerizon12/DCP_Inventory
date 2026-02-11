@extends('layout.SchoolSideLayout')

@section('title', 'DCP Inventory')

@section('content')
    <div class="max-w-full mx-5 bg-white rounded shadow p-6 px-5  mt-8" style="border:1px solid #ccc">
        <div class="flex md:flex-row flex-col justify-between   mb-4  md:space-x-4">
            <div>

                <h1 class="text-2xl font-bold tracking-wide text-blue-700 ">
                    DCP Inventory
                </h1>
                <p class="mb-2 tracking-wide">Below is a sample list of DCP equipment assigned to your school.</p>
            </div>

            <div class="md:flex hidden justify-center items-start">
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
        </div>
        <div class="flex md:flex-row flex-col">
            <div class="w-full">

                <input type="text" id="searchBatchItem" placeholder="Search for items..."
                    class="border border-gray-300 rounded px-4 py-2 mb-4 md:w-1/3 w-full ">
            </div>
            <div class="flex  flex-row   md:justify-center justify-start items-center gap-2">
                <div>
                    <a class="bg-blue-200 whitespace-nowrap flex items-center tracking-wider font-medium gap-2 text-gray-800 px-4 py-1  mb-2 rounded hover:bg-blue-600  hover:text-white border border-gray-800"
                        href="{{ url('School/items-condition/0') }}">


                        Product Condition
                    </a>
                </div>

            </div>

        </div>


        <div class="overflow-x-auto   h-96  rounded-sm   shadow-md ">

            <table class="min-w-full w-full md:w-full bg-white    ">
                <thead class="text-left bg-gray-100 border border-gray-300 ">
                    <tr>
                        <th class="tracking-wider  whitespace-nowrap    py-2 px-2 font-semibold text-gray-800 text-center">
                            Product Code
                        </th>
                        {{-- <th class=" tracking-wider px-4 py-2 font-semibold border-b border-gray-500 text-gray-800 ">Warranty
                        </th> --}}
                        <th class="tracking-wider  whitespace-nowrap    py-2 px-2 font-semibold text-gray-800 text-center">
                            Batch Label</th>

                        <th class=" tracking-wider  whitespace-nowrap    py-2 px-2 font-semibold text-gray-800 text-center">
                            Product
                        </th>
                        <th class=" tracking-wider  whitespace-nowrap    py-2 px-2 font-semibold text-gray-800 text-center">
                            Brand
                        </th>
                        <th class="tracking-wider  whitespace-nowrap    py-2 px-2 font-semibold text-gray-800 text-center">
                            Other Details</th>
                    </tr>
                </thead>
                <tbody class="tracking-wide" id="batchItemsTableBody">
                    @foreach ($batch_items as $batch_item)
                        <tr>
                            <td class="px-4 py-2 border border-gray-300">
                                {{ $batch_item->generated_code }}
                            </td>
                            {{-- <td class="px-4 py-2 w-fit   border border-gray-300">

                                <a href="{{ route('school.dcp_item_warranty', $batch_item->pk_dcp_batch_items_id) }}"
                                    class="  bg-green-200 text-black rounded  whitespace-nowrap  border border-gray-800 px-2 py-1   hover:bg-green-600 hover:text-white    transition-all duration-200">
                                    Show Warranty
                                </a>
                            </td> --}}
                            <td class="px-4 py-2  md:w-fit border border-gray-300">{{ $batch_item->batch_label }}</td>
                            <td class="px-4 py-2 border border-gray-300">
                                @php
                                    $item_name = \App\Models\DCPItemTypes::firstWhere(
                                        'pk_dcp_item_types_id',
                                        $batch_item->item_type_id,
                                    );
                                @endphp
                                {{ $item_name->name }}</td>
                            <td class="px-4 py-2 border border-gray-300">
                                @php
                                    $brand_name = \App\Models\DCPBatchItemBrand::where(
                                        'pk_dcp_batch_item_brands_id',
                                        $batch_item->brand,
                                    )->value('brand_name');

                                @endphp
                                {{ $brand_name ?? 'N/A' }}
                            </td>
                            <td class="px-4 py-2 w-fit   border border-gray-300">
                                <a href="{{ route('school.dcp_inventory.items', $batch_item->generated_code) }}"
                                    class="  text-md font-normal bg-blue-600 whitespace-nowrap text-white rounded shadow hover:bg-blue-700 tracking-wider font-medium px-2 py-1   transition-all duration-200">
                                    Show More
                                </a>

                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let delayTimer;
        $('#searchBatchItem').on('keyup', function() {
            clearTimeout(delayTimer);
            const keyword = $(this).val();

            delayTimer = setTimeout(() => {
                $.ajax({
                    url: '/School/batch-items/search',
                    type: 'GET',
                    data: {
                        query: keyword
                    },
                    success: function(data) {
                        let rows = '';
                        if (data.length > 0) {
                            data.forEach(item => {
                                rows += `                                    <tr>
                                <td class="px-4 py-2 border border-gray-300">${item.generated_code}</td>
                                <td class="px-4 py-2 md:w-fit border border-gray-300">${item.batch_label}</td>
                                <td class="px-4 py-2 border border-gray-300">${item.item_name}</td>
                                <td class="px-4 py-2 border border-gray-300">${item.the_brand ?? ""}</td>
                                <td class="px-4 py-2 w-fit border border-gray-300">
                                    <a href="/School/DCPInventory/${item.generated_code}" 
                                    class="  text-md font-normal whitespace-nowrap bg-blue-600  text-white rounded shadow hover:bg-blue-700 tracking-wider font-medium px-2 py-1 transition-all duration-200">
                                    Show More
                                    </a>
                                </td>
                            </tr>              `;
                            });
                        } else {
                            rows =
                                `<tr><td colspan="6" class="text-center py-4 text-gray-500">No results found.</td></tr>`;
                        }

                        $('#batchItemsTableBody').html(rows);
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            }, 300); // delay of 300ms
        });
    </script>
@endsection
