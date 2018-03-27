@extends('layouts.master')

@section('content')
    <link type="text/css" rel="stylesheet"  href="{{ asset('css/subscripe_plan.css') }}">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center"> Change Plan</h2>
            <hr>
        </div>
    </div>
    <div class="row">
            @include('subscription.partials.basic_plan')

            @include('subscription.partials.regular_plan')

            @include('subscription.partials.premium_plan')
    </div>
    <div class="row">
        <div class="col-md-12">
            <hr>
                <h2 class="text-center">Payments</h2>
            <hr>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col">Total</th>
                    <th scope="col">PDF</th>
                </tr>
                </thead>
                @for($i = 0; $i < count($invoices); $i++)
                    <tr>
                        <th scope="row">{{ $i+1 }}</th>
                        <td>{{ $invoices[$i]->date()->toFormattedDateString() }}</td>
                        <td>{{ $invoices[$i]->total() }}</td>
                        <td><a href="/account/invoice/{{ $invoices[$i]->id }}" class="btn btn-dark"><i class="fas fa-file-pdf"></i> Download</a></td>
                    </tr>
                @endfor
            </table>
        </div>
    </div>
@endsection