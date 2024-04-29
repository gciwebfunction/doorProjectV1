/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************************!*\
  !*** ./resources/js/product/door/utility5.js ***!
  \***********************************************/
window.onload = function () {
  init();
};

function disableOrEnableTextField(id, idType) {
  var checkboxId;
  var elementId;

  if (idType == 'sdlIsNA') {
    elementId = '#sdl_option_price-' + id;
    checkboxId = 'sdlIsNA-' + id;
  } else if (idType == 'handleTypeIsNA') {
    elementId = '#handle_type_price-' + id;
    checkboxId = 'handleTypeIsNA-' + id;
  } else if (idType == 'lockSetIsNA') {
    elementId = '#lock_set_price-' + id;
    checkboxId = 'lockSetIsNA-' + id;
  }

  if (document.getElementById(checkboxId).checked) {
    $(elementId).attr('disabled', '');
    $(elementId).attr('placeholder', 'N/A');
    //$('#'+checkboxId).val(1);

  } else {
    $(elementId).removeAttr('disabled');
    $(elementId).attr('placeholder', 'price');
    //$('#'+checkboxId).val(0);
  }
}

function init() {
  document.getElementById('continueButton').addEventListener('click', function (event) {
    event.preventDefault();

    if (validateForm()) {
      alert("Please fill out all text fields.");
    } else {
      $('#additionalOptionsPriceForm').submit();
    }
  });
  document.getElementById('sdlAllSamePriceSelect').addEventListener('change', function () {
    if ($('#sdlAllSamePriceSelect').val() == 1) {
      $('.sdlPriceRow').addClass('d-none');
      $('.allSDLPriceRow').removeClass('d-none');
    } else {
      $('.sdlPriceRow').removeClass('d-none');
      $('.allSDLPriceRow').addClass('d-none');
    }
  });
  document.getElementById('sdlOptionsPrice').addEventListener('change', function (event) {
    try {
      var newPriceValue = +$(this).val();

      if (newPriceValue > 0) {
        $('.sdlOptionPRice').each(function () {
          $(this).val(newPriceValue);
        });
      }
    } catch (e) {
      console.log(e);
    }
  });
  document.getElementById('gbgAllSamePriceSelect').addEventListener('change', function () {
    if ($('#gbgAllSamePriceSelect').val() == 1) {
      $('.gbgPriceRow').addClass('d-none');
      $('.allGBGPriceRow').removeClass('d-none');
    } else {
      $('.gbgPriceRow').removeClass('d-none');
      $('.allGBGPriceRow').addClass('d-none');
    }
  });
  document.getElementById('gbgOptionsPrice').addEventListener('change', function (event) {
    try {
      var newPriceValue = +$(this).val();

      if (newPriceValue > 0) {
        $('.gbgOptionPrice').each(function () {
          $(this).val(newPriceValue);
        });
      }
    } catch (e) {
      console.log(e);
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
  $('.dataField').each(function (i, e) {
    if ($('#sdlAllSamePriceSelect').val() == 1) {
      if (!$(e).hasClass('sdlOptionPrice') && !$(e).hasClass('gbgOptionPrice')) {
        if (e.value.length < 1 && !e.disabled) {
          failed = true;
        }
      }
    }

    if ($('#gbgAllSamePriceSelect').val() == 1) {
      if (!$(e).hasClass('gbgOptionPrice') && !$(e).hasClass('sdlOptionPrice')) {
        if (e.value.length < 1 && !e.disabled) {
          failed = true;
        }
      }
    }

    if (!$(e).hasClass('gbgOptionPrice') && !$(e).hasClass('sdlOptionPrice')) {
      if (e.value.length < 1 && !e.disabled) {
        failed = true;
      }
    }
  });
  return failed;
}
/******/ })()
;