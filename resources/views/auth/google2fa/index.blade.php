@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-center">
                    <div class="card-header">Register</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('google2fa.validate') }}">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="one_time_password" class="control-label">One Time Password</label>

                                <div class="col-md-6 mx-auto">
                                    <input id="one_time_password" type="number" class="form-control" name="one_time_password" required autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 mx-auto">
                                    <button type="submit" class="btn btn-dark">
                                        Login
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection