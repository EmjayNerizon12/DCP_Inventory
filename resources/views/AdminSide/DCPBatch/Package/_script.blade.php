<script>
	let usedItemsPerPackage = {};
	const packageListUrl = @json(route('dcp.package.list.json'));
	const deletePackageUrlTemplate = @json(route('delete.dcp.package', ['id' => '___ID___']));
	const deletePackageItemUrlTemplate = @json(route('delete.package_item', ['id' => '___ID___']));

	const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

	function escapeHtml(value) {
		return String(value ?? '')
			.replace(/&/g, '&amp;')
			.replace(/</g, '&lt;')
			.replace(/>/g, '&gt;')
			.replace(/"/g, '&quot;')
			.replace(/'/g, '&#039;');
	}

	function escapeAttr(value) {
		return escapeHtml(value);
	}

	function buildUrl(template, id) {
		return String(template).replace('___ID___', String(id));
	}

	function formatCurrency(value) {
		const num = Number(value);
		if (!Number.isFinite(num)) return '0.00';
		return num.toLocaleString('en-US', {
			minimumFractionDigits: 2,
			maximumFractionDigits: 2
		});
	}

	function getExpandedPackageIds() {
		const expanded = new Set();
		document.querySelectorAll('#package-list .js-package-products').forEach(el => {
			if (!el.classList.contains('hidden')) {
				const id = parseInt(el.getAttribute('data-package-id'), 10);
				if (Number.isFinite(id)) expanded.add(id);
			}
		});
		return expanded;
	}

	function setPackageListState({
		loading = false,
		empty = false
	} = {}) {
		const loadingEl = document.getElementById('package-list-loading');
		const emptyEl = document.getElementById('package-list-empty');

		if (loadingEl) loadingEl.classList.toggle('hidden', !loading);
		if (emptyEl) emptyEl.classList.toggle('hidden', !empty);
	}

	function togglePackageProductsById(packageId) {
		const container = document.getElementById(`package-products-${packageId}`);
		const button = document.getElementById(`toggle-package-products-${packageId}`);
		if (!container) return;

		container.classList.toggle('hidden');
		container.classList.toggle('block');

		if (button) {
			const label = button.querySelector('span');
			if (label) {
				label.textContent = container.classList.contains('hidden') ? 'Show Product' : 'Hide Product';
			}
		}
	}

	function renderPackageList(packages, expandedPackageIds) {
		const listEl = document.getElementById('package-list');
		if (!listEl) return;

		if (!Array.isArray(packages) || packages.length === 0) {
			listEl.innerHTML = '';
			setPackageListState({
				loading: false,
				empty: true
			});
			return;
		}

		const html = packages
				.map((pkg, pkgIndex) => {
					const items = Array.isArray(pkg.items) ? pkg.items : [];
					const productCount = items.length;
					const totalQty = items.reduce((sum, item) => sum + (Number(item?.quantity) || 0), 0);
					const itemsHtml = items
						.map((item, itemIndex) => {
							const brandName = item.brand_name ? escapeHtml(item.brand_name) : '';
							const brandLabel = brandName ? `Brand: ${brandName}` : 'Brand: -';
						const brandId = item.brand_id ?? '';

						return `
								<div class="w-full px-4 py-2  border border-gray-300 shadow-lg flex flex-col">
									<div class="w-full flex flex-col md:justify-between justify-start items-center pb-2">
										<div class="w-full text-left">
											<div class="font-semibold text-left flex gap-2 flex-start items-center sm:text-lg text-base">
												${itemIndex + 1}. ${escapeHtml(item.item_name)}
											</div>
											<p class="text-md text-gray-500 text-left">${brandLabel}</p>
										</div>
										<div class="text-left w-full">
											<p class="text-md">Qty: <span class="font-bold">${escapeHtml(item.quantity)}</span></p>
											<p class="text-md">₱${formatCurrency(item.unit_price)}</p>
										</div>
									</div>
									<div class="flex w-full flex-row gap-2 mt-2 items-center justify-start">
										<div class="flex flex-start">
											<button
												type="button"
												class="btn-update sm:w-full w-auto px-4 py-1 rounded"
												data-action="edit-item"
												data-package-id="${escapeAttr(pkg.id)}"
												data-item-type-id="${escapeAttr(item.item_type_id)}"
												data-item-id="${escapeAttr(item.id)}"
												data-package-name="${escapeAttr(pkg.name)}"
												data-package-content-name="${escapeAttr(item.item_name)}"
												data-quantity="${escapeAttr(item.quantity)}"
												data-brand-id="${escapeAttr(brandId)}"
												data-unit-price="${escapeAttr(item.unit_price)}"
											>
												Edit
											</button>
										</div>

										<div class="flex flex-start">
											<button
												type="button"
												class="btn-delete sm:w-full w-auto px-4 py-1 rounded"
												data-action="delete-item"
												data-item-id="${escapeAttr(item.id)}"
											>
												Remove
											</button>
										</div>
									</div>
								</div>
							`;
						})
						.join('');

					const itemsContentHtml = productCount > 0
						? itemsHtml
						: `
							<div class="w-full px-4 py-4 text-center text-gray-500">
								No Product Found
							</div>
						`;

					return `
						<div class="rounded-sm shadow-lg bg-white overflow-hidden border border-gray-300">
							<div class="p-4 flex justify-between md:flex-row flex-col items-center gap-2">
								<div class="tracking-wider text-left text-lg font-bold w-full">
									${pkgIndex + 1}. <span>${escapeHtml(pkg.name)}</span>
									<div class="flex flex-start gap-2">
										<x-badge color="blue">Product: ${productCount}</x-badge>
										<x-badge color="green">Total: ${totalQty}</x-badge>
									</div>
								</div>
								<div class="flex flex-row items-center gap-2">
										<button
										type="button"
										id="toggle-package-products-${escapeAttr(pkg.id)}"
										data-action="toggle-products"
										data-package-id="${escapeAttr(pkg.id)}"
										class="btn-cancel px-2 py-1 rounded"
									>
										<span>Show Product</span>
									</button>
									<button
										type="button"
										class="btn-submit px-2 py-1 rounded"
										data-action="insert-product"
										data-package-id="${escapeAttr(pkg.id)}"
										data-package-name="${escapeAttr(pkg.name)}"
									> 	
										Add Product
									</button>
								
									<button
										type="button"
										class="btn-delete px-2 py-1 rounded"
										data-action="delete-package"
										data-package-id="${escapeAttr(pkg.id)}"
									>
										<span>Delete</span>
									</button>
								</div>
							</div>
							<div
								id="package-products-${escapeAttr(pkg.id)}"
								class="p-4 space-y-3 bg-white hidden js-package-products"
								data-package-id="${escapeAttr(pkg.id)}"
							>
								${itemsContentHtml}
							</div>
						</div>
					`;
				})
				.join('');

		listEl.innerHTML = html;
		setPackageListState({
			loading: false,
			empty: false
		});

		if (expandedPackageIds && expandedPackageIds.size) {
			expandedPackageIds.forEach(id => {
				togglePackageProductsById(id);
			});
		}
	}

	async function loadPackageList({
		preserveExpanded = true
	} = {}) {
		const expanded = preserveExpanded ? getExpandedPackageIds() : new Set();
		setPackageListState({
			loading: true,
			empty: false
		});

		try {
			const res = await fetch(packageListUrl, {
				method: 'GET',
				headers: {
					'Accept': 'application/json',
					'X-Requested-With': 'XMLHttpRequest',
				},
			});

			const payload = await res.json().catch(() => null);
			const data = payload?.data;

			if (!res.ok || !payload?.success || !data) {
				renderPackageList([], expanded);
				renderStatusModal({
					success: false,
					message: payload?.message || 'Failed to load packages.'
				});
				return {
					ok: false
				};
			}

			usedItemsPerPackage = data.usedItemsPerPackage || {};
			renderPackageList(data.packages || [], expanded);
			return {
				ok: true
			};
		} catch (err) {
			console.error(err);
			renderPackageList([], expanded);
			renderStatusModal({
				success: false,
				message: 'Network/server error while loading packages.'
			});
			return {
				ok: false
			};
		} finally {
			setPackageListState({
				loading: false
			});
		}
	}

	async function deleteWithFetch(url, confirmMessage) {
		if (confirmMessage && !confirm(confirmMessage)) return {
			ok: false,
			cancelled: true
		};

		try {
			const res = await fetch(url, {
				method: 'DELETE',
				headers: {
					'Accept': 'application/json',
					'X-CSRF-TOKEN': csrfToken,
					'X-Requested-With': 'XMLHttpRequest',
				},
			});

			const data = await res.json().catch(() => ({
				success: false,
				message: 'Invalid server response.',
			}));

			if (!res.ok || !data.success) {
				renderStatusModal({
					success: false,
					message: data.message || 'Delete failed.'
				});
				return {
					ok: false,
					data
				};
			}

			renderStatusModal({
				success: true,
				message: data.message || 'Deleted successfully.'
			});
			return {
				ok: true,
				data
			};
		} catch (err) {
			console.error(err);
			renderStatusModal({
				success: false,
				message: 'Network/server error. Please try again.'
			});
			return {
				ok: false
			};
		}
	}

	function resetCreatePackageRows() {
		const list = document.getElementById('package-content-list');
		if (!list) return;
		const rows = list.querySelectorAll('.package-content');
		rows.forEach((row, idx) => {
			if (idx > 0) row.remove();
		});
	}

	function reindexPackageContentRows() {
		const packageContentList = document.getElementById('package-content-list');
		if (!packageContentList) return;
		const rows = packageContentList.querySelectorAll('.package-content');

		rows.forEach((row, idx) => {
			row.querySelectorAll('[data-field]').forEach(el => {
				const field = el.getAttribute('data-field');
				if (field) el.setAttribute('name', `${field}[${idx}]`);
			});

			row.querySelectorAll('[data-error-field]').forEach(el => {
				const field = el.getAttribute('data-error-field');
				if (field) {
					el.setAttribute('data-error', `${field}.${idx}`);
					el.textContent = '';
				}
			});
		});
	}

	function openCreatePackageModal() {
		const form = document.getElementById('create-form');
		if (!form) return;
		form.reset();
		resetCreatePackageRows();
		handleErrors({}, form);
		reindexPackageContentRows();
		openComponentModal('create-package-modal');
	}

	function openInsertPackageModal(dcp_packages_id, package_name) {
		const form = document.getElementById('insert-form');
		if (!form) return;

		document.getElementById('insert_package_id').value = dcp_packages_id;
		document.querySelectorAll('.insert_package_name').forEach(el => (el.textContent = package_name));
		form.reset();
		handleErrors({}, form);

		const select = document.getElementById('insert_package_content_id');
		const usedIds = usedItemsPerPackage[dcp_packages_id] || [];

		for (const option of select.options) {
			const originalText = option.text.replace(' (Already Exist)', '');
			option.text = originalText;
			option.disabled = false;

			if (usedIds.includes(parseInt(option.value))) {
				option.disabled = true;
				option.text += ' (Already Exist)';
			}
		}

		openComponentModal('insert-package-modal');
	}

	function openEditPackageModal(dcp_packages_id, item_type_id, id, package_name, package_content_name, quantity,
		brand_id, unit_price) {
		const form = document.getElementById('edit-form');
		if (!form) return;

		handleErrors({}, form);
		document.querySelectorAll('.package_name').forEach(el => (el.value = package_name));
		document.getElementById('id').value = id;
		document.getElementById('edit-quantity').value = quantity;
		document.getElementById('edit-unit_price').value = unit_price;
		document.getElementById('package_id').value = dcp_packages_id;

		const select = document.getElementById('package_content_name');
		const usedIds = usedItemsPerPackage[dcp_packages_id] || [];

		for (const option of select.options) {
			const originalText = option.text.replace(' (Already Exist)', '');
			option.text = originalText;
			option.disabled = false;

			if (usedIds.includes(parseInt(option.value)) && parseInt(option.value) !== parseInt(item_type_id)) {
				option.disabled = true;
				option.text += ' (Already Exist)';
			}
		}

		select.value = item_type_id;
		document.getElementById('edit_item_brand_id').value = brand_id;

		openComponentModal('edit-package-modal');
	}

	function togglePackageProductList(index) {
		const container = document.getElementById(`package-products-${index}`);
		const button = document.getElementById(`toggle-package-products-${index}`);
		if (!container) return;

		container.classList.toggle('hidden');
		container.classList.toggle('block');

		if (button) {
			const label = button.querySelector('span');
			if (label) {
				label.textContent = container.classList.contains('hidden') ? 'Show Product' : 'Hide Product';
			}
		}
	}

	async function submitFormWithFetch(form, submitBtn, submitText) {
		if (!form) return {
			ok: false
		};

		setLoadingText(submitBtn);
		handleErrors({}, form);

		try {
			const res = await fetch(form.action, {
				method: 'POST',
				headers: {
					'Accept': 'application/json',
					'X-CSRF-TOKEN': csrfToken,
					'X-Requested-With': 'XMLHttpRequest',
				},
				body: new FormData(form),
			});

			const data = await res.json().catch(() => ({
				success: false,
				message: 'Invalid server response.',
			}));

			if (res.status === 422 && data.errors) {
				handleErrors(data.errors, form);
				resetButtonText(submitBtn, submitText);
				return {
					ok: false,
					validation: true,
					data
				};
			}

			if (!res.ok || !data.success) {
				renderStatusModal({
					success: false,
					message: data.message || 'Request failed.'
				});
				resetButtonText(submitBtn, submitText);
				return {
					ok: false,
					data
				};
			}

			renderStatusModal({
				success: true,
				message: data.message || 'Saved successfully.'
			});
			return {
				ok: true,
				data
			};
		} catch (err) {
			console.error(err);
			renderStatusModal({
				success: false,
				message: 'Network/server error. Please try again.'
			});
			return {
				ok: false
			};
		} finally {
			resetButtonText(submitBtn, submitText);
		}
	}

	document.addEventListener('DOMContentLoaded', function() {
		const addPackageContentButton = document.getElementById('add-package-content');
		const packageContentList = document.getElementById('package-content-list');
		const createForm = document.getElementById('create-form');
		const editForm = document.getElementById('edit-form');
		const insertForm = document.getElementById('insert-form');

		const itemTypeOptions = document.getElementById('item-type-options')?.innerHTML || '';
		const brandOptions = document.getElementById('brand-options')?.innerHTML || '';

		if (createForm) {
			createForm.addEventListener('submit', async function(e) {
				e.preventDefault();
				reindexPackageContentRows();
				const submitBtn = document.getElementById('createPackageSubmitBtn');
				const result = await submitFormWithFetch(createForm, submitBtn, 'Save Package');
				if (result.ok) {
					closeComponentModal('create-package-modal');
					createForm.reset();
					resetCreatePackageRows();
					await loadPackageList({
						preserveExpanded: false
					});
				}
			});
		}

		if (editForm) {
			editForm.addEventListener('submit', async function(e) {
				e.preventDefault();
				const submitBtn = document.getElementById('editPackageSubmitBtn');
				const result = await submitFormWithFetch(editForm, submitBtn, 'Update');
				if (result.ok) {
					closeComponentModal('edit-package-modal');
					editForm.reset();
					await loadPackageList();
				}
			});
		}

		if (insertForm) {
			insertForm.addEventListener('submit', async function(e) {
				e.preventDefault();
				const submitBtn = document.getElementById('insertPackageSubmitBtn');
				const result = await submitFormWithFetch(insertForm, submitBtn, 'Save');
				if (result.ok) {
					closeComponentModal('insert-package-modal');
					insertForm.reset();
					await loadPackageList();
				}
			});
		}

		const packageList = document.getElementById('package-list');
		if (packageList) {
			packageList.addEventListener('click', async function(event) {
				const button = event.target.closest('button[data-action]');
				if (!button) return;

				const action = button.getAttribute('data-action');

				if (action === 'toggle-products') {
					const packageId = parseInt(button.getAttribute('data-package-id'), 10);
					if (Number.isFinite(packageId)) togglePackageProductsById(packageId);
					return;
				}

				if (action === 'insert-product') {
					const packageId = button.getAttribute('data-package-id');
					const packageName = button.getAttribute('data-package-name') || '';
					if (packageId) openInsertPackageModal(packageId, packageName);
					return;
				}

				if (action === 'edit-item') {
					openEditPackageModal(
						button.getAttribute('data-package-id'),
						button.getAttribute('data-item-type-id'),
						button.getAttribute('data-item-id'),
						button.getAttribute('data-package-name'),
						button.getAttribute('data-package-content-name'),
						button.getAttribute('data-quantity'),
						button.getAttribute('data-brand-id'),
						button.getAttribute('data-unit-price')
					);
					return;
				}

				if (action === 'delete-package') {
					const packageId = button.getAttribute('data-package-id');
					const url = buildUrl(deletePackageUrlTemplate, packageId);
					const result = await deleteWithFetch(url,
						'Are you sure you want to delete this package?');
					if (result.ok) await loadPackageList({
						preserveExpanded: false
					});
					return;
				}

				if (action === 'delete-item') {
					const itemId = button.getAttribute('data-item-id');
					const url = buildUrl(deletePackageItemUrlTemplate, itemId);
					const result = await deleteWithFetch(url,
						'Are you sure you want to remove this item?');
					if (result.ok) await loadPackageList();
					return;
				}
			});
		}

		if (addPackageContentButton && packageContentList) {
			addPackageContentButton.addEventListener('click', function() {
				const nextIndex = packageContentList.querySelectorAll('.package-content').length;
				const newRow = `
					<div  class="package-content flex flex-col md:flex-row gap-4 mb-4 w-full border border-gray-300 shadow">
						<div class="flex-1">
							<label class="form-label">Product</label>
							<select name="item_type_id[${nextIndex}]" data-field="item_type_id"
								class="form-input"
								required>
								<option value="">Select Product</option>
								${itemTypeOptions}
							</select>
							<div class="text-red-600 text-sm mt-1" data-error="item_type_id.${nextIndex}" data-error-field="item_type_id"></div>
						</div>

						<div class="flex-1">
							<label class="form-label">Brand</label>
							<select name="item_brand_id[${nextIndex}]" data-field="item_brand_id"
								class="form-input"
								required>
								<option value="">Select Brand</option>
								${brandOptions}
							</select>
							<div class="text-red-600 text-sm mt-1" data-error="item_brand_id.${nextIndex}" data-error-field="item_brand_id"></div>
						</div>

						<div class="flex-1">
							<label class="form-label">Quantity</label>
							<input type="number" name="quantity[${nextIndex}]" data-field="quantity"
								class="form-input" min="1" placeholder="1"
								required>
							<div class="text-red-600 text-sm mt-1" data-error="quantity.${nextIndex}" data-error-field="quantity"></div>
						</div>

						<div class="flex-1">
							<label class="form-label">Unit Price</label>
							<input type="number" name="unit_price[${nextIndex}]" data-field="unit_price" step="0.01"
								class="form-input" min="0" placeholder="0"
								required>
							<div class="text-red-600 text-sm mt-1" data-error="unit_price.${nextIndex}" data-error-field="unit_price"></div>
						</div>

						<div class="flex-1 flex items-end">
							<button type="button"
								class="remove-package-content btn-delete px-4 py-1 rounded">
								Remove
							</button>
						</div>
					</div>
				`;

				packageContentList.insertAdjacentHTML('beforeend', newRow);
				reindexPackageContentRows();
			});

			packageContentList.addEventListener('click', function(event) {
				const removeBtn = event.target.closest('.remove-package-content');
				if (!removeBtn) return;

				const row = removeBtn.closest('.package-content');
				if (!row) return;

				const rows = packageContentList.querySelectorAll('.package-content');
				if (rows.length <= 1) {
					row.querySelectorAll('input, select, textarea').forEach(el => {
						if (el.tagName === 'SELECT') {
							el.selectedIndex = 0;
						} else {
							el.value = '';
						}
					});
					row.querySelectorAll('[data-error-field]').forEach(el => (el.textContent = ''));
					return;
				}

				row.remove();
				reindexPackageContentRows();
			});
		}

		reindexPackageContentRows();
		loadPackageList({
			preserveExpanded: false
		});
	});
</script>
