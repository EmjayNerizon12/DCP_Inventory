@extends('layout.SchoolSideLayout')
<title>@yield('title', 'DCP Batch')</title>

@section('content')
    <div class="p-6">


        <div class="flex justify-start  mb-2  space-x-2">
            <div class="md:flex hidden justify-center items-start">
                <div
                    class="h-16 w-16 hidden bg-white p-3 border border-gray-300 shadow-lg rounded-full flex items-center justify-center">
                    <div class="text-white bg-blue-600 p-2 rounded-full">
                        <svg class="w-10 h-10" fill="currentColor" version="1.1" id="Capa_1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            viewBox="0 0 433.117 433.117" xml:space="preserve">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <g>
                                    <g>
                                        <path
                                            d="M206.245,281.771c-1.422-0.481-2.989-0.004-3.902,1.188l-25.484,33.292c-1.49,1.943-3.846,3.104-6.302,3.104 c-1.382,0-2.739-0.358-3.934-1.045L49.856,251.671c-1.083-0.617-2.414-0.613-3.493,0.014c-1.078,0.627-1.742,1.779-1.742,3.027 v51.977c0,1.25,0.666,2.404,1.747,3.029l157,90.834c0.543,0.312,1.147,0.471,1.753,0.471c0.604,0,1.208-0.156,1.749-0.469 c1.084-0.625,1.751-1.781,1.751-3.031V285.085C208.622,283.585,207.665,282.251,206.245,281.771z">
                                        </path>
                                        <path
                                            d="M386.75,251.685c-1.077-0.625-2.408-0.631-3.492-0.014l-116.776,66.646c-1.186,0.679-2.54,1.037-3.922,1.037 c-2.458,0-4.814-1.157-6.301-3.1l-25.486-33.297c-0.913-1.191-2.482-1.67-3.902-1.188c-1.421,0.479-2.377,1.813-2.377,3.313 v112.438c0,1.25,0.667,2.406,1.751,3.031c0.541,0.312,1.146,0.469,1.749,0.469c0.605,0,1.21-0.158,1.753-0.471l157-90.834 c1.081-0.625,1.747-1.779,1.747-3.029v-51.978C388.493,253.464,387.829,252.312,386.75,251.685z">
                                        </path>
                                        <path
                                            d="M433.07,109.572c-0.188-1.134-0.921-2.104-1.96-2.595L273.064,32.428c-1.266-0.596-2.766-0.383-3.812,0.545L224.08,72.946 l-5.884-3.121c-1.026-0.545-2.256-0.545-3.282,0l-5.882,3.123l-45.163-39.975c-1.048-0.927-2.548-1.14-3.813-0.545L2.008,106.977 c-1.039,0.49-1.772,1.461-1.96,2.595c-0.188,1.134,0.194,2.288,1.021,3.087l47.161,45.59l-7.429,3.945 c-0.589,0.313-1.076,0.787-1.404,1.367l-25.615,45.236c-0.95,1.678-0.364,3.809,1.311,4.764l150.726,86.023 c1.521,0.869,3.448,0.48,4.514-0.91l31.849-41.598c0.62-0.811,0.856-1.85,0.646-2.848c-0.209-0.998-0.843-1.855-1.736-2.346 L51.466,169.45l159.393-84.578l0.003,103.995l-39.13,22.674c-1.092,0.633-1.759,1.805-1.745,3.066 c0.014,1.261,0.705,2.418,1.811,3.028l43.069,23.729c1.052,0.579,2.326,0.579,3.378,0l43.072-23.729 c1.104-0.609,1.797-1.767,1.811-3.03c0.015-1.262-0.652-2.432-1.744-3.064l-39.13-22.674l0.001-103.996l159.394,84.578 l-149.623,82.434c-0.895,0.49-1.527,1.348-1.736,2.346c-0.21,0.998,0.026,2.037,0.646,2.849l31.85,41.599 c0.685,0.891,1.724,1.37,2.781,1.37c0.591,0,1.188-0.147,1.732-0.461l150.726-86.023c1.675-0.955,2.261-3.086,1.312-4.764 l-25.622-45.239c-0.328-0.58-0.814-1.053-1.402-1.365l-7.421-3.945l47.159-45.59C432.875,111.859,433.257,110.705,433.07,109.572z ">
                                        </path>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                </div>
            </div>
            <div>
                <div class="page-title">
                    Batch: {{ $batchName }}
                </div>
                <div class="page-subtitle"> Date Delivered: {{ $batchDeliveryDate ?? 'N/A' }}
                </div>
            </div>



        </div>
        {{-- <h2 class="text-2xl font-bold text-blue-700">Status</h2> --}}
        <a href="{{ route('school.dcp_batch') }}"
            class="inline-flex  items-center text-blue-600 text-md font-semibold hover:underline  ">

            <div
                class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                <button class="  btn-submit  p-1 rounded-full">
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
        </a>
        <div>
            <label for="" class="form-label text-blue-600">Search Product</label>
            <div class="flex justify-start gap-2">

                <input type="text"
                    class="border border-gray-300 rounded-md   px-3 py-1 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500   w-base"
                    id="searchTerm">
                <button type="button" class="btn-submit px-4 py-1 rounded-md" id="search"
                    onclick="searchProduct()">Search</button>
            </div>
        </div>
        <div class="spinner-container my-4" id="spinner-container">
            <div class="spinner-lg"></div>
        </div>
        <div class="overflow-x-auto thin-scroll max-h-96 mt-4 rounded-sm shadow-md hidden" id="tableOverlay">
            <div id="tableContainer"></div>
        </div>
        <script>
            const tableOverlay = document.getElementById('tableOverlay');
            const spinnerContainer = document.getElementById('spinner-container');

            function renderItemsTable(items) {
                console.log(items);
                const container = document.getElementById('tableContainer');
                container.innerHTML = '';
                // Create table
                const table = document.createElement('table');
                table.className = 'w-full bg-white border-collapse tracking-wider ';

                // Create thead
                const thead = document.createElement('thead');
                thead.className = 'bg-gray-200 border border-gray-500';
                thead.innerHTML = `
                <tr>

                    <td class="top-header" colspan="9"> Product List 
                        </td>
                    </tr>
                    <tr>
                        <td class="sub-header">No.</td>
                        <td class="sub-header">Item Code</td>
                        <td class="sub-header">Item</td>
                        <td class="sub-header">Current Condition</td>
                        <td class="sub-header">Brand</td>
                        <td class="sub-header">Serial</td>
                        <td class="sub-header">Functional</td>
                        <td class="sub-header">Recipient</td>
                        <td class="sub-header">Warranty</td>
                    </tr>
                `;
                table.appendChild(thead);

                // Create tbody
                const tbody = document.createElement('tbody');

                items.forEach((item, index) => {
                    // Compute dynamic values
                    const currentCondition = item.dcp_item_current_condition?.dcp_current_condition?.name ?? 'N/A';
                    const functional = item.item_status == 1 ? 'Functional' : 'Not Functional';
                    const warrantyStatus = item.dcp_item_warranties?.status?.name ?? 'N/A';
                    const warranty_status_id = item.dcp_item_warranties?.warranty_status_id ?? null;

                    const recipientBtnClass = item.dcp_assigned_users != null ? 'btn-update' : 'btn-submit';
                    const recipientBtnText = item.dcp_assigned_users != null ? 'Edit Recipient' : 'Add Recipient';

                    const warrantyBtnClass = warranty_status_id == 1 ? 'btn-green' : 'btn-delete';

                    const tr = document.createElement('tr');

                    tr.innerHTML = `
                        <td class="td-cell text-center">${index + 1}</td>
                        <td class="td-cell">${item.generated_code ?? 'N/A'}</td>
                        <td class="td-cell">${item.dcp_item_type?.name ?? 'N/A'}</td>
                        <td class="td-cell">${currentCondition}</td>
                        <td class="td-cell">${item.brand ?? 'N/A'}</td>
                        <td class="td-cell">${item.serial_number ?? 'N/A'}</td>
                        <td class="td-cell">${functional}</td>
                        <td class="td-cell text-center">
                            <div class="flex justify-start my-2">
                                <div class="h-10 w-auto bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">
                                    <button 
                                        title="Show Recipient Modal" 
                                        type="button"
                                        onclick='openUserRecipientModal({
                                            pk_dcp_batch_items_id: "${item.pk_dcp_batch_items_id}",
                                            assigned_user_type_id: "${item.type_value_item ?? ''}",
                                            assigned_user_name: "${item.name_value_item ?? ''}",
                                            assigned_user_location_id: "${item.location_value_item ?? ''}",
                                            isAssigned: ${ item.dcp_assigned_users != null }
                                        })'
                                        class="whitespace-nowrap ${recipientBtnClass} h-8 py-1 px-4 rounded-full">
                                        ${recipientBtnText}
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="td-cell text-center">
                            <a href="/School/dcp-batch/${item.pk_dcp_batch_items_id}/warranty">
                                <div class="flex justify-start my-2">
                                    <div class="h-10 w-auto bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">
                                        <button 
                                            title="Show Warranty" 
                                            type="button"
                                          
                                            class="whitespace-nowrap ${warrantyBtnClass} h-8 py-1 px-4 rounded-full">
                                            ${warrantyStatus}
                                        </button>
                                    </div>
                                </div>
                            </a>
                        </td>
                    `;

                    tbody.appendChild(tr);
                });

                table.appendChild(tbody);

                // Clear container and append table
                container.innerHTML = '';
                container.appendChild(table);
            }
            const batchId = "{{ $batchId }}";
            const token = localStorage.getItem('token');
            // Render table
            async function searchProduct() {
                console.log(token);
                const searchTerm = document.getElementById('searchTerm').value;
                const searchButton = document.getElementById('search');
                tableOverlay.classList.add('hidden');
                spinnerContainer.classList.remove('hidden');
                try {
                    const response = await fetch(`/api/School/dcpBatchItem/search/${batchId}/${searchTerm}`, {
                        method: 'GET',
                        headers: {
                            'Authorization': `Bearer ${token}`,
                            'Accept': 'application/json'
                        }
                    });
                    const res = await response.json();
                    await renderItemsTable(res.data);
                    tableOverlay.classList.remove('hidden');
                    spinnerContainer.classList.add('hidden');
                } catch (error) {
                    console.error();
                }

            }
            searchProduct();
        </script>
        <!-- User Recipient Modal -->
        @include('SchoolSide.DCPBatch.partials.Status._modalUserRecipient')
    </div>
    @include('SchoolSide.DCPBatch.partials.Status._script')
@endsection
