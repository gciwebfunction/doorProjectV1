/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************!*\
  !*** ./resources/js/order/view.js ***!
  \************************************/
window.onload = function () {
  init();
};

window.deleteOrderRequest = function (id) {
  window.location = "/or/delete/" + id;
};

window.deleteOrder = function (id) {
  window.location = "/o/delete/" + id;
};

function init() {


  $('#orderRequestTable').DataTable({
      order: [[3, 'desc']],
      dom: 'Bfrtip',
      buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
      ]
  });

  $('#orderTable').DataTable({
    dom: 'Bfrtip',
    buttons: [
      'copy', 'csv', 'excel', 'pdf', 'print'
    ]
  });
}
/******/ })()
;