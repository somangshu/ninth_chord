<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::controller('/', 'PanelController');

Route::get('/', 'GenreController@getView');

Route::group(['prefix' => 'v1'], function () {

	//Genre
    Route::get('/genres', 'GenreController@index');
    Route::post('/genre/create', 'GenreController@create');
    Route::get('/genres/{genre_id}', 'GenreController@show');
    Route::post('/genres/{genre_id}', 'GenreController@update');

    //Tracks
    Route::get('/tracks', 'TrackController@index');
    Route::post('/track/create', 'TrackController@create');
    Route::get('/tracks/{genre_id}', 'TrackController@show');
    Route::post('/tracks/{genre_id}', 'TrackController@update');
});

// Event::listen('illuminate.query', function ($query, $params, $time, $conn) {
//    echo '<pre>';
//    print_r([$query, $params, $time, $conn]);
//    echo '</pre>';
// });
