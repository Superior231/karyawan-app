<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::create([
            'name' => 'Dilraba Dilmurat',
            'position' => 'Frontend Developer',
            'email' => 'dilraba@example.com',
            'phone' => '08123456789',
            'address' => 'Chengdu, China',
            'status' => 'active',
            'joined_at' => now()
        ]);

        Employee::create([
            'name' => 'John',
            'position' => 'Backend Developer',
            'email' => 'john@example.com',
            'phone' => '081234512312',
            'address' => 'Jalan Raya, No. 123',
            'status' => 'active',
            'joined_at' => now()
        ]);

        Employee::create([
            'name' => 'Albert',
            'position' => 'Data Scientist',
            'email' => 'albert@example.com',
            'phone' => '0803127123',
            'address' => 'Jalan Raya, No. 123',
            'status' => 'inactive',
            'joined_at' => now()
        ]);

        Employee::create([
            'name' => 'Justina Xie Chuling',
            'position' => 'Data Scientist',
            'email' => 'xcl0624@example.com',
            'phone' => '0803127123',
            'address' => 'Chengdu, China',
            'status' => 'active',
            'joined_at' => now()
        ]);
    }
}
