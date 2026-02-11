<script>
    function editAreaModal(isp_details_id, area_id) {
        document.getElementById('edit_area_modal').classList.remove('hidden');
        document.getElementById('isp_details_id').value = isp_details_id;
        document.getElementById('isp_area_available_id').value = area_id;
        document.getElementById('old_isp_area_id').value = area_id;
    }

    function deleteArea(isp_details_id, area_id) {
        if (confirm("Are you sure you want to delete this area?")) {
            $.ajax({
                url: '{{ url('School/ISP/delete-area') }}/' + isp_details_id + '/' + area_id,
                type: 'DELETE', // 👈 use DELETE
                data: {
                    _token: '{{ csrf_token() }}' // 👈 CSRF token is required
                },
                success: function(response) {
                    console.log(response.message);
                    location.reload();
                },
                error: function(xhr) {
                    console.log('Error: ' + xhr.responseText);
                }
            });
        }

    }

    function showInsertArea(isp_details_id) {
        document.getElementById('insert_area_modal').classList.remove('hidden');
        document.getElementById('insert_isp_details_id').value = isp_details_id;
        document.body.classList.add('overflow-hidden');
    }

    function closeEditModal() {
        document.getElementById('edit-details-modal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    function editISPDetailsModal(isp_id, isp_list, isp_connection_type, isp_internet_quality, isp_upload,
        isp_download,
        isp_ping, isp_purpose, areas) {
        document.getElementById('edit-details-modal').classList.remove('hidden');
        document.getElementById('edit_pk_isp_details_id').value = isp_id
        document.getElementById('edit_isp_list_id').value = isp_list
        document.getElementById('edit_isp_connection_type_id').value = isp_connection_type;
        document.getElementById('edit_isp_internet_quality_id').value = isp_internet_quality;
        document.getElementById('edit_isp_purpose').value = isp_purpose;
        document.getElementById('edit_isp_upload').value = isp_upload;
        document.getElementById('edit_isp_download').value = isp_download;
        document.getElementById('edit_isp_ping').value = isp_ping;

        document.body.classList.add('overflow-hidden');
    }

    function openISPDetailsModal() {
        document.getElementById('add-details-modal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeISPDetailsModal() {
        document.getElementById('add-details-modal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    let areas = [];

    function closeInsertAreaModal() {
        document.getElementById('insert_area_modal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    function closeEditAreaModal() {
        document.getElementById('edit_area_modal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    function addArea() {
        let dropdown = document.getElementById('isp_area');
        let selected_area = dropdown.value;
        let selected_text = dropdown.options[dropdown.selectedIndex].text;
        if (selected_area && !areas.includes(selected_area)) {
            areas.push(selected_area);
            document.getElementById('selected-areas').innerHTML =
                areas.map(a => {
                    let optionText = dropdown.querySelector(`option[value="${a}"]`).text;
                    return ` <span class="px-2 py-1 bg-gray-200 rounded inline-block m-1">
          ${optionText}
            </span>
            <input type="hidden" name="areas[]" value="${a}">`;
                }).join("");
        }


    }

    function deleteISP(pk_isp_details_id) {
        if (confirm("Are you sure you want to delete this ISP?")) {
            console.log(pk_isp_details_id);
            $.ajax({
                url: '{{ url('/School/ISP/delete/') }}/' + pk_isp_details_id,
                type: 'DELETE', // 👈 use DELETE
                data: {
                    _token: '{{ csrf_token() }}' // 👈 CSRF token is required
                },
                success: function(response) {
                    console.log(response.message);
                    location.reload();
                },
                error: function(xhr) {
                    console.log('Error: ' + xhr.responseText);
                }
            });
        }
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
