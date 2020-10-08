<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(\App\Models\CarServices::class, function (Faker $faker) {
    $faker->locale('ru_RU');
    $name=$faker->name;
    return [
        'name' => $name,
        'slug' => Str::slug($name),
        'postcode' => $faker->numberBetween(100000,999999),
        'address'=>$faker->address,
        'description'=>$faker->realText(300),
        'img_link'=>$faker->imageUrl(),
    ];
});
