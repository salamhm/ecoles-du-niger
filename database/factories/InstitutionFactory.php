<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Institution;
use Faker\Generator as Faker;

$factory->define(Institution::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'initials' => $faker->word,
        'institution_type_id' => $faker->numberBetween(1, 4),
        'presentation' => $faker->realText(100),
        'city_id' => $faker->numberBetween(1, 8),
        'address' => $faker->streetName,
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
        'email' => $faker->email,
        'website' => $faker->url,

    ];
});
