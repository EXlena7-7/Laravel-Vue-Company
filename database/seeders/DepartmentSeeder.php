<?php

namespace Database\Seeders;
use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

     //
    public function run(): void
    {
        Department::firstOrCreate([

            'name' => "Social Science Research Assistant",
        ]);
        Department::firstOrCreate([

            'name' => "Online Marketing Analyst",
        ]);
        Department::firstOrCreate([

            'name' => "Tank Car",
        ]);
        Department::firstOrCreate([

            'name' => "Physical Therapist Assistant",
        ]);
        Department::firstOrCreate([

            'name' => "Broadcast News Analyst",
        ]);
        Department::firstOrCreate([

            'name' => "Industrial-Organizational Psychologist ",
        ]);
    }
}
