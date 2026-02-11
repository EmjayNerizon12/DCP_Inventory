    @php
        $batch_items = App\Models\DCPBatchItem::where('dcp_batch_id', $batchId)->get();

        $completed_count = $batch_items
            ->filter(function ($b) {
                return isset($b->brand) &&
                    $b->dcpItemCurrentCondition &&
                    $b->dcpItemCurrentCondition->current_condition_id;
            })
            ->count();

        $isCompleted = $batch_items->count() > 0 && $completed_count === $batch_items->count();
    @endphp
    <div class="modal hidden" id="progress-modal">
        <div class="modal-content medium-modal space-y-4">

            <!-- Header -->
            <div class="flex justify-between items-center">
                <div class="page-title w-full  text-left">Completed Status of Product
                </div>

            </div>

            <div class="flex justify-between  tracking-wider ">
                <span class="page-title text-lg font-medium">{{ $completed_count }} out of {{ $batch_items->count() }}
                    Product/s</span>
                <span
                    class="page-title text-lg font-medium">{{ round(($completed_count / max($batch_items->count(), 1)) * 100, 0) }}%</span>
            </div>
            <!-- Progress Bar -->
            <div class="bg-white shadow-md border border-gray-300 p-1 w-8 h-8 w-full rounded-full">

                <div class="w-full bg-gray-300 rounded-full h-6 ">
                    <div class="h-6 rounded-full 
                    {{ $isCompleted ? 'bg-green-600' : 'bg-blue-600' }}"
                        style="width: {{ $batch_items->count() > 0 ? ($completed_count / $batch_items->count()) * 100 : 0 }}%">
                    </div>
                </div>
            </div>

            <!-- Stats -->

            <div class="flex w-full justify-between items-center  ">
                <div>

                    <button
                        class="text-md px-3 py-1 rounded 
                        {{ $isCompleted ? 'btn-green hover:bg-green-600' : 'btn-submit hover:bg-blue-600' }}">
                        {{ $isCompleted ? 'Completed' : 'In Progress' }}
                    </button>

                </div>
                <div
                    class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                    <button type="button" title="Close" class="btn-cancel p-1 rounded-full"
                        onclick='closeProgressModal()'>
                        <svg fill="currentColor" class="w-8 h-8" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M18.8,16l5.5-5.5c0.8-0.8,0.8-2,0-2.8l0,0C24,7.3,23.5,7,23,7c-0.5,0-1,0.2-1.4,0.6L16,13.2l-5.5-5.5 c-0.8-0.8-2.1-0.8-2.8,0C7.3,8,7,8.5,7,9.1s0.2,1,0.6,1.4l5.5,5.5l-5.5,5.5C7.3,21.9,7,22.4,7,23c0,0.5,0.2,1,0.6,1.4 C8,24.8,8.5,25,9,25c0.5,0,1-0.2,1.4-0.6l5.5-5.5l5.5,5.5c0.8,0.8,2.1,0.8,2.8,0c0.8-0.8,0.8-2.1,0-2.8L18.8,16z">
                                </path>
                            </g>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function openProgressModal() {
            document.getElementById('progress-modal').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeProgressModal() {
            document.getElementById('progress-modal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    </script>
