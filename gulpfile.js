const elixir = require('laravel-elixir');
var Promise = require('es6-promise').Promise;
var shell = require('gulp-shell');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

gulp.task('langjs', shell.task('php artisan lang:js -c public/js/messages.js'));

elixir(function(mix) {
    mix.task('langjs')
        .copy('node_modules/jquery/dist/jquery.min.js', 'public/js')
        .copy('node_modules/bootstrap/dist/css/bootstrap.min.css', 'public/css')
        .copy('node_modules/bootstrap/dist/js/bootstrap.min.js', 'public/js')
        .copy('node_modules/font-awesome/fonts', 'public/plugins/font-awesome/fonts')
        .copy('node_modules/font-awesome/css/font-awesome.min.css', 'public/plugins/font-awesome/css')
        .copy('resources/assets/templates/survey/css', 'public/templates/survey/css')
        .copy('resources/assets/templates/survey/js', 'public/templates/survey/js')
        .copy('resources/assets/templates/survey/images', 'public/templates/survey/images')
        .copy('resources/assets/templates/survey/js', 'public/templates/survey/js');

});
