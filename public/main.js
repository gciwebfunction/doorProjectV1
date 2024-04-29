/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************************!*\
  !*** ./resources/js/product/utility2.js ***!
  \******************************************/
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

var productSizeCodeList = [];
var finishList = [];
var addOnOptionList = [];
var productSizeCodeCount = 0;
var finishOptionCount = 0;
var addOnOptionCount = 0;
var finishOptionOptionsHtml = "";
var productSizeCodeListHtml = "";
var addOnOptionListHtml = "";
var colorCodeCount = 0;

window.onload = function () {
  init();
};

function getTextArrayFromCSV(rawText) {
  rawText = rawText.replaceAll('\n', '');
  rawText = rawText.replaceAll('\r', '');
  return rawText.split(",");
}

function addColorCode() {
  colorCodeCount++;
  $('#addColorCodePlaceholder').append('<div class="row flex">' + '<div class="col-3 m-2 p-3">' + '<span class="font-thin" style="font-size: smaller">Color Code<span>' + '</div>' + '<div class="col-sm m-1 p-2">' + '<input class="form-control-sm" type="text" id="finishOption' + finishOptionCount + 'colorCode' + colorCodeCount + '">' + '</div>' + '</div>');
}

function init() {
  $('.productSizeCode').each(function (index) {
    var rawText = $(this).text();
    var textArray = getTextArrayFromCSV(rawText);
    var code = new ProductSizeCode();

    if (textArray[0]) {
      code.id = textArray[0].trim();
    }

    if (textArray[1]) {
      code.code = textArray[1].trim();
    }

    if (textArray[2]) {
      code.width = textArray[2].trim();
    }

    if (textArray[3]) {
      code.height = textArray[3].trim();
    }

    productSizeCodeList[index] = code;
  });
  $('.finishOptionOptions').each(function (index) {
    var finishRawText = $(this).val();
    var textArray = getTextArrayFromCSV(finishRawText);
    var finish = new FinishOption();

    if (textArray[0]) {
      finish.id = textArray[0].trim();
    }

    if (textArray[1]) {
      finish.finishName = textArray[1].trim();
    }

    if (textArray[2]) {
      finish.finishDescription = textArray[2].trim();
    }

    finishList[index] = finish;
  });
  $('.addOnOption').each(function (index) {
    var addOnRawText = $(this).val();
    var textArray = getTextArrayFromCSV(addOnRawText);
    var addOnOption = new AddOnOption();

    if (textArray[0]) {
      addOnOption.id = textArray[0].trim();
    }

    if (textArray[1]) {
      addOnOption.addOnOption = textArray[1].trim();
    }

    if (textArray[2]) {
      addOnOption.addOnOptionDescription = textArray[2].trim();
    }

    if (textArray[3]) {
      addOnOption.isPerPanel = textArray[3].trim();
    }

    if (textArray[4]) {
      addOnOption.isPerLight = textArray[4].trim();
    }

    if (textArray[5]) {
      addOnOption.isPriceSameForAllSizes = textArray[5].trim();
    }

    addOnOptionList[index] = addOnOption;
  });

  for (var i = 0; i < productSizeCodeList.length; i++) {
    productSizeCodeListHtml = productSizeCodeListHtml + "<option value='" + productSizeCodeList[i].id + "-" + productSizeCodeList[i].width + "-" + productSizeCodeList[i].height + "'>" + productSizeCodeList[i].code + "</option>";
  }

  for (var _i = 0; _i < finishList.length; _i++) {
    finishOptionOptionsHtml = finishOptionOptionsHtml + "<option value='" + finishList[_i].id + "-" + finishList[_i].finishName + "-" + finishList[_i].finishDescription + "'>" + finishList[_i].finishName + " " + finishList[_i].finishDescription + "</option>";
  }

  for (var _i2 = 0; _i2 < addOnOptionList.length; _i2++) {
    addOnOptionListHtml = addOnOptionListHtml + "<option value='" + addOnOptionList[_i2].id + "," + addOnOptionList[_i2].addOnOption + "," + addOnOptionList[_i2].addOnOptionDescription + "," + addOnOptionList[_i2].addOnOptionPrice + "," + addOnOptionList[_i2].isPerLight + "," + addOnOptionList[_i2].isPerPanel + "," + addOnOptionList[_i2].isPriceSameForAllSizes + "'>" + addOnOptionList[_i2].addOnOption + "</option>";
  }

  $(document).on("keypress", "input", function (e) {
    if (e.which == 13) {
      e.preventDefault();
    }
  });
  document.getElementById('addFinishOptionButton').addEventListener('click', function (event) {
    event.preventDefault();
    $('#saveFinishOptionButtonContainer').removeClass("d-none");
    $('#addFinishOptionButtonContainer').addClass("d-none");
  });
  document.getElementById('saveFinishOptionButton').addEventListener('click', function (event) {
    event.preventDefault();
    $('#savedFinishOptionPlaceholder').append('<div class="row flex m-1 p-1">' + '<div class="col-2 m-1 p-2">' + $('#finishSizeCode' + finishOptionCount).val() + '<input type="hidden" name="finishSizeCode' + finishOptionCount + '" value="' + $('#finishSizeCode' + finishOptionCount).val() + '" >' + '</div>' + '<div class="col-6 m-1 p-2">' + $('#finishOption' + finishOptionCount).val() + '<input type="hidden" name="finishOption' + finishOptionCount + '" value="' + $('#finishOption' + finishOptionCount).val() + '" >' + '</div>' + '<div class="col-3 m-1 p-2">' + $('#finishUnitPrice' + finishOptionCount).val() + '<input type="hidden" name="finishUnitPrice' + finishOptionCount + '" value="' + $('#finishUnitPrice' + finishOptionCount).val() + '" >' + '</div>' + '<div class="d-none">' + '<input type="hidden" name="finishOptionHeightInches' + finishOptionCount + '" value="' + $('#finishOptionHeightInches' + finishOptionCount).val() + '" >' + '<input type="hidden" name="finishOptionWidthInches' + finishOptionCount + '" value="' + $('#finishOptionWidthInches' + finishOptionCount).val() + '" >' + '</div>' + '</div>');
    document.getElementById('rawAddFinishOptionContainer' + finishOptionCount).remove();
    $('#saveFinishOptionButtonContainer').addClass("d-none");
    $('#addFinishOptionButtonContainer').removeClass("d-none");
    finishOptionCount++;
    $('#finishOptionCount').val(finishOptionCount);
  });
  document.getElementById('addOnOptionButton').addEventListener('click', function (event) {
    event.preventDefault();
    $('#addOnOptionPlaceholder').append('<div class="container rounded-3" style="border: 1px solid gray" id="rawAddAddOnOptionContainer' + addOnOptionCount + '">' + '<input type="hidden" name="addOnOption"' + addOnOptionCount + '>' + '<div class="row flex">' + '<div class="col-3 m-2 p-3">' + '<span class="font-thin" style="font-size: smaller">Add On Option</span>' + '</div>' + '<div class="col-sm m-1 p-2">' + '<input class="form-control-sm" type="text" id="addOnOption' + addOnOptionCount + '">' + '</div>' + '</div>' + '<div class="row flex">' + '<div class="col-3 m-2 p-3">' + '<span class="font-thin" style="font-size: smaller">Size Code</span>' + '</div>' + '<div class="col-sm m-1 p-2">' + '<input id="addOnOptionSizeCode' + addOnOptionCount + '" type="text" list="sizeCodeList" class="form-control-sm">' + '</div>' + '</div>' + '<div class="row flex">' + '<div class="col-3 m-2 p-3">' + '<span class="font-thin" style="font-size: smaller">Add On Price</span>' + '</div>' + '<div class="col-sm m-1 p-2">' + '<input class="form-control-sm" type="number" id="addOnOptionPrice' + addOnOptionCount + '">' + '</div>' + '</div>' + '<div class="row flex">' + '<div class="col-2 m-2 p-3">' + '<span class="font-thin" style="font-size: smaller">Is Per Panel</span>' + '</div>' + '<div class="col-1 m-2 p-3">' + '<input class="form-control-sm" type="checkbox" id="addOnOptionIsPerPanel' + addOnOptionCount + '">' + '</div>' + '<div class="col-2 m-2 p-3">' + '<span class="font-thin mr-2" style="font-size: smaller">Is Per Light</span>' + '</div>' + '<div class="col-1 m-2 p-3">' + '<input class="form-control-sm" type="checkbox" id="addOnOptionIsPerLight' + addOnOptionCount + '">' + '</div>' + '<div class="col-2 m-2 p-3">' + '<span class="font-thin mr-2" style="font-size: smaller">Price Same All Sizes</span>' + '</div>' + '<div class="col-1 m-2 p-3">' + '<input class="form-control-sm" type="checkbox" id="addOnOptionIsPriceSameAllSizes' + addOnOptionCount + '">' + '</div>' + '</div>' + '</div>');
    $('#saveAddOnOptionButtonContainer').removeClass("d-none");
    $('#addOnOptionButtonContainer').addClass("d-none");
  });
  document.getElementById('saveAddOnOptionButton').addEventListener('click', function (event) {
    event.preventDefault();
    $('#savedAddOnOptionsPlaceholder').append('' + '<div class="row flex m-1 p-1">' + '<div class="col-2 m-1 p-2">' + $('#addOnOption' + addOnOptionCount).val() + '<input type="hidden" name="addOnOption' + addOnOptionCount + '" value="' + $('#addOnOption' + addOnOptionCount).val() + '" >' + '</div>' + '<div class="col-4 m-1 p-2">' + $('#addOnOptionSizeCode' + addOnOptionCount).val() + '<input type="hidden" name="addOnOptionSizeCode' + addOnOptionCount + '" value="' + $('#addOnOptionSizeCode' + addOnOptionCount).val() + '" >' + '</div>' + '<div class="col-2 m-1 p-2">' + document.getElementById('addOnOptionIsPerPanel' + addOnOptionCount).checked + '<input type="hidden" name="addOnOptionIsPerPanel' + addOnOptionCount + '" value="' + document.getElementById('addOnOptionIsPerPanel' + addOnOptionCount).checked + '" >' + '</div>' + '<div class="col-2 m-1 p-2">' + document.getElementById('addOnOptionIsPerLight' + addOnOptionCount).checked + '<input type="hidden" name="addOnOptionIsPerLight' + addOnOptionCount + '" value="' + document.getElementById('addOnOptionIsPerLight' + addOnOptionCount).checked + '" >' + '</div>' + '<div class="col-1 m-1 p-2">' + $('#addOnOptionPrice' + addOnOptionCount).val() + '<input type="hidden" name="addOnOptionPrice' + addOnOptionCount + '" value="' + $('#addOnOptionPrice' + addOnOptionCount).val() + '" >' + '</div>' + '<div class="d-none">' + '<input type="hidden" name="addOnOptionIsPriceSameAllSizes' + addOnOptionCount + '" value="' + document.getElementById('addOnOptionIsPriceSameAllSizes' + addOnOptionCount).checked + '" >' + '</div>' + '</div>');
    document.getElementById('rawAddAddOnOptionContainer' + addOnOptionCount).remove();
    $('#saveAddOnOptionButtonContainer').addClass("d-none");
    $('#addOnOptionButtonContainer').removeClass("d-none");
    addOnOptionCount++;
    $('#addOnOptionCount').val(addOnOptionCount);
  });
}

function productSizeCodeChange(index) {
  var productSize = document.getElementById('productSizeCode' + index).value;
  var productSizes = productSize.split("-");
  document.getElementById('productSizeCodeId' + index).value = productSizes[0];
  document.getElementById('width_inches' + index).value = productSizes[1];
  document.getElementById('height_inches' + index).value = productSizes[2];
}

function finishOptionChange(index) {
  var productSize = document.getElementById('productSizeCode' + index).value;
  var productSizes = productSize.split("-");
  document.getElementById('productSizeCodeId' + index).value = productSizes[0];
  document.getElementById('width_inches' + index).value = productSizes[1];
  document.getElementById('height_inches' + index).value = productSizes[2];
}

function addOnChange(index) {
  var productSize = document.getElementById('productSizeCode' + index).value;
  var productSizes = productSize.split("-");
  document.getElementById('productSizeCodeId' + index).value = productSizes[0];
  document.getElementById('width_inches' + index).value = productSizes[1];
  document.getElementById('height_inches' + index).value = productSizes[2];
}

var ProductSizeCode = /*#__PURE__*/_createClass(function ProductSizeCode() {
  _classCallCheck(this, ProductSizeCode);

  _defineProperty(this, "id", void 0);

  _defineProperty(this, "code", void 0);

  _defineProperty(this, "height", void 0);

  _defineProperty(this, "width", void 0);
});

var FinishOption = /*#__PURE__*/_createClass(function FinishOption() {
  _classCallCheck(this, FinishOption);

  _defineProperty(this, "id", void 0);

  _defineProperty(this, "finishName", void 0);

  _defineProperty(this, "finishDescription", void 0);
});

var AddOnOption = /*#__PURE__*/_createClass(function AddOnOption() {
  _classCallCheck(this, AddOnOption);

  _defineProperty(this, "id", void 0);

  _defineProperty(this, "addOnOption", void 0);

  _defineProperty(this, "addOnOptionDescription", void 0);

  _defineProperty(this, "addOnOptionPrice", void 0);

  _defineProperty(this, "isPerLight", void 0);

  _defineProperty(this, "isPerPanel", void 0);

  _defineProperty(this, "isPriceSameForAllSizes", void 0);

  _defineProperty(this, "productSizeCodeId", void 0);
});
/******/ })()
;
