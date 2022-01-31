@extends('layouts.app')

@section('content')
    <div class="container-big" style="margin-top: -10px">
        <img src="{{asset('img/3.jpeg')}}" class="img-responsive img-rounded" alt="music is all"/>
        <div class="row" style="margin-bottom: 20px">
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
        </div>
        <div class="row">
            <a href="{{url('/playground')}}">
                <button class="btn" style="border: 2px solid gray; color: gray; background: none; margin-left: 15px">
                    Playground
                </button>
            </a>
        </div>
    </div>
@endsection