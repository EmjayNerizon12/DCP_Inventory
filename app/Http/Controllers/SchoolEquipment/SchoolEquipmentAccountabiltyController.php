<?php

namespace App\Http\Controllers\SchoolEquipment;

use App\Http\Controllers\Controller;
use App\Models\SchoolEquipment\SchoolEquipmentAccountabilty;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SchoolEquipmentAccountabiltyController extends Controller
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
                'transaction_type_id' => 'required|integer',
                'school_equipment_id' => 'required|integer',
                'accountable_employee_id' => 'required|integer',
                'date_assigned_to_accountable_employee' => 'required|date',
                'custodian'  => 'required|integer',
                'custodian_received_date' => 'required|date',
                'end_user' => 'required|integer',
                'end_user_received_date' => 'required|date',
            ]);
            $school_equipment_accountability = SchoolEquipmentAccountabilty::create($validated);
            if ($school_equipment_accountability) {
                return response()->json(['success' => true, 'message' => 'School Equipment Accountability created successfully', 'data' => $school_equipment_accountability], 201);
            }
        } catch (ValidationException $e) {
            return response()->json(['success' => false, 'message' => 'Validation failed', 'errors' => $e->errors()], 422);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $school_equipment_accountability = SchoolEquipmentAccountabilty::with([
            'accountableEmployee',
            'schoolEquipment',
            'transactionType',
            'equipmentEndUser',
            'equipmentCustodian',

        ])->where('school_equipment_id', $id)->first();

        return response()->json(['success' => true, 'data' => $school_equipment_accountability]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SchoolEquipmentAccountabilty $schoolEquipmentAccountabilty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'transaction_type_id' => 'required|integer',
                'school_equipment_id' => 'required|integer',
                'accountable_employee_id' => 'required|integer',
                'date_assigned_to_accountable_employee' => 'required|date',
                'custodian' => 'required|integer',
                'custodian_received_date' => 'required|date',
                'end_user' => 'required|integer',
                'end_user_received_date' => 'required|date',
            ]);

            // Find the main record by ID
            $schoolEquipmentAccountability = SchoolEquipmentAccountabilty::findOrFail($id);


            // Update associated end user
            $schoolEquipmentAccountability->update($validated);
            return response()->json(['success' => true, 'message' => 'School Equipment Accountability updated successfully.', 'data' => $schoolEquipmentAccountability]);
        } catch (ValidationException $e) {
            return response()->json(['success' => false, 'message' => 'Validation failed', 'errors' => $e->errors()], 422);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SchoolEquipmentAccountabilty $schoolEquipmentAccountabilty)
    {
        //
    }
}
