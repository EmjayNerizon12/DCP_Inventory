<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Models\ISP\ISPDetails;
use Illuminate\Http\Request;

class ISPController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(int $school_id)
    {
        try {

            $internet = ISPDetails::with(['ispInfo', 'ispList', 'ispConnectionType', 'ispInternetQuality', 'ispPurpose', 'ispSpeedTest', 'ispAreaDetails.ispAreaAvailable'])
                ->where('school_id', $school_id)
                ->get();
            return response()->json([
                'success' => true,
                'data' => $internet
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve internet data',
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
