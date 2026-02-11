import { renderIcons } from "../../custom"; 
import './_submitAccountability.js';
    const modalUser = document.getElementById('show-user-list');
    const listContainer = document.getElementById('userAccountabilityContainer');
 
    export async function showUserList(equipmentId) {
        removeOverflow();
        if (equipmentId) {
            const btnUser = document.getElementById(`btnPerson-${equipmentId}`);
            btnUser.innerHTML = `
                    <div class="sm:w-8 sm:h-8 h-6 w-6 flex items-center justify-center" >
                        <div class="sm:w-6 sm:h-6 h-4 w-4" style="
                        border: 3px solid #fff;       /* White border */
                        border-top: 3px solid transparent; /* Transparent top */
                        border-radius: 50%;
                        
                        animation: spin 1s linear infinite;
                        margin: auto;
                    "> 


                    </div>
                        </div>
                `;

            const response = await fetch(`/School/school-equipment-accountability/${equipmentId}`);
            const res = await response.json();
            const responseEmployee = await fetch(`/School/school-employee-list`);
            const resEmployee = await responseEmployee.json();
            const responseTransactionType = await fetch('/School/school-equipment-transaction-type');
            const resTransactionType = await responseTransactionType.json();

            await renderAccountabilityForm(res, resEmployee.data, equipmentId,
                resTransactionType
                .data);

            btnUser.innerHTML = '';
            renderIcons();
            
            modalUser.classList.remove('hidden');
        }
        document.body.classList.add('overflow-hidden');
    }

    function renderAccountabilityForm(res, employees, equipmentId, transactionTypes) {
        const form = document.getElementById('accountabilityForm');
        const data = res?.data ?? null;

        const isUpdate = !!data; 
        form.action = isUpdate ? `/School/school-equipment-accountability/${data.id}` : '/School/school-equipment-accountability';
        form.method = 'POST';
        form.className = ('space-y-4');
        form.innerHTML = `
              
                    <div class="flex flex-col items-center justify-center gap-0">
                        <input type="hidden" name="_token" value="${document.querySelector('meta[name=csrf-token]').getAttribute('content')}">
                        <input type="hidden" name="_method" value="${isUpdate ? 'PUT' : 'POST'}">
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
                    <label class="form-label">Accountable Officer (Employee)</label>
                    <select name="accountable_employee_id" required
                            class="form-input">
                        <option value="">Select </option>
                        ${employees.map(emp => `
                            <option value="${emp.pk_schools_employee_id}"
                                ${emp.pk_schools_employee_id === data?.accountable_employee_id ? 'selected' : ''}>
                                ${emp.employee_number} - ${emp.fname} ${emp.mname ?? ''} ${emp.lname} ${emp.suffix_name ?? ''}
                            </option>
                        `).join('')}
                    </select>
                </div>

                <!-- DATE ASSIGNED -->
                <div class="flex flex-col">
                    <label class="form-label">Date  Received (Accountable Officer)</label>
                    <input type="date" name="date_assigned_to_accountable_employee"
                        value="${data?.date_assigned_to_accountable_employee ?? ''}"
                        class="form-input">
                </div>

                <!-- RECEIVER TYPE -->
                <div class="flex flex-col">
                    <label class="form-label">Custodian Officer</label>
                    <select name="custodian" required
                            class="form-input">
                        <option value="">Select </option>
                        ${employees.map(emp => `
                            <option value="${emp.pk_schools_employee_id}"
                                ${emp.pk_schools_employee_id === data?.custodian ? 'selected' : ''}>
                                ${emp.employee_number} -  ${emp.fname} ${emp.mname ?? ''} ${emp.lname} ${emp.suffix_name ?? ''}
                            </option>
                        `).join('')}
                    </select>
                </div>

                <!-- DATE RECEIVED -->
                <div class="flex flex-col">
                    <label class="form-label">Date Received (Custodian)</label>
                    <input type="date" name="custodian_received_date"
                        value="${data?.custodian_received_date ?? ''}"
                        class="form-input">
                </div>
                
                <div class="flex flex-col">
                    <label class="form-label">End User</label>
                    <select name="end_user" required
                            class="form-input">
                        <option value="">Select </option>
                        ${employees.map(emp => `
                                    <option value="${emp.pk_schools_employee_id}"
                                        ${emp.pk_schools_employee_id === data?.end_user ? 'selected' : ''}>
                                        ${emp.employee_number} -  ${emp.fname} ${emp.mname ?? ''} ${emp.lname} ${emp.suffix_name ?? ''}
                                        </option>
                                        `).join('')}
                            </select>
                    </div>
                        <div class="flex flex-col">
                    <label class="form-label">Date Received (End User)</label>
                    <input type="date" name="end_user_received_date"
                        value="${data?.end_user_received_date ?? ''}"
                        class="form-input">
                </div>
                </div>
                   <div class="flex flex-col">
                    <label class="form-label">Transaction Type</label>
                    <select name="transaction_type_id" required
                            class="form-input">
                        <option value="">-- Select Transaction Type --</option>
                        ${transactionTypes.map(ty => `
                        <option value="${ty.id}" ${ty.id === data?.transaction_type_id ? 'selected' : ''}>
                            ${ty.name}
                        </option>
                    `).join('')}
                    </select>
                </div>

                        <div class="grid grid-cols-2 max-w-xs ml-auto gap-2">

                    <button type="button" onclick="closeComponentModal('show-user-list')"
                            class="btn-cancel px-4 py-1 rounded transition-colors md:w-auto w-full  ">
                        Cancel
                    </button>
                <button type="submit" id="submitAccountabilityBtn"
                        class="  ${isUpdate ? 'btn-green' : 'btn-submit'} px-4 py-1 rounded transition-colors md:w-auto w-full">
                    ${isUpdate ? 'Update' : 'Submit'}
                </button>

                </div>
       
        `;

    }

    window.showUserList = showUserList;
 