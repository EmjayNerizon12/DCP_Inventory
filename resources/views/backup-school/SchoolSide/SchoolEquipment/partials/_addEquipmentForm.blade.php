@php
    $equipment = $equipment ?? null;
@endphp

<div class="grid md:grid-cols-3 grid-cols-1 gap-4 mb-4">

    {{-- Basic Info --}}
    <div>
        <label for="property_number">Property No. <span class="text-red-600">(required)</span></label>
        <input type="text" name="property_number"
            value="{{ old('property_number', $equipment->property_number ?? '') }}"
            class="w-full border border-gray-400 rounded px-2 py-1">
    </div>

    <div>
        <label for="old_property_number">Old/Prev. Property No.</label>
        <input type="text" name="old_property_number"
            value="{{ old('old_property_number', $equipment->old_property_number ?? '') }}"
            class="w-full border border-gray-400 rounded px-2 py-1">
    </div>

    <div>
        <label for="serial_number">Serial No. <span class="text-red-600">(required)</span></label>
        <input type="text" name="serial_number" value="{{ old('serial_number', $equipment->serial_number ?? '') }}"
            class="w-full border border-gray-400 rounded px-2 py-1">
    </div>

    <div>
        <label for="equipment_item_id">Item <span class="text-red-600">(required)</span></label>
        <select name="equipment_item_id" class="w-full border border-gray-400 rounded px-2 py-1">
            <option value="">Select</option>
            @foreach (App\Models\SchoolEquipment\EquipmentItems::all() as $item)
                <option value="{{ $item->id }}" @selected(old('equipment_item_id', $equipment->equipment_item_id ?? '') == $item->id)>
                    {{ $item->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="unit_of_measure_id">Unit of Measure <span class="text-red-600">(required)</span></label>
        <select name="unit_of_measure_id" class="w-full border border-gray-400 rounded px-2 py-1">
            <option value="">Select</option>
            @foreach (App\Models\SchoolEquipment\SchoolEquipmentUnitOfMeasure::all() as $item)
                <option value="{{ $item->id }}" @selected(old('unit_of_measure_id', $equipment->unit_of_measure_id ?? '') == $item->id)>
                    {{ $item->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="manufacturer_id">Manufacturer/Brand</label>
        <select name="manufacturer_id" class="w-full border border-gray-400 rounded px-2 py-1">
            <option value="">Select</option>
            @foreach (App\Models\SchoolEquipment\SchoolEquipmentManufacturer::all() as $item)
                <option value="{{ $item->id }}" @selected(old('manufacturer_id', $equipment->manufacturer_id ?? '') == $item->id)>
                    {{ $item->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="model">Model</label>
        <input type="text" name="model" value="{{ old('model', $equipment->model ?? '') }}"
            class="w-full border border-gray-400 rounded px-2 py-1">
    </div>

    <div>
        <label for="specifications">Specification</label>
        <input type="text" name="specifications"
            value="{{ old('specifications', $equipment->specifications ?? '') }}"
            class="w-full border border-gray-400 rounded px-2 py-1">
    </div>

    <div>
        <label for="supplier_or_distributor">Supplier or Distributor</label>
        <input type="text" name="supplier_or_distributor"
            value="{{ old('supplier_or_distributor', $equipment->supplier_or_distributor ?? '') }}"
            class="w-full border border-gray-400 rounded px-2 py-1">
    </div>

    <div>
        <label for="category_id">Category</label>
        <select name="category_id" class="w-full border border-gray-400 rounded px-2 py-1">
            <option value="">Select</option>
            @foreach (App\Models\SchoolEquipment\SchoolEquipmentCategories::all() as $item)
                <option value="{{ $item->id }}" @selected(old('category_id', $equipment->category_id ?? '') == $item->id)>
                    {{ $item->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="classification_id">Classification</label>
        <select name="classification_id" class="w-full border border-gray-400 rounded px-2 py-1">
            <option value="">Select</option>
            @foreach (App\Models\SchoolEquipment\SchoolEquipmentClassification::all() as $item)
                <option value="{{ $item->id }}" @selected(old('classification_id', $equipment->classification_id ?? '') == $item->id)>
                    {{ $item->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="font-medium">Non DCP <span class="text-red-600">(required)</span></label>
        <div class="flex items-center gap-4 mt-1">
            <label class="flex items-center gap-1">
                <input type="radio" name="non_dcp" value="1" @checked(old('non_dcp', $equipment->non_dcp ?? '') == 1)>
                <span>Yes</span>
            </label>
            <label class="flex items-center gap-1">
                <input type="radio" name="non_dcp" value="0" @checked(old('non_dcp', $equipment->non_dcp ?? '') == 0)>
                <span>No</span>
            </label>
        </div>
    </div>

    <div>
        <label for="dcp_batch_id">DCP Batch</label>
        <select name="dcp_batch_id" class="w-full border border-gray-400 rounded px-2 py-1">
            <option value="">Select</option>
            @foreach (App\Models\DCPBatch::where('school_id', Auth::guard('school')->user()->school->pk_school_id)->get() as $batch)
                <option value="{{ $batch->pk_dcp_batches_id }}" @selected(old('dcp_batch_id', $equipment->dcp_batch_id ?? '') == $batch->pk_dcp_batches_id)>
                    {{ $batch->batch_label }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="pmp_reference_no">Procurement Management Plan (PMP) No.</label>
        <input type="text" name="pmp_reference_no"
            value="{{ old('pmp_reference_no', $equipment->pmp_reference_no ?? '') }}"
            class="w-full border border-gray-400 rounded px-2 py-1">
    </div>

    <div>
        <label for="gl_sl_code">GL-SL Code (NGAS Code)</label>
        <input type="text" name="gl_sl_code" value="{{ old('gl_sl_code', $equipment->gl_sl_code ?? '') }}"
            class="w-full border border-gray-400 rounded px-2 py-1">
    </div>

    <div>
        <label for="uacs_code">UACS</label>
        <input type="text" name="uacs_code" value="{{ old('uacs_code', $equipment->uacs_code ?? '') }}"
            class="w-full border border-gray-400 rounded px-2 py-1">
    </div>

    <div>
        <label for="acquisition_cost">Acquisition Cost</label>
        <input type="number" step="0.01" name="acquisition_cost"
            value="{{ old('acquisition_cost', $equipment->acquisition_cost ?? '') }}"
            class="w-full border border-gray-400 rounded px-2 py-1">
    </div>

    <div>
        <label for="acquisition_date">Acquisition Date</label>
        <input type="date" name="acquisition_date"
            value="{{ old('acquisition_date', $equipment->acquisition_date ?? '') }}"
            class="w-full border border-gray-400 rounded px-2 py-1">
    </div>

    <div>
        <label for="mode_of_acquisition_id">Mode of Acquisition</label>
        <select name="mode_of_acquisition_id" class="w-full border border-gray-400 rounded px-2 py-1">
            <option value="">Select</option>
            @foreach (App\Models\SchoolEquipment\SchoolEquipmentModeOfAcquisition::all() as $item)
                <option value="{{ $item->id }}" @selected(old('mode_of_acquisition_id', $equipment->mode_of_acquisition_id ?? '') == $item->id)>
                    {{ $item->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="source_of_acquisition_id">Source of Acquisition</label>
        <select name="source_of_acquisition_id" class="w-full border border-gray-400 rounded px-2 py-1">
            <option value="">Select</option>
            @foreach (App\Models\SchoolEquipment\SchoolEquipmentSourceOfAcquisition::all() as $item)
                <option value="{{ $item->id }}" @selected(old('source_of_acquisition_id', $equipment->source_of_acquisition_id ?? '') == $item->id)>
                    {{ $item->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="donor">Donor</label>
        <input type="text" name="donor" value="{{ old('donor', $equipment->donor ?? '') }}"
            class="w-full border border-gray-400 rounded px-2 py-1">
    </div>

    <div>
        <label for="source_of_fund_id">Source of Fund</label>
        <select name="source_of_fund_id" class="w-full border border-gray-400 rounded px-2 py-1">
            <option value="">Select</option>
            @foreach (App\Models\SchoolEquipment\SchoolEquipmentSourceOfFund::all() as $item)
                <option value="{{ $item->id }}" @selected(old('source_of_fund_id', $equipment->source_of_fund_id ?? '') == $item->id)>
                    {{ $item->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="allotment_class_id">Allotment Class</label>
        <select name="allotment_class_id" class="w-full border border-gray-400 rounded px-2 py-1">
            <option value="">Select</option>
            @foreach (App\Models\SchoolEquipment\SchoolEquipmentAllotmentClass::all() as $item)
                <option value="{{ $item->id }}" @selected(old('allotment_class_id', $equipment->allotment_class_id ?? '') == $item->id)>
                    {{ $item->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="remarks">Remarks</label>
        <textarea name="remarks" class="w-full border border-gray-400 rounded px-2 py-1">{{ old('remarks', $equipment->remarks ?? '') }}</textarea>
    </div>

</div>
