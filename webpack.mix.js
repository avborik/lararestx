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

// mix.js('resources/js/app.js', 'public/js')
//    .sass('resources/sass/app.scss', 'public/css');

mix.sass('resources/sass/myStyle.scss', 'public/css/myStyleConv.css')
.sass('resources/sass/myOtherStyle.scss', 'public/css')
.less('resources/less/styleLess.less','public/css')
.js([
   'resources/js/app.js',
   'resources/js/bootstrap.js'
],'public/js/main.js').version();


mix.styles([
   'public/css/myOtherStyle.css',
   'public/css/app.css'
], 'public/css/mybundlecss.css');

mix.copy('resources/whatever/what.json','public/res/what.json'),
mix.copy('resources/whatever/','public/whatever/');