<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\OtpVerify;
use App\Http\Controllers\UserDashboardController; 

Route::redirect('/', '/login');

Route::get('/otp-verify', OtpVerify::class)->name('otp.verify')->middleware('auth');


Route::middleware(['auth'])->group(function () {
    Route::get('/home', [UserDashboardController::class, 'index'])->name('home');

    Route::view('profile', 'profile')->name('profile');

    // Dashboard Routes for Different Sections
    Route::get('/admin', [UserDashboardController::class, 'index'])
        ->middleware('check.section:0')
        ->name('admin');

    Route::get('/budget', [UserDashboardController::class, 'index'])
        ->middleware('check.section:1')
        ->name('budget');

    Route::get('/accounting', [UserDashboardController::class, 'index'])
        ->middleware('check.section:2')
        ->name('accounting');

    Route::get('/cash', [UserDashboardController::class, 'index'])
        ->middleware('check.section:3')
        ->name('cash');
});

require __DIR__.'/auth.php';
