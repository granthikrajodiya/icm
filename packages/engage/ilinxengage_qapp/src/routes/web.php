<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckTenantId;
use App\Http\Middleware\Tenancy;
use Engage\Ilinxengage_qapp\Http\Controllers\QappController;


Route::group([
    'prefix'     => '/{tenant}',
    'middleware' => [
        Tenancy::class,
        'web',
        CheckTenantId::class,
    ],
], function () {


    // Route::get('qapp', [QappController::class, 'index'])->name('qapp_index')->middleware(['auth', 'XSS']);

    Route::resource('qapp', QappController::class)->parameters(['tenant' => 'selectedTenant'])->middleware(['auth', 'two-factor.auth', 'XSS']);


    Route::post('/qapp/store', [QappController::class, 'storeQapp'])->name('qapp.store')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::post('/qapp/properties/{id}', [QappController::class, 'storeProperties'])->name('qapp.properties')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::post('/qapp/designer', [QappController::class, 'storeDesigner'])->name('qapp.designer')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::post('/qapp/presentation/{id}', [QappController::class, 'storePresentation'])->name('qapp.presentation')->middleware(['auth', 'two-factor.auth', 'XSS']);


});
