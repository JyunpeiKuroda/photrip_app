<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Guide;
use App\Models\Place;
use Faker\Generator as Faker;

$factory->define(Place::class, function (Faker $faker) {
    return [
        'guide_id' => str_random(12),
        'place' => substr($faker->text, 0, 10),
        'detail' => substr($faker->text, 0, 30),
        'schedule' => $faker->dateTime,
        'time' => $faker->time,
    ];
});