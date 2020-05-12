<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Country;
use App\Department;
use App\City;

class LocationSeeder extends Seeder {
    public function run()
    {
		$p = factory(App\Country::class, 120)->create();
		$d = factory(App\Department::class, 50)->create();
		$c = factory(App\City::class, 50)->create();
		
    }
}
