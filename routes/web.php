<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\OtpVerify;

Route::redirect('/', '/login');



Route::get('/otp-verify', OtpVerify::class)->name('otp.verify')->middleware('auth');


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

