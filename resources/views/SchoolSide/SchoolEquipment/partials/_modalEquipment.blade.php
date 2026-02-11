<x-modal id="add-equipment-modal" size="super-large-modal" type="add" icon="equipment_w_8">
	<form id="addEquipmentForm" method="POST" action="{{ route('SchoolEquipment.store') }}">
		@csrf
		@method('POST')
		<div class="flex flex-col items-center justify-center gap-0">
			<div class="text-center">
				<div class="page-title">Equipment Information</div>
				<div class="page-subtitle">Encode the information needed for the equipment</div>
			</div>
		</div>
		<input type="hidden" name="totalEquipment" value="{{ count($school_equipments) }}">
		@include('SchoolSide.SchoolEquipment.partials._addEquipmentForm')
		<div class="flex w-full flex-row justify-end gap-2">
			<button type="button" onclick="closeComponentModal('add-equipment-modal')"
				class="btn-cancel w-fit rounded px-4 py-1">Cancel</button>
			<button id="addEquipmentForm-button" type="submit" class="btn-submit w-fit rounded px-4 py-1">Submit
				Equipment</button>
		</div>
	</form>
</x-modal>
<x-modal id="edit-equipment-modal" size="super-large-modal" type="edit" icon="equipment_w_8">
	<form class="space-y-4" id="editEquipmentForm" method="POST">
		@csrf
		@method('PUT')
		<div class="flex flex-col items-center justify-center gap-0">
			<div class="text-center">
				<div class="page-title">Edit Equipment Information</div>
				<div class="page-subtitle">Encode the information needed for the equipment</div>
			</div>
		</div>
		@include('SchoolSide.SchoolEquipment.partials._editEquipmentForm')

		<div class="flex w-full flex-row justify-end gap-2">

			<button type="button" onclick="closeComponentModal('edit-equipment-modal')"
				class="btn-cancel w-fit rounded px-4 py-1">Cancel
			</button>

			<button type="submit" id="equipment-update-button" class="btn-green w-fit rounded px-4 py-1">Update Equipment
			</button>
		</div>
	</form>
</x-modal>
<script>
	const school_id = document.getElementById('school_id').value;
	const baseUrl = "{{ url('School/SchoolEquipment') }}";
</script>
