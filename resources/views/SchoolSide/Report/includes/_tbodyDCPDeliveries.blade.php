     @php
         $totalPrice = 0;
     @endphp
     @foreach ($batches as $index => $batch)
         <tr>
             <td class="px-5 border py-1 text-center"> {{ $index + 1 }}</td>
             <td class="px-5 border py-1"> {{ $batch->batch_label }}</td>
             <td class="px-5 border py-1"> {{ $batch->budget_year }}</td>
             <td class="px-5 border py-1">
                 {{ \Carbon\Carbon::parse($batch->delivery_date)->format('F j, Y') ?? $batch->delivery_date }}
             </td>
             {{-- <td class="px-5">  1</td> --}}
             @php
                 $batch_items_price = App\Models\DCPBatchItem::where('dcp_batch_id', $batch->pk_dcp_batches_id)->sum(
                     'unit_price',
                 );
                 $total_functional = App\Models\DCPBatchItem::where('dcp_batch_id', $batch->pk_dcp_batches_id)
                     ->where('item_status', '1')
                     ->count();
                 $total_items = App\Models\DCPBatchItem::where('dcp_batch_id', $batch->pk_dcp_batches_id)->count();
                 $percentage = $total_items > 0 ? ($total_functional / $total_items) * 100 : 0;

             @endphp
             <td class="px-5 border py-1 whitespace-nowrap">&#8369;
                 {{ number_format($batch_items_price, 2) }}
             </td>
             <td class="px-5 border py-1">Functional: {{ $total_functional }} out of
                 {{ $total_items }}
                 ({{ $percentage }}%)
             </td>
             <td class="px-5 border py-1"> No Status Available</td>
             <td class="px-5 border py-1"> None</td>

         </tr>
         @php
             $totalPrice += $batch_items_price;
         @endphp
     @endforeach
     <tr>
         <td class="secondary-header" colspan="4">
             OVERALL TOTAL COST
         </td>
         <td class="secondary-header" colspan="1">
             &#8369; {{ number_format($totalPrice, 2) }}

         </td>
         <td class="secondary-header" colspan="3">

         </td>
     </tr>
