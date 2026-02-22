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

/*
|--------------------------------------------------------------------------
| Domain-Based Routing Configuration
|--------------------------------------------------------------------------
| Konfigurasi untuk memisahkan akses berdasarkan subdomain:
| - mudacita.or.id (domain utama) -> Website Publik
| - app.mudacita.or.id -> Dashboard Admin
*/

// Subdomain routing untuk dashboard (app.mudacita.or.id)
Route::domain('app.' . env('DASHBOARD_DOMAIN', 'mudacita.or.id'))->group(function () {
    require __DIR__.'/dashboard.php';
});

// Routes untuk domain utama (public website) - mudacita.or.id
// Scoped to main domain only to prevent access from subdomains
Route::domain(env('DASHBOARD_DOMAIN', 'mudacita.or.id'))->group(function () {

    // Auth Routes
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.process');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.process');

    // Public Pages
    Route::get('/', function () {
        $appSettings = \App\Models\Setting::first();
        return view('public.home', compact('appSettings'));
    })->name('home');

    Route::get('/tentang', function () {
        $appSettings = \App\Models\Setting::first();
        return view('public.about', compact('appSettings'));
    })->name('about');

    Route::get('/program', function () {
        $appSettings = \App\Models\Setting::first();
        return view('public.program', compact('appSettings'));
    })->name('program');

// Program detail public pages
Route::get('/program/{type}', function ($type) {
    $appSettings = \App\Models\Setting::first();

    $programs = [
        'pendidikan' => [
            'title' => $appSettings->pilar1_title ?? 'Pendidikan & Literasi',
            'subtitle' => $appSettings->pilar1_subtitle ?? 'Rumah Baca Eduva',
            'description' => $appSettings->pilar1_description ?? 'Memperkuat akses pendidikan berkualitas dan meningkatkan literasi untuk generasi muda Indonesia.',
            'image' => 'assets/images/banner/mudacita1.jpg',
            'tags' => ['Literasi', 'Anak', 'Rumah Baca'],
            'features' => [
                ['icon' => 'feather-book-open', 'title' => 'Ruang Belajar', 'text' => 'Menyediakan ruang belajar yang inklusif dan mendukung tumbuh kembang anak.'],
                ['icon' => 'feather-users', 'title' => 'Relawan Mentor', 'text' => 'Melibatkan relawan untuk mendampingi proses belajar dan aktivitas literasi.'],
                ['icon' => 'feather-award', 'title' => 'Kualitas Pendidikan', 'text' => 'Meningkatkan kualitas pembelajaran melalui program yang terukur.'],
            ],
        ],
        'sosial' => [
            'title' => $appSettings->pilar2_title ?? 'Sosial & Kemanusiaan',
            'subtitle' => $appSettings->pilar2_subtitle ?? 'MCI Socio Project',
            'description' => $appSettings->pilar2_description ?? 'Menggerakkan kepedulian sosial dan kemanusiaan untuk membantu mereka yang membutuhkan.',
            'image' => 'assets/images/banner/mudacita2.jpg',
            'tags' => ['Aksi Sosial', 'Kemanusiaan', 'Solidaritas'],
            'features' => [
                ['icon' => 'feather-heart', 'title' => 'Aksi Kemanusiaan', 'text' => 'Program bantuan untuk keluarga rentan dan komunitas terdampak.'],
                ['icon' => 'feather-activity', 'title' => 'Respons Cepat', 'text' => 'Gerak cepat dalam situasi darurat dengan dukungan relawan.'],
                ['icon' => 'feather-share-2', 'title' => 'Kolaborasi', 'text' => 'Bersinergi dengan komunitas lokal dan mitra strategis.'],
            ],
        ],
        'lingkungan' => [
            'title' => $appSettings->pilar3_title ?? 'Lingkungan',
            'subtitle' => $appSettings->pilar3_subtitle ?? 'MCI Green',
            'description' => $appSettings->pilar3_description ?? 'Melestarikan lingkungan melalui aksi nyata dan edukasi kesadaran hijau.',
            'image' => 'assets/images/banner/mudacita3.jpg',
            'tags' => ['Edukasi', 'Hijau', 'Aksi Nyata'],
            'features' => [
                ['icon' => 'feather-sun', 'title' => 'Kampanye Hijau', 'text' => 'Mendorong aksi kecil sehari-hari yang berdampak besar.'],
                ['icon' => 'feather-wind', 'title' => 'Konservasi', 'text' => 'Kegiatan konservasi dan pengelolaan sampah berbasis komunitas.'],
                ['icon' => 'feather-globe', 'title' => 'Edukasi Lingkungan', 'text' => 'Pelatihan dan edukasi kesadaran ekologis.'],
            ],
        ],
        'digital' => [
            'title' => $appSettings->pilar4_title ?? 'Transformasi Digital',
            'subtitle' => $appSettings->pilar4_subtitle ?? 'MCI Digital Impact',
            'description' => $appSettings->pilar4_description ?? 'Memperkuat kapasitas digital generasi muda untuk masa depan yang lebih cerah.',
            'image' => 'assets/images/banner/mudacita5.JPG',
            'tags' => ['Literasi Digital', 'Inovasi', 'Teknologi'],
            'features' => [
                ['icon' => 'feather-monitor', 'title' => 'Pelatihan Digital', 'text' => 'Kelas keterampilan digital untuk meningkatkan daya saing.'],
                ['icon' => 'feather-code', 'title' => 'Inovasi', 'text' => 'Mendorong inovasi berbasis teknologi untuk solusi sosial.'],
                ['icon' => 'feather-shield', 'title' => 'Keamanan Digital', 'text' => 'Edukasi literasi digital yang aman dan bertanggung jawab.'],
            ],
        ],
    ];

    if (!array_key_exists($type, $programs)) {
        abort(404);
    }

    $program = $programs[$type];

    $galleryTitle = $appSettings->{'program_' . $type . '_gallery_title'} ?? 'Kegiatan Unggulan';
    $gallerySubtitle = $appSettings->{'program_' . $type . '_gallery_subtitle'} ?? ('Cerita aksi nyata dari program ' . $program['subtitle']);
    $galleryBtnText = $appSettings->{'program_' . $type . '_gallery_btn_text'} ?? 'Lihat Semua';
    $galleryBtnUrl = $appSettings->{'program_' . $type . '_gallery_btn_url'} ?? route('program');

    $galleryItems = [];
    for ($i = 1; $i <= 3; $i++) {
        $title = $appSettings->{'program_' . $type . '_gallery_item' . $i . '_title'} ?? ('Kegiatan ' . $i);
        $desc = $appSettings->{'program_' . $type . '_gallery_item' . $i . '_description'} ?? 'Kolaborasi bersama relawan dan komunitas lokal untuk memperluas dampak positif.';
        $imagePath = $appSettings->{'program_' . $type . '_gallery_item' . $i . '_image'} ?? null;
        $image = $imagePath ? asset('storage/' . $imagePath) : asset('assets/images/banner/mudacita' . ($i + 1) . '.jpg');
        $url = $appSettings->{'program_' . $type . '_gallery_item' . $i . '_url'} ?? route('program');

        $galleryItems[] = [
            'title' => $title,
            'description' => $desc,
            'image' => $image,
            'url' => $url,
        ];
    }

    $gallery = [
        'title' => $galleryTitle,
        'subtitle' => $gallerySubtitle,
        'button_text' => $galleryBtnText,
        'button_url' => $galleryBtnUrl,
        'items' => $galleryItems,
    ];

    $activities = \App\Models\Activity::with('program')
        ->whereHas('program', fn($q) => $q->where('pilar', $type))
        ->latest()
        ->take(3)
        ->get();

    return view('public.program-detail', compact('appSettings', 'program', 'type', 'gallery', 'activities'));
})->name('program.detail');

Route::get('/program/detail/{type}', function ($type) {
    return redirect()->route('program.detail', $type);
})->name('program.show');

Route::get('/program/{type}/kegiatan', [\App\Http\Controllers\Program\ActivityController::class, 'publicIndex'])->name('public.activities.index');
Route::get('/kegiatan/{activity}', [\App\Http\Controllers\Program\ActivityController::class, 'publicShow'])->name('public.activities.show');

Route::get('/news', [\App\Http\Controllers\News\NewsController::class, 'publicIndex'])->name('public.news');

Route::get('/news/{slug}', [\App\Http\Controllers\News\NewsController::class, 'publicShow'])->name('public.news.detail');

Route::get('/kontak', function () {
    $appSettings = \App\Models\Setting::first();
    return view('public.kontak', compact('appSettings'));
})->name('kontak');

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
    return view('public.success');
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

});
