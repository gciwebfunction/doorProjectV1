window.onload = function () {
    init();
}

function init() {
   /* $('.categoryRow td').each(function () {
        let id = $(this).parent().children().first().text();
        this.addEventListener('click', function () {
            if (!$(this).hasClass('delete')) {
                window.location = "/c/edit/" + id;
            }
        })
    })*/

    $('.deleteCategory').each(function () {
        this.addEventListener('click', function () {
            $('#divFloat').text('Deleting category...')
            $('#centerFloatDiv').removeClass('d-none');

            let idArray = this.id.split("-");
            let id = idArray[1];
            let name = idArray[2];
            $.get('/c/delete/' + id)
                .done(function () {
                    $('#categoryRow-' + id).remove();
                    $('#message').append('<p>Deleted category: ' + name + '</p>');
                })
                .fail(function () {
                    $('#message').append('<p style="color:red">Deleting category: ' + name + ' failed.</p>');
                }).always(function () {
                $('#divFloat').text('');
                $('#centerFloatDiv').addClass('d-none');
            });
        });
    });
}
