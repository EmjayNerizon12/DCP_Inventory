   <div id="add-area-modal"
       class="modal fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
       <div class="modal-content bg-white px-4 py-1 mx-5 rounded-md">

           <form action="{{ route('isp.submit.area') }}" method="POST" class="mt-2">
               <h2 class="font-bold text-2xl text-gray-700">Add New ISP Area Location</h2>
               @csrf
               @method('POST')
               <div>
                   <label for="isp_area_name">ISP Area Name</label>
                   <input type="text" class="w-full p-1 border border-gray-400 rounded-sm my-2 " name="isp_area_name">
               </div>
               <div class="flex md:flex-row flex-col gap-2">
                   <button type="submit"
                       class="px-6 py-1  bg-blue-600 whitespace-nowrap w-full text-white rounded-sm hover:bg-blue-700 transition">Add
                       New Area </button>
                   <button onclick="closeAddISPModal('Area','add')" type="button"
                       class="px-6 py-1 w-full bg-gray-400 text-white rounded-sm hover:bg-gray-500 transition">Cancel</button>
               </div>

           </form>
       </div>
   </div>
   <div id="edit-area-modal"
       class="modal fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
       <div class="modal-content bg-white rounded-md px-4 py- mx-5">
           <form action="{{ route('isp.update.area') }}" method="POST" class="mt-2">
               @csrf
               @method('PUT')
               <input type="hidden" id="isp_area_id" name="isp_area_id">
               <h2 class="font-bold text-2xl  text-gray-700">Edit Area Details</h2>
               <div>
                   <label for="isp_name">Area Covered for the ISP</label>
                   <input class="w-full p-1 my-2 border border-gray-400 rounded-sm" type="text" name="isp_area_name"
                       id="isp_area_name">
               </div>
               <div class="flex md:flex-row flex-col gap-2">
                   <button type="submit"
                       class="px-6 py-1 bg-blue-600 text-white w-full rounded-sm hover:bg-blue-700 transition">Update
                       ISP Area Name</button>
                   <button onclick="closeAddISPModal('Area','edit')" type="button"
                       class="px-6 py-1 bg-gray-400 text-white rounded-sm hover:bg-gray-500 transition">Cancel</button>

               </div>

           </form>
       </div>
   </div>
   <div style="max-height: 400px" class=" bg-white shadow-xl h-full rounded-lg   border border-gray-300 px-5 py-5">
       <div class="flex flex-col h-full">
           <div>
               <div class="text-2xl font-bold text-gray-700    ">Area Distribution for the ISP</div>
               <div class="text-lg font-normal text-gray-600     ">Here are the list of name for the types of
                   area</div>

               <button onclick="showAddISPModal('Area')"
                   class="px-6 py-1 my-1 bg-blue-600 text-white rounded-sm hover:bg-blue-700 transition">Add New ISP
                   Area</button>
           </div>

           <div class="overflow-y-auto h-full scrollable-element">
               <table class="table-auto   w-full border-collapse">
                   <thead class="bg-gray-700 sticky top-0 z-10">
                       <tr>
                           <th class="py-2 px-2 text-white  ">No.</th>
                           <th class="py-2 px-2 text-white text-left  ">Area of ISP</th>
                       </tr>
                   </thead>
                   <tbody>
                       @foreach ($ISPArea as $index => $area)
                           <tr>
                               <td class="border border-gray-300 py-2 text-center bg-gray-100">{{ $index + 1 }}</td>
                               <td class="border border-gray-300 px-5">
                                   <div class="flex flex-row justify-between items-center">
                                       <div>{{ $area->name }}</div>
                                       <div class="flex flex-row gap-2">
                                           <!-- Edit Button -->
                                           <button type="button"
                                               onclick="showEditISPModal({{ $area->pk_isp_area_available_id }}, '{{ $area->name }}', 'Area')"
                                               class=" shadow-md flex items-center px-4 py-1 text-md bg-blue-500 text-white rounded-sm hover:bg-blue-600 transition-all">
                                               <!-- Pencil Icon -->
                                               <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2"
                                                   fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                   stroke-width="2">
                                                   <path stroke-linecap="round" stroke-linejoin="round"
                                                       d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7M16.5 3.5a2.121 2.121 0 113 3L12 14l-4 1 1-4 7.5-7.5z" />
                                               </svg>
                                               Edit
                                           </button>

                                           <!-- Delete Button -->
                                           <button type="button"
                                               onclick="deleteFunction({{ $area->pk_isp_area_available_id }}, 'Area')"
                                               class=" shadow-md flex items-center px-4 py-1 text-md bg-red-600 hover:bg-red-700 text-white rounded-sm transition-all">
                                               <!-- Trash Icon -->
                                               <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2"
                                                   fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                   stroke-width="2">
                                                   <path stroke-linecap="round" stroke-linejoin="round"
                                                       d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                               </svg>
                                               Delete
                                           </button>
                                       </div>

                                   </div>
                               </td>
                           </tr>
                       @endforeach
                   </tbody>
               </table>
           </div>

       </div>
   </div>
