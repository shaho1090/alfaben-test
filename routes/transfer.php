<?php


use App\Http\Controllers\PassengerController;
use App\Http\Controllers\TransferController;
use Illuminate\Support\Facades\Route;

//Route::group(['middleware' => 'auth'], function () {

    Route::post('/transfers/store', [TransferController::class, 'store'])
        ->name('transfer.store');
//});
