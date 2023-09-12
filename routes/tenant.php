<?php

declare (strict_types = 1);

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\Api\NoteApiController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SendTwoFactorMessageController;
use App\Http\Controllers\Auth\TwoFactorController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CallController;
use App\Http\Controllers\CourtCasesPresentationController;
use App\Http\Controllers\CustomPagesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\LayoutNavigationController;
use App\Http\Controllers\ModulePermissionAssignmentController;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\NewsfeedsController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\RestIntegrationController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\UserController;
//use App\Http\Controllers\TenantFileAccessController;
use App\Http\Controllers\UserNotificationController;
use App\Http\Middleware\CheckTenantId;
use App\Http\Middleware\Tenancy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/* Disable because moving the register manage to tenant level
if (env('SELF_REGISTRATION_ENABLED') == false && request()->segment(2) == 'register') {
    Route::get(request()->segment(1) . '/register', function () {
        return redirect(request()->segment(1) . '/login');
    });
}
*/

Route::group([
    'prefix'     => '/{tenant}',
    'middleware' => [
        Tenancy::class,// overide initializeTenancy of InitializeTenancyByPath::class for TenantCouldNotBeIdentifiedException
        'web',
        CheckTenantId::class,
    ],
], function () {
    Auth::routes();
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('make/logout/{message?}', [LoginController::class, 'makeLogout'])->name('make.logout');

    /** Two-Factor Authentication */
    Route::get('/two-factor', [TwoFactorController::class, 'index'])->name('two-factor.index')->middleware(['auth']);
    Route::post('/two-factor', [TwoFactorController::class, 'authenticate'])->name('two-factor.authenticate')->middleware(['auth']);
    Route::post('/two-factor/send-email', SendTwoFactorMessageController::class)->name('two-factor.send-email')->middleware(['auth', 'mail.config']);

    /** Two-Factor Authentication */
    Route::get('/two-factor', [TwoFactorController::class, 'index'])->name('two-factor.index')->middleware(['auth']);
    Route::post('/two-factor', [TwoFactorController::class, 'authenticate'])->name('two-factor.authenticate')->middleware(['auth']);
    Route::post('/two-factor/send-email', SendTwoFactorMessageController::class)->name('two-factor.send-email')->middleware(['auth', 'mail.config']);

    // Customize Password Reset
    Route::get('/password-reset-request', [PasswordResetController::class, 'request'])->name('password.reset.request');
    Route::post('/password-reset-link', [PasswordResetController::class, 'sendToken'])->name('password.reset.sendToken');
    Route::get('/password-reset-form/{token?}', [PasswordResetController::class, 'showResetForm'])->name('password.reset.form');
    Route::get('/password-reset-admin-form/{user_id}', [PasswordResetController::class, 'showResetAdminForm'])->name('password.reset.adminform');
    Route::post('/password-reset', [PasswordResetController::class, 'reset'])->name('password.reset');
    // End Customize Password Reset

    Route::get('new_registered', [UserController::class, 'firstTime'])->name('first.time')->middleware(['auth', 'two-factor.auth', 'XSS']);

    Route::get('/', [HomeController::class, 'index'])->middleware(['XSS']);
    Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware(['XSS']);

    // Change Password for first time
    Route::get('/change-password', [HomeController::class, 'changePassword'])->name('change.password')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::post('/update-password', [HomeController::class, 'updatePassword'])->name('update.password')->middleware(['auth', 'two-factor.auth']);

    // View as Public Mode
    Route::get('/public', [HomeController::class, 'viewAsPublic'])->name('view.as.public')->middleware(['auth', 'two-factor.auth', 'XSS']);

    // User Module
    Route::get('profile', [UserController::class, 'profile'])->name('profile')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::post('profile', [UserController::class, 'updateProfile'])->name('update.profile')->middleware(['auth', 'two-factor.auth', 'XSS']);
    // End User Module

    Route::get('docs/add/newDoc', [UserController::class, 'docPopup'])->name('docs.popup')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::get('docs/{doc}/grid/{order?}', [UserController::class, 'docsGridIndex'])->name('docs.grid.index')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::get('docs/detail/{docId}', [UserController::class, 'docDetail'])->name('docs.view')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::get('docs/{doc}/{order?}', [UserController::class, 'docsIndex'])->name('docs.index')->middleware(['auth', 'two-factor.auth', 'XSS']);

    Route::get('batch/{table}/grid', [UserController::class, 'batchGridDetail'])->name('batch.grid.detail')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::get('batch/{table}', [UserController::class, 'batchDetail'])->name('batch.detail')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::get('batch_form/{table}/{batch}', [UserController::class, 'batchFormDetail'])->name('batch.form.detail')->middleware(['auth', 'two-factor.auth', 'XSS']);

    Route::get('eforms/view/{id}', [UserController::class, 'eFormDetail'])->name('eforms.view')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::get('forms/view/{view?}/{order?}', [UserController::class, 'formIndex'])->name('forms.index')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::get('forms/{id}', [UserController::class, 'formDetail'])->name('forms.view')->middleware(['auth', 'two-factor.auth', 'XSS']);

    // Site Setting
    Route::post('/message/data/{lang}', [SettingsController::class, 'storeMsgData'])->name('message.store.data')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::post('/settings', [SettingsController::class, 'store'])->name('settings.store')->middleware(['auth', 'two-factor.auth']);
    Route::delete('settings/poweredby/delete', [SettingsController::class, 'deletePoweredBy'])->name('settings.poweredby.destroy')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::delete('settings/smalllogo/delete', [SettingsController::class, 'deleteSmallLogo'])->name('settings.smalllogo.destroy')->middleware(['auth', 'two-factor.auth', 'XSS']);

    // Send Test Email
    Route::post('/checkMail', [SettingsController::class, 'testEmail'])->name('test.email')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::post('/checkMail/send', [SettingsController::class, 'testEmailSend'])->name('test.email.send')->middleware(['auth', 'two-factor.auth', 'XSS']);

    // Calendar
    Route::put('/calendar/{calendar}/drag', [CalendarController::class, 'calendarDrag'])->name('calendar.drag')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::resource('calendar', CalendarController::class)->middleware(['auth', 'two-factor.auth']);

    // Activity
    Route::get('activity/{order?}', [ActivityController::class, 'index'])->name('activity.index')->middleware(['auth', 'two-factor.auth', 'XSS']);

    // Notifications
    Route::get('notification/{order?}', [UserNotificationController::class, 'index'])->name('notification.index')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::get('notification/mark/read', [UserNotificationController::class, 'markNotification'])->name('notification.mark.read')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::post('notification/mark/user/read/{userNotification?}', [UserNotificationController::class, 'markAsRead'])->name('notification.mark.user.read')->middleware(['auth', 'two-factor.auth', 'XSS']);

    // Module Permission Assingment
    Route::post('moduleAssignment', [ModulePermissionAssignmentController::class, 'storePermissions'])->name('moduleAssignment.store.permissions')->middleware(['auth', 'two-factor.auth', 'XSS']);

    // FAQ
    Route::resource('faq', FaqController::class)->middleware(['auth', 'two-factor.auth']);
    Route::get('help-center', [FaqController::class, 'helpCenter'])->name('help.center')->middleware(['auth', 'two-factor.auth']);

    // FOLDER
    Route::get('folders', [FolderController::class, 'index'])->name('folder.index')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::match(['get', 'post'], 'folders/details/{encodeFolderName}', [FolderController::class, 'folderDetail'])->name('folder.view')->middleware(['auth', 'two-factor.auth', 'XSS'])->where('name', '.*');
    Route::match(['get', 'post'], 'folder/{encodeFolderName}/{id?}', [FolderController::class, 'folderFilter'])->name('folder.filter')->middleware(['auth', 'two-factor.auth', 'XSS'])->where('name', '.*');
    Route::get('folders/{encodeFolderName}/detail/{repositoryName}/{id}', [FolderController::class, 'folderListingDetail'])->name('folder.detail')->middleware(['auth', 'two-factor.auth', 'XSS'])->where('folder', '.*');
    Route::post('folders/document/get', [FolderController::class, 'folderGetDocument'])->name('folder.document.get')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::post('folder/SearchDatumsFilter/clear', [FolderController::class, 'clearSearchDatumsFilter'])->name('folder.SearchDatums.clear')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::get('get-repository/{repositoryName}/{id?}/{type?}', [FolderController::class, 'repoDetails'])->name('folder.repo.get')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::post('new-document-upload/{repositoryName}', [FolderController::class, 'addNewDoc'])->name('folder.document.upload')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::post('update-document-properties/{repositoryName}/{id}', [FolderController::class, 'updateDocProprties'])->name('folder.document.update')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::post('add-session-openDocProps/{id}', [FolderController::class, 'addOpenDocPropsToSession'])->name('add.OpenDocPropToSession')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::post('remove-session-openDocProps/{id}', [FolderController::class, 'removeOpenDocPropsToSession'])->name('remove.OpenDocPropToSession')->middleware(['auth', 'two-factor.auth', 'XSS']);

    // Share Document & Batch
    Route::get('share/{app}/{id}/{type}', [UserController::class, 'share'])->name('share.create')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::post('share/store/{type}', [UserController::class, 'shareStore'])->name('share.store')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::post('share/users/list', [UserController::class, 'getUsersToShare'])->name('share.users.list')->middleware(['auth', 'two-factor.auth', 'XSS']);

    // TASKS
    //  You have to sort your routes because laravel checks the order of the routes.
    // If tasks.view is before tasks.taskDetail, the route will go to tasks.view
    Route::get('tasks', [TaskController::class, 'index'])->name('tasks.index')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::post('tasks/SearchDatumsTaskFilter/clear', [TaskController::class, 'clearSearchDatumsTaskFilter'])->name('tasks.SearchDatums.clear')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::get('tasks/{encodeTaskName}/eform/{title}/detail/{batchId}', [TaskController::class, 'taskEformDetail'])->name('tasks.eform.detail')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::get('tasks/{encodeTaskName}/{title}/detail/{batchId}', [TaskController::class, 'taskListingDetail'])->where('title', '.*')->name('tasks.detail')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::post('task/detail/fetchData', [TaskController::class, 'fetchData'])->name('task.fetchData')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::post('task/fetchdetail/detail', [TaskController::class, 'fetchDetail'])->name('task.fetchDetail')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::post('tasks/file', [TaskController::class, 'getFile'])->name('tasks.get-file')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::match(['get', 'post'], 'tasks/details/{encodeTaskName}', [TaskController::class, 'taskDetail'])->name('tasks.taskDetail')->middleware(['auth', 'two-factor.auth', 'XSS'])->where('name','.*');
    Route::match(['get', 'post'], 'tasks/{encodeTaskName}/{id?}', [TaskController::class, 'taskFilter'])->name('tasks.view')->middleware(['auth', 'two-factor.auth', 'XSS'])->where('name', '.*');

    // HOME PAGE LAYOUTS
    Route::post('layout/order', [LayoutController::class, 'order'])->name('layout.order')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::post('layout/getSource', [LayoutController::class, 'getSource'])->name('layout.getsource')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::resource('layout', LayoutController::class)->middleware(['auth', 'two-factor.auth', 'XSS']);

    // Navigation
    Route::post('navigation/order', [NavigationController::class, 'order'])->name('navigation.order')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::resource('navigation', NavigationController::class)->except('show')->middleware(['auth', 'two-factor.auth', 'XSS']);

    // Layout & Navigation
    Route::get('layout_navigation_create', [LayoutNavigationController::class, 'create'])->name('layout.navigation.create')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::get('layout_navigation_colorSelect', [LayoutNavigationController::class, 'colorSelect'])->name('layout.navigation.colorSelect')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::post('layout_navigation_store', [LayoutNavigationController::class, 'store'])->name('layout.navigation.store')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::get('layout_navigation_edit/{layoutDefinition}', [LayoutNavigationController::class, 'edit'])->name('layout.navigation.edit')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::post('layout_navigation_update/{layoutDefinition}', [LayoutNavigationController::class, 'update'])->name('layout.navigation.update')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::delete('layout_navigation_delete/{layoutDefinition}', [LayoutNavigationController::class, 'delete'])->name('layout.navigation.delete')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::post('layout_navigation_load', [LayoutNavigationController::class, 'loadView'])->name('navigation_load.view')->middleware(['auth', 'two-factor.auth']);
    Route::get('update_layout/{id}', [LayoutNavigationController::class, 'updateLayout'])->name('update.layout.store')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::get('getUserSecurityGroup', [LayoutNavigationController::class, 'getUserSecurityGroup'])->name('securitygroup')->middleware(['auth', 'two-factor.auth', 'XSS']);

    // Custom HTML Page
    Route::get('custom-page/{navigation}', [NavigationController::class, 'customPage'])->name('custom.page')->middleware(['auth', 'two-factor.auth', 'XSS']);

    // Save Notes
    Route::post('note/{id}', [UserController::class, 'addTaskNote'])->name('task.note.store')->middleware(['auth', 'two-factor.auth', 'XSS']);

    // Discussion
    Route::resource('discussion', DiscussionController::class)
        ->except([
            'index', 'show', 'edit', 'update', 'destroy', 'create',
        ])->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::get('discussion/create/{batchId}', [DiscussionController::class, 'create'])->name('discussion.create')->middleware(['auth', 'two-factor.auth', 'XSS']);

    // Call
    Route::resource('calls', CallController::class)->except(['show', 'create'])->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::get('calls/create/{batchId}', [CallController::class, 'create'])->name('calls.create')->middleware(['auth', 'two-factor.auth', 'XSS']);

    // Email
    Route::get('email/create/{batchId}', [UserController::class, 'emailCreate'])->name('emails.create')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::post('email/store', [UserController::class, 'emailStore'])->name('emails.store')->middleware(['auth', 'two-factor.auth']);

    // Language
    Route::get('/lang/change/{lang}', [UserController::class, 'changeLang'])->name('lang.change')->middleware(['auth', 'two-factor.auth', 'XSS']);

    // Get Breadcrumb
    Route::post('/breadcrumb', [UserController::class, 'getBreadcrumb'])->name('get.breadcrumb')->middleware('auth', 'two-factor.auth', 'XSS');

    // Get User List And Update
    Route::post('userlist', [UserController::class, 'userList'])->name('users.list')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::get('/user/create', [UserController::class, 'createUser'])->name('user.create')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::post('validate_user', [UserController::class, 'validateUser'])->name('validate.user')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::post('/user/store', [UserController::class, 'storeUser'])->name('user.store')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::get('/user/{user}/edit', [UserController::class, 'editUser'])->name('user.edit')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::post('/user/{user}/update', [UserController::class, 'updateUser'])->name('user.update')->middleware(['auth', 'two-factor.auth', 'XSS']);
    Route::post('/validate_user_edit', [UserController::class, 'validateUserEdit'])->name('validate.user.edit')->middleware(['auth', 'two-factor.auth', 'XSS']);

    // Rest Integration
    Route::post('integrations/{rest}', [RestIntegrationController::class, 'update'])->middleware(['auth', 'two-factor.auth', 'XSS']);

    Route::resource('integrations', RestIntegrationController::class)->except('show')->middleware(['auth', 'two-factor.auth', 'XSS']);

    Route::post('configuration_load', [RestIntegrationController::class, 'configurationLoadView'])->name('configuration_load.view')->middleware(['auth', 'two-factor.auth', 'XSS']);

    Route::post('configuration_test', [RestIntegrationController::class, 'configureTest'])->name('configure.test')->middleware(['auth', 'two-factor.auth', 'XSS']);

    Route::get('Integration/{view}/{restIntegration}', [RestIntegrationController::class, 'restIntegartionSearchlist'])->name('integration.list')->middleware(['auth', 'two-factor.auth', 'XSS']);

    Route::match(['get', 'post'], 'Integrations/details/{restIntegration}', [RestIntegrationController::class, 'restIntegartionDetail'])->name('integration.detail')->middleware(['auth', 'two-factor.auth', 'XSS']);

    Route::match(['get', 'post'], 'Integrations/Basic/details', [RestIntegrationController::class, 'restIntegartionBasicDetail'])->name('integration.basic.detail')->middleware(['auth', 'two-factor.auth', 'XSS']);

    // Court Case Presentation

    Route::get('CourtCase/detail/{name}/{batchId}', [CourtCasesPresentationController::class, 'courtcasesDetails'])->name('courtcase.detail')->middleware(['auth', 'two-factor.auth', 'XSS']);

    Route::get('CourtCase/history/{number}/{batchId}', [CourtCasesPresentationController::class, 'courtcasesHistoryView'])->name('courtcase.history')->middleware(['auth', 'two-factor.auth', 'XSS']);

    Route::post('CourtCase/note/{id}', [CourtCasesPresentationController::class, 'addCaseNote'])->name('courtcase.note.store')->middleware(['auth', 'two-factor.auth', 'XSS']);

    Route::get('CourtCase/{name}/{id?}', [CourtCasesPresentationController::class, 'index'])->name('courtcase.list')->middleware(['auth', 'two-factor.auth', 'XSS']);

    // custom pages

    Route::resource('CustomPages', CustomPagesController::class)->except([
        'index',
    ])
        ->parameters(['CustomPages' => 'customPage'])
        ->middleware(['auth', 'two-factor.auth']);

    Route::resource('tenant', TenantController::class)
        ->parameters(['tenant' => 'selectedTenant'])
        ->middleware(['auth', 'two-factor.auth']);

    Route::post('validate_tenant', [TenantController::class, 'validateTenant'])->name('validate.tenant')->middleware(['auth', 'two-factor.auth', 'XSS']);

    // News feed
    Route::resource('newsfeed', NewsfeedsController::class)->middleware(['auth', 'two-factor.auth'])->except(['show', 'list']);

    Route::get('newspage/{navigation}', [NavigationController::class, 'newsfeedPage'])->name('newsfeed.page')->middleware(['auth', 'two-factor.auth', 'XSS']);

    Route::get('newsfeed/{id}', [NewsfeedsController::class, 'show'])->name('newsfeed.show')->middleware(['auth', 'two-factor.auth', 'XSS']);

    Route::get('newsfeed/list/all', [NewsfeedsController::class, 'list'])->name('newsfeed.list')->middleware(['auth', 'two-factor.auth', 'XSS']);

    //dashboards
    Route::get('dashboards/view/{view?}/{order?}', [DashboardController::class, 'index'])->name('dashboards.index')->middleware(['auth', 'two-factor.auth', 'XSS']);

    Route::get('dashboards/detail/{param}', [DashboardController::class, 'detail'])->name('dashboards.detail')->middleware(['auth', 'two-factor.auth', 'XSS']);
});
