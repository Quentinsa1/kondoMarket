<?php
// routes/admin.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminVendorController;   // Assure-toi que ce contrôleur existe
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\ReportController;

Route::middleware(['auth', 'role:admin,super_admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('vendors', AdminVendorController::class)
            ->except(['create', 'store', 'edit']);

        // ✅ Ajoute cette ligne pour la route de changement de statut
        Route::post('vendors/{id}/status', [AdminVendorController::class, 'updateStatus'])
            ->name('vendors.status');

        Route::resource('products', AdminProductController::class)
            ->except(['create', 'store', 'edit']);

        Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('reports/{id}', [ReportController::class, 'show'])->name('reports.show');

        Route::post('vendors/{id}/approve', [AdminDashboardController::class, 'approveVendor'])
            ->name('vendors.approve');
        Route::post('vendors/{id}/reject', [AdminDashboardController::class, 'rejectVendor'])
            ->name('vendors.reject');

        Route::post('products/{id}/approve', [AdminDashboardController::class, 'approveProduct'])
            ->name('products.approve');
        Route::post('products/{id}/reject', [AdminDashboardController::class, 'rejectProduct'])
            ->name('products.reject');
    });