let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/app.js', 'public/js')
    .js('resources/assets/js/scripts.js', 'public/js')
    .js('resources/assets/js/admin.js', 'public/js')
    .js('resources/assets/js/movie_edit.js', 'public/js')
    .js('resources/assets/js/user_profile.js','public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
    .sass('resources/assets/sass/movie_preview.scss', 'public/css')
    .sass('resources/assets/sass/subscripe_plan.scss','public/css');

mix.styles([
    'resources/assets/css/custom.css'
], 'public/css/all.css');
