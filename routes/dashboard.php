<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SDM\VolunteerController;
use App\Http\Controllers\SDM\ManagementController;
use App\Http\Controllers\SDM\RecruitmentController;
use App\Http\Controllers\SDM\VolunteerRecruitmentController;
use App\Http\Controllers\SDM\StaffPerformanceController;
use App\Http\Controllers\Wilayah\LocationController;
use App\Http\Controllers\Laporan\ReportController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Settings\SettingsController;
use App\Http\Controllers\Collaboration\CollaborationController;

/*
|--------------------------------------------------------------------------
| Dashboard & Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | SDM MODULE
    |--------------------------------------------------------------------------
    */
    Route::prefix('sdm')
        ->name('sdm.')
        ->group(function () {
            Route::resource('volunteers', VolunteerController::class);
            Route::resource('management', ManagementController::class);
            Route::get('management-performance', [StaffPerformanceController::class, 'index'])
                ->name('management-performance.index');
            Route::get('management-performance/{staffPerformance}/edit', [StaffPerformanceController::class, 'edit'])
                ->name('management-performance.edit')
                ->middleware('role:super_admin,superadmin');
            Route::post('management-performance', [StaffPerformanceController::class, 'store'])
                ->name('management-performance.store')
                ->middleware('role:super_admin,superadmin');
            Route::put('management-performance/{staffPerformance}', [StaffPerformanceController::class, 'update'])
                ->name('management-performance.update')
                ->middleware('role:super_admin,superadmin');
            Route::delete('management-performance/{staffPerformance}', [StaffPerformanceController::class, 'destroy'])
                ->name('management-performance.destroy')
                ->middleware('role:super_admin,superadmin');
            Route::resource('recruitment', RecruitmentController::class);
            Route::resource('volunteer-recruitment', VolunteerRecruitmentController::class)
                ->parameters(['volunteer-recruitment' => 'volunteerRecruitment']);
            Route::post('recruitment/{recruitment}/approve', [RecruitmentController::class, 'approve'])
                ->name('recruitment.approve');
            Route::post('recruitment/{recruitment}/reject', [RecruitmentController::class, 'reject'])
                ->name('recruitment.reject');
            Route::post(
                'volunteer-recruitment/{volunteerRecruitment}/approve',
                [VolunteerRecruitmentController::class, 'approve']
            )->name('volunteer-recruitment.approve');
            Route::post(
                'volunteer-recruitment/{volunteerRecruitment}/reject',
                [VolunteerRecruitmentController::class, 'reject']
            )->name('volunteer-recruitment.reject');
        });

    /*
    |--------------------------------------------------------------------------
    | KOLABORASI MODULE
    |--------------------------------------------------------------------------
    */
    Route::resource('collaborations', CollaborationController::class);

    /*
    |--------------------------------------------------------------------------
    | WILAYAH MODULE
    |--------------------------------------------------------------------------
    */
    Route::prefix('wilayah')
        ->name('wilayah.')
        ->group(function () {
            Route::resource('locations', LocationController::class);
        });

    /*
    |--------------------------------------------------------------------------
    | LAPORAN MODULE
    |--------------------------------------------------------------------------
    */
    Route::prefix('laporan')
        ->name('laporan.')
        ->group(function () {
            Route::resource('reports', ReportController::class);
        });

    /*
    |--------------------------------------------------------------------------
    | USER MODULE
    |--------------------------------------------------------------------------
    */
    Route::resource('users', UserController::class);
    Route::post('users/{user}/approve', [UserController::class, 'approve'])->name('users.approve');
    Route::post('users/{user}/reject', [UserController::class, 'reject'])->name('users.reject');
    Route::post('users/{user}/activate', [UserController::class, 'activate'])
        ->name('users.activate')
        ->middleware('role:super_admin,superadmin');
    Route::post('users/{user}/deactivate', [UserController::class, 'deactivate'])
        ->name('users.deactivate')
        ->middleware('role:super_admin,superadmin');

    /*
    |--------------------------------------------------------------------------
    | SETTINGS MODULE
    |--------------------------------------------------------------------------
    */
    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('settings/organization', [SettingsController::class, 'updateOrganization'])->name('settings.organization');
    Route::post('settings/account', [SettingsController::class, 'updateAccount'])->name('settings.account');
    Route::post('settings/notification', [SettingsController::class, 'updateNotification'])->name('settings.notification');
    Route::post('settings/system', [SettingsController::class, 'updateSystem'])->name('settings.system');
    Route::post('settings/home', [SettingsController::class, 'updateHome'])->name('settings.home');
});
