window.onload = function () {
    init();


    // $('#addOnOptionIsPerLight').prop('checked', false);

}

function init() {
    document.getElementById('addAnotherOptionButton').addEventListener('click', function () {
        event.preventDefault();
        let count = +($('#productOptionCount').val());
        $('#productOptionContainer').append(getSourceForAnotherOption(count));
        count++;
        $('#productOptionCount').val(count);
    });

    document.getElementById('saveProductOptionsButton').addEventListener('click', function (event) {
        event.preventDefault();
        let validation = formIsValid();
        if (validation == '') {
            $('#productForm').submit();
        } else {
            alert(validation);
        }
    })
}

function getSourceForAnotherOption(count) {
    return '<div class="p-2 m-2 productOptionContainerTracking" style="border: 1px solid lightgray" id="productOptionContainer-' + count + '" >' +
        '<div class=" p-3 m-3 text-center" style="width: 100%">' +
        '<h4 class="productOptionHeader">Option ' + (count + 1) + '</h4>' +
        '        </div>' +
        '        <div class="row p-3 m-3">' +
        '            <div class="col">' +
        '                <label htmlFor="productOptionSize-' + count + '" class="form-label">Size</label>' +
        '            </div>' +
        '            <div class="col">' +
        '                <input type="text" class="form-control sizeOption optionFormField" id="productOptionSize-' + count + '" name="product_option_size-' + count + '">' +
        '            </div>' +
        '        </div>' +

        '        <div class="row p-3 m-3">' +
        '            <div class="col">' +
        '                <label htmlFor="productOptionColor-' + count + '" class="form-label">Color</label>' +
        '            </div>' +
        '            <div class="col">' +
        '                <input type="text" class="form-control colorOption optionFormField" id="productOptionColor-' + count + '" name="product_option_color-' + count + '">' +
        '            </div>' +
        '        </div>' +
        '        <div class="row p-3 m-3">' +
        '            <div class="col">' +
        '                <label htmlFor="productOptionPrice-' + count + '" class="form-label">Price</label>' +
        '            </div>' +
        '            <div class="col">' +
        '          <input type="number" class="form-control priceOption optionFormField" id="productOptionPrice-' + count + '" name="product_option_price-' + count + '">' +
        '     </div>' +
        '                <div class=" p-3 m-3 text-right  " style="width: 100%; color:red; cursor: pointer">' +
        '                    <h5 class="prodOptionDelete" onclick="optionDelete(' + count + ')">Delete this Option...</h5>' +
        '                </div>'
    '   </div>' +
    '</div>';

}

window.optionDelete = function (index) {
    $('#productOptionContainer-' + index).remove();
    let optionCount = +($('#productOptionCount').val());
    let updatedCount = optionCount - 1;
    $('#productOptionCount').val(updatedCount);

    let counter = +(0);
    $('.productOptionHeader').each(function () {
        $(this).text('Option ' + (counter + 2));
        counter++;
    });

    counter = +(0);
    $('.productOptionContainerTracking').each(function () {
        $(this).attr('id', 'productOptionContainer-' + counter);
        counter++;
    })

    counter = +(0);
    $('.sizeOption').each(function () {
        $(this).attr('name', 'product_option_size-' + counter);
        $(this).attr('id', 'productOptionSize-' + counter);
        counter++;
    })

    counter = +(0);
    $('.priceOption').each(function () {
        $(this).attr('name', 'product_option_price-' + counter);
        $(this).attr('id', 'productOptionPrice-' + counter);
        counter++;
    })


    counter = +(0);
    $('.colorOption').each(function () {
        $(this).attr('name', 'product_option_color-' + counter);
        $(this).attr('id', 'productOptionColor-' + counter);
        counter++;
    })
}

function formIsValid() {
    let validation = '';
    $('.optionFormField').each(function () {
        $(this).removeClass('is-invalid');
        if ($(this).val().length < 1) {
            validation = ' You must supply a name for all name/type fields.';
            $(this).addClass('is-invalid');
        }
    })

    return validation;
}
