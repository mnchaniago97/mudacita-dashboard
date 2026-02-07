<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Program;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        Program::insert([
            [
                'name' => 'Rumah Baca Eduva',
                'pilar' => 'pendidikan',
                'description' => 'Program literasi anak',
            ],
            [
                'name' => 'MCI Socio Project',
                'pilar' => 'sosial',
                'description' => 'Program sosial masyarakat',
            ],
            [
                'name' => 'MCI Green',
                'pilar' => 'lingkungan',
                'description' => 'Program peduli lingkungan',
            ],
        ]);
    }
}
