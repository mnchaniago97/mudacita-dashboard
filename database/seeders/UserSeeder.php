<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();

        User::firstOrCreate(
            ['email' => 'admin@mudacita.id'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('password'),
                'role_id' => $adminRole->id,
            ]
        );
    }
}
