<?php

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('characters.index');
});

Route::get('/characters', [CharacterController::class, 'showAll'])->name('characters.index');
Route::get('/characters/{id}', [CharacterController::class, 'showDetail'])->name('characters.detail');
Route::get('/characters/{id}/pdf', [CharacterController::class, 'exportToPdf'])->name('characters.exp.pdf');

Route::get('/locations', [LocationController::class, 'showAll'])->name('locations.index');
Route::get('/locations/{id}', [LocationController::class, 'showDetail'])->name('locations.detail');

Route::get('/episodes', [EpisodeController::class, 'showAll'])->name('episodes.index');
Route::get('/episodes/{id}', [EpisodeController::class, 'showDetail'])->name('episodes.detail');
