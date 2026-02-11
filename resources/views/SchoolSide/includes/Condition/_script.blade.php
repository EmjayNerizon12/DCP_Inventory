<script>
    const cardContainer = document.getElementById('cardContainer');
    const itemContainer = document.getElementById('itemContainer');
    const schoolId = document.getElementById('school_id').value;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    const token = localStorage.getItem('token');
    const conditionButton = document.getElementById('conditionButton');
    async function fetchItemWithCondition(conditionId) {
        itemContainer.innerHTML =
            '<div class="spinner-container md:col-span-3 my-5 col-span-1 flex justify-center"><div class="spinner-md"></div>';
        cardContainer.innerHTML =
            '<div class="spinner-container md:col-span-5 my-5 col-span-1 w-full flex justify-center"><div class="spinner-md"></div></div>';

        const response = await fetch(
            `/api/School/dcpItemCondition/condition-information/${schoolId}/${conditionId}`, {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });
        const res = await response.json();
        const content = res.data.items.map((item, index) =>
            `<div class="px-5 py-5 border border-gray-500 bg-white    w-full ">
                        <div class="flex justify-start">
                            <span class=" ${getBgColor(item?.current_condition_id )} font-semibold text-gray-700 border border-gray-800 px-2 py-0">
                                ${index + 1}.</span>
                        </div>
                        <div class="text-gray-700">
                            <b> Product:</b>
                             ${item?.dcp_batch_item?.dcp_item_type?.name}
                        </div>
                        <div>
                            <span class="font-normal text-gray-700">
                                <b> DCP Item:</b>
                            </span>
                            ${item?.dcp_batch_item?.generated_code}
                        </div>
                        <div class="font-normal text-gray-700"> <b>From Batch:</b>
                             ${item?.dcp_batch_item?.dcp_batch?.batch_label}
                        </div>
                        <div class="${getBgColor(item?.current_condition_id)} px-4   rounded-sm text-gray-800 border border-gray-800">
                            ${item?.dcp_current_condition?.name ?? 'N/A'}
                        </div>
                    </div>`
        ).join('');
        const cardContent = res.data.totals.map(total =>
            ` <div
                    class="  ${getBgColor(total?.current_condition_id)} shadow-sm rounded-lg border  mb-2 px-5 md:py-4 py-2 flex md:flex-col flex-row items-center md:justify-center justify-between hover:shadow-lg transition">
                    <span class="text-base text-gray-600 md:block hidden">Condition</span>
                    <h3 class="text-lg font-semibold text-gray-800 md:text-center text-left">${total?.dcp_current_condition?.name}</h3>
                    <p class="text-4xl font-bold text-gray-900 mt-2">${total?.total}</p>
                    <span class="text-sm text-gray-600 md:block hidden">items</span>
                </div>`
        ).join('');
        cardContainer.innerHTML = cardContent;
        itemContainer.innerHTML = content;
    }
    async function loadCondition() {
        const conditionId = document.getElementById('select-condition-item').value;
        await fetchItemWithCondition(conditionId);
    }
    loadCondition();



    function getBgColor(conditionId) {
        if (conditionId == 1) {
            return 'bg-green-200';
        }
        if (conditionId == 2) {
            return 'bg-yellow-200';
        }
        if (conditionId == 4) {
            return 'bg-red-200';
        }
        if (conditionId == 5) {
            return 'bg-purple-200';
        }
        return 'bg-blue-200';
    }
</script>
