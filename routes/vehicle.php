<?php


use App\Http\Controllers\DriverController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

//Route::group(['middleware' => 'auth'], function () {

    Route::post('/vehicles/store', [VehicleController::class, 'store'])
        ->name('vehicle.store');
//});
