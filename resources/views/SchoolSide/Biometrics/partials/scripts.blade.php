<script>
    function openEditModal(type, id, brand, total_object, object_type, powersource, location, total_amount, installer,
        functional, incharge, date_installed) {
        console.log(id, brand, total_object, object_type, powersource, location, total_amount, installer,
            functional, incharge, "DATE", date_installed);
        if (type == 'cctv') {
            document.getElementById("edit-overall-modal").classList.remove('hidden');
            document.getElementById('for-cctv').classList.remove('hidden');
            document.getElementById('edit-modal-title').textContent = "Update CCTV Details";
            document.getElementById('edit_primary_key').value = id;
            document.getElementById('edit_e_brand').value = brand;
            document.getElementById('edit_no_of_unit').value = total_object;
            document.getElementById('edit_e_cctv_type').value = object_type;
            document.getElementById('edit_e_power_source').value = powersource;
            document.getElementById('edit_e_location').value = location;
            document.getElementById('edit_total_amount').value = total_amount;
            document.getElementById('edit_e_installer').value = installer;
            document.getElementById('edit_no_of_functional').value = functional;
            document.getElementById('edit_e_incharge').value = incharge;
            document.getElementById('edit_date_installed').value = date_installed;
            document.getElementById('target').value = 'cctv';

        } else if (type == 'biometrics') {
            document.getElementById("edit-overall-modal").classList.remove('hidden');

            document.getElementById('for-biometric').classList.remove('hidden');
            document.getElementById('edit-modal-title').textContent = "Update Biometric Details";
            document.getElementById('edit_primary_key').value = id;
            document.getElementById('edit_e_brand').value = brand;
            document.getElementById('edit_no_of_unit').value = total_object;
            document.getElementById('edit_e_biometric_type').value = object_type;
            document.getElementById('edit_e_power_source').value = powersource;
            document.getElementById('edit_e_location').value = location;
            document.getElementById('edit_total_amount').value = total_amount;
            document.getElementById('edit_e_installer').value = installer;
            document.getElementById('edit_no_of_functional').value = functional;
            document.getElementById('edit_e_incharge').value = incharge;
            document.getElementById('edit_date_installed').value = date_installed;
            document.getElementById('target').value = 'biometric';

        }

        document.body.classList.add('overflow-hidden');
    }

    function openModal(type) {
        if (type == '1') {
            document.getElementById('add-cctv-modal').classList.remove('hidden')

            document.getElementById('selected_equipment_cctv').value = type;
        } else if (type == '2') {
            document.getElementById('selected_equipment_biometric').value = type;
            document.getElementById('add-biometric-modal').classList.remove('hidden')

        }
        document.body.classList.add('overflow-hidden');
    }

    function closeModal(type) {
        if (type == '1') {

            document.getElementById('add-cctv-modal').classList.add('hidden')
        } else if (type == '2') {

            document.getElementById('add-biometric-modal').classList.add('hidden')
        } else if (type == '3') {
            document.getElementById('edit-overall-modal').classList.add('hidden')
        }
        document.body.classList.remove('overflow-hidden');
    }

    function deleteFunction(id, type) {
        if (confirm("Are you sure you want to delete this record?")) {
            fetch('/School/Equipment/delete/' + id + '/' + type, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => {
                    if (response.ok) {
                        alert('Record deleted successfully!');
                        location.reload();
                    } else {
                        alert('Failed to delete record.');
                    }
                })
                .catch(error => console.error('Error:', error));
        }

    }
</script>
