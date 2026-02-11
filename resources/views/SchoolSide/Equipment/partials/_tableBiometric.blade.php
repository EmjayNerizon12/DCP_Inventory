 <div class="overflow-x-auto ">

     @if ($biometric_info->isNotEmpty())
         @foreach ($biometric_info as $index => $info)
             <div class="my-2">

                 <table class="w-full border-collapse">
                     <tbody>

                         {{-- HEADER ROW --}}
                         <tr>
                             <td colspan="6" class="top-header">
                                 <div class="flex justify-between">
                                     <div>
                                         Biometrics No. {{ $index + 1 }}
                                     </div>
                                     <div>
                                         &#8369; {{ number_format($info?->equipment_details?->total_amount, 2) }}
                                     </div>
                                 </div>
                             </td>
                         </tr>

                         {{-- ROW 1 --}}
                         <tr>
                             <td class="sub-header">Brand /
                                 Model</td>
                             <td class="td-cell">
                                 {{ $info->equipment_details->brand_model->name ?? '' }}
                             </td>

                             <td class="sub-header">
                                 Authentication Type</td>
                             <td class="td-cell">
                                 {{ $info->biometric_type->name ?? '' }}
                             </td>

                             <td class="sub-header">Date
                                 Installed</td>
                             <td class="td-cell">
                                 {{ \Carbon\Carbon::parse($info->$info?->equipment_details?->date_installed)->format('F d, Y') }}
                             </td>
                         </tr>

                         {{-- ROW 2 --}}
                         <tr>
                             <td class="sub-header">No. of
                                 Biometrics</td>
                             <td class="td-cell">
                                 {{ $info->no_of_units ?? '' }}
                             </td>

                             <td class="sub-header">Functional
                                 Biometrics</td>
                             <td class="td-cell">
                                 {{ $info->no_of_functional ?? '' }}/{{ $info->no_of_units ?? '' }}
                             </td>

                             <td class="sub-header">Power
                                 Source</td>
                             <td class="td-cell">
                                 {{ $info->equipment_details->powersource->name ?? '' }}
                             </td>
                         </tr>

                         {{-- ROW 3 --}}
                         <tr>
                             <td class="sub-header">Location
                             </td>
                             <td class="td-cell">
                                 {{ $info->equipment_details->location->name ?? '' }}
                             </td>

                             <td class="sub-header">Installer
                             </td>
                             <td class="td-cell">
                                 {{ $info->equipment_details->installer->name ?? '' }}
                             </td>

                             <td class="sub-header">Person
                                 In-Charge</td>
                             <td class="td-cell">
                                 {{ $info->equipment_details->incharge->name ?? '' }}
                             </td>
                         </tr>
                         <tr>
                             <td colspan="6">
                                 <div class="flex gap-1 items-center justify-end py-2">

                                     <div
                                         class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                                         <button class="btn-update p-1 rounded-full"
                                             onclick="openEditModal(
                                                                'biometrics',
                                                                {{ $info->equipment_details->pk_equipment_details_id }},
                                                                {{ $info->equipment_details->brand_model->pk_equipment_brand_model_id }},
                                                                {{ $info->no_of_units }},
                                                                {{ $info->biometric_type->pk_e_biometric_type_id }},
                                                                {{ $info->equipment_details->powersource->pk_equipment_power_source_id }},
                                                                {{ $info->equipment_details->location->pk_equipment_location_id }},
                                                                {{ $info->equipment_details->total_amount }},
                                                                {{ $info->equipment_details->installer->pk_equipment_installer_id }},
                                                                {{ $info->no_of_functional }},
                                                                {{ $info->equipment_details->incharge->pk_equipment_incharge_id }},
                                                                '{{ $info->equipment_details->date_installed }}'
                                                            )">
                                             <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                 <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                 <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                     stroke-linejoin="round"></g>
                                                 <g id="SVGRepo_iconCarrier">
                                                     <g id="Edit / Edit_Pencil_Line_02">
                                                         <path id="Vector"
                                                             d="M4 20.0001H20M4 20.0001V16.0001L14.8686 5.13146L14.8704 5.12976C15.2652 4.73488 15.463 4.53709 15.691 4.46301C15.8919 4.39775 16.1082 4.39775 16.3091 4.46301C16.5369 4.53704 16.7345 4.7346 17.1288 5.12892L18.8686 6.86872C19.2646 7.26474 19.4627 7.46284 19.5369 7.69117C19.6022 7.89201 19.6021 8.10835 19.5369 8.3092C19.4628 8.53736 19.265 8.73516 18.8695 9.13061L18.8686 9.13146L8 20.0001L4 20.0001Z"
                                                             stroke="currentColor" stroke-width="2"
                                                             stroke-linecap="round" stroke-linejoin="round">
                                                         </path>
                                                     </g>
                                                 </g>
                                             </svg>
                                         </button>
                                     </div>
                                     <div
                                         class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                                         <button class="text-white bg-red-600 hover:bg-red-700 p-1 rounded-full"
                                             onclick="deleteFunction({{ $info->pk_e_biometric_details_id }}, 'biometrics')">
                                             <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                 <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                 <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                     stroke-linejoin="round"></g>
                                                 <g id="SVGRepo_iconCarrier">
                                                     <path
                                                         d="M5.755,20.283,4,8H20L18.245,20.283A2,2,0,0,1,16.265,22H7.735A2,2,0,0,1,5.755,20.283ZM21,4H16V3a1,1,0,0,0-1-1H9A1,1,0,0,0,8,3V4H3A1,1,0,0,0,3,6H21a1,1,0,0,0,0-2Z">
                                                     </path>
                                                 </g>
                                             </svg>
                                         </button>
                                     </div>

                                 </div>
                             </td>
                         </tr>
                     </tbody>
                 </table>
             </div>
         @endforeach
     @else
         <div class="text-center text-gray-600">
             No Biometric Details Available.
         </div>
     @endif

 </div>
