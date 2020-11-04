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

Route::get('/landing_page', function () {
    return view('layouts.landing_page');
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

Route::get('/eventhistory/{value}&{id}&{admin}', [
    "as" => "eventhistory", "uses" => 'EventsController@showEventsHistory'
]);

Route::post('events', [
    "as" => "events.add", "uses" => 'EventsController@addEvent'
]);

Route::get('/showEdit/{id}&{param}&{userid}&{admin}', [
    "as" => "showEdit", "uses" => 'EventsController@showEditEvent'
]);

Route::get('/showEventInfo/{id}&{param}&{userid}&{admin}', [
    "as" => "showInfo", "uses" => 'EventsController@showEventInfo'
]);

Route::post('/update/{id}', [
    "as" => "update", "uses" => 'EventsController@updateEventAction'
]);

Route::get('/delete/{id}', [
    "as" => "delete", "uses" => 'EventsController@deleteEventAction'
]);

Route::post('/deleteUserGoingEvent', [
    "as" => "deleteUserGoingEvent", "uses" => 'EventsController@deleteUserGoingEvent'
]);

Route::get('/addUserToEvent/{id}', [
    "as" => "addUserEvent", "uses" => 'EventsController@addUserToEvent'
]);

Route::get('/removeUserFromEvent/{id}', [
    "as" => "removeUserEvent", "uses" => 'EventsController@removeUserFromEvent'
]);

Route::get('/uploadImage/{id}', [
    "as" => "uploadImage", "uses" => 'EventsController@openImageUpload'
]);

Route::post('/deleteImage/{id}&{eventid}&{param}&{userid}&{admin}', [
    "as" => "deleteImage", "uses" => 'EventsController@deleteImage'
]);

Route::post('/upload', [
    "as" => "upload", "uses" => 'EventsController@uploadImage'
]);


Route::get('/showEditUser/{id}', [
    "as" => "showEditUser", "uses" => 'UsersController@showEditUser'
]);

Route::post('/updateUser', [
    "as" => "updateUser", "uses" => 'UsersController@updateUserAction'
]);

Route::get('userlist', [
    "as" => "userlist", "uses" => 'UsersController@showUserList'
]);

Route::get('deleteUserAction/{id}', [
    "as" => "deleteUserAction", "uses" => 'UsersController@deleteUserAction'
]);
