<?php


use App\Http\Controllers\DriverController;
use Illuminate\Support\Facades\Route;

//Route::group(['middleware' => 'auth'], function () {

    Route::post('/drivers/store', [DriverController::class, 'store'])
        ->name('driver.store');
//});
