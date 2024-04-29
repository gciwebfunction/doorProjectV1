/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************************!*\
  !*** ./resources/js/shoppingcart/cartview.js ***!
  \***********************************************/
window.onload = function () {
  document.getElementById('goBackToCatalogButton').addEventListener('click', function (event) {
    event.preventDefault();
    window.location = "/dashboard";
  });
  document.getElementById('clearCart').addEventListener('click', function (event) {
    event.preventDefault();
    var cartId = $('#shoppingCartId').val();
    window.location = "/sc/clearcart/" + cartId;
  });
  document.getElementById('wsubmitOrderButton').addEventListener('click', function (event) {
    event.preventDefault();
    $('#cartForm').submit();
  });
};
/******/ })()
;