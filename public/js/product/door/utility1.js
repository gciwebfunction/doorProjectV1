/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************************!*\
  !*** ./resources/js/product/door/utility1.js ***!
  \***********************************************/
window.onload = function () {
  init();
};

function getCategoryType(selectedCategoryId) {
  var type = $('#categoryTypeHolder-' + selectedCategoryId).val();
  return type;
}

function categorySelectionUpdate() {
  $('#otherProductContainer').addClass('d-none');
  $('#doorProductContainer').addClass('d-none');
  var selectedCategoryId = $('#categorySelection').val();
  var categoryType = getCategoryType(selectedCategoryId);
  $('.noSubCatOption').remove();
  var optionCount = 0;

  if (selectedCategoryId > 0) {
    switch (categoryType) {
      case 'DOORS':
        $('#doorProductContainer').removeClass('d-none');
        $('#addProductForm').attr('action', '/p/doorflow/one');
        break;

      case 'OTHERS':
        $('#otherProductContainer').removeClass('d-none');
        $('#addProductForm').attr('action', '/p/flow/one');
        break;

      default:
        ;
    }

    $('.doorTypeOption').each(function (index, element) {
      if (!$(element).hasClass('doorTypeCategory-' + selectedCategoryId)) {
        $(element).addClass('d-none');
      } else {
        $(element).removeClass('d-none');
        optionCount++;
      }
    });
    $('#doorTypesList').removeAttr('disabled');
    $('#addTypeAndImageDivButton').removeAttr('disabled');
    $('#continueButton').removeAttr('disabled');
    $('#additionalDoorSpec-0').removeAttr('disabled');
    $('#addSpecifierInputField').removeAttr('disabled');
  } else {
    $('#doorTypesList').attr('disabled', 'disabled');
    $('#continueButton').attr('disabled', 'disabled');
    $('#addTypeAndImageDivButton').attr('disabled', 'disabled');
    $('#addSpecifierInputField').attr('disabled', 'disabled');
    $('#doorTypesList').val('');
  }
}

function init() {
  categorySelectionUpdate();
  document.getElementById('categorySelection').addEventListener('change', function (event) {
    categorySelectionUpdate();
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
  });
  document.getElementById('addSpecifierInputField').addEventListener('click', function (event) {
    event.preventDefault();
    var count = +$('#optionalSelectCount').val();
    $('#additionalDoorSpecifierContainer').append(getSourceForAdditionalSpecifier(count));
    count++;
    $('#optionalSelectCount').val(count);
  });
  $(document).on("keypress", "input", function (e) {
    if (e.which == 13) {
      e.preventDefault();
    }
  });
  document.getElementById('continueButton').addEventListener('click', function (event) {
    event.preventDefault();
    var validation = formIsValid();

    if (validation == '') {
      $('#addProductForm').submit();
    } else {
      alert(validation);
    }
  });
}

function getSourceAdditionalTypeAndImageFields(index) {
  return '<div class="col-lg p-3 m-3" id="doorTypeContainer' + index + '">' + '<label class="form-label" for="doorNameType-0" id="doorNameTypeLabel-' + index + '">Name or Type (ie.' + ' Inswing)</label>' + '<input type="text" id="doorNameType-' + index + '" name="door_name_type-' + index + '" ' + 'class="form-control productFormElement dataFieldDoorProduct" style="min-width: 300px"/>' + '</div>' + '<div class="col-lg p-3 m-3" id="doorTypeImageContainer' + index + '">' + '<label class="form-label" for="doorNameType" id="doorNameTypeLabel">' + ' Add Image for Type </label>' + '<input type="file" style="margin-left: 20px;" name="door_type_image-' + index + '" aria-describedby="doorTypeImage"' + ' id="door_type_image-' + index + '" class="form-control-file">' + '<p><span id="doorNameTypeSpan-' + index + '" class="deleteProduct" style="cursor: pointer" onclick="function f(){' + '$(\'#doorTypeContainer' + index + '\').remove();' + '$(\'#doorTypeImageContainer' + index + '\').remove();' + 'let count = +$(\'#typeCount\').val();' + 'count--;' + '$(\'#typeCount\').val(count);' + '} f()">Remove this type</span></p>' + '</div>';
}

function getSourceForAdditionalSpecifier(count) {
  return '<div class="row p-3 m-3" id="additionalSpecifierNewRow-' + count + '">\n' + '        <div class="col"><label class="form-label" for="additionalDoorSpec-' + count + '" id="subCategoryNameLabel-' + count + '">Optional Select (ie. Full Lite)...</label></div>\n' + '        <div class="col">' + '<input type="text" id="additionalDoorSpec-' + count + '" name="additional_door_spec-' + count + '">' + '<span id="additionalDoorSpecSpan-' + count + '" class="deleteProduct" style="cursor: pointer" onclick="function f(){' + '$(\'#subCategoryNameLabel-' + count + '\').remove();' + '$(\'#additionalSpecifierNewRow-' + count + '\').remove();' + '$(\'#additionalDoorSpec-' + count + '\').remove();' + '$(\'#additionalDoorSpecSpan-' + count + '\').remove();' + 'let count = +$(\'#optionalSelectCount\').val();' + 'count--;' + '$(\'#optionalSelectCount\').val(count);' + '} f()"> X </span></div></div>';
}

function formIsValid() {
  var validation = '';
  var categoryType = getCategoryType($('#categorySelection').val());
  var classType = '';

  switch (categoryType) {
    case 'DOORS':
      classType = '.dataFieldDoorProduct';
      break;

    case 'OTHERS':
      classType = '.dataFieldOtherProduct';
      break;

    default:
      ;
  }

  $(classType).each(function () {
    if ($(this).val().length < 1) validation = validation + ' You must supply a name for all name/type fields.';
  });
  return validation;
}
/******/ })()
;