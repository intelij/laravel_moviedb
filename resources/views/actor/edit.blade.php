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
                        <form method="POST" action="{{ route('actor.update',$actor->id ) }}">
                            {{csrf_field()}}
                            {{ method_field('patch') }}

                            <div class="form-group row">
                                <label for="name" class="col-sm-4 col-form-label text-md-right">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ $actor->name }}" required autofocus>
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