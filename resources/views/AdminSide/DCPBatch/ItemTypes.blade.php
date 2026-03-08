@extends('layout.Admin-Side')
<title>@yield('title', 'DCP Dashboard')</title>

@section('content')
	<style>
		button {
			letter-spacing: 0.05rem;
			font-weight: 500 !important;
		}
	</style>
	@include('AdminSide.DCPBatch.ItemType._addModal')
	@include('AdminSide.DCPBatch.ItemType._updateModal')
	<div class="p-2" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
		<div class="flex md:flex-row flex-col justify-between items-center mb-4">
			<div class="w-full">
				<div class=" flex justify-start gap-2 items-center ">

					<div class="h-10 w-10 bg-white p-3 border border-gray-300 shadow-lg rounded-md flex items-center justify-center">
						<div class="text-white bg-blue-600 p-1 rounded-md">
							<svg viewBox="0 0 24 24" class="w-8 h-8" fill="none" xmlns="http://www.w3.org/2000/svg">
								<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
								<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
								<g id="SVGRepo_iconCarrier">
									<path
										d="M4 15.8294V15.75V8C4 7.69114 4.16659 7.40629 4.43579 7.25487L4.45131 7.24614L11.6182 3.21475L11.6727 3.18411C11.8759 3.06979 12.1241 3.06979 12.3273 3.18411L19.6105 7.28092C19.8511 7.41625 20 7.67083 20 7.94687V8V15.75V15.8294C20 16.1119 19.8506 16.3733 19.6073 16.5167L12.379 20.7766C12.1451 20.9144 11.8549 20.9144 11.621 20.7766L4.39267 16.5167C4.14935 16.3733 4 16.1119 4 15.8294Z"
										stroke="currentColor" stroke-width="2"></path>
									<path d="M12 21V12" stroke="currentColor" stroke-width="2"></path>
									<path d="M12 12L4 7.5" stroke="currentColor" stroke-width="2"></path>
									<path d="M20 7.5L12 12" stroke="currentColor" stroke-width="2"></path>
								</g>
							</svg>
						</div>
					</div>
					<div class="w-full" style="letter-spacing: 0.05rem flex flex-col items-center">
						<h2 class="page-title">Product List</h2>
						<p class="page-subtitle">Create, Edit, and Delete Item Types</p>
					</div>
				</div>

			</div>

		</div>

		<!-- Search -->
		<div class="my-2 sm:px-2 px-0 w-full flex justify-between sm:flex-row flex-col gap-2">
			<div>
				<button class="btn-submit px-4 py-1 rounded" onclick="openAddItemTypeModal()" type="button">
					Add Product
				</button>
			</div>
			<div class="flex w-full sm:max-w-sm items-stretch">

				<!-- Icon -->
				<div class="bg-blue-600 flex items-center px-3 rounded-l h-10">
					 @include('svg.search-sm')
				</div>

				<!-- Input -->
				<input type="text" id="searchItemType"
					class="form-input" />
			</div>

		</div>

		<!-- Card Grid -->
		<div id="itemTypeCardGrid"
			class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-2 p-2">
		</div>
	</div>
	@include('AdminSide.DCPBatch.ItemType._script')
@endsection
