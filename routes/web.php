<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ArtisanController;

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

Route::get('/',[MainController::class, 'index'])->name('home');
Route::get('/solution',[MainController::class, 'solution'])->name('solution');
Route::get('/show',[MainController::class, 'show'])->name('show');
Route::get('/create',[MainController::class, 'create'])->name('create');
Route::get('/update/{id}',[MainController::class, 'update'])->name('update');

Route::fallback(function () {
    return view('404');
});
