@foreach ($batch_items as $batch_item)
    <tr>
        <td class="td-cell">
            {{ $loop->iteration }}
        </td>
        <td class="td-cell">
            {{ $batch_item->generated_code }}
        </td>

        <td class="  md:w-fit  td-cell">{{ $batch_item->batch_label }}</td>
        <td class="td-cell">
            @php
                $item_name = \App\Models\DCPItemTypes::firstWhere('pk_dcp_item_types_id', $batch_item->item_type_id);
            @endphp
            {{ $item_name->name }}</td>
        <td class="td-cell">
            @php
                $brand_name = \App\Models\DCPBatchItemBrand::where(
                    'pk_dcp_batch_item_brands_id',
                    $batch_item->brand,
                )->value('brand_name');

            @endphp
            {{ $brand_name ?? 'N/A' }}
        </td>
        <td class="td-cell w-fit">
            <div class="flex flex-row justify-center">


                <a href="{{ route('school.dcp_inventory.items', $batch_item->generated_code) }}">

                    <div
                        class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                        <button class="  btn-submit  p-1 rounded-full">
                            Show
                        </button>
                    </div>
                </a>
            </div>
        </td>

    </tr>
@endforeach
