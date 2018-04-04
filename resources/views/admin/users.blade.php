@extends('admin.index')

@section('admin_panel')
    @include('admin.partials.add_user')

    @include('admin.partials.edit_user_role')

    @include('admin.partials.edit_user')

    @include('admin.partials.delete_user')
@endsection