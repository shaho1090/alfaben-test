<?php


use App\Http\Controllers\PassengerController;
use Illuminate\Support\Facades\Route;

//Route::group(['middleware' => 'auth'], function () {

    Route::post('/passengers/store', [PassengerController::class, 'store'])
        ->name('passenger.store');
//});
