<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        Model::unguard();

        User::truncate();

        factory(User::class, 1)->create();
        Model::reguard();

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
