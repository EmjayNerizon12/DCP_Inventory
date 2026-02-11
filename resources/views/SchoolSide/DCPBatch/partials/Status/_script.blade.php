   <script>
       function openUserRecipientModal(item) {
           // Set modal title
           document.getElementById('user-recipient-modal-title').innerText = item.isAssigned ? 'Edit Recipient ' :
               'Add/Assign Recipient ';
           if (item.isAssigned) {

               document.getElementById('logo-modal').classList.add('bg-green-600')
               document.getElementById('logo-modal').classList.remove('bg-blue-600')
               document.getElementById('button-modal').classList.add('btn-green')
               document.getElementById('button-modal').classList.remove('btn-submit')
           } else {
               document.getElementById('logo-modal').classList.add('bg-blue-600')
               document.getElementById('logo-modal').classList.remove('bg-green-600')
               document.getElementById('button-modal').classList.add('btn-submit')
               document.getElementById('button-modal').classList.remove('btn-green')
           }
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
