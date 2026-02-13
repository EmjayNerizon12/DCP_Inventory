<div class="overflow-x-auto ">
	@if ($cctv_info->isNotEmpty())
		@foreach ($cctv_info as $index => $info)
			<div class=" border border-gray-400 p-6  my-4 ">
				<div
					class="cursor-pointer  flex flex-col justify-center text-center 
                    cursor-pointer text-center relative
                    "
					onclick="toggleCollapse('cctv-container-{{ $loop->iteration }}',{{ $loop->iteration }})">

					<div class="grid w-full  grid-cols-2 gap-0">
						<div class="text-base text-left   font-medium tracking-wider  ">
							{{ $loop->iteration }}.
						</div>

						<div class="flex  justify-end ">

							<button class="btn-green w-auto px-2 rounded py-0 font-normal text-base hover:bg-blue-600">
								&#8369; {{ number_format($info?->equipment_details?->total_amount, 2) }}
							</button>
						</div>
					</div>

					<div class="scale-100 hover:scale-103 transition mb-2">

						<div class="text-center  whitespace-nowrap">
							Tap to Open/CLose
						</div>

						<div class="md:text-2xl text-md font-bold underline uppercase">
							{{ $info->cctv_type->name ?? '' }}

						</div>

						<div class="md:text-base text-sm">
							{{ \Carbon\Carbon::parse($info?->equipment_details?->date_installed)->format('F d, Y') ?? '' }}
						</div>
					</div>
				</div>
				<div class="flex gap-1 items-center justify-center py-2 button-container">

					<div class="action-button">

						<button class="btn-update p-1 rounded-full"
							onclick="openEditModal('cctv',{{ $info->equipment_details->pk_equipment_details_id }},{{ $info->equipment_details->brand_model->pk_equipment_brand_model_id }},{{ $info->no_of_units }},{{ $info->cctv_type->pk_e_cctv_camera_type_id }},{{ $info->equipment_details->powersource->pk_equipment_power_source_id }},{{ $info->equipment_details->location->pk_equipment_location_id }},{{ $info->equipment_details->total_amount }},{{ $info->equipment_details->installer->pk_equipment_installer_id }},{{ $info->no_of_functional }}, {{ $info->equipment_details->incharge->pk_equipment_incharge_id }},'{{ $info->equipment_details->date_installed }}')">
							@include('SchoolSide.components.svg.edit-sm')

						</button>
					</div>
					<div class="action-button">

						<button class="text-white bg-red-600 hover:bg-red-700 p-1 rounded-full"
							onclick="deleteFunction({{ $info->pk_e_cctv_details_id }}, 'cctv')">
							@include('SchoolSide.components.svg.delete-sm')

						</button>
					</div>
					<div class="action-button">
						<button id="toggle-button-{{ $loop->iteration }}" class="btn-gray p-1 rounded-full"
							onclick="toggleCollapse('cctv-container-{{ $loop->iteration }}', {{ $loop->iteration }})">
							@include('SchoolSide.components.svg.dashboard-sm')
						</button>
					</div>
				</div>
				<div class="hidden" id="cctv-container-{{ $loop->iteration }}">
					<table class="w-full border-collapse  ">
						<tbody>

							<tr>
								<td colspan="6" class="top-header">

									<div class="flex justify-between">
										<div>
											CCTV No. {{ $index + 1 }}
										</div>
										<div>
											&#8369;
											{{ number_format($info?->equipment_details?->total_amount, 2) }}
										</div>
									</div>
								</td>

							</tr>
							<tr>
								<td class="sub-header">
									Brand / Model
								</td>
								<td class="td-cell">
									{{ $info->equipment_details->brand_model->name ?? '' }}
								</td>

								<td class="sub-header">
									Camera Type
								</td>
								<td class="td-cell">
									{{ $info->cctv_type->name ?? '' }}
								</td>

								<td class="sub-header">
									Date Installed
								</td>
								<td class="td-cell">
									{{ \Carbon\Carbon::parse($info?->equipment_details?->date_installed)->format('F d, Y') ?? '' }}
								</td>
							</tr>

							<tr>
								<td class="sub-header">
									No. of Cameras
								</td>
								<td class="td-cell">
									{{ $info->no_of_units ?? '' }}
								</td>

								<td class="sub-header">
									Functional Cameras
								</td>
								<td class="td-cell">
									{{ $info->no_of_functional ?? '' }}/{{ $info->no_of_units ?? '' }}
								</td>

								<td class="sub-header">
									Power Source
								</td>
								<td class="td-cell">
									{{ $info->equipment_details->powersource->name ?? '' }}
								</td>
							</tr>

							<tr>
								<td class="sub-header">
									Location
								</td>
								<td class="td-cell">
									{{ $info->equipment_details->location->name ?? '' }}
								</td>

								<td class="sub-header">
									Installer
								</td>
								<td class="td-cell">
									{{ $info->equipment_details->installer->name ?? '' }}
								</td>

								<td class="sub-header">
									Person In-Charge
								</td>
								<td class="td-cell">
									{{ $info->equipment_details->incharge->name ?? '' }}
								</td>
							</tr>

						</tbody>
					</table>
				</div>
			</div>
		@endforeach
	@else
		<div class="text-center text-gray-600">
			No CCTV Details Available.
		</div>
	@endif

</div>
