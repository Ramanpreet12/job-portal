<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
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

//protecting routes : these routes are only accessible when user is not logged in
Route::middleware(['guest', 'throttle:20 , 1'])->group(function () {
    Route::get('login' , [LoginController::class , 'login'])->name('login');
    Route::post('authenticate' , [LoginController::class , 'authenticate'])->name('authenticate');
Route::get('register' , [RegisterController::class , 'register'])->name('register');
Route::post('register-user' , [RegisterController::class , 'registerUser'])->name('register-user');
Route::get('forgot-password' , [RegisterController::class , 'forgotPassword'])->name('forgot-password');
});

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard' , [DashboardController::class , 'dashboard'])->name('dashboard');

});
