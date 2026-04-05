<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        $role = Auth::user()->role;
        if ($role === 'admin') return redirect()->route('admin.index');
        if ($role === 'petani') return redirect()->route('petani.index');
    }
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'storeUser']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/admin', [AuthController::class, 'indexAdmin'])->name('admin.index');
    Route::get('/admin/users', [AuthController::class, 'indexUsers'])->name('users.index');
    Route::post('/admin/users/store', [AuthController::class, 'storeUser'])->name('users.store');
    Route::get('/petani', [AuthController::class, 'indexPetani'])->name('petani.index');
    Route::get('/users-data', [AuthController::class, 'showAllUsers'])->name('users.detail');
    Route::get('/users/{id}', [AuthController::class, 'show'])->name('users.show');
});
