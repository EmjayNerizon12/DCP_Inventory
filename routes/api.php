<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\School\DashboardController;
use App\Http\Controllers\Api\School\DCPBatchItemController;
use App\Http\Controllers\Api\School\ISPController;
use App\Http\Controllers\Api\School\ISPReportController;
use App\Http\Controllers\Api\School\ItemConditionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\School\SchoolInventoryController;
use App\Models\SchoolEmployee;

Route::prefix('School')->group(function () {
    Route::apiResource('school-inventory', SchoolInventoryController::class);
    Route::get('dcpInventory/{schoolId}/search', [SchoolInventoryController::class, 'searchBatchItems']);
    Route::get('dcpBatchItem/search/{batchId}/{searchTerm?}', [DCPBatchItemController::class, 'searchProductFromStatus']);
    Route::get('dcpDashboard/dcp-information/{schoolId}', [DashboardController::class, 'getDashboardDCPInformation']);
    Route::get('dcpDashboard/condition-information/{schoolId}', [DashboardController::class, 'getItemConditionCounts']);
    Route::get('dcpDashboard/equipment-information/{schoolId}', [DashboardController::class, 'getDashboardInfomation']);
    Route::get('dcpBatchItem/item-information/{batchId}', [DCPBatchItemController::class, 'fetchItems']);
    Route::get('dcpItemCondition/condition-information/{schoolId}/{conditionId?}', [ItemConditionController::class, 'index']);
    Route::get('ispQuestionWithAnswer/{schoolId}', [ISPReportController::class, 'index']);
    Route::get('ispQuestionWithChoices', [ISPReportController::class, 'ispQuestions']);
    Route::delete('ispQuestionWithAnswer/delete/{schoolId}', [ISPReportController::class, 'destroy']);
    Route::get('fetchEmployeeList', function () {
        $employees = SchoolEmployee::all();
        return response()->json(['success' => true, 'data' => $employees], 200);
    });
    Route::get('schoolInternet/{schoolId}', [ISPController::class, 'index']);
});
Route::post('login', [AuthController::class, 'login']);
