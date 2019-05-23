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

Route::get('/', 'VotersController@start');

Route::group(['prefix' => 'admin', 'middleware' => 'admin_auth'], function(){
    Route::get('/', function () {
        return view('admin.home');
    });
    Route::get('votes', 'HistoryController@votes');
    Route::get('graph', 'HistoryController@graph');
    Route::get('user', 'UserController@index');
    Route::post('user/newEmail', 'UserController@newEmail');
    Route::post('user/newPassword', 'UserController@newPassword');
	Route::get('dashboard', 'HomeController@dashboard');
    Route::resource('colleges', 'CollegesController');
    Route::resource('candidates', 'CandidatesController');
    Route::resource('party-lists', 'PartyListsController');
    Route::resource('positions', 'PositionsController');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('logout','LoginController@logout');


Route::get('voting/votes', 'VotersController@create');
Route::post('voting/votes', 'VotersController@store');

Route::group(['prefix' => 'voting', 'middleware' => 'voting_auth'], function(){
    Route::get('votes/ssg', 'VotesController@ssg_display');
    Route::post('votes/ssg', 'VotesController@ssg_post');
    Route::get('votes/council', 'VotesController@council_display');
    Route::post('votes/council', 'VotesController@council_post');
});




