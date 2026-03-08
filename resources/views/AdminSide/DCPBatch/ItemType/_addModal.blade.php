<x-modal id="add-itemType-modal" size="small-modal" type="add" icon="product-lg">
	<form id="add-item-type-form" method="POST" action="{{ route('store.dcp.items') }}" class="flex flex-col gap-2 mt-4">
		@csrf
		<div class="page-title">Add Item Type</div>
		<div class="page-subtitle">Fill in the details to add a new item type.</div>
		<div>
			<label for="add_code" class="form-label">Code</label>
			<input type="text" name="code" id="add_code" class="form-input" required>
			<div class="text-red-600 text-sm mt-1" data-error="code"></div>
		</div>

		<div>
			<label for="add_name" class="form-label">Name</label>
			<textarea name="name" id="add_name" rows="2" class="form-input" required></textarea>
			<div class="text-red-600 text-sm mt-1" data-error="name"></div>
		</div>

		<div class="modal-button-container">
			<button type="button" onclick="closeComponentModal('add-itemType-modal')"
				class="btn-cancel rounded w-full px-4 py-1 rounded">
				Cancel
			</button>
			<button id="addItemTypeSubmitBtn" type="submit" class="btn-submit px-4 py-1 rounded w-full">
				Save
			</button>
		</div>
	</form>
</x-modal>
