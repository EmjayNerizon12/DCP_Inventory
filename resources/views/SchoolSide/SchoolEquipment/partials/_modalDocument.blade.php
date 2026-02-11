<x-modal id="modal-equipment-document" size="medium-modal" type="add" icon="report_w_8">
	<div class="space-y-2">
		<div class="flex flex-col items-center justify-center gap-0">
			<div class="text-center">
				<div class="page-title">School Equipment Document</div>
				<div class="page-subtitle">List of Supporting Documentss</div>
			</div>
		</div>
		<div id="addButtonContainer"></div>
		<div class="thin-scroll overflow-x-auto shadow-md">
			<table class="w-full">
				<thead>
					<tr>
						<td class="td-cell w-fit text-center">
							No.
						</td>
						<td class="td-cell">
							Document
						</td>
						<td class="td-cell whitespace-nowrap">
							Document No.
						</td>
						<td class="td-cell w-fit text-center">
							Action
						</td>
				</thead>
				<tbody id="documentTable" class="thin-scroll overflow-x-auto">

				</tbody>
			</table>
		</div>
	</div>
</x-modal>
{{-- Using javacsript form js/School/SchoolEquipment/_getDocument.js  --}}
