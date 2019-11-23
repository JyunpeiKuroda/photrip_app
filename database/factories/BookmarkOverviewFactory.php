<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\BookmarkOverview;
use Faker\Generator as Faker;

$factory->define(BookmarkOverview::class, function (Faker $faker) {
    return [
        'main_bookmark_id' => factory(MainBookmark::class),
        'overview_title'   => $faker->overview_title,
        'overview_content' => $faker->overview_content
    ];
});
