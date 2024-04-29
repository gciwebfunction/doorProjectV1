$('#userTable td').each(function () {
    let id = $(this).parent().children().first().text();
    this.addEventListener('click', function () {
        if (!$(this).hasClass('disabled-indicator')) {
            window.location = "/u/" + id;
        } else {
            window.location = "/u/toggleuser/" + id;
        }
    })
})
