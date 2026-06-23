<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckUser;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\BranchController;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\StaffController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::group(['middleware' => CheckUser::class], function () {

    // Route::post('/branch_list', [BranchController::class, 'index']);

    Route::post('/orders', [ReportController::class, 'orderReport']);

    Route::post('/transactions', [ReportController::class, 'transactionReport']);

    Route::post('/payments', [ReportController::class, 'paymentReport']);

    Route::post('/staff_order', [ReportController::class, 'staffOrderReport']);

    Route::post('/staff_billing', [ReportController::class, 'billingStaffReport']);

    Route::post('/gst_orders', [ReportController::class, 'gstOrderReport']);

    Route::post('/gst_date', [ReportController::class, 'gstDateReport']);

    Route::post('/branch_staff', [ReportController::class, 'branchStaffReport']);
    Route::post('/order_list', [ReportController::class, 'orderListReport']);

    Route::post('/total_sales', [ReportController::class, 'totalSalesReport']);

    Route::post('/customer_report', [ReportController::class, 'customerReport']);

    Route::post('/branch_sales', [ReportController::class, 'branchSalesReport']);

    Route::post('/dashboard', [ReportController::class, 'Dashboard']);
    Route::post('/order_wise_gst', [ReportController::class, 'orderGstReport']);

    Route::post('/branch_table_status', [ReportController::class, 'branchTableStatus']);

    Route::post('/staff_list', [StaffController::class, 'list']);
    Route::post('/staff_add', [StaffController::class, 'store']);
    Route::post('/staff_update', [StaffController::class, 'update']);
    Route::post('/staff_delete', [StaffController::class, 'delete']);

    Route::post('/branch_list', [BranchController::class, 'list']);
    Route::post('/branch_add', [BranchController::class, 'store']);
    Route::post('/branch_update', [BranchController::class, 'update']);
    Route::post('/branch_delete', [BranchController::class, 'delete']);
 Route::post('/customer_list', [ApiController::class, 'customer_list']);
   
    Route::post('/customer_view_order', [ApiController::class, 'viewOrders']);
    Route::post('/complete_order', [ApiController::class, 'completeOrder']);
    Route::post('/change_password',[ApiController::class,'changePassword']);
});


 Route::post('/test', function () {
    return response()->json(['status' => 'ok']);
});