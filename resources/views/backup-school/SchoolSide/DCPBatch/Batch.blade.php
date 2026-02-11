{{-- filepath: c:\Users\Em-jay\dcp_inventory_system\resources\views\SchoolSide\DCPBatch\Batch.blade.php --}}

@extends('layout.SchoolSideLayout')

@section('title', 'My DCP Batches')

@section('content')
    <div class="bg-white shadow-sm rounded-sm overflow-hidden p-6 mx-5 my-5" style="border:1px solid #ccc">
        <div class="flex justify-between  mb-4  space-x-4">
            <div class="tracking-wide">
                <h2 class="text-2xl font-semibold text-blue-600">School DCP Batches</h2>
                <p class="mb-2 tracking-wider">Here are the list of DCP Batches for your school.</p>
            </div>

            <div class="md:flex hidden justify-center items-start">
                <div
                    class="h-16 w-16 bg-white p-3 border border-gray-300 shadow-lg rounded-full flex items-center justify-center">
                    <div class="text-white bg-blue-600 p-2 rounded-full">
                        <svg class="w-10 h-10" fill="currentColor" version="1.1" id="Capa_1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            viewBox="0 0 612 612" xml:space="preserve">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <g>
                                    <path
                                        d="M1.659,484.737L1.001,206.595c-0.032-13.686,13.95-22.938,26.534-17.559l253.206,108.241 c6.997,2.991,11.542,9.859,11.56,17.468l0.658,278.142c0.032,13.687-13.95,22.939-26.534,17.56L13.219,502.206 C6.222,499.215,1.676,492.347,1.659,484.737z M581.805,219.687L348.142,320.883l0.608,257.406l233.664-101.196L581.805,219.687 M591.26,186.131c10.043-0.025,19.056,8.054,19.081,19.022l0.658,278.142c0.018,7.609-4.495,14.5-11.478,17.523l-252.69,109.438 c-2.493,1.079-5.047,1.583-7.534,1.59c-10.044,0.023-19.058-8.055-19.083-19.022l-0.658-278.143 c-0.019-7.609,4.495-14.5,11.479-17.523l252.69-109.437C586.218,186.64,588.771,186.137,591.26,186.131L591.26,186.131z M304.152,29.466L61.767,137.691l242.894,107.075l242.386-108.224L304.152,29.466 M304.083,0c2.632-0.006,5.266,0.533,7.728,1.618 l266.403,117.439c15.112,6.663,15.163,28.088,0.082,34.821L312.451,272.577c-2.456,1.097-5.088,1.648-7.721,1.655 c-2.632,0.006-5.266-0.533-7.728-1.618L30.6,155.175c-15.113-6.662-15.163-28.088-0.083-34.821L296.361,1.655 C298.818,0.558,301.449,0.006,304.083,0L304.083,0z">
                                    </path>
                                </g>
                            </g>
                        </svg>
                    </div>
                </div>
            </div>

        </div>
        <div class="overflow-x-auto border border-gray-200 rounded-sm md:border-none shadow-md md:shadow-none">
            <table class="min-w-full border-collapse  text-left  ">
                <thead class="bg-gray-100 border border-gray-300">
                    <tr>
                        <th
                            class="px-4 py-2 font-semibold border-b border-gray-300 uppercase whitespace-nowrap tracking-wider text-gray-800  ">
                            Batch Label</th>
                        <th
                            class="px-4 py-2 font-semibold border-b border-gray-300 uppercase whitespace-nowrap  tracking-wider text-gray-800   ">
                            DCP Items</th>
                        <th
                            class="px-4 py-2 font-semibold border-b border-gray-300 uppercase whitespace-nowrap  tracking-wider text-gray-800   ">
                            DCP Files</th>
                        {{-- <th
                            class="px-4 py-2 font-semibold border-b border-gray-300 uppercase whitespace-nowrap  tracking-wider text-gray-800   ">
                            Package Type</th> --}}
                        {{-- <th
                            class="px-4 py-2 font-semibold border-b border-gray-300 uppercase whitespace-nowrap tracking-wider text-gray-800   ">
                            Budget Year</th> --}}
                        <th
                            class="px-4 py-2 font-semibold border-b border-gray-300 uppercase whitespace-nowrap tracking-wider text-gray-800   ">
                            Delivery Date</th>
                        <th
                            class="px-4 py-2 font-semibold border-b border-gray-300  uppercase tracking-wider text-gray-800   ">
                            Supplier</th>
                        <th
                            class="px-4 py-2 font-semibold border-b border-gray-300  uppercase tracking-wider text-gray-800   ">
                            Status</th>
                        <th
                            class="px-4 py-2 font-semibold border-b border-gray-300 uppercase  tracking-wider text-gray-800   ">
                            Submit</th>

                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($batch as $b)
                        <tr class="hover:bg-blue-50 transition tracking-wide">
                            <td class="px-4 py-3 border border-gray-300">{{ $b->batch_label }} </td>
                            @php
                                $batch_items = App\Models\DCPBatchItem::where(
                                    'dcp_batch_id',
                                    $b->pk_dcp_batches_id,
                                )->get();
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
                                        $bg_color = 'bg-green-200 hover:bg-green-300  ';
                                    } else {
                                        $bg_color = 'bg-gray-200 hover:bg-gray-300  ';
                                    }
                                }

                            @endphp
                            <td class="px-2 py-3 md:px-4 space-x-2 border border-gray-300">
                                <a href="{{ route('school.dcp_items', $b->id ?? $b->pk_dcp_batches_id) }}"
                                    class=" flex items-center justify-center tracking-wide font-medium gap-2 text-md whitespace-nowrap {{ $bg_color }} text-gray-800 px-2 py-1   rounded    border border-gray-800">
                                    <div class="inline-block h-6 w-6">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path d="M20.3873 7.1575L11.9999 12L3.60913 7.14978" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M12 12V21" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path
                                                    d="M11 2.57735C11.6188 2.22008 12.3812 2.22008 13 2.57735L19.6603 6.42265C20.2791 6.77992 20.6603 7.44017 20.6603 8.1547V15.8453C20.6603 16.5598 20.2791 17.2201 19.6603 17.5774L13 21.4226C12.3812 21.7799 11.6188 21.7799 11 21.4226L4.33975 17.5774C3.72094 17.2201 3.33975 16.5598 3.33975 15.8453V8.1547C3.33975 7.44017 3.72094 6.77992 4.33975 6.42265L11 2.57735Z"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path d="M8.5 4.5L16 9" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                            </g>
                                        </svg>
                                    </div>
                                    {{ $completed_count }}/{{ $batch_items->count() }}
                                    Items
                                </a>
                            </td>
                            <td class="px-4 py-3 border border-gray-300 ">
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

                                    $obj = App\Models\DCPBatchItem::where(
                                        'dcp_batch_id',
                                        $b->id ?? $b->pk_dcp_batches_id,
                                    )->first();
                                    if (
                                        $obj->iar_value !== null &&
                                        $obj->itr_value !== null &&
                                        $obj->coc_status !== null &&
                                        $obj->training_acceptance_status !== null &&
                                        $obj->delivery_receipt_status !== null &&
                                        $obj->invoice_receipt_status !== null
                                    ) {
                                        $status = 'Completed';
                                        $bg_color = 'bg-green-200';
                                        $hover = 'hover:bg-green-300';
                                    } else {
                                        $status = 'Pending';
                                        $bg_color = 'bg-gray-200';
                                        $hover = 'hover:bg-gray-300';
                                    }
                                @endphp
                                <div class="text-left">
                                    <a href="{{ route('school.index.batch_status', $b->id ?? $b->pk_dcp_batches_id) }}"
                                        class="flex justify-center items-center  tracking-wide font-medium 
                                    {{ $bg_color }} {{ $hover }} text-gray-800 px-2 py-1
                                    rounded border border-gray-800">


                                        {{ $status ?? '' }}
                                    </a>
                                </div>
                            </td>
                            {{-- <td class="px-4 py-3 border border-gray-300">{{ $b->dcpPackageType->name ?? '' }}</td> --}}
                            {{-- <td class="px-4 py-3 border border-gray-300">{{ $b->budget_year }}</td> --}}
                            <td class="px-4 py-3 border border-gray-300">
                                {{ $b->delivery_date ? \Carbon\Carbon::parse($b->delivery_date)->format('F d, Y') : 'N/A' }}
                            </td>
                            <td class="px-4 py-3 border border-gray-300">{{ $b->supplier_name }}</td>
                            <td class="px-4 py-3 border border-gray-300">
                                {{ $b->submission_status }}
                            </td>
                            <td class="px-4 py-3 border border-gray-300 text-center">
                                @if (!$b->approval?->status)
                                    <form action="{{ route('submit.dcp_batch') }}" method="POST">
                                        @csrf
                                        <input class="hidden" type="text" name="dcp_batch_id"
                                            value="{{ $b->pk_dcp_batches_id }}">


                                        @php
                                            $isDisabled = !($status === 'Completed' && $item_status === 'Completed');
                                        @endphp

                                        <button {{ $isDisabled ? 'disabled' : '' }}
                                            title="{{ $isDisabled ? 'Items are not completed' : 'You can now submit information to admin' }}"
                                            class="bg-blue-500 hover:bg-blue-600 
                                            {{ $isDisabled ? 'cursor-not-allowed opacity-50' : '' }}
                                              text-white shadow tracking-wide font-medium py-1 px-4 rounded">
                                            Submit
                                        </button>
                                    </form>
                                @else
                                    @php
                                        $text_color = '';
                                        $title = '';
                                        if ($b->approval?->status == 'Approved') {
                                            $title = 'This batch is already seen by admin';

                                            $text_color = 'bg-green-600';
                                        } elseif ($b->approval?->status == 'Rejected') {
                                            $title = 'This batch has been rejected by admin';
                                            $text_color = 'bg-red-500';
                                        } elseif ($b->approval?->status == 'Pending') {
                                            $title = 'This batch is pending for admin approval';
                                            $text_color = 'bg-yellow-500';
                                        }
                                    @endphp
                                    <span title="{{ $title }}"
                                        class="{{ $text_color }}
                                        shadow rounded tracking-wider 
                                         px-2 py-1 text-white
                                           font-medium  ">{{ $b->approval?->status }}</span>
                                @endif
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-500">No DCP batches found for your school.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>


        </div>
    </div>
@endsection
