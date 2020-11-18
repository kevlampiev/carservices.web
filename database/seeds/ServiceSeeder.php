<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        factory(App\Models\Service::class, 15)->create();
    }
}
