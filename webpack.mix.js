let mix = require('laravel-mix');

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .copy('node_modules/semantic/dist/semantic.min.css', 'public/css/semantic.min.css')
   .copy('node_modules/semantic/dist/semantic.min.js', 'public/js/semantic.min.js')
   .copy('node_modules/jquery/dist/jquery.min.js', 'public/js/jquery.min.js')
   .copy('node_modules/bootstrap-select/dist/js/bootstrap-select.min.js', 'public/js/bootstrap-select.min.js');