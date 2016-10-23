<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Garbage;
use App\Marker;
use App\Http\Requests;

class MarkerController extends Controller
{
    public function addMarker(Request $request)
    {
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
    }

    public function deleteMarker(Request $request)
    {
        $markerRequest = $request->input('marker_id');
        $user = Auth::user();
        if (!$user)
            return response()->json(array(['error'=>'Missing authentication']));


        if(!$markerRequest)
            return response()->json(array(['error'=>'Missing marker id']));

        $marker = Marker::find($markerRequest);

        if(!$marker)
            return response()->json(array(['error'=>'No such marker']));

        if($marker->user_id != $user->id)
            return response()->json(array(['error'=>'No access for this action']));


        $status = $marker->forceDelete();


        return response()->json($status);
    }
}
