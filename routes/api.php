<?php

use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductImportController;
use App\Http\Controllers\Api\ProductMenuContoller;
use App\Http\Controllers\Api\QuoteController;
use App\Http\Controllers\Api\SettingsController;
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

Route::get('menus/getMegaMenuList', [MenuController::class, 'getMegaMenuList']);
Route::get('products', [ProductController::class, 'index']);
Route::get('products/{product}', [ProductController::class, 'show']);

Route::post('contacts', [ContactController::class, 'store']);
Route::post('quotes', [QuoteController::class, 'store']);


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

    Route::apiResource('products', ProductController::class)->except(['index', 'show']);
    Route::post('/products/import', [ProductImportController::class, 'store']);
    Route::post('/products/{product}', [ProductController::class, 'update']);
    Route::post('/products/{product}/menu', [ProductMenuContoller::class, 'store']);

    Route::apiResource('users', UserController::class);
    Route::apiResource('brands', BrandController::class);
    Route::apiResource('quotes', QuoteController::class)->except(['store']);
    Route::apiResource('contacts', ContactController::class)->except(['store']);

    //Settings
    Route::post('/settings/price-display', [SettingsController::class, 'priceDisplay']);
    Route::post('/settings/contact-email', [SettingsController::class, 'contactEmail']);

});
