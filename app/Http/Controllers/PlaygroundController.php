<?php

namespace App\Http\Controllers;

use App\Singer;
use Illuminate\Http\Request;

class PlaygroundController extends Controller
{
    function getView()
    {
        $singers = Singer::all();
        return view('playground')->with('singers', $singers);
    }
}
