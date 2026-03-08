<x-modal id="create-package-modal" size="super-large-modal" type="add" icon="product-lg">
	<form id="create-form" action="{{ route('store.dcp.package') }}" method="POST" class="flex flex-col gap-2 mt-4">
		@csrf
		<div class="page-title flex sm:flex-row flex-col text-center items-center justify-center w-full gap-2">
			DCP Package Details
			<x-badge color="blue">New Package</x-badge>
		</div>

		<div class="flex flex-col sm:flex-row gap-4 w-full">
			<div class="w-full">
				<label for="code" class="form-label">DCP Package Code</label>
				<input type="text" class="form-input" id="code" name="code" required>
				<div class="text-red-600 text-sm mt-1" data-error="code"></div>
			</div>
			<div class="w-full">
				<label for="name" class="form-label">DCP Package Name</label>
				<input type="text" class="form-input" id="name" name="name" required>
				<div class="text-red-600 text-sm mt-1" data-error="name"></div>
			</div>
		</div>

		<div id="package-contents" class=" mt-10">
			<div class="page-title mb-2 flex text-center sm:flex-row flex-col items-center justify-center w-full gap-2">
				DCP Package Content
				<x-badge color="blue">Product</x-badge>
			</div>

			<div id="package-content-list">
				<div class="package-content flex flex-col md:flex-row gap-4 mb-4 w-full border-b-2 pb-2">
					<div class="flex-1">
						<label class="form-label">Product</label>
						<select name="item_type_id[0]" data-field="item_type_id" class="form-input" required>
							<option value="">Select Product</option>
							@foreach ($itemTypes as $itemType)
								<option value="{{ $itemType->pk_dcp_item_types_id }}">{{ $itemType->name }}</option>
							@endforeach
						</select>
						<div class="text-red-600 text-sm mt-1" data-error="item_type_id.0" data-error-field="item_type_id"></div>
					</div>

					<div id="brand-options" class="hidden">
						@foreach ($brands as $brand)
							<option value="{{ $brand->pk_dcp_batch_item_brands_id }}">{{ $brand->brand_name }}</option>
						@endforeach
					</div>

					<div class="flex-1">
						<label class="form-label">Brand</label>
						<select name="item_brand_id[0]" data-field="item_brand_id" class="form-input" required>
							<option value="">Select Brand</option>
							@foreach ($brands as $brand)
								<option value="{{ $brand->pk_dcp_batch_item_brands_id }}">{{ $brand->brand_name }}</option>
							@endforeach
						</select>
						<div class="text-red-600 text-sm mt-1" data-error="item_brand_id.0" data-error-field="item_brand_id"></div>
					</div>

					<div class="flex-1">
						<label class="form-label">Quantity</label>
						<input type="number" required class="form-input" min="1" placeholder="1" name="quantity[0]" data-field="quantity"
							>
						<div class="text-red-600 text-sm mt-1" data-error="quantity.0" data-error-field="quantity"></div>
					</div>

					<div class="flex-1">
						<label class="form-label">Unit Price</label>
						<input type="number" required step="0.01" class="form-input" min="0" placeholder="0" name="unit_price[0]"
							data-field="unit_price" >
						<div class="text-red-600 text-sm mt-1" data-error="unit_price.0" data-error-field="unit_price"></div>
					</div>

						<div class="flex items-end flex-1">
							<button type="button" class="remove-package-content btn-delete px-4 py-1 rounded">
								Remove
							</button>
						</div>
					</div>
				</div>
			</div>

			<div class="flex justify-start">
				<button type="button" class="btn-green px-4 py-1 rounded" id="add-package-content">
					Add Row
				</button>
			</div>
	
			<div class="modal-button-container">
				<button type="button" onclick="closeComponentModal('create-package-modal')"
					class="btn-cancel rounded sm:w-fit w-full px-4 py-1 rounded">
				Cancel
			</button>
			<button id="createPackageSubmitBtn" type="submit" class="btn-submit px-4 py-1 rounded sm:w-fit w-full">
				Save Package
			</button>
		</div>
	</form>
</x-modal>
