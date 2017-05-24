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

mix.disableNotifications();

// bootstrap
mix.less('node_modules/bootstrap/less/bootstrap.less', 'public/css/bootstrap.css')
	.version();
mix.js('node_modules/bootstrap/dist/js/npm.js', 'public/js/bootstrap.js')
	.version();

// font awesome
mix.sass('node_modules/font-awesome/scss/font-awesome.scss', 'public/css/font-awesome.css')
	.version();

mix.js('resources/assets/js/app.js', 'public/js/app.js')
	.version();
