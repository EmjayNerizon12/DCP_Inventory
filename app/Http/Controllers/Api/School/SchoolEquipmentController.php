<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Models\SchoolEquipment\SchoolEquipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchoolEquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(int $school_id)
    {
        try {
            $school_equipments = SchoolEquipment::with([
                'allotmentClass',
                'sourceOfFund',
                'sourceOfAcquisition',
                'modeOfAcquisition',
                'classification',
                'category',
                'dcpBatch.dcpPackageType',
                'manufacturer',
                'unitOfMeasure',
                'dcpBatchItem.dcpItemType',
                'nonDCPItem',
                'equipmentStatuses.dispositionStatus',
                'equipmentStatuses.equipmentCondition',
                'equipmentDocument.documentType',
                'equipmentAccountability.accountableEmployee',
                'equipmentAccountability.transactionType',
                'equipmentAccountability.equipmentCustodian',
                'equipmentAccountability.equipmentEndUser',

            ])
                ->where('school_id', $school_id)->get();
            return response()->json([
                'success' => true,
                'data' => $school_equipments
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve school equipment data',
                'error' => $e->getMessage()
            ], 500);
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
