@extends('layouts.master')

@section('content')
    <div class="container-fluid">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <hr>
                <div class="card">
                    <div class="card-header">
                        Add a movie
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('movie.store') }}">
                            {{csrf_field()}}

                            <div class="form-group row">
                                <label for="title" class="col-sm-4 col-form-label text-md-right">Movie Title *</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control" name="title" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="runtime" class="col-sm-4 col-form-label text-md-right">Runtime</label>

                                <div class="col-md-6">
                                    <input id="runtime" type="number" min="0" class="form-control" name="runtime">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="released" class="col-sm-4 col-form-label text-md-right">Released</label>

                                <div class="col-md-6">
                                    <input id="released" type="date" class="form-control" name="released">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="director" class="col-sm-4 col-form-label text-md-right">Director</label>

                                <div class="col-md-6">
                                    <input id="director" type="text" class="form-control" name="director">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="plot" class="col-sm-4 col-form-label text-md-right">Plot</label>

                                <div class="col-md-6">
                                    <textarea id="plot" name="plot" class="form-control" rows="10"></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="poster" class="col-sm-4 col-form-label text-md-right">Poster</label>

                                <div class="col-md-6">
                                    <input id="poster" type="text" class="form-control" name="poster">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="country" class="col-sm-4 col-form-label text-md-right">Country</label>

                                <div class="col-md-6">
                                    <input id="country" type="text" class="form-control" name="country">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="rated" class="col-sm-4 col-form-label text-md-right">Rated</label>

                                <div class="col-md-6">
                                    <input id="rated" type="text" class="form-control" name="rated">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="language" class="col-sm-4 col-form-label text-md-right">Language</label>

                                <div class="col-md-6">
                                    <input id="language" type="text" class="form-control" name="language">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="imdbRating" class="col-sm-4 col-form-label text-md-right">IMDB Rating</label>

                                <div class="col-md-6">
                                    <input id="imdbRating" type="number" min="0" max="10" step="0.1"  class="form-control" name="imdbRating">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="boxOffice" class="col-sm-4 col-form-label text-md-right">BoxOffice</label>

                                <div class="col-md-6">
                                    <input id="boxOffice" type="number" min="0" class="form-control" name="boxOffice">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="production" class="col-sm-4 col-form-label text-md-right">Production</label>

                                <div class="col-md-6">
                                    <input id="production" type="text" class="form-control" name="production">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="awards" class="col-sm-4 col-form-label text-md-right">Awards</label>

                                <div class="col-md-6">
                                    <input id="awards" type="text" class="form-control" name="awards">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="website" class="col-sm-4 col-form-label text-md-right">Website</label>

                                <div class="col-md-6">
                                    <input id="website" type="text" class="form-control" name="website">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="imbdId" class="col-sm-4 col-form-label text-md-right">IMDB Id</label>

                                <div class="col-md-6">
                                    <input id="imbdId" type="text" class="form-control" name="imbdId">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="actors" class="col-sm-4 col-form-label text-md-right">Actors</label>

                                <div class="col-md-6">
                                    <select name="actors[]" id="actors" class="form-control" multiple>
                                        @foreach($actors as $actor)
                                            <option value="{{ $actor->id }}">{{ $actor->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="genres" class="col-sm-4 col-form-label text-md-right">Genres</label>

                                <div class="col-md-6">
                                    <select name="genres[]" id="genres" class="form-control" multiple>
                                        @foreach($genres as $genre)
                                            <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-dark" style="width: 30%">
                                        Add
                                    </button>
                                </div>
                            </div>
                        </form>

                        @if($errors->any())
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection