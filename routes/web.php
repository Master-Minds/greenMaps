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
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'api'], function () {

    Route::get('/add-marker', 'MarkerController@addMarker');

});
