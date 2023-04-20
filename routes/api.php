<?php

use App\Http\Controllers\API\CategoryApiController;
use App\Http\Controllers\API\PlaceApiController;
use App\Http\Controllers\Api\SettingApiController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/categories', [CategoryApiController::class, 'index']);
Route::get('/place', [PlaceApiController::class, 'index']);
Route::get('/place/category/{id}', [PlaceApiController::class, 'getPlaceByCategory']);
Route::get('setting', [SettingApiController::class, 'index']);
