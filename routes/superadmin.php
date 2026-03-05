<?php
// routes/superadmin.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdmin\DashboardController;
use App\Http\Controllers\SuperAdmin\AdminController;
use App\Http\Controllers\SuperAdmin\VendorController;   // ← à ajouter
use App\Http\Controllers\SuperAdmin\ProductController;

Route::middleware(['auth', 'role:super_admin'])
    ->prefix('superadmin')
    ->name('superadmin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('admins', AdminController::class)->except(['show', 'edit', 'update']);
        Route::get('admins/{id}/activities', [AdminController::class, 'activities'])->name('admins.activities');
        Route::post('admins/{id}/toggle-status', [AdminController::class, 'toggleStatus'])->name('admins.toggle-status');

        Route::resource('vendors', VendorController::class)->except(['create', 'store', 'edit']);

        // ✅ Corrigé : maintenant c'est VendorController
        Route::post('vendors/{id}/status', [VendorController::class, 'updateStatus'])
            ->name('vendors.status');

        Route::resource('products', ProductController::class)->except(['create', 'store', 'edit']);
        Route::post('products/{id}/status', [ProductController::class, 'updateStatus'])
            ->name('products.status');
    });