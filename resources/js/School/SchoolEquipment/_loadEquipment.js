 const logoPath = document.querySelector('meta[name="school-logo"]').content;
 const schoolName = document.querySelector('meta[name="school-name"]').content;
import { renderIcons } from "../../custom";
 //use export to use in other js files and blade pages
export async function loadEquipment(school_id) {
        const response = await fetch(`/api/School/schoolEquipment/${school_id}`);
        const res = await response.json();
        const data = res.data; 
        const equipmentContainer = document.getElementById('equipmentContainer');
        equipmentContainer.innerHTML = '';
        const loading = `<div class="sm:w-8 sm:h-8 h-6 w-6 flex items-center justify-center" >
                        <div class="sm:w-6 sm:h-6 h-4 w-4" style="
                        border: 3px solid #fff;       /* White border */
                        border-top: 3px solid transparent; /* Transparent top */
                        border-radius: 50%;
                        
                        animation: spin 1s linear infinite;
                        margin: auto;
                    "> </div></div>  `;
        data.forEach((equipment, index) => {
            equipmentContainer.innerHTML += `
            
        <div id="equipment-container-${index + 1}" class=" border border-gray-400 p-5 my-4  ">
         <div class="cursor-pointer flex flex-col justify-center text-center relative "
             onclick="toggleCollapse('equipment-print-${ index + 1 }',${ index + 1 })">
             <div class="scale-100 hover:scale-103 transition ">
                <div class="sm:text-2xl text-base font-bold uppercase">
                     ${index + 1}. ${ equipment?.dcp_batch_item?.dcp_item_type?.name ?? equipment?.non_d_c_p_item?.item_description ?? 'No Item Assigned' }
                </div>
                <div class="sm:text-xl text-sm font-medium">
                     ${ equipment?.non_dcp == 1 ? 'Non - DCP Product' : 'DCP Product' } (₱ ${formatNumber(equipment?.acquisition_cost)})
                 </div>

                <div class="sm:text-base text-xs flex items-center justify-center gap-2 my-1">
                    <span class="px-2 py-0.5 font-semibold rounded-full border border-blue-700 bg-blue-100 text-blue-700">
                        Serial No.  ${equipment?.serial_number}
                    </span>
                
                </div>

                <div class="sm:text-base text-xs flex items-center justify-center gap-2 my-1">
                    <span class="px-2 py-0.5 font-semibold rounded-full border border-green-700 bg-green-100 text-green-700">
                        Property No.  ${equipment?.property_number}
                    </span>
                </div>

             </div>
         </div>

         <div class="flex flex-row gap-1 justify-center items-start button-container">
             <div
                 class="action-button">
                 <button id="edit-equipment-button-${ index + 1 }" class="btn-update edit-icon p-1 rounded-full"
                     onclick="showEditModal(
                                ${ index + 1  },
                                ${ equipment?.id ?? '' },
                                '${ equipment?.dcp_batch_id ?? '' }',
                                '${ equipment?.dcp_batch_item_id ?? '' }',
                                '${ equipment?.non_dcp_item_id ?? '' }',
                                '${ equipment?.property_number ?? '' }',
                                '${ equipment?.old_property_number ?? '' }',
                                '${ equipment?.serial_number ?? '' }', 
                                '${ equipment?.unit_of_measure_id ?? '' }',
                                '${ equipment?.manufacturer_id ?? '' }',
                                '${ equipment?.model ?? '' }',
                                '${ equipment?.specifications ?? '' }',
                                '${ equipment?.supplier_or_distributor ?? '' }',
                                '${ equipment?.category_id ?? '' }',
                                '${ equipment?.classification_id ?? '' }',
                                '${ equipment?.non_dcp ?? '' }', 
                                '${ equipment?.pmp_reference_no ?? '' }',
                                '${ equipment?.gl_sl_code ?? '' }',
                                '${ equipment?.uacs_code ?? '' }',
                                '${ equipment?.acquisition_cost ?? '' }',
                                '${ equipment?.acquisition_date ?? '' }',
                                '${ equipment?.mode_of_acquisition_id ?? '' }',
                                '${ equipment?.source_of_acquisition_id ?? '' }',
                                '${ equipment?.donor ?? '' }',
                                '${ equipment?.source_of_fund_id ?? '' }',
                                '${ equipment?.allotment_class_id ?? '' }',
                                '${ equipment?.remarks ?? '' }'
                                    )">
                       ${loading}

                 </button>
             </div>
 
             <form action="/School/SchoolEquipment/${ equipment?.id }" id="delete-equipment-form-${ equipment?.id }"
                method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="${document.querySelector('meta[name=csrf-token]').getAttribute('content')}">
                 <div
                     class="action-button">

                     <button  onclick="deleteEquipment(${ equipment?.id })"  type="button" class="btn-delete delete-icon p-1 rounded-full">
                       ${loading}
                     </button>
                 </div>
             </form>
             <div
                 class="action-button">

                 <button id="btnPerson-${ equipment?.id }" title="User Accountabiliy"
                     onclick="showUserList(${ equipment?.id })"
                     class="btn-submit person-icon p-1 rounded-full">
                                            ${loading}
                 </button>

             </div>
             <div
                 class="action-button">

                 <button id="btnStatus-${ equipment?.id }" title="Equipment Status"
                     onclick="showStatusModal(${ equipment?.id },${ index + 1})" class="btn-green status-icon p-1 rounded-full">
                   ${loading}

                 </button>

             </div>
              <div
                 class="action-button">

         
                <button onclick='loadDocumentModal(${JSON.stringify(equipment?.equipment_document).replace(/'/g,"\\'")},${ equipment?.id })' class=" btn-submit p-1 rounded-full file-icon">
                    ${loading}
                </button>

 
             </div>
             <div
                 class="action-button">

                 <button class="theme-button p-1 rounded-full print-icon" onclick="printEquipment(${ index + 1 })">
                        ${loading}

                 </button>
             </div>
             <div
                 class="action-button">

                 <button id="toggle-button-${ index + 1 }" class="btn-gray blocks-icon p-1 rounded-full"
                     onclick="toggleCollapse('equipment-print-${ index + 1 }',${ index + 1 })">
                        ${loading}
                                                                                                                                                                                                                                        
                     </button>
             </div>
         </div>

         <div id="equipment-print-${ index + 1 }" class="hidden transition mt-2">


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
                             <td class="td-cell  w-1/6">${ equipment?.property_number ?? " " }</td>

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
                             <td class="sub-header">Non-DCP</td>
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
        renderIcons();
    }
window.loadEquipment = loadEquipment; // to call into blade pages