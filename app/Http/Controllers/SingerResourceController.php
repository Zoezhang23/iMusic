<?php

namespace App\Http\Controllers;

use App\Singer;
use Illuminate\Http\Request;

class SingerResourceController extends Controller
{
    public function index()
    {
        $singers = Singer::all();
        return response($singers);
    }

    public function show($id)
    {
        $singer = Singer::find($id);
        $songs = $singer->songs;
        return response()->json([
            'singer name' => $singer->singer_name,
            'singer description' => $singer->description,
            'songs of the singer' => $songs
        ]);
    }

}
