<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Models\Service;

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

$factory->define(Service::class, function (Faker $faker) {
    $name = $faker->company;
    return [
        'name' => $name,
        'slug' => Str::slug($name),
        'city' => $faker->city,
        'address' => $faker->streetAddress,
        'description' => $faker->realText(300),
        'img_link' => $faker->imageUrl(),
        'phone' => $faker->phoneNumber,
        'email' => $faker->email,
        'site' => $faker->url,
        'telegram' => $faker->regexify('@[a-z]{4,15}'),
        'skype' => $faker->regexify('@[a-z]{4,15}')

    ];
});
