<?php

use App\Http\Controllers\Admin\CityCandidateController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
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

Route::get('', [HomeController::class, 'index'])->name('home');

Route::prefix('admin')
    ->namespace('App\\Http\\Controllers\\Admin')
    ->middleware('auth')
    ->group(function() {

    Route::get('/', [AdminHomeController::class, 'index'])->name('admin.home');
    Route::post('groupfields/{id}/fields', [FieldController::class, 'store'])->name('fields.store');
    Route::delete('groupfields/{id}/fields/{fieldId}', [FieldController::class, 'destroy'])->name('fields.delete');
    Route::resource('groupfields', GroupFieldController::class);
    Route::resource('responsibilities', ResponsibilityController::class);
    Route::resource('candidates', CandidateController::class);
    Route::post('cities/{id}/values', [FieldValueController::class, 'store'])->name('fieldvalues.store');
    Route::post('cities/{id}/votes', [CityCandidateController::class, 'store'])->name('cities.candidates.store');
    Route::resource('cities', CityController::class);

});

/**
 * Auth
 */
Auth::routes(['register' => false]);
