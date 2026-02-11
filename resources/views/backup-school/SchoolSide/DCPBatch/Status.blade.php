@extends('layout.SchoolSideLayout')
<title>@yield('title', 'DCP Batch')</title>

@section('content')
    <div class="mx-5 mt-5 border-1">
        <a href="{{ route('school.dcp_items', $batchId) }}"
            class="inline-flex items-center text-blue-600 text-md font-semibold hover:underline">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            DCP Items
        </a>
        <div class="bg-white border border-gray-300 rounded-md overflow-hidden p-4 flex justify-between  my-5">
            <div>
                <h2 class="text-2xl font-bold text-blue-700">Batch: {{ $batchName }} </h2>
                <span class="text-gray-600">Date Delivered: {{ $batchDeliveryDate ?? 'N/A' }}</span>
            </div>


            <div class="h-16 w-16 md:block hidden text-blue-600">
                <svg fill="currentColor" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 433.117 433.117" xml:space="preserve">
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
        {{-- <h2 class="text-2xl font-bold text-blue-700">Status</h2> --}}

        <div class="overflow-x-auto   h-96 mt-4 rounded-sm md:border-b shadow-md md:shadow-none">
            <table class="w-full bg-white border-collapse    ">
                <thead class="bg-gray-200  sticky top-0 z-50">
                    <tr>
                        <td class="px-4 py-2    font-semibold whitespace-nowrap tracking-wider text-gray-800">
                            Item Code</td>
                        <td class="px-4 py-2   font-semibold whitespace-nowrap tracking-wider text-gray-800">
                            Item </td>
                        {{-- <td class="px-4 py-2  border-b border-gray-800  font-semibold   tracking-wider text-gray-800">
                            Quantity</td>
                        <td class="px-4 py-2  border-b border-gray-800   font-semibold  tracking-wider text-gray-800">Unit
                        </td> --}}
                        <td class="px-4 py-2    font-semibold  tracking-wider whitespace-nowrap text-gray-800">
                            Condition upon Delivery</td>
                        <td class="px-4 py-2    font-semibold  tracking-wider text-gray-800">Brand
                        </td>
                        <td class="px-4 py-2      font-semibold  tracking-wider text-gray-800">Serial
                        </td>
                        <td class="px-4 py-2     font-semibold  tracking-wider text-gray-800">
                            Functional
                        </td>
                        <td class="px-4 py-2    font-semibold   tracking-wider text-gray-800">
                            Recipient</td>
                        <td class="px-4 py-2     font-semibold  tracking-wider  text-gray-800">
                            Warranty</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $index => $item)
                        <tr>
                            {{-- <td class="px-4 py-3 border border-gray-300">{{ $item->pk_dcp_batch_items_id ?? 'N/A' }}</td> --}}

                            <td class="px-4 py-3 border border-gray-300">{{ $item->generated_code ?? 'N/A' }}</td>
                            <td class="px-4 py-3 border border-gray-300">{{ $item->dcpItemType->name ?? 'N/A' }}</td>
                            {{-- <td class="px-4 py-3 border border-gray-300">{{ $item->quantity ?? 'N/A' }}</td>
                            <td class="px-4 py-3 border border-gray-300">{{ $item->unit ?? 'N/A' }}</td> --}}
                            <td class="px-4 py-3 border border-gray-300">{{ $item->dcpCondition->name ?? 'N/A' }}</td>
                            <td class="px-4 py-3 border border-gray-300">{{ $item->brand ?? 'N/A' }}</td>
                            <td class="px-4 py-3 border border-gray-300">{{ $item->serial_number ?? 'N/A' }}</td>
                            <td class="px-4 py-3 border border-gray-300">
                                @if ($item->item_status == 1)
                                    Functional
                                @else
                                    Not Functional
                                @endif
                            </td>
                            <td class="px-4 py-3 border text-center gap-0 ">

                                @php
                                    $assignedCount = \App\Models\DCPItemAssignedUser::where(
                                        'dcp_batch_item_id',
                                        $item->pk_dcp_batch_items_id,
                                    )->count();

                                    $originalClass = $assignedCount > 0 ? 'bg-yellow-400' : 'bg-blue-600';

                                @endphp
                                @php
                                    $type_value_item = \App\Models\DCPItemAssignedUser::where(
                                        'dcp_batch_item_id',
                                        $item->pk_dcp_batch_items_id,
                                    )->value('assignment_type_id');

                                    $name_value_item = \App\Models\DCPItemAssignedUser::where(
                                        'dcp_batch_item_id',
                                        $item->pk_dcp_batch_items_id,
                                    )->value('assigned_user_name');

                                    $locations = \App\Models\DCPItemLocation::all();

                                    $location_value_item = \App\Models\DCPItemAssignedLocation::where(
                                        'dcp_batch_item_id',
                                        $item->pk_dcp_batch_items_id,
                                    )->value('assigned_location_id');
                                @endphp
                                <button type="button"
                                    class="{{ $originalClass }} {{ $originalClass = $assignedCount > 0 ? 'bg-yellow-400' : ' ' }}   rounded border-1 text-white  transform transition duration-300   scale-100 hover:scale-105 px-2 border border-gray-800 px-2   py-1"
                                    onclick="openUserRecipientModal({
                                        pk_dcp_batch_items_id: '{{ $item->pk_dcp_batch_items_id }}',
                                        assigned_user_type_id: '{{ $type_value_item ?? '' }}',
                                        assigned_user_name: '{{ $name_value_item ?? '' }}',
                                        assigned_user_location_id: '{{ $location_value_item ?? '' }}',
                                        isAssigned: {{ $assignedCount > 0 ? 'true' : 'false' }}
                                    })">
                                    {{ $assignedCount > 0 ? 'Edit Recipient ' : 'Add Recipient' }}
                                </button>
                                {{-- <span class="text-red-600 text-lg"
                                    style="text-decoration:none">{{ $assignedCount > 0 ? '' : '*' }}
                                </span> --}}

                            </td>
                            <td class="px-4 py-3 whitespace-nowrap border text-center  ">

                                <a href="{{ route('school.dcp_inventory.items', $item->generated_code) }}"
                                    class="bg-blue-200 text-gray-800 rounded    hover:bg-blue-600 hover:text-white px-2 border border-gray-800   py-1">
                                    Show More
                                </a>
                            </td>
                        </tr>
                        {{-- @php
                            $assignedCount = \App\Models\DCPItemAssignedUser::where(
                                'dcp_batch_item_id',
                                $item->pk_dcp_batch_items_id,
                            )->count();
                            $if_assigned_exists = $assignedCount > 0 ? 'yes' : 'no';
                        @endphp --}}

                        <!-- Hidden form row -->
                        {{-- <tr id="form-row-{{ $index }}" style="display: none;  ">

                            <td colspan="7" class=" h-full  p-0">
                                @if ($if_assigned_exists == 'no')
                                    <form method="POST" action="{{ route('school.assignment.items') }}">
                                        @csrf
                                        @method('POST')


                                        @php
                                            $type_value_item = \App\Models\DCPItemAssignedUser::where(
                                                'dcp_batch_item_id',
                                                $item->pk_dcp_batch_items_id,
                                            )->value('assignment_type_id');

                                            $name_value_item = \App\Models\DCPItemAssignedUser::where(
                                                'dcp_batch_item_id',
                                                $item->pk_dcp_batch_items_id,
                                            )->value('assigned_user_name');

                                            $locations = \App\Models\DCPItemLocation::all();

                                            $location_value_item = \App\Models\DCPItemAssignedLocation::where(
                                                'dcp_batch_item_id',
                                                $item->pk_dcp_batch_items_id,
                                            )->value('assigned_location_id');
                                        @endphp

                                        <input type="hidden" name="pk_dcp_batch_items_id"
                                            value="{{ $item->pk_dcp_batch_items_id }}">

                                        <h2 class="text-lg font-semibold text-blue-600  ">Encode the User Details for
                                            this
                                            Item</h2>
                                        <div class="grid md:grid-cols-4 gap-1 grid-cols-1 gap-0 items-start">
                                            <!-- User Icon -->



                                            <!-- User Type -->
                                            <div class="w-full h-full border border-gray-800 px-6 py-4 bg-blue-200">
                                                <label class="block text-sm font-medium text-gray-700 mb-1">User Type <span
                                                        class="text-red-600">*</span></label>
                                                <select name="assigned_user_type_id"
                                                    class="w-full border border-gray-800 rounded px-3 py-2" required>
                                                    <option value="">Select Type</option>
                                                    @foreach (\App\Models\DCPItemAssignedType::all() as $type)
                                                        <option value="{{ $type->pk_dcp_assignment_types_id }}"
                                                            {{ $type_value_item == $type->pk_dcp_assignment_types_id ? 'selected' : '' }}>
                                                            {{ $type->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- User Name -->
                                            <div class="w-full h-full border border-gray-800 px-6 py-4 bg-yellow-200">
                                                <label class="block text-sm font-medium  text-gray-700 mb-1">Staff/Student
                                                    Name
                                                    <span class="text-red-600">*</span></label>
                                                <input type="text" name="assigned_user_name"
                                                    value="{{ $name_value_item ?? '' }}"
                                                    class="w-full border border-gray-800 rounded px-3 py-2">
                                            </div>

                                            <!-- Assigned Location -->
                                            <div class="w-full h-full border border-gray-800 px-6 py-4 bg-green-200">
                                                <label class="block text-sm font-medium  text-gray-700 mb-1">Assigned
                                                    Location
                                                    <span class="text-red-600">*</span></label>
                                                <select name="assigned_user_location_id"
                                                    class="w-full border border-gray-800 rounded px-3 py-2" required>
                                                    <option value="">Select Location</option>
                                                    @foreach ($locations as $location)
                                                        <option value="{{ $location->pk_dcp_assigned_locations_id }}"
                                                            {{ $location_value_item == $location->pk_dcp_assigned_locations_id ? 'selected' : '' }}>
                                                            {{ $location->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Submit Button -->
                                            <div
                                                class="w-full h-full border border-gray-800 px-6 py-4 bg-white items-center justify-center   ">
                                                <label class="block text-sm font-medium  text-gray-700 mb-1">Save the
                                                    assigned
                                                    user </label>
                                                <button type="submit"
                                                    class="w-full bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                                                    Save User
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                @elseif ($if_assigned_exists == 'yes')
                                    <form action="{{ route('school.assignment.items') }}" method="POST">
                                        @csrf
                                        @method('POST')


                                        @php
                                            $type_value_item = \App\Models\DCPItemAssignedUser::where(
                                                'dcp_batch_item_id',
                                                $item->pk_dcp_batch_items_id,
                                            )->value('assignment_type_id');

                                            $name_value_item = \App\Models\DCPItemAssignedUser::where(
                                                'dcp_batch_item_id',
                                                $item->pk_dcp_batch_items_id,
                                            )->value('assigned_user_name');

                                            $locations = \App\Models\DCPItemLocation::all();

                                            $location_value_item = \App\Models\DCPItemAssignedLocation::where(
                                                'dcp_batch_item_id',
                                                $item->pk_dcp_batch_items_id,
                                            )->value('assigned_location_id');
                                        @endphp

                                        <input type="hidden" name="pk_dcp_batch_items_id"
                                            value="{{ $item->pk_dcp_batch_items_id }}">

                                        <h2 class="text-lg font-semibold text-blue-600  ">This item has already
                                            been
                                            assigned. You can update the user details below.</h2>
                                        <div class="grid md:grid-cols-4 grid-cols-1 gap-1 items-start">
                                            <!-- User Type -->

                                            <div class="w-full h-full border border-gray-800 px-6 py-4 bg-blue-200">
                                                <label class="block text-sm font-medium text-gray-700 mb-1">User Type <span
                                                        class="text-red-600">*</span></label>
                                                <select name="assigned_user_type_id"
                                                    class="w-full border border-gray-800 rounded px-3 py-2" required>
                                                    <option value="">Select Type</option>
                                                    @foreach (\App\Models\DCPItemAssignedType::all() as $type)
                                                        <option value="{{ $type->pk_dcp_assignment_types_id }}"
                                                            {{ $type_value_item == $type->pk_dcp_assignment_types_id ? 'selected' : '' }}>
                                                            {{ $type->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- User Name -->
                                            <div class="w-full h-full border border-gray-800 px-6 py-4 bg-yellow-200">
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Staff/Student
                                                    Name
                                                    <span class="text-red-600">*</span></label>
                                                <input type="text" name="assigned_user_name"
                                                    value="{{ $name_value_item ?? '' }}"
                                                    class="w-full border border-gray-800 rounded px-3 py-2">
                                            </div>

                                            <!-- Assigned Location -->
                                            <div class="w-full h-full border border-gray-800 px-6 py-4 bg-green-200">
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Assigned
                                                    Location
                                                    <span class="text-red-600">*</span></label>
                                                <select name="assigned_user_location_id"
                                                    class="w-full border border-gray-800 rounded px-3 py-2" required>
                                                    <option value="">Select Location</option>
                                                    @foreach ($locations as $location)
                                                        <option value="{{ $location->pk_dcp_assigned_locations_id }}"
                                                            {{ $location_value_item == $location->pk_dcp_assigned_locations_id ? 'selected' : '' }}>
                                                            {{ $location->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Update Button -->
                                            <div class="w-full h-full border border-gray-800 px-6 py-4 bg-white">
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Update the
                                                    Details</label>
                                                <button type="submit"
                                                    class="w-full border border-gray-800 bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                                                    Update User
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            </td>

                        </tr> --}}
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- User Recipient Modal -->
        <div id="user-recipient-modal-overlay"
            class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden px-5">
            <div id="user-recipient-modal" class="bg-white rounded-lg shadow-xl   px-5 py-2 w-full mx-5 max-w-2xl relative">
                <button type="button" onclick="closeUserRecipientModal()"
                    class="absolute top-2 right-4 text-gray-500 hover:text-gray-700 text-2xl  font-bold">&times;</button>
                <h2 id="user-recipient-modal-title" class="text-2xl font-bold   mt-2 text-blue-700"></h2>
                <div class="text-md text-gray-600 mb-2 ">User Recipient Details for the item</div>
                <form id="user-recipient-form" method="POST" action="{{ route('school.assignment.items') }}">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="pk_dcp_batch_items_id" id="modal_pk_dcp_batch_items_id">
                    <div class="grid md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">User Type <span
                                    class="text-red-600">*</span></label>
                            <select name="assigned_user_type_id" id="modal_assigned_user_type_id"
                                class="w-full border border-gray-300 rounded px-3 py-1" required>
                                <option value="">Select Type</option>
                                @foreach (\App\Models\DCPItemAssignedType::all() as $type)
                                    <option value="{{ $type->pk_dcp_assignment_types_id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Staff/Student Name <span
                                    class="text-red-600">*</span></label>
                            <input type="text" name="assigned_user_name" id="modal_assigned_user_name"
                                class="w-full border border-gray-300 rounded px-3 py-1" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Assigned Location <span
                                    class="text-red-600">*</span></label>
                            <select name="assigned_user_location_id" id="modal_assigned_user_location_id"
                                class="w-full border border-gray-300 rounded px-3 py-1" required>
                                <option value="">Select Location</option>
                                @foreach (\App\Models\DCPItemLocation::all() as $location)
                                    <option value="{{ $location->pk_dcp_assigned_locations_id }}">{{ $location->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mt-4 flex justify-end gap-2  ">
                        <button type="submit" class="bg-blue-600 w-40 text-white px-4 py-1 rounded hover:bg-blue-700">Save
                            Information</button>
                        <button type="button" onclick="closeUserRecipientModal()"
                            class="bg-gray-400 w-40 text-white px-4 py-1 rounded hover:bg-gray-600">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function openUserRecipientModal(item) {
            // Set modal title
            document.getElementById('user-recipient-modal-title').innerText = item.isAssigned ? 'Edit Recipient ' :
                'Add/Assign Recipient ';

            // Set form values
            if (item.isAssigned) {
                document.getElementById('modal_assigned_user_type_id').value = item.assigned_user_type_id || '';
                document.getElementById('modal_pk_dcp_batch_items_id').value = item.pk_dcp_batch_items_id || '';

                document.getElementById('modal_assigned_user_name').value = item.assigned_user_name || '';
                document.getElementById('modal_assigned_user_location_id').value = item.assigned_user_location_id || '';
            } else {

                document.getElementById('modal_pk_dcp_batch_items_id').value = item.pk_dcp_batch_items_id || '';
                document.getElementById('modal_assigned_user_type_id').value = item.assigned_user_type_id || '';
                document.getElementById('modal_assigned_user_name').value = item.assigned_user_name || '';
                document.getElementById('modal_assigned_user_location_id').value = item.assigned_user_location_id || '';
            }
            document.body.classList.add('overflow-hidden');
            // Show modal
            document.getElementById('user-recipient-modal-overlay').classList.remove('hidden');
        }

        function closeUserRecipientModal() {
            document.body.classList.remove('overflow-hidden');
            document.getElementById('user-recipient-modal-overlay').classList.add('hidden');
            document.getElementById('user-recipient-form').reset();
        }
    </script>
    {{-- <script>
        let activeIndex = null;

        function toggleForm(index) {
            const row = document.getElementById(`form-row-${index}`);
            const btn = document.getElementById(`assign-btn-${index}`);
            const originalClass = btn.getAttribute('data-original-class');

            // Close previous active form if different
            if (activeIndex !== null && activeIndex !== index) {
                const prevRow = document.getElementById(`form-row-${activeIndex}`);
                const prevBtn = document.getElementById(`assign-btn-${activeIndex}`);
                if (prevRow) prevRow.style.display = 'none';
                if (prevBtn) {
                    prevBtn.classList.remove('text-gray-700');
                    prevBtn.classList.add(prevBtn.getAttribute('data-original-class'));
                    prevBtn.innerText = " User Recipient";
                }
            }

            // Toggle current form row
            const isHidden = row.style.display === 'none';

            if (isHidden) {
                row.style.display = 'table-row';
                btn.classList.remove(originalClass);

                btn.classList.add('font-bold'); // ✅ Always gray when active

                btn.innerText = "Cancel";
                activeIndex = index;
            } else {
                row.style.display = 'none';

                btn.classList.remove('font-bold');
                btn.classList.add(originalClass); // ✅ Back to original (green/blue)
                btn.innerText = "About User Recipient";
                activeIndex = null;
            }
        }
    </script> --}}
@endsection
