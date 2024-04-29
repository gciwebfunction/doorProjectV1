/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************!*\
  !*** ./resources/js/user/view.js ***!
  \***********************************/
$('#userTable td').each(function () {
  var id = $(this).parent().children().first().text();
  this.addEventListener('click', function () {
    if (!$(this).hasClass('disabled-indicator')) {
      window.location = "/u/" + id;
    } else {
      window.location = "/u/toggleuser/" + id;
    }
  });
});
/******/ })()
;