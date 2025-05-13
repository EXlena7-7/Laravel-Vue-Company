<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $employees = [
            [
                'name' => 'Leonel Hills',
                'email' => 'Imarquardt@carter.info',
                'phone' => '+13029355976',
                'department_id' => 1,

            ],
            [
                'name' => 'Chloe Boyer II',
                'email' => 'xkreiger@gmail.com',
                'phone' => '+14709627971',
                'department_id' => 2,
            ],
            [
                'name' => 'Prof. Leta Walter Jr.',
                'email' => 'tzulauf@gmail.com',
                'phone' => '+15314049707',
                'department_id' => 3,
            ],
            [
                'name' => 'Prof. Fleta Stark DDS',
                'email' => 'nikko.dare@graham.info',
                'phone' => '+12767397489',
                'department_id' => 4,
            ],
            [
                'name' => 'Prof. Jay Greenholt',
                'email' => 'raymond28@gmail.com',
                'phone' => '+19282241254',
                'department_id' => 5,
            ],
            [
                'name' => 'Natalia Jenkins',
                'email' => 'will59@towne.com',
                'phone' => '+10-65945642',
                'department_id' => 6,
            ]
        ];

        foreach ($employees as $employee) {
            Employee::create($employee);
        }
    }
}
