<script>
    const token = localStorage.getItem('token');
    console.log(token);
    const tableContainer = document.getElementById('table-container');
    const spinnerContainer = document.getElementById('spinner-container');
    const schoolId = document.getElementById('school_id').value;
    async function searchBatchItems() {
        const keyword = document.getElementById('searchBatchItem').value;
        tableContainer.classList.add('hidden');
        spinnerContainer.classList.remove('hidden');
        try {
            const response = await fetch(
                `/api/School/dcpInventory/${schoolId}/search?query=${encodeURIComponent(keyword)}`, {
                    method: 'GET',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                });

            const data = await response.json();

            let rows = '';

            if (data.length > 0) {
                data.forEach((item, index) => {
                    rows += `
                <tr>
                    <td class="td-cell text-center">
                        ${index + 1}
                    </td>

                    <td class="td-cell">
                        ${item.generated_code}
                    </td>

                    <td class="td-cell">
                        ${item.batch_label ?? "N/A"}
                    </td>

                    <td class="td-cell">
                        ${item.item_type ?? "N/A"}
                    </td>

                    <td class="td-cell">
                        ${item.brand_name ?? "N/A"}
                    </td>

                    <td class="td-cell">
                        <div class="flex flex-row justify-center">
                            <a href="/School/DCPInventory/${item.generated_code}">
                                <div class="h-auto w-auto bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                                    <button title="Product Information" class="btn-submit px-4 py-1 rounded-full">

                                       Show

                                    </button>
                                </div>
                            </a>
                        </div>
                    </td>
                </tr>`;
                });

            } else {
                rows = `
                <tr>
                    <td colspan="6" class="text-center py-4 text-gray-500">
                        No results found.
                    </td>
                </tr>`;
            }

            document.getElementById('batchItemsTableBody').innerHTML = rows;

        } catch (error) {
            console.error('Search error:', error);
        }
        tableContainer.classList.remove('hidden');
        spinnerContainer.classList.add('hidden');
    }


    document.addEventListener('DOMContentLoaded', searchBatchItems);
</script>
