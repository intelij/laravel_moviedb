<div class="row justify-content-center">
    <div class="col-md-12">
        <hr>
        <div class="card">
            <div class="card-header">
                Edit a movie
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="movieToEdit" class="col-sm-4 col-form-label text-md-right">Select Movie:</label>

                    <div class="col-md-6">
                        <select class="form-control" id="movieToEdit">
                            @foreach($moviesToEdit as $movie)
                                <option value="{{ $movie->id }}">{{ stripslashes($movie->title) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <a href="movie/{{ $moviesToEdit->first()->id }}/edit" class="btn btn-dark" id="editMovieLink"> Edit </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>