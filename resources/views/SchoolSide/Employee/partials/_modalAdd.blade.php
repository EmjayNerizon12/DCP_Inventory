 <x-modal id="add-employee-modal" size="extra-large-modal" type="add" icon="employee-sm">
     <form action="{{ route('schools.employee.store') }}" method="POST" enctype="multipart/form-data">
         @csrf
         @method('POST')
         <div class="flex flex-col items-center justify-center gap-2">
             <div class="w-full text-center">

                 <div class="page-title">Employee Information</div>
                 <div class="page-subtitle">Provide the following information</div>
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
                             md:h-12 h-8 md:w-12 w-8 bg-white p-1
                            border border-gray-300 
                            shadow-md rounded-full flex items-center justify-center">

                         <button type="button" onclick="document.getElementById('schoolImageInput').click()"
                             class="text-white bg-gray-600 hover:bg-gray-700 p-1 rounded-full">
                             <svg class="md:w-8 md:h-8 w-4 h-4" fill="currentColor" viewBox="0 -2 28 28"
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
             <!-- Name Fields -->

             <x-input-field type="text" name="fname" label="First Name" :required="true" :edit="false" />
             <x-input-field type="text" name="mname" label="Middle Name" :required="false" :edit="false" />
             <x-input-field type="text" name="lname" label="Last Name" :required="true" :edit="false" />

             <x-select-field name="suffix_name" label="Suffix Name" :options="collect([
                 ['id' => 'Sr.', 'name' => 'Sr.'],
                 ['id' => 'Jr.', 'name' => 'Jr.'],
                 ['id' => 'II', 'name' => 'II'],
                 ['id' => 'III', 'name' => 'III'],
                 ['id' => 'IV', 'name' => 'IV'],
                 ['id' => 'V', 'name' => 'V'],
                 ['id' => 'VI', 'name' => 'VI'],
                 ['id' => 'VII', 'name' => 'VII'],
             ])" :edit="false" valueField="id"
                 textField="name" />

             <!-- Sex & Birthdate -->
             <x-select-field name="sex" label="Sex" :options="collect([['id' => 'M', 'name' => 'Male'], ['id' => 'F', 'name' => 'Female']])" :required="true" :edit="false"
                 valueField="id" textField="name" />
             <x-input-field type="date" name="birthdate" label="Birthdate" :required="true" :edit="false" />
             <div class="md:col-span-3 col-span-1 text-lg font-semibold ">
                 Employee Information
                 <hr>
             </div>
             <x-input-field type="text" name="employee_number" label="Employee Number" :required="true"
                 :edit="false" />
             <x-select-field name="position_title_id" label="Employee Title" :options="App\Models\EmployeePosition::all()" :edit="false"
                 valueField="pk_school_position_id" textField="name" />
             <x-select-field name="position_id" label="Position" :options="App\Models\EmpPosition::all()" :edit="false" valueField="id"
                 textField="name" />
             <x-input-field type="date" name="date_hired" label="Date Hired" :required="false" :edit="false" />
             <x-input-field type="text" name="salary_grade" label="Salary Grade" :required="true"
                 :edit="false" />
             <x-input-field type="email" name="deped_email" label="Deped Email" :required="true"
                 :edit="false" />
             <x-input-field type="email" name="personal_email_address" label="Personal Email" :required="true"
                 :edit="false" />
             <x-input-field type="text" name="mobile_no_1" label="Mobile No. 1" :required="false"
                 :edit="false" />
             <x-input-field type="text" name="mobile_no_2" label="Mobile No. 2" :required="false"
                 :edit="false" />

             <!-- School -->
             <div class="hidden">
                 <label for="school">School Designated</label>
                 <input type="text" name="school" id="school"
                     value="{{ Auth::guard('school')->user()->school->SchoolName }}" readonly
                     class="w-full border border-gray-400 rounded px-2 py-1 cursor-not-allowed">
             </div>
             <div class="md:col-span-3 col-span-1 text-lg font-semibold ">
                 Statuses
                 <hr>
             </div>
             <x-select-field name="deped_email_status" label="DepEd Email Status" :options="collect([['id' => 'Active', 'name' => 'Active'], ['id' => 'Inactive', 'name' => 'Inactive']])"
                 :edit="false" :required="true" valueField="id" textField="name" />

             <x-select-field name="m365_email_status" label="m365 Email Status" :options="collect([['id' => 'Active', 'name' => 'Active'], ['id' => 'Inactive', 'name' => 'Inactive']])" :edit="false"
                 :required="true" valueField="id" textField="name" />
             <x-select-field name="canva_login_status" label="Canva Login Status" :options="collect([['id' => 'Active', 'name' => 'Active'], ['id' => 'Inactive', 'name' => 'Inactive']])"
                 :edit="false" :required="true" valueField="id" textField="name" />
             <x-select-field name="lr_portal_status" label="LR Portal Status" :options="collect([['id' => 'Active', 'name' => 'Active'], ['id' => 'Inactive', 'name' => 'Inactive']])" :edit="false"
                 :required="true" valueField="id" textField="name" />
             <!-- Recipients -->
             <x-select-field name="l4t_recipient" label="L4T Recipient" :options="collect([['id' => 'Yes', 'name' => 'Yes'], ['id' => 'No', 'name' => 'No']])" :edit="false"
                 :required="true" valueField="id" textField="name" />
             <x-select-field name="smart_tv_recipient" label="Smart TV Recipient" :options="collect([['id' => 'Yes', 'name' => 'Yes'], ['id' => 'No', 'name' => 'No']])"
                 :edit="false" :required="true" valueField="id" textField="name" />
             <x-select-field name="l4nt_recipient" label="L4NT Recipient" :options="collect([['id' => 'Yes', 'name' => 'Yes'], ['id' => 'No', 'name' => 'No']])" :edit="false"
                 :required="true" valueField="id" textField="name" />
             <div class="md:col-span-3 col-span-1 text-lg font-semibold ">
                 Other Information (if Applicable)
                 <hr>
             </div>
             <!-- Foreign Keys -->
             <x-select-field name="ro_office_id" label="RO Office" :options="App\Models\EmpROOffice::all()" :edit="false"
                 valueField="id" textField="name" />
             <x-select-field name="sdo_office_id" label="SDO Office" :options="App\Models\EmpSDOOffice::all()" :edit="false"
                 valueField="id" textField="name" />
             <x-select-field name="officer_in_charge" label="Is Officer in Charge?" :options="collect([['id' => '1', 'name' => 'Yes'], ['id' => '0', 'name' => 'No']])"
                 :edit="false" :required="true" valueField="id" textField="name" />
             <!-- Other Fields -->
             <x-select-field name="inactive" label="Is Employee Inactive?" :options="collect([['id' => '1', 'name' => 'Yes'], ['id' => '0', 'name' => 'No']])" :edit="false"
                 :required="true" valueField="id" textField="name" />
             <x-input-field type="date" name="date_of_separation" label="Date of Separation" :edit="false"
                 :required="false" />
             <x-select-field name="cause_of_separation_id" label="Cause of Separation" :options="App\Models\EmpCauseOfSeparation::all()"
                 :edit="false" valueField="id" textField="name" />
             <x-select-field name="non_deped_fund" label="Is Non DepEd Fund?" :options="collect([['id' => '1', 'name' => 'Yes'], ['id' => '0', 'name' => 'No']])" :edit="false"
                 :required="true" valueField="id" textField="name" />
             <x-select-field name="sources_of_fund_id" label="Source of Fund" :options="App\Models\EmpSourceOfFund::all()" :edit="false"
                 valueField="id" textField="name" />
             <x-input-field type="text" name="detailed_transfer_from" label="Detailed Transfer From:"
                 :edit="false" :required="false" />
             <x-input-field type="text" name="detailed_transfer_to" label="Detailed Transfer To:"
                 :edit="false" :required="false" />
         </div>

         <div class="flex md:justify-end justify-center gap-2  ">
             <button type="button" onclick="closeComponentModal('add-employee-modal')"
                 class="md:w-auto w-full rounded px-4 py-1 btn-cancel ">Cancel</button>
             <button type="submit" class=" md:w-auto w-full py-1 px-4 rounded btn-submit">Save
                 Employee</button>
         </div>
     </form>
 </x-modal>
