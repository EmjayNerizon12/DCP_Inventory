          <div class="overflow-x-auto">
              <div class="font-medium tracking-wider text-gray-800 text-right w-full">Tap to Open</div>
              <table class="min-w-full   text-left   table-fixed font-medium  text-gray-700 mb-4"
                  style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif  ">
                  <tbody id="tableBodyItem" class=" divide-y divide-gray-200 space-y-6">
                      @forelse($items as $index => $item)
                          <tr>
                              <td style="height: 30px; "></td>
                          </tr>

                          <tr>
                              <td x-data="{ open: false }" colspan="13"
                                  class="px-4 py-3 shadow bg-white border border-gray-300">
                                  <form id="dcp_update_form_{{ $item->pk_dcp_batch_items_id }}" method="POST"
                                      action="{{ route('school.dcp_items.update', $item->pk_dcp_batch_items_id) }}"
                                      enctype="multipart/form-data" class="space-y-4">
                                      @csrf
                                      @method('PUT')
                                      <span style="font-bold ">{{ $index + 1 }}.</span>
                                      @php

                                          $status_button = '';
                                          $status_button_bg = ' ';
                                          $condition_current =
                                              $item->dcpItemCurrentCondition->current_condition_id ?? 0;

                                      @endphp
                                      @php
                                          $completed = $condition_current && $item->brand;

                                          $classes = $completed
                                              ? 'btn-green px-2 py-1 rounded' .
                                                  ($completed ? ' hover:bg-green-600' : '')
                                              : 'text-gray-600';
                                      @endphp

                                      @if ($completed)
                                          <button id="status-badge-{{ $item->pk_dcp_batch_items_id }}"
                                              class="{{ $classes }}">
                                              Completed
                                          </button>
                                      @else
                                          <span id="status-badge-{{ $item->pk_dcp_batch_items_id }}"
                                              class="{{ $classes }}">
                                              Not Completed
                                          </span>
                                      @endif

                                      {{-- Header --}}
                                      {{-- transform scale-100 hover:scale-105 transition duration-200  --}}
                                      <div @click="open = !open"
                                          class="flex items-center  flex-col font-bold cursor-pointer tracking-wider  text-center md:text-2xl text-md pb-0 ">

                                          {{ $item->generated_code }}

                                          <div style="font-family:'Verdana', Geneva, Tahoma, sans-serif;"
                                              class="text-sm text-gray-600">
                                              @php
                                                  $item_type = DB::table('dcp_item_types')
                                                      ->where('pk_dcp_item_types_id', $item->item_type_id)
                                                      ->first();
                                              @endphp
                                              ({{ $item_type->name }})
                                          </div>
                                          <div>
                                              <span class="text-gray-600 text-sm font-normal"
                                                  style="font-family:'Verdana', Geneva, Tahoma, sans-serif;">Unit
                                                  Price:
                                                  &#8369; {{ number_format($item->unit_price, 2) }}</span>

                                          </div>


                                      </div>

                                      {{-- Flex container: QR + Inputs + Buttons --}}
                                      <div x-show="open" x-transition
                                          class="flex flex-col md:flex-row items-start md:items-end md:space-x-6">
                                          {{-- QR on the left --}}


                                          {{-- Inputs + Buttons on the right --}}
                                          <div class="flex-1 space-y-4">
                                              {{-- First row: inputs --}}
                                              <div class="grid grid-cols-1 md:grid-cols-4 gap-2">
                                                  <div>
                                                      <label class="font-semibold">Quantity:</label>
                                                      <input type="number" name="quantity"
                                                          value="{{ $item->quantity }}"
                                                          class="border rounded px-3 py-2 w-full" disabled />
                                                      <div class="text-blue-600 text-sm">View Only</div>

                                                  </div>
                                                  <div>
                                                      <label class="font-semibold">Current Condition:</label>
                                                      <select name="condition_id"
                                                          class="border rounded px-3 py-2 w-full">
                                                          <option value="">Select Condition</option>
                                                          @foreach ($conditions as $cond)
                                                              @php
                                                                  $condition_is =
                                                                      $item->dcpItemCurrentCondition
                                                                          ->current_condition_id ?? 0;

                                                              @endphp
                                                              <option value="{{ $cond->pk_dcp_current_conditions_id }}"
                                                                  {{ $condition_is == $cond->pk_dcp_current_conditions_id ? 'selected' : '' }}>
                                                                  {{ $cond->pk_dcp_current_conditions_id }} -
                                                                  {{ $cond->name }}
                                                              </option>
                                                          @endforeach
                                                      </select>
                                                      <div class="text-red-600 text-sm">Required</div>

                                                  </div>
                                                  <div>
                                                      <label class="font-semibold">Brand:</label>
                                                      {{-- <input type="text" name="brand" value="{{ $item->brand }}"
                                                            class="border rounded px-3 py-2 w-full" /> --}}
                                                      @php
                                                          if ($item->brand) {
                                                              $readonly = 'disabled';
                                                          } else {
                                                              # code...
                                                              $readonly = '';
                                                          }
                                                      @endphp
                                                      <select name="brand" {{ $readonly }}
                                                          class="border rounded px-3 py-2 w-full" id="">
                                                          <option value="" {{ $item->brand ? '' : 'selected' }}>
                                                              Select Brand</option>
                                                          @foreach ($brand_list as $brand)
                                                              <option
                                                                  {{ $item->brand == $brand->pk_dcp_batch_item_brands_id ? 'selected' : '' }}
                                                                  value="{{ $brand->pk_dcp_batch_item_brands_id }}">
                                                                  {{ $brand->brand_name }}</option>
                                                          @endforeach
                                                      </select>
                                                      <div class="text-blue-600 text-sm">View Only</div>
                                                  </div>
                                                  <div>
                                                      <label class="font-semibold">Serial Number: </label>
                                                      <input type="text" name="serial_number"
                                                          id="selectedSerialNumber_{{ $item->pk_dcp_batch_items_id }}"
                                                          value="{{ $item->serial_number }}"
                                                          class="border rounded px-3 py-2 w-full" />
                                                      <div class="text-red-600 text-sm">Leave Blank if no serial
                                                          number</div>

                                                  </div>
                                              </div>

                                              {{-- Second row: action buttons --}}
                                              <div class="flex space-x-2">


                                                  <div class="flex justify-start items-center  gap-2">
                                                      <button type="button"
                                                          onclick="update({{ $item->pk_dcp_batch_items_id }})"
                                                          id="status-button-{{ $item->pk_dcp_batch_items_id }}"
                                                          class=" {{ $condition_current && $item->brand ? 'btn-green' : 'btn-submit' }}   h-8 py-1 px-4 rounded">
                                                          {{ $condition_current && $item->brand ? 'Update' : 'Submit' }}
                                                      </button>

                                                      <div
                                                          class="h-10 w-10 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                                                          <button type="button"
                                                              onclick='window.location.href="/School/DCPInventory/{{ $item->generated_code }}"'
                                                              title="Show in Inventory"
                                                              class="p-1  btn-cancel  rounded-full  ">
                                                              <div class="flex items-center ">
                                                                  <svg class="h-6 w-6 " viewBox="0 0 24 24"
                                                                      fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                      <g id="SVGRepo_bgCarrier" stroke-width="0">
                                                                      </g>
                                                                      <g id="SVGRepo_tracerCarrier"
                                                                          stroke-linecap="round"
                                                                          stroke-linejoin="round"></g>
                                                                      <g id="SVGRepo_iconCarrier">
                                                                          <path
                                                                              d="M3.17004 7.43994L12 12.5499L20.77 7.46991"
                                                                              stroke="currentColor" stroke-width="1.5"
                                                                              stroke-linecap="round"
                                                                              stroke-linejoin="round">
                                                                          </path>
                                                                          <path d="M12 21.6099V12.5399"
                                                                              stroke="currentColor" stroke-width="1.5"
                                                                              stroke-linecap="round"
                                                                              stroke-linejoin="round"></path>
                                                                          <path
                                                                              d="M21.61 12.83V9.17C21.61 7.79 20.62 6.11002 19.41 5.44002L14.07 2.48C12.93 1.84 11.07 1.84 9.92999 2.48L4.59 5.44002C3.38 6.11002 2.39001 7.79 2.39001 9.17V14.83C2.39001 16.21 3.38 17.89 4.59 18.56L9.92999 21.52C10.5 21.84 11.25 22 12 22C12.75 22 13.5 21.84 14.07 21.52"
                                                                              stroke="currentColor" stroke-width="1.5"
                                                                              stroke-linecap="round"
                                                                              stroke-linejoin="round">
                                                                          </path>
                                                                          <path
                                                                              d="M19.2 21.4C20.9673 21.4 22.4 19.9673 22.4 18.2C22.4 16.4327 20.9673 15 19.2 15C17.4327 15 16 16.4327 16 18.2C16 19.9673 17.4327 21.4 19.2 21.4Z"
                                                                              stroke="currentColor" stroke-width="1.5"
                                                                              stroke-linecap="round"
                                                                              stroke-linejoin="round">
                                                                          </path>
                                                                          <path d="M23 22L22 21" stroke="currentColor"
                                                                              stroke-width="1.5" stroke-linecap="round"
                                                                              stroke-linejoin="round"></path>
                                                                      </g>
                                                                  </svg>
                                                              </div>
                                                          </button>
                                                      </div>
                                                  </div>

                                              </div>
                                          </div>
                                          <div class="flex-shrink-0 mb-4 md:mb-0 mt-3 md:mt-0">
                                              @php
                                                  $url = url("/School/DCPInventory/{$item->generated_code}");
                                                  $svg = SimpleSoftwareIO\QrCode\Facades\QrCode::format(
                                                      'svg',
                                                  )->generate($url);
                                                  $base64QrCode = base64_encode($svg);
                                              @endphp
                                              <div class="p-2 border-2 border-dashed border-gray-300">
                                                  <img src="data:image/svg+xml;base64,{{ $base64QrCode }}"
                                                      class="w-28 h-28" alt="QR Code">
                                                  <p class="text-center text-sm mt-1">Scan to show</p>
                                              </div>
                                          </div>
                                      </div>


                                      {{-- Success message --}}
                                      <div id="result_{{ $item->pk_dcp_batch_items_id }}"
                                          class="hidden mt-2 bg-green-100 border border-green-400 text-green-700 px-3 py-2 rounded flex items-center gap-2 text-md">
                                          <svg class="w-4 h-4 mr-1 text-green-600" fill="none"
                                              stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                              <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M5 13l4 4L19 7" />
                                          </svg>
                                          <span id="result-message-{{ $item->pk_dcp_batch_items_id }}"></span>
                                      </div>
                                  </form>
                              </td>
                          </tr>
                      @empty
                          <tr>
                              <td colspan="13" class="text-center py-4 text-gray-500">
                                  No items found for this batch.
                              </td>
                          </tr>
                      @endforelse
                  </tbody>

              </table>
          </div>
