@extends('layout.Admin-Side')
<title>@yield('title', 'DCP Dashboard')</title>

@section('content')
	<style>
		button {
			letter-spacing: 0.05rem;
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
		}
	</style>

	@php
		$brands = \App\Models\DCPBatchItemBrand::all();
	@endphp

	@include('AdminSide.DCPBatch.Package._addProductToPackageModal')
	@include('AdminSide.DCPBatch.Package._addPackageModal')
	@include('AdminSide.DCPBatch.Package._editModal')

	<div class="p-2">
		<div class="flex justify-between md:flex-row flex-col mb-6">
			<div class="w-full" style="letter-spacing: 0.05rem">
				<div class="flex justify-start gap-2 items-center">
					<div class="h-10 w-10 bg-white p-3 border border-gray-300 shadow-lg rounded-md flex items-center justify-center">
						<div class="text-white bg-blue-600 p-1 rounded-md">
							<svg viewBox="0 0 24 24" class="w-8 h-8" fill="none" xmlns="http://www.w3.org/2000/svg">
								<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
								<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
								<g id="SVGRepo_iconCarrier">
									<path d="M4 15.8294V15.75V8C4 7.69114 4.16659 7.40629 4.43579 7.25487L4.45131 7.24614L11.6182 3.21475L11.6727 3.18411C11.8759 3.06979 12.1241 3.06979 12.3273 3.18411L19.6105 7.28092C19.8511 7.41625 20 7.67083 20 7.94687V8V15.75V15.8294C20 16.1119 19.8506 16.3733 19.6073 16.5167L12.379 20.7766C12.1451 20.9144 11.8549 20.9144 11.621 20.7766L4.39267 16.5167C4.14935 16.3733 4 16.1119 4 15.8294Z" stroke="currentColor" stroke-width="2"></path>
									<path d="M12 21V12" stroke="currentColor" stroke-width="2"></path>
									<path d="M12 12L4 7.5" stroke="currentColor" stroke-width="2"></path>
									<path d="M20 7.5L12 12" stroke="currentColor" stroke-width="2"></path>
								</g>
							</svg>
						</div>
					</div>
					<div class="w-full" style="letter-spacing: 0.05rem flex flex-col items-center">
						<div class="page-title">DCP Package List</div>
						<div class="page-subtitle">List of Package Type with Item Content</div>
					</div>
				</div>
			</div>
			<div class="w-full flex md:justify-end items-center justify-start my-2">
				<button type="button" onclick="openCreatePackageModal()" class="btn-submit px-4 py-1 rounded">
					Add Package
				</button>
			</div>
		</div>

		<div id="package-list-loading" class="text-center text-gray-500 py-8">Loading packages...</div>
		<div id="package-list-empty" class="text-center text-gray-500 py-8 hidden">No packages found.</div>
		<div id="package-list" class="grid grid-cols-1 gap-2"></div>
	</div>

	<div id="item-type-options" class="hidden">
		@foreach ($itemTypes as $itemType)
			<option value="{{ $itemType->pk_dcp_item_types_id }}">{{ $itemType->name }}</option>
		@endforeach
	</div>

	@include('AdminSide.DCPBatch.Package._script')
@endsection

