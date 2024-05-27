<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;

Route::middleware('guest')->group(function () {


    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('aula',[\App\Http\Controllers\AulaController::class,'index'])->name('aula');
    Route::post('aula',[\App\Http\Controllers\AulaController::class,'store'])->name('aula');
    Route::put("messages",[\App\Http\Controllers\MessageController::class,'change_estado'])->name("change_estado");

    Route::get('create_incidence',[\App\Http\Controllers\IncidenceController::class,'create'])->name('create_incidence');
    Route::post('create_incidence',[\App\Http\Controllers\IncidenceController::class,'store'])->name('create_incidence');


    Route::get('incidences',[\App\Http\Controllers\IncidenceController::class,'index'])->name('incidences');
    Route::get('messages',[\App\Http\Controllers\MessageController::class,'index'])->name('messages');

    Route::get('delete_department',[\App\Http\Controllers\DepartmentController::class,'delete_index'])->name('delete_department');
    Route::post('delete_department',[\App\Http\Controllers\DepartmentController::class,'delete'])->name('delete_department');


    Route::get('create_message',[\App\Http\Controllers\MessageController::class,'create'])->name('create_message');
    Route::post('create_message', [App\Http\Controllers\MessageController::class, 'store'])->name('create_message');

    Route::get('departments', [DepartmentController::class,'index'])->name('departments');
    Route::post('departments', [DepartmentController::class,'store'])->name('departments');


    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
