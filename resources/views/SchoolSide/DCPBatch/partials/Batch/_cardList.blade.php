    @forelse($batch as $b)
        @php
            $batch_items = App\Models\DCPBatchItem::where('dcp_batch_id', $b->pk_dcp_batches_id)->get();
            $completed_count = 0;
            $bg_color = '';
            foreach ($batch_items as $index => $items) {
                if (
                    isset($items->brand) &&
                    $items->dcpItemCurrentCondition &&
                    $items->dcpItemCurrentCondition->current_condition_id
                ) {
                    $completed_count++;
                }
                if ($completed_count == count($batch_items)) {
                    $bg_color = 'bg-green-600 hover:bg-green-700  ';
                } else {
                    $bg_color = 'bg-gray-400 hover:bg-gray-500  ';
                }
            }

        @endphp

        <div class="border border-gray-400 p-6  my-4 space-y-4">
            <div class="grid w-full  grid-cols-2 gap-0">
                <div class="text-base text-left   font-medium tracking-wider  ">
                    {{ $loop->iteration }}.
                </div>

                <div class="flex  justify-end ">

                    <button class="btn-submit w-auto px-2 rounded py-0 hover:bg-blue-600">
                        {{ $batch_items->count() }} Products
                    </button>
                </div>
            </div>
            <div>
                <div class="md:text-base text-center font-medium text-sm">
                    {{ $b->delivery_date ? \Carbon\Carbon::parse($b->delivery_date)->format('F d, Y') : 'N/A' }}
                </div>
                <div class="md:text-2xl text-center text-sm font-bold uppercase">
                    {{ $b->batch_label ?? '' }}
                </div>
                <div class="md:text-base text-center text-sm mb-4">
                    {{ $b->supplier_name }}
                </div>
                <div class="text-base flex md:flex-row flex-col justify-center gap-2  ">
                    <div class="flex justify-center items-center">
                        <a href="{{ route('school.dcp_items', $b->id ?? $b->pk_dcp_batches_id) }}">

                            <div class="flex justify-start  ">
                                <div
                                    class="h-10 w-auto bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                                    <button
                                        class=" {{ $bg_color }} flex items-center whitespace-nowrap text-white text-md font-medium tracking-wider h-8 py-1 px-4 rounded-full">
                                        {{ $completed_count }}/{{ $batch_items->count() }}
                                        Products
                                    </button>
                                </div>
                            </div>
                        </a>
                    </div>
                    @php
                        $item_status = '';
                        if ($completed_count == $batch_items->count()) {
                            $item_status = 'Completed';
                        } else {
                            $item_status = 'Pending';
                        }

                        $status = '';
                        $bg_color = '';
                        $hover = '';

                        $obj = App\Models\DCPBatchItem::where('dcp_batch_id', $b->id ?? $b->pk_dcp_batches_id)->first();
                        if (
                            $obj->iar_value !== null &&
                            $obj->itr_value !== null &&
                            $obj->coc_status !== null &&
                            $obj->training_acceptance_status !== null &&
                            $obj->delivery_receipt_status !== null &&
                            $obj->invoice_receipt_status !== null
                        ) {
                            $status = 'Files (Completed)';
                            $bg_color = 'bg-green-600';
                            $hover = 'hover:bg-green-700';
                        } else {
                            $status = 'Files (Pending)';
                            $bg_color = 'bg-yellow-500';
                            $hover = 'hover:bg-yellow-600';
                        }
                    @endphp
                    <div class="text-left flex justify-center items-center">
                        <a href="{{ route('school.index.batch_status', $b->id ?? $b->pk_dcp_batches_id) }}">
                            <div class="flex justify-start  ">
                                <div
                                    class="h-10 w-auto bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                                    <button title="Show Info Modal" type="button" onclick="openISPDetailsModal()"
                                        class="  {{ $bg_color }} {{ $hover }} text-white text-md font-medium tracking-wider h-8 py-1 px-4 rounded-full">

                                        {{ $status ?? '' }}
                                    </button>
                                </div>
                            </div>
                        </a>


                    </div>


                    @if (!$b->approval?->status)
                        <form class="flex items-center justify-center" action="{{ route('submit.dcp_batch') }}"
                            method="POST">
                            @csrf
                            <input class="hidden" type="text" name="dcp_batch_id"
                                value="{{ $b->pk_dcp_batches_id }}">


                            @php
                                $isDisabled = !($status === 'Files (Completed)' && $item_status === 'Completed');
                            @endphp


                            <div class="flex items-center justify-center">

                                <button {{ $isDisabled ? 'disabled' : '' }} type="submit"
                                    title="{{ $isDisabled ? 'Items are not completed' : 'You can now submit information to admin' }}"
                                    class=" theme-button rounded-full px-4 py-1
                                {{ $isDisabled ? 'cursor-not-allowed opacity-50' : ' ' }} 
                             ">
                                    Submit
                                </button>
                            </div>



                        </form>
                    @else
                        @php
                            $text_color = '';
                            $title = '';
                            if ($b->approval?->status == 'Approved') {
                                $title = 'This batch is already seen by admin';
                                $text_color = 'btn-green';
                                $svg =
                                    '<svg viewBox="0 0 24 24" class="w-10 h-10"  fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M5 10C6.10457 10 7 10.8954 7 12C7 13.1046 6.10457 14 5 14C3.89543 14 3 13.1046 3 12C3 10.8954 3.89543 10 5 10Z" fill="currentColor"></path> <path d="M12 10C13.1046 10 14 10.8954 14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12C10 10.8954 10.8954 10 12 10Z" fill="currentColor"></path> <path d="M21 12C21 10.8954 20.1046 10 19 10C17.8954 10 17 10.8954 17 12C17 13.1046 17.8954 14 19 14C20.1046 14 21 13.1046 21 12Z" fill="currentColor"></path> </g></svg>';
                            } elseif ($b->approval?->status == 'Rejected') {
                                $title = 'This batch has been rejected by admin';
                                $text_color = 'btn-red-600';
                                $svg =
                                    '<svg class="w-10 h-10" fill="currentColor" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M18.8,16l5.5-5.5c0.8-0.8,0.8-2,0-2.8l0,0C24,7.3,23.5,7,23,7c-0.5,0-1,0.2-1.4,0.6L16,13.2l-5.5-5.5 c-0.8-0.8-2.1-0.8-2.8,0C7.3,8,7,8.5,7,9.1s0.2,1,0.6,1.4l5.5,5.5l-5.5,5.5C7.3,21.9,7,22.4,7,23c0,0.5,0.2,1,0.6,1.4 C8,24.8,8.5,25,9,25c0.5,0,1-0.2,1.4-0.6l5.5-5.5l5.5,5.5c0.8,0.8,2.1,0.8,2.8,0c0.8-0.8,0.8-2.1,0-2.8L18.8,16z"></path> </g></svg>';
                            } elseif ($b->approval?->status == 'Pending') {
                                $title = 'This batch is pending for admin approval';
                                $text_color = 'btn-update';
                                $svg =
                                    '<svg viewBox="0 0 24 24" class="w-10 h-10" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M12 7V12L14.5 13.5M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>';
                            }
                        @endphp

                        <div class="flex justify-center items-center">

                            @if ($b->approval?->status === 'Approved')
                                <div
                                    class="h-10 
                                    w-auto bg-white p-1 border border-gray-300 shadow-md rounded-full 
                                    flex items-center justify-center">
                                    <button title="{{ $title }}"
                                        @if ($b->approval?->status === 'Approved') onclick="window.location.href='{{ url('School/dcp-batch/' . $b->pk_dcp_batches_id . '/item-status') }}'"
                                style="cursor:pointer" @endif
                                        class=" text-white {{ $text_color }}
                                flex items-center h-8 px-4 py-1
                                  @if ($b->approval?->status != 'Approved') cursor-not-allowed @endif
                                text-base 
                                    rounded-full">

                                        Open Package
                                    </button>
                                </div>
                            @else
                                <div
                                    class="h-10 
                                    bg-white p-1 border border-gray-300 shadow-md rounded-full 
                                    flex items-center justify-center">
                                    <button title="{{ $title }}"
                                        @if ($b->approval?->status === 'Approved') onclick="window.location.href='{{ url('School/dcp-batch/' . $b->pk_dcp_batches_id . '/item-status') }}'"
                                            style="cursor:pointer" @endif
                                        class=" text-white {{ $text_color }}
                                            flex items-center 
                                                @if ($b->approval?->status != 'Approved') cursor-not-allowed @endif
                                                    h-8 px-4 py-1
                                                    rounded-full  ">


                                        Processing
                                    </button>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @empty
    @endforelse
