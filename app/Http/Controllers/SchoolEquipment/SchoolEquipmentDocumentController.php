<?php

namespace App\Http\Controllers\SchoolEquipment;

use App\Http\Controllers\Controller;
use App\Models\SchoolEquipment\SchoolEquipmentDocument;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SchoolEquipmentDocumentController extends Controller
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
                'school_equipment_id' => 'required|exists:school_equipment,id',
                'document_type_id' => 'required|integer|exists:school_equipment_document_types,id|unique:school_equipment_documents,document_type_id,NULL,id,school_equipment_id,' . $request->school_equipment_id,
                'document_number' => 'required|string|max:255',
            ]);
            $document = SchoolEquipmentDocument::create($validated);
            return response()->json([
                'success' => true,
                'message' => 'School Equipment Document saved successfully',
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An Error Occured',
                'errors' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SchoolEquipmentDocument $schoolEquipmentDocument)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SchoolEquipmentDocument $schoolEquipmentDocument)
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
                'document_type_id' => 'required|integer|exists:school_equipment_document_types,id|unique:school_equipment_documents,document_type_id,NULL,id,school_equipment_id,' . $request->school_equipment_id,
                'document_number' => 'required|string|max:255',
            ]);
            $document = SchoolEquipmentDocument::findOrFail($id);
            $document->update($validated);
            return response()->json([
                'success' => true,
                'message' => 'School Equipment Document saved successfully',
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An Error Occured',
                'errors' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        try {
            $document = SchoolEquipmentDocument::findOrFail($id);
            $remove_document = $document->delete();
            return response()->json([
                'success' => true,
                'message' => 'School Equipment Document removed successfully',
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An Error Occured',
                'errors' => $e->getMessage(),
            ], 500);
        }
    }
}
