/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************************!*\
  !*** ./resources/js/orderrequest/view.js ***!
  \*******************************************/
window.onload = function () {
  init();
};

window.deleteOrderRequest = function (id) {
  window.location = "/or/delete/" + id;
};

function init() {
  $('#orderRequestTable').DataTable();
}
/******/ })()
;