<div id="renderBiometricData"></div>

<script>
	//Render the Biometric INFORMATION
	const biometricContainer = document.getElementById('renderBiometricData');
	async function loadBiometricTable(schoolId){
		const response = await fetch(`/api/School/biometricEquipment/${schoolId}`);
		const res = await response.json();
		if(!response.ok){
			alert('Loading Failed');
			return;
		}
		biometricContainer.innerHTML = renderLoadingOnTable();
		const data = res.data;
		await renderBiometricInfo(data);
	}
	function renderBiometricInfo(biometric_data){
		//reset the container to remove the Loading
		biometricContainer.innerHTML = '';
		// console.table(biometricContainer);
		biometric_data.forEach((biometric,index) => {
			const biometricType = biometric_data[index]?.biometric_type;
			const equipmentDetails = biometric_data[index]?.equipment_details;
			//Render the Content
			biometricContainer.innerHTML += 
			`
			<div class="border border-gray-400 p-5 my-4 ">
				<div
					class="cursor-pointer  flex flex-col justify-center text-center 
					cursor-pointer text-center relative
					"
					onclick="toggleCollapse('biometric-container-${index + 1}',${index + 1})">

					<div class="grid w-full hidden  grid-cols-2 gap-0">
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

						<div class="sm:text-2xl text-base font-bold uppercase">
						${index + 1}. ${biometricType?.name} 
						</div>
						<div class="sm:text-xl text-sm font-medium">
							${equipmentDetails?.brand_model?.name} (&#8369; ${formatNumber(equipmentDetails?.total_amount,2)})
						</div>
						<div class="sm:text-base text-sm">
							${formatDate(equipmentDetails?.date_installed)}
						</div>
						 <div class="sm:text-base text-xs flex items-center justify-center gap-2 my-1">
							<span class="px-2 py-0.5 font-semibold rounded-full border border-green-700 bg-green-100 text-green-700">
							Functional: ${ biometric?.no_of_functional ?? '' }/${ biometric?.no_of_units ?? '' }
							</span>
						</div>

					</div>
				</div>

				<div class="flex gap-1 items-center justify-center button-container">

					<div class="action-button">

						<button class="btn-update p-1 rounded-full"
							onclick="renderEditBiometricModal(${ equipmentDetails?.pk_equipment_details_id },
							${ equipmentDetails?.brand_model?.pk_equipment_brand_model_id },
							${ biometric?.no_of_units },${biometricType?.pk_e_biometric_type_id },
							${ equipmentDetails?.powersource?.pk_equipment_power_source_id },
							${ equipmentDetails?.location?.pk_equipment_location_id },
								${ equipmentDetails?.total_amount },
								${ equipmentDetails?.installer?.pk_equipment_installer_id },
								${ biometric?.no_of_functional }, ${ equipmentDetails?.incharge?.pk_equipment_incharge_id },
								'${ equipmentDetails?.date_installed }')">
							@include('SchoolSide.components.svg.edit-sm')

						</button>
					</div>
					<div class="action-button">

						<button class="text-white bg-red-600 hover:bg-red-700 p-1 rounded-full"
							onclick="deleteFunction(${ biometric?.pk_e_biometric_details_id }, 'biometric')">
							@include('SchoolSide.components.svg.delete-sm')

						</button>
					</div>
					<div class="action-button">
						<button id="toggle-button-${index+1}" class="btn-gray p-1 rounded-full"
							onclick="toggleCollapse('biometric-container-${index+1}', ${index+1})">
							@include('SchoolSide.components.svg.dashboard-sm')
						</button>
					</div>
				</div>

				<div class="mt-2 hidden thin-scroll overflow-x-auto" id="biometric-container-${index+1}">
					<table class="w-full border-collapse  ">
						<tbody>

							<tr>
								<td colspan="6" class="top-header">

									<div class="flex justify-between">
										<div>
											biometric No. ${index + 1}
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
									Authentication Type
								</td>
								<td class="td-cell">
									${biometricType?.name ?? '' }
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
									${ biometric?.no_of_units ?? '' }
								</td>

								<td class="sub-header">
									Functional Cameras
								</td>
								<td class="td-cell">
									${ biometric?.no_of_functional ?? '' }/${ biometric?.no_of_units ?? '' }
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
		if(!biometric_data.length > 0){
			biometricContainer.innerHTML = `
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
	document.addEventListener('DOMContentLoaded',loadBiometricTable(school_id));
</script>