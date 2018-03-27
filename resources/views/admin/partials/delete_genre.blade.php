<div class="row justify-content-center">
    <div class="col-md-12">
        <hr>
        <div class="card">
            <div class="card-header">
                Delete a genre
            </div>
            <div class="card-body">
                <form action="{{ route('genre.destroy') }}" method="POST">
                    {{csrf_field()}}
                    {{method_field('delete')}}
                    <div class="form-group row">
                        <label for="genreToDelete" class="col-sm-4 col-form-label text-md-right">Select Genre:</label>

                        <div class="col-md-6">
                            <select class="form-control" name="genreToDelete" id="genreToDelete">
                                @foreach($genres as $genre)
                                    <option value="{{ $genre->id }}">{{ $genre->name }}</option>
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