<?php

use App\Http\Controllers\AulaController;
use App\Http\Controllers\ProfileController;
use DebugBar\DebugBar;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
Route::get('/', function () {
    return  redirect()->route("login") ;
});


Route::get('/dashboard', function () {

        return app(UserController::class)->index(); // Llama al método index() del UserController

})->middleware(['auth', 'verified'])->name('dashboard');

Route::put("redirect",[UserController::class,'change_user'])->name("redirect");
Route::delete("redirect",[UserController::class,'eleminar'])->name("redirect");

Route::get('/aulas/{department}', [AulaController::class, 'getAulasByDepartment'])->name('aulas.department');


Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
