@extends('layouts.master')

@section('content')
    <div class="container-fluid">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <hr>
                <div class="card">
                    <div class="card-header">
                        Edit the user
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.update',$user->id ) }}">
                            {{csrf_field()}}
                            {{ method_field('patch') }}

                            <div class="form-group row">
                                <label for="name" class="col-sm-4 col-form-label text-md-right">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">Email</label>

                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control" name="email" value="{{ $user->email }}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-sm-4 col-form-label text-md-right">New Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password">
                                    <small>* Leave empty if you don't want a password change</small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="role" class="col-sm-4 col-form-label text-md-right">Role</label>

                                <div class="col-md-6">
                                    <select class="form-control" id="role" name="role">
                                        @if($role !== "none")
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @foreach(\App\Role::all() as $rol)
                                                @if($rol->name !== $role->name)
                                                    <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            <option value="none">None</option>
                                            @foreach(\App\Role::all() as $rol)
                                                <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>



                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-dark" style="width: 30%">
                                        Edit
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