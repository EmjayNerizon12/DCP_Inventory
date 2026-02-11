@php
	$equipment = $equipment ?? null;
@endphp

<div class="grid md:grid-cols-3 grid-cols-1 gap-4 mb-4">
	<div class="md:col-span-3 col-span-1 text-lg font-bold tracking-wider">
		DCP Information
		<hr>
	</div>
	<div class="md:col-span-3 col-span-1">
		<label class="font-medium">Is the Equipment a Non DCP Product? <span class="text-red-600">(required)</span></label>
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

	{{-- <x-select-field name="dcp_batch_id" label="DCP Batch" :options="" :required="false" :edit="false"
        valueField="pk_dcp_batches_id" textField="batch_label" /> --}}
	<div id="nonDCPContainer" class="hidden">
		<div class="w-full">
			<label for="" class="form-label">Non DCP Item </label>
			<select class="form-input" name="non_dcp_item_id">
				<option value="">Select Non DCP</option>
				@foreach (App\Models\NonDCPItem::where('school_id', Auth::guard('school')->user()->school->pk_school_id)->get() as $item)
					<option value="{{ $item->pk_non_dcp_item_id }}">
						{{ $item->item_description }}</option>
				@endforeach
			</select>
			<div class="error text-red-500 text-sm" data-error="non_dcp_item_id"></div>

		</div>
	</div>
	<div id="dcpBatchContainer" class="md:col-span-3 hidden col-span-1 flex md:flex-row flex-col gap-2">
		<div class="w-full">
			<label for="" class="form-label">DCP Batch </label>
			<select class="form-input" name="dcp_batch_id" id="select-dcp-batch-id">
				<option value="">Select DCP Batch</option>
				@foreach (App\Models\DCPBatch::where('school_id', Auth::guard('school')->user()->school->pk_school_id)->get() as $batch)
					<option value="{{ $batch->pk_dcp_batches_id }}"
						{{ (string) old('dcp_batch_id', (string) ($equipment->dcp_batch_id ?? '')) === (string) $batch->pk_dcp_batches_id ? 'selected' : '' }}>
						{{ $batch->batch_label }}</option>
				@endforeach
			</select>
			<div class="error text-red-500 text-sm" data-error="dcp_batch_id"></div>

		</div>
		<div class="w-full">
			<label for="" class="form-label">Batch Item</label>
			<select class="form-input" name="dcp_batch_item_id" id="select-dcp-batch-item">
				<option value="">Select DCP Batch Item</option>
			</select>
			<div class="error text-red-500 text-sm" data-error="dcp_batch_item_id"></div>

		</div>
	</div>
	<div class="md:col-span-3 col-span-1 text-lg font-bold tracking-wider">
		Basic Information
		<hr>
	</div>
	{{-- Basic Info --}}

	<x-input-field type="text" name="property_number" label="Property No." :required="true" :edit="false" />

	<x-input-field type="text" name="old_property_number" label="Old/Prev. Property No." :required="false"
		:edit="false" />
	<x-input-field type="text" name="serial_number" label="Serial No." :required="true" :edit="false" />

	<x-select-field name="unit_of_measure_id" label="Unit of Measure" :options="App\Models\SchoolEquipment\SchoolEquipmentUnitOfMeasure::all()" :required="true" :edit="false"
		valueField="id" textField="name" />

	<x-select-field name="manufacturer_id" label="Manufacturer/Brand" :options="App\Models\SchoolEquipment\SchoolEquipmentManufacturer::all()" :required="false"
		:edit="false" valueField="id" textField="name" />

	<x-input-field type="text" name="model" label="Model" :required="false" :edit="false" />

	<x-input-field type="text" name="specifications" label="Specifications" :required="false" :edit="false" />

	<x-input-field type="text" name="supplier_or_distributor" label="Supplier or Distributor" :required="false"
		:edit="false" />
	<x-select-field name="category_id" label="Category" :options="App\Models\SchoolEquipment\SchoolEquipmentCategories::all()" :required="false" :edit="false"
		valueField="id" textField="name" />
	<x-select-field name="classification_id" label="Classification" :options="App\Models\SchoolEquipment\SchoolEquipmentClassification::all()" :required="false"
		:edit="false" valueField="id" textField="name" />

	<div class="md:col-span-3 col-span-1 text-lg font-bold tracking-wider">
		Reference Information
		<hr>
	</div>

	<x-input-field type="text" name="pmp_reference_no" label="Procurement Management Plan" :required="false"
		:edit="false" />

	<x-input-field type="text" name="gl_sl_code" label="GL-SL Code (NGAS Code)" :required="false" :edit="false" />

	<x-input-field type="text" name="uacs_code" label="UACS Code" :required="false" :edit="false" />

	<div class="md:col-span-3 col-span-1 text-lg font-bold tracking-wider">
		Acquisition Information
		<hr>
	</div>
	<x-input-field type="number" name="acquisition_cost" label="Acquisition Cost" :required="true" :edit="false" />
	<x-input-field type="date" name="acquisition_date" label="Acquisition Date" :required="false" :edit="false" />

	<x-select-field name="mode_of_acquisition_id" label="Mode of Acquisition" :options="App\Models\SchoolEquipment\SchoolEquipmentModeOfAcquisition::all()" :required="false"
		:edit="false" valueField="id" textField="name" />

	<x-select-field name="source_of_acquisition_id" label="Source of Acquisiton" :options="App\Models\SchoolEquipment\SchoolEquipmentSourceOfAcquisition::all()" :required="false"
		:edit="false" valueField="id" textField="name" />

	<div class="md:col-span-3 col-span-1 text-lg font-bold tracking-wider">
		Other Information
		<hr>
	</div>
	<x-input-field type="text" name="donor" label="Donor" :required="false" :edit="false" />

	<x-select-field name="source_of_fund_id" label="Source of Fund" :options="App\Models\SchoolEquipment\SchoolEquipmentSourceOfFund::all()" :required="false"
		:edit="false" valueField="id" textField="name" />

	<x-select-field name="allotment_class_id" label="Allotment Class" :options="App\Models\SchoolEquipment\SchoolEquipmentAllotmentClass::all()" :required="false"
		:edit="false" valueField="id" textField="name" />
	<div class="md:col-span-3 col-span-1">

		<label for="remarks" class="form-label">Remarks</label>
		<textarea name="remarks" class="form-input">{{ old('remarks', $equipment->remarks ?? '') }}</textarea>
	</div>
</div>

<script>
	const dcpBatchSelect = document.getElementById('select-dcp-batch-id');
	const dcpBatchItemSelect = document.getElementById('select-dcp-batch-item');
	dcpBatchItemSelect.addEventListener('change', async (e) => {

		cascadeDCPItemDetails(e.target.value);
	});
	async function cascadeDCPItemDetails(batchItemId) {
		const response = await fetch(`/api/School/dcpBatchItem/show-item/${batchItemId}`);
		const res = await response.json();
		const data = res.data;
		console.log(data);
		const acq_cost = document.querySelector('input[name="acquisition_cost"]');
		const acq_date = document.querySelector('input[name="acquisition_date"]');
		const serial_number = document.querySelector('input[name="serial_number"]');
		acq_cost.value = data.unit_price;
		acq_date.value = data.dcp_batch.delivery_date;
		serial_number.value = data.serial_number;
	}
	async function loadBatchItems(batchId) {
		if (!dcpBatchItemSelect) return;
		// Clear existing items and add placeholder
		dcpBatchItemSelect.innerHTML = '';
		const placeholder = document.createElement('option');
		placeholder.value = '';
		placeholder.textContent = 'Select DCP Batch Item';
		dcpBatchItemSelect.appendChild(placeholder);

		if (!batchId) return;

		try {
			const response = await fetch(`/api/School/dcpBatchItem/items/${batchId}`);
			if (!response.ok) throw new Error('Network response was not ok');
			const res = await response.json();
			const data = res.data || [];

			data.forEach(value => {
				const option = document.createElement('option');
				option.value = value.pk_dcp_batch_items_id;
				// be defensive in accessing nested props
				if (value.school_equipment.length > 0) {
					option.disabled = true;
				}
				option.textContent =
					`${value.pk_dcp_batch_items_id} - ${value.generated_code || 'No code'}`;

				dcpBatchItemSelect.appendChild(option);
			});
		} catch (err) {
			console.error('Failed to load batch items', err);
		}
	}

	if (dcpBatchSelect) {
		dcpBatchSelect.addEventListener('change', (e) => {
			loadBatchItems(e.target.value);
		});

		// initial load if a batch is already selected (edit form)
		document.addEventListener('DOMContentLoaded', () => {
			const initialId = dcpBatchSelect.value;
			if (initialId) loadBatchItems(initialId);
		});
	}

	document.addEventListener('DOMContentLoaded', () => {
		const radios = document.querySelectorAll('input[name="non_dcp"]');

		const dcpContainer = document.getElementById('dcpBatchContainer');
		const nonDcpContainer = document.getElementById('nonDCPContainer');

		radios.forEach(radio => {
			radio.addEventListener('change', (e) => {
				if (e.target.value === '0') {
					// No
					dcpContainer.classList.remove('hidden');
					nonDcpContainer.classList.add('hidden');
				} else {
					// Yes
					nonDcpContainer.classList.remove('hidden');
					dcpContainer.classList.add('hidden');
				}
			});
		});
	});
</script>
