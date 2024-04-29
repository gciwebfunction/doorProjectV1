/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************************!*\
  !*** ./resources/js/permission/viewuser.js ***!
  \*********************************************/
window.onload = function () {
  init();
};

window.removePermissionFromGroup = function (permId, groupId) {
  window.location = "/perm/remove/" + groupId + "/" + permId;
};

function init() {
  $('#permissionTable').DataTable();
}
/******/ })()
;