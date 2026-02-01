<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Models\DCPBatch;
use App\Models\DCPBatchItem;
use App\Models\DCPItemCondition;
use App\Models\SchoolUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, int $schoolId, $condition_id = null)
    {

        // 🔹 Fetch all batches for the school
        $batches = DCPBatch::where('school_id', $schoolId)->pluck('pk_dcp_batches_id');

        // 🔹 Fetch all batch items for those batches
        $batchItems = DCPBatchItem::whereIn('dcp_batch_id', $batches)->pluck('pk_dcp_batch_items_id');

        // 🔹 Base query for item conditions
        $query = DCPItemCondition::whereIn('dcp_batch_item_id', $batchItems);

        // If a specific condition id is requested
        if ($condition_id !== null) {
            $query->with([
                'dcpBatchItem',
                'dcpBatchItem.dcpItemType',
                'dcpBatchItem.dcpBatch',
                'dcpCurrentCondition'
            ])->where('current_condition_id', $condition_id);
        }

        // 🔹 Get the full item conditions (for listing)
        $items_result = $query->with([
            'dcpBatchItem',
            'dcpBatchItem.dcpItemType',
            'dcpBatchItem.dcpBatch',
            'dcpCurrentCondition'
        ])->get();
        // 🔹 Get totals per condition (for summary)
        $totals = DCPItemCondition::whereIn('dcp_batch_item_id', $batchItems)
            ->with(['dcpCurrentCondition'])
            ->select('current_condition_id', DB::raw('COUNT(*) as total'))
            ->groupBy('current_condition_id')
            ->get();
        $data = [
            'condition_id' => $condition_id,
            'items' => $items_result,
            'totals' => $totals
        ];
        return response()->json(['success' => true, 'data' => $data], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
