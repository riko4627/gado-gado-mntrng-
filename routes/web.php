<?php

use App\Http\Controllers\CMS\UserController;
use App\Http\Controllers\CMS\ApprovalController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\Auth\Verify2FAController;
use App\Http\Controllers\TemplateController;
use Illuminate\Support\Facades\Route;

// =====================
// PUBLIC (tidak perlu login)
// =====================

Route::get('/2fa/verify', [Verify2FAController::class, 'showVerifyForm'])->name('2fa.verify');
Route::post('/2fa/verify', [Verify2FAController::class, 'verify']);

Route::get('/', [TemplateController::class, 'home']);

Route::get('/login', [TemplateController::class, 'login'])->name('login');

// (opsional, bisa dihapus kalau sudah tidak dipakai)
Route::get('/auth/callback', [TemplateController::class, 'authCallback']);

// Google OAuth (HARUS public)
Route::prefix('v1/auth')->controller(GoogleAuthController::class)->group(function () {
    Route::get('/google', 'redirectToProvider');
    Route::get('/google/callback', 'handleProviderCallback');
});


// =====================
// PROTECTED (WAJIB LOGIN)
// =====================

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/admin', [TemplateController::class, 'dashboard']);

    Route::get('/admin/users', [TemplateController::class, 'users']);
    Route::get('/admin/proyektor', [TemplateController::class, 'proyektor']);
    Route::get('/admin/kinexa', [TemplateController::class, 'kinexa']);
    Route::get('/admin/kinexa/summary', [TemplateController::class, 'kinexaSummary']);

    // ─── Super Admin: Approval Management ──────────────────────────────────
    Route::middleware(['role:super_admin'])->group(function () {
        Route::get('/admin/approvals', [TemplateController::class, 'approvals'])->name('admin.approvals');
    });

    Route::prefix('v1')->group(function () {

        // Logout (pakai POST)
        Route::prefix('auth')->controller(GoogleAuthController::class)->group(function () {
            Route::post('/logout', 'logout');
        });

        // User CRUD
        Route::prefix('user')->controller(UserController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/create', 'createData');
            Route::get('/get/{id}', 'getDataById');
            Route::post('/update/{id}', 'updateData');
            Route::delete('/delete/{id}', 'deleteData');
        });

        // ─── Super Admin: Approval Actions ─────────────────────────────────
        Route::middleware(['role:super_admin'])->prefix('admin')->controller(ApprovalController::class)->group(function () {
            Route::post('/approve/{id}', 'approve')->name('admin.approve');
            Route::post('/reject/{id}', 'reject')->name('admin.reject');
        });
    });
});
