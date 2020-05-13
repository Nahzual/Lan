<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $this->call(MaterialSeeder::class);
      $this->call(LocationSeeder::class);
	$this->call(UserSeeder::class);
      factory(App\Game::class, 50)->create();
    }
}
