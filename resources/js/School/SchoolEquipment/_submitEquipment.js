
import { renderIcons } from '../../custom.js';

const addEquipmentForm = document.getElementById('addEquipmentForm');
const addEquipmentFormButton = document.getElementById('addEquipmentForm-button');
addEquipmentForm.addEventListener('submit',async (e) => {
    e.preventDefault();
    buttonLoading(addEquipmentFormButton);
    const formData = new FormData(addEquipmentForm);
    const totalEquipment = parseInt(formData.get('totalEquipment')) + 1 ;
    const response = await fetch(addEquipmentForm.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: formData
    });
    const data = await response.json();
    if (!response.ok) {
        handleErrors(data.errors);
        resetButton(addEquipmentFormButton, 'Submit')
        return;
    }
    await loadEquipment(school_id);
    renderIcons();
    resetButton(addEquipmentFormButton, 'Submit');
    renderStatusModal(data);
    formData.reset();
    scrollTo(`equipment-container-${totalEquipment}`);
    closeComponentModal('add-equipment-modal');
});