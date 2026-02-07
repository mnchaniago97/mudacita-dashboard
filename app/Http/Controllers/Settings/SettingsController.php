<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::first();

        if (!$settings) {
            $settings = Setting::create([
                'timezone' => 'Asia/Jakarta',
                'locale' => 'id',
                'whatsapp_enabled' => false,
                'whatsapp_url' => config('services.fonnte.url'),
            ]);
        }

        return view('pages.settings.index', [
            'settings' => $settings,
            'user' => Auth::user(),
        ]);
    }

    public function updateOrganization(Request $request)
    {
        $request->validate([
            'org_name' => 'required|string',
            'org_email' => 'nullable|email',
            'org_phone' => 'nullable|string',
            'org_address' => 'nullable|string',
            'remove_org_logo' => 'nullable|boolean',
            'remove_org_favicon' => 'nullable|boolean',
        ]);

        $settings = Setting::firstOrFail();

        if ($request->boolean('remove_org_logo') && $settings->org_logo_path) {
            $this->deletePublicAsset($settings->org_logo_path);
            $settings->org_logo_path = null;
        }

        if ($request->boolean('remove_org_favicon') && $settings->org_favicon_path) {
            $this->deletePublicAsset($settings->org_favicon_path);
            $settings->org_favicon_path = null;
        }

        $settings->org_name = $request->org_name;
        $settings->org_email = $request->org_email;
        $settings->org_phone = $request->org_phone;
        $settings->org_address = $request->org_address;
        $settings->save();

        return back()->with('success', 'Profil organisasi diperbarui.');
    }

    public function updateAccount(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return back()->with('success', 'Akun admin diperbarui.');
    }

    public function updateNotification(Request $request)
    {
        $request->validate([
            'whatsapp_enabled' => 'nullable|boolean',
            'whatsapp_token' => 'nullable|string',
            'whatsapp_url' => 'nullable|url',
            'whatsapp_template' => 'nullable|string',
        ]);

        $settings = Setting::firstOrFail();
        $settings->whatsapp_enabled = $request->boolean('whatsapp_enabled');
        $settings->whatsapp_token = $request->whatsapp_token;
        $settings->whatsapp_url = $request->whatsapp_url;
        $settings->whatsapp_template = $request->whatsapp_template;
        $settings->save();

        return back()->with('success', 'Pengaturan notifikasi diperbarui.');
    }

    public function updateSystem(Request $request)
    {
        $request->validate([
            'timezone' => 'required|string',
            'locale' => 'required|string',
        ]);

        $settings = Setting::firstOrFail();
        $settings->timezone = $request->timezone;
        $settings->locale = $request->locale;
        $settings->save();

        return back()->with('success', 'Pengaturan sistem diperbarui.');
    }

    public function updateHome(Request $request)
    {
        $request->validate([
            'hero_title' => 'required|string',
            'hero_subtitle' => 'nullable|string',
            'hero_description' => 'nullable|string',
        ]);

        $settings = Setting::firstOrFail();

        $settings->hero_title = $request->hero_title;
        $settings->hero_subtitle = $request->hero_subtitle;
        $settings->hero_description = $request->hero_description;
        $settings->save();

        return back()->with('success', 'Hero halaman home diperbarui.');
    }

    private function deletePublicAsset(string $path): void
    {
        if (str_starts_with($path, 'assets/')) {
            $fullPath = public_path($path);
            if (file_exists($fullPath)) {
                @unlink($fullPath);
            }
            return;
        }

        $storagePath = public_path('storage/' . ltrim($path, '/'));
        if (file_exists($storagePath)) {
            @unlink($storagePath);
        }
    }

    private function storePublicImage(UploadedFile $file, string $prefix): string
    {
        $safeName = preg_replace('/[^A-Za-z0-9_.-]/', '_', $file->getClientOriginalName());
        $filename = $prefix . '_' . time() . '_' . $safeName;
        $destination = public_path('assets/images');

        if (!is_dir($destination) && !mkdir($destination, 0755, true) && !is_dir($destination)) {
            throw new \RuntimeException('Gagal membuat folder assets/images.');
        }
        if (!is_writable($destination)) {
            throw new \RuntimeException('Folder assets/images tidak bisa ditulis.');
        }

        $file->move($destination, $filename);

        return 'assets/images/' . $filename;
    }
}
