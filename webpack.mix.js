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
   .sass('resources/sass/app.scss', 'public/css')
    .copy('node_modules/bootstrap-notify/bootstrap-notify.js', 'public/js')
    .copy('node_modules/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.css', 'public/css')
    .copy('node_modules/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.js', 'public/js');

//mix.copy('node_modules/bootstrap-slider/dist/bootstrap-slider.js', 'public/js/bootstrap-slider.js');
//mix.copy('node_modules/bootstrap-slider/dist/css/bootstrap-slider.css', 'public/css/bootstrap-slider.css');

//mix.copy('node_modules/moment/moment.js', 'public/js/moment.js');
//mix.copy('node_modules/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js', 'public/js/bootstrap-datetimepicker.min.js');
//mix.copy('node_modules/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css', 'public/css/bootstrap-datetimepicker.css');
//mix.copy('node_modules/moment/locale', 'public/js/locale');