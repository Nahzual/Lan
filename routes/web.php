<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



/* GUEST ROUTES */

Auth::routes();

Route::get('/', 'PageController@home')->name('home');
Route::get('/home', 'PageController@home')->name('home');

Route::get('/contact', 'PageController@contact')->name('contact');
Route::get('/contactus', 'PageController@contact')->name('contact');


/*LOGGED ROUTES*/
Route::resource('lan', 'LansController');
Route::get('/dashboard', 'LansController@index')->name('dashboard');
Route::resource('game', 'GamesController');
Route::resource('tournament', 'TournamentsController');
Route::resource('tournament/round', 'RoundsController');
Route::resource('tournament/round/match', 'MatchesController');


/*LAN HELPER ROUTES*/
Route::resource('shopping', 'ShoppingsController');
Route::resource('material', 'MaterialsController');
Route::resource('task', 'TasksController');

/*LAN ADMIN ROUTES*/

/*GLOBAL ADMIN ROUTES*/

Route::resource('user', 'UsersController');

Route::get('/az', function(){
	$t = App\Lan::all()->first();
	dd($t->location());
});
