 <x-modal id="add-info-modal" size="super-large-modal" type="add" icon="wifi-lg">
     <form id="addInfoForm" action="{{ route('ISP-Info.store') }}" method="POST" class="mt-2">
         @csrf
         @method('POST')
         <div class="flex flex-col items-center justify-center gap-0">

             <div class="text-center">
                 <div class="page-title">Additional Information for Internet Service</div>
                 <div class="page-subtitle">Information of School's Internet</div>
             </div>
         </div>
         <input type="hidden" name="school_internet_id" id="school_internet_id">
         <input type="hidden" name="card-index" id="info-card-index">
         <div class="grid md:grid-cols-3 grid-cols-1 gap-2 mb-4">
             <div class="md:col-span-3 col-span-1 text-lg font-semibold mt-4">
                 Basic Information
                 <hr>
             </div>
             <x-input-field type="number" name="cost_per_month" label="Cost Per Month" :required="true"
                 :edit="false" />
             <x-input-field type="text" name="account_number" label="Account Number" :required="true"
                 :edit="false" />
             <x-input-field type="text" name="description" label="Description of Package Purchased" :required="true"
                 :edit="false" />
             <x-select-field name="subscription_type" label="Subscription Type" :options="collect([['id' => 'Prepaid', 'name' => 'Prepaid'], ['id' => 'Postpaid', 'name' => 'Postpaid']])" :required="true"
                 :edit="false" />
             <div class="md:col-span-3 col-span-1 text-lg font-semibold mt-4">
                 Contract Duration
                 <hr>
             </div>
             <x-input-field type="date" name="contract_start" label="Start of Contract" :required="true"
                 :edit="false" />
             <x-input-field type="date" name="contract_end" label="End of Contract" :required="true"
                 :edit="false" />
             <x-select-field name="inactive_contract" label="Is Inactive/Contract Ended ?" :options="collect([['id' => '1', 'name' => 'Yes'], ['id' => '0', 'name' => 'No']])"
                 :required="true" :edit="false" />
             <div class="md:col-span-3 col-span-1 text-lg font-semibold mt-4">
                 Acquisition and Funding Details
                 <hr>
             </div>
             <x-select-field name="mode_of_acq_id" label="Mode of Acquisition" :options="App\Models\ISPInfo\ISPModeOfAcq::all()" :required="false"
                 :edit="false" />
             <x-select-field name="source_of_acq_id" label="Source of Acquisition" :options="App\Models\ISPInfo\ISPSourceOfAcq::all()" :required="false"
                 :edit="false" />
             <x-input-field type="text" name="donor" label="Donor" :required="false" :edit="false" />
             <x-select-field name="source_of_fund_id" label="Source of Fund" :options="App\Models\ISPInfo\ISPSourceOfFund::all()" :required="false"
                 :edit="false" />
             <div class="md:col-span-3 col-span-1 text-lg font-semibold mt-4">
                 Location & Access Points
                 <hr>
             </div>
             <x-input-field type="number" name="total_no_access_points" label="Total Access Point" :required="false"
                 :edit="false" />
             <x-input-field type="text" name="location_of_access_points" label="Location of Access Point"
                 :required="false" :edit="false" />
             <x-input-field type="number" name="total_admin_area_isps" label="No. of Admin Area Rooms covered by ISP"
                 :required="false" :edit="false" />
             <x-input-field type="number" name="total_classroom_isps" label="No. of Classrooms covered by ISP"
                 :required="false" :edit="false" />
             <div class="md:col-span-3 col-span-1 text-lg font-semibold mt-4">
                 Performance Rating
                 <hr>
             </div>
             <x-select-field name="admin_area_rate_id" label="Rate ISP for AdminArea" :options="App\Models\ISPInfo\ISPRating::all()"
                 :required="false" :edit="false" />
             <x-select-field name="classroom_area_rate_id" label="Rate ISP for AdminArea" :options="App\Models\ISPInfo\ISPRating::all()"
                 :required="false" :edit="false" />
             <x-select-field name="rate" label="Rate the Overall ISP" :options="collect([
                 ['id' => '5', 'name' => '5 ★★★★★'],
                 ['id' => '4', 'name' => '4 ★★★★'],
                 ['id' => '3', 'name' => '3 ★★★'],
                 ['id' => '2', 'name' => '2 ★★'],
                 ['id' => '1', 'name' => '1 ★'],
             ])" :required="false"
                 :edit="false" />
         </div>
         <div class="grid grid-cols-2 max-w-xs ml-auto gap-2">
             <button type="button"
                 onclick="document.getElementById('add-info-modal').classList.add('hidden');document.body.classList.remove('overflow-hidden');"
                 class="btn-cancel md:w-auto w-full py-1 px-4 rounded">
                 Cancel
             </button>
             <button id="add-info-button" type="submit" class="btn-submit md:w-auto w-full py-1 px-4 rounded">
                 Save Info
             </button>
         </div>
     </form>
 </x-modal>
 <x-modal id="edit-info-modal" size="super-large-modal" type="edit" icon="wifi-lg">
     <form id="infoUpdateForm" method="POST" class="mt-2">
         @csrf
         @method('PUT')
         <div class="flex flex-col items-center justify-center gap-0">
             <div class="text-center">
                 <div class="page-title">Update Additional Information for Internet Service
                 </div>
                 <div class="page-subtitle">Information of School's Internet</div>
             </div>
         </div>
         <input type="hidden" name="school_internet_id" id="edit_school_internet_id">
         <input type="hidden" name="id" id="id">
         <div class="grid md:grid-cols-3 grid-cols-1 gap-2 mb-4">
             <div class="md:col-span-3 col-span-1 text-lg font-semibold mt-4">
                 Basic Information
                 <hr>
             </div>
             <x-input-field type="number" name="cost_per_month" label="Cost Per Month" :required="true"
                 :edit="true" />

             <x-input-field type="text" name="account_number" label="Account Number" :required="true"
                 :edit="true" />
             <x-input-field type="text" name="description" label="Description of Package Purchased"
                 :required="true" :edit="true" />
             <x-select-field name="subscription_type" label="Subscription Type" :options="collect([['id' => 'Prepaid', 'name' => 'Prepaid'], ['id' => 'Postpaid', 'name' => 'Postpaid']])" :required="true"
                 :edit="true" />

             <div class="md:col-span-3 col-span-1 text-lg font-semibold mt-4">
                 Contract Duration
                 <hr>
             </div>
             <x-input-field type="date" name="contract_start" label="Start of Contract" :required="true"
                 :edit="true" />
             <x-input-field type="date" name="contract_end" label="Start of Contract" :required="true"
                 :edit="true" />
             <x-select-field name="inactive_contract" label="Is Inactive/Contract Ended ?" :options="collect([['id' => '1', 'name' => 'Yes'], ['id' => '0', 'name' => 'No']])"
                 :required="true" :edit="true" />
             <div class="md:col-span-3 col-span-1 text-lg font-semibold mt-4">
                 Acquisition and Funding Details
                 <hr>
             </div>
             <x-select-field name="mode_of_acq_id" label="Mode of Acquisition" :options="App\Models\ISPInfo\ISPModeOfAcq::all()" :required="false"
                 :edit="true" />
             <x-select-field name="source_of_acq_id" label="Source of Acquisition" :options="App\Models\ISPInfo\ISPSourceOfAcq::all()"
                 :required="false" :edit="true" />
             <x-input-field type="text" name="donor" label="Donor" :required="false" :edit="true" />
             <x-select-field name="source_of_fund_id" label="Source of Fund" :options="App\Models\ISPInfo\ISPSourceOfFund::all()" :required="false"
                 :edit="true" />
             <div class="md:col-span-3 col-span-1 text-lg font-semibold mt-4">
                 Location & Access Points
                 <hr>
             </div>

             <x-input-field type="number" name="total_no_access_points" label="Total Access Point"
                 :required="false" :edit="true" />
             <x-input-field type="text" name="location_of_access_points" label="Location of Access Point"
                 :required="false" :edit="true" />

             <x-input-field type="number" name="total_admin_area_isps"
                 label="No. of Admin Area Rooms covered by
                        ISP" :required="false"
                 :edit="true" />


             <x-input-field type="number" name="total_classroom_isps" label="No. of Classrooms covered by ISP"
                 :required="false" :edit="true" />
             <div class="md:col-span-3 col-span-1 text-lg font-semibold mt-4">
                 Performance Rating
                 <hr>
             </div>
             <x-select-field name="admin_area_rate_id" label="Rate ISP for AdminArea" :options="App\Models\ISPInfo\ISPRating::all()"
                 :required="false" :edit="true" />
             <x-select-field name="classroom_area_rate_id" label="Rate ISP for AdminArea" :options="App\Models\ISPInfo\ISPRating::all()"
                 :required="false" :edit="true" />
             <x-select-field name="rate" label="Rate the Overall ISP" :options="collect([
                 ['id' => '5', 'name' => '5 ★★★★★'],
                 ['id' => '4', 'name' => '4 ★★★★'],
                 ['id' => '3', 'name' => '3 ★★★'],
                 ['id' => '2', 'name' => '2 ★★'],
                 ['id' => '1', 'name' => '1 ★'],
             ])" :required="false"
                 :edit="true" />


         </div>
         <div class="grid grid-cols-2 max-w-xs ml-auto gap-2">

             <button type="button"
                 onclick="document.getElementById('edit-info-modal').classList.add('hidden');document.body.classList.remove('overflow-hidden');"
                 class="btn-cancel md:w-auto w-full py-1 px-4 rounded">
                 Cancel
             </button>
             <button id="update-info-button" type="submit" class="btn-green md:w-auto w-full py-1 px-4 rounded">
                 Update Info
             </button>
         </div>
     </form>
 </x-modal>


 <script>
     function showInfoModal(school_internet_id, cardNumber) {
         const cardIndex = document.getElementById('info-card-index');
         cardIndex.value = cardNumber;

         document.getElementById('school_internet_id').value = school_internet_id;
         document.getElementById('add-info-modal').classList.remove('hidden');
         document.body.classList.add('overflow-hidden');
     }

     function showEditInfoModal(edit_id, school_internet_id, data = {}) {
         try {
             if (typeof data === 'string') {
                 data = JSON.parse(data);
             }
         } catch (e) {
             console.warn('Failed to parse data for showEditModal', e);
             data = {};
         }

         document.getElementById('edit_school_internet_id').value = school_internet_id || '';

         const setValue = (id, val) => {
             const el = document.getElementById(id);
             if (!el) return;
             if (el.tagName === 'SELECT' || el.type === 'checkbox' || el.type === 'radio' || el.type === 'text' || el
                 .type === 'number' || el.type === 'date') {
                 el.value = (typeof val !== 'undefined' && val !== null) ? val : '';
             } else {
                 el.textContent = (typeof val !== 'undefined' && val !== null) ? val : '';
             }
         };

         // Map of input ids to data keys
         const map = {
             cost_per_month: 'cost_per_month',
             account_number: 'account_number',
             description: 'description',
             subscription_type: 'subscription_type',
             contract_start: 'contract_start',
             contract_end: 'contract_end',
             inactive_contract: 'inactive_contract',
             mode_of_acq_id: 'mode_of_acq_id',
             source_of_acq_id: 'source_of_acq_id',
             donor: 'donor',
             source_of_fund_id: 'source_of_fund_id',
             total_no_access_points: 'total_no_access_points',
             location_of_access_points: 'location_of_access_points',
             total_admin_area_isps: 'total_admin_area_isps',
             admin_area_rate_id: 'admin_area_rate_id',
             total_classroom_isps: 'total_classroom_isps',
             classroom_area_rate_id: 'classroom_area_rate_id',
             rate: 'rate'
         };

         Object.keys(map).forEach(id => {
             const key = map[id];
             setValue(id, data[key]);
         });
         document.getElementById('id').value = edit_id;
         document.getElementById('infoUpdateForm').action = `/School/ISP-Info/${edit_id}`;
         document.getElementById('edit-info-modal').classList.remove('hidden');
         document.getElementById('modal-table-info').classList.add('hidden');
         document.body.classList.add('overflow-hidden');


     }
     const infoUpdateForm = document.getElementById('infoUpdateForm');
     infoUpdateForm.addEventListener('submit', async (e) => {
         e.preventDefault();
         const button = document.getElementById('update-info-button');
         buttonLoading(button);
         const formData = new FormData(infoUpdateForm);
         formData.append('_method', 'PUT');
         const response = await fetch(infoUpdateForm.action, {
             method: 'POST',
             headers: {
                 'X-CSRF-TOKEN': '{{ csrf_token() }}',
                 'Accept': 'application/json'
             },
             body: formData
         });
         const data = await response.json();
         if (!response.ok) {
             handleErrors(data.errors);
             return;
         }
         infoUpdateForm.reset();
         resetButton(button, 'Update Info');
         renderStatusModal(data);
         closeComponentModal('edit-info-modal');
         await loadInternet(school_id);


     });


     const addInfoForm = document.getElementById('addInfoForm');
     addInfoForm.addEventListener('submit', async (e) => {
         e.preventDefault();
         const button = document.getElementById('add-info-button');
         buttonLoading(button);
         const formData = new FormData(addInfoForm);
         const response = await fetch(addInfoForm.action, {
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
             resetButton(button, 'Save Info');
             return;
         }
         addInfoForm.reset();
         resetButton(button, 'Save Info');
         closeComponentModal('add-info-modal');
         await loadInternet(school_id);
         renderStatusModal(data);
         clearErrors();

         const index = parseInt(formData.get('card-index'), 10);
         if (!Number.isNaN(index)) toggleCollapse(`isp-container-${index}`, index);

     });
 </script>
