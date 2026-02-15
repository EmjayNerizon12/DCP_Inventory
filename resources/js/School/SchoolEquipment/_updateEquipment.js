import { renderIcons } from "../../custom";
import { loadEquipment } from "./_loadEquipment";
export async function showEditModal(buttonId, equipment_id, dcp_batch_id, dcp_batch_item_id, non_dcp_item_id, property_number,
    old_property_number,
    serial_number,
    unit_of_measure_id, manufacturer_id, model, specifications, supplier_or_distributor, category_id,
    classification_id, non_dcp, pmp_reference_no, gl_sl_code, uacs_code, acquisition_cost,
    acquisition_date, mode_of_acquisition_id, source_of_acquisition_id, donor, source_of_fund_id,
    allotment_class_id, remarks) {
    await editLoadBatchItems(dcp_batch_id,dcp_batch_item_id);

    // Assign values to form inputs
    const button = document.getElementById(`edit-equipment-button-${buttonId}`);
    if (button) {
         button.innerHTML = `
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

    }
  

    // Step 1: Create a dictionary (object) mapping the element IDs to the corresponding values
    const formData = {
        'id': equipment_id,
        'property_number': property_number,
        'edit-select-dcp-batch-id': dcp_batch_id,
        'updateCardIndex': buttonId,
        'edit-select-dcp-batch-item': dcp_batch_item_id,
        'non_dcp_item_id': non_dcp_item_id,
        'old_property_number': old_property_number,
        'serial_number': serial_number,
        'unit_of_measure_id': unit_of_measure_id,
        'manufacturer_id': manufacturer_id,
        'model': model,
        'specifications': specifications,
        'supplier_or_distributor': supplier_or_distributor,
        'category_id': category_id,
        'classification_id': classification_id,
        'pmp_reference_no': pmp_reference_no,
        'gl_sl_code': gl_sl_code,
        'uacs_code': uacs_code,
        'acquisition_cost': acquisition_cost,
        'acquisition_date': acquisition_date,
        'mode_of_acquisition_id': mode_of_acquisition_id,
        'source_of_acquisition_id': source_of_acquisition_id,
        'donor': donor,
        'source_of_fund_id': source_of_fund_id,
        'allotment_class_id': allotment_class_id,
        'remarks': remarks
    };

    // Step 2: Use forEach to loop through the dictionary and set values
    for (const [elementId, value] of Object.entries(formData)) {
        document.getElementById(elementId).value = value ?? '';  // Set value or empty string if undefined
    }
    // Radio buttons for Non DCP
    const editDcpContainer = document.getElementById('editDcpBatchContainer');
    const editNonDCPContainer = document.getElementById('editNonDCPContainer');

    if (non_dcp == 1) {
        document.getElementById('edit_non_dcp_yes').checked = true;
        editNonDCPContainer.classList.remove('hidden');
        editDcpContainer.classList.add('hidden');
    } else {
        document.getElementById('edit_non_dcp_no').checked = true;
        editDcpContainer.classList.remove('hidden');
        editNonDCPContainer.classList.add('hidden');
    }

      const selectElement = document.getElementById('non_dcp_item_id');
  const selectedValue = non_dcp_item_id;

  const options = selectElement.querySelectorAll('option');
  options.forEach(option => {
    const optionValue = option.value;
    // If the option is the selected one, we don't disable it
    if (optionValue !== selectedValue && option.disabled === false && option.dataset.hasSchoolEquipment) {
      option.disabled = true; // Disable options that have schoolEquipment and are not selected
    } else {
      option.disabled = false; // Keep selected option enabled
    }
  });
    document.getElementById('editEquipmentForm').action = "/School/SchoolEquipment/" + equipment_id;
    const modal = document.getElementById('edit-equipment-modal');
    modal.classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
    button.innerHTML = '';
    renderIcons();
}


const editEquipmentForm= document.getElementById('editEquipmentForm');
editEquipmentForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const button = document.getElementById('equipment-update-button');
    buttonLoading(button);
    const formData = new FormData(editEquipmentForm);
    const cardIndex = formData.get('updateCardIndex');
    const response = await fetch(editEquipmentForm.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        },
        body: formData
    });
    const data = await response.json();
    if (!response.ok) {
        handleErrors(data.errors);
        resetButton(button, 'Update');
        return;
    }
    closeComponentModal('edit-equipment-modal');
    editEquipmentForm.reset();
    resetButton(button, 'Update');
    await loadEquipment(school_id);
    clearErrors();
    renderStatusModal(data);
    scrollTo(`equipment-container-${cardIndex}`);
});
window.showEditModal = showEditModal;
 