<?php

use Illuminate\Support\Facades\Route;
use Modules\Api\V1\Authentication\app\Http\Controllers\AuthenticationController;
use Modules\Api\V1\Repository\app\Http\Controllers\RepositoryController;
use Modules\Api\V1\Tag\app\Http\Controllers\TagController;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::prefix('v1/')->name('v1.')->group(function () {

    // START: SYNC INTEL
        Route::post('syncData', [RepositoryController::class, 'syncData'])->middleware('auth:sanctum');
    // END: SYNC INTEL

    // START: AUTHENTICATION
        Route::post('register' , [AuthenticationController::class , 'register']);
        Route::post('login' , [AuthenticationController::class , 'login']);
        Route::post('logout' , [AuthenticationController::class , 'logout'])->middleware('auth:sanctum');
    // END: AUTHENTICATION

    // START: TAGS
        Route::apiResource('tags', TagController::class)->middleware('auth:sanctum');
        Route::get('tagsSearch', [TagController::class , 'search'])->name('tags.search')->middleware('auth:sanctum');
        Route::get('tags/{tag}/repositories', [TagController::class , 'repositories'])->name('tags.repositories');
    // END: TAGS

    // START: REPOSITORIES
        Route::apiResource('repositories', RepositoryController::class)->middleware('auth:sanctum');
        Route::get('repositoriesSearch', [RepositoryController::class , 'search'])->name('repositories.search')->middleware('auth:sanctum');
        // START: UNSTAR REPO
        Route::post('repositories/{repository}/unstar', [RepositoryController::class, 'unstar'])->middleware('auth:sanctum');
        // END: UNSTAR REPO
    // END: REPOSITORIES
});
