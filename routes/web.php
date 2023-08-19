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

Route::get('/', [App\Http\Controllers\MeterController::class, 'list'])->name('meter.list');
Route::post('/', [App\Http\Controllers\MeterController::class, 'store'])->name('meter.store');
Route::delete('meter/{meter}/destroy', [App\Http\Controllers\MeterController::class, 'destroy'])->name('meter.destroy');
Route::get('meter/{meter}/view', [App\Http\Controllers\MeterController::class, 'details'])->name('meter.view');
Route::post('meter/{meter}/reading', [App\Http\Controllers\MeterReadingController::class, 'store'])->name('meter.reading.store');
Route::post('meter/{meter}/reading/auto-generate', 
        [App\Http\Controllers\MeterReadingController::class, 'generateEstimatedReading'])->name('meter.reading.autogenerate');
Route::delete('meter/{meter}/reading/{reading}/destroy',
        [App\Http\Controllers\MeterReadingController::class, 'destroy'])->name('meter.reading.destroy');