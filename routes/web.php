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

//Route::get('/', function() {
//    return view('welcome');
//});

Route::get('/test', [\App\Http\Controllers\TestController::class, 'test']);

Route::get('/fligram', [\App\Http\Controllers\TestController::class, 'fligram']);
Route::post('/fligram', [\App\Http\Controllers\TestController::class, 'fligramStore'])->name('fligram.store');

//Auth::routes();

    Route::get('{any}', function() {
        return view('index');
    })->where('any', '.*');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
