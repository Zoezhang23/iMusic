<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Singer;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Gate;

class SongController extends Controller {

    public function createComment(Request $request, $songId) {
        $this->validate($request, [
            'comment_name' => 'required|min:20|max:60',
            'comment_content' => 'required|min:40'
        ]);
        $comment = new Comment;
        $comment->comment_name = $request->input('comment_name');
        $comment->comment_content = $request->input('comment_content');
        $comment->user_id = Auth::user()->id;
        $comment->song_id = $songId;
        $comment->save();
    }
    public function createSong(Request $request, $singerId, $singerName) {
        $this->validate($request, [
            'songName' => 'required|max:20',
            'songDescription' => 'required|min:20',
            'songPicture' => 'File'
        ]);

        if (Gate::allows('attach-song-to-singer')) {
            $song = new Song;
            $song->song_name = $request->songName;
            $song->singer_name = $singerName;
            $song->description = $request->songDescription;
            $songPicUrl = time() . '.' . $request->file('songPicUrl')->getClientOriginalExtension();
            $song->song_pic_url = $songPicUrl;
            $song->singer_id = $singerId;
            $song->user_id = Auth::user()->id;
            $isSuccess = $song->save();
            if ($isSuccess) {
                $uploadImg = $request->file('songPicUrl');
                $image = Image::make($uploadImg);
                $image->resize(80, 80)->insert('img/watermark.png', 'bottom');
//                $image->pixelate();
                Storage::disk('local')->put('song_pic/' . $songPicUrl, $image->stream());

                
                return view('singerDetail')->with(['singer' => Singer::find($singerId), 'songs' => Singer::find($singerId)->songs]);
            }
        }
        if (Gate::denies('attach-song-to-singer')) {
            return back()->withErrors('Please register and try it again!!');
        }
    }
    public function deleteSong(Song $song, $songId) {
        $song = Song::find($songId);
        if (Gate::allows('delete-song', $song)) {

            $song->delete();
            return back();
        }
        if (Gate::denies('delete-song', $song)) {
            return back();
        }
    }

    public function toAttachSong($singerId){
        $singer = Singer::find($singerId);
        return view('attachSong')->with(['singer' => $singer]);
    }


    public function toUpdateSong($songId, $singerId) {
        $singer = Singer::find($singerId);
        $song = Song::find($songId);
        if (Gate::allows('update-song', $song)) {
            return view('modifySong')->with(['songId' => $songId, 'singerId' => $singerId]);
        }
        if (Gate::denies('update-song', $song)) {
            return back()->with(['singerId' => $singerId]);
        }
    }

    public function updateSong(Request $request, $songId, $singerId) {
        $this->validate($request, [
            'songName' => 'required|max:20',
            'description' => 'required|min:20',
            'songPicUrl' => 'File'
        ]);
        $singer = Singer::find($singerId);
        $song = Song::find($songId);
        $oldPicUrl = $song->song_pic_url;
        $song->song_name = $request->songName;
        $song->description = $request->description;
        $songPicUrl = time() . '.' . $request->file('songPicUrl')->getClientOriginalExtension();
        $song->song_pic_url = $songPicUrl;
        if ($song->save()) {
            $uploadImg = $request->file('songPicUrl');
            $image = Image::make($uploadImg);
            $image->resize(80, 80)->insert('img/watermark.png', 'bottom');
            Storage::disk('local')->put('song_pic/' . $songPicUrl, $image->stream());
            $image_pixelated = $image->pixelate(4);
            Storage::disk('local')->put('song_pic/pixelated-' . $songPicUrl, $image_pixelated->stream());
            Storage::delete('song_pic/' . $oldPicUrl);
            if (Storage::has('song_pic/pixelated-' . $oldPicUrl)) {
                Storage::delete('song_pic/pixelated-' . $oldPicUrl);
            }
            return redirect('/personal');
        }
    }

}
