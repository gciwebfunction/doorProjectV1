/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************!*\
  !*** ./resources/js/category/view.js ***!
  \***************************************/
window.onload = function () {
  init();
  console.log('adada');
};

function init() {
  /*$('.categoryRow td').each(function () {
    var id = $(this).parent().children().first().text();
    this.addEventListener('click', function () {
      if (!$(this).hasClass('delete')) {
        window.location = "/c/edit/" + id;
      }
    });
  });*/

  $('.deleteCategory').each(function () {
    this.addEventListener('click', function () {
      $('#divFloat').text('Deleting category...');
      $('#centerFloatDiv').removeClass('d-none');
      var idArray = this.id.split("-");
      var id = idArray[1];
      var name = idArray[2];
      $.get('/c/delete/' + id).done(function () {
        $('#categoryRow-' + id).remove();
        $('#categoryRow-' + id).hide();
        $('#message').append('<p>Deleted category: ' + name + '</p>');
      }).fail(function () {
        $('#message').append('<p style="color:red">Deleting category: ' + name + ' failed.</p>');
      }).always(function () {
        $('#divFloat').text('');
        $('#centerFloatDiv').addClass('d-none');
      });
    });
  });


}


/******/ })()
;