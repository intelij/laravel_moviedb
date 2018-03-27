<div class="row justify-content-center">
    <div class="col-md-12">
        <hr>
        <div class="card">
            <div class="card-header">
                Delete an actor
            </div>
            <div class="card-body">
                <form action="{{ route('actor.destroy') }}" method="POST">
                    {{csrf_field()}}
                    {{method_field('delete')}}
                    <div class="form-group row">
                        <label for="actorToDelete" class="col-sm-4 col-form-label text-md-right">Select Actor:</label>

                        <div class="col-md-6">
                            <select class="form-control" name="actorToDelete" id="actorToDelete">
                                @foreach($actors as $actor)
                                    <option value="{{ $actor->id }}">{{ $actor->name }}</option>
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