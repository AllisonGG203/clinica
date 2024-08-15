const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/build/js')
   .vue() // Solo si usas Vue.js
   .sass('resources/sass/app.scss', 'public/build/css')
   .babelConfig({
       presets: ['@babel/preset-env'],
       sourceType: 'unambiguous' // Le dice a Babel cómo tratar los módulos
   });
