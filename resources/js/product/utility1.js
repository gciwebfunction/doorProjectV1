window.onload = function () {
    init();
}

function init() {
    document.getElementById('categoriesDatalist').addEventListener('change', function (event) {
        let cat = $('#categoriesDatalist').val();
        $('#categoryNamePlaceholder').text(cat)
        $('#doorTypeListContainer').removeClass('d-none');
        $('#doorTypeListContainer').addClass('d-none');
        $('#litesContainer').addClass('d-none');
        $('.doortypeoption').remove();
        $.get('/p/helper/door/' + cat,
            function (data) {
                    $('#errorContainer').text("");
                    $.each(data, function (index, element) {
                        $('#doorTypeListContainer').removeClass('d-none');
                        if (element.door_type) {
                            $('#doorTypesDatalist').append(
                                '<option class="doortypeoption" value="' + element.id + ' - ' + element.door_type_pretty_name + '">' + element.door_type_pretty_name + '</option>'
                            )
                        }
                    })
                    if(data[0].door_type=='gliding'){
                        $('#litesContainer').removeClass('d-none');
                    }

            });
    });

    $(document).on("keypress", "input", function (e) {
        if (e.which == 13) {
            e.preventDefault();
        }
    });
}

