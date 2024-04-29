window.onload = function () {
    $('#otherCartTable').DataTable();
    $('#cartTable').DataTable();

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

    document.getElementById('submitOrderButton').addEventListener('click', function (event) {
        event.preventDefault();
        $('#cartForm').submit();
    });


var vall   = 0;
    $('.delete').each(function () {
        this.addEventListener('click', function (event) {
            let id = this.id.split('-')[1];
            $('#divFloat').text('Deleting item...')
            $('#centerFloatDiv').removeClass('d-none');
            vall = $('#pricy-'+id).val();
            alert(vall);

            // minus from sub value / total value
            var orderSubtotalContainer  =   $('#orderSubtotalContainerSp').text();
            var orderTotalContainer     =   $('#orderTotalContainerSp').text();
            var sdfdsf                  = orderSubtotalContainer - vall;
            var sdsdfsdss               = orderTotalContainer - vall;

            alert(sdsdfsdss);
            $('#orderTotalContainerSp').text(sdfdsf);
            $('#orderTotalContainerSp').text(sdsdfsdss);

            $.get('/sc/deleteDoorItem/' + id)
                .done(function () {
                    $('#itemRow1-' + id).remove();
                    $('#itemRow2-' + id).remove();
                    $('#itemRow3-' + id).remove();
                    $('#message').append('<p>Deleted item!</p>');




                    vall = 0 ;

                })
                .fail(function () {
                    $('#message').append('<p style="color:red">Deleting item failed.</p>');
                }).always(function () {
                $('#divFloat').text('');
                $('#centerFloatDiv').addClass('d-none');

                // var kk = 0;
                // $('.pricy').each(function () {kk += this.value; });



            });
        });
    })
};
