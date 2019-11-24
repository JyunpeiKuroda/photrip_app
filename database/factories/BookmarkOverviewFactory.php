<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\BookmarkOverview;
use App\Models\MainBookmark;
use Faker\Generator as Faker;

$factory->define(BookmarkOverview::class, function (Faker $faker) {
    return [
        'main_bookmark_id' => factory(MainBookmark::class)->create()->id,
        'overview'   => $faker->sentence,
        'content' => $faker->sentence
    ];
});
