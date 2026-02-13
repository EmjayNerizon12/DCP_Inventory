<x-modal id="add-document-modal" size="small-modal" type="add" icon="report-lg">
	<form method="POST" id="addDocumentForm" class="space-y-4" action="{{ route('school-equipment-document.store') }}">
		@csrf
		@method('POST')
		<div class="flex flex-col items-center justify-center gap-0">
			<div class="text-center">
				<div class="page-title">Supporting Document</div>
				<div class="page-subtitle">Document for School Equipment</div>
			</div>
		</div>
		<div class=" grid grid-cols-1 gap-4">
			<input type="hidden" name="school_equipment_id" id="school_equipment_id">
			<x-select-field name="document_type_id" label="Supporting Document" :options="App\Models\SchoolEquipment\SchoolEquipmentDocumentType::all()" :edit="false"
				:required="true" valueField="id" textField="name" />
			<x-input-field type="text" name="document_number" label="Document No." :required="true" :edit="false" />
		</div>
		<div class="grid grid-cols-2  gap-2">
			<button type="button" onclick="closeDocumentModal()" class=" btn-cancel py-1 px-4  rounded  w-full">Cancel</button>
			<button type="submit" id="addDocumentButton" class="btn-submit  w-full py-1 px-4  rounded  ">Save
				Document</button>
		</div>
	</form>
</x-modal>
<script>
	function openDocumentModal(school_equipment_id) {
		document.getElementById('school_equipment_id').value = school_equipment_id ?? '';
		console.log(school_equipment_id);
		const modal = document.getElementById('add-document-modal');
		modal.classList.remove('hidden');
		document.body.classList.add('overflow-hidden');
		closeComponentModal('modal-equipment-document');
		removeOverflow();
	}

	function closeDocumentModal() {
		const modal = document.getElementById('add-document-modal');
		modal.classList.add('hidden');
		addOverflow();

		const editModal = document.getElementById('edit-document-modal');
		editModal.classList.add('hidden');
		document.body.classList.remove('overflow-hidden');
	}
</script>
