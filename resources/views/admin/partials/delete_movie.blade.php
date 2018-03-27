<div class="row justify-content-center">
    <div class="col-md-12">
        <hr>
        <div class="card">
            <div class="card-header">
                Delete a movie
            </div>
            <div class="card-body">
                <form action="{{ route('movie.destroy',0) }}" method="POST">
                    {{csrf_field()}}
                    {{method_field('delete')}}
                    <div class="form-group row">
                        <label for="movieToDelete" class="col-sm-4 col-form-label text-md-right">Select Movie:</label>

                        <div class="col-md-6">
                            <select class="form-control" name="movieToDelete" id="movieToDelete">
                                @foreach($moviesToEdit as $movie)
                                    <option value="{{ $movie->id }}">{{ stripslashes($movie->title) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>