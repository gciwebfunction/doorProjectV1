window.onload = function () {
    init();
}

function addPriceValue(finishPrice) {
    let currentValue = +$('#priceValue').text();
    let newvalue = +finishPrice + +currentValue;
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
    document.getElementById('addItemToCartButton')
        .addEventListener('click', function (event) {
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
        let selectedVal = $(this).val();

        if (selectedVal > 0) {
            try {
                let price = $('#productOptionPrice-' + selectedVal).val();
                setPriceValue(price);
            } catch (e) {
                console.log("Error updating price:" + e);
            }
        }
    });
}
