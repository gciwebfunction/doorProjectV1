window.onload = function () {
    document.getElementById('goBackToCatalogButton').addEventListener('click',
        function (event) {
            event.preventDefault();
            window.location = "/dashboard";
        });

    document.getElementById('clearCart').addEventListener('click', function (event) {
        event.preventDefault();
        let cartId = $('#shoppingCartId').val()
        window.location = "/sc/clearcart/" + cartId;
    });

    document.getElementById('wsubmitOrderButton').addEventListener('click', function (event) {
        event.preventDefault();
        $('#cartForm').submit();
    });
};
