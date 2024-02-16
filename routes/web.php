<?php

use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\SeriesController;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();
Route::resource('/series', SeriesController::class)->except(['show']);

Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/series/{series}/seasons', [SeasonController::class, 'index'])->name('seasons.index');
    Route::get('/seasons/{season}/episodes', [EpisodeController::class, 'index'])->name('episodes.index');
    Route::post('/seasons/{season}/episodes', [EpisodeController::class, 'markAsWatched'])->name('episodes.store');
});
