<?php

namespace App\Http\Controllers\SchoolEquipment;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\SchoolEquipment\SchoolEquipment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SchoolEquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $school_equipments = SchoolEquipment::with(['allotmentClass', 'sourceOfFund', 'sourceOfAcquisition', 'modeOfAcquisition', 'classification', 'category', 'dcpBatch', 'manufacturer', 'unitOfMeasure', 'equipmentItem'])->where('school_id', Auth::guard('school')->user()->pk_school_id)->get();

        return view('SchoolSide.SchoolEquipment.index', compact('school_equipments'));
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
                'property_number'            => 'required|string|max:100|unique:school_equipment,property_number',
                'old_property_number'        => 'nullable|string|max:100',
                'serial_number'              => 'required|string|max:100',

                'unit_of_measure_id'         => 'required|exists:school_equipment_unit_of_measures,id',
                'manufacturer_id'            => 'nullable|exists:school_equipment_manufacturers,id',

                'model'                      => 'nullable|string|max:255',
                'specifications'             => 'nullable|string|max:255',
                'supplier_or_distributor'    => 'nullable|string|max:255',

                'category_id'                => 'nullable|exists:school_equipment_categories,id',
                'classification_id'          => 'nullable|exists:school_equipment_classifications,id',

                'non_dcp'                    => 'required|boolean',
                'dcp_batch_id'               => 'nullable|exists:dcp_batches,pk_dcp_batches_id',
                'dcp_batch_item_id'          => 'nullable|exists:dcp_batch_items,pk_dcp_batch_items_id',
                'non_dcp_item_id'            => 'nullable|exists:non_dcp_item,pk_non_dcp_item_id',

                'pmp_reference_no'           => 'nullable|string|max:255|unique:school_equipment,pmp_reference_no',
                'gl_sl_code'                 => 'nullable|string|max:255|unique:school_equipment,gl_sl_code',
                'uacs_code'                  => 'nullable|string|max:255|unique:school_equipment,uacs_code',

                'acquisition_cost'           => 'nullable|numeric|min:0',
                'acquisition_date'           => 'nullable|date',

                'mode_of_acquisition_id'     => 'nullable|exists:school_equipment_mode_of_acquisitions,id',
                'source_of_acquisition_id'   => 'nullable|exists:school_equipment_source_of_acquisitions,id',

                'donor'                      => 'nullable|string|max:255',
                'source_of_fund_id'          => 'nullable|exists:school_equipment_source_of_funds,id',
                'allotment_class_id'         => 'nullable|exists:school_equipment_allotment_classes,id',

                'remarks'                    => 'nullable|string|max:1000',
            ]);
            if ($validated['non_dcp'] == 1) {
                $validated['dcp_batch_id'] = null;
                $validated['dcp_batch_item_id'] = null;
            } else {
                $validated['non_dcp_item_id'] = null;
            }
            // ✅ Add fields NOT coming from the form
            $validated['school_id'] = Auth::guard('school')->user()->school->pk_school_id;

            // ✅ CLEAN CREATE
            $schoolEquipment =  SchoolEquipment::create($validated);
            return response()->json([
                'success' => true,
                'message' => 'Equipment successfully added.'
            ], 201);
        } catch (ValidationException $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Validation errors occurred.',
                    'errors' => $e->errors(),
                ],
                422
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'An error occurred while processing your request.',
                    'error' => $e->getMessage(),
                ],
                500
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SchoolEquipment $schoolEquipment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SchoolEquipment $schoolEquipment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        try {

            $validated = $request->validate([


                'property_number'            => 'required|string|max:100',
                'old_property_number'        => 'nullable|string|max:100',
                'serial_number'              => 'required|string|max:100',

                'unit_of_measure_id'         => 'required|exists:school_equipment_unit_of_measures,id',
                'manufacturer_id'            => 'nullable|exists:school_equipment_manufacturers,id',

                'model'                      => 'nullable|string|max:255',
                'specifications'             => 'nullable|string|max:255',
                'supplier_or_distributor'    => 'nullable|string|max:255',

                'category_id'                => 'nullable|exists:school_equipment_categories,id',
                'classification_id'          => 'nullable|exists:school_equipment_classifications,id',

                'non_dcp'                    => 'required|boolean',
                'dcp_batch_id'               => 'nullable|exists:dcp_batches,pk_dcp_batches_id',
                'dcp_batch_item_id'          => 'nullable|exists:dcp_batch_items,pk_dcp_batch_items_id',
                'non_dcp_item_id'            => 'nullable|exists:non_dcp_item,pk_non_dcp_item_id',

                'pmp_reference_no'           => 'nullable|string|max:255',
                'gl_sl_code'                 => 'nullable|string|max:255',
                'uacs_code'                  => 'nullable|string|max:255',

                'acquisition_cost'           => 'nullable|numeric|min:0',
                'acquisition_date'           => 'nullable|date',

                'mode_of_acquisition_id'     => 'nullable|exists:school_equipment_mode_of_acquisitions,id',
                'source_of_acquisition_id'   => 'nullable|exists:school_equipment_source_of_acquisitions,id',

                'donor'                      => 'nullable|string|max:255',
                'source_of_fund_id'          => 'nullable|exists:school_equipment_source_of_funds,id',
                'allotment_class_id'         => 'nullable|exists:school_equipment_allotment_classes,id',

                'remarks'                    => 'nullable|string|max:1000',
            ]);
            if ($validated['non_dcp'] == 1) {
                $validated['dcp_batch_id'] = null;
                $validated['dcp_batch_item_id'] = null;
            } else {
                $validated['non_dcp_item_id'] = null;
            }
            $equipment_result = SchoolEquipment::where('id', $request->id)->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Equipment successfully updated.',
                'data' => $equipment_result
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred',
                'errors' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $schoolEquipment = SchoolEquipment::findOrFail($id);
        $remove_id = $schoolEquipment->delete();
        if ($remove_id) {
            return response()->json([
                'success' => true,
                'message' => 'Equipment successfully deleted.'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete equipment.'
            ], 500);
        }
    }
}
