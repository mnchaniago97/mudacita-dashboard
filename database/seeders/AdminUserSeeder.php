<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $role = Role::firstOrCreate([
            'name' => 'super_admin'
        ]);

        User::updateOrCreate(
            ['email' => 'admin@mudacita.or.id'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'role_id' => $role->id,
            ]
        );
    }
}
