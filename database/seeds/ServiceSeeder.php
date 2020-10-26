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
//        for ($i=0;$i<10;$i++) {
//            $name = $faker->company;
//            DB::table('services')->insert([
//                'name' => $name,
//                'slug' => Str::slug($name),
//                'city' => $faker->city,
//                'address' => $faker->streetAddress,
//                'description' => $faker->realText(300),
//                'img_link' => $faker->imageUrl(),
//            ]);
//        }

    }
}
