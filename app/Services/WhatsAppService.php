<?php

namespace App\Services;

use App\Models\Management;
use App\Models\Setting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    private ?Setting $settings;
    private ?string $token;
    private ?string $url;
    private bool $enabled;

    public function __construct()
    {
        $this->settings = Setting::first();
        $this->token = $this->settings?->whatsapp_token ?: config('services.fonnte.token');
        $this->url = $this->settings?->whatsapp_url ?: config('services.fonnte.url');
        $this->enabled = $this->settings ? (bool) $this->settings->whatsapp_enabled : true;
    }

    public function sendToManagement(string $message): void
    {
        $phones = Management::query()
            ->whereNotNull('phone')
            ->pluck('phone')
            ->filter()
            ->map(fn ($phone) => $this->normalizePhone($phone))
            ->filter()
            ->unique();

        $this->sendToNumbers($phones, $message);
    }

    public function sendToPhone(?string $phone, string $message): void
    {
        $normalized = $this->normalizePhone($phone ?? '');
        if (!$normalized) {
            return;
        }

        $this->sendToNumbers([$normalized], $message);
    }

    public function sendToNumbers(iterable $numbers, string $message): void
    {
        if (!$this->enabled || empty($this->token) || empty($this->url)) {
            return;
        }

        foreach ($numbers as $phone) {
            if (empty($phone)) {
                continue;
            }

            try {
                Http::withHeaders([
                    'Authorization' => $this->token,
                ])->asForm()->post($this->url, [
                    'target' => $phone,
                    'message' => $message,
                ]);
            } catch (\Throwable $e) {
                Log::error('Failed to send WhatsApp notification', [
                    'phone' => $phone,
                    'error' => $e->getMessage(),
                ]);
            }
        }
    }

    private function normalizePhone(string $phone): ?string
    {
        $digits = preg_replace('/\D+/', '', $phone);
        if (empty($digits)) {
            return null;
        }

        if (str_starts_with($digits, '62')) {
            return $digits;
        }

        if (str_starts_with($digits, '0')) {
            return '62' . substr($digits, 1);
        }

        if (str_starts_with($digits, '8')) {
            return '62' . $digits;
        }

        return $digits;
    }
}
