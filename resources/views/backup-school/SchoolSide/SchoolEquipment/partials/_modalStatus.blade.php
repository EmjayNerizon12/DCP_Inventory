 <div id="show-status-list" class="modal hidden">
     <div class="modal-content medium-modal thin-scroll">
         <div id="statusForm"></div>
     </div>
 </div>
 <script>
     async function showStatusModal(equipmentId) {
         if (equipmentId) {
             try {
                 const btnStatus = document.getElementById(`btnStatus-${equipmentId}`);
                 btnStatus.innerHTML = `
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
                 const response = await fetch(`/School/school-equipment-status/${equipmentId}`);
                 const res = await response.json();
                 const responseCondition = await fetch('/School/school-equipment-condition');
                 const resCondition = await responseCondition.json();
                 const responseDisposition = await fetch('/School/school-equipment-disposition');
                 const resDisposition = await responseDisposition.json();
                 renderStatusForm(res, resCondition.data, resDisposition.data, equipmentId);
                 document.getElementById('show-status-list').classList.remove('hidden');
                 btnStatus.innerHTML =
                     ` 
                 <svg fill="currentColor" class="w-8 h-8" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M500 70q-117 0-217 59-97 57-154 154-59 100-59 217t59 217q57 97 154 154 100 59 217 59t217-59q97-57 154-154 59-100 59-217t-59-217q-57-97-154-154-100-59-217-59zm0 108q79 0 148 36t114.5 99.5T819 455h-69q-12 0-25.5-6.5T704 432l-86-114q-7-10-17.5-10T583 318L417 540q-7 9-17.5 9t-17.5-9l-46-61q-7-10-20.5-17t-24.5-7H181q11-78 56.5-141.5T352 214t148-36zm0 644q-79 0-148-36t-114.5-99.5T181 545h69q12 0 25.5 7t20.5 16l86 115q7 9 17.5 9t17.5-9l166-222q7-10 17.5-10t17.5 10l46 61q7 9 20.5 16t24.5 7h110q-11 78-56.5 141.5T648 786t-148 36z"></path></g></svg>`;
             } catch (error) {
                 console.error(error);
             }
         }
     }

     function renderStatusForm(res, condition, disposition, equipmentId) {
         const form = document.getElementById('statusForm');
         const data = res?.data ?? null
         const isUpdate = !!data;

         console.log(isUpdate);
         form.innerHTML = `
                <form class="space-y-6" method="POST" action="${isUpdate ? '/School/school-equipment-status/' + data.id : '/School/school-equipment-status'}">
                    ${isUpdate ? '<input type="hidden" name="_method" value="PUT">' : ''}
                      <div class="flex flex-col items-center justify-center gap-0">
                          <input type="hidden" name="_token" value="${document.querySelector('meta[name=csrf-token]').getAttribute('content')}">
                 <div class="w-full flex flex-row items-center justify-center">
                     <div
                         class="h-16 w-16 bg-white p-3 border border-gray-300 shadow-lg rounded-full flex items-center justify-center">
                         <div class="text-white ${isUpdate ? 'bg-green-600' : 'bg-blue-600'} p-2 rounded-full">
                             <svg fill="currentColor" class="w-10 h-10" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M500 70q-117 0-217 59-97 57-154 154-59 100-59 217t59 217q57 97 154 154 100 59 217 59t217-59q97-57 154-154 59-100 59-217t-59-217q-57-97-154-154-100-59-217-59zm0 108q79 0 148 36t114.5 99.5T819 455h-69q-12 0-25.5-6.5T704 432l-86-114q-7-10-17.5-10T583 318L417 540q-7 9-17.5 9t-17.5-9l-46-61q-7-10-20.5-17t-24.5-7H181q11-78 56.5-141.5T352 214t148-36zm0 644q-79 0-148-36t-114.5-99.5T181 545h69q12 0 25.5 7t20.5 16l86 115q7 9 17.5 9t17.5-9l166-222q7-10 17.5-10t17.5 10l46 61q7 9 20.5 16t24.5 7h110q-11 78-56.5 141.5T648 786t-148 36z"></path></g></svg>
                         </div>
                     </div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-gray-700">School Equipment Status</div>
                        <div class="text-md text-gray-600 mb-4">Assigning Status to School Equipment</div>
                    </div>
                </div>

                    <input type="hidden" name="school_equipment_id" value="${equipmentId ?? ''}">
                    <input type="hidden" name="id" value="${data?.id ?? ''}">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                
                    <div class="flex flex-col">
                        <label class="font-semibold text-gray-700 mb-1">Equipment Condition</label>
                        <select name="equipment_condition_id" required
                                class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            <option value="">Select </option>
                            ${condition.map(cond => `
                                                                                    <option value="${cond.id}"
                                                                                        ${cond.id === data?.equipment_condition_id ? 'selected' : ''}>
                                                                                        ${cond.name}  
                                                                                    </option>
                                                                                `).join('')}
                        </select>
                    </div>


                    <div class="flex flex-col">
                        <label class="font-semibold text-gray-700 mb-1">Status Disposition Status</label>
                        <select name="disposition_status_id"  
                                class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            <option value="">Select </option>
                            ${disposition.map(dispo => `
                                                                            <option value="${dispo.id}"
                                                                                ${dispo.id === data?.disposition_status_id ? 'selected' : ''}>
                                                                                ${dispo.name}  
                                                                            </option>
                                                                        `).join('')}
                        </select>
                    </div>

                  
                        <div class="flex flex-col">
                            <label class="font-semibold text-gray-700 mb-1">Warranty Start Date</label>
                            <input type="date" name="start_warranty_date" value="${data?.start_warranty_date ?? ''}"  
                                class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>
                    <div class="flex flex-col">
                            <label class="font-semibold text-gray-700 mb-1">Warranty End Date</label>
                            <input type="date" name="end_warranty_date" value="${data?.end_warranty_date ?? ''}"  
                                class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>
                     
                        <div class="flex flex-col">
                            <label class="font-semibold text-gray-700 mb-1">Equipment Location</label>
                            <input type="text" name="equipment_location" value="${data?.equipment_location ?? ''}"  
                                class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>

                        <div class="flex flex-col">
                            <label class="font-semibold text-gray-700 mb-1">Non Functional</label>
                            <select name="non_functional" required
                                class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                <option value="" >Select  </option>
                                <option value="1" ${data?.non_functional === 1, 'selected', ''}>Yes</option>
                                <option value="0" ${data?.non_functional === 0, 'selected', ''}>No</option>
                            </select>    
                        </div>
                        </div>
                    <div class="flex md:justify-end justify-center gap-2 my-2 w-full">
                        
                        <button type="button" onclick="closeStatusModal()"
                        class=" md:w-auto w-full btn-cancel px-4 py-1 rounded transition-colors">
                        Cancel
                        </button>
                        <button type="submit"
                                class="md:w-auto w-full ${isUpdate ? 'btn-green' : 'btn-submit'}  px-4 py-1 rounded transition-colors">
                            ${isUpdate ? 'Update Status' : 'Save Status'}
                        </button>
                    </div>
                </form>
            `;

     }

     function closeStatusModal() {
         const modal = document.getElementById('show-status-list');

         modal.classList.add('hidden');
     }
 </script>
