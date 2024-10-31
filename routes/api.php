<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Api\V1\Authentication\app\Http\Controllers\AuthenticationController;
use Modules\Api\V1\Repository\app\Http\Controllers\RepositoryController;
use Modules\Api\V1\Tag\app\Http\Controllers\TagController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1/')->name('v1.')->group(function () {
    Route::apiResource('tags', TagController::class)->middleware('auth:sanctum');
    Route::apiResource('repositories', RepositoryController::class)->middleware('auth:sanctum');
    Route::delete('repositories/{repository}', [RepositoryController::class, 'removeStar'])->middleware('auth:sanctum');
    Route::post('register' , [AuthenticationController::class , 'register']);
    Route::post('login' , [AuthenticationController::class , 'login']);
    Route::post('logout' , [AuthenticationController::class , 'logout'])->middleware('auth:sanctum');
});
