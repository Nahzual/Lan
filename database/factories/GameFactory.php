<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\AppGame;
use Faker\Generator as Faker;

$factory->define(App\Game::class, function (Faker $faker) {
    return [
      'name_game' => $faker->sentence(2, true),
      'desc_game' => $faker->paragraph(),
      'release_date_game' => $faker->date($format = 'Y-m-d', $min = 'now'),
      'cost_game' => $faker->randomDigit,
      'is_multiplayer_game' => $faker->boolean,
    ];
});
