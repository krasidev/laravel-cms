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

mix.setPublicPath('public');
mix.setResourceRoot('../');
mix.js('resources/js/auth.js', 'public/js')
    .js('resources/js/backend.js', 'public/js')
    .js('resources/js/frontend.js', 'public/js')
    .sass('resources/sass/auth.scss', 'public/css')
    .sass('resources/sass/backend.scss', 'public/css')
    .sass('resources/sass/frontend.scss', 'public/css')
    .sourceMaps();
