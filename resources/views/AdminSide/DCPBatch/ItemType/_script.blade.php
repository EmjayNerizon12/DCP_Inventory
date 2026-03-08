<script>
	const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
	const itemTypeSearchUrl = @json(route('search.dcp.items'));
	const itemTypeStoreUrl = @json(route('store.dcp.items'));
	const itemTypeUpdateBaseUrl = @json(url('/Admin/DCP/Items/update'));
	const itemTypeDeleteBaseUrl = @json(url('/Admin/DCP/Items/delete'));

	async function loadItemTypeCards(keyword = '') {
		try {
			const response = await fetch(`${itemTypeSearchUrl}?query=${encodeURIComponent(keyword)}`, {
				method: 'GET',
				headers: {
					'Accept': 'application/json',
				},
			});

			if (!response.ok) {
				throw new Error(`Request failed: ${response.status}`);
			}

			const data = await response.json();
			let cards = '';

			if (data.length > 0) {
				data.forEach((item, index) => {
					cards += `
                    <div class="bg-white border border-gray-300 rounded-sm shadow hover:shadow-lg transition-all duration-300 p-4 flex flex-col gap-2 justify-between">
                        <!-- Top -->
                        <div style="letter-spacing: 0.05rem">
                            <div class="text-lg font-medium text-gray-800 flex flex-start gap-2 break-words mb-1">
                            <b>  ${index + 1}. </b>  ${item.name}</div>
                            <p class="text-md break-words text-gray-600"><span class="font-semibold">Code:</span> ${item.code}</p>
                        </div>
                        
                        <!-- Actions -->
                        <div class="flex flex-row gap-2 mt-2 sm:mt-0">
                            
                                <form class="flex flex-row gap-2" action="${itemTypeDeleteBaseUrl}/${item.pk_dcp_item_types_id}" method="POST" class="flex-1"
                            onsubmit="return confirm('Are you sure you want to delete this item type?');">
                            <input type="hidden" name="_token" value="${csrfToken}">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="button"
                                    onclick='openEditItemTypeModal(${JSON.stringify(item.pk_dcp_item_types_id)}, ${JSON.stringify(item.code)}, ${JSON.stringify(item.name)})'
                                    class="btn-update px-2 py-1 rounded"> Edit
                                    
                            </button>
                                    <button type="submit"
                                    class="btn-delete px-2 py-1 rounded"> 
                                    Delete
                            </button>
                        </form>
                    </div>
                </div>
            `;
				});
			} else {
				cards =
					`<p class="col-span-full text-center text-gray-500">No item types found.</p>`;
			}

			document.getElementById('itemTypeCardGrid').innerHTML = cards;
		} catch (error) {
			console.error('Error:', error);
		}
	}

	document.getElementById('searchItemType').addEventListener('keyup', function() {
		loadItemTypeCards(this.value);
	});

	document.addEventListener('DOMContentLoaded', function() {
		loadItemTypeCards('');

		const addForm = document.getElementById('add-item-type-form');
		const updateForm = document.getElementById('update-item-type-form');

		if (addForm) {
			addForm.addEventListener('submit', submitAddItemType);
		}

		if (updateForm) {
			updateForm.addEventListener('submit', submitEditItemType);
		}
	});

	function openAddItemTypeModal() {
		const addForm = document.getElementById('add-item-type-form');
		if (addForm) {
			addForm.reset();
			handleErrors({}, addForm);
		}
		openComponentModal('add-itemType-modal');
	}

	function openEditItemTypeModal(id, code, name) {
		const updateForm = document.getElementById('update-item-type-form');
		if (!updateForm) return;

		document.getElementById('update_id').value = id;
		document.getElementById('update_code').value = code;
		document.getElementById('update_name').value = name;

		updateForm.action = `${itemTypeUpdateBaseUrl}/${id}`;
		handleErrors({}, updateForm);
		openComponentModal('update-itemType-modal');
	}

	async function submitAddItemType(e) {
		e.preventDefault();

		const form = e.target;
		const submitBtn = document.getElementById('addItemTypeSubmitBtn');
		setLoadingText(submitBtn);
		handleErrors({}, form);

		try {
			const res = await fetch(itemTypeStoreUrl, {
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
				resetButtonText(submitBtn, 'Save');
				return;
			}

			if (!res.ok || !data.success) {
				renderStatusModal({
					success: false,
					message: data.message || 'Failed to create item type.',
				});
				resetButtonText(submitBtn, 'Save');
				return;
			}

			closeComponentModal('add-itemType-modal');
			form.reset();
			await loadItemTypeCards(document.getElementById('searchItemType').value || '');
			renderStatusModal({
				success: true,
				message: data.message || 'Item Type created successfully.',
			});
		} catch (err) {
			console.error(err);
			renderStatusModal({
				success: false,
				message: 'Network/server error. Please try again.',
			});
		} finally {
			resetButtonText(submitBtn, 'Save');
		}
	}

	async function submitEditItemType(e) {
		e.preventDefault();

		const form = e.target;
		const submitBtn = document.getElementById('updateItemTypeSubmitBtn');
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
				resetButtonText(submitBtn, 'Update');
				return;
			}

			if (!res.ok || !data.success) {
				renderStatusModal({
					success: false,
					message: data.message || 'Failed to update item type.',
				});
				resetButtonText(submitBtn, 'Update');
				return;
			}

			closeComponentModal('update-itemType-modal');
			await loadItemTypeCards(document.getElementById('searchItemType').value || '');
			renderStatusModal({
				success: true,
				message: data.message || 'Item Type updated successfully.',
			});
		} catch (err) {
			console.error(err);
			renderStatusModal({
				success: false,
				message: 'Network/server error. Please try again.',
			});
		} finally {
			resetButtonText(submitBtn, 'Update');
		}
	}
</script>
