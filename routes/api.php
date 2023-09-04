<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ShareApiController;

Route::middleware('auth:sanctum')->post('/share', [ShareApiController::class, 'store']);
