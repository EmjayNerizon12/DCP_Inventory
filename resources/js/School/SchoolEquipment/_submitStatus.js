import { loadEquipment } from './_loadEquipment.js';

const statusForm = document.getElementById('statusForm');
statusForm.addEventListener('submit', async function (e) {
    e.preventDefault();
    const button = document.getElementById('submitStatusBtn');
    buttonLoading(button);
    const formData = new FormData(statusForm);
    const response = await fetch(statusForm.action, {
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
        resetButton(button, 'Submit');
        return;
    }
    renderStatusModal(data);
    resetButton(button, 'Submit');
    formData.reset();
    loadEquipment(school_id);
    closeComponentModal('show-status-list');
    clearErrors();
});