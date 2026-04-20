<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\ContributionController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\DrawController;

Route::get('/', fn () => redirect()->route('dashboard'))->name('home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['ff.auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('members', MemberController::class);

    Route::resource('periods', PeriodController::class)->except(['destroy']);
    Route::post('/periods/{period}/generate-contributions', [PeriodController::class, 'generateContributions'])
        ->name('periods.generateContributions');
    Route::post('/periods/{period}/close', [PeriodController::class, 'close'])
        ->name('periods.close');

    Route::get('/contributions', [ContributionController::class, 'index'])->name('contributions.index');
    Route::post('/contributions/{contribution}/pay', [ContributionController::class, 'pay'])
        ->name('contributions.pay');

    Route::resource('loans', LoanController::class)->except(['destroy']);
    Route::post('/loans/{loan}/pay-installment/{installment}', [LoanController::class, 'payInstallment'])
        ->name('loans.payInstallment');
    Route::post('/loans/{loan}/settle', [LoanController::class, 'settle'])
        ->name('loans.settle');

    Route::resource('expenses', ExpenseController::class)->except(['show', 'destroy']);

    Route::resource('draws', DrawController::class)->except(['destroy', 'show']);
    Route::post('/draws/{draw}/run', [DrawController::class, 'run'])
        ->name('draws.run');
});