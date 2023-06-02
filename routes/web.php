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
Route::get('signin', [CustomAuthController::class, 'signIn'])->name('signin');
Route::get('signup', [CustomAuthController::class, 'signUp'])->name('signup');


Route::post('signin', [CustomAuthController::class, 'signInPost']);
Route::post('signup', [CustomAuthController::class, 'signUpPost']);
Route::post('addTask', [DashboardController::class, 'addTask'])->name('addTask');;
Route::post('addCoworker', [DashboardController::class, 'addCoworker'])->name('addCoworker');;

