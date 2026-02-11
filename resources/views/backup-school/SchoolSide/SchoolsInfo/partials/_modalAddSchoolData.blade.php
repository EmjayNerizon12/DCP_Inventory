        <div id="add-schooldata-modal" class="modal  hidden">
            <div class="modal-content medium-modal p-6">
                <div class="flex flex-col   w-full ">


                    <form id="school-data-form" method="POST" action="{{ route('school.submit.schooldata') }}">
                        @csrf
                        <div class="grid grid-cols-1   gap-4">
                            <div class="flex justify-between">
                                <div>
                                    <h3 class="text-2xl font-semibold text-blue-700 ">Submit School Data</h3>
                                    <div class="text-gray-500 mb-4 text-sm">Encode your school data here</div>
                                </div>

                            </div>
                            <div>
                                <label class="font-semibold">Grade Level <span class="text-red-500">*</span></label>
                                <select name="GradeLevelID" class="w-full border rounded px-2 py-1" required>
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
                                <input type="number" name="RegisteredLearners" min="0"
                                    class="w-full border  border-gray-300 rounded px-2 py-1" required>
                            </div>
                            <div>
                                <label class="font-normal">Total Number of <b>Teachers</b></label>
                                <input type="number" name="Teachers" min="0"
                                    class="w-full border border-gray-300  rounded px-2 py-1" required>
                            </div>
                            <div>
                                <label class="font-normal">Total Number of <b>Sections</b></label>
                                <input type="number" name="Sections" min="0"
                                    class="w-full border border-gray-300  rounded px-2 py-1" required>
                            </div>
                            <div>
                                <label class="font-normal"> Total Number of <b>Classrooms</b></label>
                                <input type="number" name="Classrooms" min="0"
                                    class="w-full border border-gray-300 rounded px-2 py-1" required>
                            </div>

                        </div>
                        <input type="hidden" name="pk_school_id"
                            value="{{ Auth::guard('school')->user()->school->pk_school_id }}">
                        <div class="mt-6 text-right">
                            <button type="submit"
                                class="px-6 py-2 bg-blue-600 text-white  rounded tracking-wider font-medium shadow  hover:bg-blue-700 transition">Submit
                                Data</button>
                            <button type="button" onclick="closeAddSchoolData()"
                                class="px-6 py-2 bg-gray-400 text-white  rounded tracking-wider font-medium shadow  hover:bg-gray-500 transition">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
