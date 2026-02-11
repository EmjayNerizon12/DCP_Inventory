<?php

namespace App\Http\Controllers;

use App\Models\DCPBatchItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class SchoolInventoryController extends Controller
{
    public function searchBatchItems(Request $request)
    {

        try {
            $search = $request->input('query');

            $results = DB::table('dcp_batch_items')
                ->leftJoin('dcp_item_types', 'dcp_batch_items.item_type_id', '=', 'dcp_item_types.pk_dcp_item_types_id')
                ->leftJoin('dcp_batches', 'dcp_batch_items.dcp_batch_id', '=', 'dcp_batches.pk_dcp_batches_id')
                ->leftJoin('dcp_batch_item_brands', 'dcp_batch_items.brand', '=', 'dcp_batch_item_brands.pk_dcp_batch_item_brands_id')
                ->select(
                    'dcp_batch_items.pk_dcp_batch_items_id',
                    'dcp_batch_items.generated_code',
                    'dcp_batches.batch_label', // ✅ select from joined table
                    'dcp_batch_items.brand',
                    'dcp_batch_items.created_at',
                    'dcp_batch_item_brands.brand_name as the_brand',
                    'dcp_item_types.name as item_name'
                )
                ->where(function ($query) use ($search) {
                    $query->where('dcp_batch_items.generated_code', 'like', "%$search%")
                        ->orWhere('dcp_batches.batch_label', 'like', "%$search%")
                        ->orWhere('dcp_batch_items.brand', 'like', "%$search%")
                        ->orWhere('dcp_item_types.name', 'like', "%$search%");
                })
                ->where('dcp_batches.school_id', Auth::guard('school')->user()->school->pk_school_id) // ✅ filter by school_id
                ->orderBy('dcp_batches.created_at', 'desc')
                ->get();


            return response()->json($results);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
