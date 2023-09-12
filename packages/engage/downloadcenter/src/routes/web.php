<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckTenantId;
use App\Http\Middleware\Tenancy;
use Engage\Downloadcenter\Http\Controllers\DownloadcenterController;
use Engage\Downloadcenter\Http\Controllers\TenantFileAccessController;



Route::group([
    'prefix'     => '/{tenant}/downloadcenter-navigation',
    'middleware' => [
        Tenancy::class,
        'web',
        CheckTenantId::class,
    ],
], function () {

    Route::get('', [TenantFileAccessController::class, 'index'])->name('fileaccess')->middleware(['auth', 'XSS']);
    // Route::get('downloadcenter-navigation/{id}', [DownloadcenterController::class, 'downloadcenterNavigationPage'])->name('downloadcenter_navigation')->middleware(['auth', 'XSS']);
    // Route::get('downloadcenter-extra-profile-navigation', [DownloadcenterController::class, 'downloadcenterNavigationPage'])->name('downloadcenter_extra_profile_navigation')->middleware(['auth', 'XSS']);

    Route::get('fileaccess', [TenantFileAccessController::class, 'index'])->name('fileaccess.index')->middleware(['auth', 'XSS']);


    // TenantFileAccessController

    Route::resource('fileaccess', TenantFileAccessController::class)->parameters(['tenant' => 'selectedTenant'])->middleware(['auth', 'two-factor.auth', 'XSS']);

    Route::get('new-release/create', [TenantFileAccessController::class, 'newRelease'])->name('newRelease.create')->middleware(['auth', 'two-factor.auth', 'XSS']);

    Route::post('new-release/store', [TenantFileAccessController::class, 'storeNewRelease'])->name('newRelease.store')->middleware(['auth', 'two-factor.auth', 'XSS']);

    Route::get('new-product/create', [TenantFileAccessController::class, 'newProduct'])->name('newProduct.create')->middleware(['auth', 'two-factor.auth', 'XSS']);

    Route::post('new-product/store', [TenantFileAccessController::class, 'storeNewProduct'])->name('newProduct.store')->middleware(['auth', 'two-factor.auth', 'XSS']);

    Route::get('release-product/edit/{id}', [TenantFileAccessController::class, 'editReleaseProduct'])->name('release-product.edit')->middleware(['auth', 'two-factor.auth', 'XSS']);

    Route::put('new-release-product/update/{id}', [TenantFileAccessController::class, 'updateReleaseProduct'])->name('release-product.update')->middleware(['auth', 'two-factor.auth', 'XSS']);

    Route::get('new-file/create/{id}/{type}/{name?}', [TenantFileAccessController::class, 'newFile'])->name('newFile.create')->middleware(['auth', 'two-factor.auth', 'XSS']);

    Route::post('new-file/store', [TenantFileAccessController::class, 'storeNewFile'])->name('newFile.store')->middleware(['auth', 'two-factor.auth', 'XSS']);

    Route::post('product-list/get', [TenantFileAccessController::class, 'getProduct'])->name('product.get')->middleware(['auth', 'two-factor.auth', 'XSS']);

    Route::post('tenant-file-list/get', [TenantFileAccessController::class, 'fileList'])->name('fileList.get')->middleware(['auth', 'two-factor.auth', 'XSS']);

    Route::post('tenant-files/Access', [TenantFileAccessController::class, 'fileAccess'])->name('fileList.access')->middleware(['auth', 'two-factor.auth', 'XSS']);

    Route::post('tenant-files/removeAccess', [TenantFileAccessController::class, 'removeFileAccess'])->name('fileList.access.remove')->middleware(['auth', 'two-factor.auth', 'XSS']);

    Route::get('tenant-files/download/{name}/{id}/{exe?}/{folder?}', [TenantFileAccessController::class, 'getDownload'])->name('fileList.download')->middleware(['auth', 'two-factor.auth', 'XSS']);

    Route::post('tenant-files/destroy', [TenantFileAccessController::class, 'destroyFile'])->name('file.destroy')->middleware(['auth', 'two-factor.auth', 'XSS']);

    Route::get('reports', [TenantFileAccessController::class, 'reports'])->name('fileaccess.reports')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::post('reports/filter', [TenantFileAccessController::class, 'reportsFilterData'])->name('fileaccess.reports.filter')->middleware(['auth', 'two-factor.auth', 'XSS']);

});

