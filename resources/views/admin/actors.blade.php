@extends('admin.index')

@section('admin_panel')
    @include('admin.partials.add_actor')

    @include('admin.partials.edit_actor')

    @include('admin.partials.delete_actor')
@endsection