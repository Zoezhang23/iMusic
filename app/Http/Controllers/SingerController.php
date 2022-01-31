<?php

namespace App\Http\Controllers;

use App;
use App\Singer;
use App\Song;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;

class SingerController extends Controller {

    public function singerDetail($singerId) {
        $singer = Singer::find($singerId);
        return view('singerDetail')->with(['singer' => $singer, 'songs' => $singer->songs]);
    }

    public function getSongPic($songPicUrl) {
        $songPic = Storage::get('song_pic/' . $songPicUrl);
        return new Response($songPic, 200);
    }

    public function getSingerPDF($singerId) {
        $pdf = App::make('dompdf.wrapper');
        $singer = Singer::find($singerId);
        $pdf->loadView('singerPDF', ['singer' => $singer, 'songs' => $singer->songs]);
        return $pdf->stream();
    }

    public function downloadSingerPDF($singerId) {
        $singer = Singer::find($singerId);
        $pdf = PDF::loadView('singerPDF', ['singer' => $singer, 'songs' => $singer->songs]);
        return $pdf->download('singer: ' . $singer->singer_name . '.pdf');
    }

}
