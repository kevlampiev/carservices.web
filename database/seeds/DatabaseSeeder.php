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
        // $this->call(UserSeeder::class);
        $this->call(ServiceTypesSeeder::class);
        $this->call(CarServicesSeeder::class);
        $this->call(UsersSeeder::class);
    }
}
