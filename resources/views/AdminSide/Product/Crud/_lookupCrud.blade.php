<div class="bg-white border border-gray-200 rounded-lg shadow-sm p-4">
	<div class="flex items-center justify-between mb-3">
		<div class="text-xl flex gap-2 font-bold text-gray-700">{{ $title }} <span><x-badge color="blue">
					{{ count($items) }} </x-badge></span> </div>
	</div>

	<form action="{{ route('admin.crud.store') }}" method="POST" class="flex gap-2 mb-4">
		@csrf
		<input type="hidden" name="type" value="{{ $type }}">
		<input type="text" name="name" class="form-input" placeholder="Add {{ $title }}" required>
		<button type="submit" class="btn-submit p-1 rounded plus-icon"></button>
	</form>

	<div class="overflow-auto thin-scroll max-h-[220px]">
		<table class="min-w-full text-sm">
			<thead>
				<tr class="border-b">
					<th class="text-left px-2 py-2">Name</th>
				</tr>
			</thead>
			<tbody>
				@forelse ($items as $item)
					<tr class="border-b align-top">
						<td class="px-2 py-2">
							<div class="flex flex-row gap-1 w-full items-center">
								<form action="{{ route('admin.crud.update') }}" method="POST" class="flex gap-2 flex-1">
									@csrf
									@method('PUT')
									<input type="hidden" name="type" value="{{ $type }}">
									<input type="hidden" name="id" value="{{ $item->id }}">
									<input type="text" name="name" value="{{ $item->name }}" class="flex-1 form-input" required>
									<button type="submit" class="btn-green p-1 rounded h-fit"><span class="refresh-icon"></span></button>
								</form>
								<form action="{{ route('admin.crud.delete', ['id' => $item->id, 'type' => $type]) }}" method="POST"
									onsubmit="return confirm('Delete this item?');">
									@csrf
									@method('DELETE')
									<button type="submit" class="btn-delete p-1 rounded text-white"><span class="delete-icon"></span></button>
								</form>
							</div>
						</td>
					</tr>
				@empty
					<tr>
						<td class="px-2 py-3 text-gray-500" colspan="2">No records yet.</td>
					</tr>
				@endforelse
			</tbody>
		</table>
	</div>
</div>
