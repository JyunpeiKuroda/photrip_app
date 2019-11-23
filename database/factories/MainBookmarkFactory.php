<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\MainBookmark;
use App\Model;
use Faker\Generator as Faker;

$factory->define(MainBookmark::class, function (Faker $faker) {
    return [
        'bookmark_title' => $faker->bookmark_title,
        'bookmark_days'  => $faker->bookmark_days
    ];
});