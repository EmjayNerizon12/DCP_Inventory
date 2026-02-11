<?php

namespace App\Http\Controllers;

use App\Models\Equipment\EquipmentBiometricDetails;
use App\Models\Equipment\EquipmentType;
use App\Models\Equipment\EquipmentBrand;
use App\Models\Equipment\EquipmentInstaller;
use App\Models\Equipment\EquipmentIncharge;
use App\Models\Equipment\EquipmentLocation;
use App\Models\Equipment\EquipmentPowerSource;
use App\Models\Equipment\EquipmentBiometricType;
use App\Models\Equipment\EquipmentCCTVDetails;
use App\Models\Equipment\EquipmentCCTVType;
use App\Models\Equipment\EquipmentDetails;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class SchoolEquipmentContoller extends Controller
{
    public function index()
    {
        $equipment_type = EquipmentType::all();
        $equipment_brand_model = EquipmentBrand::all();
        $equipment_installer = EquipmentInstaller::all();
        $equipment_incharge = EquipmentIncharge::all();
        $equipment_location = EquipmentLocation::all();
        $equipment_power_source = EquipmentPowerSource::all();
        $biometric_type = EquipmentBiometricType::all();
        $cctv_type = EquipmentCCTVType::all();
        $cctv_info = EquipmentCCTVDetails::where('school_id', Auth::guard('school')->user()->school->pk_school_id)->get();
        $biometric_info = EquipmentBiometricDetails::where('school_id', Auth::guard('school')->user()->school->pk_school_id)->get();



        return view("SchoolSide.Equipment.index", compact('cctv_type', 'biometric_info', 'cctv_info', 'biometric_type', 'equipment_type', 'equipment_brand_model', 'equipment_installer', 'equipment_incharge', 'equipment_location', 'equipment_power_source'));
    }
    public function store(Request $request)
    {
        // dd($request->all());

        try {
            $validated = $request->validate([
                "selected_equipment" => "required|integer",       // CCTV, Biometric
                "e_cctv_type"      => " integer",      // Brand/Model
                "e_biometric_type"      => "integer",      // Brand/Model
                "e_brand"          => "required|integer",      // Brand/Model
                "e_power_source"   => "required|integer",       // PoE, DC adapter, etc.
                "e_location"       => "required|integer",      // Building, room, outdoor
                "date_installed"   => "required|date",                // Must be a valid date
                "total_amount"     => "required|numeric|min:0",       // Money value
                "e_installer"      => "required|integer",      // Installer name
                "e_incharge"       => "required|integer ",      // Person in-charge

                "no_of_cctv"      => "nullable|integer ",       // Dome, Bullet, PTZ (nullable if not CCTV)
                "no_of_functional" => "required|integer|min:0",       // Number of functional units
            ]);
            $school_id =  Auth::guard("school")->user()->school->pk_school_id;
            $equipment_details = EquipmentDetails::create([
                'equipment_type_id'           => $validated['selected_equipment'],
                'equipment_brand_model_id'          => $validated['e_brand'],
                // 'no_of_cctv'          => $validated['no_of_cctv'],
                'equipment_power_source_id'   => $validated['e_power_source'],
                'equipment_location_id'       => $validated['e_location'],
                'date_installed'   => $validated['date_installed'],
                'total_amount'     => $validated['total_amount'],
                'equipment_installer_id'      => $validated['e_installer'],
                'equipment_incharge_id'       => $validated['e_incharge'],
            ]);
            if ($equipment_details) {
                if ($validated['selected_equipment'] == 1) {

                    $equipment_cctv = EquipmentCCTVDetails::create([
                        'school_id' => $school_id,
                        'equipment_details_id' => $equipment_details->pk_equipment_details_id,
                        'e_cctv_camera_type_id' => $validated['e_cctv_type'],
                        'no_of_units' => $validated['no_of_cctv'],
                        'no_of_functional' => $validated['no_of_functional'],
                    ]);
                } elseif ($validated['selected_equipment'] == 2) {
                    $equipment_biometrics = EquipmentBiometricDetails::create([
                        'school_id' => $school_id,
                        'equipment_details_id' => $equipment_details->pk_equipment_details_id,
                        'e_biometric_type_id' => $validated['e_biometric_type'],
                        'no_of_units' => $validated['no_of_cctv'],
                        'no_of_functional' => $validated['no_of_functional'],
                    ]);
                }
                if (isset($equipment_details) || isset($equipment_biometrics)) {
                    return response()->json([
                        'success' => true,
                        'message' => 'New School Equipment added successfully!',
                    ]);
                }
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->getMessage(),
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ]);
        }
    }
    public function update(Request $request)
    {
        $validated = $request->validate([
            'edit_primary_key' => 'required|integer',
            'target' => 'required|string',
            'edit_e_brand' => 'required|integer',
            'edit_no_of_unit' => 'required|integer',
            'edit_e_cctv_type' => 'nullable|integer',
            'edit_e_biometric_type' => 'nullable|integer',
            'edit_e_power_source' => 'required|integer',
            'edit_e_location' => 'required|integer',
            'edit_total_amount' => 'required|integer',
            'edit_e_installer' => 'required|integer',
            'edit_no_of_functional' => 'required|integer',
            'edit_e_incharge' => 'required|integer',
            'edit_date_installed' => 'required|date',
        ]);

        try {

            $equipment_details = EquipmentDetails::findOrFail($validated['edit_primary_key']);

            $equipment_details->update([
                'equipment_brand_model_id'          => $validated['edit_e_brand'],
                'equipment_power_source_id'   => $validated['edit_e_power_source'],
                'equipment_location_id'       => $validated['edit_e_location'],
                'equipment_installer_id'      => $validated['edit_e_installer'],
                'equipment_incharge_id'       => $validated['edit_e_incharge'],
                'date_installed'   => $validated['edit_date_installed'],
                'total_amount'     => $validated['edit_total_amount'],
            ]);
            if ($validated['target'] == 'cctv') {
                try {

                    $equipment_details->cctv_details()->update([
                        'no_of_units' => $validated['edit_no_of_unit'],
                        'e_cctv_camera_type_id' => $validated['edit_e_cctv_type'],
                        'no_of_functional' => $validated['edit_no_of_functional'],
                    ]);
                } catch (Exception $e) {
                    return redirect()->back()->with('error', 'Error on CCTV Details' . $e->getMessage());
                }
            } elseif ($validated['target'] == 'biometric') {
                try {
                    $equipment_details->biometric_details()->update([
                        'no_of_units' => $validated['edit_no_of_unit'],
                        'e_biometric_type_id' => $validated['edit_e_biometric_type'],
                        'no_of_functional' => $validated['edit_no_of_functional'],
                    ]);
                } catch (Exception $e) {
                    return redirect()->back()->with('error', 'Error on Biometric Details' . $e->getMessage()); //'.
                }
            }

            if ($equipment_details->cctv_details || $equipment_details->biometric_details) {
                return redirect()->back()->with('success', 'Equipment updated successfully.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function destroy(int $pk_id, String $type)
    {
        if ($type == "cctv") {

            $deleteDetails = EquipmentCCTVDetails::findOrFail($pk_id);
        } else if ($type == "biometrics") {
            $deleteDetails = EquipmentBiometricDetails::findOrFail($pk_id);
        }
        $deleteDetails->delete();
        return response()->json([
            'success' => true,
            'message' => 'Equipment deleted successfully!',
        ]);
    }
}
