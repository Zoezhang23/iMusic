@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading text-center" style="padding: 10px 10px;"><span
                        style="font-size: 16px; color: #0d3625">Attach a song to</span>
                    <span style="font-size: 20px; color: #1b6d85">{{ $singer->singer_name }}</span></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST"
                          action="{{ url('/createNewSong',['singerId' => $singer->id, 'singerName' => $singer->singer_name]) }}"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="song_name" class="col-md-4 control-label">Song Name</label>

                            <div class="col-md-6">
                                <input id="song_name" type="text" class="form-control" name="songName" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="song_description" class="col-md-4 control-label">Song
                                Description</label>

                            <div class="col-md-6">
                                <textarea class="form-control" cols="3" id="song_description"
                                          name="songDescription" required></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="song_pic" class="col-md-4 control-label">Song Picture</label>

                            <div class="col-md-6">
                                <input id="song_pic" type="file" class="form-control" name="songPicUrl"
                                       required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-info">
                                    Attach
                                </button>
                            </div>
                        </div>

                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
