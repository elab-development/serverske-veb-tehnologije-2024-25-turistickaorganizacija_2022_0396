<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AboutApiController;
use App\Http\Controllers\Api\DestinationApiController;
use App\Http\Controllers\Api\PackageApiController;
use App\Http\Controllers\Api\TeamApiController;
use App\Http\Controllers\Api\FaqApiController;

Route::get('/about', [AboutApiController::class, '__invoke']);
Route::get('/destinations', [DestinationApiController::class, 'index']);
Route::get('/packages', [PackageApiController::class, 'index']);
Route::get('/team', [TeamApiController::class, 'index']);
Route::get('/faqs', [FaqApiController::class, 'index']);

