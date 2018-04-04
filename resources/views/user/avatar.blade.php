@extends('layouts.master')

@section('content')
    @if($hasAvatar)
        <div class="row">
            <div class="col-md-3">
                <img src="{{ asset('storage/avatars/'.$id) }}" alt="" class="img-fluid">
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12 text-center">
            <form action="{{ route('user.avatar') }}" enctype="multipart/form-data" method="POST">
                {{ csrf_field() }}
                <input type="file" name="avatar" class="form-control" accept="image/*">

                @if($hasAvatar)
                    <button type="submit" class="btn btn-dark">Change the avatar</button>
                @else
                    <button type="submit" class="btn btn-dark">Add new avatar</button>
                @endif
            </form>
        </div>
    </div>
@endsection