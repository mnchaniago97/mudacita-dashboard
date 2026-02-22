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
use App\Http\Controllers\Content\ContentController;

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
    Route::get('/admin', [DashboardController::class, 'index'])
        ->name('dashboard');
    
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard_alt');

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

    /*
    |--------------------------------------------------------------------------
    | KONTEN WEBSITE MODULE
    |--------------------------------------------------------------------------
    */
    Route::prefix('content')
        ->name('content.')
        ->group(function () {
            Route::get('/', [ContentController::class, 'index'])->name('index');
            Route::get('/home', [ContentController::class, 'showHome'])->name('home.show');
            Route::get('/home/edit', [ContentController::class, 'editHome'])->name('home.edit');
            Route::post('/home', [ContentController::class, 'updateHome'])->name('home.update');
            Route::get('/tentang', [ContentController::class, 'showTentang'])->name('tentang.show');
            Route::get('/tentang/edit', [ContentController::class, 'editTentang'])->name('tentang.edit');
            Route::post('/tentang', [ContentController::class, 'updateTentang'])->name('tentang.update');
            Route::get('/program/{type?}/show', [ContentController::class, 'showProgram'])->name('program.show');
            Route::get('/program/{type?}', [ContentController::class, 'editProgram'])->name('program.edit');
            Route::post('/program/{type}', [ContentController::class, 'updateProgram'])->name('program.update');
            Route::get('/news/show', [ContentController::class, 'showNews'])->name('news.show');
            Route::get('/news', [ContentController::class, 'editNews'])->name('news.edit');
            Route::post('/news', [ContentController::class, 'updateNews'])->name('news.update');
            Route::get('/kontak', [ContentController::class, 'showKontak'])->name('kontak.show');
            Route::get('/kontak/edit', [ContentController::class, 'editKontak'])->name('kontak.edit');
            Route::post('/kontak', [ContentController::class, 'updateKontak'])->name('kontak.update');
        });

    /*
    |--------------------------------------------------------------------------
    | NEWS MODULE
    |--------------------------------------------------------------------------
    */
    Route::prefix('manage/news')->name('news.')->group(function () {
        Route::get('/', [\App\Http\Controllers\News\NewsController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\News\NewsController::class, 'create'])->name('create');
        Route::post('/', [\App\Http\Controllers\News\NewsController::class, 'store'])->name('store');
        Route::get('/{news}/edit', [\App\Http\Controllers\News\NewsController::class, 'edit'])->name('edit');
        Route::put('/{news}', [\App\Http\Controllers\News\NewsController::class, 'update'])->name('update');
        Route::delete('/{news}', [\App\Http\Controllers\News\NewsController::class, 'destroy'])->name('destroy');

        // Categories
        Route::get('/categories', [\App\Http\Controllers\News\NewsController::class, 'categoriesIndex'])->name('categories.index');
        Route::get('/categories/create', [\App\Http\Controllers\News\NewsController::class, 'categoriesCreate'])->name('categories.create');
        Route::post('/categories', [\App\Http\Controllers\News\NewsController::class, 'categoriesStore'])->name('categories.store');
        Route::get('/categories/{category}/edit', [\App\Http\Controllers\News\NewsController::class, 'categoriesEdit'])->name('categories.edit');
        Route::put('/categories/{category}', [\App\Http\Controllers\News\NewsController::class, 'categoriesUpdate'])->name('categories.update');
        Route::delete('/categories/{category}', [\App\Http\Controllers\News\NewsController::class, 'categoriesDestroy'])->name('categories.destroy');
    });
});
