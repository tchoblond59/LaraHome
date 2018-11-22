const { mix } = require('laravel-mix');

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
   .sass('resources/assets/sass/app.scss', 'public/css');

//mix.copy('node_modules/bootstrap-slider/dist/bootstrap-slider.js', 'public/js/bootstrap-slider.js');
//mix.copy('node_modules/bootstrap-slider/dist/css/bootstrap-slider.css', 'public/css/bootstrap-slider.css');

//mix.copy('node_modules/moment/moment.js', 'public/js/moment.js');
//mix.copy('node_modules/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js', 'public/js/bootstrap-datetimepicker.min.js');
//mix.copy('node_modules/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css', 'public/css/bootstrap-datetimepicker.css');
//mix.copy('node_modules/moment/locale', 'public/js/locale');