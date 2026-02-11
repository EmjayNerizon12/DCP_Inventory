import { loadEquipment } from "./_loadEquipment";

 const accountabilityForm = document.getElementById('accountabilityForm');
    accountabilityForm.addEventListener('submit', async function (e) {
    e.preventDefault();
    const button = document.getElementById('submitAccountabilityBtn');
    buttonLoading(button);

    const formData = new FormData(accountabilityForm);
    const cardNumber = formData.get('cardIndex');      
    const response = await fetch(accountabilityForm.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        },
        body: formData
    });
    const data = await response.json();  
    if(!response.ok){
        handleErrors(data.errors);
        resetButton(button, 'Submit');
        return;
    }
    renderStatusModal(data);
    resetButton(button, 'Submit');
    formData.reset();
    loadEquipment(school_id);
    scrollTo(`equipment-container-${cardNumber}`);
    closeComponentModal('show-user-list');
    clearErrors();
 });