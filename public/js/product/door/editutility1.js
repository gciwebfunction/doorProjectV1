/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************************!*\
  !*** ./resources/js/product/door/editutility1.js ***!
  \***************************************************/
window.onload = function () {
  init();
};

window.isGliding = $('#isGliding').val();

function getSourceForHandlingInput(handlingCount) {
  return '<input class="form-control  dataField" type="text" size="70" ' + 'name="doorhandling-' + handlingCount + '" id="doorhandling-' + handlingCount + '" ' + 'placeholder="Door Handling" value="">' + '<p class="ml-10 handlingDelete" style="text-transform: capitalize;font-size: small;font-weight: bold;color: red;' + ' cursor:pointer;" id="doorhandling-delete-' + handlingCount + '">Delete</p>';
}

function getSourceForMeasurementInput(measurementCount) {
  return '<input class="form-control-sm dataField" type="text" name="width-' + measurementCount + '" ' + 'placeholder="Width" id="doorWidthMeasurement-' + measurementCount + '" >' + '<input class="form-control-sm dataField" type="text" name="height-' + measurementCount + '" ' + 'placeholder="Height" id="doorHeightMeasurement-' + measurementCount + '">' + '<p class=" ml-10 measurementDelete" style="text-transform: capitalize;font-size: small;font-weight: bold;color: red; ' + 'cursor:pointer;" id="doorMeasurements-delete-' + measurementCount + '-0">Delete</p>';
}

function getSourceForFrame(frameCount) {
  return '<input class="form-control-sm dataField doorFrameClass" size="70" type="text" ' + 'name="frame-' + frameCount + '" ' + 'id="frame-' + frameCount + '" ' + 'placeholder="Frame Option" value="">' + '<p class=" ml-10 doorFrameDelete" ' + 'style="text-transform: capitalize;font-size: small;' + 'font-weight: bold;color: red;cursor:pointer;" ' + 'id="doorFrame-delete-' + frameCount + '">' + 'Delete</p>';
}

function getSourceForColor(colorCount) {
  return '<input class="form-control-sm dataField colorClass" size="70" type="text" ' + 'name="color-' + colorCount + '" ' + 'id="color-' + colorCount + '" ' + 'placeholder="Finish/Color" value=""> ' + '<p class=" ml-10 colorDelete" ' + 'style="text-transform: capitalize;font-size: small;font-weight: bold;color: red; ' + 'cursor:pointer;" ' + 'id="doorColor-delete-' + colorCount + '">' + 'Delete</p>';
}

function initHandleDeletes() {
  $('.handlingDelete').each(function () {
    this.addEventListener('click', function (event) {
      var idArray = this.id.split("-");

      try {
        $('#doorhandling-' + idArray[2]).remove();
        this.remove();
        $.get("/p/deleteDoorHandling/" + idArray[3]);
        var handlingcount = $('#doorHandlingCount').val();
        handlingcount = +handlingcount - 1;
        $('#doorHandlingCount').val(handlingcount);
      } catch (e) {
        console.log("Error deleting door handling:", e);
      }
    });
  });
}

function initMeasurementDeletes() {
  $('.measurementDelete').each(function () {
    this.addEventListener('click', function (event) {
      var idArray = this.id.split("-");

      try {
        $('#doorWidthMeasurement-' + idArray[2]).remove();
        $('#doorHeightMeasurement-' + idArray[2]).remove();
        this.remove();
        $.get("/p/deleteDoorMeasurement/" + idArray[3]);
        var measurementCount = $('#doorMeasurementsCount').val();
        measurementCount = +measurementCount - 1;
        $('#doorMeasurementsCount').val(measurementCount);
        var counter = 0;
        $('.doorMeasurementClass').each(function () {
          $(this).attr('name', 'width-' + counter);
          $(this).attr('id', 'doorWidthMeasurement-' + counter);
          counter++;
        });
        counter = 0;
        $('.doorMeasurementHeightClass').each(function () {
          $(this).attr('name', 'height-' + counter);
          $(this).attr('id', 'doorHeightMeasurement-' + counter);
          counter++;
        });
        counter = 0;
        $('.hiddenMeasurementId').each(function () {
          $(this).attr('name', 'measurement_id-' + counter);
          counter++;
        });
      } catch (e) {
        console.log("Error deleting door measurement:", e);
      }
    });
  });
}

function initColorDelete() {
  $('.colorDelete').each(function () {
    this.addEventListener('click', function (event) {
      var idArray = this.id.split("-");

      try {
        $('#color-' + idArray[2]).remove();

        try {
          $('#hiddenColorId-' + idArray[2]).remove();
        } catch (e) {}

        if (idArray.length > 3) {
          $('#doorColor-delete-' + idArray[2] + '-' + idArray[3]).remove();
        } else {
          $('#doorColor-delete-' + idArray[2]).remove();
        }

        //alert( idArray[3]);
        $.get("/p/deleteColor/" + idArray[3]);

        var colorCount = $('#colorCount').val();
        colorCount = +colorCount - 1;
        $('#colorCount').val(colorCount);
        var counter = 0;
        $('.colorClass').each(function () {
          $(this).attr('name', 'color-' + counter);
          $(this).attr('id', 'color-' + counter);
          counter++;
        });
        counter = 0;
        $('.hiddenColorId').each(function () {
          $(this).attr('name', 'color_id-' + counter);
          $(this).attr('id', 'hiddenColorId-' + counter);
          counter++;
        });
        counter = 0;
        $('.colorDelete').each(function () {
          var colorDeleteIdArray = $(this).attr('id').split('-');

          if (colorDeleteIdArray.length > 3) {
            $(this).attr('id', 'doorColor-delete-' + counter + '-' + colorDeleteIdArray[3]);
          } else {
            $(this).attr('id', 'doorColor-delete-' + counter);
          }

          counter++;
        });
      } catch (e) {
        console.log("Error deleting color:", e);
      }
    });
  });
}

function initFrameDelete() {
  $('.doorFrameDelete').each(function () {
    this.addEventListener('click', function (event) {
      var idArray = this.id.split("-");

      try {
        $('#frame-' + idArray[2]).remove();
        this.remove();
        $.get("/p/deleteFrame/" + idArray[3]);
        var frameOptionCount = $('#frameOptionCount').val();
        frameOptionCount = +frameOptionCount - 1;
        $('#frameOptionCount').val(frameOptionCount);
        var counter = 0;
        $('.doorFrameClass').each(function () {
          $(this).attr('id', 'frame-' + counter);
          $(this).attr('name', 'frame-' + counter);
          counter++;
        });
        counter = 0;
        $('.hiddenFrameId').each(function () {
          $(this).attr('name', 'door_frame_option_id-' + counter);
          counter++;
        });
      } catch (e) {
        console.log("Error deleting frame:", e);
      }
    });
  });
}

function init() {
  document.getElementById('categorySelection').addEventListener('change', function (event) {
    var selectedCategoryId = $('#categorySelection').val();
    $('.noSubCatOption').remove();
    var optionCount = 0;

    if (selectedCategoryId > 0) {
      $('.doorTypeOption').each(function (index, element) {
        if (!$(element).hasClass('doorTypeCategory-' + selectedCategoryId)) {
          $(element).addClass('d-none');
        } else {
          $(element).removeClass('d-none');
          optionCount++;
        }
      });

      if (optionCount == 0) {
        $('#doorTypesList').append('<option value="-11" class="noSubCatOption">No matching sub categories.</option>');
      } else {
        $('#doorTypesList').removeAttr('disabled');
        $('#addTypeAndImageDivButton').removeAttr('disabled');
        $('#continueButton').removeAttr('disabled');
      }
    } else {
      $('#doorTypesList').attr('disabled', 'disabled');
      $('#continueButton').attr('disabled', 'disabled');
      $('#addTypeAndImageDivButton').attr('disabled', 'disabled');
      $('#doorTypesList').val(-1);
    }
  });
  document.getElementById('addTypeAndImageDivButton').addEventListener('click', function (event) {
    event.preventDefault();
    var index = +$('#typeCount').val();
    $('#addTypeContainer').append(getSourceAdditionalTypeAndImageFields(index));
    index++;
    $('#typeCount').val(index);
  });
  document.getElementById('doorTypesList').addEventListener('change', function (event) {
    var subCatVal = $('#doorTypesList').val();

    if (subCatVal > 0) {
      $('.productFormElement').removeAttr('disabled');
    } else {
      $('.productFormElement').attr('disabled', 'disabled');
    }
  });
  $(document).on("keypress", "input", function (e) {
    if (e.which == 13) {
      e.preventDefault();
    }
  });

  if (isGliding == 0) {
    document.getElementById('addDoorHandlingButton').addEventListener('click', function (event) {
      event.preventDefault();
      var handlingCount = $('#doorHandlingCount').val();
      handlingCount = +handlingCount + 1;
      $('#doorHandlingCount').val(handlingCount);
      $('#doorHandlingContainer').append(getSourceForHandlingInput(handlingCount - 1));
      initHandleDeletes();
    });
    document.getElementById('addFrameOptionButton').addEventListener('click', function (event) {
      event.preventDefault();
      var frameCount = $('#frameOptionCount').val();
      frameCount = +frameCount + 1;
      $('#frameOptionCount').val(frameCount);
      $('#addFrameContainer').append(getSourceForFrame(frameCount - 1));
      initFrameDelete();
    });
  }

  document.getElementById('addSizeButton').addEventListener('click', function (event) {
    event.preventDefault();
    var doorMeasurementsCount = $('#doorMeasurementsCount').val();
    doorMeasurementsCount = +doorMeasurementsCount + 1;
    $('#doorMeasurementsCount').val(doorMeasurementsCount);
    $('#measurementContainer').append(getSourceForMeasurementInput(doorMeasurementsCount - 1));
    initMeasurementDeletes();
  });
  document.getElementById('addColorButton').addEventListener('click', function (event) {
    event.preventDefault();
    var colorCount = $('#colorCount').val();
    colorCount = +colorCount + 1;
    $('#colorCount').val(colorCount);
    $('#addColorContainer').append(getSourceForColor(colorCount - 1));
    initColorDelete();
  });

  if (isGliding == 0) {
    initHandleDeletes();
    initFrameDelete();
  }

  initMeasurementDeletes();
  initColorDelete();
  document.getElementById('submitEditButton').addEventListener('click', function (event) {
    event.preventDefault();
    var validation = formIsValid();

    if (validation == '') {
      $('#editProductForm').submit();
    } else {
      alert(validation);
    }
  });
  var index = 0;
  $('.doorNameType').each(function () {
    index++;
  });
  $('#typeCount').val(index);

  if (isGliding == 0) {
    index = 0;
    $('.doorHandlingClass').each(function () {
      index++;
    });
    $('#doorHandlingCount').val(index);
    index = 0;
    $('.doorFrameClass').each(function () {
      index++;
    });
    $('#frameOptionCount').val(index);
  }

  index = 0;
  $('.doorMeasurementClass').each(function () {
    index++;
  });
  $('#doorMeasurementsCount').val(index);
  index = 0;
  $('.colorClass').each(function () {
    index++;
  });
  $('#colorCount').val(index);
}

function getSourceAdditionalTypeAndImageFields(index) {
  return '<div id="addOnDoorNameTypePlaceholder-' + index + '" style="padding: 3px; margin: 1px; border: 1px solid lightgray; ">' + '<div class="col-lg p-3 m-3" id="doorTypeContainer' + index + '">' + '<label class="form-label" for="doorNameType-0" id="doorNameTypeLabel-' + index + '">' + 'Name or Type (ie.' + ' Inswing)' + '' + '</label>' + '<input type="text" id="doorNameType-' + index + '" name="door_name_type-' + index + '" ' + 'class="form-control productFormElement dataField" style="min-width: 300px"/>' + '</div>' + '<div class="col-lg p-3 m-3" id="doorTypeImageContainer' + index + '">' + '<label class="form-label" for="doorNameType" id="doorNameTypeLabel">' + ' Add Image for Type' + '</label>' + '<input type="file" style="margin-left: 20px;" name="door_type_image-' + index + '" aria-describedby="doorTypeImage"' + ' id="door_type_image-' + index + '" class="form-control-file">' + '</div>' + '<div class="col-lg p-3 m-3">' + '<label class="form-label" for="doorNameType" id="doorNameTypeLabel">' + ' Remove this type...' + '</label>' + '   <span class="deleteProduct" style="cursor: pointer; text-align: center" ' + '   onclick="' + '   function e(){' + '                   $(\'#addOnDoorNameTypePlaceholder-' + index + '\').remove();' + '                   let count = +$(\'#typeCount\').val();' + '                   count--;' + '                   $(\'#typeCount\').val(count);' + '   } ' + 'e()">X</span>' + '</div>' + '</div>';
}

function formIsValid() {
  var validation = '';
  $('.dataField').each(function () {
    if ($(this).val().length <= 1) return 'Please provide a value for all fields.';
  });
  return validation;
}
/******/ })()
;