@extends('layouts.app')

@section('content')
<div class="container">
    @if($errors->any())
    <h4>{{$errors->first()}}</h4>
    @endif
    @if($singer != null)
    <div class="row">
        <div class="col-md-4">
            <img src="{{ asset('/img/' . $singer->singer_pic_url) }}" 
                 class="img-thumbnail" style="width: 280px">
        </div>
        <div class="col-md-6">
            <div style="margin-bottom: 20px; font-size: 20px; color: #1b6d85">{{ $singer->singer_name }}</div>
            <div style="font-size: 16px; line-height: 22px; word-spacing: 2px">{{ $singer->description }}</div>
            <div style="margin-top: 30px">
                <a href="{{ url('toAttachSong',['singer' => $singer]) }}" class="btn btn-info" style="display: block">Attach a song to {{$singer->singer_name}}</a>
            </div>
        </div>
    </div>

    <table class="table table-striped" style="margin-top: 30px">
        <caption style="font-size: 20px; color: #1b6d85">Song List</caption>
        <colgroup>
            <col width="10%"/>
            <col width="15%"/>
            <col width="50"/>
            <col width="10%"/>
        </colgroup>
        <thead>
            <tr>
                <th>picture</th>
                <th>name</th>
                <th>description</th>
                <th>author</th>
            </tr>
            @foreach($songs as $song)
            <tr>
                @if(Storage::has('song_pic/' . $song->song_pic_url))
                <td><img src="{{ url('getSongPic',['songPicUrl' => $song->song_pic_url]) }}"
                         class="img-responsive img-rounded" onmouseover='bigImg(this)'
                         onmouseout="normalImg(this)"/></td>
                @endif
                <td>{{ $song->song_name }}</td>
                <td>{{ $song->description }}</td>
                <td>{{ \App\User::find($song->user_id)->name }}</td>
            </tr>
            @endforeach
        </thead>
    </table>
    <div>
        <div class="row" style="margin-top: 30px">
            <div class="col-md-offset-8 col-md-2"><a href="{{ url('/getSingerPDF',['singerId' => $singer->id]) }}" class="btn btn-info">VIEW {{$singer->singer_name}}</a></div>
            <div class="col-md-2"><a href="{{ url('/downloadSingerPDF',['singerId' => $singer->id]) }}" class="btn btn-info">DOWNLOAD {{$singer->singer_name}}</a>
        </div>
    </div>
    @endif
</div>
<script>
    function bigImg(x) {
        x.style.height = "90px";
        x.style.width = "90px";
    }

    function normalImg(x) {
        x.style.height = "80px";
        x.style.width = "80px";
    }
</script>
@endsection