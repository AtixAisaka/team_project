<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [
    "as" => "home", "uses" => 'HomeController@index'
]);

Route::get('events', [
    "as" => "events.index", "uses" => 'EventsController@index'
]);

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('eventlist', [
    "as" => "eventlist", "uses" => 'EventsController@showEventList'
]);

Route::post('events', [
    "as" => "events.add", "uses" => 'EventsController@addEvent'
]);

Route::get('/showEdit/{id}', [
    "as" => "showEdit", "uses" => 'EventsController@showEditEvent'
]);

Route::get('/showEventInfo/{id}', [
    "as" => "showInfo", "uses" => 'EventsController@showEventInfo'
]);

Route::post('/update/{id}', [
    "as" => "update", "uses" => 'EventsController@updateEventAction'
]);

Route::get('/delete/{id}', [
    "as" => "delete", "uses" => 'EventsController@deleteEventAction'
]);

Route::get('/addUserToEvent/{id}', [
    "as" => "addUserEvent", "uses" => 'EventsController@addUserToEvent'
]);

Route::get('/removeUserFromEvent/{id}', [
    "as" => "removeUserEvent", "uses" => 'EventsController@removeUserFromEvent'
]);

<<<<<<< HEAD
Route::get('/home', 'HomeController@index')->name('home');

Route::get('events', 'EventsController@index')->name('events.index');
Route::post('events', 'EventsController@addEvent')->name('events.add');
=======
>>>>>>> feature/TEAM-15-User_implementation_and_gui_change
