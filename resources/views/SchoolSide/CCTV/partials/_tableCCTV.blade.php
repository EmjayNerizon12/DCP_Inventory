<div id="renderCCTVData"></div>

<script>
	//Render the CCTV INFORMATION
	const cctvContainer = document.getElementById('renderCCTVData');
	async function loadCCTVTable(schoolId){
		const response = await fetch(`/api/School/CCTVEquipment/${schoolId}`);
		const res = await response.json();
		if(!response.ok){
			alert('Loading Failed');
			return;
		}
		cctvContainer.innerHTML = renderLoadingOnTable()
		const data = res.data;
		await renderCCTVInfo(data);
	}
	function renderCCTVInfo(cctv_info){
		//reset the container to remove the Loading
		cctvContainer.innerHTML = '';
		// console.table(cctv_info);
		cctv_info.forEach((cctv,index) => {
			const cctvType = cctv_info[index]?.cctv_type;
			const equipmentDetails = cctv_info[index]?.equipment_details;
			
			//Render the Content
			cctvContainer.innerHTML += 
			`
			<div class=" border border-gray-400 p-6  my-4 ">
				<div
					class="cursor-pointer  flex flex-col justify-center text-center 
					cursor-pointer text-center relative
					"
					onclick="toggleCollapse('cctv-container-${index + 1}',${index + 1})">

					<div class="grid w-full  grid-cols-2 gap-0">
						<div class="text-base text-left   font-medium tracking-wider  ">
							${index + 1}.
						</div>

						<div class="flex  justify-end ">

							<button class="btn-green w-auto px-2 rounded py-0 font-normal text-base hover:bg-green-600">
								&#8369; ${formatNumber(equipmentDetails?.total_amount,2)}
							</button>
						</div>
					</div>

					<div class="scale-100 hover:scale-103 transition mb-2">

						<div class="text-center  whitespace-nowrap">
							Tap to Open/CLose
						</div>

						<div class="md:text-2xl text-md font-bold underline uppercase">
							${cctvType?.name}

						</div>

						<div class="md:text-base text-sm">
							${formatDate(equipmentDetails?.date_installed)}
						</div>
					</div>
				</div>

				<div class="flex gap-1 items-center justify-center py-2 button-container">

					<div class="action-button">

						<button class="btn-update p-1 rounded-full"
							onclick="renderEditCCTVModal(${ equipmentDetails?.pk_equipment_details_id },
							${ equipmentDetails?.brand_model?.pk_equipment_brand_model_id },
							${ cctv?.no_of_units },${cctvType?.pk_e_cctv_camera_type_id },
							${ equipmentDetails?.powersource?.pk_equipment_power_source_id },
							${ equipmentDetails?.location?.pk_equipment_location_id },
								${ equipmentDetails?.total_amount },
								${ equipmentDetails?.installer?.pk_equipment_installer_id },
								${ cctv?.no_of_functional }, ${ equipmentDetails?.incharge?.pk_equipment_incharge_id },
								'${ equipmentDetails?.date_installed }')">
							@include('SchoolSide.components.svg.edit-sm')

						</button>
					</div>
					<div class="action-button">

						<button class="text-white bg-red-600 hover:bg-red-700 p-1 rounded-full"
							onclick="deleteFunction(${ cctv?.pk_e_cctv_details_id }, 'cctv')">
							@include('SchoolSide.components.svg.delete-sm')

						</button>
					</div>
					<div class="action-button">
						<button id="toggle-button-${index+1}" class="btn-gray p-1 rounded-full"
							onclick="toggleCollapse('cctv-container-${index+1}', ${index+1})">
							@include('SchoolSide.components.svg.dashboard-sm')
						</button>
					</div>
				</div>

				<div class="hidden thin-scroll overflow-x-auto" id="cctv-container-${index+1}">
					<table class="w-full border-collapse  ">
						<tbody>

							<tr>
								<td colspan="6" class="top-header">

									<div class="flex justify-between">
										<div>
											CCTV No. ${index + 1}
										</div>
										<div>
											&#8369; ${formatNumber(equipmentDetails?.total_amount,2)}
										</div>
									</div>
								</td>

							</tr>
							<tr>
								<td class="sub-header">
									Brand / Model
								</td>
								<td class="td-cell">
									${equipmentDetails?.brand_model?.name ?? '' }
								</td>

								<td class="sub-header">
									Camera Type
								</td>
								<td class="td-cell">
									${cctvType?.name ?? '' }
								</td>

								<td class="sub-header">
									Date Installed
								</td>
								<td class="td-cell">
									${formatDate(equipmentDetails?.date_installed)}
								</td>
							</tr>

							<tr>
								<td class="sub-header">
									No. of Cameras
								</td>
								<td class="td-cell">
									${ cctv?.no_of_units ?? '' }
								</td>

								<td class="sub-header">
									Functional Cameras
								</td>
								<td class="td-cell">
									${ cctv?.no_of_functional ?? '' }/${ cctv?.no_of_units ?? '' }
								</td>

								<td class="sub-header">
									Power Source
								</td>
								<td class="td-cell">
									${equipmentDetails?.powersource?.name ?? '' }
								</td>
							</tr>

							<tr>
								<td class="sub-header">
									Location
								</td>
								<td class="td-cell">
									${equipmentDetails?.location?.name ?? '' }
								</td>

								<td class="sub-header">
									Installer
								</td>
								<td class="td-cell">
									${equipmentDetails?.installer?.name ?? '' }
								</td>

								<td class="sub-header">
									Person In-Charge
								</td>
								<td class="td-cell">
									${equipmentDetails?.incharge?.name ?? '' }
								</td>
							</tr>

						</tbody>
					</table>
				</div>

			</div>
			`;
		});
		//Make a reusable method that displays no record found
		if(!cctv_info.length > 0){
			cctvContainer.innerHTML = `
				<div class=" flex items-center py-5 justify-center">
					<div class="bg-gray-50/80 w-full backdrop-blur-md border border-gray-300 rounded-xl shadow-md px-8 py-6 text-center">
						<h2 class="text-gray-700 font-semibold sm:text-lg text-base">
							No Record Found
						</h2>
						<p class="text-gray-500 sm:text-sm text-xs mt-1">
							There is currently nothing to display.
						</p>
					</div>
				</div>
			`;
		}
		 
	}
	//Default call the function
	document.addEventListener('DOMContentLoaded',loadCCTVTable(school_id));
</script>