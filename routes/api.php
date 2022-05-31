<?php

use App\Http\Controllers\RentController;
use Illuminate\Support\Facades\Route;
Route::group(['as' => 'api.'], function() {
    Route::group(['as' => 'car.', 'prefix' => 'car', 'controller' => RentController::class], function() {
        Route::post('/rent', 'rent')->name('rent');
        Route::delete('/return', 'return')->name('return');
    });
});

