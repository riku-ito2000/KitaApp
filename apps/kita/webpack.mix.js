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
    .styles([
        'resources/css/app.css', // メインの CSS ファイル
        // 'resources/css/extra.css', // その他の CSS ファイルがある場合
    ], 'public/css/all.css');

// バージョニング（キャッシュバスティング）
if (mix.inProduction()) {
    mix.version();
}


