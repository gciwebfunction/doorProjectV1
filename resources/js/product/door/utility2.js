window.onload = function () {
    init();
}


function init() {


    document.getElementById('addSizeButton').addEventListener('click', function (event) {
        event.preventDefault();
        let count = +$('#sizeCount').val()
        let liveCounter = 0;
        $('#sizeContainer').append(getSizeSource(count));
        $('.measurementDeleteRow').each(function () {
            this.addEventListener('click', function (event) {
                let id = $(this).attr('id').split('-')[1];
                $('#measurementRow-' + id).remove();
                let fieldIndex = 0;
                $('.widthDatafield').each(function () {
                    $(this).attr('name', 'width-' + fieldIndex);
                    $(this).attr('id', 'width-' + fieldIndex);
                    fieldIndex++;
                    sizeCounter++;
                })
                fieldIndex = 0;
                $('.heightDatafield').each(function () {
                    $(this).attr('name', 'height-' + fieldIndex);
                    $(this).attr('id', 'height-' + fieldIndex);
                    fieldIndex++;
                })
                let sizeCounter = 0;
                $('.measurementRow').each(function () {
                    sizeCounter++;
                })
                $('#sizeCount').val(sizeCounter);
            })
        })
        $('.measurementRow').each(function () {
            liveCounter++;
        })
        $('#sizeCount').val(liveCounter);
    });

    let isGliding = $('#isGliding').val();

    if (isGliding == "false") {
        document.getElementById('addDoorHandlingButton').addEventListener('click', function (event) {
            event.preventDefault();
            let count = +$('#doorHandlingCount').val()
            $('#doorhandling-0').append(getHandlingSource(count));
            count++;
            $('#doorHandlingCount').val(count);
        });
        document.getElementById('addFrameOptionButton').addEventListener('click', function (event) {
            event.preventDefault();
            let count = +$('#frameOptionCount').val()
            $('#frame-0').append(getFrameSource(count));
            count++;
            $('#frameOptionCount').val(count);
        });
    }

    document.getElementById('addColorButton').addEventListener('click', function (event) {
        event.preventDefault();
        let count = +$('#colorCount').val()
        let liveCounter = 0;
        $('#colorContainer').append(getColorSource(count));
        $('.colorDeleteRow').each(function () {
            this.addEventListener('click', function (event) {
                let id = $(this).attr('id').split('-')[1];
                $('#colorRow-' + id).remove();
                let fieldIndex = 0;
                $('.colorDatafield').each(function () {
                    $(this).attr('name', 'color-' + fieldIndex);
                    $(this).attr('id', 'color-' + fieldIndex);
                    fieldIndex++;
                })
                let colorCounter = 0;
                $('.colorRow').each(function () {
                    colorCounter++;
                })
                $('#colorCount').val(colorCounter);
            })
        })
        $('.colorRow').each(function () {
            liveCounter++;
        })
        $('#colorCount').val(liveCounter);
    });

    document.getElementById('continueButton').addEventListener('click', function (event) {
        event.preventDefault();
        if (validateForm()) {
            alert("Please fill out all text fields.");
        } else {
            $('#productDetailsForm').submit();
        }
    });

}

function getSizeSource(count) {
    return '<div class="row  p-1 m-1 measurementRow" id="measurementRow-' + count + '">' +
        '  <div class="col" >' +
        '      <label>Size Option W/H</label>' +
        '  </div>' +
        '  <div class="col">' +
        '      <input class="form-control dataField widthDatafield" type="text" name="width-' + count + '" id="width-' + count + '"' +
        '             placeholder="Width">' +
        '  </div>' +
        '  <div class="col">' +
        '      <input class="form-control dataField heightDatafield" type="text" name="height-' + count + '" id="height-' + count + '"' +
        '             placeholder="Height">' +
        '</div><div class="col-1">' +
        '<span id="sizeSpan-' + count + '" class="measurementDeleteRow p-1 m-1" style="cursor: pointer; background-color: red">X</span>' +
        '  </div>' +
        '</div>';
}

function getHandlingSource(count) {
    return '<input class="form-control-sm dataField" type="text" size="70"  name="doorhandling-' + count + '" id="doorHandling-' + count + '" placeholder="Door Handling"><span id="doorHandlingSpan-' + count + '" class="deleteProduct" style="cursor: pointer" onclick="function d(){' +
        '$(\'#doorHandling-' + count + '\').remove();' +
        '$(\'#doorHandlingSpan-' + count + '\').remove();' +
        'let count = +$(\'#doorHandlingCount\').val();' +
        'count--;' +
        '$(\'#doorHandlingCount\').val(count);' +
        '} d()">X</span>'
}

function getColorSource(count) {
    return '<div class="row p-1 m-1 colorRow" id="colorRow-' + count + '">' +
        ' <div class="col">' +
        '  <label>Finish/Color</label>' +
        ' </div>' +
        ' <div class="col">' +
        '  <input class="form-control dataField colorDatafield" type="text"' +
        '    name="color-' + count + '"' +
        '    id="color-' + count + '"' +
        '    placeholder="Finish/Color">' +
        '</div><div class="col-1">' +
        '  <span id="colorSpan-' + count + '" class="colorDeleteRow p-1 m-1" style="cursor: pointer; background-color: red">X</span>' +
        ' </div>' +
        '</div>';
}

function getFrameSource(count) {
    return '<input class="form-control-sm dataField" type="text" size="70"   name="frame-' + count + '" id="frame-' + count + '" placeholder="Frame Option">' +
        '<span id="frameSpan-' + count + '" class="deleteProduct" style="cursor: pointer" onclick="function e(){' +
        '$(\'#frame-' + count + '\').remove();' +
        '$(\'#frameSpan-' + count + '\').remove();' +
        'let count = +$(\'#frameOptionCount\').val();' +
        'count--;' +
        '$(\'#frameOptionCount\').val(count);' +
        '} e()">X</span>'
}

function validateForm() {
    let failed = false;
    $('.dataField').each(function (i, e) {
        if (e.value.length < 1) {
            failed = true;
        }
    });

    return failed;
}

function removeField(id) {
    $(id).remove();
}
