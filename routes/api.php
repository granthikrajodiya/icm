<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserNotificationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/pluralize', [LayoutController::class, 'pluralize'])->name('pluralize');

Route::middleware(['api-id.check'])->group(function () {
    Route::post('user/update/{user?}', [UserController::class, 'userUpdate'])->name('user.update');

    Route::post('calendar/addEvent', [CalendarController::class, 'addEvent'])->name('calendar.addEvent');
    Route::post('calendar/updateEvent/{calendar?}', [CalendarController::class, 'updateEvent'])->name('calendar.updateEvent');
    Route::post('calendar/deleteEvent/{calendar?}', [CalendarController::class, 'deleteEvent'])->name('calendar.deleteEvent');

    Route::post('activity/addActivity', [ActivityController::class, 'addActivity'])->name('activity.addActivity');
    Route::post('activity/updateActivity/{activity?}', [ActivityController::class, 'updateActivity'])->name('activity.updateActivity');
    Route::post('activity/deleteActivity/{activity?}', [ActivityController::class, 'deleteActivity'])->name('activity.deleteActivity');

    Route::post('notification/addNotification', [UserNotificationController::class, 'addNotification'])->name('notification.addNotification');

    Route::post('setting/update', [SettingsController::class, 'updateValue'])->name('setting.update');
});
