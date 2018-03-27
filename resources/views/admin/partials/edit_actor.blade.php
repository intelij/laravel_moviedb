<div class="row justify-content-center">
    <div class="col-md-12">
        <hr>
        <div class="card">
            <div class="card-header">
                Edit actor
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="editActor" class="col-sm-4 col-form-label text-md-right">Select Actor:</label>

                    <div class="col-md-6">
                        <select class="form-control" id="editActor">
                            @foreach($actors as $actor)
                                <option value="{{ $actor->id }}">{{ $actor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <a href="actor/{{ $actors->first()->id }}/edit" class="btn btn-dark" id="editActorLink"> Edit </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>