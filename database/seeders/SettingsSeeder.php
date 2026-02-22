<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        Setting::firstOrCreate(
            ['id' => 1],
            [
                'org_name' => 'Mudacita',
                'org_email' => 'info@mudacita.or.id',
                'org_phone' => '+62 123 4567 890',
                'org_address' => 'Jl. Contoh No. 123, Jakarta, Indonesia',
                'hero_title' => 'Membangun Masa Depan Indonesia',
                'hero_subtitle' => 'Mudacita - Membangun Negeri',
                'hero_description' => 'Organisasi nonprofit yang berkomitmen untuk meningkatkan kualitas pendidikan, keadilan sosial, pelestarian lingkungan, dan transformasi digital di Indonesia.',
            ]
        );
    }
}
