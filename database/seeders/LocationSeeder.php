<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $country = Location::firstOrCreate([
            'name' => 'Indonesia',
            'type' => 'country',
        ]);

        $province = Location::firstOrCreate([
            'name' => 'Jawa Barat',
            'type' => 'province',
            'parent_id' => $country->id,
        ]);

        Location::firstOrCreate([
            'name' => 'Bandung',
            'type' => 'city',
            'parent_id' => $province->id,
        ]);
    }
}
