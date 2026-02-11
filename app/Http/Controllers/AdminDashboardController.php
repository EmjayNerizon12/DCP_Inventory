<?php

namespace App\Http\Controllers;

use App\Models\DCPBatch;
use App\Models\DCPBatchItem;
use App\Models\DCPItemCondition;
use App\Models\Equipment\EquipmentBiometricDetails;
use App\Models\Equipment\EquipmentBiometricType;
use App\Models\Equipment\EquipmentCCTVDetails;
use App\Models\Equipment\EquipmentDetails;
use App\Models\ISP\ISPDetails;
use App\Models\School;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{

    public function get_current_condition_of_item()
    {

        $conditions = DCPItemCondition::all()->groupBy('current_condition_id');

        $conditions =   $conditions->map(function ($group) {
            return [
                'id' => $group->first()->current_condition_id,
                'condition' => $group->first()->dcpCurrentCondition?->name,
                'count' => $group->count(),
            ];
        })->values()->toArray();
        return response()->json($conditions);
    }
    public function showItemCondition($id)
    {
        if ($id != 0) {
            $condition = DCPItemCondition::where('current_condition_id', $id)
                ->with('dcpCurrentCondition')
                ->with('dcpBatchItem.dcpItemType')
                ->with('dcpBatchItem.dcpBatch')
                ->with('dcpBatchItem.dcpBatch.school')
                ->get();
        } else {

            $condition = DCPItemCondition::with([
                'dcpCurrentCondition',
                'dcpBatchItem.dcpItemType',
                'dcpBatchItem.dcpBatch',
                'dcpBatchItem.dcpBatch.school'
            ])
                ->get();
        }
        $condition = $condition->map(function ($item) {
            return [
                'condition_id' => $item->current_condition_id,
                'dcp_batch_item_id' => $item->dcpBatchItem->pk_dcp_batch_items_id,
                'batch_label' => $item->dcpBatchItem->dcpBatch->batch_label,
                'item_type' => $item->dcpBatchItem->dcpItemType->name,
                'school_name' => $item->dcpBatchItem->dcpBatch->school->SchoolName,
                'generated_code' => $item->dcpBatchItem->generated_code,
                'condition' => $item->dcpCurrentCondition->name,
                'updated_at' => $item->updated_at->format('F d, Y h:i A'),
            ];
        })->values()->toArray();

        return view('AdminSide.ItemConditions.show', compact('condition'));
    }
    public  function itemReport($id)
    {
        $batch_item = DCPBatchItem::where('pk_dcp_batch_items_id', $id)
            ->with('dcpItemType')
            ->with('dcpBatch.school')
            ->with('dcpItemCurrentCondition.dcpCurrentCondition')
            ->first();
        return response()->json($batch_item);
    }
    public function school_with_isp()
    {

        $cctv_count = EquipmentCCTVDetails::where('school_id', '!=', null)
            ->distinct('school_id')
            ->count('school_id');
        $biometric_count = EquipmentBiometricDetails::where('school_id', '!=', null)
            ->distinct('school_id')
            ->count('school_id');


        $isp_count = ISPDetails::where('school_id', '!=', null)
            ->distinct('school_id')
            ->count('school_id');
        $total_schools = School::all()->count();
        return response()->json(['cctv_count' => $cctv_count, 'biometric_count' => $biometric_count, 'isp_count' => $isp_count, 'total_schools' => $total_schools]);
    }
    public function get_item_categories()
    {
        $counts = DCPBatchItem::select('item_type_id')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('item_type_id')
            ->with('dcpItemType')
            ->get();

        return response()->json($counts);
    }
    public function get_package_categories()
    {
        $counts = DCPBatch::select('dcp_package_type_id')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('dcp_package_type_id')
            ->with('dcpPackageType')
            ->orderBy('total', 'desc')
            ->get();
        return response()->json($counts);
    }
    public function get_schools_dcp_count()
    {
        $count = DCPBatch::select('school_id')
            ->selectRaw("COUNT(*) as total")
            ->groupBy('school_id')
            ->with('school')
            ->orderBy('total', 'desc')
            ->get();

        return response()->json($count);
    }
}
