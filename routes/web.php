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
    return view('auth/login');
});

Auth::routes();

Route::resource('/caisse', App\Http\Controllers\CaisseController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('edit-caisse/{id}', [App\Http\Controllers\CaisseController::class, 'edit']);
Route::put('update-caisse/{id}', [App\Http\Controllers\CaisseController::class, 'update']);

Route::get('/filter', [App\Http\Controllers\CaisseController::class, 'filter']);
