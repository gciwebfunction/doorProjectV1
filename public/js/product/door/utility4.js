/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************************!*\
  !*** ./resources/js/product/door/utility4.js ***!
  \***********************************************/
window.onload = function () {
  init();
};

window.addGlassOptionValue = function (count) {
  var valueCount = +$('#customGlassOptionValuesCount' + count).val();
  valueCount++;
  $("#customGlassOptionValuesCount" + count).val(valueCount);
  $('#customGlassOptionAdditionalRowPlaceholder' + count).append(getCustomGlassOptionSourceAdditionalValueRow(count, valueCount));
};

function getCustomOptionSource(count) {
  return '' + '<input type="hidden" name="custom_option_value_counter-' + count + '" id="custom_option_value_counter-' + count + '" ' + 'value="1">' + '<div class="row flex">' + '   <div class="col-4">' + '       <label for="customOption">Custom Option Name</label>' + '   </div>' + '   <div class="col-4">' + '       <input type="text" name="custom_option_name-' + count + '" id="customOptionName-' + count + '">' + '   </div>' + '</div>' + '<div class="row flex">' + '   <div class="col-6 p-1 m-1">Does this custom option need to have prices associated?</div>' + '   <div class="col-2 p-1 m-1">' + '       <input type="checkbox" name="custom_option_has_prices-' + count + '" id="customOptionHasPrices-' + count + '">' + '   </div>' + '</div>' + '<div class="row flex">' + '   <div class="col-6"><p>Enter values for custom option:</p></div>' + '</div>' + '<div class="row flex">' + '   <div class="col-3">Value 1</div>' + '   <div class="col-4"><input type="text" name="custom_option-' + count + '-value-1" id="custom_option-' + count + '-value-1"></div>' + '</div>' + '<div id="customOptionValuesContainer-' + count + '">' + '</div>' + '<div class="row flex">' + '   <div class="col-4">' + '       <button class="btn btn-primary" id="addAnotherCustomOptionValue-' + count + '">Add another value for custom option.</button>' + '   </div>' + '</div>';
}

window.deleteCGOV = function (count, valueCount) {
  $('#cGOV-container-' + count + '-' + valueCount).remove();
  var valueCounter = 0;
  $('.cGOV_container-' + count).each(function () {
    $(this).attr('id', 'cGOV-container-' + count + '-' + valueCounter);
    valueCounter++;
  });
  $("#customGlassOptionValuesCount" + count).val(valueCounter);
  valueCounter = 0;
  $('.cGOV-' + count).each(function () {
    $(this).attr('name', 'custom_glass_option-' + count + '_value-' + valueCounter);
    $(this).attr('id', 'customGlassOption-' + count + '-Value-' + valueCounter);
    valueCounter++;
  });
  valueCounter = 0;
  $('.deleteCGOV-' + count).each(function () {
    $(this).attr('onclick', 'deleteCGOV(' + count + ',' + valueCounter + ')');
    valueCounter++;
  });
};

function getCustomGlassOptionSourceAdditionalValueRow(count, valueCount) {
  return '<div class="row flex cGOV_container-' + count + '" id="cGOV-container-' + count + '-' + valueCount + '">' + '      <div class="col-3 p-1 m-1">Glass Option Selection</div>' + '       <div class="col-6 p-1 m-1">' + '           <input class="form-control dataField cGOV-' + count + '" type="text" value="" size="60" ' + '               placeholder="Custom Glass Option Value"' + ' name="custom_glass_option-' + count + '_value-' + valueCount + '"' + '              id="customGlassOption-' + count + '-Value-' + valueCount + '">' + '       </div>' + '       <div class="col-1 p-1 m-1 deleteX deleteCGOV-' + count + '" style="" onclick="deleteCGOV(' + count + ',' + valueCount + ')">' + '           X' + '       </div>' + '   </div>';
}

function getCustomGlassOptionSource(count) {
  return '' + '<fieldset style="border: 1px solid lightgray; " class="p-4 m-4">' + '   <legend>Custom Glass Option ' + (count + 1) + '</legend>' + '   <div class="d-none">' + '       <input type="hidden" name="custom_glass_option_values_count-' + count + '" id="customGlassOptionValuesCount' + count + '" value="1">' + '   </div>' + '   <div class="row flex" id="custom_glass_option-' + count + '">' + '       <div class="col-8 p-1 m-1">Does this glass option need to have prices associated?</div>' + '       <div class="col-2 p-1 m-1">' + '           <input type="checkbox" name="custom_glass_option_has_prices_' + count + '" id="customGlassOptionHasPrices' + count + '">' + '       </div>' + '   </div>' + '   <div class="row flex" id="custom_glass_option_div2-' + count + '">' + '       <div class="col-3 p-1 m-1">Glass Option Name</div>' + '       <div class="col-6 p-1 m-1">' + '           <input class="form-control dataField" type="text" value="" size="60"' + '               placeholder="Custom Glass Option Name" name="custom_glass_option_name-' + count + '" id="customGlassOptionName' + count + '">' + '       </div>' + '   </div>' + '   <div class="row flex cGOV_container-' + count + '"  id="cGOV-container-' + count + '-0">' + '       <div class="col-3 p-1 m-1">Glass Option Selection</div>' + '       <div class="col-6 p-1 m-1">' + '           <input class="form-control dataField cGOV-' + count + '" type="text" value="" size="60" placeholder="Custom Glass Option Value"' + '               name="custom_glass_option-' + count + '_value-0" id="customGlassOption-' + count + '-Value-0">' + '       </div>' + '       <div class="col-1"></div>' + '   </div>' + '   <div id="customGlassOptionAdditionalRowPlaceholder' + count + '"></div>' + '   <div class="" id="newCustomGlassOptionRows-' + count + '">' + '   </div>' + '   <div class="row">' + '       <div class="col-lg p-1 m-1">' + '           <p style="padding: 2px; margin: 1px; color: lightblue; cursor: pointer"' + '               id="addCustomGlassOptionValueRows-' + count + '" onclick="addGlassOptionValue(' + count + ')">Add another value...</p>' + '       </div>' + '   </div>' + '</fieldset>';
}

function init() {
  document.getElementById('addGlassOptionButton').addEventListener('click', function (event) {
    event.preventDefault();
    var count = +$('#glassOptionCount').val();
    $('#newGlassOptionRows').append(getGlassOptionsSource(count));
    count++;
    $('#glassOptionCount').val(count);
  });
  document.getElementById('createGlassOptionButton').addEventListener('click', function (event) {
    event.preventDefault();
    var count = +$('#customGlassOptionCount').val();
    $('#newCustomGlassOptionsPlaceholder').append(getCustomGlassOptionSource(count));
    count++;
    $('#customGlassOptionCount').val(count);
  });
  document.getElementById('addGlassDepthOptionButton').addEventListener('click', function (event) {
    event.preventDefault();
    var count = +$('#glassDepthCount').val();
    $('#newGlassDepthRows').append(getGlassDepthSource(count));
    count++;
    $('#glassDepthCount').val(count);
  });
  document.getElementById('addHandleTypeOptionButton').addEventListener('click', function (event) {
    event.preventDefault();
    var count = +$('#handleTypeCount').val();
    $('#newHandleRows').append(getHandleTypeSource(count));
    count++;
    $('#handleTypeCount').val(count);
  });
  document.getElementById('addLockSetOptionButton').addEventListener('click', function (event) {
    event.preventDefault();
    var count = +$('#lockSetCount').val();
    $('#newLockSetRow').append(getLockSetSource(count));
    count++;
    $('#lockSetCount').val(count);
  });
  document.getElementById('addFrameThicknessOptionButton').addEventListener('click', function (event) {
    event.preventDefault();
    var count = +$('#frameThicknessCount').val();
    $('#newFrameThicknessRows').append(getFrameThicknessSource(count));
    count++;
    $('#frameThicknessCount').val(count);
  });
  document.getElementById('continueButton').addEventListener('click', function (event) {
    event.preventDefault();

    if (validateForm()) {
      alert("Please fill out all text fields.");
    } else {
      $('#additionalOptionsForm').submit();
    }
  });
  document.getElementById('addCustomOptionButton').addEventListener('click', function (event) {
    event.preventDefault();
    var count = +$('#customOptionCount').val();
    var trackingContainerId = count;
    var customOptionSource = getCustomOptionSource(count);
    $('#customOptionContainer').append(customOptionSource);
    document.getElementById('addAnotherCustomOptionValue-' + count).addEventListener('click', function (event) {
      event.preventDefault();
      var valuesCount = +$('#custom_option_value_counter-' + trackingContainerId).val();
      $('#customOptionValuesContainer-' + trackingContainerId).append('<div class="row flex">' + '<div class="col-3">Value ' + (valuesCount + 1) + '</div>' + '<div class="col-4">' + '<input type="text" name="custom_option-' + trackingContainerId + '-value-' + valuesCount + '" ' + 'id="custom_option-' + trackingContainerId + '-value-' + valuesCount + '">' + '</div>' + '</div>');
      valuesCount++;
      $('#custom_option_value_counter-' + trackingContainerId).val(valuesCount);
    });
    count++;
    $('#customOptionCount').val(count);
  });
}

function getGlassOptionsSource(count) {
  return '<div class="row flex"><div class="col-2 p-1 m-1"></div><div class="col-6 p-1 m-1">' + '<input class="form-control dataField" type="text" value="" size="60" placeholder="Glass Option" name="glass_option-' + count + '" id="glass_option-' + count + '"></div></div></div>';
} //
// function getGridCountSource(count) {
//     return '<div class="row flex"><div class="col-2 p-1 m-1"></div><div class="col-6 p-1 m-1"><input class="form-control dataField"  type="text" value="" size="60" placeholder="Grid Option" name="glass_grid-' + count + '" id="glass_grid-' + count + '"></div></div>'
// }


function getGlassLoweSource(count) {
  return '<div class="row flex"><div class="col-2 p-1 m-1"></div><div class="col-6 p-1 m-1"><input class="form-control dataField"  type="text" value="" size="60" placeholder="Glass (Lowe) Option" name="glass_lowe_option-' + count + '" ' + 'id="glass_lowe_option-' + count + '"></div></div>';
}

function getGlassDepthSource(count) {
  return '<div class="row flex" class="newGlassDepthOptionRow" id="newGlassDepthOptionRow-' + count + '">' + '<div class="col-4 p-1 m-1"> ' + '<span id="glassDepthOptionSpan-' + count + '" class="deleteProduct" style="cursor: pointer; float: right" ' + '   onclick="' + '   function e(){' + '                   $(\'#newGlassDepthOptionRow-' + count + '\').remove();' + '                   let count = +$(\'#glassDepthCount\').val();' + '                   count--;' + '                   $(\'#glassDepthCount\').val(count);' + '   } ' + 'e()">X</span>' + '</div>' + '<div class="col-6 p-1 m-1">' + '   <input class="form-control dataField" type="text" value="" size="60" placeholder="Glass (Depth) Option" ' + '   name="glass_depth_option-' + count + '" ' + '' + 'id="glass_depth_option-' + count + '">' + '</div>' + '</div>';
}

function getHandleTypeSource(count) {
  return '<div class="row flex" class="newHandleTypeOptionRow" id="newHandleTypeOptionRow-' + count + '">' + '<div class="col-4 p-1 m-1">' + '   <span class="deleteProduct" style="cursor: pointer; float: right" ' + '   onclick="' + '   function e(){' + '                   $(\'#newHandleTypeOptionRow-' + count + '\').remove();' + '                   $(\'#newHandleTypeOptionRow2-' + count + '\').remove();' + '                   let count = +$(\'#handleTypeCount\').val();' + '                   count--;' + '                   $(\'#handleTypeCount\').val(count);' + '   } ' + 'e()">X</span>' + '</div>' + '<div class="col-6 p-1 m-1"><input class="form-control dataField" type="text" value="" size="60" placeholder="Handle Type Option" name="handle_type_option-' + count + '" id="handle_type_option-' + count + '"></div></div>' + '<div class="row flex" id="newHandleTypeOptionRow2-' + count + '"><div class="col-4 m-1 p-1"><label for="handleTypeImage" class="form-label">Handle Type Picture</label></div><div class="col-5 m-1 p-1">' + '<input type="file" name="handle_type_option_image-' + count + '" aria-describedby="handleTypeImage" ' + 'id="handleTypeImage-' + count + '" class="form-control-file"></div></div>';
}

function getLockSetSource(count) {
  return '<div class="row flex"><div class="col-2 p-1 m-1"></div><div class="col-6 p-1 m-1">' + '<input class="form-control dataField"  type="text" value="" size="60" placeholder="Lock Set Option" name="lock_set_option-' + count + '" ' + 'id="lock_set_option-' + count + '"></div><div>' + '<div class="row flex"><div class="col-4 m-1 p-1"><label for="lockSetImage" class="form-label">Lock Set Picture</label></div><div class="col-5 m-1 p-1">' + '<input type="file" name="lock_set_option_image-' + count + '" aria-describedby="lockSetImage" ' + 'id="lockSetImage-' + count + '" class="form-control-file"></div></div>';
}

function getFrameThicknessSource(count) {
  return '<div class="row flex"><div class="col-2 p-1 m-1"></div><div class="col-6 p-1 m-1"><input class="form-control dataField"  type="text" value="" size="60" placeholder="Frame Thickness Option" name="frame_thickness_option-' + count + '" id="frame_thickness_option-' + count + '"></div></div>';
}

function validateForm() {
  var failed = false;
  $('.dataField').each(function (i, e) {
    if (e.value.length < 1 && !e.disabled) {
      failed = true;
    }
  });
  return failed;
}
/******/ })()
;