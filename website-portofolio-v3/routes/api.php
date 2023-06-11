<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\SkillController;
use App\Http\Controllers\Api\V1\ProjectController;
use App\Http\Controllers\SkillController as SkillControllerWeb;
use App\Http\Controllers\Api\V1\AuthController;

Route::group(['prefix' => 'V1'], function(){
    Route::apiResource('skills', SkillController::class);
    Route::apiResource('project', ProjectController::class);
});

Route::group(['prefix'=> 'old'], function(){
    Route::apiResource('skill', SkillControllerWeb::class);
});


Route::group([
    'middleware' => ['api'],
    'prefix' => 'auth'
],function($router){
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'fresh']);
    Route::post('me', [AuthController::class, 'me']);
});


// Route::middleware('auth:api')->group(function () {
//     Route::post('register', [AuthController::class, 'register']);
//     Route::post('login', [AuthController::class, 'login']);
//     Route::post('logout', [AuthController::class, 'logout']);
//     Route::post('refresh', [AuthController::class, 'fresh']);
//     Route::post('me', [AuthController::class, 'me']);
// });
