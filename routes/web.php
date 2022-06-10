<?php

use App\Http\Controllers\Admin\{
    CandidateController,
    CityController,
    ResponsibilityController,
    GroupFieldController,
    FieldValueController,
    FieldController
};
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
Route::resource('admin/responsibilities', ResponsibilityController::class);
Route::resource('admin/candidates', CandidateController::class);
Route::post('admin/cities/{id}/values', [FieldValueController::class, 'store'])->name('fieldvalues.store');
Route::resource('admin/cities', CityController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
