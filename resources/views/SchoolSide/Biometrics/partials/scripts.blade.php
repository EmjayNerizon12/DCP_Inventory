<script>
	const school_id = document.getElementById('school_id').value;

    function renderEditBiometricModal( id, brand, total_object, object_type, powersource, location, total_amount, installer,
        functional, incharge, date_installed) {
       
        document.getElementById("edit-biometric-modal").classList.remove('hidden');
        document.getElementById('edit-modal-title').textContent = "Update Biometric Details";
        
        document.getElementById('id').value = id;
		document.getElementById('target').value = 'biometric';

		document.getElementById('e_brand').value = brand;
		document.getElementById('no_of_units').value = total_object;
		document.getElementById('e_biometric_type').value = object_type;
		document.getElementById('e_power_source').value = powersource;
		document.getElementById('e_location').value = location;
		document.getElementById('total_amount').value = total_amount;
		document.getElementById('e_installer').value = installer;
		document.getElementById('no_of_functional').value = functional;
		document.getElementById('e_incharge').value = incharge;
		document.getElementById('date_installed').value = date_installed;
        document.body.classList.add('overflow-hidden');
    }

    function renderAddBiometricModal(type) {
        document.getElementById('selected_equipment').value = type;
        document.getElementById('add-biometric-modal').classList.remove('hidden')
        document.body.classList.add('overflow-hidden');
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
    	//This function prevents wrong input on total Functional equipment
	//This function prevents wrong input on total Functional equipment
	function createNumberInputValidation(totalUnitsInput, totalFunctionalInput) {
    return function () {
        totalFunctionalInput.max = totalUnitsInput.value;

        if (totalFunctionalInput.value > totalUnitsInput.value) {
            totalFunctionalInput.value = totalUnitsInput.value;
        }
    };
}

function initCCTVValidation(formId) {
    const form = document.getElementById(formId);
    if (!form) return;

    const totalUnitsInput = form.querySelector('[name="no_of_units"]');
    const totalFunctionalInput = form.querySelector('[name="no_of_functional"]');

    if (!totalUnitsInput || !totalFunctionalInput) return;

    function validate() {
        const units = totalUnitsInput.value;

        totalFunctionalInput.max = units;

        if (totalFunctionalInput.value > units) {
            totalFunctionalInput.value = units;
        }
    }

    totalFunctionalInput.addEventListener('input', validate);
}

document.addEventListener('DOMContentLoaded', function () {
    initCCTVValidation('addBiometricForm');
    initCCTVValidation('updateBiometricForm');
});
</script>
