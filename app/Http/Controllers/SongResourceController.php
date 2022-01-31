<?php

namespace App\Http\Controllers;

use App\Song;
use Illuminate\Http\Request;

class SongResourceController extends Controller
{
    public function index()
    {
        $allSongs = Song::all();
        if($allSongs){
            return response()->json($allSongs, 200);
        } else {
            return response()->json([
                'msg' => 'no song',
                'status' => 404
            ], 404);
        }
    }

    public function show($id)
    {
        $song = Song::find($id);
        if($song != null){
            return response()->json($song, 200);
        } else {
            return response()->json([
                'msg' => 'song not exists',
                'status' => 404
            ], 404);
        }
    }

}
