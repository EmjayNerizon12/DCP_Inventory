<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Models\Equipment\EquipmentBiometricDetails;
use Illuminate\Http\Request;

class BiometricController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(int $schoolId)
    {
         $biometrics_data = EquipmentBiometricDetails::where('school_id', $schoolId)
        ->with([
            'equipment_details.equipmentType', 
            'equipment_details.incharge',
            'equipment_details.installer',
            'equipment_details.location',
            'equipment_details.powersource',
            'equipment_details.brand_model',
            'biometric_type',
        ])
        ->get();
        return response()->json([
            'success' => true,
            'data' => $biometrics_data
        ],200);
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
