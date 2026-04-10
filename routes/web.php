<?php

use App\Http\Controllers\CMS\UserController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TemplateController;

Route::get('/', [TemplateController::class, 'home']);
Route::get('/admin', [TemplateController::class, 'dashboard']);
Route::get('/admin/users', [TemplateController::class, 'users']);

Route::prefix('v1')->group(function () {
    Route::prefix('user')->controller(UserController::class)->group(function () {
        Route::get('/', 'index');
        Route::post('/create', 'createData');
        Route::get('/get/{id}', 'getDataById');
        Route::post('/update/{id}', 'updateData');
        Route::delete('/delete/{id}', 'deleteData');
    });
});
