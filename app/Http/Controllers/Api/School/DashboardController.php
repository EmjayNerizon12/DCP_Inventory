<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Models\DCPBatch;
use App\Models\DCPBatchItem;
use App\Models\DCPCurrentCondition;
use App\Models\DCPItemCondition;
use App\Models\DCPItemTypes;
use App\Models\DCPPackageTypes;
use App\Models\Equipment\EquipmentBiometricDetails;
use App\Models\Equipment\EquipmentCCTVDetails;
use App\Models\ISP\ISPDetails;
use App\Models\SchoolData;
use App\Models\SchoolEmployee;
use App\Models\SchoolEquipment\SchoolEquipment;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getDashboardDCPInformation(Request $request, $school_id)
    {


        $batches = DCPBatch::where('school_id', $school_id)->get();

        $items = collect();
        $packages = collect();

        foreach ($batches as $batch) {
            $batch_items = DCPBatchItem::where('dcp_batch_id', $batch->pk_dcp_batches_id)->get();
            $items = $items->merge($batch_items);

            // Merge the single ID as array to prevent weird merges
            $packages = $packages->merge([$batch->dcp_package_type_id]);
        }

        // Count how many times each package ID appears
        $packageCounts = $packages->countBy(); // key = package ID, value = count

        // Get unique package IDs for querying names
        $uniquePackageIds = $packages->unique()->values();

        // Get package names keyed by ID
        $packageNames = DCPPackageTypes::whereIn('pk_dcp_package_types_id', $uniquePackageIds)
            ->pluck('name', 'pk_dcp_package_types_id');  // key by ID for easy lookup

        // Now you can combine names + counts
        $packagesWithCounts = collect();

        foreach ($packageCounts as $packageId => $count) {
            $name = $packageNames[$packageId] ?? 'Unknown';
            $packagesWithCounts->push([
                'id' => $packageId,
                'name' => $name,
                'count' => $count,
            ]);
        }

        $totalGood = 0;
        $totalDamaged = 0;
        $totalForRepair = 0;
        $nostatus = 0;
        $totalForDisposal = 0;
        $totalForMissing = 0;
        foreach ($items as $batch_items) {
            $current_condition =  DCPItemCondition::where(
                'dcp_batch_item_id',
                $batch_items->pk_dcp_batch_items_id,
            )->value('current_condition_id');
            if ($current_condition == 1) {
                $totalGood++;
            } elseif ($current_condition == 2) {
                $totalForRepair++;
            } elseif ($current_condition == 4) {
                $totalDamaged++;
            } elseif ($current_condition == 5) {
                $totalForDisposal++;
            } elseif ($current_condition == 7) {
                $totalForMissing++;
            } else {
                $nostatus++;
            }
        }


        $totalBatches = $batches->count();
        $totalItems = $items->count();


        $schoolData = SchoolData::where('pk_school_id', $school_id)->get();
        $totalLearners = 0;
        $totalClassrooms = 0;
        $totalTeachers = 0;
        $totalSections = 0;


        foreach ($schoolData as $data) {
            $totalLearners = $totalLearners + $data->RegisteredLearners;
            $totalClassrooms = $totalClassrooms + $data->Classrooms;
            $totalTeachers = $totalTeachers + $data->Teachers;
            $totalSections = $totalSections + $data->Sections;
        }
        $item_names_collect = collect();
        foreach ($batches as $batch) {

            $item_types = DCPBatchItem::where('dcp_batch_id', $batch->pk_dcp_batches_id)->pluck('item_type_id');
            foreach ($item_types as $types) {
                $item_names = DCPItemTypes::where('pk_dcp_item_types_id', $types)->value('name');
                $item_names_collect->push([
                    'items' => $item_names
                ]);
            }
        }
        $item_sorted =   $item_names_collect->groupBy('items')->map->count()->sortDesc();
        $total_under_warranty = 0;
        $total_out_of_warranty = 0;
        foreach ($batches as $batch) {
            $batch_items = DCPBatchItem::where('dcp_batch_id', $batch->pk_dcp_batches_id)->get();

            foreach ($batch_items as $item) {
                // check if item is under warranty
                $warranty = $item->dcpItemWarranties;

                if ($warranty && now()->between($warranty->warranty_start_date, $warranty->warranty_end_date)) {
                    $total_under_warranty++;
                } else {
                    $total_out_of_warranty++;
                }
            }
        }
        $data = [
            'totalLearners' => $totalLearners,
            'item_sorted' => $item_sorted,
            'totalClassrooms' => $totalClassrooms,
            'totalTeachers' => $totalTeachers,
            'totalSections' => $totalSections,
            'packagesWithCounts' => $packagesWithCounts,
            // 'schoolData' => $schoolData,
            'totalItems' => $totalItems,
            'totalGood' => $totalGood,
            'totalForRepair' => $totalForRepair,
            'totalDamaged' => $totalDamaged,
            'totalForDisposal' => $totalForDisposal,
            'totalForMissing' => $totalForMissing,
            'nostatus' => $nostatus,
            'totalBatches' => $totalBatches,
            'totalItems' => $items->count(),
            'total_out_of_warranty' => $total_out_of_warranty,
            'total_under_warranty' => $total_under_warranty
        ];
        return response()->json(['success' => true, 'data' => $data], 200);
    }
    public function getItemConditionCounts(Request $request, int $school_id)
    {

        // Get all DCP batches for this school
        $batches = DCPBatch::where('school_id', $school_id)->get();

        // Collect all batch items
        $items = collect();
        foreach ($batches as $batch) {
            $batch_items = DCPBatchItem::where('dcp_batch_id', $batch->pk_dcp_batches_id)->get();
            $items = $items->merge($batch_items);
        }

        // Initialize counter
        $conditionCounts = [];

        // Loop through items and get their condition names
        foreach ($items as $item) {
            $condition_id = DCPItemCondition::where('dcp_batch_item_id', $item->pk_dcp_batch_items_id)
                ->value('current_condition_id');

            if ($condition_id) {
                $condition_name = DCPCurrentCondition::where('pk_dcp_current_conditions_id', $condition_id)
                    ->value('name');

                if ($condition_name) {
                    if (!isset($conditionCounts[$condition_name])) {
                        $conditionCounts[$condition_name] = 0;
                    }
                    $conditionCounts[$condition_name]++;
                }
            }
        }

        return response()->json($conditionCounts);
    }
    public function getDashboardInfomation(Request $request, int $school_id)
    {

        //SCHOOL EMPLOYEE COUNT
        $school_employee_count = SchoolEmployee::where('school_id', $school_id)->count();
        $internet_count = ISPDetails::where('school_id', $school_id)->count();
        $biometric_count = EquipmentBiometricDetails::where('school_id', $school_id)->count();
        $cctv_count = EquipmentCCTVDetails::where('school_id', $school_id)->count();

        $other_equipment = SchoolEquipment::where('school_id', $school_id)->count();
        $data = [
            'school_employee_count' => $school_employee_count,
            'internet_count' => $internet_count,
            'biometric_count' => $biometric_count,
            'cctv_count' => $cctv_count,
            'other_equipment' => $other_equipment,
        ];
        return response()->json(['success' => true, 'data' => $data], 200);
    }
    /**
     * Display a listing of the resource.
     */
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
