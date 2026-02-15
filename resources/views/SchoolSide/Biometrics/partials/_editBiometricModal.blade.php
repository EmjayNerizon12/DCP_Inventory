<x-modal id="edit-biometric-modal" size="large-modal" type="edit" icon="biometric-lg">    

        <form action="{{ route('schools.equipment.update') }}" id="updateBiometricForm" class="space-y-4" method="POST">
            @csrf
            @method('PUT')
            <div class="flex flex-col gap-2 justify-center w-full">
    
                <div class="text-center">
                    <h2 class="font-bold text-2xl text-gray-800" id="edit-modal-title">Update Information</h2>
                    <h3 class="font-normal text-lg text-gray-800 mb-4">Save Information for Reports</h3>
                </div>
            </div>
            
            
            <div class="grid md:grid-cols-2 grid-cols-1 gap-2">
                <input type="hidden" name="id" id="id">
                <input type="hidden" id="target" name="target">
                <x-select-field name="e_brand" label="Brand/Model" :options="$equipment_brand_model" :required="true" :edit="true" valueField="pk_equipment_brand_model_id" textField="name" />
                <x-select-field name="e_biometric_type" label="Biometric Authentication Type" :options="$biometric_type" :required="true" :edit="true" valueField="pk_e_biometric_type_id" textField="name" />
                <x-input-field type="number" name="no_of_units" label="Total No. of Camera" :required="true" :edit="true" />
                <x-select-field name="e_power_source" label="Power Source" :options="$equipment_power_source" :required="true" :edit="true" valueField="pk_equipment_power_source_id" textField="name" />
                <x-select-field name="e_location" label="Location" :options="$equipment_location" :required="true" :edit="true" valueField="pk_equipment_location_id" textField="name" />
                <x-input-field type="date" name="date_installed" label="Date Installed" :required="true" :edit="true" />
                <x-input-field type="number" name="total_amount" label="Total Amount" :required="true" :edit="true" />
                <x-select-field name="e_installer" label="Installer" :options="$equipment_installer" :required="true" :edit="true" valueField="pk_equipment_installer_id" textField="name" />
                <x-input-field type="number" name="no_of_functional" label="Total No. of Functional" :required="true" :edit="true" /> 
                <x-select-field name="e_incharge" label="Person In Charge" :options="$equipment_incharge" :required="true" :edit="true" valueField="pk_equipment_incharge_id" textField="name" />
            </div>

            <div class="modal-button-container">
                <button type="button" onclick="closeComponentModal('edit-biometric-modal')"
                    class="btn-cancel px-6 py-1 sm:w-fit w-full rounded   ">
                    Cancel
                </button>
                <button type="submit" id="updateBiometricButton" class="btn-green sm:w-fit w-full px-4 py-1  rounded   ">
                    Update Details
                </button>
            </div>

        </form>

</x-modal>
<script>
    const updateBiometricForm = document.getElementById('updateBiometricForm');
    const updateBiometricButton = document.getElementById('updateBiometricButton');
    updateBiometricForm.addEventListener('submit', async (e) =>{
        e.preventDefault();
        buttonLoading(updateBiometricButton);

        const formData = new FormData(updateBiometricForm);
        formData.append('_method','PUT');
        const response = await fetch(updateBiometricForm.action,{
            method: 'POST',
            headers:{
                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: formData
        });
        const data = await response.json();
        if(!response.ok){
            handleErrors(data.errors);
            resetButton(updateBiometricButton, 'Update Details');
            return;
        }
        closeComponentModal('edit-biometric-modal');
        updateBiometricForm.reset(); 
        loadBiometricTable(school_id);
        resetButton(updateBiometricButton, 'Update Details');
        renderStatusModal(data);
    }); 
</script>