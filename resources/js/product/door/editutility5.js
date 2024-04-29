window.onload = function () {
    init();
}

function disableOrEnableTextField(id, idType) {
    let checkboxId;
    let elementId;
    if (idType == 'sdlIsNA') {
        elementId = '#sdl_option_price-' + id;
        checkboxId = 'sdlIsNA-' + id;
    }

    if (document.getElementById(checkboxId).checked) {
        $(elementId).attr('disabled', '');
        $(elementId).attr('placeholder', 'N/A');

    } else {
        $(elementId).removeAttr('disabled');
        $(elementId).attr('placeholder', 'price');
    }
}

function init() {

    $('.dataField').each(function () {
        let id = $(this).attr('id');
        let hiddenIdList = $('#hiddenIdList').val();
        if (hiddenIdList != '') {
            hiddenIdList = hiddenIdList + ",";
        }

        $('#hiddenIdList').val(hiddenIdList + id);
    })

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
    let id = $(this).attr('id');
    let idArray = id.split("-");
    this.addEventListener('click', function (event) {
        disableOrEnableTextField(idArray[1], idArray[0]);
    });
});

function validateForm() {
    let failed = false;
    $('.dataField').each(function (i, e) {

    });

    return failed;
}

