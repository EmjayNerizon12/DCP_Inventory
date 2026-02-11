<?php

namespace App\Http\Controllers;

use App\Models\DCPBatch;
use App\Models\DCPBatchItem;
use App\Models\DCPItemCondition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SchoolItemConditionController extends Controller
{
    public function index(int $id)
    {
        $schoolId = Auth::guard('school')->user()->pk_school_id;

        // 🔹 Fetch all batches for the school
        $batches = DCPBatch::where('school_id', $schoolId)->pluck('pk_dcp_batches_id');

        // 🔹 Fetch all batch items for those batches
        $batchItems = DCPBatchItem::whereIn('dcp_batch_id', $batches)->pluck('pk_dcp_batch_items_id');

        // 🔹 Base query for item conditions
        $query = DCPItemCondition::whereIn('dcp_batch_item_id', $batchItems);

        // If a specific condition id is requested
        if ($id !== 0) {
            $query->where('current_condition_id', $id);
        }

        // 🔹 Get the full item conditions (for listing)
        $items_result = $query->get();

        // 🔹 Get totals per condition (for summary)
        $totals = DCPItemCondition::whereIn('dcp_batch_item_id', $batchItems)
            ->select('current_condition_id', DB::raw('COUNT(*) as total'))
            ->groupBy('current_condition_id')
            ->get();

        return view('SchoolSide.ItemsCondition', compact('items_result', 'id', 'totals'));
    }

    public function  comboSearch(Request $request)
    {
        return redirect()->route('schools.item.condition', ['id' => $request->condition_id]);
    }
}
