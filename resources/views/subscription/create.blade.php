@extends('layouts.master')

@section('content')
    <link type="text/css" rel="stylesheet"  href="{{ asset('css/subscripe_plan.css') }}">
    <div class="container">
        <div class="row flex-items-xs-middle flex-items-xs-center">

            <!-- Basic Plan Table  -->
            @include('subscription.partials.basic_plan')

            <!-- Regular Plan Table  -->
            @include('subscription.partials.regular_plan')

            <!-- Premium Plan Table  -->
            @include('subscription.partials.premium_plan')

        </div>
    </div>
@endsection