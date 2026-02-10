<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'username' => 'Super Admin',
            'roles' => 'superadmin',
            'password' => Hash::make('superadmin1234'),
        ]);
        
        User::create([
            'name' => 'Admin',
            'username' => 'Admin',
            'roles' => 'admin',
            'password' => Hash::make('admin1234'),
        ]);
    }
}
