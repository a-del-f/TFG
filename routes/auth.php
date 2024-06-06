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
    Route::get('aula',[\App\Http\Controllers\AulaController::class,'index'])->name('aula')->middleware(\App\Http\Middleware\CheckUserJob::class .":Admin");
    Route::post('aula',[\App\Http\Controllers\AulaController::class,'store'])->name('aula')->middleware(\App\Http\Middleware\CheckUserJob::class .":Admin");
    Route::put("change_estado",[\App\Http\Controllers\MessageController::class,'change_estado'])->name("change_estado")->middleware(\App\Http\Middleware\CheckUserJob::class .":Technician");

    Route::get('create_incidence',[\App\Http\Controllers\IncidenceController::class,'create'])->name('create_incidence')->middleware(\App\Http\Middleware\CheckUserJob::class .":Admin");
    Route::post('create_incidence',[\App\Http\Controllers\IncidenceController::class,'store'])->name('create_incidence')->middleware(\App\Http\Middleware\CheckUserJob::class .":Admin");


    Route::get('incidences',[\App\Http\Controllers\IncidenceController::class,'index'])->name('incidences')->middleware(\App\Http\Middleware\CheckUserJob::class.":Admin,Technician");

    Route::get('messages',[\App\Http\Controllers\MessageController::class,'index'])->name('messages');

    Route::get('delete_department',[\App\Http\Controllers\DepartmentController::class,'delete_index'])->name('delete_department')->middleware(\App\Http\Middleware\CheckUserJob::class .":Admin");
    Route::post('delete_department',[\App\Http\Controllers\DepartmentController::class,'delete'])->name('delete_department')->middleware(\App\Http\Middleware\CheckUserJob::class .":Admin");


    Route::get('create_message/{id?}', [\App\Http\Controllers\MessageController::class, 'create'])->name('creator_message');
    Route::post('create_message', [App\Http\Controllers\MessageController::class, 'store'])->name('create_message');

    Route::get('departments', [DepartmentController::class,'index'])->name('departments')->middleware(\App\Http\Middleware\CheckUserJob::class .":Admin");
    Route::post('departments', [DepartmentController::class,'store'])->name('departments.store')->middleware(\App\Http\Middleware\CheckUserJob::class .":Admin");


    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register')->middleware(\App\Http\Middleware\CheckUserJob::class . ':Admin');

    Route::post('register', [RegisteredUserController::class, 'store']);







    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
