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

Route::resource('contact', 'ContactsController');


/*LOGGED ROUTES*/
Route::delete('/lan/game/{id}','LansController@removeGame')->name('lan.remove_game');
Route::get('/lan/game/{id}','LansController@addGame')->name('lan.add_game');
Route::post('/lan/game/{id}','LansController@postAddGame');
Route::resource('lan', 'LansController');
Route::get('/lans','LansController@index')->name('my_lans');


Route::delete('/lan/material/{id}','LansController@removeMaterial')->name('lan.remove_material');
Route::get('/lan/material/{id}','LansController@addMaterial')->name('lan.add_material');
Route::post('/lan/material/{id}','LansController@postAddMaterial');
Route::resource('lan', 'LansController');
Route::get('/lans','LansController@index')->name('my_lans');


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

Route::get('/dashboard', 'PageController@dashboard')->name('dashboard');

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

// Activities routes
Route::get('lan/{lan}/task/create', 'TaskController@create')->name('task.create');
Route::post('lan/{lan}/task/store', 'TaskController@store')->name('task.store');
Route::get('lan/{lan}/task/{task}/show', 'TaskController@show')->name('task.show');
Route::get('lan/{lan}/task/{task}/edit', 'TaskController@edit')->name('task.edit');
Route::delete('lan/{lan}/task/{task}/destroy', 'TaskController@destroy')->name('task.destroy');
Route::put('lan/{lan}/task/{task}/edit', 'TaskController@update')->name('task.update');

// Activities routes
Route::get('lan/{lan}/activity/create', 'ActivitiesController@create')->name('activity.create');
Route::post('lan/{lan}/activity/store', 'ActivitiesController@store')->name('activity.store');
Route::get('lan/{lan}/activity/{activity}/show', 'ActivitiesController@show')->name('activity.show');
Route::get('lan/{lan}/activity/{activity}/edit', 'ActivitiesController@edit')->name('activity.edit');
Route::delete('lan/{lan}/activity/{activity}/destroy', 'ActivitiesController@destroy')->name('activity.destroy');
Route::put('lan/{lan}/activity/{activity}/edit', 'ActivitiesController@update')->name('activity.update');


/*LAN ADMIN ROUTES*/

/*GLOBAL ADMIN ROUTES*/

Route::resource('user', 'UsersController');
Route::get('search/user/', 'UsersController@search');

Route::get('/az', function(){
	$t = App\Lan::all()->first();
	dd($t->location());
});
