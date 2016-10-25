<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Garbage;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::post('/login', 'CustomAuth@login');

Route::group(['prefix' => 'api'], function () {

    Route::post('/add-marker', 'MarkerController@addMarker');

    Route::delete('/delete-marker', 'MarkerController@deleteMarker');

    Route::get('/find-marker', 'MarkerController@findMarkers');

    Route::get('/find-accurate-marker', 'MarkerController@findAccurateMarkers');

    Route::get('/get-marker-by-id', 'MarkerController@getMarkerById');

    Route::put('/update-marker', 'MarkerController@updateMarker');

    Route::get('/get-all-markers', 'MarkerController@getAllMarkers');

});
