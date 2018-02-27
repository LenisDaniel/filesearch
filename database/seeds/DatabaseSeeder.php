<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Department;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Model::unguard();

        User::truncate();
        Department::truncate();

        factory(User::class, 1)->create();
        $this->call(DefaultDepartment::class);
        Model::reguard();

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
