const mix = require('laravel-mix');
require('laravel-mix-react-css-modules');

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

mix.react('resources/js/app.js', 'public/js')
    .react('resources/js/pages/project/create.js', 'public/js/pages/project')
    .sass('resources/sass/app.scss', 'public/css');


// CSS module library
mix.reactCSSModules();

// Copy directories
mix.copyDirectory('resources/images', 'public/images');
