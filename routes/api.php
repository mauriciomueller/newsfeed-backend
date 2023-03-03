<?php

use App\Http\Controllers\ChangeUserPasswordController;
use App\Http\Controllers\CreateAuthenticationTokenController;
use App\Http\Controllers\DestroyAuthenticationTokenController;
use App\Http\Controllers\EmailVerificationNotificationController;
use App\Http\Controllers\GetLoggedUserDataController;
use App\Http\Controllers\GetUserSettingsCategoryController;
use App\Http\Controllers\UpdateUserProfileController;
use App\Http\Controllers\UserResetPasswordController;
use App\Http\Controllers\UserPasswordResetLinkController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SearchNewsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GetUserNewsController;
use App\Http\Controllers\UpdateUserSettingsCategoryController;
use App\Http\Controllers\VerifyEmailController;
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

Route::prefix('v1')->middleware('throttle:api')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::post('/users', RegisterUserController::class)->name('user.register');
        Route::post('/users/login', CreateAuthenticationTokenController::class)->name('user.login');
        Route::post('/users/forgot-password', UserPasswordResetLinkController::class)->name('user.forgotPassword');
        Route::post('/users/reset-password', UserResetPasswordController::class)->name('user.resetPassword');
    });

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('/user', GetLoggedUserDataController::class)->name('user.get');
        Route::put('/users', UpdateUserProfileController::class)->name('user.update');
        Route::put('/users/change-password', ChangeUserPasswordController::class)->name('user.password.change');
        Route::get('/users/news/', GetUserNewsController::class)->name('user.news.get');
        Route::get('/users/categories', GetUserSettingsCategoryController::class)->name('user.categories.get');
        Route::put('/users/categories', UpdateUserSettingsCategoryController::class)->name('user.categories.update');
        Route::post('/users/logout', DestroyAuthenticationTokenController::class)->name('user.logout');
        Route::get('/news/search', [SearchNewsController::class, 'searchNews'])->name('news.search');
    });

    Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['auth', 'signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware(['auth', 'throttle:6,1'])
        ->name('verification.send');
});
