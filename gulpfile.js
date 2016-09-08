const elixir = require('laravel-elixir');

require('laravel-elixir-vue');

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
    mix.scripts([
    	'../bower/vue/dist/vue.min.js',
		'../bower/vue-resource/dist/vue-resource.min.js',
    	'../bower/jquery/dist/jquery.min.js',
	    '../bower/bootstrap/dist/js/bootstrap.min.js',
	    '../bower/metisMenu/dist/metisMenu.min.js',
	    '../bower/jquery.nicescroll/jquery.nicescroll.min.js',
	    
    	]);
	mix.styles([
	    '../bower/bootstrap/dist/css/bootstrap.min.css',
	    '../bower/font-awesome/css/font-awesome.min.css',
    	]);
	mix.copy('resources/assets/bower/bootstrap/fonts', 'public/fonts/');
	mix.copy('resources/assets/bower/font-awesome/fonts', 'public/fonts/');
});
