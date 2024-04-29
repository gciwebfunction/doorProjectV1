/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*****************************************!*\
  !*** ./resources/js/product/viewone.js ***!
  \*****************************************/
var productTable = document.getElementById('productTable');

if (productTable) {
  productTable.addEventListener('click', function () {
    var tds = this.getElementsByTagName('td');
    var productId = tds[0].innerText;
    location.href = "/p/" + productId;
  });
}
/******/ })()
;