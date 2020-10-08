<?php

use Illuminate\Database\Seeder;

class CarServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(\App\Models\CarServices::class, 40)->create();
    }
}
