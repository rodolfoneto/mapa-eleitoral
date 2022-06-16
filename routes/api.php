<?php

use App\Http\Controllers\Api\CityApiController;
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

Route::get('cities', 'App\Http\Controllers\Api\CityApiController@index')->name('api.city.index');
Route::get('cities-2', [CityApiController::class, 'index2'])->name('api.city.index2');
Route::get('cities-3', [CityApiController::class, 'index3'])->name('api.city.index3');
Route::get('cities/{slug}', 'App\Http\Controllers\Api\CityApiController@byCity')->name('api.city.slug');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
