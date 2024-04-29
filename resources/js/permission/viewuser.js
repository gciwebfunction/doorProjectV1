window.onload = function () {
    init();
}

window.removePermissionFromGroup = function (permId, groupId) {
    window.location = "/perm/remove/" + groupId + "/" + permId;
}

function init() {
    $('#permissionTable').DataTable();
}
