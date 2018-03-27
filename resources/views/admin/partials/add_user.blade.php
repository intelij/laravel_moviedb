<div class="row justify-content-center">
    <div class="col-md-12">
        <hr>
        <div class="card">
            <div class="card-header">
                Add a user
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('user.store')}}">
                    {{csrf_field()}}

                    <div class="form-group row">
                        <label for="name" class="col-sm-4 col-form-label text-md-right">Name</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" required autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-4 col-form-label text-md-right">Email</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-sm-4 col-form-label text-md-right">Password</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm" class="col-sm-4 col-form-label text-md-right">Password Confirmation</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="role" class="col-sm-4 col-form-label text-md-right">Role</label>

                        <div class="col-md-6">
                            <select id="role" name="role" class="form-control" required>
                                <option value="0">member</option>
                                @foreach(\App\Role::all() as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-dark">
                                Add user
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