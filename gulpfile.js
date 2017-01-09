const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

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

elixir(mix => {
    mix.sass('app.scss')
   .webpack('app.js')
   .scripts(['admin-script.js'], 'public/admin/js/admin-script.js')
   .copy('resources/assets/fonts', 'public/admin/fonts')
   .browserSync({
        proxy: 'http://localhost:8000/',
        proxy: 'http://survey.com/'
    });
});
