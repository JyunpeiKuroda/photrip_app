<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Guide;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Guide::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class)->create()->id,
        'title' => substr($faker->text, 0, 20),
        'days' => substr($faker->text, 0, 10),
    ];
});
