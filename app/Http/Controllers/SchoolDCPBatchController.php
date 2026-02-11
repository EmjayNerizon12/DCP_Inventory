<?php

namespace App\Http\Controllers;

use App\Models\DCPBatch;
use App\Models\DCPBatchApproval;
use App\Models\DCPBatchItem;
use App\Models\DCPBatchItemBrand;
use App\Models\DCPCurrentCondition;
use App\Models\DCPDeliveryCondintion;
use App\Models\DCPItemAssignedLocation;
use App\Models\DCPItemAssignedUser;
use App\Models\DCPItemBrand;
use App\Models\DCPItemCondition;
use App\Models\DCPItemTypes;
use App\Models\School;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class SchoolDCPBatchController extends Controller
{
    public function batch_item_list()
    {
        $batches = DB::table('dcp_batches')
            ->join('dcp_batch_items', 'dcp_batches.pk_dcp_batches_id', '=', 'dcp_batch_items.dcp_batch_id')
            ->select('dcp_batches.batch_label', 'dcp_batch_items.*')
            ->where('dcp_batches.school_id', Auth::guard('school')->user()->school->pk_school_id)
            ->get()
            ->groupBy('batch_label');

        // dd($batches);
        return view('SchoolSide.DCPBatch.BatchItemFolder', compact('batches'));
    }
    public function updateBatchStatus(Request $request, $batchId)
    {

        $school = Auth::guard('school')->user()->school;
        $validated = $request->validate([
            'iar_ref_code' => 'nullable|string|max:100',
            'iar_value' => 'nullable|string|max:100',
            'iar_date' => 'nullable|date',
            'iar_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'itr_ref_code' => 'nullable|string|max:100',
            'itr_value' => 'nullable|string|max:100',
            'itr_date' => 'nullable|date',
            'itr_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'certificate_of_completion' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'coc_status' => 'nullable|string|max:50',
            'training_acceptance_status' => 'nullable|string|max:50',
            'training_acceptance_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'delivery_receipt_status' => 'nullable|string|max:50',
            'delivery_receipt_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'invoice_receipt_status' => 'nullable|string|max:50',
            'invoice_receipt_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);
        if ($request->iar_value == 'yes') {
            $validated['iar_value'] = 'with IAR';
        } else {
            $validated['iar_value'] = 'without IAR';
        }


        if ($request->itr_value == 'yes') {
            $validated['itr_value'] = 'with ITR';
        } else {
            $validated['itr_value'] = 'without ITR';
        }

        if ($request->hasFile('certificate_of_completion')) {
            $file = $request->file('certificate_of_completion');
            $filename = date('d-m-Y') . '-' . $school->SchoolID . '-' . $file->getClientOriginalName();
            $destination = base_path('certificates/certificate-completion');
            $file->move($destination, $filename);
            $validated['certificate_of_completion'] =  $filename;
        }

        if ($request->hasFile('training_acceptance_file')) {
            $file = $request->file('training_acceptance_file');
            $filename = date('d-m-Y') . '-' . $school->SchoolID . '-' . $file->getClientOriginalName();
            $destination = base_path('certificates/training-acceptance');
            $file->move($destination, $filename);
            $validated['training_acceptance_file'] =  $filename;
        }

        if ($request->hasFile('delivery_receipt_file')) {
            $file = $request->file('delivery_receipt_file');
            $filename = date('d-m-Y') . '-' . $school->SchoolID . '-' . $file->getClientOriginalName();
            $destination = base_path('certificates/delivery-receipt');
            $file->move($destination, $filename);
            $validated['delivery_receipt_file'] =  $filename;
        }

        if ($request->hasFile('invoice_receipt_file')) {
            $file = $request->file('invoice_receipt_file');
            $filename = date('d-m-Y') . '-' . $school->SchoolID . '-' . $file->getClientOriginalName();
            $destination = base_path('certificates/invoice-receipt');
            $file->move($destination, $filename);
            $validated['invoice_receipt_file'] =  $filename;
        }
        if ($request->hasFile('itr_file')) {
            $file = $request->file('itr_file');
            $filename = date('d-m-Y') . '-' . $school->SchoolID . '-' . $file->getClientOriginalName();
            $destination = base_path('certificates/itr');
            $file->move($destination, $filename);
            $validated['itr_file'] =  $filename;
        }
        if ($request->hasFile('iar_file')) {
            $file = $request->file('iar_file');
            $filename = date('d-m-Y') . '-' . $school->SchoolID . '-' . $file->getClientOriginalName();
            $destination = base_path('certificates/iar');
            $file->move($destination, $filename);
            $validated['iar_file'] =  $filename;
        }

        $batchItems = DCPBatchItem::where('dcp_batch_id', $batchId)->get();

        foreach ($batchItems as $item) {
            $item->update([
                'iar_ref_code' => $validated['iar_ref_code'] ?? null,
                'iar_value' => $validated['iar_value'] ?? null,
                'iar_date' => $validated['iar_date'] ?? null,
                'iar_file' => $validated['iar_file'] ?? null,

                'itr_ref_code' => $validated['itr_ref_code'] ?? null,
                'itr_value' => $validated['itr_value'] ?? null,
                'itr_date' => $validated['itr_date'] ?? null,
                'itr_file' => $validated['itr_file'] ?? null,

                'coc_status' => $validated['coc_status'] ?? null,
                'certificate_of_completion' => $validated['certificate_of_completion'] ?? null,

                'training_acceptance_status' => $validated['training_acceptance_status'] ?? null,
                'training_acceptance_file' => $validated['training_acceptance_file'] ?? null,

                'delivery_receipt_status' => $validated['delivery_receipt_status'] ?? null,
                'delivery_receipt_file' => $validated['delivery_receipt_file'] ?? null,

                'invoice_receipt_status' => $validated['invoice_receipt_status'] ?? null,
                'invoice_receipt_file' => $validated['invoice_receipt_file'] ?? null,
            ]);
        }



        return redirect()->back()->with('success', 'Batch Information submitted successfully.');
    }
    public function editUpdateBatchStatus(Request $request, $batchId)
    {
        $school = Auth::guard('school')->user()->school;
        $validated = $request->validate([
            'status' => 'string|required',
            'type' => 'string|required',
            'file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'code_of_file' => 'string|nullable',
            'date_of_file' => 'date|nullable',
        ]);
        $item_remove = DCPBatchItem::where('dcp_batch_id', $batchId)->first();
        if ($validated['type'] == "delivery-receipt") {
            $oldFile = $item_remove->delivery_receipt_file;
            if ($oldFile) {
                $oldPath = base_path('certificates/delivery-receipt/' . $oldFile);

                if (file_exists($oldPath)) {
                    unlink($oldPath); // delete the old file
                }
            }
        }
        if ($validated['type'] == "certificate-completion") {
            $oldFile = $item_remove->certificate_of_completion;
            if ($oldFile) {
                $oldPath = base_path('certificates/certificate-completion/' . $oldFile);

                if (file_exists($oldPath)) {
                    unlink($oldPath); // delete the old file
                }
            }
        }
        if ($validated['type'] == "invoice-receipt") {
            $oldFile = $item_remove->invoice_receipt_file;
            if ($oldFile) {
                $oldPath = base_path('certificates/invoice-receipt/' . $oldFile);

                if (file_exists($oldPath)) {
                    unlink($oldPath); // delete the old file
                }
            }
        }
        if ($validated['type'] == "training-acceptance") {
            $oldFile = $item_remove->training_acceptance_file;
            if ($oldFile) {
                $oldPath = base_path('certificates/training-acceptance/' . $oldFile);

                if (file_exists($oldPath)) {
                    unlink($oldPath); // delete the old file
                }
            }
        }
        if ($validated['type'] == "itr") {
            $oldFile = $item_remove->itr_file;
            if ($oldFile) {
                $oldPath = base_path('certificates/itr/' . $oldFile);

                if (file_exists($oldPath)) {
                    unlink($oldPath); // delete the old file
                }
            }
        }
        if ($validated['type'] == "iar") {
            $oldFile = $item_remove->iar_file;
            if ($oldFile) {
                $oldPath = base_path('certificates/iar/' . $oldFile);

                if (file_exists($oldPath)) {
                    unlink($oldPath); // delete the old file
                }
            }
        }
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = date('d-m-Y') . '-' . $school->SchoolID . '-' . $file->getClientOriginalName();
            $destination = base_path('certificates/' . $validated['type']);
            $file->move($destination, $filename);
            $validated['file'] =  $filename;
        }

        $batchItems = DCPBatchItem::where('dcp_batch_id', $batchId)->get();

        foreach ($batchItems as $item) {
            if ($validated['type'] == 'delivery-receipt') {
                if ($request->hasFile('file')) {

                    $item->update([
                        'delivery_receipt_status' => $validated['status'] ?? null,
                        'delivery_receipt_file' => $validated['file'] ?? null,

                    ]);
                } else {
                    $item->update([
                        'delivery_receipt_status' => $validated['status'] ?? null,
                    ]);
                }
            } else if ($validated['type'] == 'certificate-completion') {
                if ($request->hasFile('file')) {

                    $item->update([
                        'coc_status' => $validated['status'] ?? null,
                        'certificate_of_completion' => $validated['file'] ?? null,

                    ]);
                } else {
                    $item->update([
                        'coc_status' => $validated['status'] ?? null,

                    ]);
                }
            } else if ($validated['type'] == 'invoice-receipt') {
                if ($request->hasFile('file')) {
                    $item->update([
                        'invoice_receipt_status' => $validated['status'] ?? null,
                        'invoice_receipt_file' => $validated['file'] ?? null,

                    ]);
                } else {
                    if ($request->hasFile('file')) {
                        $item->update([
                            'invoice_receipt_status' => $validated['status'] ?? null,

                        ]);
                    }
                }
            } else if ($validated['type'] == 'training-acceptance') {
                if ($request->hasFile('file')) {
                    $item->update([
                        'training_acceptance_status' => $validated['status'] ?? null,
                        'training_acceptance_file' => $validated['file'] ?? null,

                    ]);
                } else {
                    $item->update([
                        'training_acceptance_status' => $validated['status'] ?? null,
                    ]);
                }
            } else if ($validated['type'] == 'iar') {
                if ($validated['status'] == "yes") {
                    $validated['status'] = "with IAR";
                } else {
                    $validated['status'] = "without IAR";
                }
                if ($request->hasFile('file')) {

                    $item->update([
                        'iar_value' => $validated['status'] ?? null,
                        'iar_file' => $validated['file'] ?? null,
                        'iar_ref_code' => $validated['code_of_file'] ?? null,
                        'iar_date' => $validated['date_of_file'] ?? null,

                    ]);
                } else {
                    $item->update([
                        'iar_value' => $validated['status'] ?? null,
                        'iar_ref_code' => $validated['code_of_file'] ?? null,
                        'iar_date' => $validated['date_of_file'] ?? null,

                    ]);
                }
            } else if ($validated['type'] == 'itr') {
                if ($validated['status'] == "yes") {
                    $validated['status'] = "with ITR";
                } else {
                    $validated['status'] = "without ITR";
                }
                if ($request->hasFile('file')) {
                    $item->update([
                        'itr_value' => $validated['status'] ?? null,
                        'itr_file' => $validated['file'] ?? null,
                        'itr_ref_code' => $validated['code_of_file'] ?? null,
                        'itr_date' => $validated['date_of_file'] ?? null,

                    ]);
                } else {
                    $item->update([
                        'itr_value' => $validated['status'] ?? null,
                        'itr_ref_code' => $validated['code_of_file'] ?? null,
                        'itr_date' => $validated['date_of_file'] ?? null,

                    ]);
                }
            }
        }
        return redirect()->back()->with('success', 'Batch Information submitted successfully.');
    }
    public function index()
    {

        $school = Auth::guard('school')->user()->school;
        $batch =  DCPBatch::where('school_id', $school->pk_school_id) // Only batches for this school
            ->orderBy('dcp_batches.delivery_date', 'desc')
            ->get();

        return view('SchoolSide.DCPBatch.Batch', compact('batch'));
    }

    public function items($batchId)
    {
        $batch = DCPBatch::findOrFail($batchId);
        $school_id = Auth::guard('school')->user()->school->pk_school_id;
        $itemTypes = DCPItemTypes::all();
        $items = DCPBatchItem::where('dcp_batch_id', $batchId)->get();
        $conditions = DCPCurrentCondition::all();
        $batchStatus = DCPBatchItem::where('dcp_batch_id', $batchId)->first();
        $batch_approved = DCPBatchApproval::where('dcp_batches_id', $batchId)->first();
        $batchName = $batch->batch_label;
        $brand_list = DCPBatchItemBrand::all();

        return view('SchoolSide.DCPBatch.Items', compact('batchId', 'brand_list', 'batchName', 'batch', 'items', 'itemTypes', 'conditions', 'batchId', 'batchStatus', 'batch_approved'));
    }

    public function batch_status($batchId)
    {
        $batchStatus = DCPBatchItem::where('dcp_batch_id', $batchId)->first();
        return view('SchoolSide.DCPBatch.BatchStatus', compact('batchStatus', 'batchId'));
    }
    public function warranty($item_id)
    {
        $batchItem = DCPBatchItem::findOrFail($item_id);

        $warranty = $batchItem->dcpItemWarranties->first();

        // dd($warranties);
        return view('SchoolSide.DCPBatch.Warranty', compact('batchItem', 'warranty'));
    }

    public function itemStatus($batchId)
    {
        $batch = DCPBatch::findOrFail($batchId);
        // dd($batch); 
        $itemTypes = DCPItemTypes::all();
        $items = DCPBatchItem::where('dcp_batch_id', $batchId)->with(['dcpItemWarranties.status', 'dcpAssignedUsers', 'dcpItemCurrentCondition.dcpCurrentCondition', 'dcpItemType'])->get();
        $conditions = DCPDeliveryCondintion::all();
        $batchStatus = DCPBatchItem::where('dcp_batch_id', $batchId)->first();
        $batch_approved = DCPBatchItem::where('dcp_batch_id', $batchId)->value('date_approved');
        $batchName = $batch->batch_label;
        $batchDeliveryDate = $batch->delivery_date;


        return view('SchoolSide.DCPBatch.Status', compact('batchDeliveryDate',  'batchName', 'batch', 'items', 'itemTypes', 'conditions', 'batchId', 'batchStatus', 'batch_approved'));
    }


    public function assigned_for_items(Request $request)
    {
        $request->validate([
            'pk_dcp_batch_items_id' => 'required|integer',
            'assigned_user_type_id' => 'required|integer',
            'assigned_user_name' => 'required|string|max:255',
            'assigned_user_location_id' => 'nullable|integer',
        ]);

        $item = DCPBatchItem::findOrFail($request->pk_dcp_batch_items_id);
        $batch_delivery_date = $item->dcpBatch->delivery_date;

        // Update or create assigned user
        $assignedUser = DCPItemAssignedUser::where('dcp_batch_item_id', $item->pk_dcp_batch_items_id)->first();

        if ($assignedUser) {
            $assignedUser->update([
                'assignment_type_id' => $request->assigned_user_type_id,
                'assigned_user_name' => $request->assigned_user_name,
                'date_assigned' => $batch_delivery_date,
            ]);
        } else {
            $item->dcpAssignedUsers()->create([
                'assignment_type_id' => $request->assigned_user_type_id,
                'assigned_user_name' => $request->assigned_user_name,
                'date_assigned' => $batch_delivery_date,
            ]);
        }

        // Update or create assigned location
        $assignedLocation = DCPItemAssignedLocation::where('dcp_batch_item_id', $item->pk_dcp_batch_items_id)->first();

        if ($assignedLocation) {
            $assignedLocation->update([
                'assigned_location_id' => $request->assigned_user_location_id,
            ]);
        } else {
            $item->dcpBatchItemLocation()->create([
                'assigned_location_id' => $request->assigned_user_location_id,
            ]);
        }

        return redirect()->back()->with('success', 'Item assignment updated successfully.');
    }



    public function showItems($code)
    {
        $item =   DCPBatchItem::where('generated_code', $code)->first();


        $user_type = $item->dcpAssignedUsers->dcpAssignedType->name ?? 'N/A';
        $user_name = $item->dcpAssignedUsers->assigned_user_name ?? 'N/A';
        $item_location = $item->dcpBatchItemLocation->dcpAssignedLocation->name ?? 'N/A';
        $user_date_assigned = $item->dcpAssignedUsers->date_assigned ?? 'N/A';
        return view('SchoolSide.DCPInventory.ShowItems', compact('item', 'user_name', 'item_location', 'user_type', 'user_date_assigned'));
    }
    public function updateItem(Request $request, $itemId)
    {

        try {
            $item = DCPBatchItem::findOrFail($itemId);

            $validated = $request->validate([
                'unit' => 'nullable|string|max:50',
                'quantity' => 'nullable|integer',
                'brand' => 'nullable|string|max:100',
                'serial_number' => [
                    'nullable',
                    'string',
                    'max:100',
                    Rule::unique('dcp_batch_items', 'serial_number')->ignore($itemId, 'pk_dcp_batch_items_id'),
                ],
                'date_approved' => 'nullable|date',

            ]);


            $getCondition = DCPItemCondition::where('dcp_batch_item_id', $itemId)->first();
            // return response()->json($getCondition);
            if ($getCondition) {
                $getCondition->update([
                    'current_condition_id' => $request->current_condition_id,
                ]);
            } else {
                DCPItemCondition::create([
                    'dcp_batch_item_id' => $itemId,
                    'current_condition_id' => $request->current_condition_id,
                ]);
            }
            $item =  $item->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Item updated successfully!',
                'data' => $item
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'This serial number is already assigned to another item.',
                'errors' => $e->errors(), // will include 'serial_number' => ['The serial number has already been taken.']
            ], 422);
        } catch (QueryException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Database error: ' . $e->getMessage(),
            ], 500);
        }
    }
    public function insertCondition(Request $request)
    {
        $validated = $request->validate([
            'dcp_batch_item_id' => 'required',
            'current_condition_id' => 'required|Integer'
        ]);
        $results =  DCPItemCondition::create($validated);
        return response()->json($results);
    }
}
