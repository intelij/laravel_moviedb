@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <hr>
            <h3>{{ $name }} Movies</h3>
            <hr>
        </div>
        <div class="col-md-9">
            <div class="row">
                @foreach($movies as $movie)
                    <div class="col-md-4">
                        <div class="card card-01 height-fix">
                            <a href="/movie/{{$movie->id}}">
                                <img class="card-img-top" src="{{ $movie->poster }}" alt="Card image cap">
                            </a>
                            <div class="card-img-overlay">
                                <h4 class="card-title"><strong>{{ stripslashes($movie->title) }}</strong></h4>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-3">
            @include('layouts.sidebar')
        </div>
    </div>

@endsection
