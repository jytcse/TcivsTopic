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
const cssFolder = 'public/css';
const jsFolder = 'public/js';
let baseJsPath = 'resources/js/';
let baseCssPath = 'resources/css/';

let fs = require('fs');
mix.disableNotifications();
const getFiles = function (dir) {
    // get all 'files' in this directory
    // filter directories
    return fs.readdirSync(dir).filter(file => {
        return fs.statSync(`${dir}/${file}`).isFile();
    });
};
//編譯css檔案到public/css
getFiles(baseCssPath).forEach(function (filepath) {
    mix.css(baseCssPath + filepath, cssFolder);
});
//編譯js檔案到public/js
getFiles(baseJsPath).forEach(function (filepath) {
    mix.js(baseJsPath + filepath, jsFolder);
});

