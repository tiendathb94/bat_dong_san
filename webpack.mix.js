const mix = require('laravel-mix')
require('laravel-mix-react-css-modules')

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

mix
    .react('resources/js/app.js', 'public/js')
    .react('resources/js/pages/project/form.js', 'public/js/pages/project')
    .react('resources/js/pages/project/manage.js', 'public/js/pages/project')
    .react('resources/js/pages/project/search.js', 'public/js/pages/project')
    .react('resources/js/pages/investor/form.js', 'public/js/pages/investor')
    .react('resources/js/pages/users/info.js', 'public/js/pages/users')
    .react('resources/js/pages/news/editor.js', 'public/js/pages/news')
    .react('resources/js/pages/news/project.js', 'public/js/pages/news')
    .react('resources/js/pages/investor/manage.js', 'public/js/pages/investor')
    .react('resources/js/pages/posts/create_sell.js', 'public/js/pages/posts')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/pages/project/form.scss', 'public/css/pages/project')
    .sass('resources/sass/pages/investor/form.scss', 'public/css/pages/investor')
    .sass('resources/sass/pages/users/index.scss', 'public/css/pages/users')
    .sass('resources/sass/pages/auth/reset-password.scss', 'public/css/pages/auth')
    .sass('resources/sass/layouts/personal.scss', 'public/css/layouts')
    .sass('resources/sass/pages/project/project-detail.scss', 'public/css/pages/project')
    .sass('resources/sass/pages/news/show.scss', 'public/css/pages/news')
    .sass('resources/sass/partials/navbar.scss', 'public/css/partials')
    .sass('resources/sass/pages/news/index.scss', 'public/css/pages/news')
    .sass('resources/sass/partials/company-detail.scss', 'public/css/partials')
    .sass('resources/sass/partials/project/project-items-card.scss', 'public/css/partials/project')
    .sass('resources/sass/partials/project/project-items-row.scss', 'public/css/partials/project')
    .sass('resources/sass/partials/project/block-show-categories-with-province.scss', 'public/css/partials/project')
    .sass('resources/sass/pages/project/project-landing.scss', 'public/css/pages/project')
    .sass('resources/sass/pages/project/project-category.scss', 'public/css/pages/project')
    .sass('resources/sass/partials/project/block-search.scss', 'public/css/partials/project')
    .sass('resources/sass/pages/posts/create_sell.scss', 'public/css/pages/posts')

// CSS module library
mix.reactCSSModules()

// Copy directories
mix.copyDirectory('resources/images', 'public/images')
