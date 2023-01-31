<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;

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

Route::get('/', [ UserController::class,'index' ] )->name('user.index');
Route::get('/edit/{id?}', [ UserController::class,'edit'])->name('user.edit');
Route::post('/save', [ UserController::class,'store'])->name('user.store');
Route::get('/delete/{id}',[ UserController::class,'delete'])->name('user.delete');
Route::delete('/destroy', [ UserController::class,'destroy'])->name('user.destroy');

Route::get('/login', [ LoginController::class,'index'])->name('user.login');
Route::get('/logout', [ LoginController::class,'logout'])->name('user.logout');
Route::post('/auth', [ LoginController::class,'authenticate'])->name('login.auth');
