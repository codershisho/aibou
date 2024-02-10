<?php

use App\Http\Controllers\Api\PartnerApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('aibou')->group(function () {
    Route::prefix('partners')->group(function () {
        Route::get('/', [PartnerApi::class, 'index']);
        Route::get('/{id}', [PartnerApi::class, 'show']);
        Route::post('/', [PartnerApi::class, 'store']);
        Route::put('/{id}', [PartnerApi::class, 'update']);
        Route::delete('/{id}', [PartnerApi::class, 'destroy']);
    });
});


Route::get('/sample', function (Request $request) {
    return response()->json(['msg' => '成功']);
});
