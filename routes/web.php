<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RestIntegrationController;
use App\Http\Controllers\TenantController;
use Illuminate\Support\Facades\Route;
use Rap2hpoutre\LaravelLogViewer\LogViewerController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/missing', [TenantController::class, 'Tenant_Exception'])->name('Tenant_Exception');

Route::middleware('XSS')->group(function () {
    Route::get('/home', [HomeController::class, 'index']);
    Route::get('/public', [HomeController::class, 'viewAsPublic'])->name('view.as.public');
    Route::get('/integrations', [RestIntegrationController::class, 'integrations'])->name('integrations');
});

if (!app()->isProduction()) {
    Route::get('logs', [LogViewerController::class, 'index']);
}
