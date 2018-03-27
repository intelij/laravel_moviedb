@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <hr>
            <h3>Latest Movies</h3>
            <hr>
        </div>
        <div class="col-md-9">
            <div class="row">
                @foreach($top as $movie)
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

    <div class="row">
        @if(session()->has('recent.movies'))
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-12">
                        <hr>
                        <h3>Recently Viewed</h3>
                        <hr>
                    </div>
                    @if(count(session('recent.movies')) > 3)
                        @foreach(array_slice(session('recent.movies'),-3,3,true) as $recent)
                            <div class="col-md-2">
                                <div class="card card-01 height-fix">
                                    <a href="/movie/{{$recent}}">
                                        <img class="card-img-top" src="{{ \App\Movie::find($recent)->poster }}" alt="Card image cap">
                                    </a>
                                </div>
                            </div>
                        @endforeach

                    @else
                        @foreach(session('recent.movies') as $recent)
                            <div class="col-md-2">
                                <div class="card card-01 height-fix">
                                    <a href="/movie/{{$recent}}">
                                        <img class="card-img-top" src="{{ \App\Movie::find($recent)->poster }}" alt="Card image cap">
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        @endif
    </div>

    <div class="row">
        @if(count($ranks) > 0)
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-12">
                        <hr>
                        <h3>Recommended Movies</h3>
                        <hr>
                    </div>
                    @foreach($ranks as $key => $value)
                        <div class="col-md-2">
                            <div class="card card-01 height-fix">
                                <a href="/movie/{{ $mov = \App\Movie::where('title','=',$key)->first()->id }}">
                                    <img class="card-img-top" src="{{ \App\Movie::find($mov)->poster }}" alt="Card image cap">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection

