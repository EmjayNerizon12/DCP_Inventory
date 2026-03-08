<x-modal id="insert-package-modal" size="large-modal" type="add" icon="product-lg">
	<form id="insert-form" method="POST" action="{{ route('insert.package_item') }}" class="flex flex-col gap-2 mt-4">
		@csrf

		<input type="hidden" name="insert_package_id" id="insert_package_id">

		<div class="page-title flex text-center items-center justify-center w-full gap-2">
			New product for Package
			<x-badge color="blue">Insert Product</x-badge>
		</div>
		<div class="page-subtitle w-full text-center">
			To <span class="insert_package_name"></span>
		</div>
		<div class="flex flex-col md:flex-row gap-4 mb-4 w-full">
			<div class="w-full">
				<div class="w-full">
					<label class="form-label">Package Content</label>
					<select name="insert_package_content_id" id="insert_package_content_id"
						class="form-input"
						required>
						<option value="">Select Content</option>
						@foreach ($itemTypes as $itemType)
							<option value="{{ $itemType->pk_dcp_item_types_id }}">{{ $itemType->name }}</option>
						@endforeach
					</select>
					<div class="text-red-600 text-sm mt-1" data-error="insert_package_content_id"></div>
				</div>

				<div class="w-full">
					<label class="form-label">Brand</label>
					<select name="insert_item_brand_id" id="insert_item_brand_id"
						class="form-input"
						required>
						<option value="">Select Brand</option>
						@foreach ($brands as $brand)
							<option value="{{ $brand->pk_dcp_batch_item_brands_id }}">{{ $brand->brand_name }}</option>
						@endforeach
					</select>
					<div class="text-red-600 text-sm mt-1" data-error="insert_item_brand_id"></div>
				</div>
			</div>

			<div class="w-full">
				<div class="w-full">
					<label class="form-label">Quantity</label>
					<input type="number" name="insert_quantity" id="insert_quantity"
						class="form-input"
						required>
					<div class="text-red-600 text-sm mt-1" data-error="insert_quantity"></div>
				</div>

				<div class="w-full">
					<label class="form-label">Unit Price</label>
					<input type="number" step="0.01" name="insert_unit_price" id="insert_unit_price"
						class="form-input"
						required>
					<div class="text-red-600 text-sm mt-1" data-error="insert_unit_price"></div>
				</div>
			</div>
		</div>

		<div class="modal-button-container">
			<button type="button" onclick="closeComponentModal('insert-package-modal')"
				class="btn-cancel rounded sm:w-fit w-full px-4 py-1 rounded">
				Cancel
			</button>
			<button id="insertPackageSubmitBtn" type="submit" class="btn-submit px-4 py-1 rounded sm:w-fit w-full">
				Save
			</button>
		</div>
	</form>
</x-modal>
