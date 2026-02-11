import { renderIcons } from '../../custom.js';

export async function deleteDocument(documentId) {
    if (confirm('Are you sure you want to delete this Document?')) {

       const form = document.getElementById(`delete-document-form-${documentId}`);
       const formData = new FormData(form);
       form.action= `/School/school-equipment-document/${documentId}`;
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
            alert('Failed to delete document. Please try again.');
            return;
        }
        closeComponentModal('modal-equipment-document');
        await loadEquipment(school_id);
        renderStatusModal(data);
        renderIcons();
    }else{
        return ;
    }
}
window.deleteDocument = deleteDocument;