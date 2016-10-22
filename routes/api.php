<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


Route::get('/get-all-markers', function(Request $request){
    $markers = DB::table('markers')
            ->leftJoin('garbage_types', 'markers.garbage_id', '=', 'garbage_types.id')
            ->leftJoin('users', 'markers.user_id', '=', 'users.id')
            ->get([
                'markers.id as marker_id',
                'markers.title as marker_title',
                'markers.description',
                'markers.latitude',
                'markers.langitude',
                'garbage_types.*',
                'users.id',
                'users.name',
                'users.email',
            ]);

//    dd($markers);
    return response()->json($markers);
});
Route::get('/test', function(Request $request){
  return "work";
});
