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


Route::resource('contact', 'ContactsController');


/*LOGGED ROUTES*/

// Task routes
Route::get('lan/tasks', 'TasksController@all')->name('task.all');
Route::get('lan/{lan}/task/create', 'TasksController@create')->name('task.create');
Route::post('lan/{lan}/task/store', 'TasksController@store')->name('task.store');
Route::get('lan/{lan}/task/{task}/show', 'TasksController@show')->name('task.show');
Route::get('lan/{lan}/task/{task}/edit', 'TasksController@edit')->name('task.edit');

Route::get('lan/{lan}/task/{task}/assign', 'TasksController@addHelper')->name('task.add_helper');
Route::post('lan/{lan}/task/{task}/assign', 'TasksController@assign')->name('task.assign');
Route::delete('lan/{lan}/task/{task}/unassign', 'TasksController@unassign')->name('task.unassign');

Route::delete('lan/{lan}/task/{task}/destroy', 'TasksController@destroy')->name('task.destroy');
Route::put('lan/{lan}/task/{task}/edit', 'TasksController@update')->name('task.update');


// lan
Route::resource('lan', 'LansController');
Route::get('/lans/{id}/guest/show','LansController@guestShow')->name('lan.guest_show');
Route::get('/lans','LansController@index')->name('my_lans');
Route::get('/all_lans','LansController@list_all')->name('all_lans');
Route::post('/all_lans', 'PageController@allLansList');
Route::put('/lan/submit/{id}', 'LansController@submit');

Route::get('/lan/{lan}/games/','LansController@list_games')->name('lan.game_list');
Route::get('/lan/{lan}/games/{page}','LansController@list_games')->name('lan.game_list.page');

Route::get('/lan/{lan}/tasks/','LansController@list_tasks')->name('lan.task_list');
Route::get('/lan/{lan}/tasks/{page}','LansController@list_tasks')->name('lan.task_list.page');

Route::get('/lan/{lan}/materials/','LansController@list_materials')->name('lan.material_list');
Route::get('/lan/{lan}/materials/{page}','LansController@list_materials')->name('lan.material_list.page');


Route::get('/lan/{lan}/shoppings/','LansController@list_shoppings')->name('lan.shopping_list');
Route::get('/lan/{lan}/shoppings/{page}','LansController@list_shoppings')->name('lan.shopping_list.page');

Route::get('/lan/{lan}/users/','LansController@list_users')->name('lan.user_list');
Route::get('/lan/{lan}/users/{page}','LansController@list_users')->name('lan.user_list.page');

Route::get('/lan/{lan}/admins/','LansController@list_admins')->name('lan.admin_list');
Route::get('/lan/{lan}/admins/{page}','LansController@list_admins')->name('lan.admin_list.page');

Route::get('/lan/{lan}/helpers/','LansController@list_helpers')->name('lan.helper_list');
Route::get('/lan/{lan}/helpers/{page}','LansController@list_helpers')->name('lan.helper_list.page');

Route::get('/lan/{lan}/tournaments/','LansController@list_tournaments')->name('lan.tour_list');
Route::get('/lan/{lan}/tournaments/{page}','LansController@list_tournaments')->name('lan.tour_list.page');

Route::get('/lan/{lan}/activities/','LansController@list_activities')->name('lan.act_list');
Route::get('/lan/{lan}/activities/{page}','LansController@list_activities')->name('lan.act_list.page');

// game-lan
Route::delete('/lan/game/{id}','LansController@removeGame')->name('lan.remove_game');
Route::get('/lan/game/{id}','LansController@addGame')->name('lan.add_game');
Route::post('/lan/game/{id}','LansController@postAddGame');
Route::get('/lan/{lan}/game/{game}/port','GamesController@addPort')->name('game.add_ports');
Route::post('/lan/{lan}/game/{game}/port','GamesController@postAddPort');
Route::delete('/lan/{lan}/game/{game}/port','GamesController@removePort');


// material
Route::delete('/lan/material/{id}','LansController@removeMaterial')->name('lan.remove_material');
Route::get('/lan/material/{id}','LansController@addMaterial')->name('lan.add_material');
Route::post('/lan/material/{id}','LansController@postAddMaterial');
Route::put('/lan/material/{id}','LansController@editQuantity');

// shopping
Route::delete('/lan/shopping/{id}','LansController@removeShopping')->name('lan.remove_shopping');
Route::get('/lan/shopping/{id}','LansController@addShopping')->name('lan.add_shopping');
Route::post('/lan/shopping/{id}','LansController@postAddShopping');


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
Route::get('/dashboard/admin', 'PageController@adminDashboard');


// game routes
Route::get('/game/favourite/','GamesController@showFavouriteGames')->name('game.favourite');
Route::resource('game', 'GamesController');
Route::post('/game/favourite/{id}','GamesController@addToFavourite')->name('game.add_favourite');
Route::delete('/game/favourite/{id}','GamesController@removeFromFavourite')->name('game.remove_favourite');
Route::get('/search/game','GamesController@search')->name('game.search');

Route::get('lan/{lan}/tournament/create', 'TournamentsController@create')->name('tournament.create_tournament');
Route::post('lan/{lan}/tournament/store', 'TournamentsController@store')->name('tournament.store');
Route::get('lan/{lan}/tournament/{tournament}/show', 'TournamentsController@show')->name('tournament.show_tournament');
Route::get('lan/{lan}/tournament/{tournament}/edit', 'TournamentsController@edit')->name('tournament.edit_tournament');
Route::put('lan/{lan}/tournament/{tournament}/edit', 'TournamentsController@update')->name('tournament.update');
Route::delete('lan/{lan}/tournament/{tournament}/destroy', 'TournamentsController@destroy')->name('tournament.destroy');
Route::resource('tournament/round', 'RoundsController');
Route::resource('tournament/round/match', 'MatchesController');

// material search
Route::get('/search/material','MaterialsController@search');

// shopping search
Route::get('/search/shopping','ShoppingsController@search');

/*LAN HELPER ROUTES*/
Route::resource('material', 'MaterialsController');


// Shoppings routes
Route::get('lan/{lan}/shopping/create', 'ShoppingsController@create')->name('shopping.create');
Route::post('lan/{lan}/shopping/store', 'ShoppingsController@store')->name('shopping.store');

// Activities routes
Route::get('lan/{lan}/activity/create', 'ActivitiesController@create')->name('activity.create');
Route::get('lan/{lan}/activities', 'ActivitiesController@perLan')->name('activity.perLan');
Route::post('lan/{lan}/activity/store', 'ActivitiesController@store')->name('activity.store');
Route::get('lan/{lan}/activity/{activity}/show', 'ActivitiesController@show')->name('activity.show');
Route::get('lan/{lan}/activity/{activity}/edit', 'ActivitiesController@edit')->name('activity.edit');
Route::delete('lan/{lan}/activity/{activity}/destroy', 'ActivitiesController@destroy')->name('activity.destroy');
Route::put('lan/{lan}/activity/{activity}/edit', 'ActivitiesController@update')->name('activity.update');


/*LAN ADMIN ROUTES*/

/*GLOBAL ADMIN ROUTES*/

Route::resource('user', 'UsersController');
Route::get('search/user/', 'UsersController@search');
Route::get('search/helper/{task}', 'UsersController@searchHelper');

Route::get('/az', function(){
	$t = App\Lan::all()->first();
	dd($t->location());
});
Route::get('/m', function(){
	return(view('errors.m'));
});
