<?php

use App\Http\Controllers\Auth\AuthenticatedTokenController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\SearchNewsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserNewsController;
use App\Http\Controllers\UserSettingsCategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::post('/users', [UserController::class, 'store'])->name('register');
        Route::post('/login', [AuthenticatedTokenController::class, 'store'])->name('login');
        Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
        Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.store');
    });

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('/user', [userController::class, 'getUser'])->name('user.get');
        Route::put('/users', [UserController::class, 'update'])->name('user.update');
        Route::put('/users/change-password', [UserController::class, 'changePassword'])->name('password.change');
        Route::get('/users/news/', [UserNewsController::class, 'getUserNews'])->name('user.news.getUserNews');
        Route::get('/users/categories', [UserSettingsCategoryController::class, 'show'])->name('user.categories.show');
        Route::put('/users/categories', [UserSettingsCategoryController::class, 'update'])->name('user.categories.update');
        Route::get('/search', [SearchNewsController::class, 'searchNews'])->name('search');
        Route::post('/logout', [AuthenticatedTokenController::class, 'destroy'])->name('logout');
    });

    Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['auth', 'signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware(['auth', 'throttle:6,1'])
        ->name('verification.send');
});
