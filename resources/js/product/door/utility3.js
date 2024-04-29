window.onload = function () {
    init();
}

function disableOrEnableTextField(idArrayElement) {
    if (document.getElementById('isNA-' + idArrayElement).checked) {
        $('#sizePrice-' + idArrayElement).attr('disabled', '');
        $('#sizePrice-' + idArrayElement).attr('placeholder', 'N/A');

    } else {
        $('#sizePrice-' + idArrayElement).removeAttr('disabled');
        $('#sizePrice-' + idArrayElement).attr('placeholder', 'price');
    }
}

function init() {
    $('input[type=checkbox]').each(function () {
        $(this).removeAttr('checked');
    });

    document.getElementById('continueButton').addEventListener('click', function (event) {
        event.preventDefault();
        if (validateForm()) {
            alert("Please fill out all text fields.");
        } else {
            $('#productPricesForm').submit();
        }
    });

    $('input[type=checkbox]').each(function () {
        let id = $(this).attr('id');
        let idArray = id.split("-");
        this.addEventListener('click', function (event) {
            disableOrEnableTextField(idArray[1]);
        });
    });
}

function validateForm() {
    let failed = false;
    $('.dataField').each(function (i, e) {
        if (e.value.length < 1 && !e.disabled) {
            failed = true;
        }
    });

    return failed;
}

