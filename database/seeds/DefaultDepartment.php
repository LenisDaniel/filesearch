<?php

use Illuminate\Database\Seeder;
use App\Department;

class DefaultDepartment extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create([
            'department_name' => $name['category_name'],
            'remember_token' => str_random(40),
        ]);
    }
}
