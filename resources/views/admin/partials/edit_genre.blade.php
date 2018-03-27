<div class="row justify-content-center">
    <div class="col-md-12">
        <hr>
        <div class="card">
            <div class="card-header">
                Edit genre
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="editGenre" class="col-sm-4 col-form-label text-md-right">Select Genre:</label>

                    <div class="col-md-6">
                        <select class="form-control" id="editGenre">
                            @foreach($genres as $genre)
                                <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <a href="genre/{{ $genre->first()->id }}/edit" class="btn btn-dark" id="editGenreLink"> Edit </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>