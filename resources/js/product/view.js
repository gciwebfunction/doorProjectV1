$('#productTable td').click(function () {
    let id = $(this).parent().children().first().text();

    if (!$(this).hasClass('delete')) {
        window.location = '/p/editdoorflowstepone/' + id;
    }
});

window.deleteProduct = function (id) {
    $('#divFloat').text('Deleting door...')
    $('#centerFloatDiv').removeClass('d-none');

    $('#deleteProduct' + id).hide();

    window.location = '/p/deleteDoor/' + id;
}

$(document).ready(function () {
    $('#productTable').dataTable();
});


