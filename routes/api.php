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
Route::get('cities/{slug}', 'App\Http\Controllers\Api\CityApiController@byCity')->name('api.city.slug');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
