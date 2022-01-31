@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row" style="margin-bottom: 20px">
            @foreach($singers as $singer)
                <div style="margin-top: 20px">
                    <div class="col-md-4" style="margin-bottom: 40px">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="{{ asset('/img/' . $singer->singer_pic_url) }}"
                                     style="width: 200px;height: 160px; margin-bottom: 40px" class="img-thumbnail">
                                <div>
                                    <a href="{{ url('toSinger',['singerId'=>$singer->id]) }}">
                                        <button type="button" class="btn btn-info" style="margin-bottom: 40px">check
                                            out {{$singer->singer_name}}</button>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="font-size: 18px; color: #1b6d85; margin-bottom: 5px;">{{$singer->singer_name}}</div>
                                <div style="line-height: 20px; word-break: break-all; margin-bottom: 10px">{{ substr($singer->description, 0, 100) }}
                                    <a style="margin-left: 10px"
                                       href="{{ url('toSinger',['singerId'=>$singer->id]) }}">...More...</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection