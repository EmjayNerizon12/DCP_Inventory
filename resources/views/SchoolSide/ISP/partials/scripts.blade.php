<script>
    const school_id = document.getElementById('school_id').value;

    function editAreaModal(pk_isp_area_details_id, isp_details_id, area_id, cardNumber) {
        closeComponentModal('modal-area-info');
        removeOverflow();
        const inputIndex = document.getElementById('update-card-index');
        inputIndex.value = cardNumber;
        document.getElementById('edit_area_modal').classList.remove('hidden');
        document.getElementById('pk_isp_area_details_id').value = pk_isp_area_details_id;
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

    function showInsertArea(isp_details_id, cardNumber) {
        closeComponentModal('modal-area-info');
        removeOverflow();
        const inputIndex = document.getElementById('card-index');
        inputIndex.value = cardNumber;
        document.getElementById('insert_area_modal').classList.remove('hidden');
        document.getElementById('insert_isp_details_id').value = isp_details_id;
        removeOverflow();

    }

    function closeEditModal() {
        document.getElementById('edit-details-modal').classList.add('hidden');
        addOverflow();
    }

    function editISPDetailsModal(cardNumber, isp_id, isp_list, isp_connection_type, isp_internet_quality, isp_upload,
        isp_download,
        isp_ping, isp_purpose, areas) {
        const inputIndex = document.getElementById('update-details-index');
        inputIndex.value = cardNumber;
        document.getElementById('edit-details-modal').classList.remove('hidden');
        document.getElementById('pk_isp_details_id').value = isp_id;
        document.getElementById('isp_list_id').value = isp_list;
        document.getElementById('isp_connection_type').value = isp_connection_type;
        document.getElementById('isp_internet_quality').value = isp_internet_quality;
        document.getElementById('isp_purpose').value = isp_purpose;
        document.getElementById('isp_upload').value = isp_upload;
        document.getElementById('isp_download').value = isp_download;
        document.getElementById('isp_ping').value = isp_ping;

        removeOverflow();
    }

    function openISPDetailsModal() {
        document.getElementById('add-details-modal').classList.remove('hidden');
        removeOverflow();
    }

    function closeISPDetailsModal() {
        document.getElementById('add-details-modal').classList.add('hidden');
        addOverflow();
    }

    let areas = [];

    function closeInsertAreaModal() {
        document.getElementById('insert_area_modal').classList.add('hidden');
        addOverflow();
    }

    function closeEditAreaModal() {
        document.getElementById('edit_area_modal').classList.add('hidden');
        addOverflow();
    }



    function addArea() {

        let dropdown = document.getElementById('isp_area');
        let selected_area = dropdown.value;

        if (selected_area && !areas.includes(selected_area)) {
            areas.push(selected_area);
            renderAreas();
        }
    }

    function removeArea(area) {
        areas = areas.filter(a => a !== area);
        renderAreas();
    }

    function renderAreas() {
        let dropdown = document.getElementById('isp_area');
        let container = document.getElementById('selected-areas');

        container.innerHTML = areas.map(a => {
            let optionText = dropdown.querySelector(`option[value="${a}"]`).text;

            return `
            <span class="px-2 py-1 bg-gray-200 rounded inline-flex items-center m-1 gap-1">
                ${optionText}
                <button
                    type="button"
                    onclick="removeArea('${a}')"
                    class="text-gray-800 shadow-none font-bold hover:text-gray-900"
                >
                    ×
                </button>
                <input type="hidden" name="areas[]" value="${a}">
            </span>
        `;
        }).join("");
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
    let totalInternet = 0;
    async function loadInternet(school_id) {
        try {
            const response = await fetch(`/api/School/schoolInternet/${school_id}`);
            const res = await response.json();
            const container = document.getElementById('internetCardContainer');
            container.innerHTML = '';
            const data = res.data;
            totalInternet = data.length;
            console.log('THis is the data' + totalInternet);
            data.forEach((internet, index) => {

                const card = document.createElement('div');
                card.className = 'border border-gray-400 p-5 my-4';
                card.innerHTML = `
                     <div class="cursor-pointer  flex flex-col justify-center text-center 
                                 cursor-pointer text-center relative
                                  "
                                 onclick="toggleCollapse('isp-container-${index +1}',${index + 1})">

                                 <div class="scale-100 hover:scale-103 transition mb-2">
                                    <div class="sm:text-2xl text-base font-bold uppercase">
                                        ${index + 1 }. ${internet?.isp_list?.name ?? ''}
                                    </div>

                                    <div class="sm:text-xl text-sm font-medium">
                                        ${internet?.isp_connection_type?.name ?? ''} (&#8369; ${formatNumber(internet?.isp_info[0]?.cost_per_month ?? 0,2)})
                                     </div>
                                    <div class="sm:text-lg text-sm">
                                        Account No. <span class="font-medium"> ${internet?.isp_info[0]?.account_number ?? 'N/A'} </span>
                                     </div>
                                    <div class="sm:text-base text-xs flex items-center justify-center gap-2 my-1">
                                        <span class="px-2 py-0.5 font-semibold rounded-full border border-green-700 bg-green-100 text-green-700">
                                        Quality: ${internet?.isp_internet_quality?.name} 
                                        </span>
                                    </div>
                                     
                                 </div>

                                 </div>
                                 <div class="flex w-full flex-row  gap-1 justify-center items-start  ">
    
                                    
                                     <div
                                         class="action-button">
    
                                         <button title="Edit ISP" class="btn-update p-1 rounded-full"
                                             onclick='editISPDetailsModal(${index+1},${internet?.pk_isp_details_id},
                                                            ${internet?.isp_list_id},${internet?.isp_connection_type_id},
                                                           ${internet?.isp_internet_quality_id},${internet?.isp_speed_test[0]?.upload},
                                                           ${internet?.isp_speed_test[0]?.download},
                                                            ${internet?.isp_speed_test[0]?.ping}, "${internet?.isp_purpose_id ?? ''}",
                                                           ${JSON.stringify(internet?.isp_area_details)})'>
                                             @include('SchoolSide.components.svg.edit-sm')
    
                                         </button>
                                     </div>
                                     <div
                                         class="action-button">
    
                                         <button type="button" title="Remove ISP" onclick="deleteISP(${internet?.id})"
                                             class="btn-delete p-1 rounded-full">
                                             @include('SchoolSide.components.svg.delete-sm')
    
    
                                         </button>
                                     </div>
                                      <div
                                         class="action-button">
    
                                         <button  title="Insert Area" class="btn-submit p-1 rounded-full"
                                          data-areas='${encodeURIComponent(JSON.stringify(internet?.isp_area_details ?? []))}' 
                                         onclick="loadAreaModal(this,${internet?.pk_isp_details_id},${index + 1})">
    
                                             @include('SchoolSide.components.svg.area-sm')
    
                                         </button>
                                     </div>
                                     <div  
                                         class="action-button">
                                      
                                        <button
                                            title="Internet Information"
                                            onclick="${internet.isp_info.length > 0 
                                                ? `showTableInfo(${internet.pk_isp_details_id})`
                                                : `showInfoModal(${internet.pk_isp_details_id},${index+ 1})`
                                            }"
                                            class="${internet.isp_info.length > 0  ? 'theme-button' : 'btn-cancel'} p-1 rounded-full">
                                              @include('SchoolSide.components.svg.wifi-sm')
                                         </button>
    
                                     </div>
                                     <div
                                         class="action-button">
    
                                         <button id="toggle-button-${index + 1}" class="btn-gray p-1 rounded-full"
                                             onclick="toggleCollapse('isp-container-${index + 1}',${index + 1})">
    
                                             @include('SchoolSide.components.svg.dashboard-sm')
    
                                         </button>
                                     </div>
                                 </div>
                                <div id="isp-container-${index + 1}" class="hidden space-y-4 mt-2">
                                    <div class="overflow-x-auto">
                                        <table class="table-auto w-full border ">

                                            <thead>
                                                <tr>
                                                    <td colspan="7" class="top-header">
                                                        INTERNET SERVICE PROVIDER
                                                    </td>
                                                </tr>
                                                <tr>

                                                    <td class="sub-header   text-center tracking-wider">

                                                        Provider</th>
                                                    <td class=" sub-header   text-center tracking-wider">
                                                        Connection
                                                    </td>
                                                    <td class=" sub-header   text-center tracking-wider">
                                                        Purpose</ttdh>
                                                    <td class="sub-header   text-center tracking-wider">
                                                        Speed Test
                                                    </td>
                                                    <td class=" sub-header    text-center tracking-wider">
                                                        Quality
                                                    </td>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody class="tracking-wide">

                                                <tr>

                                                    <td class="td-cell text-center">
                                                        ${internet?.isp_list?.name ?? '' } 
                                                    </td>
                                                    <td class="td-cell text-center">
                                                        ${internet?.isp_connection_type?.name ?? ''}  </td>
                                                    <td class="td-cell text-center" style="width: 20%">

                                                        ${internet?.isp_purpose?.name ?? ''}  </td>
                                                    <td class="td-cell">

                                                        <div class="flex flex-col">
                                                            <div class="font-normal">Upload:
                                                                ${internet?.isp_speed_test[0]?.upload} 
                                                                mbps
                                                            </div>
                                                            <div class="font-normal">Download:
                                                        ${internet?.isp_speed_test[0]?.download} 

                                                                mbps
                                                            </div>
                                                            <div class="font-normal">Ping:
                                                                ${internet?.isp_speed_test[0]?.ping} 
                                                                mbps
                                                            </div>

                                                        </div>

                                                    </td>
                                                    <td class="td-cell text-center">
                                                        ${internet?.isp_internet_quality?.name} </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                `;
                container.appendChild(card);

            });
        } catch (error) {
            console.error(error);
        }
    }
    loadInternet(school_id);
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
