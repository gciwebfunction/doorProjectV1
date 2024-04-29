/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************************!*\
  !*** ./resources/js/shoppingcart/doorcart1.js ***!
  \************************************************/
var finishSizeCodeArray           = [];
var addOnOptionSizeCodeArray      = [];
window.handleTypeSelectHTML       = $('#handleTypeSelect').clone();
window.lockSetSelectHTML          = $('#lockSetSelect').clone();
window.glassDepthSelectHTML       = $('#glassDepthSelect').clone();
window.glassOptionSelectHTML      = $('#glassOptionSelect').clone();
window.frameThicknessSelectHTML   = $('#frameThicknessSelect').clone();

window.onload = function () {
  init();
  var doorNameTypeId = $('#doorNameTypeIdSelection').val();
  var sizeId = $('#oldSize').val();
  var handlingId = $('#oldHandling').val();
  var frameId = $('#oldFrame').val();
  var colorId = $('#oldColor').val();
  var gridId = $('#oldGlassGrid').val();
  var glassOptionId = $('#oldGlassOption').val();
  var depthId = $('#oldGlassDepth').val();
  var handleTypeId = $('#oldHandleType').val();
  var lockSetId = $('#oldLockset').val();
  var thicccId = $('#oldThickness').val();

  if (sizeId && sizeId > 0) {
    $('#doorSizeSelect').val(sizeId);
    setupSelectBoxes();
  }

  if (doorNameTypeId && doorNameTypeId > 0) {
    $('.doorNameClass').attr('style', 'border: 2px solid black');
    $('#doornameid-' + doorNameTypeId).attr('style', 'border: 2px solid red');
  }

  if (handlingId && handlingId > 0) {
    $('#doorHandlingSelect').val(handlingId);
  }

  if (frameId && frameId > 0) {
    $('#doorFrameSelect').val(frameId);
  }

  if (colorId && colorId > 0) {
    $('#doorColorSelect').val(colorId);
  }

  if (gridId && gridId > 0) {
    $('#glassGridSelect').val(gridId);
  }

  if (glassOptionId && glassOptionId > 0) {
    $('#glassOptionSelect').val(glassOptionId);
  }

  if (depthId && depthId > 0) {
    $('#glassDepthSelect').val(depthId);
  }

  if (handleTypeId && handleTypeId > 0) {
    $('#handleTypeSelect').val(handleTypeId);
  }

  if (lockSetId && lockSetId > 0) {
    $('#lockSetSelect').val(lockSetId);
  }

  if (thicccId && thicccId > 0) {
    $('#frameThicknessSelect').val(thicccId);
  }
};

function setupSelectBoxes() {
  var measurementId = $('#doorSizeSelect').val();
  var handleTypeForSpecificSizeCount = 0;
  var lockSetOptionForSpecificSizeCount = 0;
  var glassDepthOptionForSpecificSizeCount = 0;
  var glassOptionForSpecificSizeCount = 0;
  var frameThicknessForSpecificSizeCount = 0;
  $('.noOptionForSize').remove();
  var index = 0;
  $('.customOptionPlaceHolder').each(function () {
    var optionName = $(this).attr('id');
    var optionId = optionName.split("-")[0];
    console.log("OPTIONANME: " + optionName);
    $('#customOptionSelect-' + optionName).empty();
    $('#customOptionSelect-' + optionName).append('<option value="">Please select ' + $('#customOptionNamePlaceHolder-' + index).val() + ' ...</option>');
    var customOptionCount = 0;
    $('.customOption option').each(function () {
      try {
        var thisOptionId = $(this).attr('id').split('-');

        if (thisOptionId[2] == measurementId && thisOptionId[1] == optionId) {
          $('#customOptionSelect-' + optionName).append($(this).clone());
          customOptionCount++;
        }
      } catch (e) {
        console.log(e);
      }
    });
    $('#customOptionSelect-' + optionName).removeAttr('disabled');

    if (customOptionCount == 0) {
      $('#customOptionSelect-' + optionName).remove();
      $('#customOptionSelect-' + optionName).append("<p class='bold noOptionForSize'>No " + optionName + " options for this size.</p>");
    }

    index++;
  });
  $('#doorColorSelect').empty();
  $('#doorColorSelect').append('<option value="">Select a color option...</option>');
  $('.colorOption').each(function () {
    var idArray = $(this).attr('id').split("-");

    if (idArray[1] == measurementId) {
      $('#doorColorSelect').append($(this).clone());
    }
  });
  $('#doorColorSelect').removeAttr('disabled'); // ****************************************
  // HANDLE TYPE SELECT DYNAMIC UPDATES
  // ****************************************

  if ($('#handleTypeSelect').length == 0) {
    $('#handleTypeSelectPlaceholder').append(this.handleTypeSelectHTML);
  }

  $('#handleTypeSelect').empty();
  $('#handleTypeSelect').append('<option value="">Please select a handle...</option>');
  $('.HANDLE_TYPE_OPTION').each(function () {
    var idArray = $(this).attr('id').split("-");

    if (idArray[2] == measurementId) {
      handleTypeForSpecificSizeCount++;
      $('#handleTypeSelect').append($(this).clone());
    }
  });
  $('#handleTypeSelect').removeAttr('disabled');

  if (handleTypeForSpecificSizeCount == 0) {
    $('#handleTypeSelect').remove();
    $('#handleTypeSelectPlaceholder').append("<p class='bold noOptionForSize'>No handle type options for this size.</p>");
  } // ****************************************
  // LOCK SET SELECT DYNAMIC UPDATES
  // ****************************************


  if ($('#lockSetSelect').length == 0) {
    $('#lockSetSelectPlaceholder').append(this.lockSetSelectHTML);
  }

  $('#lockSetSelect').empty();
  $('#lockSetSelect').append('<option value="">Please select a lock...</option>');
  $('.LOCK_SET_OPTION').each(function () {
    var idArray = $(this).attr('id').split("-");

    if (idArray[2] == measurementId) {
      $('#lockSetSelect').append($(this).clone());
      lockSetOptionForSpecificSizeCount++;
    }
  });
  $('#lockSetSelect').removeAttr('disabled');

  if (lockSetOptionForSpecificSizeCount == 0) {
    $('#lockSetSelect').remove();
    $('#lockSetSelectPlaceholder').append("<p class='bold noOptionForSize'>No lock set options for this size.</p>");
  } // ****************************************
  // GLASS DEPTH SELECT DYNAMIC UPDATES
  // ****************************************


  if ($('#glassDepthSelect').length == 0) {
    $('#glassDepthSelectPlaceholder').append(this.glassDepthSelectHTML);
  }

  $('#glassDepthSelect').empty();
  $('#glassDepthSelect').append('<option value="">Please select a glass depth...</option>');
  $('.GLASS_DEPTH_OPTION').each(function () {
    var idArray = $(this).attr('id').split("-");

    if (idArray[2] == measurementId) {
      glassDepthOptionForSpecificSizeCount++;
      $('#glassDepthSelect').append($(this).clone());
    }
  });
  $('#glassDepthSelect').removeAttr('disabled');

  if (glassDepthOptionForSpecificSizeCount == 0) {
    $('#glassDepthSelect').remove();
    $('#glassDepthSelectPlaceholder').append("<p class='bold noOptionForSize'>No glass depth options for this size.</p>");
  } // ****************************************
  // GLASS GRID SELECT DYNAMIC UPDATES
  // ****************************************


  $('#glassGridSelect').empty();
  $('#glassGridSelect').append('<option value="">Please select a grid option...</option>');
  $('.GLASS_GRID').each(function () {
    var idArray = $(this).attr('id').split("-");

    if (idArray[2] == measurementId) {
      $('#glassGridSelect').append($(this).clone());
    }
  });
  $('#glassGridSelect').removeAttr('disabled'); // ****************************************
  // GLASS OPTION SELECT DYNAMIC UPDATES
  // ****************************************

  if ($('#glassOptionSelect').length == 0) {
    $('#glassOptionSelectPlaceholder').append(this.glassOptionSelectHTML);
  }

  $('#glassOptionSelect').empty();
  $('#glassOptionSelect').append('<option value="">Please select a glass option...</option>');
  $('.GLASS_OPTION').each(function () {
    var idArray = $(this).attr('id').split("-");

    if (idArray[2] == measurementId) {
      glassOptionForSpecificSizeCount++;
      $('#glassOptionSelect').append($(this).clone());
    }
  });
  $('#glassOptionSelect').removeAttr('disabled');

  if (glassOptionForSpecificSizeCount == 0) {
    $('#glassOptionSelect').remove();
    $('#glassOptionSelectPlaceholder').append("<p class='bold noOptionForSize'>No glass options for this size.</p>");
  } // ****************************************
  // FRAME THICKNESS SELECT DYNAMIC UPDATES
  // ****************************************


  if ($('#frameThicknessSelect').length == 0) {
    $('#frameThicknessSelectPlaceholder').append(this.frameThicknessSelectHTML);
  }

  $('#frameThicknessSelect').empty();
  $('#frameThicknessSelect').append('<option>Please select a thickness...</option>');
  $('.FRAME_THICKNESS_OPTION').each(function () {
    var idArray = $(this).attr('id').split("-");

    if (idArray[2] == measurementId) {
      frameThicknessForSpecificSizeCount++;
      $('#frameThicknessSelect').append($(this).clone());
    }
  });
  $('#frameThicknessSelect').removeAttr('disabled');

  if (frameThicknessForSpecificSizeCount == 0) {
    $('#frameThicknessSelect').remove();
    $('#frameThicknessSelectPlaceholder').append("<p class='bold noOptionForSize'>No frame thickness for this size.</p>");
  }
}

function setupOptionSpecificationsSelectBox() {
  var optValues = [];
  $('.OPT_SPEC').each(function () {
    // m-{{$addOn->group_name}}-{{$addOn->door_measurement_id}}-{{$addOn->price}}
    optValues.push($(this).text());
  });

  if (optValues.length > 0) {
    $('#optSpecLabel').append('<label>Special Option</label>');
    $('#optSpecSelect').append('<select name="opt_select" id="optSelect"></select>');

    for (var index = 0; index < optValues.length; index++) {
      $('#optSelect').append('<option value="' + optValues[index] + '">' + optValues[index] + '</option>');
    }
  }
}

function init() {
  setupOptionSpecificationsSelectBox();
  document.getElementById('doorSizeSelect').addEventListener('change', function (event) {
    setupSelectBoxes();
  });
  $('.doorNameClass').each(function () {
    this.addEventListener('click', function (event) {
      event.preventDefault();
      $('.doorNameClass').attr('style', 'border: 2px solid black');
      $(this).attr('style', 'border: 2px solid red');
      var nameId = this.id.split("-")[1];
      $('#doorNameTypeIdSelection').val(nameId);
    });
  });
  document.getElementById('doorColorSelect').addEventListener('change', function () {
    updatePrice();
  });
  document.getElementById('glassGridSelect').addEventListener('change', function () {
    updatePrice();
  });
  document.getElementById('handleTypeSelect').addEventListener('change', function () {
    updatePrice();
  });
  document.getElementById('lockSetSelect').addEventListener('change', function () {
    updatePrice();
  });
  var index = 0;
  $('.customOptionPlaceHolder').each(function () {
    var optionName = $(this).attr('id');
    document.getElementById('customOptionSelect-' + optionName).addEventListener('change', function () {
      updatePrice();
    });
    index++;
  });
  document.getElementById('addItemToCartButton').addEventListener('click', function (event) {
    event.preventDefault();
    $('#addItemToCartButton p').text('Saving...');
    $('#cartItemForm').submit();
  });
}

function updatePrice() {
  var basePrice = 0;
  var colorSelectArray = $("#doorColorSelect option:selected").text().split("-");

  try {
    if (colorSelectArray.length > 1) {
      var colorPrice = colorSelectArray[1].trim();
      colorPrice = colorPrice.replace("$", "");
      basePrice = +colorPrice;
    }
  } catch (e) {
    console.log(e);
  }

  try {
    var glassGridArray = $("#glassGridSelect option:selected").text().split("-");
    var glassGridIDArray = $("#glassGridSelect option:selected").attr('id').split("-");

    if (glassGridArray.length > 1) {
      var gridCount = +glassGridArray[0].trim();
      var gridPricePerLite = glassGridIDArray[3];
      gridPricePerLite = +gridPricePerLite.replace("$", "");
      gridPricePerLite = gridPricePerLite * +$('#panelCount').val();
      basePrice = basePrice + gridPricePerLite + gridCount;
    }
  } catch (e) {
    console.log(e);
  }

  try {
    var handleTypeIDArray = $("#handleTypeSelect option:selected").attr('id').split("-");

    if (handleTypeIDArray.length > 1) {
      var handlePrice = +handleTypeIDArray[3].trim();
      basePrice = basePrice + handlePrice;
    }
  } catch (e) {
    console.log(e);
  }

  try {
    var lockSetIDArray = $("#lockSetSelect option:selected").attr('id').split("-");

    if (lockSetIDArray.length > 1) {
      var lockPrice = +lockSetIDArray[3].trim();
      basePrice = basePrice + lockPrice;
    }
  } catch (e) {
    console.log(e);
  }

  try {
    var index = 0;
    $('.customOptionPlaceHolder').each(function () {
      var optionName = $(this).attr('id');
      var customIdArray = $('#customOptionSelect-' + optionName + ' option:selected').attr('id').split("-");

      if (customIdArray.length > 1) {
        var customPrice = +customIdArray[3].trim();
        basePrice = basePrice + customPrice;
      }

      index++;
    });
  } catch (e) {
    console.log(e);
  }

  $('#priceValue').text(basePrice);
}
/******/ })()
;