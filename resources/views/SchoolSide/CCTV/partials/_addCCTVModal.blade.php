<x-modal id="add-cctv-modal" size="large-modal" type="add" icon="cctv-sm">

    <form action="{{ route('schools.equipment.store') }}" id="addCCTVForm" method="POST">
        @csrf
        @method('POST')
        <div class="flex flex-col gap-2 justify-center w-full">
             
            <div class="text-center">

                <h2 class="font-bold text-2xl text-gray-800">CCTV Information</h2>
                <h3 class="font-normal text-lg text-gray-800 mb-4">Save Information for Reports</h3>
            </div>
        </div>
        <div>
            <label for="e_type"></label>
            <select class="hidden " name="selected_equipment" id="selected_equipment_cctv">
                @foreach ($equipment_type as $e_type)
                    <option value="{{ $e_type->pk_equipment_type_id }}">{{ $e_type->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="grid md:grid-cols-2 grid-cols-1 gap-2">
 
            <x-select-field name="e_brand" label="Brand/Model" :options="$equipment_brand_model" :required="true" :edit="false" valueField="pk_equipment_brand_model_id" textField="name" />
            <x-select-field name="e_cctv_type" label="Camera Type" :options="$cctv_type" :required="true" :edit="false" valueField="pk_e_cctv_camera_type_id" textField="name" />
            <x-input-field type="text" name="no_of_cctv" label="Total No. of Camera" :required="true" :edit="false" />
            <x-select-field name="e_power_source" label="Power Source" :options="$equipment_power_source" :required="true" :edit="false" valueField="pk_equipment_power_source_id" textField="name" />
            <x-select-field name="e_location" label="Location" :options="$equipment_location" :required="true" :edit="false" valueField="pk_equipment_location_id" textField="name" />

            <div>
                <label for="date_installed" class="form-label">Date Installed <span class="text-red-600">(required)</span></label>
                <input required class="form-input" type="date"
                    name="date_installed" id="date_installed">
            </div>
            <div>
                <label for="total_amount" class="form-label">Total Amount <span class="text-red-600">(required)</span></label>
                <input required class="form-input" type="number" step="0.01"
                    name="total_amount" id="total_amount" placeholder="₱ 0.00">
            </div>
            <x-select-field name="e_installer" label="Installer" :options="$equipment_installer" :required="true" :edit="false" valueField="pk_equipment_location_id" textField="name" />

            <div>
                <label for="no_of_functional" class="form-label">Total No. of Functional <span class="text-red-600">(required)</span></label>
                <input required class="form-input" type="number"
                    name="no_of_functional" placeholder="0">
            </div>
           
            <x-select-field name="e_incharge" label="Person In Charge" :options="$equipment_incharge" :required="true" :edit="false" valueField="pk_equipment_incharge_id" textField="name" />

        </div>

        <div class="flex md:justify-end justify-center gap-2 mt-4">
            <button type="button" onclick="closeComponentModal('add-cctv-modal')"
                class="btn-cancel rounded md:w-auto w-full   px-4 py-1 rounded">
                Cancel
            </button>
            <button type="submit" id="addCCTVButton" class="btn-submit px-4 py-1 rounded md:w-auto w-full  ">
                Save Details
            </button>
        </div>

    </form>

</x-modal>

<script>
    const addCCTVForm = document.getElementById('addCCTVForm');
    addCCTVForm.addEventListener('submit',async (e) =>{
        const addCCTVButton= document.getElementById('addCCTVButton');
        buttonLoading(addCCTVButton);
        e.preventDefault();
        const formData = new FormData(addCCTVForm);
        const response = await fetch(addCCTVForm.action,{
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
            resetButton(addCCTVButton,'Save Details');
            return;
        }
        resetButton(addCCTVButton,'Save Details');
        renderStatusModal(data);
        formData.reset();
        closeComponentModal('add-cctv-modal');
    })
</script>
