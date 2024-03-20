<?php

use App\Http\Controllers\ProfileController;
use DebugBar\DebugBar;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/dashboard', function () {

    dump(auth()->user()->job);
    \Barryvdh\Debugbar\Facades\Debugbar::info(auth()->user()->job);
$job=auth()->user()->job==1;
    if( $job==1){
        return view('super-admin');
    }elseif ($job==2){
        return view('admin');
    }elseif ($job==3){
        return view('tech');

    }
    else {

        return view('dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin', function () {
    return view('admin');
})->middleware(['auth', 'verified'])->name('admin');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
