{{-- filepath: c:\Users\Em-jay\dcp_inventory_system\resources\views\AdminSide\DCPBatch\Batch.blade.php --}}

@extends('layout.Admin-Side')
<title>@yield('title', 'DCP Dashboard')</title>
@section('content')
    <style>
        .table {
            border-collapse: collapse;
            width: 100%;
            border: 1px solid #282828;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .table th,
        .table td {
            border: 1px solid #989898;
            padding: 10px;
            text-align: left;
        }

        .table th {
            background: #e9e9e9;
            color: #333;
        }


        .school-rows {
            text-align: center;
        }


        button {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            letter-spacing: 0.05rem;
            font-weight: 500 !important;

        }

        input,
        textarea,
        select {
            border: 1px solid #ccc
        }
    </style>
    <!-- ✅ First load jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- ✅ Then load Select2 CSS and JS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>




    <!-- Modal Overlay for Add DCP Batch -->
    <div id="add-batch-modal-overlay"
        class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
        <!-- Modal Content -->
        <div id="add-batch-form-section"
            class="bg-white shadow-xl rounded-lg overflow-hidden border border-green-700 p-6 w-full max-w-full mx-5 relative"
            style="max-height: 80vh; overflow-y: auto;">
            <h2 class="text-2xl font-bold w-full text-center md:text-left text-gray-800"
                style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Create DCP
                Batch Recipient</h2>
            <div class="text-gray-600 text-md mb-4">Assign a Batch to a School</div>
            {{-- <div class="flex justify-center md:justify-start mb-4">
                <div class="rounded-full bg-green-100 p-4 shadow-md flex items-center justify-center w-32 h-32">
                    <!-- SVG Icon -->
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                        class="w-16 h-16 text-green-700" stroke="currentColor">
                        <path
                            d="M20.5 7.27783L12 12.0001M12 12.0001L3.49997 7.27783M12 12.0001L12 21.5001M14 20.889L12.777 21.5684C12.4934 21.726 12.3516 21.8047 12.2015 21.8356C12.0685 21.863 11.9315 21.863 11.7986 21.8356C11.6484 21.8047 11.5066 21.726 11.223 21.5684L3.82297 17.4573C3.52346 17.2909 3.37368 17.2077 3.26463 17.0893C3.16816 16.9847 3.09515 16.8606 3.05048 16.7254C3 16.5726 3 16.4013 3 16.0586V7.94153C3 7.59889 3 7.42757 3.05048 7.27477C3.09515 7.13959 3.16816 7.01551 3.26463 6.91082C3.37368 6.79248 3.52345 6.70928 3.82297 6.54288L11.223 2.43177C11.5066 2.27421 11.6484 2.19543 11.7986 2.16454C11.9315 2.13721 12.0685 2.13721 12.2015 2.16454C12.3516 2.19543 12.4934 2.27421 12.777 2.43177L20.177 6.54288C20.4766 6.70928 20.6263 6.79248 20.7354 6.91082C20.8318 7.01551 20.9049 7.13959 20.9495 7.27477C21 7.42757 21 7.59889 21 7.94153L21 12.5001M7.5 4.50008L16.5 9.50008M16 18.0001L18 20.0001L22 16.0001"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
            </div> --}}



            <div id="result" class="hidden mt-4">

                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative flex items-center gap-2"
                    role="alert" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    <span id="result-message"></span>
                </div>
            </div>

            <form method="POST" action="{{ route('store.batch') }}" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="font-semibold">Package Type <span class="text-red-600">*</span></label>
                        <select name="dcp_package_type_id" id="package_type" class="w-full border rounded px-2 py-1"
                            required>
                            <option value=""> Select Package </option>
                            @foreach ($packageTypes as $type)
                                <option value="{{ $type->pk_dcp_package_types_id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="font-semibold">Receipient School <span class="text-red-600">*</span></label><br>
                        <select name="school_id" class=" border rounded px-2 py-2   select2  " style="width: 100%; ">
                            <option value=""> Select School</option>
                            @foreach ($schools as $school)
                                <option value="{{ $school->pk_school_id }}" data-email="{{ $school->SchoolEmailAddress }}">
                                    {{ $school->SchoolName }} - {{ $school->SchoolLevel }}
                                </option>
                            @endforeach
                        </select>


                    </div>
                    <div>
                        <label class="font-semibold">Budget Year <span class="text-red-600">*</span></label>
                        <input type="number" name="budget_year" id="budget_year" class="w-full border rounded px-2 py-1"
                            required>
                    </div>

                    <div>
                        <label class="font-semibold">Batch Label <span class="text-gray-500">- (Auto
                                Generated)</span></label>
                        <input type="text" name="batch_label" id="batch_label" readonly
                            class="w-full border rounded px-2 py-1" required>
                    </div>
                    <div>
                        <label class="font-semibold">Delivery Date <span class="text-red-600">*</span></label>
                        <input type="date" name="delivery_date" class="w-full border rounded px-2 py-1" required>
                    </div>
                    <div>
                        <label class="font-semibold">Supplier Name <span class="text-red-600">*</span></label>
                        @php
                            $suppliers = \App\Models\DCPItemBrand::all();
                        @endphp
                        <select name="supplier_name" class="w-full border rounded px-2 py-1" required>
                            <option value="">Select Supplier</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->name }}">{{ $supplier->name }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div>
                        <label class="font-semibold">Mode of Delivery <span class="text-red-600">*</span></label>

                        <select name="mode_of_delivery" id="" class="w-full border rounded px-2 py-1" required>

                            @php
                                $modes = \App\Models\DCPItemModeDelivery::all();
                            @endphp
                            <option value="">Select Mode of Delivery</option>
                            @foreach ($modes as $mode)
                                <option value="{{ $mode->name }}">{{ $mode->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="md:col-span-1">

                        <label class="font-semibold">School Email Address <span class="text-gray-500">- (Auto
                                Generated)</span></label>
                        <input type="email" id="school-email" name="school_email" class="w-full border rounded px-2 py-1"
                            readonly>

                    </div>
                    <div>
                        <label class="font-semibold">Submission Status</label>
                        <div class="flex space-x-2 mt-1">
                            <button type="button"
                                class="px-3 py-1 rounded  shadow-md bg-green-500 text-white   cursor-not-allowed">
                                Approved
                            </button>
                            <button type="button"
                                class="px-3 py-1 rounded shadow-md  bg-yellow-500 text-white  cursor-not-allowed">
                                For Editing
                            </button>
                            <button type="button"
                                class="px-3 py-1 rounded shadow-md  bg-blue-500 text-white   cursor-not-allowed">
                                For Updating
                            </button>
                        </div>
                        <input type="hidden" name="submission_status" value="For Editing">
                    </div>
                    <div class="md:col-span-3">
                        <label class="font-semibold">Description<span class="text-gray-500">- (Auto
                                Generated)</span></label>
                        <textarea name="description" class="w-full border rounded px-2 py-1"></textarea>
                    </div>
                    <div id="batch-items-section" class="w-full overflow-hidden col-span-1 md:col-span-3  hidden">
                        <h3 class="text-lg font-semibold mb-2">Package Contents</h3>
                        <div id="batch-items-flex-container" class="flex flex-col md:flex-row flex-wrap gap-4 mx-5"
                            style="font-family: Verdana, Geneva, Tahoma, sans-serif">
                            <table class="table w-full   border border-gray-300 text-md">
                                <thead class="bg-gray-100" id="batch-items-table-head">
                                    <tr>
                                        <th class="px-4 py-2 border">Product Content</th>
                                    </tr>
                                </thead>
                                <tbody id="batch-items-table-body">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-md shadow-md hover:bg-blue-700 transition">Add
                        DCP Batch</button>
                    <button onclick="cancelAddBatch()"
                        class="bg-gray-400 text-white rounded-md hover:bg-gray-500 shadow-md px-6 py-2">Cancel</button>
                </div>
            </form>


        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const schoolSelect = document.querySelector('select[name="school_id"]');
            const emailInput = document.getElementById('school-email');

            schoolSelect.addEventListener('change', function() {
                const selectedOption = schoolSelect.options[schoolSelect.selectedIndex];
                const email = selectedOption.getAttribute('data-email') || '';
                emailInput.value = email;
            });
        });
    </script>
    <script>
        function showAddBatchModal() {
            document.getElementById('add-batch-modal-overlay').classList.remove('hidden');
            document.getElementById('add-batch-form-section').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function cancelAddBatch() {
            document.getElementById('add-batch-modal-overlay').classList.add('hidden');
            document.getElementById('add-batch-form-section').classList.add('hidden');
            document.querySelector('#add-batch-form-section form').reset();
            document.body.classList.remove('overflow-hidden');
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const packageTypeSelect = document.getElementById('package_type');
            const budgetYearInput = document.getElementById('budget_year');
            const batchLabelInput = document.getElementById('batch_label');

            function updateBatchLabel() {
                const selectedOption = packageTypeSelect.options[packageTypeSelect.selectedIndex];
                const packageName = selectedOption ? selectedOption.text : '';
                const year = budgetYearInput.value;

                if (packageName && year) {
                    batchLabelInput.value = `DCP ${year} - ${packageName}`;
                } else {
                    batchLabelInput.value = '';
                }
            }

            packageTypeSelect.addEventListener('change', updateBatchLabel);
            budgetYearInput.addEventListener('input', updateBatchLabel);
        });
    </script>


    <script>
        const bgColors = [
            'bg-red-100',
            'bg-yellow-100',
            'bg-green-100',
            'bg-blue-100',
            'bg-indigo-100',
            'bg-purple-100',
            'bg-pink-100',
            'bg-orange-100',
            'bg-teal-100',
            'bg-cyan-100'
        ];

        document.addEventListener('DOMContentLoaded', function() {
            const packageSelect = document.querySelector('[name="dcp_package_type_id"]');
            const itemsSection = document.getElementById('batch-items-section');
            const itemsTableBody = document.getElementById('batch-items-table-body');
            const descriptionInput = document.querySelector('textarea[name="description"]');

            packageSelect.addEventListener('change', function() {
                const packageTypeId = this.value;
                itemsTableBody.innerHTML = ''; // clear previous

                if (packageTypeId) {
                    const itemsTableHead = document.querySelector('#batch-items-table-head');
                    const itemsTableBody = document.querySelector('#batch-items-table-body');

                    const itemsFlexContainer = document.getElementById('batch-items-flex-container');

                    fetch(`/api/package-items/${packageTypeId}`)
                        .then(res => res.json())
                        .then(data => {
                            itemsFlexContainer.innerHTML = ''; // clear previous
                            data.sort((a, b) => b.quantity - a.quantity);

                            if (data.length > 0) {
                                let descriptionParts = [];

                                data.forEach((item, index) => {

                                    const bgColor = bgColors[index % bgColors.length];
                                    const itemBox = `
                    <div class="flex-1 min-w-[200px] bg-white border  rounded shadow p-4 ${bgColor} text-center"
                    style="border: 1px solid #282828;"
                    >
                        <p class=" text-gray-800"><b>${item.quantity}</b> - ${item.item_name}</p>
                       
                    </div>
                `;
                                    itemsFlexContainer.insertAdjacentHTML('beforeend', itemBox);
                                    // Build description string
                                    descriptionParts.push(`${item.quantity} ${item.item_name}`);
                                });

                                // Set description value
                                descriptionInput.value = `(${descriptionParts.join('; ')})`;
                                itemsSection.classList.remove('hidden');
                            } else {
                                itemsSection.classList.add('hidden');
                            }
                        })


                        .catch(err => {

                            console.error('Error fetching items:', err);
                            itemsSection.classList.add('hidden');
                        });
                } else {
                    itemsSection.classList.add('hidden');
                }
            });
        });
    </script>





    <div class=" md:my-5 mx-0 my-0"
        style="border-radius: 8px; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">

        <div class="flex md:flex-row flex-col justify-between items-center">
            <div class=" flex justify-start gap-2 items-center ">

                <div
                    class="h-16 w-16 bg-white p-3 border border-gray-300 shadow-lg rounded-full flex items-center justify-center">
                    <div class="text-white bg-blue-600 p-2 rounded-full">
                        <svg viewBox="0 0 24 24" class="w-10 h-10" fill="none" xmlns="http://www.w3.org/2000/svg">
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

                <div style="letter-spacing: 0.05rem">
                    <h2 class="text-2xl font-bold text-gray-800 uppercase">DCP Batch List</h2>
                    <div class="text-lg text-gray-600 mb-2">List of Batches assigned in every Schools under DepEd
                        Computerization Program</div>
                </div>
            </div>
            <div class="w-full flex md:justify-end justify-start my-2">
                <button type="button" onclick="showAddBatchModal()"
                    class="bg-blue-600 hover:bg-blue-700 text-white py-1 h-10 px-4 rounded">
                    + Add DCP Batch
                </button>
            </div>
        </div>
        <div class="my-3 flex justify-end gap-2 w-full">
            <button id="btnBatchList" onclick="showContainer1()"
                class="px-4 py-1 rounded-md shadow-md bg-gray-400 text-white">
                Batch List
            </button>
            <button id="btnSchoolBatch" onclick="showContainer2()"
                class="px-4 py-1 rounded-md shadow-md bg-gray-400 text-white">
                Schools Batch
            </button>
        </div>
        <div id="batch-list-display">
            <div class="text-md text-gray-700">Dashboard Status</div>
            <div class="grid grid-cols-1 md:grid-cols-3 md:gap-4 gap-2 mb-4">
                <!-- 🕒 Pending -->
                <div
                    class="flex items-center gap-4 bg-white border border-gray-200 shadow-md rounded-xl p-4 transition hover:shadow-lg">
                    <div
                        class="flex items-center justify-center p-1 rounded-full shadow-sm border border-gray-300 bg-white">
                        <div class="flex items-center justify-center w-12 h-12 rounded-full bg-yellow-400 text-white">
                            <!-- Clock Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">Pending - For Approval</h3>
                        <p class="text-2xl font-bold text-yellow-600">{{ $total_pending }}</p>
                    </div>
                </div>

                <!-- ✅ Approved -->
                <div
                    class="flex items-center gap-4 bg-white border border-gray-200 shadow-md rounded-xl p-4 transition hover:shadow-lg">
                    <div
                        class="flex items-center justify-center p-1 rounded-full shadow-sm border border-gray-300 bg-white">
                        <div class="flex items-center justify-center w-12 h-12 rounded-full text-white bg-green-600">
                            <!-- Check Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">Approved Batch</h3>
                        <p class="text-2xl font-bold text-green-600">{{ $total_approved }}</p>
                    </div>
                </div>

                <!-- 📦 Total -->
                <div
                    class="flex items-center gap-4 bg-white border border-gray-200 shadow-md rounded-xl p-4 transition hover:shadow-lg">
                    <div
                        class="flex items-center justify-center p-1 rounded-full shadow-sm border border-gray-300 bg-white">
                        <div class="flex items-center justify-center w-12 h-12 rounded-full text-white bg-blue-600">
                            <!-- Box Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 7l9-4 9 4-9 4-9-4zm0 6l9 4 9-4M3 7v6m18-6v6" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">Total Batch</h3>
                        <p class="text-2xl font-bold text-blue-600">{{ $total_batches }}</p>
                    </div>
                </div>
            </div>
            <div class="text-md text-gray-700">Search</div>

            <!-- 🔍 Search Bar -->
            <input type="text" id="searchBatch" placeholder="Search by batch label, school, etc."
                class="mb-4 p-2 border border-gray-300 rounded md:w-1/3 w-full">


            <!-- Card Container -->
            <div id="batchCardContainer" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3  gap-4">
                @foreach ($dcpBatches as $batch)
                    <div id="card-{{ $batch->pk_dcp_batches_id }}" x-data="{ open: false }"
                        class="bg-white border border-gray-300 rounded-lg shadow-md p-4 hover:shadow-lg transition">

                        <!-- Clickable Header -->
                        <div @click="open = !open" class="cursor-pointer">
                            <h3 class="text-lg font-bold text-gray-800 mb-2">
                                <div class="flex items-center gap-2 mb-2">
                                    <span
                                        class="flex items-center min-w-8 h-8 px-2 font-bold justify-center w-8 h-8 rounded-full   bg-green-600 text-white font-medium text-md md:text-base">
                                        {{ $loop->iteration }}
                                    </span>
                                    <span class="text-gray-900 font-semibold" style="letter-spacing: 0.05rem;">
                                        {{ $batch->batch_label }}
                                    </span>
                                </div>


                                @if ($batch->approval_status === 'Pending')
                                    <span style="letter-spacing: 0.05rem;"
                                        class="inline-block uppercase bg-yellow-100 text-yellow-800 text-xs font-semibold px-3 py-1 rounded-full">
                                        For Approval
                                    </span>
                                @elseif ($batch->approval_status === 'Approved')
                                    <span style="letter-spacing: 0.05rem;"
                                        class="inline-block uppercase bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">
                                        Approved: {{ $batch->date_approved }}
                                    </span>
                                @else
                                    <span style="letter-spacing: 0.05rem;"
                                        class="inline-block uppercase bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">
                                        For Submission
                                    </span>
                                @endif

                            </h3>
                            <p style="letter-spacing: 0.05rem;" class="text-md text-gray-600 font-medium mb-1">
                                <b>Recipient:</b>
                                <span class="text-gray-700">{{ $batch->school_name ?? 'N/A' }} -
                                    <strong> {{ $batch->school_level }}</strong> </span>
                            </p>
                        </div>

                        <!-- Collapsible Content -->
                        <div x-show="open" x-collapse>
                            <p class="text-md text-gray-600 mb-1"><b>Description:</b> {{ $batch->description }}</p>
                            <p class="text-md text-gray-600 mb-1"><b>Delivery:</b>
                                {{ $batch->delivery_date ? \Carbon\Carbon::parse($batch->delivery_date)->format('F d, Y') : 'N/A' }}
                            </p>

                            <div class="text-md text-gray-600 mb-3">
                                <b>Status:</b>

                                @if ($batch->approval_status === 'Pending')
                                    <span>
                                        <form method="POST"
                                            action="{{ url('Admin/DCPBatch/' . $batch->pk_dcp_batches_id . '/approve') }}"
                                            style="display:inline;">
                                            @csrf
                                            <button type="submit"
                                                class=" text-center px-3 py-1 text-md font-normal text-white bg-green-600 rounded hover:bg-green-700"
                                                {{ $batch->approval_status === 'Approved' ? 'disabled' : '' }}>
                                                Approve
                                            </button>
                                        </form>
                                    </span>
                                @elseif ($batch->approval_status === 'Approved')
                                    <span class="text-green-600 font-bold">Approved: {{ $batch->date_approved }}</span>
                                @else
                                    <span class="text-blue-600">For Submission</span>
                                @endif
                            </div>


                            <!-- Action Buttons -->
                            <div class="flex flex-wrap gap-2">
                                <a style="letter-spacing: 0.05rem;"
                                    href="{{ route('index.items', $batch->id ?? $batch->pk_dcp_batches_id) }}"
                                    class="px-3 py-1 text-white font-medium bg-blue-500 rounded hover:bg-blue-600">
                                    Items
                                </a>

                                <a style="letter-spacing: 0.05rem"
                                    class="px-3 py-1 text-white  font-medium bg-yellow-500 rounded hover:bg-yellow-600">
                                    Edit
                                </a>

                                <button type="button" onclick="deleteBatch({{ $batch->pk_dcp_batches_id }})"
                                    class="px-3 py-1 text-white bg-red-500 rounded hover:bg-red-600">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $dcpBatches->links() }}
            </div>
        </div>
        <div id="school-batch-list" style="display:none">
            <table class="table">
                <thead class="text-gray-700 uppercase text-md">
                    <tr>
                        <th class="bg-gray-200">No.</th>
                        <th class="bg-gray-200">School Name</th>
                        <th style="text-align: center">School Level</th>
                        <th style="text-align: center">Total Batch Received</th>
                        <th style="text-align: center">Cost</th>
                    </tr>
                </thead>
                <tbody id="tbody-school"></tbody>
            </table>
        </div>
    </div>
    <script>
        function showContainer1() {
            document.getElementById("batch-list-display").style.display = "block";
            document.getElementById("school-batch-list").style.display = "none";

            // Button color toggle
            document.getElementById("btnBatchList").classList.add("bg-blue-600");
            document.getElementById("btnBatchList").classList.remove("bg-gray-400");

            document.getElementById("btnSchoolBatch").classList.add("bg-gray-400");
            document.getElementById("btnSchoolBatch").classList.remove("bg-blue-600");
        }

        function showContainer2() {
            document.getElementById("batch-list-display").style.display = "none";
            document.getElementById("school-batch-list").style.display = "block";

            // Button color toggle
            document.getElementById("btnSchoolBatch").classList.add("bg-blue-600");
            document.getElementById("btnSchoolBatch").classList.remove("bg-gray-400");

            document.getElementById("btnBatchList").classList.add("bg-gray-400");
            document.getElementById("btnBatchList").classList.remove("bg-blue-600");
        }

        // Optional: Set initial active state
        showContainer1();
    </script>
    <script>
        async function loadSchools() {

            const response = await fetch('/Admin/api/schools-with-packages');
            const res = await response.json();
            const data = res.schools;
            const tbody = document.getElementById('tbody-school');
            data.forEach((school, index) => {
                const row = document.createElement('tr');
                row.classList.add('school-rows');
                row.innerHTML = `
                <td class="bg-white">${index + 1}</td>
                <td class="bg-white">${school.SchoolName}</td>
                <td class="bg-white" style="text-align:center">${school.SchoolLevel}</td>
                <td class="${school.TotalBatch == 0 ? 'bg-red-200 border border-gray-300' : 'bg-white'}" style="text-align:center; ">
                    ${school.TotalBatch}
                </td>
               <td class="bg-white" style="text-align:center">
                ₱ ${Number(school.TotalCost).toLocaleString('en-PH', { minimumFractionDigits: 0, maximumFractionDigits: 0 })}
                </td>


                `;

                tbody.appendChild(row);
            });
        }
        loadSchools();
    </script>

    <!-- Only load jQuery and Select2 once, and initialize after both are loaded -->
    <script>
        $(document).ready(function() {
            // Initialize Select2
            if ($.fn.select2) {
                $('.select2').select2({
                    placeholder: "Select School",
                    allowClear: true
                });
            } else {
                console.error('Select2 plugin not loaded.');
            }

            // Auto-fill school email address on selection
            $('select[name="school_id"]').on('change', function() {
                var email = $(this).find('option:selected').data('email') || '';
                $('#school-email').val(email);
            });
        });

        // Add form submission
        const form = document.getElementById('dcp_add_form');
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(form);

                fetch('/Admin/DCPBatch/store', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const resultDiv = document.getElementById('result');
                            const resultMsg = document.getElementById('result-message');
                            resultMsg.innerText = "Batch saved: " + data.data.batch_label;
                            resultDiv.classList.remove('hidden');
                            form.reset();
                            $('#searchBatch').val(''); // clear search bar if needed
                            $('#searchBatch').trigger('keyup'); // trigger table refresh
                        } else {
                            alert('Error: ' + (data.message || 'Unknown error'));
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while submitting the form.');
                    });
            });
        }

        // School email autofill
        const schoolSelect = document.querySelector('select[name="school_id"]');
        const emailInput = document.getElementById('school-email');
        if (schoolSelect && emailInput) {
            schoolSelect.addEventListener('change', function() {
                const selected = schoolSelect.options[schoolSelect.selectedIndex];
                emailInput.value = selected.getAttribute('data-email') || '';
            });
            if (schoolSelect.value) {
                const selected = schoolSelect.options[schoolSelect.selectedIndex];
                emailInput.value = selected.getAttribute('data-email') || '';
            }
        }


        // Delete batch function (global)
        function deleteBatch(batchId) {
            if (confirm('Are you sure you want to delete this batch?')) {
                fetch(`/Admin/DCPBatch/${batchId}/delete`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const row = document.getElementById(`card-${batchId}`);
                            if (row) {
                                row.innerHTML = `
                        <td colspan="100%" class="bg-green-100 text-green-700 text-center py-4 rounded">
                            <svg class="w-6 h-6 inline-block mr-2 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            DCP Batch deleted successfully!
                        </td>
                    `;
                            }
                        } else {
                            alert('Error deleting batch');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }



        }
    </script>

    <script>
        $('#searchBatch').on('keyup', function() {
            const keyword = $(this).val();

            $.ajax({
                url: '/Admin/DCPBatch/search',
                type: 'GET',
                data: {
                    query: keyword
                },
                success: function(data) {
                    let cards = '';
                    if (data.length > 0) {

                        // Sort descending by id
                        data.sort((a, b) => b.pk_dcp_batches_id - a.pk_dcp_batches_id);

                        data.forEach((batch, index) => {
                            const approved = (batch.submission_status ?? '').toUpperCase() ===
                                'APPROVED';
                            cards += `
                                    <div id="card-${batch.pk_dcp_batches_id}"
                                        class="bg-white border border-gray-200 rounded-lg shadow-md p-4 hover:shadow-lg transition flex flex-col"
                                        x-data="{ open: false }">

                                        <!-- Clickable header -->
                                        <div @click="open = !open" class="cursor-pointer">
                                            <h3 class="text-lg font-bold text-gray-800 mb-2">
                                              <div class="flex items-center gap-2 mb-2">
                                <span
                                    class="flex items-center min-w-8 h-8 px-2 font-bold justify-center w-8 h-8 rounded-full   bg-green-600 text-white font-medium text-md md:text-base">
                                                ${index + 1}
                                </span>
                                <span style="letter-spacing: 0.05rem;" class="text-gray-900 font-semibold">
                                    ${batch.batch_label }
                                </span>
                            </div>
                                                ${
                                                    batch.approval_status === 'Pending'
                                                    ? `<span style="letter-spacing: 0.05rem;" class="inline-block uppercase bg-yellow-100 text-yellow-800 text-xs font-semibold px-3 py-1 rounded-full">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    For Approval
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </span>`
                                                    : batch.approval_status === 'Approved'
                                                        ? `<span style="letter-spacing: 0.05rem;" class="inline-block uppercase bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        Approved: ${batch.date_approved}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </span>`
                                                        : `<span style="letter-spacing: 0.05rem;" class="inline-block uppercase bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        For Submission
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </span>`
                                                }</h3>
                                            <p style="letter-spacing: 0.05rem;" class="text-md text-gray-700 font-medium mb-1">
                                                <b>Recipient:</b> ${batch.school_name ?? 'N/A'} - <strong> ${batch.school_level ?? 'N/A'} </strong>
                                            </p>
                                        </div>

                                        <!-- Collapsible section -->
                                        <div x-show="open" x-collapse>
                                            <p class="text-md text-gray-600 mb-1"><b>Description:</b> ${batch.description}</p>
                                            <p class="text-md text-gray-600 mb-1"><b>Delivery:</b> ${batch.delivery_date ?? 'N/A'}</p>
                                           <div class="text-md text-gray-600 mb-3">
                                            <b>Status:</b>
                                            ${
                                                batch.approval_status === 'Pending'
                                                ? `
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <span>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <form method="POST" action="Admin/DCPBatch/${batch.pk_dcp_batches_id}/approve" style="display:inline;">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <button type="submit"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        class="text-center px-3 py-1 text-md font-normal text-white bg-green-600 rounded hover:bg-green-700 ${batch.approval_status === 'Approved' ? 'opacity-50 cursor-not-allowed' : ''}"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ${batch.approval_status === 'Approved' ? 'disabled' : ''}>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        Approve
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </button>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </form>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </span>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        `
                                                : batch.approval_status === 'Approved'
                                                    ? `<span class="text-green-600 font-bold">Approved: ${batch.date_approved}</span>`
                                                    : `<span class="text-blue-600">For Submission</span>`
                                            }
                                        </div>

                                            <div class="flex flex-wrap gap-2 mt-auto">
                                                <a style="letter-spacing:0.05rem" href="/dcp-batch/${batch.pk_dcp_batches_id}/items"
                                                    class="min-w-[80px] text-center  font-medium  px-3 py-1 text-xs font-semibold text-white bg-blue-500 rounded hover:bg-blue-600">
                                                    Items
                                                </a>
                                                <a style="letter-spacing:0.05rem" class="min-w-[80px] text-center  font-medium  px-3 py-1 text-xs font-semibold text-white bg-yellow-500 rounded hover:bg-yellow-600">
                                                    Edit
                                                </a>
                                                <button onclick="deleteBatch(${batch.pk_dcp_batches_id})"
                                                    class="min-w-[80px] text-center px-3 py-1 text-xs font-semibold text-white bg-red-500 rounded hover:bg-red-600">
                                                    Delete
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    `;

                        });
                    } else {
                        cards =
                            `<p class="col-span-full text-center text-gray-500">No results found.</p>`;
                    }
                    $('#batchCardContainer').html(cards); // target your card grid container
                }
            });
        });
    </script>
@endsection
