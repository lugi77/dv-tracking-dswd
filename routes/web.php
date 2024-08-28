<?php


use App\Livewire\Admin\AdminTable;
use App\Livewire\DataTable\AccountingDataTable;
use App\Livewire\DataTable\CashDataTable;
use Illuminate\Support\Facades\Route;
use App\Livewire\OtpVerify;
use App\Http\Controllers\UserDashboardController; 
use App\Livewire\DataTable\BudgetDataTable;


Route::redirect('/', '/login')->name('login');




Route::middleware(['auth', 'otp', 'PreventBackHistory'])->group(function () {

    Route::get('/otp-verify', OtpVerify::class)->name('otp-verify')->middleware('auth');
    
    Route::get('/home', [UserDashboardController::class, 'index'])->name('home');

    Route::view('profile', 'profile')->name('profile');

    // Dashboard Routes for Different Sections
    Route::get('/admin', [UserDashboardController::class, 'index'])
        ->middleware('check.section:0')
        ->name('admin');
    Route::get('/AdminTable', [AdminTable::class])
        ->middleware('check.section:0')
        ->name('admin table');

    Route::middleware('check.section:1')->group(function () {
        Route::get('/budget', [UserDashboardController::class, 'index'])->name('budget');
        Route::get('/BudgetDataTable', BudgetDataTable::class)->name('budget table');
   
    });

    Route::get('/accounting', [UserDashboardController::class, 'index'])
        ->middleware('check.section:2')
        ->name('accounting');

    Route::get('/AccountingDataTable', AccountingDataTable::class)
        ->middleware('check.section:2')
        ->name('accounting table');

    Route::get('/cash', [UserDashboardController::class, 'index'])
        ->middleware('check.section:3')
        ->name('cash');
    
    Route::get('/CashDataTable', CashDataTable::class)
        ->middleware('check.section:3')
        ->name('cash table');

    
});

require __DIR__.'/auth.php';
