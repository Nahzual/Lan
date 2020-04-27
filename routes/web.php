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
Route::post('/home', 'PageController@homeLanList');

Route::get('/contact', 'PageController@contact')->name('contact');
Route::get('/contactus', 'PageController@contact')->name('contact');


/*LOGGED ROUTES*/
Route::delete('/lan/game/{id}','LansController@removeGame')->name('lan.remove_game');
Route::get('/lan/game/{id}','LansController@addGame')->name('lan.add_game');
Route::post('/lan/game/{id}','LansController@postAddGame');
Route::resource('lan', 'LansController');

// player participation
Route::get('lan/participate/{id}', 'LansController@participate')->name('lan.participate');
Route::post('lan/participate/{id}', 'LansController@postParticipate');
Route::delete('lan/participate/{id}', 'LansController@removePlayer');

// helper participation
Route::get('lan/helper/{id}', 'LansController@addHelper')->name('lan.add_helper');
Route::post('lan/helper/{id}', 'LansController@postAddHelper');
Route::delete('lan/helper/{id}', 'LansController@removeHelper');

// admin participation
Route::get('lan/admin/{id}', 'LansController@addAdmin')->name('lan.add_admin');
Route::post('lan/admin/{id}', 'LansController@postAddAdmin');
Route::delete('lan/admin/{id}', 'LansController@removeAdmin');

Route::get('/dashboard', 'LansController@index')->name('dashboard');

// game routes
Route::get('/game/favourite/','GamesController@showFavouriteGames')->name('game.favourite');
Route::resource('game', 'GamesController');
Route::post('/game/favourite/{id}','GamesController@addToFavourite')->name('game.add_favourite');
Route::delete('/game/favourite/{id}','GamesController@removeFromFavourite')->name('game.remove_favourite');
Route::get('/search/game','GamesController@search');

Route::resource('tournament', 'TournamentsController');
Route::resource('tournament/round', 'RoundsController');
Route::resource('tournament/round/match', 'MatchesController');


/*LAN HELPER ROUTES*/
Route::resource('shopping', 'ShoppingsController');
Route::resource('material', 'MaterialsController');
Route::resource('task', 'TasksController');
//Route::resource('activity', 'ActivitiesController');



/*LAN ADMIN ROUTES*/

/*GLOBAL ADMIN ROUTES*/

Route::resource('user', 'UsersController');
Route::get('search/user/', 'UsersController@search');

Route::get('/az', function(){
	$t = App\Lan::all()->first();
	dd($t->location());
});
