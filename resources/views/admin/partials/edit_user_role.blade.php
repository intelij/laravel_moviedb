<div class="row justify-content-center">
    <div class="col-md-12">
        <hr>
        <div class="card">
            <div class="card-header">
                Edit user role
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('user.updateRoll') }}">
                    {{ csrf_field() }}
                    {{ method_field('patch') }}

                    <div class="form-group row">
                        <label for="users" class="col-sm-4 col-form-label text-md-right">Select User:</label>

                        <div class="col-md-6">
                            <select class="form-control" id="users" name="users">
                                <option value="" disabled selected>Select a user</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="new_role" class="col-sm-4 col-form-label text-md-right">Select New Role:</label>

                        <div class="col-md-6">
                            <select class="form-control" id="new_role" name="new_role">
                                <option value="" disabled selected>Select a role</option>
                                @foreach(App\Role::all() as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-dark">
                                Edit
                            </button>
                        </div>
                    </div>

                    @if($errors->any())
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                </form>
            </div>
        </div>
    </div>
</div>