<?php

use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductImportController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\AuthController;
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
Route::group([
    'middleware' => 'api',
    'namespace'  => 'Auth',
    'prefix'     => 'auth',
], function() {
    Route::post('login', [AuthController::class, 'login']);
    Route::get('user', [AuthController::class, 'user']);
});

//'auth:sanctum'
Route::group(['middleware' => ['auth:api']], function() {
    Route::get('/user', function(Request $request) {
        return $request->user();
    });

    Route::post('/tokens/create', function(Request $request) {
        $token = $request->user()->createToken('token');

        return ['token' => $token->plainTextToken];
    });

    Route::get('menus/getMenuList', [MenuController::class, 'getMenuList']);
    Route::apiResource('menus', MenuController::class);

    Route::apiResource('products', ProductController::class);
    Route::post('/products/import', [ProductImportController::class, 'store']);
    Route::post('/products/{product}', [ProductController::class, 'update']);

    Route::apiResource('users', UserController::class);
    Route::apiResource('brands', BrandController::class);
});
