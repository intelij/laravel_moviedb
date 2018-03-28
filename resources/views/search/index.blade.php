@extends('layouts.master')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div id="app">
                <ais-index app-id="{{ config('scout.algolia.id') }}"
                           api-key="{{ env('ALGOLIA_SEARCH') }}"
                           index-name="movies">

                    <!-- Other Algolia search components go here -->
                    <ais-powered-by></ais-powered-by>

                    <ais-search-box></ais-search-box>

                    <ais-refinement-list attribute-name="actors.name"></ais-refinement-list>
                    <ais-refinement-list attribute-name="genres.name"></ais-refinement-list>

                    <ais-results>
                        <template scope="{ result }">
                            <div>
                                <h1>@{{ result.title }}</h1>
                                <ul>
                                    <li v-for="actor in result.actors">
                                        @{{ actor.name }}
                                    </li>
                                </ul>
                            </div>
                        </template>
                    </ais-results>

                </ais-index>
            </div>
        </div>
    </div>
@endsection