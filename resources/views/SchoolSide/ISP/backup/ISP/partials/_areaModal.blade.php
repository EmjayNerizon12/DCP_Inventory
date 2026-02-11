  <div id="insert_area_modal" class="modal hidden">
      <div class="modal-content small-modal">
          <form action="{{ route('schools.isp.add.area') }}" class="mt-2" method="POST">
              @csrf
              @method('POST')
              <div class="flex flex-col items-center justify-center gap-0">

                  <div class="w-full flex flex-row items-center justify-center">
                      <div
                          class="h-16 w-16 bg-white p-3 border border-gray-300 shadow-lg rounded-full flex items-center justify-center">
                          <div class="text-white bg-blue-600 p-2 rounded-full">
                              @include('SchoolSide.components.svg.area_w_10')

                          </div>
                      </div>
                  </div>
                  <div class="text-center">
                      <div class="page-title">ISP Area/Location</div>
                      <div class="page-subtitle">Add New Area</div>
                  </div>
              </div>
              <input type="hidden" name="insert_isp_details_id" id="insert_isp_details_id">
              <div class="mb-4">
                  <label for="insert_isp_area_available_id">ISP Area of Connection</label>
                  <select class="border border-gray-400 rounded-md py-1 px-2 w-full" required
                      name="insert_isp_area_available_id" id="insert_isp_area_available_id">
                      @php
                          $isp_area = App\Models\ISP\ISPAreaAvailable::all();

                      @endphp
                      <option value="">Select Area</option>
                      @foreach ($isp_area as $area)
                          <option value="{{ $area->pk_isp_area_available_id }}">{{ $area->name }}</option>
                      @endforeach
                  </select>
              </div>
              <div class="flex flex-row justify-end gap-2 ">


                  <button title="Show Edit Modal" type="button" onclick="closeInsertAreaModal(1)"
                      class="btn-cancel w-full h-8 py-1 px-4 rounded">
                      Cancel
                  </button>
                  <button title="Show Edit Modal" type="submit" class="btn-submit w-full h-8 py-1 px-4 rounded">
                      Save Area
                  </button>




              </div>
          </form>
      </div>
  </div>
  <div id="edit_area_modal" class="modal hidden">
      <div class="modal-content small-modal">
          <form action="{{ route('schools.isp.update.area') }}" class="mt-2" method="POST">
              @csrf
              @method('PUT')
              <div class="flex flex-col items-center justify-center gap-0">

                  <div class="w-full flex flex-row items-center justify-center">
                      <div
                          class="h-16 w-16 bg-white p-3 border border-gray-300 shadow-lg rounded-full flex items-center justify-center">
                          <div class="text-white bg-green-600 p-2 rounded-full">
                              @include('SchoolSide.components.svg.area_w_10')

                          </div>
                      </div>
                  </div>
                  <div class="text-center">
                      <div class="page-title">ISP Area/Location</div>
                      <div class="page-subtitle">Edit/Update</div>
                  </div>
              </div>

              <div class="mb-4">
                  <input type="hidden" id="old_isp_area_id" name="old_isp_area_id">
                  <input type="hidden" id="isp_details_id" name="isp_details_id">
                  <label for="isp_area">ISP Area of Connection</label>
                  <select class="border border-gray-400 px-2 py-1 w-full rounded-sm" required
                      name="isp_area_available_id" id="isp_area_available_id">
                      <option value="" selected>Select area</option>
                      @php
                          $isp_area = App\Models\ISP\ISPAreaAvailable::all();
                      @endphp
                      @foreach ($isp_area as $area)
                          <option value="{{ $area->pk_isp_area_available_id }}">{{ $area->name }}
                          </option>
                      @endforeach
                  </select>
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
      </div>
  </div>
