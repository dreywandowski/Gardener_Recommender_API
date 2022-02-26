<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// register customers/gardeners
Route::post('register', [App\Http\Controllers\UserController::class, 'register']);

// get customers and their gardeners
Route::get('customers', [App\Http\Controllers\UserController::class, 'getCustomers']);

// get gardeners and number of customers each have
Route::get('gardeners', [App\Http\Controllers\UserController::class, 'getGardeners']);

// get locations and customers
Route::get('locations', [App\Http\Controllers\LocationController::class, 'index']);
