<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\MainBookmark;
use Faker\Generator as Faker;

$factory->define(MainBookmark::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'days'  => $faker->sentence
    ];
});