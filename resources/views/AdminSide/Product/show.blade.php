@extends('layout.Admin-Side')
<title>@yield('title', 'DCP Inventory')</title>

@section('content')
	<div class="p-2">
		<div class="flex justify-start gap-2 items-center mb-2">
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
			<div class="w-full">
				<div class="page-title">DCP Product</div>
				<div class="page-subtitle">Product Information</div>
			</div>
		</div>

		<table class="table border-collapse bg-white w-full ">
			<thead>
				<tr class="top-header">
					<th class="p-1" colspan="2">Product Search</th>
				</tr>
				<tr class="sub-header">
					<th class="p-1 ">Product Description</th>
					<th class="p-1"> </th>
				</tr>
			</thead>
			<tbody>

				<tr>
					<td class="border p-2 secondary-header">Product Code</td>
					<td class="border p-2">{{ $items['generated_code'] }}</td>
				</tr>
				<tr>
					<td class="border p-2 secondary-header">Product Name</td>
					<td class="border p-2">{{ $items->dcpItemType->name ?? ' ' }}</td>
				</tr>
				<tr>
					<td class="border p-2 secondary-header">Product Price</td>
					<td class="border p-2">₱{{ number_format($items->unit_price, 2) }}</td>
				</tr>
				<tr>
					<td class="border p-2 secondary-header">Product Brand</td>
					<td class="border p-2">{{ $items->brand_details->name ?? ' ' }}</td>
				</tr>
				<tr>
					<td class="border p-2 secondary-header">Product Current Condition</td>
					<td class="border p-2">{{ $items->dcpItemCurrentCondition->dcpCurrentCondition->name ?? ' ' }}</td>
				</tr>
				<tr>
					<td class="border p-2 secondary-header">Serial Number</td>
					<td class="border p-2">{{ $items->serial_number ?? ' ' }}</td>
				</tr>
				<tr>
					<td class="border p-2 secondary-header">Batch</td>
					<td class="border p-2">{{ $items->dcpBatch->batch_label ?? ' ' }}</td>
				</tr>
				<tr>
					<td class="border p-2 secondary-header">School Recipient</td>
					<td class="border p-2">{{ $items->dcpBatch->school->SchoolName ?? ' ' }}</td>
				</tr>
				<tr>
					<td class="border p-2 secondary-header">School Level Recipient </td>
					<td class="border p-2">{{ $items->dcpBatch->school->SchoolLevel ?? ' ' }}</td>
				</tr>
				<tr>
					<td class="border p-2 secondary-header">Assigned User </td>
					<td class="border p-2">{{ $items->dcpAssignedUsers->assigned_user_name ?? ' ' }}</td>
				</tr>
				<tr>
					<td class="border p-2 secondary-header">Assigned Type </td>
					<td class="border p-2">{{ $items->dcpAssignedUsers->dcpAssignedType->name ?? ' ' }}</td>
				</tr>
				<tr>
					<td class="border p-2 secondary-header">Assigned Location </td>
					<td class="border p-2">{{ $items->dcpBatchItemLocation->dcpAssignedLocation->name ?? ' ' }}</td>
				</tr>
				<tr>
					<td class="border p-2 secondary-header">IAR File </td>
					<td class="border p-2">
						@if ($items->iar_file == null)
						@else
							<a href="{{ asset('certificates/iar/' . $items->iar_file) }}" target="_blank"
								class="text-blue-600 underline hover:text-blue-800">
								{{ $items->iar_file ?? ' ' }}
							</a>
						@endif
					</td>
				</tr>
				<tr>
					<td class="border p-2 secondary-header">ITR File </td>
					<td class="border p-2">
						@if ($items->itr_file == null)
						@else
							<a href="{{ asset('certificates/itr/' . $items->itr_file) }}" target="_blank"
								class="text-blue-600 underline hover:text-blue-800">
								{{ $items->itr_file ?? ' ' }}
							</a>
						@endif
					</td>
				</tr>
				<tr>
					<td class="border p-2 secondary-header">Certificate of Completion </td>
					<td class="border p-2">
						@if ($items->certificate_of_completion == null)
						@else
							<a href="{{ asset('certificates/certificate-completion/' . $items->certificate_of_completion) }}" target="_blank"
								class="text-blue-600 underline hover:text-blue-800">
								{{ $items->certificate_of_completion ?? ' ' }}
							</a>
						@endif
					</td>
				</tr>
				<tr>
					<td class="border p-2 secondary-header">Training Acceptance File </td>
					<td class="border p-2">
						@if ($items->training_acceptance_file == null)
						@else
							<a href="{{ asset('certificates/training-acceptance/' . $items->training_acceptance_file) }}" target="_blank"
								class="text-blue-600 underline hover:text-blue-800">
								{{ $items->training_acceptance_file ?? ' ' }}
							</a>
						@endif
					</td>
				</tr>
				<tr>
					<td class="border p-2 secondary-header">Delivery Receipt File </td>
					<td class="border p-2">
						@if ($items->delivery_receipt_file == null)
						@else
							<a href="{{ asset('certificates/delivery-receipt/' . $items->delivery_receipt_file) }}" target="_blank"
								class="text-blue-600 underline hover:text-blue-800">
								{{ $items->delivery_receipt_file ?? ' ' }}
							</a>
						@endif
					</td>
				</tr>

			</tbody>
		</table>
	</div>
@endsection
