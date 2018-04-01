
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import instantsearch from 'instantsearch.js/es';

import {searchBox} from 'instantsearch.js/es/widgets';

import {hits} from 'instantsearch.js/es/widgets';

import {refinementList} from 'instantsearch.js/es/widgets';

import {starRating} from 'instantsearch.js/es/widgets';

import {pagination} from 'instantsearch.js/es/widgets';

import InstantSearch from 'vue-instantsearch';

import AlgoliaComponents from 'vue-instantsearch';

Vue.use(InstantSearch);
Vue.use(AlgoliaComponents);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));


$(document).ready(function () {
    const app = new Vue({
        el: '#app'
    });

    const search = instantsearch({
        appId: 'IBCEGVJG4T',
        apiKey: '7b724e1496fcece67f8d42559b901677',
        indexName: 'movies',
        urlSync: true
    });

    search.addWidget(searchBox({
        container: '#searchBox',
        placeholder: 'Search for movies....',
        poweredBy: true
    }));

    search.addWidget(hits({
        container: '#hits',
        templates: {
            empty: '<h3>Sorry no result met your criteria.</h3>',
            item: '' +
            '   <div class="card card-01 height-fix">' +
            '       <a href="/movie/{{ id }}">' +
            '           <img class="card-img-top" src ="{{ poster }}" alt="Card image cap">' +
            '       </a>' +
            '   </div>'
        },
        cssClasses: {
            item: 'col-md-3'
        }
    }));

    search.addWidget(refinementList({
        container: '#actorsRefinementList',
        attributeName: 'actors.name',
        sortBy: ['isRefined','name:desc'],
        limit: 10,
        searchForFacetValues: {
            placeholder: 'Search for actors',
            escapeFacetValues: true
        },
        templates: {
            header: 'Filter By Actor'
        }
    }));

    search.addWidget(refinementList({
        container: '#genresRefinementList',
        attributeName: 'genres.name',
        sortBy: ['isRefined','name:desc'],
        limit: 10,
        searchForFacetValues: {
            placeholder: 'Search for genres',
            escapeFacetValues: true
        },
        templates: {
            header: 'Filter By Genre'
        }
    }));

    search.addWidget(starRating({
        container: '#starRating',
        attributeName: 'rating',
        labels: {
            andUp: 'Or Above'
        },
        templates: {
            header: 'Star Rating'
        }
    }));

    search.addWidget(pagination({
        container: '#pagination',
        maxPages: 20,
        scrollTo: '#searchBox'
    }));

    search.start();
});
