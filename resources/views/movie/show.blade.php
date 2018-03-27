@extends('layouts.master')

@section('content')
    <script src="{{asset('js/youtube.js')}}"></script>
    <script src="https://www.youtube.com/iframe_api"></script>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12 bg-dark" style="color: white">
                <h2>Title: <span id="title">{{ stripslashes($movie->title) }}</span>  (<span id="year">{{ substr($movie->released,0,4) }}</span>) </h2>
                <span>
                    Runtime: {{ $movie->runtime }} min. |
                    Genres: @foreach ($movie->genres as $genre) <a href="/movie/genre?genre={{ $genre->name }}">{{ $genre->name }}</a> @endforeach |
                    Release date: {{ $movie->released }} |
                    IMDB rating: {{ $movie->imdbRating }}
                </span>
                <p>
                    <h4 class="d-inline-block" style="border-right: 1px solid">
                        &nbsp; Rating: {{ round($rating,1) }}/5 &nbsp;
                    </h4>
                    @auth
                        @subscriber
                        <h4 class="d-inline-block">
                            &nbsp; Rate this
                            <div id="rating" class="rate_widget d-inline-block">
                                <div class="star_1 ratings_stars" id="1"></div>
                                <div class="star_2 ratings_stars" id="2"></div>
                                <div class="star_3 ratings_stars" id="3"></div>
                                <div class="star_4 ratings_stars" id="4"></div>
                                <div class="star_5 ratings_stars" id="5"></div>
                            </div>
                        </h4>
                        @else
                            <h4 class="d-inline-block">
                                <a href="/account/billing" style="color: white">&nbsp; Subscribe to rate</a>
                            </h4>
                        @endsubscriber
                        @if(count($wls) > 0)
                            <div class="dropdown">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                    Add to wishlist
                                </button>
                                <div class="dropdown-menu">
                                    @foreach($wls as $wl)
                                        @if($wl->movies->count() < 10)
                                            <form method="POST" action="{{ route('wishlist.attach',[$wl->id,$movie->id]) }}" class="dropdown-item" style="display: inline-block">
                                                {{ csrf_field() }}
                                                <button class="btn btn-dark" style="background: none;border: none;color: black">{{ $wl->name }}</button>
                                            </form>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @else
                            <h4 class="d-inline-block">
                                <a href="/login" style="color: white">&nbsp; Login to rate</a>
                            </h4>
                    @endauth
                </p>
            </div>
            <div class="row">
                <div class="col-md 4">
                    <br>
                    <img src="{{$movie->poster}}" class="img-fluid">
                </div>
                <div class="col-md-8">
                    <br>
                    <h2>Plot</h2>
                    <p class="text-justify">{{ $movie->plot }}</p>
                    <p>
                        Actors:
                        @foreach($movie->actors as $actor)
                            <a href="/actor?actor={{ $actor->name }}">{{ $actor->name }}</a>
                        @endforeach
                    </p>
                    <p>
                        Director: {{ $movie->director }}
                    </p>
                    <p>
                        Production: {{ $movie->production }} /
                        Rated: {{ $movie->rated }} /
                        @if($movie->boxOffice > 0)
                            Box Office: $ {{ $movie->boxOffice }}
                        @endif
                    </p>

                    @if($movie->website !== "N/A")
                        <p>
                            Website: <a href="{{ $movie->website }}">{{ $movie->website }}</a>
                        </p>
                    @endif
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-4.push-right">
                <iframe id="player" type="text/html" width="100%" height="200px"
                        src="http://www.youtube.com/embed/M7lc1UVf-VE?enablejsapi=1&origin=http://example.com"
                        frameborder="0"></iframe>
            </div>
            <div class="col-md-8">
                <br>
                <h3>Awards</h3>
                <p> {{ $movie->awards }}</p>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/scripts.js') }}"></script>
@endsection