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

$factory->define(\App\Models\Services::class, function (Faker $faker) {
    $name = $faker->company;
    return [
        'name' => $name,
        'slug' => Str::slug($name),
        'city' => $faker->city,
        'address' => $faker->streetAddress,
        'description' => $faker->realText(300),
        'img_link' => $faker->imageUrl(),
    ];
});
