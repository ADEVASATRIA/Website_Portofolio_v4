<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\SkillController;
use App\Http\Controllers\Api\V1\ProjectController;
use App\Http\Controllers\SkillController as SkillControllerWeb;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Middleware\VerifyToken;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Api\V1\ApiController;


Route::group(['prefix' => 'V1', 'middleware' => 'auth:api'], function(){
    Route::apiResource('skills', ApiController::class);
    // Route::apiResource('project', ProjectController::class);
});


// Route::prefix('v1')->group(function () {
//     // Rute tanpa otentikasi
//     Route::post('auth/register', [AuthController::class, 'register']);
//     Route::post('auth/login', [AuthController::class, 'login']);

//     // Rute yang membutuhkan otentikasi
//     Route::middleware(['auth:api'])->group(function () {
//         Route::get('project', [ProjectController::class, 'index']);
//         Route::post('project', [ProjectController::class, 'store']);
//         Route::get('project/{id}', [ProjectController::class, 'show']);
//         Route::put('project/{id}', [ProjectController::class, 'update']);
//         Route::delete('project/{id}', [ProjectController::class, 'destroy']);

//         // Rute logout
//         Route::post('auth/logout', [AuthController::class, 'logout']);
//     });
// });
Route::middleware('auth:api')->prefix('V1')->group(function () {
    Route::get('/project', [ProjectController::class, 'index']);
    Route::post('/project', [ProjectController::class, 'store']);
    Route::get('/project/{id}', [ProjectController::class, 'show']);
    Route::put('/project/{id}', [ProjectController::class, 'update']);
    Route::delete('/project/{id}', [ProjectController::class, 'destroy']);
    // Route::apiResource('skills', ApiController::class);
    // Route::apiResource('skills', [ApiController::class]);
});

// Route::group(['prefix'=> 'old'], function(){
//     Route::apiResource('skill', SkillControllerWeb::class);
// });

Route::middleware('api')->prefix('V1')->group(function(){

});
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [ApiController::class, 'login']);
    Route::post('logout', [ApiController::class, 'logout']);
    Route::post('refresh', [ApiController::class, 'refresh']);
    Route::post('me', [ApiController::class, 'me']);
});


// Route::middleware('auth:api')->group(function () {
//     Route::post('register', [AuthController::class, 'register']);
//     Route::post('login', [AuthController::class, 'login']);
//     Route::post('logout', [AuthController::class, 'logout']);
//     Route::post('refresh', [AuthController::class, 'fresh']);
//     Route::post('me', [AuthController::class, 'me']);
// });
