<?php

use App\Http\Controllers\Auth\Users\AuthenticatedSessionController;

use App\Http\Controllers\Auth\Users\ConfirmablePasswordController ;
use App\Http\Controllers\Auth\Users\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\Users\EmailVerificationPromptController ;
use App\Http\Controllers\Auth\Users\NewPasswordController ;
use App\Http\Controllers\Auth\Users\PasswordResetLinkController ;
use App\Http\Controllers\Auth\Users\RegisteredUserController;
use App\Http\Controllers\Auth\Users\VerifyEmailController ;

use App\Http\Controllers\Auth\Admin\AuthenticatedSessionController  as AuthenticatedSessionController1;

use App\Http\Controllers\Auth\Admin\ConfirmablePasswordController  as ConfirmablePasswordController1;
use App\Http\Controllers\Auth\Admin\EmailVerificationNotificationController  as EmailVerificationNotificationController1 ;
use App\Http\Controllers\Auth\Admin\EmailVerificationPromptController as EmailVerificationPromptController1;
use App\Http\Controllers\Auth\Admin\NewPasswordController as NewPasswordController1;
use App\Http\Controllers\Auth\Admin\PasswordResetLinkController as PasswordResetLinkController1;
use App\Http\Controllers\Auth\Admin\RegisteredUserController  as RegisteredUserController1;
use App\Http\Controllers\Auth\Admin\VerifyEmailController as VerifyEmailController1;

use Illuminate\Support\Facades\Route;

Route::get('/admin/register', [RegisteredUserController1::class, 'create'])
                ->middleware('guest:admin')
                ->name('admin.register');

Route::post('/admin/register', [RegisteredUserController1::class, 'store'])
                ->middleware('guest:admin');

Route::get('/admin/login', [AuthenticatedSessionController1::class, 'create'])
                ->middleware('guest:admin')
                ->name('admin.login');

Route::post('/admin/login', [AuthenticatedSessionController1::class, 'store'])
                ->middleware('guest:admin');

Route::get('/admin/forgot-password', [PasswordResetLinkController1::class, 'create'])
                ->middleware('guest:admin')
                ->name('admin.password.request');

Route::post('/admin/forgot-password', [PasswordResetLinkController1::class, 'store'])
                ->middleware('guest:admin')
                ->name('admin.password.email');

Route::get('/admin/reset-password/{token}', [NewPasswordController1::class, 'create'])
                ->middleware('guest:admin')
                ->name('admin.password.reset');

Route::post('/admin/reset-password', [NewPasswordController1::class, 'store'])
                ->middleware('guest:admin')
                ->name('admin.password.update');

Route::get('/admin/verify-email', [EmailVerificationPromptController1::class, '__invoke'])
                ->middleware('auth:admin')
                ->name('admin.verification.notice');

Route::get('/admin/verify-email/{id}/{hash}', [VerifyEmailController1::class, '__invoke'])
                ->middleware(['auth:admin', 'signed', 'throttle:6,1'])
                ->name('admin.verification.verify');

Route::post('/admin/email/verification-notification', [EmailVerificationNotificationController1::class, 'store'])
                ->middleware(['auth:admin', 'throttle:6,1'])
                ->name('admin.verification.send');

Route::get('/admin/confirm-password', [ConfirmablePasswordController1::class, 'show'])
                ->middleware('auth:admin')
                ->name('admin.password.confirm');

Route::post('/admin/confirm-password', [ConfirmablePasswordController1::class, 'store'])
                ->middleware('auth:admin');

Route::post('/admin/logout', [AuthenticatedSessionController1::class, 'destroy'])
                ->middleware('auth:admin')
                ->name('admin.logout');



//User

Route::get('/register', [RegisteredUserController::class, 'create'])
                ->middleware('guest:user')
                ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
                ->middleware('guest:user');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest:user')
                ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest:user');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->middleware('guest:user')
                ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->middleware('guest:user')
                ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->middleware('guest:user')
                ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->middleware('guest')
                ->name('password.update');

Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->middleware('auth:user')
                ->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['auth:user', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth:user', 'throttle:6,1'])
                ->name('verification.send');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->middleware('auth:user')
                ->name('password.confirm');

Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
                ->middleware('auth:user');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth:user')
                ->name('logout');