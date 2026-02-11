<?php

namespace App\Http\Controllers\ISPInfo;

use App\Http\Controllers\Controller;
use App\Models\ISPInfo\ISPInfo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ISPInfoController extends Controller
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


            // dd($request->all());
            // 1️⃣ Validate required fields
            $validated = $request->validate([
                'school_internet_id'      => 'required|integer|exists:isp_details,pk_isp_details_id',
                'cost_per_month'          => 'required|numeric',
                'account_number'          => 'required|string|max:255',
                'description'             => 'nullable|string|max:500',
                'subscription_type'       => 'required|string|in:Prepaid,Postpaid',
                'contract_start'          => 'required|date',
                'contract_end'            => 'required|date|after_or_equal:contract_start',
                'inactive_contract'       => 'nullable|boolean',
                'active_isp_counter'      => 'nullable|integer',
                'mode_of_acq_id'          => 'nullable|integer|exists:i_s_p_mode_of_acqs,id',
                'source_of_acq_id'        => 'nullable|integer|exists:i_s_p_source_of_acqs,id',
                'donor'                   => 'nullable|string|max:255',
                'source_of_fund_id'       => 'nullable|integer|exists:i_s_p_source_of_funds,id',
                'total_no_access_points'  => 'nullable|integer',
                'active_counter1'         => 'nullable|integer',
                'location_of_access_points' => 'nullable|string|max:500',
                'total_admin_area_isps'   => 'nullable|integer',
                'active_counter2'         => 'nullable|integer',
                'admin_area_rate_id'      => 'nullable|integer|exists:i_s_p_ratings,id',
                'total_classroom_isps'    => 'nullable|integer',
                'active_counter3'         => 'nullable|integer',
                'classroom_area_rate_id'  => 'nullable|integer|exists:i_s_p_ratings,id',
                'rate'                    => 'nullable|numeric',
            ]);

            // 2️⃣ Create record using mass assignment
            $schoolInternet = ISPInfo::create($validated);

            // 3️⃣ Return response
            return response()->json([
                'success' => true,
                'message' => 'School Internet info created successfully!',
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Creation failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $iSPInfo = ISPInfo::where('school_internet_id', $id)->with([
            'schoolInternet.ispList',
            'schoolInternet.ispConnectionType',
            'schoolInternet.ispInternetQuality',
            'schoolInternet.ispPurpose',
            'modeOfAcq',
            'sourceOfAcq',
            'sourceOfFund',
            'adminAreaRate',
            'classroomAreaRate'
        ])->get();

        return response()->json(['success' => true, 'data' => $iSPInfo], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        try {
            // dd($request->all());
            // 1️⃣ Validate required fields
            $validated = $request->validate([
                'school_internet_id'      => 'required|integer|exists:isp_details,pk_isp_details_id',
                'cost_per_month'          => 'required|numeric',
                'account_number'          => 'required|string|max:255',
                'description'             => 'nullable|string|max:500',
                'subscription_type'       => 'required|string|in:Prepaid,Postpaid',
                'contract_start'          => 'required|date',
                'contract_end'            => 'required|date|after_or_equal:contract_start',
                'inactive_contract'       => 'nullable|boolean',
                'active_isp_counter'      => 'nullable|integer',
                'mode_of_acq_id'          => 'nullable|integer|exists:i_s_p_mode_of_acqs,id',
                'source_of_acq_id'        => 'nullable|integer|exists:i_s_p_source_of_acqs,id',
                'donor'                   => 'nullable|string|max:255',
                'source_of_fund_id'       => 'nullable|integer|exists:i_s_p_source_of_funds,id',
                'total_no_access_points'  => 'nullable|integer',
                'active_counter1'         => 'nullable|integer',
                'location_of_access_points' => 'nullable|string|max:500',
                'total_admin_area_isps'   => 'nullable|integer',
                'active_counter2'         => 'nullable|integer',
                'admin_area_rate_id'      => 'nullable|integer|exists:i_s_p_ratings,id',
                'total_classroom_isps'    => 'nullable|integer',
                'active_counter3'         => 'nullable|integer',
                'classroom_area_rate_id'  => 'nullable|integer|exists:i_s_p_ratings,id',
                'rate'                    => 'nullable|numeric',
            ]);

            // 2️⃣ Create record using mass assignment
            $schoolInternet = ISPInfo::findOrFail($request->id);
            $schoolInternet->update($validated);

            // 3️⃣ Return response
            return response()->json([
                'success' => true,
                'message' => 'School Internet info updated successfully!',
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ISPInfo $iSPInfo)
    {
        //
    }
}
