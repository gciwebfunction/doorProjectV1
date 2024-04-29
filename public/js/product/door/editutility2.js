/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************************!*\
  !*** ./resources/js/product/door/editutility2.js ***!
  \***************************************************/
window.onload = function () {
  init();
};

function init() {
  $('#doorFinishPriceContainer div').each(function () {
    var idArray = $(this).attr('id').split('-');
    var price = $(this).text();
    $('#finish_price-' + idArray[1] + '-' + idArray[2]).val(price);
  });
  document.getElementById('submitEditButton').addEventListener('click', function (event) {
    event.preventDefault();
    var validation = formIsValid();

    if (validation == '') {
      $('#editProductForm').submit();
    } else {
      alert(validation);
    }
  });
}

function formIsValid() {
  var validation = '';
  $('.dataField').each(function () {
    if ($(this).val().length < 1) return 'Please provide a value for all fields.';
  });
  return validation;
}
/******/ })()
;