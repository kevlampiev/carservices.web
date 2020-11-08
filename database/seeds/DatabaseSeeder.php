<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TypesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(ServiceSeeder::class);
//        $this->call(ServiceTypeSeeder::class);
    }
}
