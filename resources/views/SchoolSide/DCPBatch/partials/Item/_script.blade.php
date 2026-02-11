<script>
    const tableBody = document.getElementById('tableBodyItem');
    const batchId = document.getElementById('batchId').value;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    const spinnerContainer = document.getElementById('spinner');
    const tableContainer = document.getElementById('tableContainer');
    const loadButton = document.getElementById('loadMore');
    let nextUrl = `/api/School/dcpBatchItem/item-information/${batchId}`;
    let rows = 0;

    async function fetchItem(url = null) {
        loadButton.innerHTML = `
          <div class="spinner-container">
                    <div class="spinner-xs"  >

                    </div>
                </div>
        `;
        try {

            const token = localStorage.getItem('token');

            const endpoint = url ?? nextUrl;

            const response = await fetch(endpoint, {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });
            const res = await response.json();
            renderRows(res.data.data, res.dcpCurrentCondition, res.dcpItemBrand);
            nextUrl = res.data.next_page_url;
            loadButton.innerHTML = 'Load More';
            loadButton.style.display =
                nextUrl ? 'block' : 'none';
        } catch (error) {
            console.error(error);
        }
    }

    function renderRows(items, condition, brands) {

        items.forEach((item, index) => {
            rows += 1;
            const completed =
                item?.dcp_item_current_condition?.current_condition_id && item.serial_number && item.brand;
            const hasBrand = item.brand;
            const conditionCurrent = item?.dcp_item_current_condition?.current_condition_id;
            const btnClass =
                conditionCurrent || hasBrand || item.serial_number ? 'btn-green' : 'btn-submit';

            const btnLabel =
                conditionCurrent || hasBrand || item.serial_number ? 'Update' : 'Submit';
            const badge = conditionCurrent && hasBrand && item.serial_number;


            tableBody.innerHTML += `
                    
                    <tr><td style="height:30px"></td></tr>

                    <tr>
                    <td x-data="{open:false}" colspan="13"
                    class="px-4 py-3 shadow bg-white border border-gray-300">
                          <form id="dcp_update_form_${item.pk_dcp_batch_items_id}" method="POST"
                                      enctype="multipart/form-data" class="space-y-4">
                                      <input type="hidden" name="_token" value="${csrfToken}">
                    <input type="hidden" name="_method" value="PUT">      
                    <div @click="open=!open" 
                    class="flex items-center flex-col font-bold cursor-pointer text-center md:text-2xl text-md">
                 
                    <div class="my-2 w-full flex justify-between items-center gap-2 text-base">   
                        <div>   
                        <span class="${badge ? '' : 'hidden'}" id="ok_status_badge_${item.pk_dcp_batch_items_id}" style="font-normal ">${rows}. 
                                <button  
                                class="btn-green px-2  py-0 font-normal text-base hover:bg-green-600 rounded">Completed</button>
                                </span>
                                

                            <span class="${badge ? 'hidden' : ''}"  id="not_status_badge_${item.pk_dcp_batch_items_id}" style="font-normal ">${rows}. 
                            <span  class="text-gray-600 font-normal  ">Not Completed</span>
                            </span>
                            </div>

                            <button class="btn-submit px-2 rounded py-0 font-normal text-base hover:bg-blue-600">
                              ${formatPrice(item.unit_price)}
                                </button>
                    </div>
                   
                  
                    ${item.generated_code}

                    <div class="text-base font-normal text-gray-800">
                    (${item.dcp_item_type.name})
                    </div>

                   

                    </div>

                    <div x-show="open" class="mt-3">

                    <div class="grid md:grid-cols-4 gap-2">

                    <div>
                        <label class="form-label">Quantity</label>
                            <input name="quantity" required value="${item.quantity}"
                            class="w-full form-input" disabled />
                        <div class="text-blue-600 text-sm">View Only</div>
                    </div>

                    <div>
                    <label class="form-label">Condition</label>

                    <select name='current_condition_id' required class="w-full form-input">
                        <option value="">Select</option>
                        ${condition.map(c => 
                        `
                            <option
                            ${item.dcp_item_current_condition?.current_condition_id == c.pk_dcp_current_conditions_id ? 'selected' : ''}
                            value="${c.pk_dcp_current_conditions_id}">${c.name}</option>
                            `
                        ).join('')} 
                    
                    </select>
                    <div class="text-red-600 text-sm">Required</div>
                    </div>

                    <div>
                    <label class="form-label">Brand</label>
                   
                   <select name="brand" required class="w-full form-input">
                        <option value="">Select</option>
                    ${brands.map(brand => 
                       `
                        <option
                        ${item.brand == brand.pk_dcp_batch_item_brands_id ? 'selected' : ''}
                        value="${brand.pk_dcp_batch_item_brands_id}">${brand.brand_name}</option>
                        `
                    ).join('')} 
                    
                    </select>
                        <div class="text-blue-600 text-sm">Changeable</div>

                    </div>

                    <div>
                    <label class="form-label">Serial</label>
                    <input required value="${item.serial_number ?? ''}"  name="serial_number"
                      id="selectedSerialNumber_${item.pk_dcp_batch_items_id}"
                    class="w-full form-input" />
                    <div class="text-red-600 text-sm">Required</div>

                    </div>

                    </div>

                    <div class="flex space-x-2">
                        
                        <div class="flex justify-start items-center gap-2">

                                    <button type="button"
                                            onclick="update(${item.pk_dcp_batch_items_id})"
                                                    id="status-button-${item.pk_dcp_batch_items_id}"
                                                    class="${btnClass} h-8 w-24 flex justify-center text-center  py-1 px-4 rounded">
                                                    ${btnLabel}
                                            </button>

                                <div class="h-10 w-10 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                                    <button type="button"
                                        onclick="window.location.href='/School/DCPInventory/${item.generated_code}'"
                                        title="Show in Inventory"
                                        class="p-1 btn-cancel rounded-full">

                                        <div class="flex items-center">
                                        ${inventoryIcon()}
                                        </div>

                                    </button>
                                </div>
                            </div>
                        </div>

                       

                        <!-- SUCCESS MESSAGE -->
                        <div id="result_${item.pk_dcp_batch_items_id}"
                        class="hidden mt-2 bg-green-100 border border-green-400 text-green-700 px-3 py-2 rounded flex items-center gap-2 text-md">
                        
                        <svg class="w-4 h-4 mr-1 text-green-600"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                        d="M5 13l4 4L19 7"/>
                        </svg>
                        
                        <span id="result-message-${item.pk_dcp_batch_items_id}"></span>
                        
                        </div>
                        
                        </div>
                        </form>
                    </td>
                    </tr>
                    `;
        });
    }

    function inventoryIcon() {
        return `
     <svg class="h-6 w-6 " viewBox="0 0 24 24"
                                                                      fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                      <g id="SVGRepo_bgCarrier" stroke-width="0">
                                                                      </g>
                                                                      <g id="SVGRepo_tracerCarrier"
                                                                          stroke-linecap="round"
                                                                          stroke-linejoin="round"></g>
                                                                      <g id="SVGRepo_iconCarrier">
                                                                          <path
                                                                              d="M3.17004 7.43994L12 12.5499L20.77 7.46991"
                                                                              stroke="currentColor" stroke-width="1.5"
                                                                              stroke-linecap="round"
                                                                              stroke-linejoin="round">
                                                                          </path>
                                                                          <path d="M12 21.6099V12.5399"
                                                                              stroke="currentColor" stroke-width="1.5"
                                                                              stroke-linecap="round"
                                                                              stroke-linejoin="round"></path>
                                                                          <path
                                                                              d="M21.61 12.83V9.17C21.61 7.79 20.62 6.11002 19.41 5.44002L14.07 2.48C12.93 1.84 11.07 1.84 9.92999 2.48L4.59 5.44002C3.38 6.11002 2.39001 7.79 2.39001 9.17V14.83C2.39001 16.21 3.38 17.89 4.59 18.56L9.92999 21.52C10.5 21.84 11.25 22 12 22C12.75 22 13.5 21.84 14.07 21.52"
                                                                              stroke="currentColor" stroke-width="1.5"
                                                                              stroke-linecap="round"
                                                                              stroke-linejoin="round">
                                                                          </path>
                                                                          <path
                                                                              d="M19.2 21.4C20.9673 21.4 22.4 19.9673 22.4 18.2C22.4 16.4327 20.9673 15 19.2 15C17.4327 15 16 16.4327 16 18.2C16 19.9673 17.4327 21.4 19.2 21.4Z"
                                                                              stroke="currentColor" stroke-width="1.5"
                                                                              stroke-linecap="round"
                                                                              stroke-linejoin="round">
                                                                          </path>
                                                                          <path d="M23 22L22 21" stroke="currentColor"
                                                                              stroke-width="1.5" stroke-linecap="round"
                                                                              stroke-linejoin="round"></path>
                                                                      </g>
                                                                  </svg>
        `;
    }

    document.getElementById('loadMore')
        .addEventListener('click', () => {

            if (nextUrl) {
                fetchItem(nextUrl);
            }
        });


    async function loadList() {
        loadButton.style.display = 'none';
        await fetchItem();
        spinnerContainer.classList.add('hidden');
        tableContainer.classList.remove('hidden');
        loadButton.style.display = nextUrl ? 'block' : 'none';
    }

    function formatPrice(price) {
        return new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'PHP'
        }).format(price);
    }
    loadList();
</script>
