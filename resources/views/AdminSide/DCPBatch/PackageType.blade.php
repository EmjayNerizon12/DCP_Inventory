@extends('layout.Admin-Side')
<title>@yield('title', 'DCP Dashboard')</title>

@section('content')
    <style>
        button {
            letter-spacing: 0.05rem;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
    </style>
    <div id="create-modal-overlay"
        class="fixed inset-0 bg-black bg-opacity-40 flex items-center overflow-y-auto justify-center z-50 hidden">
        <!-- Modal Content -->
        <div id="create-form-section"
            class="bg-white shadow-xl rounded-lg overflow-hidden
             border border-gray-300 p-6 w-full max-w-4xl relative mx-5"
            style="max-height: 80vh; overflow-y: auto;">
            <button type="button" onclick="cancelCreate()"
                class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-xl font-bold">&times;</button>
            <form id="create-form" action="{{ route('store.package_type') }}" method="POST"> @csrf
                <h2 class="text-2xl font-bold  w-full text-center md:text-left"> DCP Package Details

                    <span class="bg-blue-600 text-white py-1 px-2 rounded-xl text-sm font-semibold">New</span>
                </h2>
                <div class="flex justify-center md:justify-start  ">

                </div>
                <div class=" flex flex-col md:flex-row gap-4  w-full">
                    <div class="w-full md:w-1/3">
                        <div class="mb-2">
                            <label for="code" class="block text-gray-700   font-semibold mb-2">DCP Package
                                Code</label>
                            <input type="text"
                                class="shadow appearance-none border border-gray-400 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="code" name="code" required>
                        </div>
                    </div>
                    <div class="w-full md:w-1/3">
                        <div>
                            <label for="name" class="block text-gray-700   font-semibold  mb-2">DCP Package
                                Name</label>
                            <input type="text"
                                class="shadow appearance-none border border-gray-400 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="name" name="name" required>
                        </div>
                    </div>

                    <div class="w-full md:w-1/3">
                    </div>
                </div>
                <div id="package-contents">
                    <h4 class="text-lg font-bold mb-2">DCP Package Contents</h4>







                    <div id="package-content-list">

                        <div class="package-content flex flex-col md:flex-row gap-4 mb-4 w-full">
                            <div class="w-full md:w-1/2">
                                <label for="item_type_id" class="block text-gray-700   font-semibold  mb-2 w-full">Product
                                </label>
                                <select name="item_type_id[]"
                                    class="w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
                                    required>
                                    <option value="">-- Select Product --</option>
                                    @foreach ($itemTypes as $itemType)
                                        <option value="{{ $itemType->pk_dcp_item_types_id }}">{{ $itemType->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @php
                                $brands = \App\Models\DCPBatchItemBrand::all();

                            @endphp
                            <div id="brand-options" class="hidden">
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->pk_dcp_batch_item_brands_id }}">{{ $brand->brand_name }}
                                    </option>
                                @endforeach
                            </div>
                            <div class="w-full md:w-1/3">
                                <label for="item_brand_id" class="block text-gray-700   font-semibold  mb-2 w-full">Brand
                                </label>

                                <select name="item_brand_id[]"
                                    class="w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
                                    required>
                                    <option value="">-- Select Brand --</option>

                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->pk_dcp_batch_item_brands_id }}">{{ $brand->brand_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-full md:w-1/3">
                                <label for="quantity"
                                    class="block text-gray-700    font-semibold  mb-2 w-full">Quantity</label>
                                <input type="number"
                                    class="w-full shadow appearance-none border border-gray-400 rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="quantity" name="quantity[]" required>
                            </div>
                            <div class="w-full md:w-1/3">
                                <label for="unit_price" class="block text-gray-700    font-semibold  mb-2 w-full">Unit
                                    Price</label>
                                <input type="number" step="0.01"
                                    class="w-full shadow appearance-none border border-gray-400 rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="unit_price" name="unit_price[]" required>


                            </div>
                            <div class="w-full md:w-1/3 flex items-end">
                                <button type="button"
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold  shadow-md py-1 px-2 rounded"
                                    id="add-package-content">Add More Item</button>
                            </div>
                        </div>

                    </div>
                </div>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white  shadow-md py-1 px-2 rounded">Create
                    New
                    Package
                </button>
                <button onclick="cancelCreate()"
                    class="bg-gray-400 hover:bg-gray-600 text-white py-1 px-4 rounded ml-1 shadow-md">Cancel</button>
            </form>
        </div>
    </div>
    <script>
        function showCreateForm() {
            document.getElementById('create-form').reset();
            document.getElementById('create-modal-overlay').classList.remove('hidden');
            document.getElementById('create-form-section').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function cancelCreate() {
            document.getElementById('create-modal-overlay').classList.add('hidden');
            document.getElementById('create-form').reset();
            document.body.classList.remove('overflow-hidden');
        }
    </script>

    <!-- Modal Overlay for Insert Form -->
    <div id="insert-modal-overlay"
        class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
        <!-- Modal Content -->
        <div id="insert-form-section"
            class="bg-white shadow-xl rounded-lg overflow-hidden border border-gray-300 p-6 w-full max-w-4xl relative mx-5">
            <button type="button" onclick="cancelInsert()"
                class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-xl font-bold">&times;</button>
            <form id="insert-form" method="POST" action="{{ route('insert.package_item') }}">
                @csrf
                <input type="hidden" name="insert_package_id" id="insert_package_id">

                <h2 class="text-2xl font-bold mb-2">Insert Item to <span class="insert_package_name font-semibold"></span>
                    <span class="bg-green-600 text-white py-1 px-2 rounded-xl text-sm font-semibold">Insert</span>
                </h2>

                <div class="flex flex-col md:flex-row gap-4 mb-4 w-full">
                    <div class="w-full">
                        <div class="w-full  ">
                            <label class="block text-gray-700 font-semibold mb-2">Package Content</label>
                            <select name="insert_package_content_id" id="insert_package_content_id"
                                class="shadow border border-gray-400 rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline"
                                required>
                                <option value="">-- Select Content --</option>
                                @foreach ($itemTypes as $itemType)
                                    <option value="{{ $itemType->pk_dcp_item_types_id }}">{{ $itemType->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-full  ">
                            <label class="block text-gray-700 font-semibold mb-2">Brand</label>
                            <select name="insert_item_brand_id" id="insert_item_brand_id"
                                class="shadow border border-gray-400 rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline"
                                required>
                                <option value="">-- Select Brand --</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->pk_dcp_batch_item_brands_id }}">{{ $brand->brand_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="w-full">
                        <div class="w-full ">
                            <label class="block text-gray-700 font-semibold mb-2">Quantity</label>
                            <input type="number" name="insert_quantity" id="insert_quantity"
                                class="shadow border border-gray-400 rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline"
                                required>
                        </div>
                        <div class="w-full  ">
                            <label class="block text-gray-700 font-semibold mb-2">Unit Price</label>
                            <input type="number" step="0.01" name="insert_unit_price" id="insert_unit_price"
                                class="shadow border border-gray-400 rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline"
                                required>
                        </div>
                    </div>

                </div>

                <button type="submit"
                    class="bg-green-600 shadow-md hover:bg-green-700 text-white py-1 px-4 rounded">Insert
                    Item</button>
                <button type="button" onclick="cancelInsert()"
                    class="bg-gray-400 hover:bg-gray-600 text-white py-1 shadow-md px-4 rounded ml-1">Cancel</button>
            </form>
        </div>
    </div>


    <script>
        function showInsertForm(dcp_packages_id, package_name) {
            document.getElementById('insert_package_id').value = dcp_packages_id;
            document.querySelectorAll('.insert_package_name').forEach(el => el.textContent = package_name);

            document.getElementById('insert-form').reset();
            document.getElementById('insert-modal-overlay').classList.remove('hidden');
            document.getElementById('insert-form-section').classList.remove('hidden');

            // Hide edit modal if open
            document.getElementById('edit-modal-overlay').classList.add('hidden');
            document.body.classList.add('overflow-hidden');
            // Disable already used items except the one being inserted
            const select = document.getElementById('insert_package_content_id');
            const usedIds = usedItemsPerPackage[dcp_packages_id] || [];

            for (const option of select.options) {
                const originalText = option.text.replace(' (Already Exist)', '');
                option.text = originalText; // reset label
                option.disabled = false;

                if (
                    usedIds.includes(parseInt(option.value))
                ) {
                    option.disabled = true;
                    option.text += ' (Already Exist)';
                }
            }
        }

        function cancelInsert() {
            document.getElementById('insert-modal-overlay').classList.add('hidden');
            document.getElementById('insert-form').reset();
            document.body.classList.remove('overflow-hidden');
        }
    </script>

    <!-- Modal Overlay -->
    <div id="edit-modal-overlay"
        class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
        <!-- Modal Content -->
        <div id="edit-form-section"
            class="bg-white shadow-xl rounded-lg overflow-hidden p-6 border border-gray-300 w-full max-w-4xl relative mx-5">
            <button type="button" onclick="cancelEdit()"
                class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-xl font-bold">&times;</button>
            <form id="edit-form" method="POST" action="{{ route('update.package_type') }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="package_id" id="edit-package-id">

                <h2 class="text-2xl font-bold mb-2">Edit Package Content Items
                    <span class="bg-yellow-500 text-white py-1 px-2 rounded-xl text-sm font-semibold">Update</span>
                </h2>
                <input type="hidden" name="id" id="id">
                <input type="hidden" name="package_id" id="package_id">

                <div class="flex flex-col md:flex-row gap-4 mb-4 w-full">
                    <div class="w-full">
                        <div class="w-full ">
                            <label class="block text-gray-700 font-semibold mb-2">DCP Package Name</label>
                            <input type="text" name="package_name"
                                class="package_name shadow border border-gray-400 rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline"
                                readonly>
                        </div>
                        <div class="w-full  ">
                            <label class="block text-gray-700 font-semibold mb-2">DCP Package Content</label>
                            <select name="package_content_name" id="package_content_name"
                                class="shadow border border-gray-400 rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">
                                <option value="">-- Select Content --</option>
                                @foreach ($itemTypes as $itemType)
                                    <option value="{{ $itemType->pk_dcp_item_types_id }}">{{ $itemType->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-full  ">
                            <label class="block text-gray-700 font-semibold mb-2">Brand</label>
                            <select name="edit_item_brand_id" id="edit_item_brand_id"
                                class="shadow border border-gray-400 rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline"
                                required>
                                <option value="">-- Select Brand --</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->pk_dcp_batch_item_brands_id }}">{{ $brand->brand_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="w-full">
                        <div class="w-full  ">
                            <label class="block text-gray-700 font-semibold mb-2">Item Quantity</label>
                            <input type="text" name="quantity" id="edit-quantity"
                                class="shadow border border-gray-400 rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline"
                                required>
                        </div>
                        <div class="w-full  ">
                            <label class="block text-gray-700 font-semibold mb-2">Item Price</label>
                            <input type="number" name="unit_price" id="edit-unit_price"
                                class="shadow border border-gray-400 rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline"
                                step="0.01" min="0" required>

                        </div>
                    </div>

                </div>

                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-4 rounded shadow-md">Update
                    Package</button>
                <button type="button" onclick="cancelEdit()"
                    class="bg-gray-400 hover:bg-gray-600 text-white py-1 px-4 rounded ml-1 shadow-md">Cancel</button>
            </form>
        </div>
    </div>


    <div class="md:my-5 mx-0 my-0"
        style="border-radius: 8px; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
        @php
            $groupedPackages = $packages->groupBy('package_name');
            $colors = ['#C9E4CA', '#F7D2C4', '#C5CAE9', '#F2C464'];
            $colorIndex = 0;
        @endphp

        <div class="flex justify-between md:flex-row flex-col   mb-6">
            <div class="w-full" style="letter-spacing: 0.05rem">
                <div class=" flex justify-start gap-2 items-center ">

                    <div
                        class="h-16 w-16 bg-white p-3 border border-gray-300 shadow-lg rounded-full flex items-center justify-center">
                        <div class="text-white bg-blue-600 p-2 rounded-full">
                            <svg viewBox="0 0 24 24" class="w-10 h-10" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M4 15.8294V15.75V8C4 7.69114 4.16659 7.40629 4.43579 7.25487L4.45131 7.24614L11.6182 3.21475L11.6727 3.18411C11.8759 3.06979 12.1241 3.06979 12.3273 3.18411L19.6105 7.28092C19.8511 7.41625 20 7.67083 20 7.94687V8V15.75V15.8294C20 16.1119 19.8506 16.3733 19.6073 16.5167L12.379 20.7766C12.1451 20.9144 11.8549 20.9144 11.621 20.7766L4.39267 16.5167C4.14935 16.3733 4 16.1119 4 15.8294Z"
                                        stroke="currentColor" stroke-width="2"></path>
                                    <path d="M12 21V12" stroke="currentColor" stroke-width="2"></path>
                                    <path d="M12 12L4 7.5" stroke="currentColor" stroke-width="2"></path>
                                    <path d="M20 7.5L12 12" stroke="currentColor" stroke-width="2"></path>
                                </g>
                            </svg>
                        </div>
                    </div>
                    <div class="w-full" style="letter-spacing: 0.05rem flex flex-col items-center">
                        <h2 class="text-2xl font-bold text-gray-800 uppercase">DCP Package List</h2>
                        <p class="text-lg text-gray-600">List of Package Type with Item Content</p>
                    </div>
                </div>
            </div>
            <div class="w-full flex md:justify-end items-center justify-start">
                <button type="button" onclick="showCreateForm()"
                    class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded shadow-md font-medium">
                    + Create New Package
                </button>
            </div>



        </div>

        @if ($packages->isEmpty())
            <div class="text-center text-gray-500 py-8">No packages found.</div>
        @else
            <div class="grid grid-cols-1  gap-2">
                @foreach ($groupedPackages as $packageName => $items)
                    @php
                        $color = $colors[$colorIndex % count($colors)];
                        $colorIndex++;
                    @endphp
                    <div class="rounded-sm shadow-lg bg-white overflow-hidden border border-gray-300"
                        x-data="{ open: false }">
                        <!-- Header -->
                        <div class="p-4 flex justify-between md:flex-row flex-col items-center gap-2">
                            <h3 style="letter-spacing: 0.05rem;"
                                class="flex items-center justify-center md:justify-start gap-2 text-lg font-bold text-gray-800">
                                <span
                                    class="flex items-center justify-center min-w-8 w-8 h-8 rounded-full shadow bg-blue-600 text-white font-mediium">
                                    {{ $loop->iteration }}
                                </span>
                                <span>{{ $packageName }}</span>
                            </h3>


                            <div class="flex md:flex-row flex-col  md:space-x-2 space-x-0 md:space-y-0 space-y-2   ">
                                <button type="button"
                                    onclick="showInsertForm('{{ $items->first()->dcp_packages_id }}', '{{ $packageName }}')"
                                    class="bg-blue-600  font-semibold  shadow-md hover:bg-blue-700 text-md rounded-md py-2 px-2 text-white  ">
                                    Insert Product
                                </button>
                                <button type="button" @click="open = !open"
                                    class="bg-green-600 shadow-md hover:bg-green-700  font-semibold  text-md rounded-md py-2 px-2 text-white  ">
                                    <span>Product List</span>
                                </button>
                                <form action="{{ route('delete.package_type', $items->first()->dcp_packages_id) }}"
                                    method="post"
                                    onsubmit="return confirm('Are you sure you want to delete this package?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-600 shadow-md  font-semibold  hover:bg-red-800 text-md rounded-md py-2 px-3 text-white  flex items-center space-x-2">
                                        <!-- Trash Icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        <span>Delete Package</span>
                                    </button>

                                </form>
                                <!-- Toggle Button -->

                            </div>
                        </div>
                        <style>
                            [x-cloak] {
                                display: none !important;
                            }
                        </style>
                        <!-- Items (hidden initially) -->
                        <div class="p-4 space-y-3 bg-white" x-show="open" x-collapse x-cloak>

                            @foreach ($items as $index => $package)
                                <div class="w-full shadow-sm border px-4 py-2  flex md:flex-row flex-col">
                                    <div
                                        class=" w-full flex flex-col md:justify-between justify-start items-center   pb-2">
                                        <div class="w-full  text-left  ">

                                            <p class="font-semibold text-gray-700 text-left">
                                                <span
                                                    class="font-bold p-2 bg-green-600 shadow text-white min-w-8 w-8 h-8 inline-flex items-center justify-center rounded-full">{{ $index + 1 }}.</span>
                                                {{ $package->item_name }}
                                            </p>
                                            @php
                                                $brand_name = \App\Models\DCPBatchItemBrand::where(
                                                    'pk_dcp_batch_item_brands_id',
                                                    $package->dcp_batch_item_brands_id,
                                                )->value('brand_name');
                                            @endphp
                                            <p class="text-md text-gray-500 text-left">Brand: {{ $brand_name }}</p>
                                        </div>
                                        <div class="  text-left  w-full ">
                                            <p class="text-md">Qty: <span
                                                    class="font-bold">{{ $package->quantity }}</span>
                                            </p>
                                            <p class="text-md">₱{{ number_format($package->unit_price, 2) }}</p>
                                        </div>
                                    </div>
                                    <form action="{{ route('delete.package_item', $package->id) }}" method="post"
                                        onsubmit="return confirm('Are you sure you want to remove this item?')">

                                        <!-- Action buttons -->
                                        <div
                                            class="flex w-full   md:flex-col flex-row gap-2 mt-2 items-center justify-center">

                                            <div class="w-full    flex">
                                                <button type="button"
                                                    onclick="showEditForm(
                                                        '{{ $package->dcp_packages_id }}',
                                                        '{{ $package->item_type_id }}',
                                                        '{{ $package->id }}',
                                                        '{{ $packageName }}',
                                                        '{{ $package->item_name }}',
                                                        `{{ $package->quantity }}`,
                                                        '{{ $package->dcp_batch_item_brands_id }}',
                                                        '{{ $package->unit_price }}'
                                                    )"
                                                    class="w-full whitespace-nowrap text-center shadow-md bg-blue-600 hover:bg-blue-700 text-white py-1 px-3 rounded text-md">
                                                    Edit Product
                                                </button>
                                            </div>

                                            <div class="w-full    flex">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="flex w-full justify-center shadow-md items-center gap-1 bg-red-600 hover:bg-red-700 text-white py-1 px-3 rounded text-md">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                        stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m2 0h-2m-6 0H7m6-4h-2a1 1 0 00-1 1v1h4V4a1 1 0 00-1-1z" />
                                                    </svg>
                                                    Remove
                                                </button>
                                            </div>

                                        </div>
                                    </form>


                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>





    <script>
        const usedItemsPerPackage = @json(
            $packages->groupBy('dcp_packages_id')->map(function ($group) {
                return $group->pluck('item_type_id');
            }));
    </script>


    <script>
        function showEditForm(dcp_packages_id, item_type_id, id, package_name, package_content_name, quantity, brand_id,
            unit_price) {
            document.querySelectorAll('.package_name').forEach(el => el.value = package_name);
            document.getElementById('id').value = id;
            document.getElementById('edit-quantity').value = quantity;
            document.getElementById('edit-unit_price').value = unit_price;
            document.getElementById('package_id').value = dcp_packages_id;
            document.getElementById('insert-form-section').classList.add('hidden');
            const select = document.getElementById('package_content_name');
            const usedIds = usedItemsPerPackage[dcp_packages_id] || [];

            for (const option of select.options) {
                const originalText = option.text.replace(' (Already Exist)', '');
                option.text = originalText; // reset label
                option.disabled = false;

                if (
                    usedIds.includes(parseInt(option.value)) &&
                    parseInt(option.value) !== parseInt(item_type_id)
                ) {
                    option.disabled = true;
                    option.text += ' (Already Exist)';
                }
            }

            // Set the selected value after updating options
            select.value = item_type_id;

            // Set the brand dropdown value
            document.getElementById('edit_item_brand_id').value = brand_id;

            // Show modal
            document.getElementById('edit-modal-overlay').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function cancelEdit() {
            document.getElementById('edit-modal-overlay').classList.add('hidden');
            document.getElementById('edit-form').reset();
            document.body.classList.remove('overflow-hidden');
        }
    </script>










    <div id="item-type-options" class="hidden">
        @foreach ($itemTypes as $itemType)
            <option value="{{ $itemType->pk_dcp_item_types_id }}">{{ $itemType->name }}</option>
        @endforeach
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addPackageContentButton = document.getElementById('add-package-content');
            const packageContentList = document.getElementById('package-content-list');
            const itemTypeOptions = document.getElementById('item-type-options').innerHTML;
            const brandOptions = document.getElementById('brand-options').innerHTML;

            addPackageContentButton.addEventListener('click', function() {
                const newRow = `
        <div class="package-content flex flex-col md:flex-row gap-4 mb-4 w-full">
            <!-- Product -->
            <div class="w-full md:w-1/2">
                <label class="block text-gray-700 font-semibold mb-2">Product</label>
                <select name="item_type_id[]"
                    class="w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
                    required>
                    <option value="">-- Select Product --</option>
                    ${itemTypeOptions}
                </select>
            </div>
            <!-- Brand -->
            <div class="w-full md:w-1/3">
                <label class="block text-gray-700 font-semibold mb-2">Brand</label>
                <select name="item_brand_id[]"
                    class="w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
                    required>
                    <option value="">-- Select Brand --</option>
                    ${brandOptions}
                </select>
            </div>
            <!-- Quantity -->
            <div class="w-full md:w-1/3">
                <label class="block text-gray-700 font-semibold mb-2">Quantity</label>
                <input type="number"
                    name="quantity[]"
                    class="w-full shadow appearance-none border border-gray-400 rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required>
            </div>

               <div class="w-full md:w-1/3">
                <label class="block text-gray-700 font-semibold mb-2">Unit Price</label>
                <input type="number"
                    name="unit_price[]"
                    step="0.01"
                    class="w-full shadow appearance-none border border-gray-400 rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required>
            </div>
            <!-- Remove Button -->
            <div class="w-full md:w-1/3 flex items-end">
                <button type="button"
                    class="remove-package-content shadow-md bg-red-600 hover:bg-red-700 text-white py-1 px-2 rounded">
                    Remove
                </button>
            </div>
        </div>
        `;
                packageContentList.insertAdjacentHTML('beforeend', newRow);
            });

            packageContentList.addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-package-content')) {
                    const row = event.target.closest('.package-content');
                    if (row) row.remove();
                }
            });
        });
    </script>
@endsection
