<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\SavingController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect()->route('login');
});

// Route đăng nhập và đăng ký (chỉ dành cho khách)
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');
// Routes có bảo mật
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Giao dịch
    Route::resource('transactions', TransactionController::class);

    // Ngân sách
    Route::resource('budgets', BudgetController::class);

    // Mục tiêu tiết kiệm
    Route::resource('goals', GoalController::class);
    Route::post('/goals/{goal}/add-fund', [GoalController::class, 'addFund'])->name('goals.add-fund');

    // Khoản tiết kiệm
    Route::resource('savings', SavingController::class);
});
