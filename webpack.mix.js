const mix = require('laravel-mix');

require('laravel-mix-tailwind');
require('laravel-mix-purgecss');

mix.ts('resources/ts/app.ts', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .tailwind()
    .purgeCss()
    .sourceMaps();

mix.webpackConfig({
    resolve: {
        alias: {
            '@ts': path.resolve(
                __dirname,
                'resources/ts'
            )
        }
    }
});
