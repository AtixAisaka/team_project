<?php

use App\Mail\MailtrapExample;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Session\get;

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

Route::get('/aboutus', function () {
    return view('aboutus');
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

Route::post('/filter', [
    "as" => "filter", "uses" => 'EventsController@filterEvents'
]);

Route::post('/filterCal', [
    "as" => "filterCal", "uses" => 'EventsController@filterEventsCalendar'
]);

Route::get('/delete/{id}', [
    "as" => "delete", "uses" => 'EventsController@deleteEventAction'
]);

Route::get('/hide/{id}&{value}', [
    "as" => "hide", "uses" => 'EventsController@hideEventAction'
]);

Route::post('/deleteEventHistory', [
    "as" => "deleteEventHistory", "uses" => 'EventsController@deleteEventHistory'
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

Route::get('/deleteImage/{id}&{eventid}&{param}&{userid}&{admin}', [
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

Route::get('showFilters', [
    "as" => "showFilters", "uses" => 'UsersController@showFilters'
]);

Route::post('filterUsers', [
    "as" => "filterUsers", "uses" => 'UsersController@filterUsers'
]);

Route::get('deleteUserAction/{id}', [
    "as" => "deleteUserAction", "uses" => 'UsersController@deleteUserAction'
]);

Route::get('tags', [
    "as" => "tagsView", "uses" => 'EventsController@tagsView'
]);

Route::get('addtags', [
    "as" => "addtagsView", "uses" => 'EventsController@addtagsView'
]);

Route::post('addtag', [
    "as" => "addtag", "uses" => 'EventsController@addtag'
]);

Route::get('deletetag/{id}', [
    "as" => "deletetag", "uses" => 'EventsController@deletetag'
]);

Route::get('edittag/{id}', [
    "as" => "editTagView", "uses" => 'EventsController@editTagView'
]);

Route::post('edittagAction', [
    "as" => "edittagAction", "uses" => 'EventsController@edittagAction'
]);

Route::get('eventtags/{id}', [
    "as" => "eventtags", "uses" => 'EventsController@eventTagInfoView'
]);

Route::post('eventaddTagInfo', [
    "as" => "eventaddTagInfo", "uses" => 'EventsController@eventaddTagInfo'
]);

Route::get('deletetagInfo/{id}&{idevent}', [
    "as" => "deletetagInfo", "uses" => 'EventsController@deletetagInfo'
]);

Route::get('/send-mail', function () {

    Mail::to('newuser@example.com')->send(new MailtrapExample());

    return 'A message has been sent to Mailtrap!';

});

Route::get('/profile', 'UserController@profile')->name('user.profile')->middleware('auth');;

Route::get('/edit/user', 'UserController@edit')->name('user.edit');

Route::post('/edit/user', 'UserController@update')->name('user.update');

Route::get('/edit/password/user', 'UserController@passwordEdit')->name('password.edit');

Route::post('/edit/password/user', 'UserController@passwordUpdate')->name('password.update');

Route::get('makeeventpdf/{id}', [
    "as" => "makeeventpdf", "uses" => 'EventsController@makeEventPDF'
]);

Route::get('/login/github', 'Auth\LoginController@github');
Route::get('/login/github/redirect', 'Auth\LoginController@githubRedirect');

Route::get('/login/facebook', 'Auth\LoginController@facebook');
Route::get('/login/facebook/redirect', 'Auth\LoginController@facebookRedirect');

Route::get('/login/google', 'Auth\LoginController@google');
Route::get('/login/google/redirect', 'Auth\LoginController@googleRedirect');

Route::get('exportIcs/{id}', [
    "as" => "exportIcs", "uses" => 'EventsController@exportIcs'
]);

Route::get('/uploadfile/{id}', [
    "as" => "openFileUpload", "uses" => 'EventsController@openFileUpload'
]);

Route::get('/deletefile/{id}&{eventid}&{param}&{userid}&{admin}', [
    "as" => "deletefile", "uses" => 'EventsController@deletefile'
]);

Route::post('/uploadfileaction', [
    "as" => "uploadFile", "uses" => 'EventsController@uploadFile'
]);



