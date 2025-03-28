<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//User Route
Route::resource('user', App\Http\Controllers\UserController::class);
Route::post('/user-list', [App\Http\Controllers\UserController::class, 'userList'])->name('user-list');
Route::get('/user/delete/{user}', [App\Http\Controllers\UserController::class, 'delete'])->name('user.delete');
Route::post('/user/status/{id}', [App\Http\Controllers\UserController::class, 'updateStatus'])->name('user.status');
