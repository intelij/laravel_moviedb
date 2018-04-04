@extends('admin.index')

@section('admin_panel')
    @include('admin.partials.add_genre')

    @include('admin.partials.edit_genre')

    @include('admin.partials.delete_genre')
@endsection