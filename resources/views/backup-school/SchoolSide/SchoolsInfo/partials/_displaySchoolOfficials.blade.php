  <div id="school_officials" class="bg-white rounded-md   overflow-hidden  ">
      <div class="text-2xl font-bold tracking-wider text-center w-full
           text-blue-600 uppercase my-2 ">School
          Officials
      </div>

      <form method="POST" action="{{ route('school.update.officials') }}">
          @csrf
          <div class="grid grid-cols-1 md:mx-auto   max-w-xl gap-6 text-gray-700">
              <!-- Principal -->
              <div class="p-4 shadow-md border border-gray-300">
                  <div class="bg-blue-200 text-gray- 800 border border-gray-800 mb-2  text-center p-2">

                      <h4 class="font-semibold text-gray-800 text-lg">SCHOOL HEAD</h4>
                  </div>
                  <div class="mb-2">
                      <label class="font-semibold">Name:</label>
                      <input type="text" name="PrincipalName"
                          value="{{ Auth::guard('school')->user()->school->PrincipalName }}"
                          class="w-full border rounded px-2 py-1" />
                  </div>
                  <div class="mb-2">
                      <label class="font-semibold">Contact:</label>
                      <input type="text" name="PrincipalContact"
                          value="{{ Auth::guard('school')->user()->school->PrincipalContact }}"
                          class="w-full border rounded px-2 py-1" />
                  </div>
                  <div class="mb-2">
                      <label class="font-semibold">Email:</label>
                      <input type="email" name="PrincipalEmail"
                          value="{{ Auth::guard('school')->user()->school->PrincipalEmail }}"
                          class="w-full border rounded px-2 py-1" />
                  </div>
              </div>
              <!-- ICT Coordinator -->
              <div class="p-4 shadow-md border border-gray-300">
                  <div class="bg-green-200 text-gray-800 border border-gray-800 mb-2  text-center p-2">

                      <h4 class="font-semibold text-gray-800 text-lg">SCHOOL ICT COORDINATOR</h4>
                  </div>
                  <div class="mb-2">
                      <label class="font-semibold">Name:</label>
                      <input type="text" name="ICTName" value="{{ Auth::guard('school')->user()->school->ICTName }}"
                          class="w-full border rounded px-2 py-1" />
                  </div>
                  <div class="mb-2">
                      <label class="font-semibold">Contact:</label>
                      <input type="text" name="ICTContact"
                          value="{{ Auth::guard('school')->user()->school->ICTContact }}"
                          class="w-full border rounded px-2 py-1" />
                  </div>
                  <div class="mb-2">
                      <label class="font-semibold">Email:</label>
                      <input type="email" name="ICTEmail"
                          value="{{ Auth::guard('school')->user()->school->ICTEmail }}"
                          class="w-full border rounded px-2 py-1" />
                  </div>
              </div>
              <!-- Property Custodian -->
              <div class="p-4 shadow-md border border-gray-300">
                  <div class="bg-yellow-200 text-gray-800 border border-gray-800 mb-2  text-center p-2">

                      <h4 class="font-semibold text-gray-800 text-lg">SCHOOL PROPERTY CUSTODIAN</h4>
                  </div>
                  <div class="mb-2">
                      <label class="font-semibold">Name:</label>
                      <input type="text" name="CustodianName"
                          value="{{ Auth::guard('school')->user()->school->CustodianName }}"
                          class="w-full border rounded px-2 py-1" />
                  </div>
                  <div class="mb-2">
                      <label class="font-semibold">Contact:</label>
                      <input type="text" name="CustodianContact"
                          value="{{ Auth::guard('school')->user()->school->CustodianContact }}"
                          class="w-full border rounded px-2 py-1" />
                  </div>
                  <div class="mb-2">
                      <label class="font-semibold">Email:</label>
                      <input type="email" name="CustodianEmail"
                          value="{{ Auth::guard('school')->user()->school->CustodianEmail }}"
                          class="w-full border rounded px-2 py-1" />
                  </div>
              </div>
          </div>
          <div class="md:mx-auto  max-w-xl">

              <div
                  class="h-10 my-2 w-fit bg-white p-1 border border-gray-300  shadow-md rounded-full flex items-center justify-center">

                  <button type="submit" class="btn-submit h-8 py-1 px-4 rounded-full">
                      Save Official Information
                  </button>
              </div>
          </div>
      </form>
  </div>
