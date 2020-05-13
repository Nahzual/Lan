<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			// create site admin account
			DB::table('users')->insert([
				'name'=>'admin',
				'lastname'=>'admin',
				'pseudo'=>'admin',
				'password'=>Hash::make('admin'),
				'email'=>'admin@gmail.com',
				'tel_user'=>'0123456789',
				'rank_user'=>config('ranks.SITE_ADMIN'),
				'location_id'=>'1',
				'theme'=>'0'
			]);
    }
}
