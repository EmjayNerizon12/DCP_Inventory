 import  { renderIcons } from '../../custom.js';
 import { loadDocumentModal } from './_getDocument.js';
 import { loadEquipment } from './_loadEquipment.js';
 import './_getAccountablity.js';
 import './_submitDocument.js';
 import './_getStatus.js';
 import './_deleteEquipment.js';
 import './_deleteDocument.js';
 import './_submitEquipment.js';
 import './_updateEquipment.js';
 import './_updateDocument.js';
 import './_printFunction.js';
    const school_id = document.getElementById('school_id').value;
    document.addEventListener('DOMContentLoaded', async () => {
        await loadEquipment(school_id);
        renderIcons();
    });
    document.querySelectorAll('.open-doc-btn').forEach(btn =>
        btn.addEventListener('click', e => loadDocumentModal(JSON.parse(btn.dataset.doc)))
    );

    var currentDate = new Date();
    var options = {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
    };
    var formattedDate = currentDate.toLocaleDateString(undefined, options);
    document.querySelectorAll('.current-time-date').forEach(el => {
        el.textContent = formattedDate;
    });
 