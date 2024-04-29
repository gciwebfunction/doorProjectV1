window.onload = function () {
    init();
}

function init() {
    document.getElementById('backButton').addEventListener('click', function (event) {
        event.preventDefault();
        let productId = $('#productId').val();
        window.location = '/p/createflowsteptwo/' + productId;
    });

    document.getElementById('saveChanges').addEventListener('click', function (event) {
        event.preventDefault();
        $('#updateCategoryForm').submit();
    });
}
