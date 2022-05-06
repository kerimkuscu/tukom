<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function() {
    return view('welcome');
});

Route::get('/test', [\App\Http\Controllers\LocalController::class, 'test']);

Route::get('/fligram', [\App\Http\Controllers\LocalController::class, 'fligram']);
Route::post('/fligram', [\App\Http\Controllers\LocalController::class, 'fligramStore'])->name('fligram.store');

Auth::routes();

Route::middleware('auth:sanctum')->group(function() {
    Route::get('{any}', function() {
        return view('index');
    })->where('any', '.*');
});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
