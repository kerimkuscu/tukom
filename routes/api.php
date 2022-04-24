<?php

use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
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

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/user', function(Request $request) {
        return $request->user();
    });

    Route::post('/tokens/create', function(Request $request) {
        $token = $request->user()->createToken('token');

        return ['token' => $token->plainTextToken];
    });

    Route::apiResource('menus', MenuController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('users', UserController::class);
});




