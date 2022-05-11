const mix = require('laravel-mix');
mix.disableNotifications(); //取消通知
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
// let path = require('path');
// let filePath = path.resolve('resources/');
// //呼叫檔案遍歷方法
// console.log(filePath);
// fileDisplay(filePath);
//
// /**
//  * 檔案遍歷方法
//  * https://codertw.com/%E5%89%8D%E7%AB%AF%E9%96%8B%E7%99%BC/230209/
//  * @param filePath 需要遍歷的檔案路徑
//  */
// function fileDisplay(filePath) {
//     //根據檔案路徑讀取檔案，返回檔案列表
//     fs.readdir(filePath, function (err, files) {
//         if (err) {
//             console.warn(err)
//             return;
//         }
//         //遍歷讀取到的檔案列表
//         files.forEach(function (filename) {
//             //獲取當前檔案的絕對路徑
//             let filedir = String.raw`${path.join(filePath, filename)}`;
//             // console.log(filedir);
//             //根據檔案路徑獲取檔案資訊，返回一個fs.Stats物件
//             if (!filedir.includes('views') && !filedir.includes('img')) {
//                 fs.stat(filedir, function (eror, stats) {
//                     if (eror) {
//                         console.warn('獲取檔案stats失敗');
//                     } else {
//                         let isFile = stats.isFile();//是檔案
//                         let isDir = stats.isDirectory();//是資料夾
//                         if (isFile) {
//                             let absoluteFileDir = String.raw`${filedir.slice(filedir.indexOf('resources')).replace(/\\/g, "/")}`;
//                             // 取得副檔名
//                             let extname = path.extname(absoluteFileDir);
//                             console.log(extname);
//                             if (extname === '.js') {
//                                 //編譯js檔案到public/js
//                                 mix.js(absoluteFileDir, jsFolder);
//                             } else if (extname === '.css') {
//                                 //編譯css檔案到public/css
//                                 mix.css(absoluteFileDir, cssFolder);
//                             }
//                         }
//                         if (isDir) {
//                             fileDisplay(filedir);//遞迴，如果是資料夾，就繼續遍歷該資料夾下面的檔案
//                         }
//                     }
//                 })
//             }
//         });
//     });
// }


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
    // console.log(baseCssPath + filepath);
});
//編譯js檔案到public/js
getFiles(baseJsPath).forEach(function (filepath) {
    mix.js(baseJsPath + filepath, jsFolder);
    // console.log(baseJsPath + filepath);
});



