/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************************!*\
  !*** ./resources/js/shoppingcart/cart1.js ***!
  \********************************************/
window.onload = function () {
  init();
  $('#quantity').val();
};

function addPriceValue(finishPrice) {
  var currentValue = +$('#priceValue').text();
  var newvalue = +finishPrice + +currentValue;
  $('#priceValue').text(newvalue);
}

function getItemPrice() {
  return +$('#priceValue').text();
}

function setPriceValue(price) {
  return $('#priceValue').text(price);
}

function init() {
  $('#addItemToCartButton').html('<p>Add To Cart</p>');
  /**
   * Handle product add to cart.
   */

  document.getElementById('addItemToCartButton').addEventListener('click', function (event) {
    event.preventDefault();

    if ($('#productOptionSelect').val() < 1) {
      alert("Please select an option.");
    } else {
      try {
        $('#addItemToCartButton').html("<p>Adding...</p>");
        $('#cartItemForm').submit();
      } catch (e) {
        console.log("Error submitting form." + e);
        $('#addItemToCartButton').html("<p>Add To Cart</p>");
      }
    }
  });
  document.getElementById('productOptionSelect').addEventListener('change', function (event) {
    var selectedVal = $(this).val();

    if (selectedVal > 0) {
      try {
        var price;
        var prie     = $('#productOptionPrice-' + selectedVal).val();
        var quantity  = $('#quantity').val();
        if(quantity){
          price         = prie*quantity;
        }else{
          price         = prie;
        }
        setPriceValue(price);
      } catch (e) {
        console.log("Error updating price:" + e);
      }
    }
  });

  document.getElementById('quantity').addEventListener('change', function (event) {

    var prie      = $('#productOptionSelect').find(":selected").val();
    var priee     = $('#productOptionPrice-'+prie).val();

    if (prie > 0) {
      try {
        var price;
        var quantity  = $('#quantity').val();
        price         = priee*quantity;
        setPriceValue(price);
      } catch (e) {
        alert('Select Product');
      }
    }
  });
}
/******/ })()
;