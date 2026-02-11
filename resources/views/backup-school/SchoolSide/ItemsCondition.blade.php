@extends('layout.SchoolSideLayout')

@section('title', 'DCPMS Dashboard')

@section('content')

    <div class="py-5 px-5 ">





        {{-- <h2 class="text-lg font-semibold mb-3">Items</h2>
        <ul class="list-disc pl-5 text-gray-700">
            @foreach ($items_result as $item)
                <li>
                    Item ID: {{ $item->dcp_batch_item_id }} — Condition: {{ $item->current_condition_id }}
                </li>
            @endforeach
        </ul> --}}

        <div
            class="flex justify-between items-center bg-white mb-4 shadow-md border border-gray-300 rounded-md overflow-hidden px-4 py-2">
            <div class="text-2xl font-bold ">Condition of DCP Items
                <div class="text-lg font-normal text-gray-500 ">Here are the List of Items</div>
            </div>

            <div class="py-5 px-5">
                <span class="text-md text-gray-600">You Can Filter By Condition</span>
                <form id="conditionForm" action="{{ route('schools.item.condition.combo') }}" method="POST">
                    @csrf
                    @method('POST')
                    <select
                        class="py-1 px-2 w-full border border-gray-300 bg-white rounded-sm shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        name="condition_id" onchange="document.getElementById('conditionForm').submit()">
                        @php
                            $conditions = App\Models\DCPCurrentCondition::all();
                        @endphp
                        <option value="0" {{ request('condition_id') == 0 ? 'selected' : '' }}>All </option>
                        @foreach ($conditions as $condition)
                            <option value="{{ $condition->pk_dcp_current_conditions_id }}"
                                {{ $id == $condition->pk_dcp_current_conditions_id ? 'selected' : '' }}>
                                {{ $condition->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>

        <div class="flex md:flex-row flex-col flex-wrap md:gap-4 gap-1">
            @foreach ($totals as $total)
                @php
                    $condition = App\Models\DCPCurrentCondition::where(
                        'pk_dcp_current_conditions_id',
                        $total->current_condition_id,
                    )->first();

                    $condition_name = $condition->name ?? 'Unknown';

                    // Color map based on id
                    $colorClass = match ($total->current_condition_id) {
                        1 => 'bg-green-200',
                        2 => 'bg-yellow-200',
                        3 => 'bg-gray-200',
                        4 => 'bg-red-200',
                        5 => 'bg-indigo-200',
                        default => 'bg-gray-200',
                    };
                @endphp

                <div
                    class="flex-1 min-w-[200px] {{ $colorClass }} shadow-md rounded-md border border-gray-800 mb-2 px-5 md:py-4 py-2 flex md:flex-col flex-row items-center md:justify-center justify-between hover:shadow-lg transition">
                    <span class="text-sm text-gray-600 md:block hidden">Condition</span>
                    <h3 class="text-lg font-semibold text-gray-800 md:text-center text-left">{{ $condition_name }}</h3>
                    <p class="text-4xl font-bold text-gray-900 mt-2">{{ $total->total }}</p>
                    <span class="text-sm text-gray-600 md:block hidden">items</span>
                </div>
            @endforeach
        </div>
        @php
            $bgColors = [
                'bg-green-200',
                'bg-yellow-200',
                'bg-red-200',
                'bg-blue-200',
                'bg-indigo-200',
                'bg-purple-200',
                'bg-pink-200',
                'bg-teal-200',
                'bg-cyan-200',
            ];
        @endphp

        @if ($items_result->count() > 0)
            <div class="grid md:grid-cols-3 grid-cols-1 gap-2 border mb-2">
                @foreach ($items_result as $item)
                    @php
                        $batch_items = App\Models\DCPBatchItem::where(
                            'pk_dcp_batch_items_id',
                            $item->dcp_batch_item_id,
                        )->first();

                    @endphp
                    @php
                        $process = $batch_items->dcpItemCurrentCondition->dcpCurrentCondition;
                        if ($process->pk_dcp_current_conditions_id == 1) {
                            $bgColor = 'bg-green-200';
                        } elseif ($process->pk_dcp_current_conditions_id == 2) {
                            $bgColor = 'bg-yellow-200';
                        } elseif ($process->pk_dcp_current_conditions_id == 4) {
                            $bgColor = 'bg-red-200';
                        } elseif ($process->pk_dcp_current_conditions_id == 5) {
                            $bgColor = 'bg-purple-200';
                        } else {
                            $bgColor = 'bg-gray-200';
                        }
                    @endphp
                    <div class="px-5 py-5 border border-gray-500 bg-white    w-full ">
                        <div class="flex justify-start">
                            <span class="{{ $bgColor }} font-semibold text-gray-700 border border-gray-800 px-2 py-0">
                                {{ $loop->iteration }}.</span>
                        </div>
                        <div class="text-gray-700">
                            <b> Product:</b>
                            {{ $batch_items->dcpItemType->name }}
                        </div>
                        <div>
                            <span class="font-normal text-gray-700">
                                <b> DCP Item:</b>
                            </span>
                            {{ $batch_items->generated_code ?? '' }}
                        </div>
                        <div class="font-normal text-gray-700"> <b>From Batch:</b>
                            {{ $batch_items->dcpBatch->batch_label ?? '' }}
                        </div>


                        <div class="{{ $bgColor }} px-4   rounded-sm text-gray-800 border border-gray-800">
                            {{ $batch_items->dcpItemCurrentCondition->dcpCurrentCondition->name ?? '' }}
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-gray-200  text-gray-900 border border-gray-800 px-4 py-2 rounded-sm">
                No Items Found
            </div>
        @endif

    @endsection
