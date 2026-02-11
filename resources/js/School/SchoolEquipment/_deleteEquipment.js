import { renderIcons } from '../../custom.js';

export async function deleteEquipment(equipmentId) {
    if (confirm('Are you sure you want to delete this equipment?')) {

       const form = document.getElementById(`delete-equipment-form-${equipmentId}`);
       const formData = new FormData(form);
       const response = await fetch(form.action, {
            method: 'POST', 
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        });
        const data = await response.json();
        if (!response.ok) {
            alert('Failed to delete equipment. Please try again.');
            return;
        }
        await loadEquipment(school_id);
        renderStatusModal(data);
        renderIcons();
    }else{
        return ;
    }
}
window.deleteEquipment = deleteEquipment;