const mix = require('laravel-mix');

mix.ts('resources/ts/app.ts', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();
