console.log(x);
$('#searchBatch').on('keyup', function () {
    const keyword = $(this).val();

    $.ajax({
        url: '/Admin/DCPBatch/search',
        type: 'GET',
        data: { query: keyword },
        success: function (data) {
            let rows = '';
            if (data.length > 0) {

                data.sort((a, b) => b.pk_dcp_batches_id - a.pk_dcp_batches_id);


                data.forEach((batch, index) => {
                    const approved = (batch.submission_status ?? '').toUpperCase() === 'APPROVED';
                    rows += `
                        <tr id="row-${batch.pk_dcp_batches_id}" class="hover:bg-blue-50 transition">
                            <td class="px-4 py-3 border-r border-gray-200">${index + 1}</td>
                            <td class="px-4 py-3 border-r border-gray-200">${batch.batch_label}</td>
                            <td class="px-4 py-3 border-r border-gray-200">${batch.description}</td>
                             <td class="px-4 py-3 border-r border-gray-200">${batch.school_name ?? 'N/A'} - ${batch.school_level ?? 'N/A'}</td>
                         
                            <td class="px-4 py-3 border-r border-gray-200">${batch.delivery_date ?? 'N/A'}</td>  
                               <td class="px-4 py-3 border-r border-gray-200 whitespace-nowrap">
                                <div class="flex flex-col">


                                     ${batch.approval_status ?? ''}
                                    ${batch.approval_status === 'Pending'
                            ? `<form method="POST" action="${batch.pk_dcp_batches_id}/approve" style="display:inline;">
                                            <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
                                            <button type="submit"
                                            class="min-w-[80px] text-center px-3 py-1 text-xs font-semibold text-white bg-green-600 rounded hover:bg-green-700 ${approved ? 'opacity-50 cursor-not-allowed' : ''}"
                                            ${approved ? 'disabled' : ''}>
                                            Approve
                                            </button>
                                        </form>`
                            : batch.approval_status === 'Approved'
                                ? `<span class="text-green-600 font-bold">${batch.date_approved}</span>`
                                : `<span class="text-blue-600">For Submission</span>`
                        }
 
                                </div>

                            </td>
                            <td class="px-4 py-3 flex flex-wrap gap-2">
                               
                                <a href="/dcp-batch/${batch.pk_dcp_batches_id}/items"
                                   class="min-w-[80px] text-center px-3 py-1 text-xs font-semibold text-white bg-blue-500 rounded hover:bg-blue-600">
                                   Items
                                </a>
                                <a class="min-w-[80px] text-center px-3 py-1 text-xs font-semibold text-white bg-yellow-500 rounded hover:bg-yellow-600">
                                   Edit
                                </a>
                                <button onclick="deleteBatch(${batch.pk_dcp_batches_id})"
                                        class="min-w-[80px] text-center px-3 py-1 text-xs font-semibold text-white bg-red-500 rounded hover:bg-red-600">
                                   Delete
                                </button>
                            </td>
                        </tr>
                    `;
                });
            } else {
                rows = `<tr><td colspan="13" class="px-4 py-3 text-center text-gray-500">No results found.</td></tr>`;
            }
            $('#batchTableBody').html(rows);
        }
    });


    // Add form submission
        const form = document.getElementById('dcp_add_form');
    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(form);

            fetch('/Admin/DCPBatch/store', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const resultDiv = document.getElementById('result');
                        const resultMsg = document.getElementById('result-message');
                        resultMsg.innerText = "Batch saved: " + data.data.batch_label;
                        resultDiv.classList.remove('hidden');
                        form.reset();
                        $('#searchBatch').val(''); // clear search bar if needed
                        $('#searchBatch').trigger('keyup'); // trigger table refresh
                    } else {
                        alert('Error: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while submitting the form.');
                });
        });
    }

    // School email autofill
    const schoolSelect = document.querySelector('select[name="school_id"]');
    const emailInput = document.getElementById('school-email');
    if (schoolSelect && emailInput) {
        schoolSelect.addEventListener('change', function () {
            const selected = schoolSelect.options[schoolSelect.selectedIndex];
            emailInput.value = selected.getAttribute('data-email') || '';
        });
        if (schoolSelect.value) {
            const selected = schoolSelect.options[schoolSelect.selectedIndex];
            emailInput.value = selected.getAttribute('data-email') || '';
        }
    }
});

// Delete batch function (global)
function deleteBatch(batchId) {
    if (confirm('Are you sure you want to delete this batch?')) {
        fetch(`/Admin/DCPBatch/${batchId}/delete`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Content-Type': 'application/json'
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const row = document.getElementById(`row-${batchId}`);
                    if (row) {
                        row.innerHTML = `
                        <td colspan="100%" class="bg-green-100 text-green-700 text-center py-4 rounded">
                            <svg class="w-6 h-6 inline-block mr-2 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            DCP Batch deleted successfully!
                        </td>
                    `;
                    }
                } else {
                    alert('Error deleting batch');
                }
            })
            .catch(error => console.error('Error:', error));
    }



}