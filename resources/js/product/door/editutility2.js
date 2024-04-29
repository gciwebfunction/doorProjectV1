window.onload = function () {
    init();
}

function init() {
    $('#doorFinishPriceContainer div').each(
        function () {
            let idArray = $(this).attr('id').split('-');
            let price = $(this).text()
            $('#finish_price-' + idArray[1] + '-' + idArray[2]).val(price);
        }
    )

    document.getElementById('submitEditButton').addEventListener('click', function (event) {
        event.preventDefault();
        let validation = formIsValid();
        if (validation == '') {
            $('#editProductForm').submit();
        } else {
            alert(validation);
        }

    });

}

function formIsValid() {
    let validation = '';

    $('.dataField').each(function () {
        if ($(this).val().length < 1)
            return 'Please provide a value for all fields.';
    })

    return validation;
}
