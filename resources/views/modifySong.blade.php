@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Modify <span style="color: red;">{{\App\Song::find($songId)->song_name}}</span></div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('updateSong',['songId' => $songId, 'singerId' => $singerId]) }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : ''}}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="songName" value="{{ \App\Song::find($songId)->song_name }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="song_description" class="col-md-4 control-label">description</label>

                                <div class="col-md-6">
                                    <textarea class="form-control" rows="12" id="song_description"
                                              name="description" required>{{\App\Song::find($songId)->description}}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="song_pic" class="col-md-4 control-label">Song Picture</label>

                                <div class="col-md-6">
                                    <input id="song_pic" type="file" class="form-control" name="songPicUrl"
                                           required>
                                </div>
                            </div>

                            <input name="_method" type="hidden" value="PUT">
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <input class="btn btn-primary" type="submit" value="Modify Song">
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