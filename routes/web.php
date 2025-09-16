<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\BorrowController;
use Illuminate\Support\Facades\Route;

Route::get('/', [EquipmentController::class, 'list'])->name('equipment.list');

Route::get('/dashboard', [AdminController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Admin routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Equipment management
    Route::get('/admin/equipment', [EquipmentController::class, 'index'])->name('admin.equipment.index');
    Route::get('/admin/equipment/create', [EquipmentController::class, 'create'])->name('admin.equipment.create');
    Route::post('/admin/equipment', [EquipmentController::class, 'store'])->name('admin.equipment.store');
    Route::get('/admin/equipment/{id}/edit', [EquipmentController::class, 'edit'])->name('admin.equipment.edit');
    Route::put('/admin/equipment/{id}', [EquipmentController::class, 'update'])->name('admin.equipment.update');
    Route::delete('/admin/equipment/{id}', [EquipmentController::class, 'destroy'])->name('admin.equipment.destroy');

    // Borrow requests management
    Route::get('/admin/borrow-requests', [BorrowController::class, 'index'])->name('admin.borrow.requests');
    Route::post('/admin/borrow-requests/{id}/approve', [BorrowController::class, 'approve'])->name('admin.borrow.approve');
    Route::post('/admin/borrow-requests/{id}/decline', [BorrowController::class, 'decline'])->name('admin.borrow.decline');
});

// User routes (no authentication required)
Route::get('/equipment', [EquipmentController::class, 'list'])->name('equipment.list');
Route::get('/borrow', [BorrowController::class, 'create'])->name('borrow.create');
Route::post('/borrow', [BorrowController::class, 'store'])->name('borrow.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
