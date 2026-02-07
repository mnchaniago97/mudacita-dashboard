<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Laporan\ReportController;
use App\Http\Controllers\Agenda\AgendaController;
use App\Http\Controllers\Program\ProgramController;
use App\Http\Controllers\Program\ActivityController;
use App\Http\Controllers\SDM\RecruitmentController;
use App\Http\Controllers\SDM\VolunteerRecruitmentController;
use App\Http\Controllers\Impact\ImpactController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.process');

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/recruitment/management', function () {
    return view('public.recruitment.management');
})->name('public.recruitment.management.create');
Route::post('/recruitment/management', [RecruitmentController::class, 'store'])
    ->name('public.recruitment.management.store');

Route::get('/recruitment/volunteer', function () {
    return view('public.recruitment.volunteer');
})->name('public.recruitment.volunteer.create');
Route::post('/recruitment/volunteer', [VolunteerRecruitmentController::class, 'store'])
    ->name('public.recruitment.volunteer.store');

Route::get('/recruitment/success', function () {
    return view('success');
})->name('public.recruitment.success');

Route::middleware(['auth'])->group(function () {
    Route::get('/reports', [ReportController::class, 'index'])->name('reports');
    Route::get('/impacts', [ImpactController::class, 'index'])->name('impacts.index');

    Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda.index');
    Route::post('/agenda', [AgendaController::class, 'store'])->name('agenda.store');
    Route::get('/agenda/create', [AgendaController::class, 'create'])->name('agenda.create');
    Route::get('/agenda/{agenda}/edit', [AgendaController::class, 'edit'])->name('agenda.edit');
    Route::put('/agenda/{agenda}', [AgendaController::class, 'update'])->name('agenda.update');
    Route::delete('/agenda/{agenda}', [AgendaController::class, 'destroy'])->name('agenda.destroy');
    Route::get('/agenda/{agenda}', [AgendaController::class, 'show'])->name('agenda.show');

    Route::get('/pilar-program/create', [ProgramController::class, 'create'])->name('program.create');
    Route::post('/pilar-program/store', [ProgramController::class, 'store'])->name('pilar.store');
    // Menggunakan parameter {pilar}
    Route::get('/pilar-program/{pilar}', [ProgramController::class, 'index'])->name('pilar.index');
    // Route baru untuk detail program
    Route::get('/program/detail/{program}', [ProgramController::class, 'show'])->name('pilar.show');
    Route::get('/pilar-program/{program}/edit', [ProgramController::class, 'edit'])->name('pilar.edit');
    Route::put('/pilar-program/{program}', [ProgramController::class, 'update'])->name('pilar.update');
    Route::delete('/pilar-program/{program}', [ProgramController::class, 'destroy'])->name('pilar.destroy');

    Route::resource('activity', ActivityController::class);

});

require __DIR__ . '/dashboard.php';
