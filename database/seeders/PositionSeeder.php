<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = [
            // Engineering & Tech
            ['name' => 'Software Engineer'],
            ['name' => 'Senior Machine Learning Engineer'],
            ['name' => 'Frontend Developer'],
            ['name' => 'Backend Developer'],
            ['name' => 'DevOps Engineer'],
            ['name' => 'Data Scientist'],
            ['name' => 'QA Automation Engineer'],
            
            // Human Resources (HRD)
            ['name' => 'HR Manager'],
            ['name' => 'Talent Acquisition Specialist'],
            ['name' => 'HR Operations'],
            
            // Product & Management
            ['name' => 'Product Manager'],
            ['name' => 'Project Manager'],
            ['name' => 'UI/UX Designer'],
            
            // Finance & Operations
            ['name' => 'Accountant'],
            ['name' => 'Operations Manager'],
            ['name' => 'Legal Counsel'],
        ];

        foreach ($positions as $position) {
            Position::create($position);
        }
    }
}
