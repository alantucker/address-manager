<?php

use App\Http\Controllers\AddressController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/bypostcode', [AddressController::class, 'byPostcodeIndex'])->name('bypostcode.index');
Route::post('/bypostcode', [AddressController::class, 'byPostcodeShow'])->name('bypostcode.show');
Route::post('/bypostcode/store', [AddressController::class, 'byPostcodeStore'])->name('bypostcode.store');

Route::get('/byid', [AddressController::class, 'byIdIndex'])->name('byid.index');
Route::post('/byid', [AddressController::class, 'byIdShow'])->name('byid.show');
