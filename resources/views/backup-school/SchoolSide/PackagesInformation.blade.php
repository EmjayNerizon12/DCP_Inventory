@extends('layout.SchoolSideLayout')

@section('title', 'DCPMS Dashboard')

@section('content')

    <div class="py-5 px-5">
        <div class="text-2xl font-bold ">About Packages</div>
        <div class="text-lg font-normal text-gray-500 mb-4">Here are the List of Packages</div>
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
        @foreach ($packageContent as $index => $package)
            <div class="mb-4 bg-white rounded-lg py-2 border border-gray-500  px-4">


                <div class="font-normal  text-gray-800  ">
                    <div>
                        <span class="font-semibold">Package Name:</span> {{ $package['package_name'] }}
                    </div>
                    <div>
                        <span class="font-semibold">Total Items:</span>
                        @php
                            $totalItems = 0;
                            foreach ($package['contents'] as $content) {
                                $totalItems += $content->quantity;
                            }
                        @endphp
                        {{ $totalItems }}
                    </div>

                </div>
                <div class="flex flex-row gap-1 overflow-x-auto">
                    @foreach ($package['contents'] as $index => $content)
                        @php
                            $itemName = App\Models\DCPItemTypes::where(
                                'pk_dcp_item_types_id',
                                $content->dcp_item_types_id,
                            )->value('name');
                        @endphp
                        <div
                            class="  {{ $bgColors[$index % count($bgColors)] }} text-white my-2 px-4 text-gray-800 border border-gray-800  rounded-sm">
                            <b>{{ $content->quantity }}</b> - {{ $itemName }}
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

@endsection
