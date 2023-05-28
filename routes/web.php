<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;

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
Route::get('dashboard', [CustomAuthController::class, 'dashboard']);
Route::get('signin', [CustomAuthController::class, 'signIn'])->name('login');
Route::get('signup', [CustomAuthController::class, 'signUp'])->name('register-user');


Route::post('signin', [CustomAuthController::class, 'signInPost'])->name('login.custom');
Route::post('signup', [CustomAuthController::class, 'signUpPost'])->name('register.custom');

