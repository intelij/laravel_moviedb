@extends('layouts.master')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="row">
                <div class="col-md-12 text-center" id="searchBox">

                </div>
            </div>

            <div class="row">
                <div class="col-md-9" id="hits">

                </div>
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-12" id="actorsRefinementList">

                        </div>

                        <div class="col-md-12" id="genresRefinementList">

                        </div>

                        <div class="col-md-12" id="starRating">

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 text-center" id="pagination">

                </div>
            </div>

        </div>
    </div>
@endsection