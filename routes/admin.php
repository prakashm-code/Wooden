<?php

use App\Http\Controllers\Admin\BlockBoardController;
use App\Http\Controllers\Admin\BranchController as AdminBranchController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DoorController;
use App\Http\Controllers\Admin\PlywoodController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OutletController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\TaxController;
use App\Http\Controllers\Api\BranchController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Route::get('/outlet_dashboard', [DashboardController::class, 'outlet_index'])->name('outlet_dashboard');
    // //  Route::get('/tables', [DashboardController::class, 'tables'])->name('tables');
    // Route::get('/view_order', [DashboardController::class, 'view_order'])->name('view_order');
    // Route::get('/take_order', [DashboardController::class, 'take_order'])->name('take_order');
    Route::get('/enquiries', [DashboardController::class, 'enquiry'])->name('enquiries');


    Route::get('/settings', [SettingController::class, 'index'])->name('setting');
    Route::post('/add_settings', [SettingController::class, 'update'])->name('setting.update');
    Route::get('/profile', [SettingController::class, 'userProfile'])->name('setting.profile');
    Route::post('/update_profile', [SettingController::class, 'updateProfile'])->name('setting.profile_update');
    // web.php
    Route::get('/plywoods', [PlywoodController::class, 'index'])->name('plywoods');
    Route::get('/add_plywood', [PlywoodController::class, 'add'])->name('add_plywood');
    Route::post('/add_plywood', [PlywoodController::class, 'store'])->name('plywood.store');
    Route::get('plywood_edit/{id}',  [PlywoodController::class, 'edit'])->name('plywood.edit');
    Route::post('plywood_update/{id}', [PlywoodController::class, 'update'])->name('plywood.update');
    Route::post('plywood_delete/{id}', [PlywoodController::class, 'delete'])->name('plywood.destroy');

    Route::get('/doors', [DoorController::class, 'index'])->name('doors');
    Route::get('/add_door', [DoorController::class, 'add'])->name('add_door');
    Route::post('/add_door', [DoorController::class, 'store'])->name('door.store');
    Route::get('door_edit/{id}',  [DoorController::class, 'edit'])->name('door.edit');
    Route::post('door_update/{id}', [DoorController::class, 'update'])->name('door.update');
    Route::post('door_delete/{id}', [DoorController::class, 'delete'])->name('door.destroy');

    Route::get('/blockboards', [BlockBoardController::class, 'index'])->name('blockboards');
    Route::get('/add_blockboard', [BlockBoardController::class, 'add'])->name('add_blockboard');
    Route::post('/add_blockboard', [BlockBoardController::class, 'store'])->name('blockboard.store');
    Route::get('blockboard_edit/{id}',  [BlockBoardController::class, 'edit'])->name('blockboard.edit');
    Route::post('blockboard_update/{id}', [BlockBoardController::class, 'update'])->name('blockboard.update');
    Route::post('blockboard_delete/{id}', [BlockBoardController::class, 'delete'])->name('blockboard.destroy');


    //  Route::get('/tax', [TaxController::class, 'index'])->name('tax');



});

Route::get('/admin', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});
