<?php

use App\Http\Controllers\VerifyEmailController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    return view('signin');
});
Route::get('signin', [CustomAuthController::class, 'signIn'])->name('signin');
Route::get('signup', [CustomAuthController::class, 'signUp'])->name('signup');
Route::post('signin', [CustomAuthController::class, 'signInPost']);
Route::post('signup', [CustomAuthController::class, 'signUpPost']);


Route::middleware('auth')->group(function ()
{
    Route::get('/email/verify', function () {
        return view('auth.verify');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware('signed')
        ->name('verification.verify');

    Route::get('dashboard', [DashboardController::class, 'getDashboard'])->middleware('verified')->name('dashboard');
    Route::post('addTask', [DashboardController::class, 'addTask'])->name('addTask');
    Route::post('addCoworker', [DashboardController::class, 'addCoworker'])->name('addCoworker');

    Route::get('completeTask', [DashboardController::class, 'getCompletedTasks'])->name('completeTask');
    Route::post('completeTask', [DashboardController::class, 'completeTask']);

});

Route::get('accept/{token}', [DashboardController::class, 'accept'])->name('accept');


