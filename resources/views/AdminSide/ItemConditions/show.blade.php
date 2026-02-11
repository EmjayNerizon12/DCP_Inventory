@extends('layout.Admin-Side')
<title>@yield('title', 'DCP Conditions')</title>

@section('content')
    <div class="p-2 md:my-5 mx-0 my-0">

        <div class="flex md:flex-row flex-col justify-between items-center mb-4">
            <div class="  flex justify-start gap-2 items-center ">

                <div
                    class="h-16 w-16 bg-white p-3 border border-gzray-300 shadow-lg rounded-full flex items-center justify-center">
                    <div class="text-white bg-blue-600 p-2 rounded-full">
                        <svg fill="currentColor" class="w-10 h-10" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path fill-rule="evenodd"
                                    d="M384,-2.84217094e-14 L384,74.666 L426.666667,74.6666667 L426.666667,181.333333 L384,181.333 L384,256 L-2.13162821e-14,256 L-2.13162821e-14,-2.84217094e-14 L384,-2.84217094e-14 Z M341.333333,42.6666667 L42.6666667,42.6666667 L42.6666667,213.333333 L341.333333,213.333333 L341.333333,42.6666667 Z M234.083198,55.7493229 L269.58401,79.4165312 L189.982396,198.818952 L113.830111,122.666667 L144,92.4967773 L183.338667,131.818667 L234.083198,55.7493229 Z"
                                    transform="translate(42.667 128)"></path>
                            </g>
                        </svg>
                    </div>
                </div>
                <div class="w-full" style="letter-spacing: 0.05rem">
                    <h2 class="text-2xl font-bold text-gray-800 uppercase">DCP item current condition</h2>
                    <div id="page-title" style="letter-spacing: 0.05rem!important" class="text-lg font-medium uppercase  ">
                    </div>

                </div>
            </div>
            <div class="w-50 flex md:justify-end justify-start my-2 mx-5">
                <select style="letter-spacing: 0.05rem" id="select-condition"
                    class="px-3 py-2 text-md border border-gray-300 shadow-sm  rounded-md bg-white mb-2"
                    onchange="showCondition()">
                    @php
                        $condition_list = App\Models\DCPItemCondition::with('dcpCurrentCondition')
                            ->get()
                            ->groupBy('current_condition_id')
                            ->map(function ($group) {
                                return [
                                    'condition' => $group->first()->dcpCurrentCondition->name,
                                    'id' => $group->first()->current_condition_id,
                                    'count' => $group->count(),
                                ];
                            })
                            ->values()
                            ->toArray();
                    @endphp
                    <option>Select Condition</option>
                    <option value="0">All</option>
                    @foreach ($condition_list as $list)
                        <option value="{{ $list['id'] }}">
                            {{ $list['condition'] }} ({{ $list['count'] }})
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div>

        </div>
        <div id="printReport">


        </div>
        <div style="letter-spacing: 0.05rem !important" id="card-container" class="  grid grid-cols-1 md:grid-cols-2 gap-2">

        </div>
    </div>
    <style>
        #printReport {
            display: none;
        }

        @media print {
            body * {
                visibility: hidden;
                /* hide everything */
            }

            #printReport,
            #printReport * {
                visibility: visible;
                /* show only the print container */
            }

            #printReport {
                position: absolute;
                left: 0;
                top: 0;
            }
        }
    </style>
    <script>
        async function generateItemReport(id) {
            console.log(id);
            const response = await fetch('/Admin/ItemConditions/Report/' + id);
            const data = await response.json();
            const printContainer = document.getElementById('printReport');
            const divContainer = document.createElement('div');
            const content = document.createElement('div');
            content.innerHTML = `
                    <div class="text-2xl font-semibold text-gray-800 w-full text-center mb-2">
                    ${data.generated_code}
                    </div>
                     <div class="text-lg font-bold text-gray-800 w-full text-center mb-4">
                    (${data.dcp_item_current_condition.dcp_current_condition.name})
                    </div>
                    
                    <table  class="min-w-full border border-gray-400 text-md text-left text-gray-700">
                    <tbody>
                        <tr class="border-b">
                        <th class="px-3 py-2 border w-1/4 font-semibold bg-gray-100">Product</th>
                        <td class="px-3 py-2 border">${data.dcp_item_type.name ?? ''}</td>
                        </tr>
                        <tr class="border-b">
                        <th class="px-3 py-2 border font-semibold bg-gray-100">Batch</th>
                        <td class="px-3 py-2 border">${data.dcp_batch.batch_label ?? ''}</td>
                        </tr>
                        <tr class="border-b">
                        <th class="px-3 py-2 border font-semibold bg-gray-100">School</th>
                        <td class="px-3 py-2 border">${data.dcp_batch.school.SchoolName ?? ''} - ${data.dcp_batch.school.SchoolLevel ?? ''}</td>
                        </tr>
                        <tr class="border-b">
                        <th class="px-3 py-2 border font-semibold bg-gray-100">Product Code</th>
                        <td class="px-3 py-2 border">${data.generated_code}</td>
                        </tr>
                        <tr class="border-b">
                        <th class="px-3 py-2 border  font-semibold bg-gray-100">Unit Price</th>
                        <td class="px-3 py-2 border">₱ ${data.unit_price}</td>
                        </tr>
                        <tr class="border-b">
                        <th class="px-3 py-2 border font-semibold bg-gray-100">Quantity</th>
                        <td class="px-3 py-2 border">${data.quantity}</td>
                        </tr>
                        <tr class="border-b">
                        <th class="px-3 py-2  border font-semibold bg-gray-100">Unit</th>
                        <td class="px-3 py-2 border">${data.unit}</td>
                        </tr>
                        <tr class="border-b">
                        <th class="px-3 py-2 border font-semibold bg-gray-100">Condition</th>
                        <td class="px-3 py-2 border">${data.dcp_item_current_condition.dcp_current_condition.name}</td>
                        </tr>
                        <tr class="border-b">
                        <th class="px-3 py-2 border font-semibold bg-gray-100">Brand</th>
                        <td class="px-3 py-2 border">${data.brand ?? 'N/A'}</td>
                        </tr>
                        <tr class="border-b">
                        <th class="px-3 py-2 border font-semibold bg-gray-100">Serial Number</th>
                        <td class="px-3 py-2 border">${data.serial_number ?? 'N/A'}</td>
                        </tr>
                        <tr class="border-b">
                        <th class="px-3 py-2 border font-semibold bg-gray-100">IAR</th>
                        <td class="px-3 py-2 border">${data.iar_value}</td>
                        </tr>
                        <tr class="border-b">
                        <th class="px-3 py-2 border font-semibold bg-gray-100">ITR</th>
                        <td class="px-3 py-2 border">${data.itr_value}</td>
                        </tr>
                        <tr class="border-b">
                        <th class="px-3 py-2 border font-semibold bg-gray-100">COC Status</th>
                        <td class="px-3 py-2 border">${data.coc_status}</td>
                        </tr>
                        <tr class="border-b">
                        <th class="px-3 py-2 border font-semibold bg-gray-100">Training Acceptance</th>
                        <td class="px-3 py-2 border">${data.training_acceptance_status}</td>
                        </tr>
                        <tr class="border-b">
                        <th class="px-3 py-2 border font-semibold bg-gray-100">Delivery Receipt</th>
                        <td class="px-3 py-2 border">${data.delivery_receipt_status}</td>
                        </tr>
                        <tr class="border-b">
                        <th class="px-3 py-2 border font-semibold bg-gray-100">Invoice Receipt</th>
                        <td class="px-3 py-2 border">${data.invoice_receipt_status}</td>
                        </tr>
                        <tr>
                        <th class="px-3 py-2 font-semibold bg-gray-100 border">Date Approved</th>
                        <td class="px-3 py-2 border">${data.date_approved}</td>
                        </tr>
                    </tbody>
                    </table>
                    <div class="grid grid-cols-1 gap-4 mt-8"> 
                        <div class="text-md">School Officials:</div>
                 <div class="flex flex-row   gap-5 w-full">
                     <div class="text-md   w-full">
                         <div class="text-md text-center">${data.dcp_batch.school.PrincipalName}</div>
                         <div class="text-sm border-t-2 border-gray-900 text-center">SIGNATURE OVER PRINTED NAME</div>
                         <div class="text-md  text-center">School Head</div>
                     </div>
                     <div class="text-md   w-full">
                         <div class="text-md text-center ">${data.dcp_batch.school.ICTName}</div>
                         <div class="text-sm border-t-2 border-gray-900 text-center">SIGNATURE OVER PRINTED NAME</div>
                         <div class="text-md  text-center">ICT Coordinator</div>
                     </div>
                     <div class="text-md   w-full">
                         <div class="text-md text-center">${data.dcp_batch.school.CustodianName}</div>
                         <div class="text-sm border-t-2 border-gray-900 text-center">SIGNATURE OVER PRINTED NAME</div>
                         <div class="text-md text-center ">Property Custodian</div>
                     </div>
                 </div>

             </div>
              <div class="flex flex-row  flex-start gap-5 w-full">
                      <div class="grid grid-cols-1 gap-0 mt-8">
                        <div class="text-md">Prepared By:</div>
                        <div class="text-center mt-2 font-semibold">NORMAN A. FLORES</div>
                        <div class="text-sm border-t-2 border-gray-900 mx-auto w-64 text-center">SIGNATURE OVER PRINTED NAME</div>
                        <div class="text-md text-center">Information Technology Officer I</div>
                    </div>
                    </div>
              <div class="flex flex-row align-center justify-center gap-5 w-full">

                    <div class="grid grid-cols-1 gap-0 mt-8">
                        <div class="text-md text-left">Noted:</div>
                        <div class="text-md text-center mt-2 font-semibold">DIOSDADO I. CAYABYAB, CESO VI</div>
                        <div class="text-sm border-t-2 border-gray-900 mx-auto w-80 text-center">SIGNATURE OVER PRINTED NAME</div>
                        <div class="text-md text-center">Schools Division Superintendent</div>
                    </div>
                    </div>
                `;

            divContainer.appendChild(content);

            printContainer.appendChild(divContainer);
            printContainer.classList.remove('hidden');
            printContainer.classList.add('flex', 'flex-col', 'gap-2', 'bg-white', 'px-5', 'py-5',
                'w-full');

            printContainer.style.display = 'block'; // temporarily display
            window.print();
            printContainer.style.display = 'none'; // hide again
            printContainer.innerHTML = '';
        }
    </script>
    <script>
        function showCondition() {
            const dropDown = document.getElementById('select-condition');
            const cardId = dropDown.value;
            window.location.href = `/Admin/ItemConditions/${cardId}`


        }
        // document.addEventListener("DOMContentLoaded", showCondition);
        const myConditions = @json($condition);
        console.log(myConditions);
        const bgColors = [

            "#16A34A", // green
            "#DC2626", // red
            "#3B82F6", // blue fair
            "#FACC15", // yellow
            "#4F46E5", // indigo
            "#4B5563", // light gray - missing
            "#9CA3AF ", // light gray
            "#9CA3AF ", // light gray
            "#9CA3AF ", // light gray
            "bg-green-100", // green-100
            "bg-yellow-100", // yellow-100
            "bg-gray-100", // gray-100
            "bg-red-100", // red-100
            "bg-indigo-100", // indigo-100
            "bg-gray-100", // gray-200
        ];
        // const dropDown = document.getElementById('select-condition').value =const condition = params.get("condition");;

        myConditions.forEach((data, index) => {
            console.log(data.dcp_batch_item_id);
            document.getElementById('page-title').innerHTML =
                `${data.condition ==0 ?  'All': data.condition}`;
            const newCard = document.createElement("div");
            newCard.className =
                "px-5 py-5 border border-gray-300 bg-white    w-full";
            newCard.innerHTML = `
                   
            <div>
                        <div class="flex justify-center relative items-center mb-4">
                            <span  class="  text-gray-800 text-lg font-semibold  rounded-full  px-2 py-0">
                           Product ${index + 1}</span>
                              <div class="flex justify-end mt-2 absolute right-0">
                            <button type="button" onclick=(generateItemReport(${data.dcp_batch_item_id})) class="bg-gray-200 border border-gray-300 px-4 py-1 rounded-sm shadow-md  font-semibold"> 
                                
                                <svg class="w-6 h-6 text-gray-700" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path fill-rule="evenodd" clip-rule="evenodd" d="M17 7H7V6h10v1zm0 12H7v-6h10v6zm2-12V3H5v4H1v8.996C1 17.103 1.897 18 3.004 18H5v3h14v-3h1.996A2.004 2.004 0 0 0 23 15.996V7h-4z" fill="currentColor"></path></g></svg>
                                </button>
                            </div>
                        </div>
                        <div class="text-gray-700">
                            <b> Product:</b>
                            ${data.item_type ?? ''}
                        </div>
                        <div>
                            <span class="font-normal text-gray-700">
                                <b> DCP Item:</b>
                            </span>
                        ${data.generated_code ?? ''}
                        </div>
                        <div class="font-normal text-gray-700 mb-3"> <b>From Batch:</b>
                            ${data.batch_label ?? ''}
                        </div>


                        <div style="background-color:${bgColors[data.condition_id-1]};" class=" px-4 py-1  text-md uppercase rounded-sm text-white font-medium  shadow-md">
                           ${data.condition ?? ''}
                        </div>
                     
                    </div>
            `;
            document.getElementById("card-container").appendChild(newCard);
        });
    </script>
@endsection
