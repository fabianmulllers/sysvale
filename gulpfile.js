var elixir = require('laravel-elixir');

require('laravel-elixir-vueify');
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

elixir(function(mix) {
    mix.sass('app.scss')
        mix.browserify('appvue.js')
        .styles(['metisMenu.css'],'public/css','node_modules/metismenu/dist')
        .styles(['morris.css'],'public/css','node_modules/morrisjs')
        .styles(['sb-admin-.css'],'public/css','public/css')
         .styles(['bootstrap-select.css'],'public/css/bootstrap-select.css','node_modules/bootstrap-select/dist/css')
        .copy('node_modules/bootstrap-sass/assets/fonts/bootstrap/','public/fonts/bootstrap')
        .copy('node_modules/font-awesome/fonts/','public/fonts/font-awesome');

});






elixir(function(mix) {
    mix.scriptsIn("node_modules/bootstrap-sass/assets/javascripts")
        .scripts(["jquery.js"],'public/js','node_modules/jquery/dist')
        .scripts(["morris.js"],'public/js','node_modules/morrisjs')
        .scripts(['bootstrap-select.js'],'public/js/bootstrap-select.js','node_modules/bootstrap-select/dist/js')
        .scripts(["sb-admin-2.js"],'public/js','public/js')
        .scripts(["enlaces.js"],'public/js','public/js')
        .scripts(["metisMenu.js"],'public/js','node_modules/metismenu/dist')
        .scripts(["vue.js"],'public/js/vue.js','node_modules/vue/dist')
        .scripts(["vue-resource.min.js"],'public/js/vue-resource.min.js','node_modules/vue-resource/dist' );

    



});

