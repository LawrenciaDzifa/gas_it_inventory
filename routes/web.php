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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder')->name('io_generator_builder');

Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate')->name('io_field_template');

Route::get('relation_field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@relationFieldTemplate')->name('io_relation_field_template');

Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate')->name('io_generator_builder_generate');

Route::post('generator_builder/rollback', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@rollback')->name('io_generator_builder_rollback');

Route::post(
    'generator_builder/generate-from-file',
    '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generateFromFile'
)->name('io_generator_builder_generate_from_file');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();
Route::resource('items', App\Http\Controllers\ItemController::class);
Route::resource('categories', App\Http\Controllers\CategoryController::class);
Route::resource('stocks', App\Http\Controllers\StockController::class);
Route::resource('stockHistories', App\Http\Controllers\StockHistoryController::class);
Route::resource('requisitions', App\Http\Controllers\RequisitionController::class);
Route::get('/approve/{id}', [App\Http\Controllers\RequisitionController::class, 'approve'])->name('approve');
Route::get('/decline/{id}', [App\Http\Controllers\RequisitionController::class, 'decline'])->name('decline');
Route::resource('restocks', App\Http\Controllers\RestockController::class);


Route::resource('assignments', App\Http\Controllers\AssignmentController::class);
