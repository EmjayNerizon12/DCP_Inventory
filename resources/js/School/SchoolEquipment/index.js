 import  { loadSVG } from '../../custom.js';
 import { loadDocumentModal } from './_getDocument.js';
 const logoPath = document.querySelector('meta[name="school-logo"]').content;
 const schoolName = document.querySelector('meta[name="school-name"]').content;
    const school_id = document.getElementById('school_id').value;
    async function loadEquipment(school_id) {
        const response = await fetch(`/api/School/schoolEquipment/${school_id}`);
        const res = await response.json();
        const data = res.data;
        console.log(data);

        
        const equipmentContainer = document.getElementById('equipmentContainer');
        equipmentContainer.innerHTML = '';
        data.forEach((equipment, index) => {
            equipmentContainer.innerHTML += `
            
              <div id="equipment-container-${index + 1}" class=" border border-gray-400 p-6 my-4  ">
         <div class="cursor-pointer flex flex-col justify-center text-center relative "
             onclick="toggleCollapse('equipment-print-${ index + 1 }',${ index + 1 })">

             <div class="flex w-full md:flex-row flex-col md:justify-between justify-center items-center  ">
                 <div class="  text-base font-medium tracking-wider  ">
                     ${index + 1}. ${ equipment?.serial_number }
                 </div>
                 <div class="text-center">
                     Tap to Open/CLose
                 </div>
                 <button class="btn-submit w-auto px-2 rounded py-0 font-normal text-base hover:bg-blue-600">
                   
                     ${formatNumber(equipment?.acquisition_cost)}
                 </button>
             </div>
             <div class="scale-100 hover:scale-103 transition ">


                   <div class="md:text-lg text-xs font-bold  ">

                     ${ equipment?.non_dcp == 1 ? 'Non - DCP Product' : 'DCP Product' }
                 </div>
                 <div class="md:text-2xl text-md font-bold uppercase">

                     ${ equipment?.dcp_batch_item?.dcp_item_type?.name ?? equipment?.non_d_c_p_item?.item_description ?? 'No Item Assigned' }
                 </div>

                 <div class="text-base">
                     Property No. ${ equipment?.property_number }
                 </div>
             </div>
         </div>

         <div class="flex flex-row gap-1 justify-center items-start button-container my-2">
             <div
                 class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                 <button  class="btn-update edit-icon p-1 rounded-full"
                     onclick="showEditModal(
                                ${ equipment?.id },
                                '${ equipment?.property_number }',
                                '${ equipment?.old_property_number }',
                                '${ equipment?.serial_number }',
                                '${ equipment?.equipment_item_id }',
                                '${ equipment?.unit_of_measure_id }',
                                '${ equipment?.manufacturer_id }',
                                '${ equipment?.model }',
                                '${ equipment?.specifications }',
                                '${ equipment?.supplier_or_distributor }',
                                '${ equipment?.category_id }',
                                '${ equipment?.classification_id }',
                                '${ equipment?.non_dcp }',
                                '${ equipment?.dcp_batch_id }',
                                '${ equipment?.pmp_reference_no }',
                                '${ equipment?.gl_sl_code }',
                                '${ equipment?.uacs_code }',
                                '${ equipment?.acquisition_cost }',
                                '${ equipment?.acquisition_date }',
                                '${ equipment?.mode_of_acquisition_id }',
                                '${ equipment?.source_of_acquisition_id }',
                                '${ equipment?.donor }',
                                '${ equipment?.source_of_fund_id }',
                                '${ equipment?.allotment_class_id }',
                                '${ equipment?.remarks }'
                                    )">

                 </button>
             </div>
 
             <form 
                 onsubmit="return confirm('Are you sure you want to delete this equipment?');" method="POST">
                
                 <div
                     class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                     <button type="submit" class="btn-delete delete-icon p-1 rounded-full">
                         </button>
                 </div>
             </form>
             <div
                 class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                 <button id="btnPerson-${ equipment?.id }" title="User Accountabiliy"
                     onclick="showUserList(${ equipment?.id })"
                     class="btn-submit person-icon p-1 rounded-full">
                    
                 </button>

             </div>
             <div
                 class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                 <button id="btnStatus-${ equipment?.id }" title="Equipment Status"
                     onclick="showStatusModal(${ equipment?.id })" class="btn-green status-icon p-1 rounded-full">
                   
                 </button>

             </div>
              <div
                 class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

         
<button onclick='loadDocumentModal(${JSON.stringify(equipment?.equipment_document).replace(/'/g,"\\'")},${ equipment?.id })' class=" btn-submit p-1 rounded-full file-icon"> </button>

 
             </div>
             <div
                 class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                 <button class="theme-button p-1 rounded-full" onclick="printEquipment(${ index + 1 })">
                     <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                         <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                         <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                         </g>
                         <g id="SVGRepo_iconCarrier">
                             <path fill-rule="evenodd" clip-rule="evenodd"
                                 d="M17 7H7V6h10v1zm0 12H7v-6h10v6zm2-12V3H5v4H1v8.996C1 17.103 1.897 18 3.004 18H5v3h14v-3h1.996A2.004 2.004 0 0 0 23 15.996V7h-4z"
                                 fill="currentColor"></path>
                         </g>
                     </svg>
                 </button>
             </div>
             <div
                 class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                 <button id="toggle-button-${ index + 1 }" class="btn-gray blocks-icon p-1 rounded-full"
                     onclick="toggleCollapse('equipment-print-${ index + 1 }',${ index + 1 })">
                 </button>
             </div>
         </div>

         <div id="equipment-print-${ index + 1 }" class="hidden transition">


             <div style="display: none" id="print-header-individual">
                 <div class="logo-container" class="flex flex-row items-center justify-center w-full">
                     <img class="school-logo"
                         src="${logoPath}">

                 </div>
                 <div class="school-name">${schoolName}</div>
                 <div class="print-date">
                     School Report – Generated on <span class="get-date"></span>
                 </div>
             </div>
             <div class="overflow-x-auto">
                 <table id="equipment-table-${index + 1}" class="table w-full border-collapse">
                     <tbody>
                         <tr>
                             <td colspan="6" class="py-2" style="border:none !important">

                             </td>
                         </tr>
                         <tr>
                             <td colspan="6" class="top-header">
                                 <span class="uppercase">Equipment No.</span>
                                 ${index + 1}

                             </td>
                         </tr>
               
                         <tr>
                             <td colspan="6" class="secondary-header text-center ">
                                 Basic Information</td>
                         </tr>

                     
                         <tr>
                             <td class="sub-header ">Property No.</td>
                             <td class="td-cell  w-1/6">${ equipment?.property_number ?? '' }</td>

                             <td class="sub-header ">Previous Property No.
                             </td>
                             <td class="td-cell  w-1/6">${ equipment?.old_property_number ?? '' }</td>

                             <td class="sub-header ">Serial No.</td>
                             <td class="td-cell  w-1/6">${ equipment?.serial_number ?? '' }</td>
                         </tr>

                   
                         <tr>
                             <td class="sub-header ">Item</td>
                             <td class="td-cell  w-1/6">${ equipment?.dcp_batch_item?.dcp_item_type?.name ?? equipment?.non_d_c_p_item?.item_description ?? 'No Item Assigned' }</td>

                             <td class="sub-header ">Unit of Measure</td>
                             <td class="td-cell  w-1/6">${ equipment?. unit_of_measure?.name ?? '' }</td>

                             <td class="sub-header ">Manufacturer</td>
                             <td class="td-cell  w-1/6">${ equipment?.manufacturer?.name ?? ''}</td>
                         </tr>

                       
                         <tr>
                             <td class="sub-header ">Model</td>
                             <td class="td-cell  w-1/6">${ equipment?.model ?? '' }</td>

                             <td class="sub-header ">Specification</td>
                             <td class="td-cell  w-1/6">${ equipment?.specifications ?? '' }</td>

                             <td class="sub-header ">Supplier / Distributor
                             </td>
                             <td class="td-cell  w-1/6">${ equipment?.supplier_or_distributor ?? '' }</td>
                         </tr>
                         <tr>

                             <td class="sub-header ">Category</td>
                             <td class="td-cell  w-1/6">${ equipment?.category?.name ?? '' }</td>

                             <td class="sub-header ">Classification</td>
                             <td class="td-cell  w-1/6">${ equipment?.classification?.name ?? '' }</td>
                             <td class="sub-header ">Estimated Useful Life
                             </td>
                             <td class="td-cell  w-1/6">${ equipment?.estimated_useful_life ?? '' }</td>
                         </tr>
                         <tr>
                             <td colspan="6" class="secondary-header text-center ">
                                 DCP Batch</td>
                         </tr>
                         <tr>
                             <td class="sub-header ">DCP Batch </td>
                             <td colspan="3" class="td-cell  w-1/6">
                                 ${ equipment?.dcp_batch_id ?  equipment.dcp_batch?.batch_label : 'This equipment is Non-DCP Equipment' }

                             </td>
                             <td class="sub-header ">Non-DCP</td>
                             <td class="td-cell  w-1/6">${ equipment?.non_dcp ? 'Yes' : 'No' }</td>

                         </tr>
                         <tr>
                             <td class="sub-header ">DCP Package </td>
                             <td colspan="3" class="td-cell  w-1/6">

                                 <div class="">


                                     ${ equipment?.dcp_batch?.dcp_package_type?.name ?? '' }


                                 </div>
                             </td>
                             <td class="sub-header">



                                 Package Year:

                             </td>
                             <td class="td-cell  w-1/6">

                                 <div >


                                     ${ equipment?.dcp_batch?.budget_year ?? '' }

                                 </div>
                             </td>
                         </tr>
                         <tr>
                             <td colspan="6" class="secondary-header text-center ">
                                 Reference/Financial</td>
                         </tr>

                        
                         <tr>
                  
                             <td class="sub-header ">PMP Reference No.</td>
                             <td class="td-cell  w-1/6">${ equipment?.pmp_reference_no ?? '' }</td>
                             <td class="sub-header ">GL-SL Code</td>
                             <td class="td-cell  w-1/6">${ equipment?.gl_sl_code ?? '' }</td>

                             <td class="sub-header ">UACS</td>
                             <td class="td-cell  w-1/6">${ equipment?.uacs_code ?? '' }</td>
                         </tr>

                         <tr>
                             <td colspan="6" class="secondary-header text-center ">
                                 Acquisition Details</td>
                         </tr>
                 
                         <tr>
                             <td class="sub-header ">Acquisition Cost</td>
                             <td class="td-cell  w-1/6 text-right">
                                ${formatNumber(equipment.acquisition_cost ?? 0)} </td>
                             <td class="sub-header ">Acquisition Date</td>
                             <td class="td-cell  w-1/6">
                                ${formatDate(equipment.acquisition_date ?? '')} </td>
                             <td class="sub-header ">Mode of Acquistion
                             </td>
                             <td class="td-cell  w-1/6">${ equipment?.mode_of_acquisition?.name ?? '' }</td>
                         </tr>
                         <tr>
                             <td class="sub-header ">Source of Acquistion
                             </td>
                             <td class="td-cell  w-1/6">${ equipment?.source_of_acquisition?.name ?? '' }
                             </td>


                             <td class="sub-header ">Donor</td>
                             <td class="td-cell  w-1/6">${ equipment?.donor ?? '' }</td>
                             <td rowspan="2" class="sub-header ">Source
                                 of Fund
                             </td>
                             <td rowspan="2" class="td-cell  w-1/6">
                                 ${ equipment?.source_of_fund?.name ?? '' }
                             </td>

                         </tr>

                    
                         <tr>

                             <td class="sub-header ">Allotment Class</td>
                             <td class="td-cell  w-1/6">${ equipment?.allotment_class?.name ?? '' }</td>

                             <td class="sub-header ">Remarks</td>
                             <td colspan="1" class="td-cell  w-1/6">${ equipment?.remarks ?? '' }</td>
                         </tr>
                            <tr>
                             <td colspan="6" class="secondary-header text-center ">
                                Accountability</td>
                         </tr>
            ${equipment?.equipment_accountability.length > 0 ?  equipment?.equipment_accountability.map((accountable, index) =>
                 `
                                   <tr>
                                       <td class="sub-header ">Accountable Officer</td>
                                       <td  colspan="3"class="td-cell  w-1/6">${ accountable.accountable_employee?.fname ?? '' } ${ accountable.accountable_employee?.mname ?? '' } ${ accountable.accountable_employee?.lname ?? '' } ${ accountable.accountable_employee?.suffix_name ?? '' } - ${ accountable.accountable_employee?.employee_number ?? '' }</td>
                                       <td class="sub-header ">Received Date:</td>
                                       <td  class="td-cell  w-1/6">
                                           <div class="flex flex-row justify-between items-center">
                                               ${ formatDate(accountable.date_assigned_to_accountable_employee) }
                                           </div>
                                       </td>
                                       </tr>

                                          <tr>
                                       <td class="sub-header ">Property Custodian</td>
                                       <td  colspan="3"class="td-cell  w-1/6">${ accountable.equipment_custodian?.fname ?? '' } ${ accountable.equipment_custodian?.mname ?? '' } ${ accountable.equipment_custodian?.lname ?? '' } ${ accountable.equipment_custodian?.suffix_name ?? '' } - ${ accountable.equipment_custodian?.employee_number ?? '' }</td>
                                       <td class="sub-header ">Received Date:</td>
                                       <td  class="td-cell  w-1/6">
                                           <div class="flex flex-row justify-between items-center">
                                               ${ formatDate(accountable.custodian_received_date) }
                                           </div>
                                       </td>
                                       </tr>
                                       <tr>
                                       <td class="sub-header ">End User</td>
                                       <td  colspan="3"class="td-cell  w-1/6">${ accountable.equipment_end_user?.fname ?? '' } ${ accountable.equipment_end_user?.mname ?? '' } ${ accountable.equipment_end_user?.lname ?? '' } ${ accountable.equipment_end_user?.suffix_name ?? '' } - ${ accountable.equipment_end_user?.employee_number ?? '' }</td>
                                       <td class="sub-header ">Received Date:</td>
                                       <td  class="td-cell  w-1/6">
                                           <div class="flex flex-row justify-between items-center">
                                               ${ formatDate(accountable.end_user_received_date) }
                                           </div>
                                       </td>
                                       </tr>

                         `
             ).join('')  : `
                                                       
                                        <tr>
                                            <td colspan="6" class="td-cell text-center">
                                                
                                                    No Record Yet

                                                
                                            </td>
                                        </tr>
                           ` }
                         <tr>
                             <td colspan="6" class="secondary-header text-center ">
                                 Supporting Documents</td>
                         </tr>
            ${equipment?.equipment_document.length > 0 ?  equipment?.equipment_document.map((document, index) =>
                 `
                                   <tr>
                                       <td class="sub-header ">Document Type</td>
                                       <td  colspan="3"class="td-cell  w-1/6">${ document.document_type?.name }</td>
                                       <td class="sub-header ">Document No.</td>
                                       <td  class="td-cell  w-1/6">
                                           <div class="flex flex-row justify-between items-center">

                                               ${ document.document_number }

                                              
                                           </div>
                                       </td>

                         `
             ).join('')  : `
                                                       
                                        <tr>
                                            <td colspan="6" class="td-cell text-center">
                                                
                                                    No Document Attached

                                                
                                            </td>
                                        </tr>
                           ` }
                        
                         <tr>
                             <td colspan="6" class="secondary-header text-center ">
                                 Equipment Status</td>
                         </tr> 
            ${equipment.equipment_statuses.length > 0 ?  equipment?.equipment_statuses.map((status, index) =>

                 `
                                     <tr>
                                         <td class="sub-header ">Start of Warranty
                                         </td>
                                         <td class="td-cell  w-1/6">
                                             ${formatDate(status.start_warranty_date)} </td>
                                         </td>
                                         <td class="sub-header ">End of Warranty
                                         </td>
                                         <td class="td-cell  w-1/6">
                                             ${formatDate(status.end_warranty_date)} </td>

                                         <td class="sub-header ">Non Functional
                                         </td>
                                         <td class="td-cell  w-1/6">
                                             ${status.non_functional == 1 ? 'Yes' : 'No' }
                                         </td>

                                     </tr>
                                     <tr>
                                         <td class="sub-header ">Equipment Location
                                         </td>
                                         <td class="td-cell  w-1/6">
                                             ${status.equipment_location } 
                                         </td>
                                         <td class="sub-header ">Equipment Condition
                                         </td>
                                         <td class="td-cell  w-1/6">
                                              ${status.equipment_condition?.name} 
                                         </td>
                                         <td class="sub-header ">Accountability
                                             Disposition     Status
                                         </td>
                                         <td class="td-cell  w-1/6">
                                            ${status.disposition_status?.name} 
                                         </td>
                                     </tr>
                                 ` 
             ).join(''): ` <tr>
                                         <td colspan="6" class="td-cell text-center">
                                             No record found
                                         </td>

                                     </tr>`}
             

                     </tbody>
                 </table>
             </div>


         </div>
     </div>
            `;
        });
    }
    document.addEventListener('DOMContentLoaded', async () => {
        await loadEquipment(school_id);
        loadSVG('/svg/delete.svg', '.delete-icon');
        loadSVG('/svg/edit.svg', '.edit-icon');
        loadSVG('/svg/table.svg', '.blocks-icon');
        loadSVG('/svg/status.svg', '.status-icon');
        loadSVG('/svg/person.svg', '.person-icon');
        loadSVG('/svg/plus.svg', '.plus-icon');
    loadSVG('/svg/report.svg', '.file-icon');

    });
    document.querySelectorAll('.open-doc-btn').forEach(btn =>
  btn.addEventListener('click', e => loadDocumentModal(JSON.parse(btn.dataset.doc)))
);

    var currentDate = new Date();
    var options = {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
    };
    var formattedDate = currentDate.toLocaleDateString(undefined, options);
    document.querySelectorAll('.current-time-date').forEach(el => {
        el.textContent = formattedDate;
    });
    window.loadEquipment = loadEquipment;
 