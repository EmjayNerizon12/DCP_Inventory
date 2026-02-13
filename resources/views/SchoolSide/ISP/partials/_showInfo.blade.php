<x-modal id="modal-table-info" size="super-large-modal" type="add" icon="wifi-sm">
    <div class="flex flex-col items-center justify-center gap-0">
        <div class="text-center">
            <div class="page-title">Additional Information for Internet Service</div>
            <div class="page-subtitle">Information of School's Internet</div>
        </div>
    </div>
    <div id="infoTable" class="overflow-x-auto thin-scroll"></div>
    <div id="button-container" class="w-full"></div>

</x-modal>
<script>
    async function showTableInfo(school_internet_id) {
        const response = await fetch('/School/ISP-Info/' + school_internet_id);
        const res = await response.json();
        console.log(res.data);
        renderInfoTable(res.data);
        document.getElementById('school_internet_id').value = school_internet_id;
        document.getElementById('modal-table-info').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function renderInfoTable(data) {
        const tableContainer = document.getElementById('infoTable');
        tableContainer.innerHTML = '';
        const table = document.createElement('table');

        const tbody = document.createElement('tbody');
        table.classList.add('table', 'w-full', 'border-collapse');
        tbody.innerHTML = `
            <tr>
                <td class="top-header" colspan="4">
                         Internet Service Provider Information   
             
                    </td>
                </tr>
                
                
                  <tr>
                    <td class="sub-header text-base "  >
                    ISP Account Number
                    </td>
                <td class=" td-cell" >
                    ${data[0].account_number ?? ''}
                    </td>
                     <td class="sub-header text-base"  >
                   Cost Per Month
                    </td>
                <td class=" td-cell" >
                    ${data[0].cost_per_month ?? ''}
                    </td>
                    
                </tr>
                
                   <tr>
                     <td class="sub-header text-base"  >
                   Subscription Type
                    </td>
                <td class=" td-cell" >
                    ${data[0].subscription_type ?? ''}
                    </td>
                    <td class="sub-header text-base"  >
                    Description
                    </td>
                <td class=" td-cell" >
                    ${data[0].description ?? ''}
                    </td>
                    </tr>
                    <tr>
                     <td class="sub-header text-base"  >
                   Start of Contract
                    </td>
                <td class=" td-cell" >
                    ${formatDate(data[0].contract_start) ?? ''}
                    </td>
                     <td class="sub-header text-base"  >
                    End Of Contract
                    </td>
                <td class=" td-cell whitespace-nowrap" >
                    ${formatDate(data[0].contract_end) ?? ''}
                    </td>
                </tr>

                     <tr>
                        <td class="sub-header text-base"  >
                   Mode of Acquisition
                   </td>
                   <td class=" td-cell" >
                    ${data[0].mode_of_acq?.name ?? ''}
                    </td>
                    <td class="sub-header text-base"  >
                   Is Contract Inactive/Ended ?
                    </td>
                <td class=" td-cell" >
                    ${data[0].inactive_contract ? 'Yes' : 'No'}
                    </td>
                    
                </tr>

                  <tr>
                     <td class="sub-header text-base"  >
                    Source of Acquisition
                    </td>
                <td class=" td-cell" >
                    ${data[0].source_of_acq?.name ?? ''}
                    </td>
                    <td class="sub-header text-base"  >
                   Donor Name
                    </td>
                    <td class=" td-cell" >
                        ${data[0].donor ?? ''}
                        </td>
                        </tr>
                        <tr>
                     <td class="sub-header text-base"  >
                   Mode of Acquisition
                    </td>
                <td class=" td-cell" >
                    ${data[0].source_of_fund?.name ?? ''}
                    </td>
                        <td class="sub-header text-base"  >
                  Number of Admin Area Rooms covered by ISP
                    </td>
                <td class=" td-cell" >
                    ${data[0].total_admin_area_isps ?? ''}
                    </td>
                </tr>

                   <tr>
                    <td class="sub-header text-base"  >
                   Location of Access Points
                    </td>
                <td class=" td-cell" >
                    ${data[0].location_of_access_points ?? ''}
                    </td>
                 
                    <td class="sub-header text-base"  >
                    Total Number of Access Points
                    </td>
                
                    <td class=" td-cell" >
                    ${data[0].total_no_access_points ?? ''}
                    </td>
                    </tr>

                    <tr>
                     
                     <td class="sub-header text-base"  >
                   ISP Rating for Admin Area Covered  
                    </td>
                <td class=" td-cell" >
                
                    ${data[0].admin_area_rate?.name ?? ''}
                    </td>
                    <td class="sub-header text-base"  >
                  Total Classrooms Covered by ISP
                    </td>
                <td class=" td-cell" >
                    ${data[0].total_classroom_isps ?? ''}
                    </td>
                </tr>
  
                <tr>
                    <td class="sub-header text-base"  >
                  Number of Admin Area Rooms covered by ISP
                    </td>
                <td class=" td-cell" >
                    ${data[0].classroom_area_rate?.name ?? ''}
                    </td>
                     <td class="sub-header text-base"  >
                   Overall Rating for ISP
                    </td>
                <td class=" td-cell" >
                
                    ${data[0].rate ? data[0].rate + ' star'  : ''}
                    </td>
                    </tr>


             
                   
                   
                `;




        table.appendChild(tbody);
        const buttonContainer = document.getElementById('button-container');
        buttonContainer.innerHTML = `
        <div class="flex md:justify-end justify-center gap-2 my-4">
            
                        <button title="Close" type="button" onclick="document.getElementById('modal-table-info').classList.add('hidden');document.body.classList.remove('overflow-hidden');"  
                            class="btn-cancel  md:w-auto w-full  py-1 px-4 rounded">
                           Close
                        </button>
                            <button title="Show Edit Modal" type="button" onclick='showEditInfoModal(${data[0].id},${data[0].school_internet_id},${JSON.stringify(data[0])})'  
                                class="theme-button md:w-auto w-full py-1 px-4 rounded">
                                Edit Information
                                </button>
                                
                                
                                </div>
                                `;

        tableContainer.appendChild(table);
    }
</script>
