<?php

use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\FieldController;
use App\Http\Controllers\Admin\GroupFieldController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Route::post('admin/groupfields/{id}/fields', [FieldController::class, 'store'])->name('fields.store');
Route::delete('admin/groupfields/{id}/fields/{fieldId}', [FieldController::class, 'destroy'])->name('fields.delete');
Route::resource('admin/groupfields', GroupFieldController::class);
Route::resource('admin/cities', CityController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
