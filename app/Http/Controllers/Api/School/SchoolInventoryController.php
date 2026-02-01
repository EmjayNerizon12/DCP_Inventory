<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Models\DCPBatch;
use App\Models\DCPBatchItem;
use App\Models\SchoolUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Tymon\JWTAuth\Facades\JWTAuth;

class SchoolInventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index() {}
    public function searchBatchItems(Request $request, int $schoolId)
    {


        try {
            // Parse JWT token and get authenticated user

            $search = $request->input('query');
            $user = SchoolUser::where('pk_school_id', $schoolId)->first();

            $results = DB::table('dcp_batch_items')
                ->leftJoin('dcp_item_types', 'dcp_batch_items.item_type_id', '=', 'dcp_item_types.pk_dcp_item_types_id')
                ->leftJoin('dcp_batches', 'dcp_batch_items.dcp_batch_id', '=', 'dcp_batches.pk_dcp_batches_id')
                ->leftJoin('dcp_batch_item_brands', 'dcp_batch_items.brand', '=', 'dcp_batch_item_brands.pk_dcp_batch_item_brands_id')
                ->select(
                    'dcp_batch_items.pk_dcp_batch_items_id',
                    'dcp_batch_items.generated_code',
                    'dcp_batches.batch_label',
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
                ->where('dcp_batches.school_id', $schoolId) // filter by authenticated user's school
                ->orderBy('dcp_batches.created_at', 'desc')
                ->get();
            $results = DCPBatchItem::with([
                'dcpItemType',
                'dcpBatch',
                'dcpBatch.school',
                'brand_details'
            ])
                // 👉 relationship filter
                ->whereHas('dcpBatch', function ($q) use ($user) {
                    $q->where('school_id', $user->school->pk_school_id);
                })
                ->where(function ($query) use ($search) {

                    $query->where('generated_code', 'like', "%$search%")
                        ->orWhereHas('dcpBatch', function ($q) use ($search) {
                            $q->where('batch_label', 'like', "%$search%");
                        })

                        ->orWhereHas('brand_details', function ($q) use ($search) {
                            $q->where('brand_name', 'like', "%$search%");
                        })

                        ->orWhereHas('dcpItemType', function ($q) use ($search) {
                            $q->where('name', 'like', "%$search%");
                        });
                })->get()->map(function ($item) {
                    return [
                        'pk_dcp_batch_items_id' => $item->pk_dcp_batch_items_id,
                        'generated_code' => $item->generated_code,

                        'batch_label'    => $item->dcpBatch->batch_label ?? null,

                        'brand_name'     => $item->brand_details->brand_name ?? null,

                        'item_type'      => $item->dcpItemType->name ?? null,
                        'created_at'     => $item->created_at
                    ];
                });


            return response()->json($results, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
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
