 <div id="edit-modal" class="modal  hidden">
     <div class="modal-content medium-modal thin-scroll">
         <div class="flex flex-col justify-center  text-center w-full mb-4">
             <div
                 class="h-16 w-16 bg-white p-3 border mx-auto border-gray-300 shadow-lg rounded-full flex items-center justify-center">
                 <div class="text-white bg-green-600 p-2 rounded-full">
                     <svg class="w-10 h-10" version="1.1" id="Icons" xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" xml:space="preserve"
                         fill="currentColor">
                         <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                         <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                         <g id="SVGRepo_iconCarrier">
                             <style type="text/css">
                                 .st0 {
                                     fill: none;
                                     stroke: currentColor;
                                     stroke-width: 2;
                                     stroke-linecap: round;
                                     stroke-linejoin: round;
                                     stroke-miterlimit: 10;
                                 }
                             </style>
                             <g>
                                 <path
                                     d="M16,12H3c-0.6,0-1,0.4-1,1v9c0,0.6,0.4,1,1,1h13c0.6,0,1-0.4,1-1v-9C17,12.4,16.6,12,16,12z">
                                 </path>
                                 <path d="M13,25H6c-0.6,0-1,0.4-1,1s0.4,1,1,1h7c0.6,0,1-0.4,1-1S13.6,25,13,25z"></path>
                                 <path
                                     d="M29,5H19c-0.6,0-1,0.4-1,1v20c0,0.6,0.4,1,1,1h10c0.6,0,1-0.4,1-1V6C30,5.4,29.6,5,29,5z M28,7v9h-8V7H28z">
                                 </path>
                                 <path d="M22,11h4c0.6,0,1-0.4,1-1s-0.4-1-1-1h-4c-0.6,0-1,0.4-1,1S21.4,11,22,11z">
                                 </path>
                                 <path d="M26,12h-1c-0.6,0-1,0.4-1,1s0.4,1,1,1h1c0.6,0,1-0.4,1-1S26.6,12,26,12z"></path>
                             </g>
                         </g>
                     </svg>
                 </div>
             </div>
             <div class="page-title">
                 Edit Non-DCP Item
             </div>
             <div class="page-subtitle">This information will be included for reports.</div>
         </div>
         <form action="{{ route('schools.nondcpitem.update') }}" method="POST"
             class="grid md:grid-cols-2 grid-cols-1 gap-2">
             @csrf
             @method('PUT')
             <input type="hidden" name="pk_non_dcp_item_id" id="pk_non_dcp_item_id">
             <div class="mb-2  md:col-span-1 col-span-2">
                 <label for="item_description" class="">Item Description</label>
                 <textarea id="item_description" placeholder="eg. Computer, Laptop, Smart TV" name="item_description"
                     class="border border-gray-300 px-2  w-full  py-1"></textarea>
             </div>
             <div class="mb-2 md:col-span-1 col-span-2">
                 <label for="unit_price" class="">Unit Price</label>
                 <input type="number" id="unit_price" step="0.01" name="unit_price" placeholder="0.00"
                     class="border border-gray-300 w-full  px-2 py-1">
             </div>
             <div class="mb-2 md:col-span-1 col-span-2">
                 <label for="date_acquired" class="">Date Acquired</label>
                 <input type="date" id="date_acquired" name="date_acquired"
                     class="border border-gray-300  w-full px-2 py-1">
             </div>
             <div class="mb-2 md:col-span-1 col-span-2">
                 <label for="total_item" class="">Total Item</label>
                 <input placeholder="0" id="total_item" type="text" name="total_item"
                     class="border border-gray-300 w-full  px-2 py-1">
             </div>
             <div class="mb-2 md:col-span-1 col-span-2">
                 <label for="total_functional" class="">Total Functional</label>
                 <input type="text" placeholder="0" id="total_functional" name="total_functional"
                     class="border border-gray-300 w-full  px-2 py-1">
             </div>
             <div class="mb-2 md:col-span-1 col-span-2">
                 <label for="fund_source">Fund Source</label>
                 <select name="fund_source_id" id="fund_source_id"
                     class="w-full border border-gray-400 w-full  rounded px-2 py-1">
                     @php
                         $fund_sources = App\Models\FundSource::all();
                     @endphp
                     <option value="">Select </option>
                     @foreach ($fund_sources as $fund_source)
                         <option value="{{ $fund_source->pk_fund_source_id }}">{{ $fund_source->name }}</option>
                     @endforeach
                 </select>

             </div>
             <div class="mb-2 md:col-span-1 col-span-2">
                 <label for="item_holder_and_location">Item Holder - Location</label>
                 <textarea name="item_holder_and_location" id="item_holder_and_location" class="border border-gray-300  w-full px-2 py-1"
                     placeholder="Name and Location of the Item User"></textarea>
             </div>
             <div class="mb-2 md:col-span-1 col-span-2">
                 <label for="remarks">Remarks</label>
                 <textarea name="remarks" id="remarks" class="border border-gray-300   w-full px-2 py-1"
                     placeholder="Description of the Non-DCP item"></textarea>
             </div>
             <div class="flex md:justify-end justify-center  col-span-2 gap-2  ">
                 <button type="button" class="md:w-auto w-full py-1 px-4 btn-cancel rounded   "
                     onclick="document.getElementById('edit-modal').classList.add('hidden')">
                     Cancel
                 </button>
                 <button type="submit" class="md:w-auto w-full  btn-green py-1 px-4   rounded   ">
                     Update this Item
                 </button>
             </div>
         </form>
     </div>
 </div>
