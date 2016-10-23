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
        $latitude = $request->input('la');
        $longitude = $request->input('lo');
        $image = $request->input('image');
        $user_id = $user->id;


        if (!$garbage_id)
            return response()->json(array(['error'=>'Missing garbage id']));

        if(!$latitude)
            return response()->json(array(['error'=>'Missing latitude']));

        if(!$longitude)
            return response()->json(array(['error'=>'Missing longitude']));


        if(!Garbage::find($garbage_id))
            return response()->json(array(['error'=>'No such garbage id']));

        if(!$image)
            $image = '';


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
                'user_id' => $user_id,
                'image' => $image
            ]
        );

        return response()->json(array(['success' => $status]));
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

        return response()->json(array(['success' => $status]));

    }

    public function findMarkers(Request $request)
    {
        $la = $request->input('la');
        $lo = $request->input('lo');


        if(!$la)
            return response()->json(array(['error'=>'No latitude']));
        if(!$lo)
            return response()->json(array(['error'=>'No longitude']));

        $la = explode('.', $la);
        $lo = explode('.', $lo);
        $exLa = substr( $la[1], 0, 1);
        $exLo = substr( $lo[1],0, 1);

        $markers = Marker::where('latitude', 'LIKE', $la[0] . '.' . $exLa .'%')
                    ->where('langitude', 'LIKE', $lo[0] . '.' . $exLo .'%')->get();
        if(count($markers) == 0)
            return response()->json(array(['success'=>'No markers']));

        return response()->json(array(['success' => $markers]));
    }

    public function findAccurateMarkers(Request $request)
    {
        $la = $request->input('la');
        $lo = $request->input('lo');


        if(!$la)
            return response()->json(array(['error'=>'No latitude']));
        if(!$lo)
            return response()->json(array(['error'=>'No longitude']));


        $markers = Marker::where('latitude', '=', $la)
            ->where('langitude', 'LIKE', $lo)->get();

        if(count($markers) == 0)
            return response()->json(array(['success'=>'No markers']));

        return response()->json(array(['success' => $markers]));
    }

    public function getMarkerById(Request $request)
    {
        $id = $request->input('marker_id');
        if(!$id)
            return response()->json(array(['error'=>'No marker id']));

        $marker = DB::table('markers')
            ->leftJoin('garbage_types', 'markers.garbage_id', '=', 'garbage_types.id')
            ->leftJoin('users', 'markers.user_id', '=', 'users.id')
            ->where('markers.id', '=', $id)
            ->first([
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

        if(!$marker)
            return response()->json(array(['success'=>'No marker found']));

        return response()->json(array(['success' => $marker]));
    }

    public function updateMarker(Request $request)
    {
        $user = Auth::user();
        if (!$user)
            return response()->json(array(['error'=>'Missing authentication']));

        $id = $request->input('marker_id');
        $title = $request->input('title');
        $description = $request->input('description');
        $la = $request->input('la');
        $lo = $request->input('lo');
        $image = $request->input('image');

        $id = $request->input('marker_id');
        if(!$id)
            return response()->json(array(['error'=>'No marker id']));

        $marker = Marker::find($id);

        if(!$marker)
            return response()->json(array(['error'=>'No marker found']));

        /*check for access*/
        if($marker->user_id != $user->id)
            return response()->json(array(['error'=>'No access for this action']));

        if(!$image)
            $image = '';

        if(!$la)
            $la = '';
        if(!$lo)
            $lo = '';
        if(!$title)
            $title = '';
        if(!$description)
            $description = '';

        $marker->title = $title;
        $marker->description = $description;
        $marker->latitude = $la;
        $marker->langitude = $lo;
        $marker->image = $image;

        $status = $marker->save();


        return response()->json(array(['success' => $status]));
    }

    public function getAllMarkers(Request $request)
    {
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

        return response()->json($markers);
    }

}
