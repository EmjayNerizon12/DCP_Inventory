@foreach ($batch_items as $typeId => $items)
    @php
        // get item type name
        $name = App\Models\DCPItemTypes::where('pk_dcp_item_types_id', $typeId)->value('name');

        // sum of unit prices
        $totalSum = $items->sum('unit_price');

        // join unit prices into one string
        $unitPrice = $items->first()->unit_price ?? 0;
        $status = $items->first()->item_status ?? '';

        // join statuses
        $totalCount = $items->count();
        $functionalCnt = $items->where('item_status', 1)->count();
        $percentage = $totalCount > 0 ? ($functionalCnt / $totalCount) * 100 : 0;
    @endphp
    <tr>
        <td class="border w-5 px-2 py-1 text-center">{{ $loop->iteration }}</td>
        <td class="border px-2 py-1 font-semibold">{{ $name ?? 'N/A' }}</td>
        <td class="border px-2 py-1 whitespace-nowrap">
            ₱{{ number_format($unitPrice, 2) }}
        </td>
        <td class="border px-2 py-1 whitespace-nowrap">₱{{ number_format($totalSum, 2) }}
        </td>
        <td class="border px-2 py-1">{{ $functionalCnt }} / {{ $totalCount }}
            ({{ $percentage }}%)
        </td>
    </tr>
@endforeach
@php
    $total_items = App\Models\DCPBatchItem::where('dcp_batch_id', $batch->pk_dcp_batches_id)->count();
    $total_functional = App\Models\DCPBatchItem::where('dcp_batch_id', $batch->pk_dcp_batches_id)
        ->where('item_status', '1')
        ->count();
    $overall_percentage = $total_items > 0 ? ($total_functional / $total_items) * 100 : 0;
    $total_items = App\Models\DCPBatchItem::where('dcp_batch_id', $batch->pk_dcp_batches_id)->count();
    $total_price = App\Models\DCPBatchItem::where('dcp_batch_id', $batch->pk_dcp_batches_id)->sum('unit_price');
    $overall_percentage = $total_items > 0 ? ($total_functional / $total_items) * 100 : 0;
@endphp
<tr class="bg-gray-100">
    <td colspan="3" class="secondary-header px-2 py-1 ">TOTAL</td>

    <td class="secondary-header  px-2 py-1 "> ₱{{ number_format($total_price, 2) }}</td>
    <td class=" secondary-header px-2 py-1  " class="text-sm font-semibold">
        {{ $total_functional }} / {{ $total_items }}
        {{ $overall_percentage }}%</td>
</tr>
