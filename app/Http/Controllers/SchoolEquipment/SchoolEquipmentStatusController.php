<?php

namespace App\Http\Controllers\SchoolEquipment;

use App\Http\Controllers\Controller;
use App\Models\SchoolEquipment\SchoolEquipmentStatus;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SchoolEquipmentStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'school_equipment_id' => 'required|integer',
                'equipment_condition_id' => 'required|integer',
                'disposition_status_id' => 'required|integer',
                'start_warranty_date' => 'nullable|string|max:500',
                'end_warranty_date' => 'nullable|string|max:500',
                'equipment_location' => 'nullable|string|max:500',
                'non_functional' => 'required|integer|in:0,1',
            ]);

            SchoolEquipmentStatus::create($validated);
            return response()->json([
                'success' => true,
                'message' => 'School equipment status saved successfully.'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while saving the school equipment status.',
                'error' => $e->getMessage()
            ], 500);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = SchoolEquipmentStatus::with(['equipmentCondition', 'dispositionStatus'])->where('school_equipment_id', $id)->first();

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SchoolEquipmentStatus $schoolEquipmentStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validated = $request->validate([
                'school_equipment_id' => 'required|integer',
                'equipment_condition_id' => 'required|integer',
                'disposition_status_id' => 'required|integer',
                'start_warranty_date' => 'nullable|string|max:500',
                'end_warranty_date' => 'nullable|string|max:500',
                'equipment_location' => 'nullable|string|max:500',
                'non_functional' => 'required|integer|in:0,1',
            ]);

            $schoolEquipmentStatus = SchoolEquipmentStatus::findOrFail($id);
            $schoolEquipmentStatus->update($validated);
            return response()->json([
                'success' => true,
                'message' => 'School equipment status updated successfully.'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the school equipment status.',
                'error' => $e->getMessage()
            ], 500);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SchoolEquipmentStatus $schoolEquipmentStatus)
    {
        //
    }
}
