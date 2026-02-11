 <div class="grid md:grid-cols-3 grid-cols-1 gap-4 mb-4">
     <input type="hidden" name="id" id="id">
     {{-- Basic Info --}}
     <div>
         <label for="property_number">Property No. <span class="text-red-600">(required)</span></label>
         <input id="property_number" type="text" name="property_number"
             class="w-full border border-gray-400 rounded px-2 py-1">
     </div>

     <div>
         <label for="old_property_number">Old/Prev. Property No.</label>
         <input id="old_property_number" type="text" name="old_property_number"
             class="w-full border border-gray-400 rounded px-2 py-1">
     </div>

     <div>
         <label for="serial_number">Serial No. <span class="text-red-600">(required)</span></label>
         <input id="serial_number" type="text" name="serial_number"
             class="w-full border border-gray-400 rounded px-2 py-1">
     </div>

     <div>
         <label for="equipment_item_id">Item <span class="text-red-600">(required)</span></label>
         <select id="equipment_item_id" name="equipment_item_id"
             class="w-full border border-gray-400 rounded px-2 py-1">
             <option value="">Select</option>
             @foreach (App\Models\SchoolEquipment\EquipmentItems::all() as $item)
                 <option value="{{ $item->id }}">
                     {{ $item->name }}
                 </option>
             @endforeach
         </select>
     </div>

     <div>
         <label for="unit_of_measure_id">Unit of Measure <span class="text-red-600">(required)</span></label>
         <select id="unit_of_measure_id" name="unit_of_measure_id"
             class="w-full border border-gray-400 rounded px-2 py-1">
             <option value="">Select</option>
             @foreach (App\Models\SchoolEquipment\SchoolEquipmentUnitOfMeasure::all() as $item)
                 <option value="{{ $item->id }}">
                     {{ $item->name }}
                 </option>
             @endforeach
         </select>
     </div>

     <div>
         <label for="manufacturer_id">Manufacturer/Brand</label>
         <select id="manufacturer_id" name="manufacturer_id" class="w-full border border-gray-400 rounded px-2 py-1">
             <option value="">Select</option>
             @foreach (App\Models\SchoolEquipment\SchoolEquipmentManufacturer::all() as $item)
                 <option value="{{ $item->id }}">
                     {{ $item->name }}
                 </option>
             @endforeach
         </select>
     </div>

     <div>
         <label for="model">Model</label>
         <input id="model" type="text" name="model" class="w-full border border-gray-400 rounded px-2 py-1">
     </div>

     <div>
         <label for="specifications">Specification</label>
         <input id="specifications" type="text" name="specifications"
             class="w-full border border-gray-400 rounded px-2 py-1">
     </div>

     <div>
         <label for="supplier_or_distributor">Supplier or Distributor</label>
         <input id="supplier_or_distributor" type="text" name="supplier_or_distributor"
             class="w-full border border-gray-400 rounded px-2 py-1">
     </div>

     <div>
         <label for="category_id">Category</label>
         <select id="category_id" name="category_id" class="w-full border border-gray-400 rounded px-2 py-1">
             <option value="">Select</option>
             @foreach (App\Models\SchoolEquipment\SchoolEquipmentCategories::all() as $item)
                 <option value="{{ $item->id }}">
                     {{ $item->name }}
                 </option>
             @endforeach
         </select>
     </div>

     <div>
         <label for="classification_id">Classification</label>
         <select id="classification_id" name="classification_id"
             class="w-full border border-gray-400 rounded px-2 py-1">
             <option value="">Select</option>
             @foreach (App\Models\SchoolEquipment\SchoolEquipmentClassification::all() as $item)
                 <option value="{{ $item->id }}">
                     {{ $item->name }}
                 </option>
             @endforeach
         </select>
     </div>

     <div>
         <label class="font-medium">Non DCP <span class="text-red-600">(required)</span></label>
         <div class="flex items-center gap-4 mt-1">
             <label class="flex items-center gap-1">
                 <input type="radio" name="non_dcp" id="non_dcp_yes" value="1">
                 <span>Yes</span>
             </label>
             <label class="flex items-center gap-1">
                 <input type="radio" name="non_dcp" value="0" id="non_dcp_no">
                 <span>No</span>
             </label>
         </div>
     </div>

     <div>
         <label for="dcp_batch_id">DCP Batch</label>
         <select id="dcp_batch_id" name="dcp_batch_id" class="w-full border border-gray-400 rounded px-2 py-1">
             <option value="">Select</option>
             @foreach (App\Models\DCPBatch::where('school_id', Auth::guard('school')->user()->school->pk_school_id)->get() as $batch)
                 <option value="{{ $batch->pk_dcp_batches_id }}">
                     {{ $batch->batch_label }}
                 </option>
             @endforeach
         </select>
     </div>

     <div>
         <label for="pmp_reference_no">Procurement Management Plan (PMP) No.</label>
         <input id="pmp_reference_no" type="text" name="pmp_reference_no"
             class="w-full border border-gray-400 rounded px-2 py-1">
     </div>

     <div>
         <label for="gl_sl_code">GL-SL Code (NGAS Code)</label>
         <input id="gl_sl_code" type="text" name="gl_sl_code"
             class="w-full border border-gray-400 rounded px-2 py-1">
     </div>

     <div>
         <label for="uacs_code">UACS</label>
         <input id="uacs_code" type="text" name="uacs_code"
             class="w-full border border-gray-400 rounded px-2 py-1">
     </div>

     <div>
         <label for="acquisition_cost">Acquisition Cost</label>
         <input id="acquisition_cost" type="number" step="0.01" name="acquisition_cost"
             class="w-full border border-gray-400 rounded px-2 py-1">
     </div>

     <div>
         <label for="acquisition_date">Acquisition Date</label>
         <input id="acquisition_date" type="date" name="acquisition_date"
             class="w-full border border-gray-400 rounded px-2 py-1">
     </div>

     <div>
         <label for="mode_of_acquisition_id">Mode of Acquisition</label>
         <select id="mode_of_acquisition_id" name="mode_of_acquisition_id"
             class="w-full border border-gray-400 rounded px-2 py-1">
             <option value="">Select</option>
             @foreach (App\Models\SchoolEquipment\SchoolEquipmentModeOfAcquisition::all() as $item)
                 <option value="{{ $item->id }}">
                     {{ $item->name }}
                 </option>
             @endforeach
         </select>
     </div>

     <div>
         <label for="source_of_acquisition_id">Source of Acquisition</label>
         <select id="source_of_acquisition_id" name="source_of_acquisition_id"
             class="w-full border border-gray-400 rounded px-2 py-1">
             <option value="">Select</option>
             @foreach (App\Models\SchoolEquipment\SchoolEquipmentSourceOfAcquisition::all() as $item)
                 <option value="{{ $item->id }}">
                     {{ $item->name }}
                 </option>
             @endforeach
         </select>
     </div>

     <div>
         <label for="donor">Donor</label>
         <input id="donor" type="text" name="donor"
             class="w-full border border-gray-400 rounded px-2 py-1">
     </div>

     <div>
         <label for="source_of_fund_id">Source of Fund</label>
         <select id="source_of_fund_id" name="source_of_fund_id"
             class="w-full border border-gray-400 rounded px-2 py-1">
             <option value="">Select</option>
             @foreach (App\Models\SchoolEquipment\SchoolEquipmentSourceOfFund::all() as $item)
                 <option value="{{ $item->id }}">
                     {{ $item->name }}
                 </option>
             @endforeach
         </select>
     </div>

     <div>
         <label for="allotment_class_id">Allotment Class</label>
         <select id="allotment_class_id" name="allotment_class_id"
             class="w-full border border-gray-400 rounded px-2 py-1">
             <option value="">Select</option>
             @foreach (App\Models\SchoolEquipment\SchoolEquipmentAllotmentClass::all() as $item)
                 <option value="{{ $item->id }}">
                     {{ $item->name }}
                 </option>
             @endforeach
         </select>
     </div>

     <div>
         <label for="remarks">Remarks</label>
         <textarea id="remarks" name="remarks" class="w-full border border-gray-400 rounded px-2 py-1"> </textarea>
     </div>

 </div>
