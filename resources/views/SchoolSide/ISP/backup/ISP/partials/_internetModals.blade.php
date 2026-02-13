 <x-modal id="add-details-modal" size="large-modal" type="add" icon="wifi-sm">


     <form id="add-details-form" action="{{ route('schools.isp.store') }}" class="space-y-4" method="POST">
         @csrf
         @method('POST')
         <div class="flex flex-col items-center justify-center gap-0">

             <div class="text-center">
                 <div class="page-title">Internet Service Provider</div>
                 <div class="page-subtitle9">Information of School's Internet</div>
             </div>
         </div>
         <div class="grid md:grid-cols-2 grid-cols-1 gap-4">
             <x-select-field name='isp_list_id' label="Internet Service Provider" :options="App\Models\ISP\ISPList::all()" :edit="false"
                 :required="false" valueField="pk_isp_list_id" textField="name" />
             <x-select-field name='isp_purpose' label="Purpose" :options="App\Models\ISP\ISPPurpose::all()" :edit="false" :required="false"
                 valueField="pk_isp_purpose_id" textField="name" />

         </div>
         <div class="grid md:grid-cols-2 grid-cols-1 gap-4">

             <x-select-field name='isp_connection_type' label="Connection Type" :options="App\Models\ISP\ISPConnectionType::all()" :edit="false"
                 :required="false" valueField="pk_isp_connection_type_id" textField="name" />

             <x-select-field name='isp_internet_quality' label="Internet Quality" :options="App\Models\ISP\ISPInternetQuality::all()" :edit="false"
                 :required="false" valueField="pk_isp_internet_quality_id" textField="name" />
         </div>

         <div>
             <div class="font-bold text-xl ">
                 Speed Test Results
             </div>
             <div class="grid md:grid-cols-3 grid-cols-1 w-full gap-4">
                 <x-input-field type="number" name="isp_upload" label="Upload - mbps" :required="false"
                     :edit="false" />
                 <x-input-field type="number" name="isp_download" label="Download - mbps" :required="false"
                     :edit="false" />
                 <x-input-field type="number" name="isp_ping" label="Ping - mbps" :required="false"
                     :edit="false" />

             </div>
         </div>
         <div class="flex flex-col  ">
             <div class="flex flex-row items-end gap-2">
                 <x-select-field name='isp_area' label="ISP Area of Connection" :options="App\Models\ISP\ISPAreaAvailable::all()" :edit="true"
                     :required="false" valueField="pk_isp_area_available_id" textField="name" />
                 <button title="Insert Area" type="button" class="btn-submit px-4 py-1 rounded" onclick="addArea()">
                     Add Area
                 </button>
             </div>
             <div class="flex flex-row items-center mt-4">
                 Selected Area/s:
                 <div id="selected-areas"></div>
             </div>
         </div>
         <div class="grid grid-cols-2 max-w-xs ml-auto gap-2">
             <button title="Show Edit Modal" type="button" onclick="closeComponentModal('add-details-modal')"
                 class="btn-cancel py-1 px-4 md:w-auto w-full rounded">
                 Cancel
             </button>
             <button id="submit-button" title="Show Edit Modal" type="submit"
                 class="btn-submit md:w-auto w-full flex items-center justify-center py-1 px-4 rounded">
                 Submit
             </button>
         </div>
     </form>


 </x-modal>
 <x-modal id="edit-details-modal" size="large-modal" type="edit" icon="wifi-sm">

     <form id="updateDetailsForm" action="{{ route('schools.isp.update') }}" class="space-y-4" method="POST">
         @csrf
         @method('PUT')
         <div class="flex flex-col items-center justify-center gap-0">
             <input type="hidden" name="card-index" id="update-details-index">
             <x-input-field type="hidden" name='pk_isp_details_id' label="" :required="false"
                 :edit="true" />
             <div class="text-center">
                 <div class="page-title">Update Internet Service Provider</div>
                 <div class="page-subtitle">Information of School's Internet</div>
             </div>
         </div>

         <div class="grid md:grid-cols-2 grid-cols-1 gap-4">
             <x-select-field name='isp_list_id' label="Internet Service Provider" :options="App\Models\ISP\ISPList::all()" :edit="true"
                 :required="false" valueField="pk_isp_list_id" textField="name" />
             <x-select-field name='isp_purpose' label="Purpose" :options="App\Models\ISP\ISPPurpose::all()" :edit="true" :required="false"
                 valueField="pk_isp_purpose_id" textField="name" />

         </div>
         <div class="grid md:grid-cols-2 grid-cols-1 gap-4">

             <x-select-field name='isp_connection_type' label="Connection Type" :options="App\Models\ISP\ISPConnectionType::all()" :edit="true"
                 :required="false" valueField="pk_isp_connection_type_id" textField="name" />

             <x-select-field name='isp_internet_quality' label="Internet Quality" :options="App\Models\ISP\ISPInternetQuality::all()" :edit="true"
                 :required="false" valueField="pk_isp_internet_quality_id" textField="name" />
         </div>

         <div>
             <div class="font-bold text-xl ">
                 Speed Test Results
             </div>
             <div class="grid md:grid-cols-3 grid-cols-1 w-full gap-4">
                 <x-input-field type="number" name="isp_upload" label="Upload - mbps" :required="false"
                     :edit="true" />
                 <x-input-field type="number" name="isp_download" label="Download - mbps" :required="false"
                     :edit="true" />
                 <x-input-field type="number" name="isp_ping" label="Ping - mbps" :required="false"
                     :edit="true" />

             </div>
         </div>

         <div class="grid grid-cols-2 max-w-xs ml-auto gap-2">
             <button type="button" onclick="closeComponentModal('edit-details-modal')"
                 class="btn-cancel py-1 px-4 rounded md:w-auto w-full">
                 Cancel
             </button>
             <button id="update-details-button" type="submit"
                 class="btn-green  whitespace-nowrap h-8 py-1 px-4 rounded md:w-auto w-full  ">
                 Update
             </button>
         </div>
     </form>
 </x-modal>
 <script>
     const addDetailsForm = document.getElementById('add-details-form');
     addDetailsForm.addEventListener('submit', async (e) => {
         e.preventDefault();
         const button = document.getElementById('submit-button');
         buttonLoading(button);
         const formData = new FormData(addDetailsForm);
         const response = await fetch(addDetailsForm.action, {
             method: 'POST',
             headers: {
                 'X-CSRF-TOKEN': '{{ csrf_token() }}',
                 'Accept': 'application/json',
             },
             body: formData,
         });
         const data = await response.json();
         if (!response.ok) {
             handleErrors(data.errors);
             resetButton(button, 'Submit');
             renderStatusModal(data);

             return;
         }
         addDetailsForm.reset();
         resetButton(button, 'Submit');
         closeComponentModal('add-details-modal');
         await loadInternet(school_id);
         renderStatusModal(data);
         clearErrors();
         console.log(totalInternet);
         const index = parseInt(totalInternet, 10);
         if (!Number.isNaN(index)) toggleCollapse(`isp-container-${index}`, index);
         scrollTo('isp-container-' + totalInternet);
     });

     const updateDetailsForm = document.getElementById('updateDetailsForm');
     const updateButton = document.getElementById('update-details-button');
     updateDetailsForm.addEventListener('submit', async (e) => {
         e.preventDefault();
         buttonLoading(updateButton);
         const formData = new FormData(updateDetailsForm);
         formData.append('_method', 'PUT');
         const response = await fetch(updateDetailsForm.action, {
             method: 'POST',
             headers: {
                 'X-CSRF-TOKEN': '{{ csrf_token() }}',
                 'Accept': 'application/json'
             },
             body: formData,
         });
         const data = await response.json();
         if (!response.ok) {
             handleErrors(data.errors);
             resetButton(updateButton, 'Update');
             return;
         }
         resetButton(updateButton, 'Update');
         updateDetailsForm.reset();
         renderStatusModal(data);
         clearErrors();
         closeComponentModal('edit-details-modal');
         await loadInternet(school_id);
         const index = parseInt(formData.get('card-index'), 10);
         scrollTo('isp-container-' + totalInternet);
         if (!Number.isNaN(index)) toggleCollapse(`isp-container-${index}`, index);

     });
 </script>
