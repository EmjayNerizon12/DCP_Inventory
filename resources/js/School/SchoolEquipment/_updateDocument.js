import { renderIcons } from "../../custom";
const editDocumentForm = document.getElementById('editDocumentForm');
editDocumentForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const editDocumentButton = document.getElementById('editDocumentButton');
    buttonLoading(editDocumentButton);
    const formData = new FormData(editDocumentForm);
    const response = await fetch(editDocumentForm.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        },
        body: formData
    });
    const data = await response.json();
    if (!response.ok) {
        resetButton(editDocumentButton, 'Save Document');
        handleErrors(data.errors);
        return;
    }
    closeComponentModal('edit-document-modal');
    renderStatusModal(data);
    renderIcons();
    resetButton(editDocumentButton, 'Save Document');
    await loadEquipment(school_id);
    formData.reset();
    clearErrors();
})