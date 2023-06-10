<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\SkillController;
// use App\Http\Controllers\SkillController;

Route::group(['prefix' => 'V1'], function(){
    Route::apiResource('skills', SkillController::class);
});

// Route::group(['prefix'=> 'api'], function(){
//     Route::apiResource('skills', SkillController::class);
// });
