const mix = require('laravel-mix');
require('laravel-mix-eslint');
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

mix.js('resources/js/app.js', 'public/js').eslint({
        fix: false,
        cache: false,
    }).js('resources/js/admin.js', 'public/js').eslint({
        fix: false,
        cache: false,
    })
   .sass('resources/sass/app.scss', 'public/css');
