const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js/app.js')
.sass('resources/sass/app.scss', 'public/css');
mix.copy('resources/images', 'public/images');



mix.copy('vue/dist/css', 'public/css')
    .copy('vue/dist/js', 'public/js')
    .copy('vue/dist/img', 'public/img')
    .copy('vue/dist/fonts', 'public/fonts')
    .copy('vue/dist/favicon.ico', 'public/favicon.ico')
    .copy('vue/dist/loader.css', 'public/loader.css')
    .copy('vue/dist/loading.svg', 'public/loading.svg')
    // .copy('vue/dist/logo.png', 'public/logo.png')
    .copy('vue/dist/index.html', 'resources/views/vue.blade.php')


