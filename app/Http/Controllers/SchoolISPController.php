<?php

namespace App\Http\Controllers;

use App\Models\ISP\ISPAreaDetails;
use App\Models\ISP\ISPDetails;
use App\Models\ISP\ISPSpeedTest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;

class SchoolISPController extends Controller
{
    function index()
    {

        $schoolsISP = ISPDetails::where('school_id', Auth::guard('school')->user()->school->pk_school_id)->get();
        $isp_content = ISPDetails::with(['ispInfo', 'ispList', 'ispConnectionType', 'ispInternetQuality', 'ispPurpose', 'ispSpeedTest', 'ispAreaDetails.ispAreaAvailable'])
            ->where('school_id', Auth::guard('school')->user()->school->pk_school_id)
            ->get();
        return view('SchoolSide.ISP.index', compact('isp_content'));
    }

    function updateArea(Request $request)
    {
        try {
            $validated = $request->validate([
                'isp_details_id' => 'required|integer',
                'pk_isp_area_details_id' => 'required|integer',
                'isp_area_available_id' => 'required|integer',
            ]);

            $if_exist = ISPAreaDetails::where('isp_details_id', $validated['isp_details_id'])
                ->where('isp_area_available_id', $validated['isp_area_available_id'])
                ->where('pk_isp_area_details_id', '!=', $validated['pk_isp_area_details_id']) // exclude current row
                ->first();

            if ($if_exist != null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Area already exists.',
                    'errors' => [
                        'isp_area_available_id' => [
                            'Area already exists.'
                        ]
                    ]
                ], 422);
            }

            $isp_area = ISPAreaDetails::findOrFail($validated['pk_isp_area_details_id']);

            $isp_area->update([
                'isp_area_available_id' => $validated['isp_area_available_id']
            ]);

            return response()->json([
                'success' => true,
                'message' => 'ISP Area has been updated.',
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Updating failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    function insertNewArea(Request $request)
    {
        try {
            $validated = $request->validate(

                [
                    'insert_isp_details_id' => 'required|integer',
                    'insert_isp_area_available_id' => 'required|integer',
                ],
                [],
                [
                    'insert_isp_details_id' => 'ID is Missing (dev)',
                    'insert_isp_area_available_id' => 'Internet Area Covered',
                ]
            );

            $isp_area = ISPAreaDetails::where('isp_details_id',  $validated['insert_isp_details_id'])
                ->where('isp_area_available_id', $validated['insert_isp_area_available_id'])->get();
            if (count($isp_area) > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Area already exists.',
                    'errors' => [
                        'insert_isp_area_available_id' => [
                            'Area already exists.'
                        ]
                    ]
                ], 422);
            } else {
                ISPAreaDetails::create([
                    'isp_details_id' => $validated['insert_isp_details_id'],
                    'isp_area_available_id' => $validated['insert_isp_area_available_id']
                ]);
                return response()->json([
                    'success' => true,
                    'message' => 'New ISP Area has been added.',
                ], 201);
            }
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Saving failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    function deleteArea(int $isp_details_id, int $isp_area_available_id)
    {
        $isp_area = ISPAreaDetails::where('isp_details_id',  $isp_details_id)
            ->where('isp_area_available_id', $isp_area_available_id);
        $isp_area->delete();
        return response()->json(['message' => 'The ISP Area has been deleted']);
    }
    function storeData(Request $request)
    {
        try {
            $validated = $request->validate([
                'isp_list_id' => 'required|integer',
                'isp_connection_type' => 'required|integer',
                'isp_internet_quality' => 'required|integer',
                'isp_purpose' => 'required|integer',
                'isp_upload' => 'required|integer',
                'isp_download' => 'required|integer',
                'isp_ping' => 'required|integer',
                'areas' => 'required|array|min:1',
                'areas.*' => 'distinct',
            ]);

            $isp_details = ISPDetails::create([
                'school_id' => Auth::guard('school')->user()->school->pk_school_id,
                'isp_list_id' => $validated['isp_list_id'],
                'isp_purpose_id' => $validated['isp_purpose'],
                'isp_connection_type_id' => $validated['isp_connection_type'],
                'isp_internet_quality_id' => $validated['isp_internet_quality'],
            ]);

            foreach ($validated['areas'] as $area) {
                ISPAreaDetails::create([
                    'isp_details_id' => $isp_details->pk_isp_details_id,
                    'isp_area_available_id' => $area,
                ]);
            }

            ISPSpeedTest::create([
                'isp_details_id' => $isp_details->pk_isp_details_id,
                'upload' => $validated['isp_upload'],
                'ping' => $validated['isp_ping'],
                'download' => $validated['isp_download'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'New Internet Service Provider added successfully',
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Saving failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    function updateData(Request $request)
    {
        try {
            $validated = $request->validate([
                'pk_isp_details_id' => 'required|integer',
                'isp_list_id' => 'required|integer',
                'isp_connection_type' => 'required|integer',
                'isp_internet_quality' => 'required|integer',
                'isp_purpose' => 'required|integer',
                'isp_upload' => 'required|integer',
                'isp_download' => 'required|integer',
                'isp_ping' => 'required|integer',
            ]);
            $isp_details = ISPDetails::findOrFail($validated['pk_isp_details_id']);
            if ($isp_details) {
                $isp_details->update([
                    'isp_list_id' => $validated['isp_list_id'],
                    'isp_purpose_id' => $validated['isp_purpose'],
                    'isp_connection_type_id' => $validated['isp_connection_type'],
                    'isp_internet_quality_id' => $validated['isp_internet_quality'],
                ]);
                $speed_test = ISPSpeedTest::where('isp_details_id', $validated['pk_isp_details_id'])->first();
                if ($speed_test) {
                    $speed_test->update([
                        'upload' => $validated['isp_upload'],
                        'ping' => $validated['isp_ping'],
                        'download' => $validated['isp_download'],
                    ]);
                }

                return response()->json([
                    'success' => true,
                    'message' => 'ISP Details have been updated.',
                ], 200);
            }
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Updating failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    function deleteISP(int $id)
    {
        $isp_details = ISPDetails::findOrFail($id);
        $isp_details->delete();
        return response()->json(['message' => 'The ISP has been deleted']);
    }
}
