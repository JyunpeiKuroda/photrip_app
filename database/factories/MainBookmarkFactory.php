<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\MainBookmark;
use Faker\Generator as Faker;

$factory->define(MainBookmark::class, function (Faker $faker) {
    return [
        'bookmark_title' => $faker->sentence,
        'bookmark_days'  => $faker->sentence
    ];
});