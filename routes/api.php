<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\TeamMemberApiController;
use App\Http\Controllers\Api\AboutApiController;
use App\Http\Controllers\Api\DestinationApiController;
use App\Http\Controllers\Api\FaqApiController;
use App\Http\Controllers\Api\PackageApiController;
use App\Http\Controllers\Api\TeamApiController;

Route::post('/auth/register', [AuthApiController::class, 'register']);
Route::post('/auth/login',    [AuthApiController::class, 'login']);
// /api/...
Route::get('/about', AboutApiController::class)->name('api.about');
Route::get('/destinations', [DestinationApiController::class, 'index'])->name('api.destinations.index');
Route::get('/faqs', [FaqApiController::class, 'index'])->name('api.v1.faqs.index');
Route::get('/packages', [PackageApiController::class, 'index'])->name('api.packages.index');
Route::get('/team', [TeamApiController::class, 'index'])->name('api.team.index');



Route::apiResource('team-members', TeamMemberApiController::class)->only(['index','show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('team-members', TeamMemberApiController::class)->only(['store','update','destroy']);
    Route::post('/auth/logout', [AuthApiController::class, 'logout']);
});
