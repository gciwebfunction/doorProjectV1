/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************************************!*\
  !*** ./resources/js/product/utility3-changecategory.js ***!
  \*********************************************************/
window.onload = function () {
  init();
};

function init() {
  document.getElementById('backButton').addEventListener('click', function (event) {
    event.preventDefault();
    var productId = $('#productId').val();
    window.location = '/p/createflowsteptwo/' + productId;
  });
  document.getElementById('saveChanges').addEventListener('click', function (event) {
    event.preventDefault();
    $('#updateCategoryForm').submit();
  });
}
/******/ })()
;