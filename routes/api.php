<?php

use App\Http\Controllers\Api\V1\AddressController;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/v1/address/store/{id}', [AddressController::class, 'store']);

Route::get('/v1/lookup/{postcode}', [AddressController::class, 'index']);
Route::get('/v1/lookup/show/{id}', [AddressController::class, 'show']);

Route::get('/v1/lookup/find/{id}', function (string $id) {
    return new AddressResource(Address::findOrFail($id));
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
