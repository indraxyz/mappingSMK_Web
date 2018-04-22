let mix = require('laravel-mix');

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

mix.styles([
   		'node_modules/noty/lib/noty.css',
	    'node_modules/semantic-ui/dist/semantic.css',
	    'resources/assets/css/login.css',
	    'resources/assets/css/global.css'
	], 'public/css/admin.css')
   .scripts([
   		'node_modules/noty/lib/noty.js',
	    'node_modules/jquery/dist/jquery.js',
	    'node_modules/semantic-ui/dist/semantic.js',
	    'resources/assets/js/login.js',
	    'resources/assets/js/admin.js'
	], 'public/js/admin.js');
