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

Route::get('/', 'SiteController@index')->name('home');

Route::get('/login', 'SiteController@login')->name('login');

Route::post('/login', 'SiteController@authenticate');

Route::get('/logout', 'SiteController@logout');

Route::get('/program', 'SiteController@program');

Route::group(['middleware'=>'admin'], function() {
    Route::get('/delegates', 'UserController@delegates');
    Route::post('/user/set-active', 'UserController@setActive');
    Route::get('/user/create', 'UserController@create');
    Route::post('/user/create', 'UserController@store');
    Route::get('/user/import-form', 'UserController@importForm');
    Route::post('/user/import', 'UserController@importUpload');
    Route::post('/user/import-map', 'UserController@import');
    Route::get('/raffle/prize', 'RaffleController@create');
    Route::post('/raffle/prize', 'RaffleController@store');
    Route::get('/raffle/draw', 'RaffleController@draw');
    Route::post('/raffle/draw', 'RaffleController@raffleDraw');
    Route::post('/raffle/confirm', 'RaffleController@confirm');
    Route::get('/election/create', 'ElectionController@create');
    Route::post('/election/create', 'ElectionController@store');
    Route::get('/election/admin/{stage}', 'ElectionController@adminChangeStage');
    Route::get('/election/admin', 'ElectionController@adminIndex');
    Route::post('/election/set-candidate', 'ElectionController@setCandidacy');
});

Route::group(['middleware'=>'auth'], function() {
    Route::post('/user/{user}/avatar', 'UserController@avatar');
    Route::get('/profile/{user}', 'UserController@profile');
    Route::get('/user/{user}/change-password', 'UserController@changePasswordForm');
    Route::patch('/user/{user}/change-password', 'UserController@changePassword');
    Route::get('/user/{user}', 'UserController@edit');
    Route::post('/user/{user}', 'UserController@update');
    Route::get('/user/{user}/pic', 'UserController@picture');
    Route::get('/raffle', 'RaffleController@index');
    Route::get('/election', 'ElectionController@index');
    Route::post('/election/nominate', 'ElectionController@nominate');
    Route::post('/election/vote-confirm', 'ElectionController@voteConfirmation');
    Route::post('/election/vote', 'ElectionController@vote');
});


