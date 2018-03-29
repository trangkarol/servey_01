const elixir = require('laravel-elixir');
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
gulp.task('langjs', shell.task('php artisan lang:js -c public/plugins/languages/messages.js'));

elixir(function(mix) {
    mix.task('langjs')
        .copy('node_modules/jquery/dist/jquery.min.js', 'public/plugins/jquery')
        .copy('node_modules/bootstrap/dist/css/bootstrap.min.css', 'public/plugins/bootstrap')
        .copy('node_modules/bootstrap/dist/js/bootstrap.min.js', 'public/plugins/bootstrap')
        .copy('node_modules/font-awesome/fonts', 'public/plugins/font-awesome/fonts')
        .copy('node_modules/font-awesome/css/font-awesome.min.css', 'public/plugins/font-awesome/css')
        .copy('node_modules/jquery-menu-aim/jquery.menu-aim.js', 'public/plugins/jquery-menu-aim')
        .copy('node_modules/pace-progress/pace.min.js', 'public/plugins/pace-progress')
        .copy('node_modules/js-offcanvas/dist/_css/minified/js-offcanvas.css', 'public/plugins/js-offcanvas')
        .copy('node_modules/js-offcanvas/dist/_js/js-offcanvas.min.js', 'public/plugins/js-offcanvas')
        .copy('node_modules/ionicons/dist/css/ionicons.min.css', 'public/plugins/ionicons/css')
        .copy('node_modules/ionicons/dist/fonts', 'public/plugins/ionicons/fonts')
        .copy('node_modules/metismenu/dist/metisMenu.min.css', 'public/plugins/metismenu')
        .copy('node_modules/metismenu/dist/metisMenu.min.js', 'public/plugins/metismenu')
        .copy('node_modules/jquery-ui-dist', 'public/plugins/jquery-ui')
        .copy('resources/assets/templates/survey/css', 'public/templates/survey/css')
        .copy('resources/assets/templates/survey/js', 'public/templates/survey/js')
        .copy('resources/assets/templates/survey/images', 'public/templates/survey/images');
});
