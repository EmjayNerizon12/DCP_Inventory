   @foreach ($non_dcp as $item)
       <tr>
           <td class="border w-5 px-2 py-1 text-center">{{ $loop->iteration }}</td>
           <td class="border px-2 py-1">{{ $item->item_description }}</td>
           <td class="border px-2 py-1 ">&#8369;
               {{ number_format($item->unit_price, 2) }}</td>
           <td class="border px-2 py-1 ">
               {{ \Carbon\Carbon::parse($item->date_acquired)->format('M d, Y') ?? $item->date_acquired }}
           </td>
           <td class="border px-2 py-1 ">{{ $item->total_functional }}/{{ $item->total_item }}
           </td>
           <td class="border px-2 py-1 ">{{ $item->fund_source->name }}</td>
           <td class="border px-2 py-1 ">{{ $item->item_holder_and_location }}</td>
           <td class="border px-2 py-1 ">{{ $item->remarks }}</td>
       </tr>
   @endforeach
