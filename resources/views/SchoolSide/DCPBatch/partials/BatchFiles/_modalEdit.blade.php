  <div id="edit-modal" class="modal hidden ">
      <div class="modal-content small-modal">

          <div class="flex flex-col items-center justify-center ">


              <div class="w-full flex flex-row items-center justify-center">
                  <div
                      class="h-16 w-16 bg-white p-3 border border-gray-300 shadow-lg rounded-full flex items-center justify-center">
                      <div class="text-white bg-green-600 p-2 rounded-full">
                          <svg class="w-10 h-10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                              <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                              <g id="SVGRepo_iconCarrier">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M6 1C4.34315 1 3 2.34315 3 4V20C3 21.6569 4.34315 23 6 23H18C19.6569 23 21 21.6569 21 20V8.82843C21 8.03278 20.6839 7.26972 20.1213 6.70711L15.2929 1.87868C14.7303 1.31607 13.9672 1 13.1716 1H6ZM5 4C5 3.44772 5.44772 3 6 3H12V8C12 9.10457 12.8954 10 14 10H19V20C19 20.5523 18.5523 21 18 21H6C5.44772 21 5 20.5523 5 20V4ZM18.5858 8L14 3.41421V8H18.5858Z"
                                      fill="currentColor"></path>
                              </g>
                          </svg>
                      </div>
                  </div>
              </div>
              <div class="w-full flex flex-col justify-center">

                  <div class="page-title text-center"> DCP Batch Files
                  </div>

                  <div class="page-subtitle text-center">Update Status & Files
                  </div>
              </div>
          </div>
          <form action="{{ route('batch_status.update', ['batchId' => $batchId]) }}" method="POST"
              enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="space-y-4">
                  <label for="status" class="font-semibold text-gray-800">
                      <span id="title"></span>
                  </label>
                  <select name="status" id="status" class="form-input ">
                      <option value="">Select</option>
                      <option value="yes">Yes</option>
                      <option value="no">No</option>
                  </select>
                  <input type="hidden" name="type" id="type">
                  <div id="file-wrapper" class="hidden">
                      <p id="current-file" class="text-md text-gray-600 my-4"></p>

                      <label for="file" class="font-semibold text-gray-800">Change File Uploaded</label>
                      <input type="file" name="file" id="file" class="form-input" accept=".pdf,.doc,.docx" />
                  </div>

                  <div id="code_wrapper" class="hidden">
                      <div>
                          <label for="code_of_file" class="font-semibold text-gray-800"><span id="title_2"></span>
                              Code</label>
                          <input class="form-input" type="text" name="code_of_file" id="code">
                      </div>
                      <div>
                          <label for="date_of_file" class="font-semibold text-gray-800"><span id="title_3"></span>
                              Date</label>
                          <input class="form-input" type="date" name="date_of_file" id="date">
                      </div>

                  </div>

                  <div class="flex md:justify-end justify-center gap-2  ">
                      <button type="button" onclick="document.getElementById('edit-modal').classList.add('hidden')"
                          class="btn-cancel   w-full  py-1 px-4 rounded    ">
                          Cancel
                      </button>
                      <button type="submit" class=" btn-green w-full  py-1 px-4 rounded  ">
                          Update Information
                      </button>

                  </div>

              </div>
          </form>
      </div>
  </div>
