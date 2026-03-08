<x-modal id="update-itemType-modal" size="small-modal" type="edit" icon="product-lg">
	<form id="update-item-type-form" method="POST" class="flex flex-col gap-2 mt-4">
		@csrf
		<div class="page-title">Update Item Type</div>
		<div class="page-subtitle">Edit the details and save changes.</div>
		<input type="hidden" name="id" id="update_id">
		<div>
			<label for="update_code" class="form-label">Code</label>
			<input type="text" name="code" id="update_code" class="form-input" required>
			<div class="text-red-600 text-sm mt-1" data-error="code"></div>
		</div>

		<div>
			<label for="update_name" class="form-label">Name</label>
			<textarea name="name" id="update_name" rows="2" class="form-input" required></textarea>
			<div class="text-red-600 text-sm mt-1" data-error="name"></div>
		</div>

		<div class="modal-button-container">
			<button type="button" onclick="closeComponentModal('update-itemType-modal')"
				class="btn-cancel rounded w-full px-4 py-1 rounded">
				Cancel
			</button>
			<button id="updateItemTypeSubmitBtn" type="submit" class="btn-green px-4 py-1 rounded w-full">
				Update
			</button>
		</div>
	</form>
</x-modal>

