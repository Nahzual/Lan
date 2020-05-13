<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Country;
use App\City;
use App\Department;
use App\Street;
use App\Location;
use Faker\Generator as Faker;

$factory->define(Country::class, function (Faker $faker) {

    return [
       	'name_country' => $faker->unique()->country,
    ];

});

$factory->define(Department::class, function (Faker $faker) {

    return [
       	'name_department' => $faker->unique()->state,
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

$factory->define(Street::class, function (Faker $faker) {

    return [
       	'name_street' => $faker->unique()->streetName,
	'city_id' => rand(1,25),
    ];
});

$factory->define(Location::class, function (Faker $faker) {

    return [
       	'num_street' => rand(1,99),
	'street_id' => rand(1,25),
    ];
});
