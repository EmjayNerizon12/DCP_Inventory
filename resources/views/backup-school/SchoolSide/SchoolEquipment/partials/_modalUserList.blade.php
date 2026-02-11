 <div id="show-user-list" class="modal  hidden">
     <div class="modal-content medium-modal  thin-scroll">

         <div id="userAccountabilityContainer">

         </div>
         <div id="accountabilityForm"></div>

     </div>
 </div>

 <script>
     const modalUser = document.getElementById('show-user-list');
     const listContainer = document.getElementById('userAccountabilityContainer');
     async function showUserList(equipmentId) {
         if (equipmentId) {
             const btnUser = document.getElementById(`btnPerson-${equipmentId}`);
             btnUser.innerHTML = `
                        <div class="w-8 h-8  flex items-center justify-center" >
                            <div style="
                            border: 3px solid #fff;       /* White border */
                            border-top: 3px solid transparent; /* Transparent top */
                            border-radius: 50%;
                           height:18px ; width:18px;
                            animation: spin 1s linear infinite;
                            margin: auto;
                        "> 


                        </div>
                            </div>
                    `;

             const response = await fetch(`/School/school-equipment-accountability/${equipmentId}`);
             const res = await response.json();
             const responseReceiverType = await fetch('/School/school-equipment-accountability-receiver-type');
             const resReceiverType = await responseReceiverType.json();
             const responseEmployee = await fetch(`/School/school-employee-list`);
             const resEmployee = await responseEmployee.json();
             const responseTransactionType = await fetch('/School/school-equipment-transaction-type');
             const resTransactionType = await responseTransactionType.json();

             renderAccountabilityForm(res, resEmployee.data, resReceiverType.data, equipmentId, resTransactionType
                 .data);

             btnUser.innerHTML = `
                <svg class="w-8 h-8" viewBox="-102.4 -102.4 1228.80 1228.80"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path fill="currentColor"
                                d="M288 320a224 224 0 1 0 448 0 224 224 0 1 0-448 0zm544 608H160a32 32 0 0 1-32-32v-96a160 160 0 0 1 160-160h448a160 160 0 0 1 160 160v96a32 32 0 0 1-32 32z">
                            </path>
                        </g>
                    </svg>
                    `;
             modalUser.classList.remove('hidden');
         }
         document.body.classList.add('overflow-hidden');
     }

     function renderAccountabilityForm(res, employees, receiverTypes, equipmentId, transactionTypes) {
         const form = document.getElementById('accountabilityForm');
         const data = res?.data ?? null;

         const isUpdate = !!data;
         const endUser = data?.end_user?.[0] ?? {};

         form.innerHTML = `
                <form class="space-y-6" method="POST" action="${isUpdate ? '/School/school-equipment-accountability/' + data.id : '/School/school-equipment-accountability'}">
                    ${isUpdate ? '<input type="hidden" name="_method" value="PUT">' : ''}
                      <div class="flex flex-col items-center justify-center gap-0">
                          <input type="hidden" name="_token" value="${document.querySelector('meta[name=csrf-token]').getAttribute('content')}">
                 <div class="w-full flex flex-row items-center justify-center">
                     <div
                         class="h-16 w-16 bg-white p-3 border border-gray-300 shadow-lg rounded-full flex items-center justify-center">
                         <div class="text-white ${isUpdate ? 'bg-green-600' : 'bg-blue-600'} p-2 rounded-full">
                              <svg class="w-10 h-10" viewBox="-102.4 -102.4 1228.80 1228.80"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path fill="currentColor"
                                            d="M288 320a224 224 0 1 0 448 0 224 224 0 1 0-448 0zm544 608H160a32 32 0 0 1-32-32v-96a160 160 0 0 1 160-160h448a160 160 0 0 1 160 160v96a32 32 0 0 1-32 32z">
                                        </path>
                                    </g>
                                </svg>
                         </div>
                     </div>
                 </div>
                 <div class="text-center">
                     <div class="page-title">School Equipment Accountability</div>
                     <div class="page-subtitle">Assigning Accountability to School Equipment</div>
                 </div>
             </div>

                    <input type="hidden" name="school_equipment_id" value="${equipmentId ?? ''}">
                    <input type="hidden" name="id" value="${data?.id ?? ''}">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- ACCOUNTABLE OFFICER -->
                    <div class="flex flex-col">
                        <label class="font-semibold text-gray-700 mb-1">Accountable Officer <br> (Employee)</label>
                        <select name="accountable_employee_id" required
                                class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            <option value="">Select </option>
                            ${employees.map(emp => `
                                        <option value="${emp.pk_schools_employee_id}"
                                            ${emp.pk_schools_employee_id === data?.accountable_employee_id ? 'selected' : ''}>
                                            ${emp.fname} ${emp.mname ?? ''} ${emp.lname} ${emp.suffix_name ?? ''}
                                        </option>
                                    `).join('')}
                        </select>
                    </div>

                    <!-- DATE ASSIGNED -->
                    <div class="flex flex-col">
                        <label class="font-semibold text-gray-700 mb-1">Date Assigned / Received (Accountable Officer)</label>
                        <input type="date" name="date_assigned_to_accountable_employee"
                            value="${data?.date_assigned_to_accountable_employee ?? ''}"
                            class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    </div>

                    <!-- RECEIVER TYPE -->
                    <div class="flex flex-col">
                        <label class="font-semibold text-gray-700 mb-1">Receiver Type</label>
                        <select name="receiver_type_id" required
                                class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            <option value="">Select </option>
                            ${receiverTypes.map(rt => `
                                                                                                                                                           <option value="${rt.id}" ${rt.id === data?.receiver_type_id ? 'selected' : ''}>
                                                                                                                                                               ${rt.name}
                                                                                                                                                           </option>
                                                                                                                                                       `).join('')}
                        </select>
                    </div>

                    <!-- DATE RECEIVED -->
                    <div class="flex flex-col">
                        <label class="font-semibold text-gray-700 mb-1">Date Received (Receiver)</label>
                        <input type="date" name="date_received"
                            value="${data?.date_received ?? ''}"
                            class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    </div>
                    </div>
                    <hr class="my-4 border-gray-300">

                    <h4 class="text-lg font-semibold mb-2">End User</h4>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex flex-col">
                            <label class="font-semibold text-gray-700 mb-1">First Name</label>
                            <input type="text" name="fname" value="${endUser.fname ?? ''}" required
                                class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>

                        <div class="flex flex-col">
                            <label class="font-semibold text-gray-700 mb-1">Middle Name</label>
                            <input type="text" name="mname" value="${endUser.mname ?? ''}"
                                class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>

                        <div class="flex flex-col">
                            <label class="font-semibold text-gray-700 mb-1">Last Name</label>
                            <input type="text" name="lname" value="${endUser.lname?.trim() ?? ''}" required
                                class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>

                      <div class="flex flex-col">
                        <label class="font-semibold text-gray-700 mb-1">Suffix</label>
                        <select name="suffix"
                                class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            <option value="">Select  </option>
                            <option value="Jr." ${endUser.suffix === 'Jr.' ? 'selected' : ''}>Jr.</option>
                            <option value="Sr." ${endUser.suffix === 'Sr.' ? 'selected' : ''}>Sr.</option>
                            <option value="I" ${endUser.suffix === 'I' ? 'selected' : ''}>I</option>
                            <option value="II" ${endUser.suffix === 'II' ? 'selected' : ''}>II</option>
                            <option value="III" ${endUser.suffix === 'III' ? 'selected' : ''}>III</option>
                            <option value="IV" ${endUser.suffix === 'IV' ? 'selected' : ''}>IV</option>
                            <option value="V" ${endUser.suffix === 'V' ? 'selected' : ''}>V</option>
                            <option value="VI" ${endUser.suffix === 'VI' ? 'selected' : ''}>VI</option>
                            <option value="VII" ${endUser.suffix === 'VII' ? 'selected' : ''}>VII</option>
                        </select>
                    </div>

                        <div class="flex flex-col">
                            <label class="font-semibold text-gray-700 mb-1">Date Assigned to End User</label>
                            <input type="date" name="date_assigned" value="${endUser.date_assigned ?? ''}"
                                class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>
                    </div>

                <!-- RECEIVER TYPE -->
                    <div class="flex flex-col">
                        <label class="font-semibold text-gray-700 mb-1">Receiver Type</label>
                        <select name="transaction_type_id" required
                                class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            <option value="">-- Select Transaction Type --</option>
                            ${transactionTypes.map(ty => `
                                                                                                                                                           <option value="${ty.id}" ${ty.id === data?.transaction_type_id ? 'selected' : ''}>
                                                                                                                                                               ${ty.name}
                                                                                                                                                           </option>
                                                                                                                                                       `).join('')}
                        </select>
                    </div>

                    <div class="flex md:justify-end justify-center gap-2 my-2">
                        <button type="button" onclick="closeUserRecipientModal()"
                                class="btn-cancel px-4 py-1 rounded transition-colors md:w-auto w-full  ">
                            Cancel
                        </button>
                    <button type="submit"
                            class="  ${isUpdate ? 'btn-green' : 'btn-submit'} px-4 py-1 rounded transition-colors md:w-auto w-full">
                        ${isUpdate ? 'Update Accountability' : 'Save Accountability'}
                    </button>

                    </div>
                </form>
            `;

     }

     function formatDate(date) {
         if (!date) return '';
         return new Date(date).toISOString().split('T')[0];
     }

     function closeUserRecipientModal() {
         const modal = document.getElementById('show-user-list');
         modal.classList.add('hidden');
         document.body.classList.remove('overflow-hidden');
     }
 </script>
