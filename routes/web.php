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

    Route::post('/add-marker', function (Request $request) {
        if (!Auth::user())
            return response()->json(array(['error'=>'Missing authentication']));

        $user = Auth::user();

        $title = $request->input('title');
        $garbage_id = $request->input('garbage_id');
        $description = $request->input('description');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $user_id = $user->id;


        if (!$garbage_id)
            return response()->json(array(['error'=>'Missing garbage id']));

        if(!$latitude)
            return response()->json(array(['error'=>'Missing latitude']));

        if(!$longitude)
            return response()->json(array(['error'=>'Missing longitude']));


        if(!Garbage::find($garbage_id))
            return response()->json(array(['error'=>'No such garbage id']));


        if (!$title)
            $title = '';
        if (!$description)
            $description = '';

         $status = DB::table('markers')->insert(
             [
                 'title' => $title,
                 'description' => $description,
                 'garbage_id' => $garbage_id,
                 'latitude' => $latitude,
                 'langitude' => $longitude,
                 'user_id' => $user_id
             ]
         );

         return response()->json($status);

    }); /*->middleware('auth')*/

});
