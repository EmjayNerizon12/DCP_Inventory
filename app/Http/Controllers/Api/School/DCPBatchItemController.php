<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Models\DCPBatch;
use App\Models\DCPBatchItem;
use App\Models\DCPBatchItemBrand;
use App\Models\DCPCurrentCondition;
use App\Models\DCPItemBrand;
use Illuminate\Http\Request;

class DCPBatchItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function fetchItems($batchId)
    {
        $items = DCPBatchItem::where('dcp_batch_id', $batchId)
            ->with(['dcpItemType', 'dcpItemCurrentCondition.dcpCurrentCondition', 'brand_details'])
            ->paginate(10);
        $dcpCurrentCondition = DCPCurrentCondition::all();
        $dcpItemBrand = DCPBatchItemBrand::all();
        return response()->json(['success' => true, 'data' => $items, 'dcpCurrentCondition' => $dcpCurrentCondition, 'dcpItemBrand' => $dcpItemBrand], 200);
    }
    public function searchProductFromStatus(int $batchId, $searchTerm = null)
    {

        if (empty($searchTerm)) {
            $items = DCPBatchItem::where('dcp_batch_id', $batchId)->with(['dcpItemWarranties.status', 'dcpAssignedUsers', 'dcpItemCurrentCondition.dcpCurrentCondition', 'dcpItemType'])->get();
            return response()->json(['success' => true, 'data' =>  $items], 200);
        }
        $items = DCPBatchItem::where('dcp_batch_id', $batchId)
            ->where(function ($query) use ($searchTerm) {
                $query->where('generated_code', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('serial_number', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('brand', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhereHas('dcpItemType', function ($q) use ($searchTerm) {
                        $q->where('name', 'LIKE', '%' . $searchTerm . '%');
                    });
            })
            ->with(['dcpItemWarranties.status', 'dcpAssignedUsers', 'dcpItemCurrentCondition.dcpCurrentCondition', 'dcpItemType'])

            ->paginate(10);
        return response()->json(['success' => true, 'data' => $items], 200);
    }
    public function index()
    {
        //
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
    public function show(string $batchId)
    {
        $items = DCPBatchItem::where('dcp_batch_id', $batchId)
            ->with(['dcpItemType', 'dcpItemCurrentCondition.dcpCurrentCondition', 'brand_details', 'schoolEquipment'])
            ->get();
        return response()->json(['success' => true, 'data' => $items], 200);
    }
    public function showItems(int $itemId)
    {
        $item = DCPBatchItem::where('pk_dcp_batch_items_id', $itemId)
            ->with(['dcpItemType', 'dcpItemCurrentCondition.dcpCurrentCondition', 'brand_details', 'dcpBatch'])
            ->first();
        return response()->json(['success' => true, 'data' => $item], 200);
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
