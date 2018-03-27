<div class="row justify-content-center">
    <div class="col-md-12">
        <hr>
        <div class="card">
            <div class="card-header">
                Edit an user
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="editUsers" class="col-sm-4 col-form-label text-md-right">Select User:</label>

                    <div class="col-md-6">
                        <select class="form-control" id="editUsers">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <a href="user/{{$users->first()->id}}/edit" class="btn btn-dark" id="editUsersLink"> Edit </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>