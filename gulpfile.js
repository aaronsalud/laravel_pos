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
	    
    	]);
});
