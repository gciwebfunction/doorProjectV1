/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************************!*\
  !*** ./resources/js/product/door/editutility5.js ***!
  \***************************************************/
window.onload = function () {
  init();
};

function disableOrEnableTextField(id, idType) {
  var checkboxId;
  var elementId;

  if (idType == 'sdlIsNA') {
    elementId = '#sdl_option_price-' + id;
    checkboxId = 'sdlIsNA-' + id;
  }

  if (document.getElementById(checkboxId).checked) {
    $(elementId).attr('disabled', '');
    $(elementId).attr('placeholder', 'N/A');
    $('#'+checkboxId).val(1);
  } else {
    $(elementId).removeAttr('disabled');
    $(elementId).attr('placeholder', 'price');
    $('#'+checkboxId).val(0);
  }
}

function init() {
  $('.dataField').each(function () {
    var id = $(this).attr('id');
    var hiddenIdList = $('#hiddenIdList').val();

    if (hiddenIdList != '') {
      hiddenIdList = hiddenIdList + ",";
    }

    $('#hiddenIdList').val(hiddenIdList + id);
  });
  document.getElementById('continueButton').addEventListener('click', function (event) {
    event.preventDefault();

    if (validateForm()) {
      alert("Please fill out all text fields.");
    } else {
      $('#additionalOptionsPriceForm').submit();
    }
  });
}

$('input[type=checkbox]').each(function () {
  var id = $(this).attr('id');
  var idArray = id.split("-");
  this.addEventListener('click', function (event) {
    disableOrEnableTextField(idArray[1], idArray[0]);
  });
});

function validateForm() {
  var failed = false;
  $('.dataField').each(function (i, e) {});
  return failed;
}
/******/ })()
;