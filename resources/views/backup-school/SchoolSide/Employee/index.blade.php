  @extends('layout.SchoolSideLayout')
  <title>
      @yield('title', 'DCP Dashboard')</title>

  @section('content')
      <div id="add-employee-modal"
          class="modal inset-0 fixed  overflow-y-auto  bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
          <div class="modal-content bg-white px-4 py-1 mx-5 rounded-md">
              <form action="{{ route('schools.employee.store') }}" method="POST">
                  @csrf
                  @method('POST')

                  <div class="text-2xl font-bold text-gray-700 mt-4">Employee Information</div>
                  <div class="text-md text-gray-600 mb-4">Encode the information needed for the employee</div>

                  <div class="grid md:grid-cols-3 grid-cols-1 gap-4 mb-4 ">
                      <div>
                          <label for="fname">First Name</label>
                          <input type="text" name="fname" class="w-full border border-gray-400 rounded px-2 py-1">
                      </div>
                      <div>
                          <label for="mname">Middle Name</label>
                          <input type="text" name="mname" class="w-full border border-gray-400 rounded px-2 py-1">
                      </div>
                      <div>
                          <label for="lname">Last Name</label>
                          <input type="text" name="lname" class="w-full border border-gray-400 rounded px-2 py-1">
                      </div>
                      <div class="col-span-3 grid grid-cols-3 gap-4">
                          <div>
                              <label for="sex">Sex</label>
                              <select name="sex" class="w-full border border-gray-400 rounded px-2 py-1">
                                  <option value="">Select</option>
                                  <option value="M">Male</option>
                                  <option value="F">Female</option>
                              </select>
                          </div>
                          <div>
                              <label for="birthdate">Birthdate</label>
                              <input type="date" name="birthdate"
                                  class="w-full border border-gray-400 rounded px-2 py-1">
                          </div>

                      </div>
                      <div>
                          <label for="employee_number">Employee Number</label>
                          <input type="text" name="employee_number"
                              class="w-full border border-gray-400 rounded px-2 py-1">
                      </div>
                      <div>
                          <label for="position_title_id">Employee Position Title</label>
                          <select name="position_title_id" class="w-full border border-gray-400 rounded px-2 py-1">
                              <option value="">Select</option>
                              @php
                                  $positions = App\Models\EmployeePosition::all();
                              @endphp
                              @foreach ($positions as $position)
                                  <option value="{{ $position->pk_school_position_id }}">{{ $position->name }}</option>
                              @endforeach
                          </select>
                      </div>
                      <div>
                          <label for="salary_grade">Salary Grade</label>
                          <input type="text" name="salary_grade" class="w-full border border-gray-400 rounded px-2 py-1">
                      </div>


                      <div>
                          <label for="school">School Designated</label>
                          <input type="text" name="school"
                              value="{{ Auth::guard('school')->user()->school->SchoolName }}" readonly
                              class="w-full border border-gray-400 rounded px-2 py-1  cursor-not-allowed ">
                      </div>
                      <div>
                          <label for="deped_email">Deped Email Address</label>
                          <input type="email" name="deped_email" class="w-full border border-gray-400 rounded px-2 py-1">
                      </div>
                      <div>
                          <label for="deped_email_status">Deped Email Status</label>
                          <select name="deped_email_status" class="w-full border border-gray-400 rounded px-2 py-1">
                              <option value="">Select</option>
                              <option value="Active">Active</option>
                              <option value="Inactive">Inactive</option>
                          </select>
                      </div>

                      <div>
                          <label for="m365_email_status">M365 Email Status</label>
                          <select name="m365_email_status" class="w-full border border-gray-400 rounded px-2 py-1">
                              <option value="">Select</option>
                              <option value="Active">Active</option>
                              <option value="Inactive">Inactive</option>
                          </select>
                      </div>
                      <div>
                          <label for="canva_login_status">Canva Login Status</label>
                          <select name="canva_login_status" class="w-full border border-gray-400 rounded px-2 py-1">
                              <option value="">Select</option>
                              <option value="Active">Active</option>
                              <option value="Inactive">Inactive</option>
                          </select>
                      </div>

                      <div>
                          <label for="lr_portal_status">LR Portal Status</label>
                          <select name="lr_portal_status" class="w-full border border-gray-400 rounded px-2 py-1">
                              <option value="">Select</option>
                              <option value="Active">Active</option>
                              <option value="Inactive">Inactive</option>
                          </select>
                      </div>

                      <div>
                          <label for="l4t_recipient">L4T Recipient</label>
                          <select name="l4t_recipient" class="w-full border border-gray-400 rounded px-2 py-1">
                              <option value="">Select</option>
                              <option value="Yes">Yes</option>
                              <option value="No">No</option>
                          </select>
                      </div>
                      <div>
                          <label for="smart_tv_recipient">Smart TV Recipient</label>
                          <select name="smart_tv_recipient" class="w-full border border-gray-400 rounded px-2 py-1">
                              <option value="">Select</option>
                              <option value="Yes">Yes</option>
                              <option value="No">No</option>
                          </select>
                      </div>
                      <div>
                          <label for="l4nt_recipient">L4NT Recipient</label>
                          <select name="l4nt_recipient" class="w-full border border-gray-400 rounded px-2 py-1">
                              <option value="">Select</option>
                              <option value="Yes">Yes</option>
                              <option value="No">No</option>
                          </select>
                      </div>




                  </div>
                  <div>
                      <button type="submit"
                          class="bg-blue-500 hover:bg-blue-700 text-white  py-1 px-4  tracking-wider font-medium rounded shadow ">Save
                          Employee</button>
                      <button type="button" onclick="closeModal()"
                          class="bg-gray-500 hover:bg-gray-700 text-white   py-1 px-4  tracking-wider font-medium rounded shadow ">Cancel</button>
                  </div>
              </form>

          </div>
      </div>
      <div id="edit-employee-modal"
          class="modal inset-0 fixed  overflow-y-auto  bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
          <div class="modal-content bg-white px-4 py-1 mx-5 rounded-md">
              <form action="{{ route('schools.employee.update') }}" method="POST">
                  @csrf
                  @method('PUT')

                  <div class="text-2xl font-bold text-gray-700 mt-4">Editing Employee Information</div>
                  <div class="text-md text-gray-600 mb-4">Update the information needed for the employee</div>
                  <input type="hidden" name="primary_key" id="employee_id">
                  <div class="grid md:grid-cols-3 grid-cols-1 gap-4 mb-4 ">
                      <div>
                          <label for="fname">First Name</label>
                          <input type="text" name="fname" id="fname"
                              class="w-full border border-gray-400 rounded px-2 py-1">
                      </div>
                      <div>
                          <label for="mname">Middle Name</label>
                          <input type="text" name="mname" id="mname"
                              class="w-full border border-gray-400 rounded px-2 py-1">
                      </div>
                      <div>
                          <label for="lname">Last Name</label>
                          <input type="text" name="lname" id="lname"
                              class="w-full border border-gray-400 rounded px-2 py-1">
                      </div>
                      <div class="col-span-3 grid grid-cols-3 gap-4">
                          <div>
                              <label for="sex">Sex</label>
                              <select name="sex" id="sex"
                                  class="w-full border border-gray-400 rounded px-2 py-1">
                                  <option value="">Select</option>
                                  <option value="M">Male</option>
                                  <option value="F">Female</option>
                              </select>
                          </div>
                          <div>
                              <label for="birthdate">Birthdate</label>
                              <input type="date" name="birthdate" id="birthdate"
                                  class="w-full border border-gray-400 rounded px-2 py-1">
                          </div>

                      </div>
                      <div>
                          <label for="employee_number">Employee Number</label>
                          <input type="text" name="employee_number" id="employee_number"
                              class="w-full border border-gray-400 rounded px-2 py-1">
                      </div>
                      <div>
                          <label for="position_title_id">Employee Position Title</label>
                          <select name="position_title_id" id="position_title_id"
                              class="w-full border border-gray-400 rounded px-2 py-1">
                              <option value="">Select</option>
                              @php
                                  $positions = App\Models\EmployeePosition::all();
                              @endphp
                              @foreach ($positions as $position)
                                  <option value="{{ $position->pk_school_position_id }}">{{ $position->name }}</option>
                              @endforeach
                          </select>
                      </div>
                      <div>
                          <label for="salary_grade">Salary Grade</label>
                          <input type="text" name="salary_grade" id="salary_grade"
                              class="w-full border border-gray-400 rounded px-2 py-1">
                      </div>


                      <div>
                          <label for="school">School Designated</label>
                          <input type="text" name="school" id="school"
                              value="{{ Auth::guard('school')->user()->school->SchoolName }}" readonly
                              class="w-full border border-gray-400 rounded px-2 py-1  cursor-not-allowed ">
                      </div>
                      <div>
                          <label for="deped_email">Deped Email Address</label>
                          <input type="email" name="deped_email" id="deped_email"
                              class="w-full border border-gray-400 rounded px-2 py-1">
                      </div>
                      <div>
                          <label for="deped_email_status">Deped Email Status</label>
                          <select name="deped_email_status" id="deped_email_status"
                              class="w-full border border-gray-400 rounded px-2 py-1">
                              <option value="">Select</option>
                              <option value="Active">Active</option>
                              <option value="Inactive">Inactive</option>
                          </select>
                      </div>

                      <div>
                          <label for="m365_email_status">M365 Email Status</label>
                          <select name="m365_email_status" id="m365_email_status"
                              class="w-full border border-gray-400 rounded px-2 py-1">
                              <option value="">Select</option>
                              <option value="Active">Active</option>
                              <option value="Inactive">Inactive</option>
                          </select>
                      </div>
                      <div>
                          <label for="canva_login_status">Canva Login Status</label>
                          <select name="canva_login_status" id="canva_login_status"
                              class="w-full border border-gray-400 rounded px-2 py-1">
                              <option value="">Select</option>
                              <option value="Active">Active</option>
                              <option value="Inactive">Inactive</option>
                          </select>
                      </div>

                      <div>
                          <label for="lr_portal_status">LR Portal Status</label>
                          <select name="lr_portal_status" id="lr_portal_status"
                              class="w-full border border-gray-400 rounded px-2 py-1">
                              <option value="">Select</option>
                              <option value="Active">Active</option>
                              <option value="Inactive">Inactive</option>
                          </select>
                      </div>

                      <div>
                          <label for="l4t_recipient">L4T Recipient</label>
                          <select name="l4t_recipient" id="l4t_recipient"
                              class="w-full border border-gray-400 rounded px-2 py-1">
                              <option value="">Select</option>
                              <option value="Yes">Yes</option>
                              <option value="No">No</option>
                          </select>
                      </div>
                      <div>
                          <label for="smart_tv_recipient">Smart TV Recipient</label>
                          <select name="smart_tv_recipient" id="smart_tv_recipient"
                              class="w-full border border-gray-400 rounded px-2 py-1">
                              <option value="">Select</option>
                              <option value="Yes">Yes</option>
                              <option value="No">No</option>
                          </select>
                      </div>
                      <div>
                          <label for="l4nt_recipient">L4NT Recipient</label>
                          <select name="l4nt_recipient" id="l4nt_recipient"
                              class="w-full border border-gray-400 rounded px-2 py-1">
                              <option value="">Select</option>
                              <option value="Yes">Yes</option>
                              <option value="No">No</option>
                          </select>
                      </div>




                  </div>
                  <div>
                      <button type="submit"
                          class="bg-blue-500 hover:bg-blue-700 text-white  py-1 px-4  tracking-wider font-medium rounded shadow ">Update
                          Employee</button>
                      <button type="button" onclick="closeEditModal()"
                          class="bg-gray-500 hover:bg-gray-700 text-white   py-1 px-4  tracking-wider font-medium rounded shadow ">Cancel</button>
                  </div>
              </form>

          </div>
      </div>
      <div id="cards" class="grid grid-cols-1 md:grid-cols-6 gap-3 p-6"></div>

      <script>
          document.addEventListener("DOMContentLoaded", () => {
              fetch("get-data")
                  .then(res => res.json())
                  .then(data => {
                      const container = document.getElementById("cards");

                      const items = [{
                              key: "active_deped_email",
                              label: "Active DepEd Email",
                              color: "bg-green-500",
                              icon: `<svg viewBox="0 0 24 24" class="h-10 w-10"  fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12ZM16 12V13.5C16 14.8807 17.1193 16 18.5 16V16C19.8807 16 21 14.8807 21 13.5V12C21 7.02944 16.9706 3 12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21H16" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>`
                          },
                          {
                              key: "inactive_deped_email",
                              label: "Inactive DepEd Email",
                              color: "bg-red-500",
                              icon: `<svg viewBox="0 0 24 24" class="h-10 w-10"  fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12ZM16 12V13.5C16 14.8807 17.1193 16 18.5 16V16C19.8807 16 21 14.8807 21 13.5V12C21 7.02944 16.9706 3 12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21H16" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>`

                          },
                          {
                              key: "m365_email_status_active",
                              label: "M365 Active",
                              color: "bg-green-500",
                              icon: `<svg viewBox="0 0 24 24" class="h-10 w-10" xmlns="http://www.w3.org/2000/svg" fill="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>microsoft_windows</title> <rect width="24" height="24" fill="none"></rect> <path d="M3,12V6.75L9,5.43v6.48L3,12M20,3v8.75L10,11.9V5.21L20,3M3,13l6,.09V19.9L3,18.75V13m17,.25V22L10,20.09v-7Z"></path> </g></svg>`
                          },
                          {
                              key: "m365_email_status_inactive",
                              label: "M365 Inactive",
                              color: "bg-red-500",
                              icon: `<svg viewBox="0 0 24 24" class="h-10 w-10" xmlns="http://www.w3.org/2000/svg" fill="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>microsoft_windows</title> <rect width="24" height="24" fill="none"></rect> <path d="M3,12V6.75L9,5.43v6.48L3,12M20,3v8.75L10,11.9V5.21L20,3M3,13l6,.09V19.9L3,18.75V13m17,.25V22L10,20.09v-7Z"></path> </g></svg>`

                          },
                          {
                              key: "canva_login_status_active",
                              label: "Canva Active",
                              color: "bg-green-500",
                              icon: `<svg viewBox="0 0 192 192" class="h-10 w-10" xmlns="http://www.w3.org/2000/svg" style="enable-background:new 0 0 192 192" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M95.2 170c-11.6 0-22-3.1-30.9-9.1-8.8-6-15.4-14.6-19.7-25.6-2.5-6.4-4-13.4-4.7-21.4-.8-9.5-.2-19.2 1.9-28.7 3.3-15.3 10-28.5 19.8-39.5 9.7-10.8 21.2-18.1 34.3-21.5 5.6-1.5 11.2-2.2 16.5-2.2 6.4 0 12.7 1.1 18.7 3.3 8.9 3.3 15 9 17.9 17 1.4 3.7 1.8 7.6 1.4 12-.6 6.2-2.6 11.7-6 16.4-3.9 5.4-8.6 8.7-14.3 10.1-1 .3-2.1.4-3.3.4-.5 0-.9 0-1.4-.1-1.7-.2-3.2-.9-4.2-2.2-1-1.3-1.4-3-1.2-4.7.3-2 1.1-3.7 1.9-5.1l.3-.6c1.6-3.2 3.1-6.2 3.9-9.4 1.3-5.4 1.3-9.5-.1-13.3-1.5-4-4.3-6.5-8.5-7.5-1.6-.4-3.2-.6-4.8-.6-3.6 0-7.4.9-11.4 2.7C93.4 44 86.7 50 81 58.7c-3.9 6-6.9 12.7-9.1 20.5-1.6 5.6-2.6 11.5-3.2 17.6-.3 2.9-.5 6.3-.5 9.6.1 9.7 1.5 17.4 4.5 24.2 3.3 7.6 7.8 12.9 13.9 16.3 4.1 2.3 8.7 3.5 13.6 3.5.8 0 1.7 0 2.6-.1 10.4-.8 19.6-5.5 28-14.3 4.3-4.5 7.9-9.7 11-15.9.5-.9 1-1.9 1.8-2.7 1-1.1 2.3-1.7 3.7-1.7 1.7 0 3.2.9 4.2 2.5 1.2 2 1.1 4.2.9 5.6-.6 4.1-2.1 8.1-4.6 12.8-7.2 12.9-17.1 22.4-29.4 28.3-6.3 3-13.1 4.7-20.1 5-1.1.1-2.1.1-3.1.1z" style="fill:none;stroke:#ffffff;stroke-width:12;stroke-linejoin:round;stroke-miterlimit:10"></path></g></svg>`
                          },
                          {
                              key: "canva_login_status_inactive",
                              label: "Canva Inactive",
                              color: "bg-red-500",
                              icon: `<svg viewBox="0 0 192 192" class="h-10 w-10" xmlns="http://www.w3.org/2000/svg" style="enable-background:new 0 0 192 192" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M95.2 170c-11.6 0-22-3.1-30.9-9.1-8.8-6-15.4-14.6-19.7-25.6-2.5-6.4-4-13.4-4.7-21.4-.8-9.5-.2-19.2 1.9-28.7 3.3-15.3 10-28.5 19.8-39.5 9.7-10.8 21.2-18.1 34.3-21.5 5.6-1.5 11.2-2.2 16.5-2.2 6.4 0 12.7 1.1 18.7 3.3 8.9 3.3 15 9 17.9 17 1.4 3.7 1.8 7.6 1.4 12-.6 6.2-2.6 11.7-6 16.4-3.9 5.4-8.6 8.7-14.3 10.1-1 .3-2.1.4-3.3.4-.5 0-.9 0-1.4-.1-1.7-.2-3.2-.9-4.2-2.2-1-1.3-1.4-3-1.2-4.7.3-2 1.1-3.7 1.9-5.1l.3-.6c1.6-3.2 3.1-6.2 3.9-9.4 1.3-5.4 1.3-9.5-.1-13.3-1.5-4-4.3-6.5-8.5-7.5-1.6-.4-3.2-.6-4.8-.6-3.6 0-7.4.9-11.4 2.7C93.4 44 86.7 50 81 58.7c-3.9 6-6.9 12.7-9.1 20.5-1.6 5.6-2.6 11.5-3.2 17.6-.3 2.9-.5 6.3-.5 9.6.1 9.7 1.5 17.4 4.5 24.2 3.3 7.6 7.8 12.9 13.9 16.3 4.1 2.3 8.7 3.5 13.6 3.5.8 0 1.7 0 2.6-.1 10.4-.8 19.6-5.5 28-14.3 4.3-4.5 7.9-9.7 11-15.9.5-.9 1-1.9 1.8-2.7 1-1.1 2.3-1.7 3.7-1.7 1.7 0 3.2.9 4.2 2.5 1.2 2 1.1 4.2.9 5.6-.6 4.1-2.1 8.1-4.6 12.8-7.2 12.9-17.1 22.4-29.4 28.3-6.3 3-13.1 4.7-20.1 5-1.1.1-2.1.1-3.1.1z" style="fill:none;stroke:#ffffff;stroke-width:12;stroke-linejoin:round;stroke-miterlimit:10"></path></g></svg>`

                          },
                          {
                              key: "lr_portal_status_active",
                              label: "LR Portal Active",
                              color: "bg-green-500",
                              icon: `<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
               </svg>`
                          },
                          {
                              key: "lr_portal_status_iactive",
                              label: "LR Portal Inactive",
                              color: "bg-red-500",
                              icon: `<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6" />
               </svg>`
                          },
                          {
                              key: "l4t_recipient",
                              label: "L4T Recipient",
                              color: "bg-blue-500",
                              icon: `<svg viewBox="0 0 24 24" class="h-10 w-10" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M2 6C2 4.34315 3.34315 3 5 3H19C20.6569 3 22 4.34315 22 6V16H23V17V18C23 19.6569 21.6569 21 20 21H4C2.34315 21 1 19.6569 1 18V17V16H2V6ZM20 6V16H4V6C4 5.44772 4.44772 5 5 5H19C19.5523 5 20 5.44772 20 6ZM4 19C3.44772 19 3 18.5523 3 18H21C21 18.5523 20.5523 19 20 19H4ZM5.5 6C5.22386 6 5 6.22386 5 6.5V14.5C5 14.7761 5.22386 15 5.5 15H18.5C18.7761 15 19 14.7761 19 14.5V6.5C19 6.22386 18.7761 6 18.5 6H5.5Z" fill="#ffffff"></path> </g></svg>`
                          },
                          {
                              key: "smart_tv_recipient",
                              label: "Smart TV Recipient",
                              color: "bg-purple-500",
                              icon: `<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h18v12H3V4z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 20h8" />
                                </svg>`
                          },
                          {
                              key: "l4nt_recipient",
                              label: "L4NT Recipient",
                              color: "bg-yellow-500",
                              icon: `<svg viewBox="0 0 24 24" class="h-10 w-10" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M2 6C2 4.34315 3.34315 3 5 3H19C20.6569 3 22 4.34315 22 6V16H23V17V18C23 19.6569 21.6569 21 20 21H4C2.34315 21 1 19.6569 1 18V17V16H2V6ZM20 6V16H4V6C4 5.44772 4.44772 5 5 5H19C19.5523 5 20 5.44772 20 6ZM4 19C3.44772 19 3 18.5523 3 18H21C21 18.5523 20.5523 19 20 19H4ZM5.5 6C5.22386 6 5 6.22386 5 6.5V14.5C5 14.7761 5.22386 15 5.5 15H18.5C18.7761 15 19 14.7761 19 14.5V6.5C19 6.22386 18.7761 6 18.5 6H5.5Z" fill="#ffffff"></path> </g></svg>`

                          }, {
                              key: "employees",
                              label: "Total Employees",
                              color: "bg-blue-500",
                              icon: `<svg fill="#ffffff" viewBox="0 0 36 36" class="h-10 w-10" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>employee_solid</title> <g id="aad88ad3-6d51-4184-9840-f392d18dd002" data-name="Layer 3"> <circle cx="16.86" cy="9.73" r="6.46"></circle> <rect x="21" y="28" width="7" height="1.4"></rect> <path d="M15,30v3a1,1,0,0,0,1,1H33a1,1,0,0,0,1-1V23a1,1,0,0,0-1-1H26V20.53a1,1,0,0,0-2,0V22H22V18.42A32.12,32.12,0,0,0,16.86,18a26,26,0,0,0-11,2.39,3.28,3.28,0,0,0-1.88,3V30Zm17,2H17V24h7v.42a1,1,0,0,0,2,0V24h6Z"></path> </g> </g></svg>`

                          }




                      ];


                      items.forEach(item => {
                          const value = data[item.key] ?? 0;

                          const card = document.createElement("div");
                          card.className =
                              "p-4 rounded-xl tracking-wider shadow-lg border border-gray-300 bg-white flex items-center gap-4 hover:shadow-xl transition";

                          card.innerHTML = `
                          <div
                     class="h-16 w-16 bg-white p-3 border border-gray-300 shadow-lg rounded-full flex items-center justify-center">
                     <div class="text-white ${item.color} p-2 rounded-full">
                         
                        ${item.icon}
                     </div>
                 </div>
                                
                                <div>
                                    <h3 class="text-gray-600 text-sm font-medium">${item.label}</h3>
                                    <p class="text-2xl font-bold">${value}</p>
                                </div>
                            `;

                          container.appendChild(card);
                      });
                  })
                  .catch(err => console.error("Fetch error:", err));
          });
      </script>

      <div class="my-5 mx-5 bg-white shadow-xl rounded-lg overflow-hidden p-6 border border-gray-300">
          <div class="flex justify-between">
              <div>
                  <div class="text-2xl font-bold text-gray-700">Digital Identity</div>
                  <div class="text-md font-normal text-gray-600 mb-2  ">Employee Information</div>

                  <div class="d-flex justify-content-end mb-3">
                      <button onclick="openModal()" type="button"
                          class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-1 px-4  tracking-wider font-medium rounded shadow  w-fit">Add
                          Employee
                      </button>


                  </div>
              </div>
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

          </div>
          <div>
              <table class="w-full  tracking-wider table-auto border-collapse" id="employeeTable">
                  @foreach ($employee as $emp)
                      <tr>
                          <td class="px-4 py-1 bg-gray-100 border border-gray-500">Name</td>
                          <td class="px-4 py-1 bg-gray-100 border border-gray-500">Sex</td>
                          <td class="px-4 py-1 bg-gray-100 border border-gray-500">Birthdate</td>
                          <td class="px-4 py-1 bg-gray-100 border border-gray-500">Employee Number</td>
                          <td class="px-4 py-1 bg-gray-100 border border-gray-500">Position Title</td>
                          <td class="px-4 py-1 bg-gray-100 border border-gray-500">Salary Grade</td>
                          <td class="px-4 py-1 bg-gray-100 border border-gray-500">Deped Email</td>
                      </tr>
                      <tr class="border border-gray-500 ">
                          <td class="px-4 py-2 font-bold">{{ $emp->fname }} {{ $emp->mname }}
                              {{ $emp->lname }}</td>
                          <td class="px-4 py-2 ">{{ $emp->sex }}</td>
                          <td class="px-4 py-2">{{ $emp->birthdate }}</td>
                          <td class="px-4 py-2 ">{{ $emp->employee_number }}</td>
                          @php
                              $position = App\Models\EmployeePosition::find($emp->position_title_id);
                          @endphp
                          @if ($position)
                              <td class="px-4 py-2  ">{{ $position->name }}</td>
                          @endif

                          <td class="px-4 py-2  ">{{ $emp->salary_grade }}</td>
                          <td class="px-4 py-2 ">{{ $emp->deped_email }}</td>

                      </tr>
                      <tr>
                          <td class="px-4 py-1 bg-gray-100 border border-gray-500">Deped Email Status</td>
                          <td class="px-4 py-1 bg-gray-100 border border-gray-500">M365 Email Status</td>
                          <td class="px-4 py-1 bg-gray-100 border border-gray-500">Canva Login Status</td>
                          <td class="px-4 py-1 bg-gray-100 border border-gray-500">LR Portal Status</td>
                          <td class="px-4 py-1 bg-gray-100 border border-gray-500">L4T Recipient</td>
                          <td class="px-4 py-1 bg-gray-100 border border-gray-500">Smart TV Recipient</td>
                          <td class="px-4 py-1 bg-gray-100 border border-gray-500">L4NT Recipient</td>
                      </tr>


                      <tr class="mb-4 border border-gray-500 ">
                          <td class="px-4 py-2 @if ($emp->deped_email_status == 'Inactive') text-red-500 @endif">
                              {{ $emp->deped_email_status }}</td>
                          <td class="px-4 py-2 @if ($emp->m365_email_status == 'Inactive') text-red-500 @endif">
                              {{ $emp->m365_email_status }}</td>
                          <td class="px-4 py-2 @if ($emp->canva_login_status == 'Inactive') text-red-500 @endif ">
                              {{ $emp->canva_login_status }}</td>
                          <td class="px-4 py-2  @if ($emp->lr_portal_status == 'Inactive') text-red-500 @endif  ">
                              {{ $emp->lr_portal_status }}</td>
                          <td class="px-4 py-2 @if ($emp->l4t_recipient == 'No') text-red-500 @endif ">
                              {{ $emp->l4t_recipient }}</td>
                          <td class="px-4 py-2 @if ($emp->smart_tv_recipient == 'No') text-red-500 @endif">
                              {{ $emp->smart_tv_recipient }}</td>
                          <td class="px-4 py-2 @if ($emp->l4nt_recipient == 'No') text-red-500 @endif">
                              {{ $emp->l4nt_recipient }}</td>
                          {{-- <td class="px-4 py-1 border-b border-gray-500"><a href="{{ route('school.employee.edit', $emp->id) }}" class="text-blue-500 hover:text-blue-600 underline">Edit</a></td> --}}
                      </tr>
                      <tr>
                          <td colspan="2" class="h-5  ">
                              <div class="mb-5 mt-1 flex flex-row gap-2">
                                  <button
                                      class="border border-blue-500 text-blue-500 hover:bg-blue-700 hover:text-white text-sm  py-1 px-4  tracking-wider font-medium rounded shadow "
                                      onclick="editModal('{{ $emp->pk_schools_employee_id }}','{{ $emp->fname }}','{{ $emp->mname }}','{{ $emp->lname }}','{{ $emp->sex }}','{{ $emp->birthdate }}','{{ $emp->employee_number }}','{{ $emp->position_title_id }}','{{ $emp->salary_grade }}','{{ $emp->deped_email }}','{{ $emp->deped_email_status }}','{{ $emp->m365_email_status }}','{{ $emp->canva_login_status }}','{{ $emp->lr_portal_status }}','{{ $emp->l4t_recipient }}','{{ $emp->smart_tv_recipient }}','{{ $emp->l4nt_recipient }}')">Edit
                                      Employee</button>
                                  <button onclick="delete_employee('{{ $emp->pk_schools_employee_id }}') "
                                      class="text-red-500 border border-red-500 hover:bg-red-600 hover:text-white text-sm  py-1 px-4  tracking-wider font-medium rounded shadow ">Remove
                                      Employee</button>
                              </div>
                          </td>
                      </tr>
                  @endforeach
              </table>
          </div>
      </div>
      <script>
          function delete_employee(id) {
              if (confirm("Are you sure you want to delete this record?")) {
                  fetch('/School/Employee/delete/' + id, {
                          method: 'DELETE',
                          headers: {
                              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                          }
                      })
                      .then(response => {
                          if (response.ok) {
                              alert('Record deleted successfully!');
                              location.reload();
                          } else {
                              alert('Failed to delete record.');
                          }
                      })
                      .catch(error => console.error('Error:', error));
              }
          }

          function openModal() {
              const modal = document.getElementById('add-employee-modal');
              modal.classList.remove('hidden');
          }

          function closeModal() {
              const modal = document.getElementById('add-employee-modal');
              modal.classList.add('hidden');
          }

          function closeEditModal() {
              const modal = document.getElementById('edit-employee-modal');
              modal.classList.add('hidden');
          }

          function editModal(id, fname, mname, lname, sex, birthdate, employee_number, position_title_id, salary_grade,
              deped_email, deped_email_status, m365_email_status, canva_login_status, lr_portal_status, l4t_recipient,
              smart_tv_recipient, l4nt_recipient) {
              const modal = document.getElementById('edit-employee-modal');
              modal.classList.remove('hidden');
              document.getElementById('employee_id').value = id;
              document.getElementById('fname').value = fname;
              document.getElementById('mname').value = mname;
              document.getElementById('lname').value = lname;
              document.getElementById('sex').value = sex;
              document.getElementById('birthdate').value = birthdate;
              document.getElementById('employee_number').value = employee_number;
              document.getElementById('position_title_id').value = position_title_id;
              document.getElementById('salary_grade').value = salary_grade;
              document.getElementById('deped_email').value = deped_email;
              document.getElementById('deped_email_status').value = deped_email_status;
              document.getElementById('m365_email_status').value = m365_email_status;
              document.getElementById('canva_login_status').value = canva_login_status;
              document.getElementById('lr_portal_status').value = lr_portal_status;
              document.getElementById('l4t_recipient').value = l4t_recipient;
              document.getElementById('smart_tv_recipient').value = smart_tv_recipient;
              document.getElementById('l4nt_recipient').value = l4nt_recipient;
          }
      </script>
  @endsection
