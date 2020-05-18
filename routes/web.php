<?php

use Illuminate\Support\Facades\Route;

/* ----------------- GUEST ROUTES ----------------- */

Auth::routes();
Route::get('/', 'PageController@home')->name('home');
Route::get('/home', 'PageController@home')->name('home');
Route::get('/privacy', 'PageController@privacy')->name('privacy');

Route::get('/contact','ContactsController@index')->name('contact.index');
Route::post('/contact','ContactsController@store')->name('contact.store');
Route::post('/contact/{user}','UsersController@contact');

/* ----------------- Tasks routes ----------------- */

//Show and list
Route::get('/lan/tasks/', 'TasksController@all')->name('task.all');
Route::get('/lan/{lan}/tasks/','LansController@list_tasks')->name('lan.task_list');
Route::get('/lan/{lan}/tasks/{page}','LansController@list_tasks')->name('lan.task_list.page');
Route::get('/lan/{lan}/task/{task}/show', 'TasksController@show')->name('task.show');

//Resource managment and related
Route::get('lan/{lan}/task/create', 'TasksController@create')->name('task.create');
Route::post('lan/{lan}/task/store', 'TasksController@store')->name('task.store');
Route::get('lan/{lan}/task/{task}/edit', 'TasksController@edit')->name('task.edit');
Route::delete('lan/{lan}/task/{task}/destroy', 'TasksController@destroy')->name('task.destroy');
Route::put('lan/{lan}/task/{task}/edit', 'TasksController@update')->name('task.update');

//Assign
Route::get('lan/{lan}/task/{task}/assign', 'TasksController@addHelper')->name('task.add_helper');
Route::post('lan/{lan}/task/{task}/assign', 'TasksController@assign')->name('task.assign');
Route::delete('lan/{lan}/task/{task}/unassign', 'TasksController@unassign')->name('task.unassign');


/* ----------------- Lan routes ----------------- */

//Resource managment and related
Route::get('/lan/create','LansController@create')->name('lan.create');
Route::post('/lan','LansController@store')->name('lan.store');
Route::get('/lan/{lan}/edit','LansController@edit')->name('lan.edit');
Route::put('/lan/{lan}','LansController@update')->name('lan.update');
Route::delete('/lan/{lan}','LansController@destroy')->name('lan.destroy');
Route::put('/lan/submit/{id}', 'LansController@submit');

//Show and list
Route::get('/lan/{lan}','LansController@show')->name('lan.show');
Route::get('/lans/{id}/guest/show','LansController@guestShow')->name('lan.guest_show');
Route::get('/all_lans','LansController@list_all')->name('all_lans');
Route::post('/all_lans', 'PageController@allLansList');

Route::get('/lan/{lan}/users/','LansController@list_users')->name('lan.user_list');
Route::get('/lan/{lan}/users/{page}','LansController@list_users')->name('lan.user_list.page');
Route::get('/lan/{lan}/admins/','LansController@list_admins')->name('lan.admin_list');
Route::get('/lan/{lan}/admins/{page}','LansController@list_admins')->name('lan.admin_list.page');
Route::get('/lan/{lan}/helpers/','LansController@list_helpers')->name('lan.helper_list');
Route::get('/lan/{lan}/helpers/{page}','LansController@list_helpers')->name('lan.helper_list.page');

//LAN Games
Route::get('/lan/{lan}/games/','LansController@list_games')->name('lan.game_list');
Route::get('/lan/{lan}/games/{page}','LansController@list_games')->name('lan.game_list.page');
Route::delete('/lan/game/{id}','LansController@removeGame')->name('lan.remove_game');
Route::get('/lan/game/{id}','LansController@addGame')->name('lan.add_game');
Route::post('/lan/game/{id}','LansController@postAddGame');

//LAN Games port
Route::get('/lan/{lan}/game/{game}/port','GamesController@addPort')->name('game.add_ports');
Route::post('/lan/{lan}/game/{game}/port','GamesController@postAddPort');
Route::delete('/lan/{lan}/game/{game}/port','GamesController@removePort');

// player participation
Route::get('lan/participate/{id}', 'LansController@participate')->name('lan.participate');
Route::post('lan/participate/{id}', 'LansController@postParticipate');
Route::delete('lan/participate/{id}', 'LansController@removePlayer');

// helper participation
Route::get('lan/helper/{id}', 'LansController@addHelper')->name('lan.add_helper');
Route::post('lan/helper/{id}', 'LansController@postAddHelper');
Route::delete('lan/helper/{id}', 'LansController@removeHelper');
Route::get('search/helper/{task}', 'UsersController@searchHelper');

// admin participation
Route::get('lan/admin/{id}', 'LansController@addAdmin')->name('lan.add_admin');
Route::post('lan/admin/{id}', 'LansController@postAddAdmin');
Route::delete('lan/admin/{id}', 'LansController@removeAdmin');

/* ----------------- Material routes ----------------- */

//Resource managment and related
Route::get('material/create', 'MaterialsController@create')->name('material.create');
Route::post('material', 'MaterialsController@store')->name('material.store');
Route::put('material/{material}', 'MaterialsController@update')->name('material.update');
Route::delete('material/{material}', 'MaterialsController@destroy')->name('material.destroy');
Route::get('material/{material}/edit', 'MaterialsController@edit')->name('material.edit');

//Show and list
Route::get('material/{material}', 'MaterialsController@show')->name('material.show');
Route::get('/search/material','MaterialsController@search');
Route::get('/lan/{lan}/materials/','LansController@list_materials')->name('lan.material_list');
Route::get('/lan/{lan}/materials/{page}','LansController@list_materials')->name('lan.material_list.page');

//LAN assign
Route::delete('/lan/material/{id}','LansController@removeMaterial')->name('lan.remove_material');
Route::get('/lan/material/{id}','LansController@addMaterial')->name('lan.add_material');
Route::post('/lan/material/{id}','LansController@postAddMaterial');
Route::put('/lan/material/{id}','LansController@editQuantity');


Route::get('/dashboard', 'PageController@dashboard')->name('dashboard');
Route::get('/dashboard/admin', 'PageController@adminDashboard')->name('dashboard.admin');

/* ----------------- Game routes ----------------- */

//Fav
Route::post('/game/favourite/{id}','GamesController@addToFavourite')->name('game.add_favourite');
Route::delete('/game/favourite/{id}','GamesController@removeFromFavourite')->name('game.remove_favourite');

//Show and list
Route::get('/search/game','GamesController@search')->name('game.search');
Route::get('/game/favourite/','GamesController@showFavouriteGames')->name('game.favourite');

//Resource managment and related
Route::resource('game', 'GamesController');


/* ----------------- Tournament routes ----------------- */

//Resource managment and related
Route::get('lan/{lan}/tournament/create', 'TournamentsController@create')->name('tournament.create_tournament');
Route::post('lan/{lan}/tournament/store', 'TournamentsController@store')->name('tournament.store');
Route::get('lan/{lan}/tournament/{tournament}/edit', 'TournamentsController@edit')->name('tournament.edit_tournament');
Route::put('lan/{lan}/tournament/{tournament}/edit', 'TournamentsController@update')->name('tournament.update');
Route::delete('lan/{lan}/tournament/{tournament}/destroy', 'TournamentsController@destroy')->name('tournament.destroy');
//Show and list
Route::get('lan/{lan}/tournament/{tournament}/show', 'TournamentsController@show')->name('tournament.show_tournament');
Route::get('/lan/{lan}/tournaments/','LansController@list_tournaments')->name('lan.tour_list');
Route::get('/lan/{lan}/tournaments/{page}','LansController@list_tournaments')->name('lan.tour_list.page');

/* ----------------- TEAM routes ----------------- */

//Resource managment and related
Route::get('tournament/{tournament}/team/create', 'TeamsController@create')->name('team.create_team');
Route::post('tournament/{tournament}/team/store', 'TeamsController@store')->name('team.store');
Route::post('tournament/{tournament}/team/joinTeam', 'TeamsController@joinTeam')->name('team.joinTeam');
Route::get('tournament/{tournament}/team/{team}/show', 'TeamsController@show')->name('team.players_team');
Route::delete('tournament/{tournament}/team/{team}/destroy', 'TeamsController@destroy')->name('team.destroy');

/* ----------------- Round and matches routes ----------------- */
Route::resource('tournament/round', 'RoundsController');
Route::resource('tournament/round/match', 'MatchesController');

/* ----------------- SHOPPING routes ----------------- */
//Resource managment and related
Route::get('lan/{lan}/shopping/create', 'ShoppingsController@create')->name('shopping.create');
Route::post('lan/{lan}/shopping/store', 'ShoppingsController@store')->name('shopping.store');
Route::get('lan/{lan}/shopping/{shopping}/edit', 'ShoppingsController@edit')->name('shopping.edit');
Route::delete('lan/{lan}/shopping/{shopping}/destroy', 'ShoppingsController@destroy')->name('shopping.destroy');
Route::put('lan/{lan}/shopping/{shopping}/edit', 'ShoppingsController@update')->name('shopping.update');

//Show and list
Route::get('lan/{lan}/shopping/{shopping}/show', 'ShoppingsController@show')->name('shopping.show');
Route::get('/lan/{lan}/shoppings/','LansController@list_shoppings')->name('lan.shopping_list');
Route::get('/lan/{lan}/shoppings/{page}','LansController@list_shoppings')->name('lan.shopping_list.page');

/* ----------------- Activities routes ----------------- */
//Resource managment and related
Route::get('lan/{lan}/activity/create', 'ActivitiesController@create')->name('activity.create');
Route::post('lan/{lan}/activity/store', 'ActivitiesController@store')->name('activity.store');
Route::get('lan/{lan}/activity/{activity}/edit', 'ActivitiesController@edit')->name('activity.edit');
Route::delete('lan/{lan}/activity/{activity}/destroy', 'ActivitiesController@destroy')->name('activity.destroy');
Route::put('lan/{lan}/activity/{activity}/edit', 'ActivitiesController@update')->name('activity.update');
//Show and list
Route::get('lan/{lan}/activity/{activity}/show', 'ActivitiesController@show')->name('activity.show');
Route::get('/lan/{lan}/activities/','LansController@list_activities')->name('lan.activity_list');
Route::get('/lan/{lan}/activities/{page}','LansController@list_activities')->name('lan.activity_list.page');

/* ----------------- ADMIN ROUTES ----------------- */

//User
Route::post('/user','UsersController@store')->name('user.store');
Route::delete('/user/{user}','UsersController@destroy')->name('user.destroy');
Route::get('/user/{user}','UsersController@show')->name('user.show');
Route::put('/user/{user}','UsersController@update')->name('user.update');
Route::get('/user/{user}/edit','UsersController@edit')->name('user.edit');
Route::post('/user/{user}/restore','UsersController@restore');
Route::get('search/user/', 'UsersController@search');
Route::get('adm/users', 'UsersController@admList')->name('admin.users');
Route::get('adm/users/{page}', 'UsersController@admList')->name('admin.users.page');

//Tournaments
Route::get('adm/tournaments', 'TournamentsController@admList')->name('admin.tournaments');
Route::get('adm/tournaments/{page}', 'TournamentsController@admList')->name('admin.tournaments.page');

/* ----------------- SETTINGS ROUTES ----------------- */

Route::get('updateTheme/{id}', 'UsersController@updateTheme')->name('user.updateTheme');
Route::get('updateLanguage/{id}', 'UsersController@updateLanguage')->name('user.updateLanguage');

/* ----------------- MISC ROUTES ----------------- */

Route::get('/az', function(){
	$t = App\Lan::all()->first();
	dd($t->location());
});
Route::get('/m', function(){//very important
	return(view('errors.m'));
});
