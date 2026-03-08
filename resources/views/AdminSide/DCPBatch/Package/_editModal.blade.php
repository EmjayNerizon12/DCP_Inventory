<x-modal id="edit-package-modal" size="large-modal" type="edit" icon="product-lg">
	<form id="edit-form" method="POST" action="{{ route('update.dcp.package') }}" class="flex flex-col gap-2 mt-4">
		@csrf
		@method('PUT')

		<div class="text-2xl font-bold mb-2 flex w-full justify-center items-center gap-2">
			Edit Package Content Items
			<x-badge color="yellow">Update</x-badge>
		</div>

		<input type="hidden" name="id" id="id">
		<input type="hidden" name="package_id" id="package_id">

		<div class="grid sm:grid-cols-2 grid-cols-1 gap-4 mb-4 w-full">
			<div class="w-full col-span-2">
				<label class="form-label">DCP Package Name</label>
				<input type="text" name="package_name"
					class="package_name form-input bg-gray-100"
					readonly disabled>
			</div>
			<div class="w-full">

				<div class="w-full">
					<label class="form-label">DCP Package Content</label>
					<select name="package_content_name" id="package_content_name"
						class="form-input">
						<option value="">-- Select Content --</option>
						@foreach ($itemTypes as $itemType)
							<option value="{{ $itemType->pk_dcp_item_types_id }}">{{ $itemType->name }}</option>
						@endforeach
					</select>
					<div class="text-red-600 text-sm mt-1" data-error="package_content_name"></div>
				</div>

				<div class="w-full">
					<label class="form-label">Brand</label>
					<select name="edit_item_brand_id" id="edit_item_brand_id"
						class="form-input"
						required>
						<option value="">-- Select Brand --</option>
						@foreach ($brands as $brand)
							<option value="{{ $brand->pk_dcp_batch_item_brands_id }}">{{ $brand->brand_name }}</option>
						@endforeach
					</select>
					<div class="text-red-600 text-sm mt-1" data-error="edit_item_brand_id"></div>
				</div>
			</div>

			<div class="w-full">
				<div class="w-full">
					<label class="form-label">Item Quantity</label>
					<input type="text" name="quantity" id="edit-quantity"
						class="form-input"
						required>
					<div class="text-red-600 text-sm mt-1" data-error="quantity"></div>
				</div>

				<div class="w-full">
					<label class="form-label">Item Price</label>
					<input type="number" name="unit_price" id="edit-unit_price"
						class="form-input"
						step="0.01" min="0" required>
					<div class="text-red-600 text-sm mt-1" data-error="unit_price"></div>
				</div>
			</div>
		</div>

		<div class="modal-button-container">
			<button type="button" onclick="closeComponentModal('edit-package-modal')"
				class="btn-cancel rounded sm:w-fit w-full px-4 py-1 rounded">
				Cancel
			</button>
			<button id="editPackageSubmitBtn" type="submit" class="btn-green px-4 py-1 rounded sm:w-fit w-full">
				Update
			</button>
		</div>
	</form>
	</x-modal>
