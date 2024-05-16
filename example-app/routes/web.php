<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetsController;

Route::controller(PetsController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/pet/add', 'add');
    Route::post('/pet/create', 'store');
    Route::get('/pet/show/{petId}', 'show');
    // Route::post('/pet/edit/{petId}', 'edit');
    // Route::get('/pet/delete/ask/{petId}', 'askToConfirmDestroy');
    // Route::post('/pet/delete/confirm/{petId}', 'destroy');

});