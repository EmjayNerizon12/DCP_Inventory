@extends('layout.SchoolSideLayout')

@section('title', 'DCPMS Dashboard')

@section('content')

    <div class="p-6">

        <input type="hidden" id="school_id" value="{{ Auth::guard('school')->user()->school->pk_school_id }}">
        <div
            class="flex hidden justify-between items-center bg-white mb-4 shadow-md border border-gray-300 rounded-md overflow-hidden px-4 py-2">
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
        <div class="flex hidden md:flex-row flex-col flex-wrap md:gap-4 gap-1">
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
            <div class="grid hidden md:grid-cols-3 grid-cols-1 gap-2 border mb-2">
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
        <div class="space-y-4">


            <div class="flex justify-start space-x-4">

                <div>

                    <div class="page-title">Product Conditions - Inventory</div>
                    <div class="page-subtitle">List of Products with Current Condition
                    </div>

                </div>

            </div>
            <div>

                <div class="form-label">
                    Current Condition
                </div>
                <div class="flex gap-2">

                    <select id="select-condition-item" class="form-input max-w-sm">
                        <option value="">Select</option>
                        @foreach (App\Models\DCPCurrentCondition::all() as $cond)
                            <option value="{{ $cond->pk_dcp_current_conditions_id }}">{{ $cond->name }}</option>
                        @endforeach
                    </select>
                    <button class="theme-button" id="conditionButton" onclick="loadCondition()">
                        Get Items
                    </button>
                </div>
            </div>
            <div class="flex gap-2 mb-4">
                <div
                    class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                    <button id="btnDiv1" onclick="showDiv1()" class="btn-submit rounded-full flex p-1  ">
                        <svg viewBox="0 0 24 24" class="w-8 h-8" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M9 4L9 20M15 4L15 20M3 9H21M3 15H21M6.2 20H17.8C18.9201 20 19.4802 20 19.908 19.782C20.2843 19.5903 20.5903 19.2843 20.782 18.908C21 18.4802 21 17.9201 21 16.8V7.2C21 6.0799 21 5.51984 20.782 5.09202C20.5903 4.71569 20.2843 4.40973 19.908 4.21799C19.4802 4 18.9201 4 17.8 4H6.2C5.07989 4 4.51984 4 4.09202 4.21799C3.71569 4.40973 3.40973 4.71569 3.21799 5.09202C3 5.51984 3 6.07989 3 7.2V16.8C3 17.9201 3 18.4802 3.21799 18.908C3.40973 19.2843 3.71569 19.5903 4.09202 19.782C4.51984 20 5.07989 20 6.2 20Z"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </g>
                        </svg>
                    </button>
                </div>
                <div
                    class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                    <button id="btnDiv2" onclick="showDiv2()" class="  btn-cancel rounded-full flex p-1  ">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 256 256" id="Flat"
                            xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M200.00781,88V200a16.01833,16.01833,0,0,1-16,16h-144a16.01833,16.01833,0,0,1-16-16V88a16.01833,16.01833,0,0,1,16-16h144A16.01833,16.01833,0,0,1,200.00781,88Zm16-48h-152a8,8,0,0,0,0,16h152V176a8,8,0,0,0,16,0V56A16.01833,16.01833,0,0,0,216.00781,40Z">
                                </path>
                            </g>
                        </svg>
                    </button>
                </div>
            </div>
            <div id="divContainer1">
                <div id="itemContainer" class="grid md:grid-cols-3 grid-cols-1 gap-4 "></div>

            </div>
            <div id="divContainer2" class="hidden">

                <div id="cardContainer" class="grid md:grid-cols-5 grid-cols-1 md:gap-4 gap-1  "></div>
            </div>
        </div>
    </div>
    @include('SchoolSide.includes.Condition._script')
    @include('SchoolSide.components._scriptSwitchButton')
@endsection
