import { renderIcons } from "../../custom";
import './_submitStatus.js';
export async function showStatusModal(equipmentId,cardIndex) {
    removeOverflow();
    if (equipmentId) {
        try {
            const btnStatus = document.getElementById(`btnStatus-${equipmentId}`);
            btnStatus.innerHTML = `
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
            const response = await fetch(`/School/school-equipment-status/${equipmentId}`);
            const res = await response.json();
            const responseCondition = await fetch('/School/school-equipment-condition');
            const resCondition = await responseCondition.json();
            const responseDisposition = await fetch('/School/school-equipment-disposition');
            const resDisposition = await responseDisposition.json();
            renderStatusForm(res, resCondition.data, resDisposition.data, equipmentId,cardIndex);
            document.getElementById('show-status-list').classList.remove('hidden');
            btnStatus.innerHTML = '';
            renderIcons();
        } catch (error) {
            console.error(error);
        }
    }
}

function renderStatusForm(res, condition, disposition, equipmentId,cardIndex) {
    const form = document.getElementById('statusForm');
    const data = res?.data ?? null
    const isUpdate = !!data;
    form.action = isUpdate ? `/School/school-equipment-status/${data.id}` : '/School/school-equipment-status';
    form.method = 'POST';
    form.className = ('space-y-4');
    form.innerHTML = `
            <div class="flex flex-col items-center justify-center gap-0">
            <input type="hidden" name="_token" value="${document.querySelector('meta[name=csrf-token]').getAttribute('content')}">
    
            <div class="text-center">
                <div class="text-2xl font-bold text-gray-700">School Equipment Status</div>
                <div class="text-md text-gray-600 mb-4">Assigning Status to School Equipment</div>
            </div>
        </div>

            <input type="hidden" name="_method" value="${isUpdate ? 'PUT' : 'POST'}">
            <input type="hidden" name="school_equipment_id" value="${equipmentId ?? ''}">
            <input type="hidden" name="id" value="${data?.id ?? ''}">
            <input type="hidden" name="cardIndex" value="${cardIndex ?? ''}">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        
            <div class="flex flex-col">
                <label class="form-label">Equipment Condition</label>
                <select name="equipment_condition_id" required
                        class="form-input">
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
                <label class="form-label">Status Disposition Status</label>
                <select name="disposition_status_id"  
                        class="form-input">
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
                    <label class="form-label">Warranty Start Date</label>
                    <input type="date" name="start_warranty_date" value="${data?.start_warranty_date ?? ''}"  
                        class="form-input">
                </div>
            <div class="flex flex-col">
                    <label class="form-label">Warranty End Date</label>
                    <input type="date" name="end_warranty_date" value="${data?.end_warranty_date ?? ''}"  
                        class="form-input">
                </div>
                
                <div class="flex flex-col">
                    <label class="form-label">Equipment Location</label>
                    <input type="text" name="equipment_location" value="${data?.equipment_location ?? ''}"  
                        class="form-input">
                </div>

                <div class="flex flex-col">
                    <label class="form-label">Non Functional</label>
                    <select name="non_functional" required
                        class="form-input">
                        <option value="" >Select  </option>
                        <option value="1" ${data?.non_functional == 1 ? 'selected' : ''}>Yes</option>
                        <option value="0" ${data?.non_functional == 0 ? 'selected' : ''}>No</option>
                    </select>    
                </div>
                </div>
                
                        <div class="flex flex-row justify-end w-full gap-2">
                <button type="button" onclick="closeComponentModal('show-status-list')"
                class=" w-fit btn-cancel px-4 py-1 rounded transition-colors">
                Cancel
                </button>
                <button type="submit" id="submitStatusBtn"
                        class="w-fit ${isUpdate ? 'btn-green' : 'btn-submit'}  px-4 py-1 rounded transition-colors">
                    ${isUpdate ? 'Update Status' : 'Save Status'}
                </button>
            </div>
 
    `;

}

window.showStatusModal = showStatusModal;