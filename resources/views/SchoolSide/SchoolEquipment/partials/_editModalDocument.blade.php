<x-modal id="edit-document-modal" size="small-modal" type="edit" icon="report-lg">
	<form class="space-y-4" id="editDocumentForm" method="POST">
		@csrf
		@method('PUT')
		<div class="flex flex-col items-center justify-center gap-0">
			<div class="text-center">
				<div class="page-title">Supporting Document</div>
				<div class="page-subtitle">Document for School Equipment</div>
			</div>
		</div>
		<div class="grid grid-cols-1 gap-4  ">
			<input type="hidden" name="id" id="document_id">
			<input type="hidden" name="_method" value="PUT">
			<input type="hidden" name="_csrf" value="{{ csrf_token() }}">
			<div>
				<label for="document_type_id">Supporting Document Type <span class="text-red-600">(required)</span></label>
				<select name="document_type_id" id="document_type_id" class="w-full border border-gray-400 rounded px-2 py-1">
					<option value="">Select</option>
					@foreach (App\Models\SchoolEquipment\SchoolEquipmentDocumentType::all() as $type)
						<option value="{{ $type->id }}">
							{{ $type->name }}
						</option>
					@endforeach
				</select>
			</div>
			<div>
				<label for="document_number">Document No. <span class="text-red-600">(required)</span></label>
				<input type="text" id="document_number" name="document_number"
					class="w-full border border-gray-400 rounded px-2 py-1">
			</div>
		</div>
		<div class="flex gap-2  justify-center ">
			<button type="button" onclick="closeDocumentModal()"
				class="btn-cancel w-full py-1 px-4 w-full rounded  ">Cancel</button>
			<button type="submit" id="editDocumentButton" class="btn-green  w-full  py-1 px-4  rounded  ">Update
				Document</button>
		</div>
	</form>
</x-modal>
<script>
	const documentBaseUrl = "{{ url('School/school-equipment-document') }}";

	function showDocumentEditModal(id, document_type_id, document_number) {
		// Assign values to form inputs
		console.log(id, document_type_id, document_number);
		document.getElementById('document_id').value = id ?? '';
		document.getElementById('document_type_id').value = document_type_id ?? '';
		document.getElementById('document_number').value = document_number ?? '';
		const modal = document.getElementById('edit-document-modal');
		modal.classList.remove('hidden');
		const form = document.getElementById('editDocumentForm');
		form.action = documentBaseUrl + '/' + id;
		removeOverflow();
		closeComponentModal('modal-equipment-document');
	}
</script>
