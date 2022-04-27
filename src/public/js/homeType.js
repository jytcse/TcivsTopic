/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************!*\
  !*** ./resources/js/homeType.js ***!
  \**********************************/
var i = 0;
var content = "許多創意專題等著你!!";
setInterval(function () {
  document.querySelector('#type').textContent += content.charAt(i);
  i++;

  if (i === content.length) {
    setTimeout(function () {
      document.querySelector('#type').textContent = '';
      i = 0;
    }, 2000);
  }
}, 200);
/******/ })()
;