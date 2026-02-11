import { renderIcons } from "../../custom";
const addDocumentForm = document.getElementById('addDocumentForm');
addDocumentForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const addDocumentButton = document.getElementById('addDocumentButton');
    buttonLoading(addDocumentButton);
    const formData = new FormData(addDocumentForm);
    const response = await fetch(addDocumentForm.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        },
        body: formData
    });
    const data = await response.json();
    if (!response.ok) {
        resetButton(addDocumentButton, 'Save Document');
        handleErrors(data.errors);
        return;
    }
    closeComponentModal('add-document-modal');
    renderStatusModal(data);
    renderIcons();
    resetButton(addDocumentButton, 'Save Document');
    await loadEquipment(school_id);
    formData.reset();
    clearErrors();
})