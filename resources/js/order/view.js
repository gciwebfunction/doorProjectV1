window.onload = function () {
    init();
}

window.deleteOrderRequest = function (id) {
    window.location = "/or/delete/" + id;
}

window.deleteOrder = function (id) {
    window.location = "/o/delete/" + id;
}

function init() {
    $('#orderRequestTable').DataTable({
        order: [[1, 'desc']],
    });

    $('#orderTable').DataTable({
        order: [[0, 'desc']],
    });
}
