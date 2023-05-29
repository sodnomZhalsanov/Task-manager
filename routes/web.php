<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\DashboardController;

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
Route::get('dashboard', [DashboardController::class, 'getDashboard'])->middleware('auth')->name('dashboard');
Route::get('signin', [CustomAuthController::class, 'signIn'])->middleware('guest')->name('signin');
Route::get('signup', [CustomAuthController::class, 'signUp'])->middleware('guest')->name('signup');


Route::post('signin', [CustomAuthController::class, 'signInPost'])->middleware('guest');
Route::post('signup', [CustomAuthController::class, 'signUpPost'])->middleware('guest');

