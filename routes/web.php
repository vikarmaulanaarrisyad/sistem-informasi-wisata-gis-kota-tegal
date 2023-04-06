<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PlaceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'middleware' => ['auth', 'role:admin,user']
], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::group([
        'middleware' => 'role:admin'
    ], function () {
        // route category
        Route::get('/category/data', [CategoryController::class, 'data'])->name('category.data');
        Route::resource('category', CategoryController::class)->except('edit', 'create');

        // route places
        Route::get('/places/data', [PlaceController::class, 'data'])->name('place.data');
        Route::resource('place', PlaceController::class)->except('edit', 'create');
    });
});
