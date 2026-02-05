import { loadSVG } from "../../custom.js";
export async function loadDocumentModal(data,equipmentId){
    const addButtonContainer= document.getElementById('addButtonContainer');
    addButtonContainer.innerHTML= `
       <div class="w-full flex justify-start gap-2 items-center">
            <button class="btn-cancel px-4 py-1  rounded " onclick="closeComponentModal('modal-equipment-document')">
                Close
            </button>
            <button
                onclick="openDocumentModal(${ equipmentId })"
                class="btn-submit  py-1 px-4 rounded">
                Add Document
            </button>
        </div>
    `;
    const modal = document.getElementById('modal-equipment-document');
    modal.classList.remove('hidden');
   const documentTable = document.getElementById('documentTable');
    documentTable.innerHTML = '';
    console.log(data);
   const content = data.length > 0 ? data.map((doc,index) => 
            ` 
            <tr>
                <td class="td-cell w-fit text-center">
                ${index + 1}
                </td>
                <td class="td-cell  w-1/6">
                ${ doc.document_type?.name }
                </td>
                        <td class="td-cell  w-1/6">
                        ${ doc.document_number }
                        </td>


                        <td class="td-cell  ">
                    <div class="flex flex-row gap-1 justify-center items-start button-container">


                    

                        <div
                            class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                            <button title="Edit Document" type="button"
                                onclick="showDocumentEditModal(${ doc.id }, ${ doc.document_type_id }, '${ doc.document_number }')"
                                class="btn-update edit-icon p-1 rounded-full">
                            
                            </button>
                        </div>
                        <form
                        
                            onsubmit="return confirm('Are you sure you want to delete this document?');"
                            method="POST">
                            
                            <div
                                class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                                <button type="submit" title="Remove Document"
                                    class="btn-delete delete-icon  p-1 rounded-full">
                        
                                </button>
                            </div>
                        </form>
                    </div>
                        </td>
            </tr>`
).join('') : `
            <tr>
                <td colspan="4" class="td-cell text-center">
                    No documents found
                </td>
            </tr>
        `;
    loadSVG('/svg/plus.svg', '.plus-icon');
    loadSVG('/svg/edit.svg', '.edit-icon');
    loadSVG('/svg/delete.svg', '.delete-icon');
    removeOverflow();
   documentTable.innerHTML = content;
}window.loadDocumentModal = loadDocumentModal;