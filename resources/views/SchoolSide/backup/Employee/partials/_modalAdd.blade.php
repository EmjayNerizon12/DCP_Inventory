 <div id="add-employee-modal" class="modal hidden">
     <div class="modal-content super-large-modal thin-scroll">
         <form action="{{ route('schools.employee.store') }}" method="POST" enctype="multipart/form-data">
             @csrf
             @method('POST')
             <div class="flex flex-col items-center justify-center gap-2">


                 <div
                     class="h-16 w-16 bg-white p-3 border border-gray-300 shadow-lg rounded-full flex items-center justify-center">
                     <div class="text-white bg-blue-600 p-2 rounded-full">
                         <svg class="w-10 h-10" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve"
                             fill="currentColor">
                             <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                             <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                             <g id="SVGRepo_iconCarrier">

                                 <g>
                                     <path class="st0"
                                         d="M256.008,411.524c54.5,0,91.968-7.079,92.54-13.881c2.373-28.421-34.508-43.262-49.381-48.834 c-7.976-2.984-19.588-11.69-19.588-17.103c0-3.587,0-8.071,0-14.214c4.611-5.119,8.095-15.532,10.183-27.317 c4.857-1.738,7.627-4.524,11.095-16.65c3.69-12.93-5.548-12.5-5.548-12.5c7.468-24.715-2.357-47.944-18.825-46.246 c-11.358-19.857-49.397,4.54-61.31,2.841c0,6.818,2.834,11.92,2.834,11.92c-4.143,7.882-2.548,23.564-1.389,31.485 c-0.667,0-9.016,0.079-5.468,12.5c3.452,12.126,6.23,14.912,11.088,16.65c2.079,11.786,5.571,22.198,10.198,27.317 c0,6.143,0,10.627,0,14.214c0,5.413-12.35,14.548-19.611,17.103c-14.953,5.262-51.746,20.413-49.373,48.834 C164.024,404.444,201.491,411.524,256.008,411.524z">
                                     </path>
                                     <path class="st0"
                                         d="M404.976,56.889h-75.833v16.254c0,31.365-25.524,56.889-56.889,56.889h-32.508 c-31.366,0-56.889-25.524-56.889-56.889V56.889h-75.834c-25.444,0-46.071,20.627-46.071,46.071v362.969 c0,25.444,20.627,46.071,46.071,46.071h297.952c25.445,0,46.072-20.627,46.072-46.071V102.96 C451.048,77.516,430.421,56.889,404.976,56.889z M402.286,463.238H109.714V150.349h292.572V463.238z">
                                     </path>
                                     <path class="st0"
                                         d="M239.746,113.778h32.508c22.405,0,40.635-18.23,40.635-40.635V40.635C312.889,18.23,294.659,0,272.254,0 h-32.508c-22.406,0-40.635,18.23-40.635,40.635v32.508C199.111,95.547,217.341,113.778,239.746,113.778z M231.619,40.635 c0-4.492,3.634-8.127,8.127-8.127h32.508c4.492,0,8.127,3.635,8.127,8.127v16.254c0,4.492-3.635,8.127-8.127,8.127h-32.508 c-4.493,0-8.127-3.635-8.127-8.127V40.635z">
                                     </path>
                                 </g>
                             </g>
                         </svg>
                     </div>
                 </div>
                 <div class="w-full text-center">

                     <div class="page-title">Employee Information</div>
                     <div class="page-subtitle">Encode the information needed for the employee</div>
                 </div>
             </div>

             <div class="grid md:grid-cols-3 grid-cols-1 gap-4 mb-4">
                 <div class="md:col-span-3 col-span-1 text-lg font-semibold ">
                     Basic Information
                     <hr>
                 </div>
                 {{-- Basic Info --}}
                 <div class="md:col-span-3 col-span-1">
                     <div class="relative inline-block group">
                         <!-- Profile Image -->
                         <div class="shadow-md p-1 border border-gray-300 rounded-full">
                             <img id="schoolPreview" class="md:w-40 md:h-40 h-20 w-20 rounded-full object-cover"
                                 src="{{ asset('icon/profile.png') }}" alt="Profile Photo">
                         </div>


                         <div id="camera-button"
                             class="absolute bottom-2 right-2
                            text-white p-2 
                             h-12 w-12 bg-white p-1
                            border border-gray-300 
                            shadow-md rounded-full flex items-center justify-center">

                             <button type="button" onclick="document.getElementById('schoolImageInput').click()"
                                 class="text-white bg-gray-600 hover:bg-gray-700 p-1 rounded-full">
                                 <svg class="w-8 h-8" fill="currentColor" viewBox="0 -2 28 28"
                                     xmlns="http://www.w3.org/2000/svg">
                                     <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                     <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                     <g id="SVGRepo_iconCarrier">
                                         <path
                                             d="m13.846 9.692c2.293.004 4.15 1.862 4.154 4.154v.004c0 2.294-1.86 4.154-4.154 4.154s-4.154-1.86-4.154-4.154c0-1.148.466-2.187 1.218-2.939.728-.753 1.747-1.22 2.876-1.22h.063-.003zm10.154-6h.055c1.002 0 1.908.414 2.554 1.081l.001.001c.668.647 1.082 1.553 1.082 2.555v.058-.003 12.924c-.001 2.039-1.653 3.691-3.692 3.692h-20.308c-2.039-.001-3.691-1.653-3.692-3.692v-12.923c0-.016 0-.036 0-.055 0-1.002.414-1.908 1.081-2.554l.001-.001c.647-.668 1.553-1.082 2.555-1.082h.058-.003 3.23l.735-1.962c.212-.507.557-.922.993-1.213l.01-.006c.411-.311.929-.501 1.49-.512h.002 7.385c.564.011 1.081.201 1.499.517l-.006-.005c.445.297.791.712.996 1.201l.007.018.735 1.962zm-10.154 16.616c.027 0 .059.001.091.001 1.755 0 3.341-.727 4.472-1.896l.002-.002c1.171-1.133 1.897-2.719 1.897-4.474 0-.032 0-.064-.001-.096v.005c0-.027.001-.06.001-.092 0-1.755-.727-3.341-1.896-4.472l-.002-.002c-1.167-1.172-2.781-1.897-4.565-1.897s-3.398.725-4.565 1.896c-1.171 1.133-1.897 2.719-1.897 4.474 0 .032 0 .064.001.096v-.005c0 .028-.001.061-.001.094 0 1.755.726 3.34 1.894 4.471l.002.002c1.133 1.171 2.719 1.897 4.474 1.897.033 0 .065 0 .097-.001h-.005z">
                                         </path>
                                     </g>
                                 </svg>
                             </button>

                         </div>

                         <!-- Hidden File Input -->
                         <input type="file" name="image_path" id="schoolImageInput" class="hidden" accept="image/*">

                         <!-- Action Buttons -->
                         <div id="imageActions" class="hidden mt-3 flex justify-center gap-2">
                             <button type="button" onclick="cancelImage()"
                                 class="px-3 py-1 text-sm shadow font-medium text-gray-600 border border-gray-300 rounded hover:bg-gray-100">
                                 Remove
                             </button>
                         </div>
                     </div>
                     <script>
                         let selectedFile = null;
                         const originalSrc = document.getElementById('schoolPreview').src;

                         document.getElementById('schoolImageInput').addEventListener('change', function(e) {
                             selectedFile = e.target.files[0];
                             if (!selectedFile) return;

                             const reader = new FileReader();
                             reader.onload = function(e) {
                                 document.getElementById('schoolPreview').src = e.target.result;
                             };
                             reader.readAsDataURL(selectedFile);

                             document.getElementById('imageActions').classList.remove('hidden');
                             document.getElementById('camera-button').classList.add('hidden');
                         });

                         function cancelImage() {
                             document.getElementById('schoolPreview').src = originalSrc;
                             document.getElementById('schoolImageInput').value = '';
                             document.getElementById('imageActions').classList.add('hidden');
                             selectedFile = null;
                             document.getElementById('camera-button').classList.remove('hidden');

                         }
                     </script>

                 </div>
                 <div>
                     <label for="fname">First Name <span class="text-red-600">(required)</span></label>
                     <input type="text" name="fname" required
                         class="w-full border border-gray-400 rounded px-2 py-1">
                 </div>
                 <div>
                     <label for="mname">Middle Name</label>
                     <input type="text" name="mname" class="w-full border border-gray-400 rounded px-2 py-1">
                 </div>
                 <div>
                     <label for="lname">Last Name <span class="text-red-600">(required)</span></label>
                     <input type="text" name="lname" required
                         class="w-full border border-gray-400 rounded px-2 py-1">
                 </div>

                 <div>
                     <label for="suffix_name">Suffix</label>
                     <select name="suffix_name" class="w-full border border-gray-400 rounded px-2 py-1">
                         <option value="">Select</option>
                         <option value="Sr.">Sr.</option>
                         <option value="Jr.">Jr.</option>
                         <option value="II">II </option>
                         <option value="III">III </option>
                         <option value="IV">IV </option>
                         <option value="V">V </option>
                         <option value="VI">VI </option>
                         <option value="VII">VII </option>
                     </select>
                 </div>
                 <div>
                     <label for="sex">Sex <span class="text-red-600">(required)</span></label>
                     <select name="sex" required class="w-full border border-gray-400 rounded px-2 py-1">
                         <option value="">Select</option>
                         <option value="M">Male</option>
                         <option value="F">Female</option>
                     </select>
                 </div>
                 <div>
                     <label for="birthdate">Birthdate <span class="text-red-600">(required)</span></label>
                     <input type="date" required name="birthdate"
                         class="w-full border border-gray-400 rounded px-2 py-1">
                 </div>
                 <div class="md:col-span-3 col-span-1 text-lg font-semibold ">
                     Employee Information
                     <hr>
                 </div>
                 <div>
                     <label for="employee_number">Employee Number <span class="text-red-600">(required)</span></label>
                     <input type="text" name="employee_number" required
                         class="w-full border border-gray-400 rounded px-2 py-1">
                 </div>
                 <div>
                     <label for="position_title_id">Employee Title</label>
                     <select name="position_title_id" class="w-full border border-gray-400 rounded px-2 py-1"
                         required>
                         <option value="">Select</option>
                         @foreach (App\Models\EmployeePosition::all() as $position)
                             <option value="{{ $position->pk_school_position_id }}">{{ $position->name }}</option>
                         @endforeach
                     </select>
                 </div>
                 <div>
                     <label for="position_id">Employee Position</label>
                     <select name="position_id" class="w-full border border-gray-400 rounded px-2 py-1">
                         <option value="">Select</option>
                         @foreach (App\Models\EmpPosition::all() as $position)
                             <option value="{{ $position->id }}">{{ $position->name }}</option>
                         @endforeach
                     </select>
                 </div>
                 <div>
                     <label for="date_hired">Date Hired</label>
                     <input type="date" name="date_hired" class="w-full border border-gray-400 rounded px-2 py-1">
                 </div>

                 <div>
                     <label for="salary_grade">Salary Grade <span class="text-red-600">(required)</span></label>
                     <input type="text" name="salary_grade" required
                         class="w-full border border-gray-400 rounded px-2 py-1">
                 </div>
                 <div class="hidden">
                     <label for="school_id">School Designated</label>
                     <input type="text" name="school_id"
                         value="{{ Auth::guard('school')->user()->school->pk_school_id }}" readonly
                         class="w-full border border-gray-400 rounded px-2 py-1 cursor-not-allowed">
                 </div>
                 <div>
                     <label for="deped_email">Deped Email <span class="text-red-600">(required)</span></label>
                     <input type="email" name="deped_email" required
                         class="w-full border border-gray-400 rounded px-2 py-1">
                 </div>
                 <div>
                     <label for="personal_email_address">Personal Email</label>
                     <input type="email" name="personal_email_address"
                         class="w-full border border-gray-400 rounded px-2 py-1">
                 </div>
                 <div>
                     <label for="mobile_no_1">Mobile No 1</label>
                     <input type="text" name="mobile_no_1"
                         class="w-full border border-gray-400 rounded px-2 py-1">
                 </div>
                 <div>
                     <label for="mobile_no_2">Mobile No 2</label>
                     <input type="text" name="mobile_no_2"
                         class="w-full border border-gray-400 rounded px-2 py-1">
                 </div>

                 <div class="md:col-span-3 col-span-1 text-lg font-semibold ">
                     Statuses
                     <hr>
                 </div>

                 <div>
                     <label for="deped_email_status">Deped Email Status <span
                             class="text-red-600">(required)</span></label>
                     <select name="deped_email_status" required
                         class="w-full border border-gray-400 rounded px-2 py-1">
                         <option value="">Select</option>
                         <option value="Active">Active</option>
                         <option value="Inactive">Inactive</option>
                     </select>
                 </div>
                 <div>
                     <label for="m365_email_status">M365 Email Status <span
                             class="text-red-600">(required)</span></label>
                     <select name="m365_email_status" required
                         class="w-full border border-gray-400 rounded px-2 py-1">
                         <option value="">Select</option>
                         <option value="Active">Active</option>
                         <option value="Inactive">Inactive</option>
                     </select>
                 </div>
                 <div>
                     <label for="canva_login_status">Canva Login Status <span
                             class="text-red-600">(required)</span></label>
                     <select name="canva_login_status" required
                         class="w-full border border-gray-400 rounded px-2 py-1">
                         <option value="">Select</option>
                         <option value="Active">Active</option>
                         <option value="Inactive">Inactive</option>
                     </select>
                 </div>

                 <div>
                     <label for="lr_portal_status">LR Portal Status <span
                             class="text-red-600">(required)</span></label>
                     <select name="lr_portal_status" required class="w-full border border-gray-400 rounded px-2 py-1">
                         <option value="">Select</option>
                         <option value="Active">Active</option>
                         <option value="Inactive">Inactive</option>
                     </select>
                 </div>
                 <div>
                     <label for="l4t_recipient">L4T Recipient <span class="text-red-600">(required)</span></label>
                     <select name="l4t_recipient" required class="w-full border border-gray-400 rounded px-2 py-1">
                         <option value="">Select</option>
                         <option value="Yes">Yes</option>
                         <option value="No">No</option>
                     </select>
                 </div>
                 <div>
                     <label for="smart_tv_recipient">Smart TV Recipient <span
                             class="text-red-600">(required)</span></label>
                     <select name="smart_tv_recipient" required
                         class="w-full border border-gray-400 rounded px-2 py-1">
                         <option value="">Select</option>
                         <option value="Yes">Yes</option>
                         <option value="No">No</option>
                     </select>
                 </div>

                 <div>
                     <label for="l4nt_recipient">L4NT Recipient <span class="text-red-600">(required)</span></label>
                     <select name="l4nt_recipient" required class="w-full border border-gray-400 rounded px-2 py-1">
                         <option value="">Select</option>
                         <option value="Yes">Yes</option>
                         <option value="No">No</option>
                     </select>
                 </div>

                 <div class="md:col-span-3 col-span-1 text-lg font-semibold ">
                     Other Information (if Applicable)
                     <hr>
                 </div>
                 <div>
                     <label for="ro_office_id">RO Office</label>
                     <select name="ro_office_id" class="w-full border border-gray-400 rounded px-2 py-1">
                         <option value="">Select</option>
                         @foreach (App\Models\EmpROOffice::all() as $ro)
                             <option value="{{ $ro->id }}">{{ $ro->name }}</option>
                         @endforeach
                     </select>
                 </div>
                 <div>
                     <label for="sdo_office_id">SDO Office</label>
                     <select name="sdo_office_id" class="w-full border border-gray-400 rounded px-2 py-1">
                         <option value="">Select</option>
                         @foreach (App\Models\EmpSDOOffice::all() as $sdo)
                             <option value="{{ $sdo->id }}">{{ $sdo->name }}</option>
                         @endforeach
                     </select>
                 </div>
                 <div>
                     <label for="officer_in_charge">Officer in Charge <span
                             class="text-red-600">(required)</span></label>
                     <select name="officer_in_charge" required
                         class="w-full border border-gray-400 rounded px-2 py-1">
                         <option value="">Select</option>
                         <option value="0">No</option>
                         <option value="1">Yes</option>
                     </select>
                 </div>


                 <div>
                     <label for="inactive">Inactive <span class="text-red-600">(required)</span></label>
                     <select name="inactive" required class="w-full border border-gray-400 rounded px-2 py-1">
                         <option value="">Select</option>
                         <option value="0">No</option>
                         <option value="1">Yes</option>
                     </select>
                 </div>
                 <div>
                     <label for="date_of_separation">Date of Separation</label>
                     <input type="date" name="date_of_separation"
                         class="w-full border border-gray-400 rounded px-2 py-1">
                 </div>
                 <div>
                     <label for="cause_of_separation_id">Cause of Separation</label>
                     <select name="cause_of_separation_id" class="w-full border border-gray-400 rounded px-2 py-1">
                         <option value="">Select</option>
                         @foreach (App\Models\EmpCauseOfSeparation::all() as $cause)
                             <option value="{{ $cause->id }}">{{ $cause->name }}</option>
                         @endforeach
                     </select>
                 </div>
                 <div>
                     <label for="non_deped_fund">Non Deped Fund</label>
                     <select name="non_deped_fund" class="w-full border border-gray-400 rounded px-2 py-1">
                         <option value="">Select</option>
                         <option value="0">No</option>
                         <option value="1">Yes</option>
                     </select>
                 </div>

                 <div>
                     <label for="sources_of_fund_id">Source of Fund</label>
                     <select name="sources_of_fund_id" class="w-full border border-gray-400 rounded px-2 py-1">
                         <option value="">Select</option>
                         @foreach (App\Models\EmpSourceOfFund::all() as $fund)
                             <option value="{{ $fund->id }}">{{ $fund->name }}</option>
                         @endforeach
                     </select>
                 </div>

                 <div>
                     <label for="detailed_transfer_from">Detailed Transfer From</label>
                     <input type="text" name="detailed_transfer_from"
                         class="w-full border border-gray-400 rounded px-2 py-1">
                 </div>
                 <div>
                     <label for="detailed_transfer_to">Detailed Transfer To</label>
                     <input type="text" name="detailed_transfer_to"
                         class="w-full border border-gray-400 rounded px-2 py-1">
                 </div>

             </div>

             <div class="flex md:justify-end justify-center gap-2  ">
                 <button type="button" onclick="closeModal()"
                     class="md:w-auto w-full rounded px-4 py-1 btn-cancel ">Cancel</button>
                 <button type="submit" class=" md:w-auto w-full py-1 px-4 rounded btn-submit">Save
                     Employee</button>
             </div>
         </form>
     </div>
 </div>
