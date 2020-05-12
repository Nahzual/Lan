<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Country;
use App\City;
use App\Department;
use Faker\Generator as Faker;

$factory->define(Country::class, function (Faker $faker) {

    return [
       	'name_country' => $faker->unique()->country,
    ];

});

$factory->define(Department::class, function (Faker $faker) {

    return [
       	'name_department' => $faker->unique()->city,
	'country_id' => rand(1,50),
    ];
});

$factory->define(City::class, function (Faker $faker) {

    return [
       	'name_city' => $faker->unique()->city,
	'zip_city' => rand(10000,99999),
	'department_id' => rand(1,25),
    ];
});
