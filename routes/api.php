<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrganizationController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/**
 * Routes for Auth
 */
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/user', [AuthController::class, 'userInfo'])->middleware('auth:sanctum');

/**
 * Routes for orgnanization management
 */
Route::post('/org/create', [OrganizationController::class, 'create'])->middleware('auth:sanctum');
Route::get('/org/list', [OrganizationController::class, 'list'])->middleware('auth:sanctum');
Route::delete('/org/delete', [OrganizationController::class, 'delete'])->middleware('auth:sanctum');

/**
 * Routes for diagnostic management
 */