# Deployment Guide: Laravel Project ke Hostinger dengan GitHub

## Spesifikasi Domain
- **Domain Utama**: mudacita.or.id (Website Publik)
- **Subdomain**: app.mudacita.or.id (Dashboard Admin)

---

## Bagian 1: Persiapan GitHub

### 1.1 Buat Repository GitHub
1. Buka [GitHub](https://github.com) dan login
2. Klik tombol **New Repository**
3. Isi nama repository, contoh: `mudacita-dashboard`
4. Pilih **Public** atau **Private**
5. Klik **Create Repository**

### 1.2 Inisialisasi Git di Project Lokal
```bash
# Buka terminal di folder project
cd c:/project-laravel/mudacita-dashboard

# Inisialisasi git (jika belum ada)
git init

# Tambah remote repository
git remote add origin https://github.com/username/mudacita-dashboard.git

# Tambah semua file
git add .

# Commit pertama
git commit -m "Initial commit - Laravel project"

# Push ke GitHub
git branch -M main
git push -u origin main
```

---

## Bagian 2: Setup Hostinger hPanel

### 2.1 Tambahkan Domain Utama
1. Login ke [hPanel Hostinger](https://hpanel.hostinger.com)
2. Buka **Websites** → Pilih website Anda
3. Klik **Manage** → **DNS / DNS Zone**
4. Pastikan domain sudahpointing ke nameserver Hostinger

### 2.2 Tambahkan Subdomain
1. Di hPanel, cari menu **Subdomains**
2. Buat subdomain baru: `app.mudacita.or.id`
3. Document root: `/public_html/public` (sama dengan domain utama)

### 2.3 Konfigurasi File Manager
1. Buka **Files** → **File Manager**
2. Structure folder:
```
/public_html
  ├── (file public untuk domain utama)
  └── public
       └── (semua file Laravel public)
```

---

## Bagian 3: Konfigurasi Laravel untuk Subdomain

### 3.1 Update routes/web.php untuk subdomain routing

Buat middleware untuk menangani subdomain atau tambahkan kondisi di routes. Edit [`routes/web.php`](routes/web.php):

```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Subdomain routing untuk dashboard
Route::domain('app.mudacita.or.id')->group(function () {
    require __DIR__.'/dashboard.php';
});

// Routes untuk domain utama (public website)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.process');

Route::get('/', function () {
    $appSettings = \App\Models\Setting::first();
    return view('public.home', compact('appSettings'));
})->name('home');

// ... route public lainnya
```

### 3.2 Update config/app.php (Opsional untuk subdomain)
Tambahkan konfigurasi domain di [`config/app.php`](config/app.php):

```php
/*
|--------------------------------------------------------------------------
| Application Domain Config
|--------------------------------------------------------------------------
*/
'domain' => env('APP_DOMAIN', 'mudacita.or.id'),
'dashboard_domain' => env('DASHBOARD_DOMAIN', 'app.mudacita.or.id'),
```

### 3.3 Update .env untuk production
```env
APP_NAME=Mudacita
APP_ENV=production
APP_DEBUG=false
APP_URL=https://mudacita.or.id

DASHBOARD_URL=https://app.mudacita.or.id
```

---

## Bagian 4: Deploy ke Hostinger

### 4.1 Cara 1: Git Deployment (Disarankan)

#### Setup Git di Hostinger
1. Di hPanel, cari **Git** di menu website
2. Klik **Setup Git**
3. Pilih repository GitHub yang sudah dibuat
4. Branch: `main`
5. Deployment path: `/public_html`
6. Klik **Deploy**

#### Setup Auto-Deploy
1. Di pengaturan Git, enable **Auto Deploy**
2. Setiap push ke GitHub akan otomatis ter-deploy

### 4.2 Cara 2: Manual Upload

1. Download semua file dari GitHub (Code → Download ZIP)
2. Extract file di komputer
3. Upload via File Manager atau FTP ke `/public_html`
4. Pastikan folder `vendor`, `storage`, `bootstrap/cache` ter-upload

### 4.3 Konfigurasi Setelah Upload

1. **Setup .env**:
   - Edit file `.env` di File Manager
   - Sesuaikan database credentials dari hPanel

2. **Install dependencies** (jika perlu):
   - Buka **Terminal** di hPanel
   ```bash
   composer install --optimize-autoloader --no-dev
   ```

3. **Generate key**:
   ```bash
   php artisan key:generate
   ```

4. **Setup storage link**:
   ```bash
   php artisan storage:link
   ```

5. **Set permissions** (jika diperlukan):
   ```bash
   chmod -R 755 storage bootstrap/cache
   ```

6. **Clear cache**:
   ```bash
   php artisan config:clear
   php artisan cache:clear
   php artisan route:clear
   php artisan view:clear
   ```

---

## Bagian 5: Konfigurasi SSL (HTTPS)

### 5.1 Install SSL Gratis
1. Di hPanel, cari **SSL**
2. Klik **Secure Your Site** untuk domain utama
3. Pilih **Free SSL** (Let's Encrypt)
4. Install untuk:
   - `mudacita.or.id`
   - `*.mudacita.or.id` (untuk subdomain)

### 5.2 Force HTTPS
Tambahkan di [`public/.htaccess`](public/.htaccess):

```apache
# Force HTTPS
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

---

## Bagian 6: Verifikasi

### Checklist:
- [ ] Domain utama (mudacita.or.id) menampilkan website publik
- [ ] Subdomain (app.mudacita.or.id) menampilkan halaman login dashboard
- [ ] SSL ter-install untuk kedua domain
- [ ] assets (CSS, JS, images) loaded correctly
- [ ] Database connection berhasil

### Troubleshooting:

**Masalah: Subdomain tidak bisa akses**
- Pastikan subdomain sudah dibuat di hPanel
- Pastikan document root subdomain sama dengan domain utama

**Masalah: Assets tidak loaded**
- Cek storage link sudah dibuat
- Clear cache: `php artisan view:clear && php artisan cache:clear`

**Masalah: Database error**
- Cek credentials di .env sesuai dengan database di hPanel
- Pastikan database sudah dibuat dan di-import

---

## Struktur Folder di Hosting

Setelah deployment, struktur folder di `/public_html`:

```
/public_html
├── .env
├── artisan
├── composer.json
├── composer.lock
├── package.json
├── vendor/
├── bootstrap/
│   └── cache/
├── storage/
│   ├── app/
│   ├── framework/
│   │   ├── cache/
│   │   ├── sessions/
│   │   └── views/
│   └── logs/
├── public/  (jika public dipisah)
│   ├── index.php
│   ├── .htaccess
│   └── assets/
└── (file Laravel lainnya)
```

---

## Catatan Penting

1. **Backup**: Selalu backup sebelum deploy
2. **Database**: Export database dari local dan import ke hosting
3. **Environment**: Pastikan `APP_ENV=production` dan `APP_DEBUG=false`
4. **Queue/Scheduler**: Jika menggunakan queue, setup worker di cron

---

## Support

Jika ada pertanyaan atau masalah, cek:
- [Laravel Documentation](https://laravel.com/docs)
- [Hostinger Help Center](https://support.hostinger.com)
