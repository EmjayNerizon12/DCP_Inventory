@extends('layout.SchoolSideLayout')

<title>@yield('title', 'DCP Dashboard')</title>
@vite(['resources/js/app.js'])
@section('content')
	<style>
		select option:disabled {
			color: red;
			/* Change text color to red */
			background-color: #f2dede;
			/* Optional: Change background to a light red (for better visibility) */
		}

		.selected-option {
			color: green;
			/* Change text color to green */
			background-color: #d4edda;
			/* Light green background */
		}

		.updated-badge {
			position: absolute;
			top: 0;
			right: 0;
			background-color: #4caf50;
			/* Green background for "Updated" */
			color: white;
			/* Text color */
			font-size: 12px;
			/* Font size for the badge */
			padding: 2px 8px;
			border-radius: 50%;
			/* Rounded badge */
			font-weight: bold;
			display: none;
			/* Initially hidden */
		}

		/* If you want to show the badge, add a class like .show-updated */
		.show-updated .updated-badge {
			display: inline-block;
			/* Show the badge */
		}

		@keyframes spin {
			0% {
				transform: rotate(0deg);
			}

			100% {
				transform: rotate(360deg);
			}
		}
	</style>
	<input type="hidden" id="school_id" value="{{ Auth::guard('school')->user()->school->pk_school_id }}">
	@include('SchoolSide.SchoolEquipment.partials._modalEquipment')
	@include('SchoolSide.components.print')
	@include('SchoolSide.SchoolEquipment.partials._modalDocument')
	@include('SchoolSide.SchoolEquipment.partials._addModalDocument')
	@include('SchoolSide.SchoolEquipment.partials._editModalDocument')
	<div class="flex flex-col gap-5 overflow-hidden bg-white p-2 md:p-6">
		<div class="flex justify-start space-x-4">
			<div
				class="flex hidden h-16 w-16 items-center justify-center rounded-full border border-gray-300 bg-white p-3 shadow-lg">
				<div class="rounded-full bg-blue-600 p-2 text-white">
					<svg fill="currentColor" class="h-10 w-10" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
						xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 390 390" xml:space="preserve">
						<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
						<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
						<g id="SVGRepo_iconCarrier">
							<g>
								<path
									d="M383.408,84.898H132.23v31.332h231.238v166.805H132.23v41.225h42.014l-29.597,28.516c-0.978,0.942-1.53,2.242-1.53,3.601 v6.396c0,2.761,2.238,5,5,5h151.375c2.762,0,5-2.239,5-5v-6.396c0-1.358-0.553-2.658-1.531-3.601l-29.597-28.516h110.044 c3.64,0,6.592-2.951,6.592-6.596V91.49C390,87.85,387.048,84.898,383.408,84.898z M223.803,297.552 c4.008,0,7.254,3.247,7.254,7.254c0,4.006-3.246,7.254-7.254,7.254c-4.003,0-7.25-3.248-7.25-7.254 C216.553,300.799,219.8,297.552,223.803,297.552z">
								</path>
								<path
									d="M101.607,22.228H8.076C3.615,22.228,0,25.843,0,30.304v329.059c0,4.461,3.615,8.076,8.076,8.076h93.531 c4.461,0,8.076-3.615,8.076-8.076V30.304C109.684,25.843,106.068,22.228,101.607,22.228z M46.168,63.251 c0-0.705,0.571-1.277,1.277-1.277H62.24c0.705,0,1.277,0.572,1.277,1.277v127.422c0,0.706-0.572,1.278-1.277,1.278H47.445 c-0.706,0-1.277-0.572-1.277-1.278V63.251z M62.439,257.647c0,4.195-3.4,7.598-7.598,7.598c-4.196,0-7.598-3.402-7.598-7.598 c0-4.196,3.401-7.598,7.598-7.598C59.039,250.049,62.439,253.45,62.439,257.647z M54.842,318.288 c-9.877,0-17.885-8.007-17.885-17.885c0-9.877,8.008-17.885,17.885-17.885c9.877,0,17.885,8.008,17.885,17.885 C72.727,310.281,64.719,318.288,54.842,318.288z">
								</path>
							</g>
						</g>
					</svg>
				</div>
			</div>
			<div>
				<div class="page-title">School Equipment </div>
				<div class="page-subtitle">Properties and Information</div>

			</div>

		</div>
		<div class="flex items-center justify-between">

			<button title="Show Info Modal" type="button" onclick="openComponentModal('add-equipment-modal')"
				class="btn-submit rounded px-4 py-1">
				Add Equipment
			</button>
			<div class="flex h-12 w-12 hidden items-center justify-center rounded-full border border-gray-300 bg-white p-1 shadow-md">

				<button class="btn-cancel rounded-full p-1" onclick="window.print()">
					<svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
						<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
						</g>
						<g id="SVGRepo_iconCarrier">
							<path fill-rule="evenodd" clip-rule="evenodd"
								d="M17 7H7V6h10v1zm0 12H7v-6h10v6zm2-12V3H5v4H1v8.996C1 17.103 1.897 18 3.004 18H5v3h14v-3h1.996A2.004 2.004 0 0 0 23 15.996V7h-4z"
								fill="currentColor"></path>
						</g>
					</svg>
				</button>
			</div>

		</div>

		<div id="fullPrintable">
			@include('SchoolSide.components.print-header')
			@include('SchoolSide.SchoolEquipment.partials._tableEquipments')
		</div>
		@include('SchoolSide.components.print')
		@include('SchoolSide.SchoolEquipment.partials._modalAccountability')
		@include('SchoolSide.SchoolEquipment.partials._modalStatus')

	</div>
	@include('SchoolSide.SchoolEquipment.partials._scriptPrint')
@endsection
