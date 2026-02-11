  <div id="user-recipient-modal-overlay" class="modal hidden">
      <div id="user-recipient-modal" class="modal-content small-modal">
          <div class="flex flex-col items-center justify-center ">


              <div
                  class="h-16 w-16 bg-white p-3 border border-gray-300 shadow-lg rounded-full flex items-center justify-center">
                  <div id="logo-modal" class="text-white   p-2 rounded-full">
                      <svg class="w-10 h-10" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                          <path d="M12 3L3 8V16L12 21L21 16V8L12 3Z" stroke-linecap="round" stroke-linejoin="round" />
                          <path d="M3.5 7.8L12 12.5L20.5 7.8" stroke-linecap="round" stroke-linejoin="round" />
                          <path d="M12 12.5V21" stroke-linecap="round" stroke-linejoin="round" />
                      </svg>
                  </div>
              </div>
              <div class="w-full flex flex-col justify-center">

                  <div id="user-recipient-modal-title" class="page-title text-center">
                  </div>

                  <div class="page-subtitle text-center">User Recipient Details for the Product
                  </div>
              </div>
          </div>
          <form id="user-recipient-form" method="POST" action="{{ route('school.assignment.items') }}">
              @csrf
              @method('POST')
              <input type="hidden" name="pk_dcp_batch_items_id" id="modal_pk_dcp_batch_items_id">
              <div class="grid  grid-cols-1 gap-4">
                  <div>
                      <label class="form-label">User Type <span class="text-red-600">*</span></label>
                      <select name="assigned_user_type_id" id="modal_assigned_user_type_id" class="form-input" required>
                          <option value="">Select Type</option>
                          @foreach (\App\Models\DCPItemAssignedType::all() as $type)
                              <option value="{{ $type->pk_dcp_assignment_types_id }}">{{ $type->name }}</option>
                          @endforeach
                      </select>
                  </div>
                  <div>
                      <label class="form-label">Staff/Student Name <span class="text-red-600">*</span></label>
                      <input type="text" name="assigned_user_name" id="modal_assigned_user_name" class="form-input"
                          required>
                  </div>
                  <div>
                      <label class="block form-label">Assigned Location <span class="text-red-600">*</span></label>
                      <select name="assigned_user_location_id" id="modal_assigned_user_location_id" class="form-input"
                          required>
                          <option value="">Select Location</option>
                          @foreach (\App\Models\DCPItemLocation::all() as $location)
                              <option value="{{ $location->pk_dcp_assigned_locations_id }}">{{ $location->name }}
                              </option>
                          @endforeach
                      </select>
                  </div>
              </div>
              <div class="mt-4 flex md:justify-center justify-center gap-2  ">

                  <button type="button" onclick="closeUserRecipientModal()"
                      class="btn-cancel  w-full py-1 px-4 rounded">
                      Cancel
                  </button>
                  <button type="submit" id="button-modal" class="  w-full  py-1 px-4 rounded">
                      Save Information
                  </button>

              </div>

          </form>
      </div>
  </div>
