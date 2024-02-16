<?php

use App\Http\Controllers\Api\DocumentApi;
use App\Http\Controllers\Api\MeetingApi;
use App\Http\Controllers\Api\PartnerApi;
use App\Http\Controllers\Api\ProjectApi;
use App\Http\Controllers\Api\ReflectionApi;
use App\Http\Controllers\Api\WorktimeApi;
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
        Route::post('/', [PartnerApi::class, 'store']);
        // ステップ周り
        Route::prefix('{id}')->group(function () {
            Route::get('/', [PartnerApi::class, 'show']);
            Route::put('/', [PartnerApi::class, 'update']);
            Route::delete('/', [PartnerApi::class, 'destroy']);
            Route::prefix('documents')->group(function () {
                Route::get('/', [DocumentApi::class, 'index']);
                Route::post('/', [DocumentApi::class, 'upload']);
            });
        });
    });
    Route::prefix('projects')->group(function () {
        Route::get('/', [ProjectApi::class, 'index']);
        Route::prefix('{id}')->group(function () {
            Route::get('/', [ProjectApi::class, 'show']);
            // ステップ周り
            Route::prefix('step')->group(function () {
                Route::get('/', [ProjectApi::class, 'showStep']);
                Route::put('/', [ProjectApi::class, 'step']);
            });
            // 契約周り
            Route::prefix('agreement')->group(function () {
                Route::get('/', [ProjectApi::class, 'showAgreement']);
                Route::post('/', [ProjectApi::class, 'updateAgreement']);
            });
            // 工数周り
            Route::prefix('worktime')->group(function () {
                Route::get('/', [WorktimeApi::class, 'show']);
                Route::post('/', [WorktimeApi::class, 'store']);
                Route::put('/{worktime_id}', [WorktimeApi::class, 'update']);
            });
            // 振り返り周り
            Route::prefix('reflection')->group(function () {
                Route::get('/', [ReflectionApi::class, 'show']);
                Route::post('/', [ReflectionApi::class, 'store']);
                Route::put('/{reflection_id}', [ReflectionApi::class, 'update']);
            });
            // 会議周り
            Route::prefix('meetings')->group(function () {
                Route::get('/', [MeetingApi::class, 'index']);
                Route::post('/', [MeetingApi::class, 'store']);
            });
        });
        Route::post('/', [ProjectApi::class, 'store']);
        // Route::put('/{id}', [PartnerApi::class, 'update']);
        // Route::delete('/{id}', [PartnerApi::class, 'destroy']);
    });
});


Route::get('/sample', function (Request $request) {
    return response()->json(['msg' => '成功']);
});
