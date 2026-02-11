<x-modal id="modal-area-info" size="medium-modal" type="add" icon="area_w_8">
    <div class="flex flex-col items-center justify-center gap-0">
        <div class="text-center">
            <div class="page-title"> Internet Service Area Covered </div>
            <div class="page-subtitle">ISP Coverage Areas</div>
        </div>
    </div>
    <div id="buttonContainer" class="my-2"></div>
    <div id="areaContainer" class="overflow-x-auto thin-scroll"></div>
    <div id="button-container" class="w-full"></div>

</x-modal>
<script>
    async function loadAreaModal(btn, pk_isp_details_id, index) {
        removeOverflow();
        const modal = document.getElementById('modal-area-info');
        modal.classList.remove('hidden');
        const areaContainer = document.getElementById('areaContainer');
        const buttonContainer = document.getElementById('buttonContainer');
        areaContainer.innerHTML = '';
        buttonContainer.innerHTML = `
          <div class="flex justify-start gap-2 ">
              <button title="Show Info Modal" type="button"
                onclick="closeComponentModal('modal-area-info')"
                class="btn-cancel rounded-sm shadow px-4 py-1">
                Close
            </button>
            <button title="Show Info Modal" type="button"
                onclick="showInsertArea(${pk_isp_details_id ?? ''}, ${index}) "
                class="theme-button rounded-sm px-2 py-1">
                Add Area
            </button>


        </div>`;

        const areas = JSON.parse(decodeURIComponent(btn.dataset.areas));
        console.log(areas);
        const rows = (areas ?? []).map(area =>
            `  <div
                class="flex md:flex-row flex-col justify-between md:gap-5 gap-2 gap-2 border border-gray-300 px-2 py-1 rounded-sm shadow-sm mb-2">
                <div class="font-normal whitespace-nowrap "
                    data-id="${area?.isp_area_available?.pk_isp_area_available_id ?? ''}">

                    ${area?.isp_area_available?.name ?? ''}
                </div>
                <div class="flex flex-row gap-2">
                    <button type="button"
                        onclick="editAreaModal(${area?.pk_isp_area_details_id},${pk_isp_details_id ?? ''}, ${area?.isp_area_available?.pk_isp_area_available_id ?? ''},${index})"
                        class="btn-update px-2 py-0 rounded-sm">Edit
                    </button>
                    <button type="button"
                        onclick="deleteArea(${pk_isp_details_id ?? ''}, ${area?.isp_area_available?.pk_isp_area_available_id ?? ''})"
                        class="btn-delete px-2 py-0 rounded-sm">Remove
                    </button>
                </div>
            </div>`

        ).join('');
        areaContainer.innerHTML = rows;
    }
</script>
