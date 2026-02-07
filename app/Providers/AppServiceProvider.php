<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (!Schema::hasTable('settings')) {
            View::share('appSettings', null);
            View::share('authRole', null);
            View::share('isAdmin', false);
            return;
        }

        $settings = Setting::first();
        if (!$settings) {
            View::share('appSettings', null);
            View::share('authRole', null);
            View::share('isAdmin', false);
            return;
        }

        config([
            'app.timezone' => $settings->timezone ?? config('app.timezone'),
            'app.locale' => $settings->locale ?? config('app.locale'),
        ]);

        if (!empty($settings->timezone)) {
            date_default_timezone_set($settings->timezone);
        }

        if (!empty($settings->locale)) {
            app()->setLocale($settings->locale);
        }

        View::share('appSettings', $settings);
        $roleName = Auth::check() ? (Auth::user()->role->name ?? null) : null;
        View::share('authRole', $roleName);
        $normalizedRole = $roleName ? preg_replace('/[^a-z0-9]/', '', strtolower($roleName)) : null;
        View::share('isAdmin', in_array($normalizedRole, ['superadmin', 'admin'], true));
    }
}
