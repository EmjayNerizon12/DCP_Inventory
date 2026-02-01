  <x-modal id="insert_area_modal" size="small-modal" type="add" icon="area_w_8">

      <form id="addAreaForm" action="{{ route('schools.isp.add.area') }}" class="mt-2" method="POST">
          @csrf
          @method('POST')
          <div class="flex flex-col items-center justify-center gap-0">
              <div class="text-center">
                  <div class="page-title">ISP Area/Location</div>
                  <div class="page-subtitle">Add New Area</div>
              </div>
          </div>
          <input type="hidden" id="card-index" name="card-index">
          <input type="hidden" name="insert_isp_details_id" id="insert_isp_details_id">

          <x-select-field name="insert_isp_area_available_id" label="ISP Area of Connection" :options="App\Models\ISP\ISPAreaAvailable::all()"
              :required="false" :edit="true" valueField="pk_isp_area_available_id" textField="name" />
          <div class="flex flex-row justify-end gap-2 mt-4">


              <button title="Show Edit Modal" type="button" onclick="closeInsertAreaModal(1)"
                  class="btn-cancel w-full h-8 py-1 px-4 rounded">
                  Cancel
              </button>
              <button id="area-save-button" title="Show Edit Modal" type="submit"
                  class="btn-submit w-full h-8 py-1 px-4 rounded">
                  Save Area
              </button>




          </div>
      </form>

  </x-modal>
  <x-modal id="edit_area_modal" size="small-modal" type="edit" icon="area_w_8">
      <form action="{{ route('schools.isp.update.area') }}" class="mt-2" method="POST">
          @csrf
          @method('PUT')
          <div class="flex flex-col items-center justify-center gap-0">
              <div class="text-center">
                  <div class="page-title">ISP Area/Location</div>
                  <div class="page-subtitle">Edit/Update</div>
              </div>
          </div>

          <div class="mb-4">
              <input type="hidden" id="old_isp_area_id" name="old_isp_area_id">
              <input type="hidden" id="isp_details_id" name="isp_details_id">
              <x-select-field name="isp_area_available_id" label="ISP Area of Connection" :options="App\Models\ISP\ISPAreaAvailable::all()"
                  :required="true" :edit="true" valueField="pk_isp_area_available_id" textField="name" />

          </div>
          <div class="flex flex-row justify-end gap-2">

              <button title="Show Edit Modal" type="button" onclick="closeEditAreaModal()"
                  class="btn-cancel  w-full py-1 px-4 rounded">
                  Cancel
              </button>
              <button title="Show Edit Modal" type="submit" class="btn-green w-full   py-1 px-4 rounded">
                  Update Area
              </button>



          </div>
      </form>
  </x-modal>


  <script>
      const addAreaForm = document.getElementById('addAreaForm');
      addAreaForm.addEventListener('submit', async (e) => {
          e.preventDefault();
          const button = document.getElementById('area-save-button');
          buttonLoading(button);
          const formData = new FormData(addAreaForm);

          const response = await fetch(addAreaForm.action, {
              method: 'POST',
              headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}',
                  'Accept': 'application/json',
              },
              body: formData
          });
          const data = await response.json();
          if (!response.ok) {
              handleErrors(data.errors);
              resetButton(button, 'Save Area');
              return;
          }
          addAreaForm.reset();
          closeComponentModal('insert_area_modal');
          resetButton(button, 'Save Area');
          renderStatusModal(data);
          // wait for the list to re-render so the card DOM exists, then toggle
          await loadInternet(school_id);
          const index = parseInt(formData.get('card-index'), 10);
          if (!Number.isNaN(index)) toggleCollapse(`isp-container-${index}`, index);
          scrollTo('isp-container-' + totalInternet);

      });
  </script>
