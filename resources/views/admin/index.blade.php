@extends('layouts.master')

@section('content')
    <script src="{{ asset('js/admin.js') }}"></script>
    <div class="container-fluid">
        <hr>
        <div class="row">
            <div class="col-md 3">
                <a href="{{ route('admin.movies') }}" class="btn btn-dark btn-block">Movies</a>
            </div>
            @admin
            <div class="col-md 3">
                <a href="{{ route('admin.users') }}" class="btn btn-dark btn-block">Users</a>
            </div>
            @endadmin
            <div class="col-md 3">
                <a href="{{ route('admin.actors') }}" class="btn btn-dark btn-block">Actors</a>
            </div>
            <div class="col-md 3">
                <a href="{{ route('admin.genres') }}" class="btn btn-dark btn-block">Genres</a>
            </div>
        </div>
        @yield('admin_panel')
    </div>
@endsection