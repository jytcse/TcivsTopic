/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************!*\
  !*** ./resources/js/homeSlider.js ***!
  \************************************/
var slide = document.querySelectorAll('.custom_slide');
var offset_value = -100;
slide[0].style.marginLeft = 0 + 'vw'; //每五秒自動輪播 方法是對第一個slide使用margin-left 後面的slide會自動補上 每次輪播位移單位-100vw

setInterval(function () {
  slide[0].style.marginLeft = offset_value + 'vw';
  offset_value -= 100; //輪播到最後一個，重置位移量 (讓第一個slide歸位

  if (offset_value === slide.length * -100) {
    offset_value = 0;
    slide.style.marginLeft = offset_value + 'vw';
  }
}, 5000);
/******/ })()
;