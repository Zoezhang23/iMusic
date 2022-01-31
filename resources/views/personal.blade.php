@extends('layouts.app')

@section('content')
    <div class="container">
        @if(Auth::user())
            <div class="row">
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-3">
                            @if(Storage::has('avatar/'.Auth::user()->avatar_url))
                                <img src="{{url('accountImg', ['avatar_url' => Auth::user()->avatar_url])}}"
                                     class="img-responsive img-circle">
                            @endif
                            
                        </div>
                        <div class="col-md-8">
                            <div style="font-size: 22px; color: #1b6d85;">{{Auth::user()->name}}</div>
                            <div><span>Email Address: </span><span
                                        style="font-size: 18px; color: #1b6d85;">{{Auth::user()->email}}</span></div>
                        </div>
                    </div>
                    <a href="{{url('toModifyAccount')}}" class="btn btn-info" style="margin-top: 20px"><i class="fa fa-pencil"></i>Modify Account</a>
                    <a href="{{url('toResetPassword')}}" class="btn btn-info" style="margin-top: 20px"><i class="fa fa-pencil"></i>Reset Password</a>
                </div>
            </div>
        @endif
        
        <table class="table table-striped" style="margin-top: 30px">
        <caption style="font-size: 20px; color: #1b6d85">Song List</caption>
        <colgroup>
            <col width="10%"/>
            <col width="15%"/>
            <col width="50"/>
            <col width="15%"/>
        </colgroup>
        <thead>
            <tr>
                <th>picture</th>
                <th>name</th>
                <th>description</th>
                <th class="text-center">operations</th>
            </tr>
            @foreach(Auth::user()->songs as $song)
            <tr>
                @if(Storage::has('song_pic/' . $song->song_pic_url))
                <td><img src="{{ url('getSongPic',['songPicUrl' => $song->song_pic_url]) }}"
                         class="img-responsive img-rounded" onmouseover='bigImg(this)'
                         onmouseout="normalImg(this)"/></td>
                @endif
                <td>{{ $song->song_name }}</td>
                <td>{{ $song->description }}</td>
                <td>
                    <form method="POST" action="{{ url('deleteSong', ['songId' => $song->id]) }}" style="margin-left: 5px;display: inline-block">
                        {{csrf_field()}}
                        <input name="_method" type="hidden" value="DELETE">
                        <input class="btn btn-danger" type="submit" value="Delete">
                    </form>
                    <a href="{{ url('toUpdateSong', ['songId' => $song->id, 'singerId' => $song->singer_id]) }}"
                       class="btn btn-warning">Update</a>
                </td>
            </tr>
            @endforeach
        </thead>
    </table>
        
    </div>
@endsection
