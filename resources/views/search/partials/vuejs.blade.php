<div id="app">
    <ais-index app-id="{{ config('scout.algolia.id') }}"
               api-key="{{ env('ALGOLIA_SEARCH') }}"
               index-name="movies"
               :query-parameters="{
                    maxFacetHits : 20
               }"
    >

        <!-- Other Algolia search components go here -->
        <div class="row">
            <div class="col-md-9">

                <ais-search-box>
                    <div class="input-group">
                        <ais-input
                                placeholder="Search movie by title, actors, genres..."
                                :class-names="{
                                            'ais-input': 'form-control'
                                        }"
                        >

                        </ais-input>

                        <span class="input-group-btn">
                                        <ais-clear :class-names="{'ais-clear': 'btn btn-default'}">
                                          <i class="fas fa-times"></i>
                                        </ais-clear>
                                        <button class="btn btn-default" type="submit">
                                          <i class="fas fa-search"></i>
                                        </button>
                                  </span>
                    </div>
                </ais-search-box>
            </div>
            <div class="col-md-3">
                <ais-powered-by></ais-powered-by>
            </div>
        </div>


        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-12">
                        <hr>
                        <h3>Results</h3>
                        <hr>
                    </div>

                    <ais-results>
                        <template slot-scope="{ result }">
                            <div class="col-md-3" style="display: inline-block">
                                <div class="card card-01 height-fix">
                                    <a v-bind:href="'/movie/'+result.id">
                                        <img class="card-img-top" v-bind:src ="result.poster" alt="Card image cap">
                                    </a>
                                </div>
                            </div>
                        </template>
                    </ais-results>
                    <ais-pagination style="margin: auto" class="pagination" :class-names="{
                                    'ais-pagination': 'pagination',
                                    'ais-pagination__item': 'page-item',
                                    'ais-pagination__link': 'page-link',
                                    'ais-pagination__item--active': 'active',
                                    'ais-pagination__item--disabled': 'disabled'
                                }">
                    </ais-pagination>
                </div>
            </div>

            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-12">
                        <ais-clear :class-names="{'ais-clear' : 'btn btn-default btn-block'}">

                        </ais-clear>
                    </div>
                    <div class="col-md-12">
                        <ais-refinement-list limit=10 attribute-name="actors.name"  :class-names="{
                                            'ais-refinement-list__count': 'badge',
                                            'ais-refinement-list__item': 'checkbox'
                                        }">
                            <h3 slot="header">Actors</h3>
                        </ais-refinement-list>
                    </div>
                    <div class="col-md-12">
                        <ais-refinement-list limit=10 attribute-name="genres.name"  :class-names="{
                                            'ais-refinement-list__count': 'badge',
                                            'ais-refinement-list__item': 'checkbox'
                                        }">
                            <h3 slot="header">Genres</h3>
                        </ais-refinement-list>
                    </div>
                    <div class="col-md-12">
                        <ais-rating attribute-name="rating">

                        </ais-rating>
                    </div>
                </div>
            </div>
        </div>
    </ais-index>
</div>