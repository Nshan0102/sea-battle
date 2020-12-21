const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .js('public/assets/js/init-toastr.js', 'public/js')
    .js('public/assets/js/main.js', 'public/js')
    .styles(['public/assets/css/main.css'], 'public/css/main.css')
    .sass('resources/sass/app.scss', 'public/css');
