const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .autoload({
        jquery: ['$', 'window.jQuery']  // jQueryを自動的にグローバルに割り当てる
    })
    .options({
        processCssUrls: false  // CSS内のURL変換を無効化
    });

// バージョニング（キャッシュバスティング）
if (mix.inProduction()) {
    mix.version();
}


