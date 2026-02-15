{{-- Using component modal template --}}
<x-modal id="add-biometric-modal" size="large-modal" type="add" icon="biometric-lg">    
         <form action="{{ route('schools.equipment.store') }}" id="addBiometricForm" class="space-y-4" method="POST">
             @csrf
             @method('POST')
             <div class="flex flex-col gap-2 justify-center w-full">
                 <div class="w-full flex flex-row items-center justify-center">

                    
                 </div>
                 <div class="text-center">
                     <h2 class="font-bold text-2xl text-gray-800">Biometrics Information</h2>
                     <h3 class="font-normal text-lg text-gray-800 mb-4">Save Information for Reports</h3>
                 </div>
             </div>
           
             <div class="grid md:grid-cols-2 grid-cols-1 gap-2">
                   <div class="hidden">
                        <x-select-field name="selected_equipment" label="" :options="$equipment_type" :required="false" :edit="true" valueField="pk_equipment_type_id" textField="name" />
                    </div> 
                    <x-select-field name="e_brand" label="Brand/Model" :options="$equipment_brand_model" :required="true" :edit="false" valueField="pk_equipment_brand_model_id" textField="name" />
                    <x-select-field name="e_biometric_type" label="Biometric Authentication Type" :options="$biometric_type" :required="true" :edit="false" valueField="pk_e_biometric_type_id" textField="name" />
                    <x-input-field type="text" name="no_of_units" label="Total No. of Camera" :required="true" :edit="false" />
                    <x-select-field name="e_power_source" label="Power Source" :options="$equipment_power_source" :required="true" :edit="false" valueField="pk_equipment_power_source_id" textField="name" />
                    <x-select-field name="e_location" label="Location" :options="$equipment_location" :required="true" :edit="false" valueField="pk_equipment_location_id" textField="name" />
                    <x-input-field type="date" name="date_installed" label="Date Installed" :required="true" :edit="false" />
                    <x-input-field type="number" name="total_amount" label="Total Amount" :required="true" :edit="false" />
                    <x-select-field name="e_installer" label="Installer" :options="$equipment_installer" :required="true" :edit="false" valueField="pk_equipment_installer_id" textField="name" />
                    <x-input-field type="number" name="no_of_functional" label="Total No. of Functional" :required="true" :edit="false" /> 
                    <x-select-field name="e_incharge" label="Person In Charge" :options="$equipment_incharge" :required="true" :edit="false" valueField="pk_equipment_incharge_id" textField="name" />
             </div>

             <div class="modal-button-container">
                 <button type="button" onclick="closeComponentModal('add-biometric-modal')"
                     class="btn-cancel sm:w-fit w-full px-4 py-1 rounded   ">
                     Cancel
                 </button>
                 <button type="submit" id="addBiometricButton" class=" btn-submit px-4 py-1 sm:w-fit w-full  rounded   ">
                     Save Details
                 </button>
             </div>

         </form>
 </x-modal>
<script>
    const addBiometricForm = document.getElementById('addBiometricForm');
    addBiometricForm.addEventListener('submit',async (e) =>{
        const addBiometricButton= document.getElementById('addBiometricButton');
        buttonLoading(addBiometricButton);
        e.preventDefault();
        const formData = new FormData(addBiometricForm);
        const response = await fetch(addBiometricForm.action,{
            method: 'POST',
            headers:{
                'X-CSRF-TOKEN': '{{csrf_token()}}',
                'Accept': 'application/json'
            },
            body:formData
        });
        const data = await response.json();
        if(!response.ok){
            handleErrors(data.errors);
            resetButton(addBiometricButton,'Save Details');
            return;
        }
        closeComponentModal('add-biometric-modal');
        addBiometricForm.reset();
        loadBiometricTable(school_id)
        resetButton(addBiometricButton,'Save Details');
        renderStatusModal(data);
    });
 
</script>