      <div id="school-data-form_update" class="modal hidden  ">
          <div class="modal-content  medium-modal p-6">

              <div class="text-blue-600 text-2xl font-bold mb-4">Update School Data Form</div>
              <form id="school-data-form_update" method="POST" action="{{ route('school.update.schooldata') }}">
                  @csrf
                  @method('PUT')

                  <input type="hidden" id="pk" name="pk">
                  <div class="grid grid-cols-1  gap-4">
                      <div>
                          <label class="font-semibold">Grade Level <span class="text-red-500">*</span></label>
                          <select name="GradeLevelID" id="GradeLevelID" class="w-full border rounded px-2 py-1"
                              required>

                              <option value="">-- Select Grade Level --</option>
                              @foreach ($gradeLevels as $level)
                                  <option value="{{ $level['id'] }}"
                                      {{ in_array($level['id'], $submittedGradeLevels ?? []) ? 'disabled' : '' }}>
                                      {{ $level['name'] }}
                                  </option>
                              @endforeach
                          </select>
                      </div>
                      <div>
                          <label class="font-normal">Total Number of <b>Registered Learners</b> </label>
                          <input type="number" name="RegisteredLearners" id="RegisteredLearners" min="0"
                              class="w-full border  border-gray-300 rounded px-2 py-1" required>
                      </div>
                      <div>
                          <label class="font-normal">Total Number of <b>Teachers</b></label>
                          <input type="number" name="Teachers" id="Teachers" min="0"
                              class="w-full border border-gray-300  rounded px-2 py-1" required>
                      </div>
                      <div>
                          <label class="font-normal">Total Number of <b>Sections</b></label>
                          <input type="number" name="Sections" id="Sections" min="0"
                              class="w-full border border-gray-300  rounded px-2 py-1" required>
                      </div>
                      <div>
                          <label class="font-normal"> Total Number of <b>Classrooms</b></label>
                          <input type="number" name="Classrooms" id="Classrooms" min="0"
                              class="w-full border border-gray-300 rounded px-2 py-1" required>
                      </div>

                  </div>
                  <input type="hidden" name="pk_school_id"
                      value="{{ Auth::guard('school')->user()->school->pk_school_id }}">
                  <div class="mt-6 text-right flex justify-end gap-2">
                      <button type="submit"
                          class="px-6 py-2 bg-blue-600 text-white rounded tracking-wider font-medium shadow  hover:bg-blue-700 transition">Update
                          Data</button>
                      <button type="button"
                          class="px-6 py-2 bg-gray-400 text-white  rounded tracking-wider font-medium shadow  hover:bg-gray-600"
                          onclick="closeEditModal()">Cancel</button>
                  </div>
              </form>

          </div>

      </div>
