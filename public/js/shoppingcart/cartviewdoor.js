/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************************!*\
  !*** ./resources/js/shoppingcart/cartviewdoor.js ***!
  \***************************************************/
window.onload = function () {
  $('#otherCartTable').DataTable();
  $('#cartTable').DataTable();
  document.getElementById('goBackToCatalogButton').addEventListener('click', function (event) {
    event.preventDefault();
    window.location = "/dashboard";
  });
  document.getElementById('clearCart').addEventListener('click', function (event) {
    event.preventDefault();
    var cartId = $('#shoppingCartId').val();
    window.location = "/sc/clearcart/" + cartId;
  });
  document.getElementById('submitOrderButton').addEventListener('click', function (event) {
    event.preventDefault();
    $('#cartForm').submit();
  });

  $('.delete').each(function () {
    this.addEventListener('click', function (event) {
      var id = this.id.split('-')[1];
      $('#divFloat').text('Deleting item...');
      $('#centerFloatDiv').removeClass('d-none');

      var vall = $('#pricy-'+id).val();


      // minus from sub value / total value
      var orderSubtotalContainer  = $('#orderSubtotalContainerSp').text();
      var orderTotalContainer     = $('#orderTotalContainerSp').text();
      var sdfdsf                  = orderSubtotalContainer - vall;
      var sdsdfsdss               = orderTotalContainer - vall;

      // alert(orderTotalContainer);
      // alert(sdsdfsdss);
      $('#orderSubtotalContainerSp').text(sdfdsf);
      $('#orderTotalContainerSp').text(sdsdfsdss);


      $.get('/sc/deleteDoorItem/' + id).done(function () {
        $('#itemRow1-' + id).remove();
        $('#itemRow2-' + id).remove();
        $('#itemRow3-' + id).remove();
        $('#message').append('<p>Deleted item!</p>');

      }).fail(function () {
        $('#message').append('<p style="color:red">Deleting item failed.</p>');
      }).always(function () {
        $('#divFloat').text('');
        $('#centerFloatDiv').addClass('d-none');
      });
    });
  });




  $('.deleteProduct').each(function () {
    this.addEventListener('click', function (event) {
      var id = this.id.split('-')[1];
      $('#divFloat').text('Deleting item...');
      $('#centerFloatDiv').removeClass('d-none');

      var valle = $('#pricies-'+id).val();


      // minus from sub value / total value
      var orderSubtotalContainer  = $('#orderSubtotalContainerSp').text();
      var orderTotalContainer     = $('#orderTotalContainerSp').text();
      var sdfds                   = orderSubtotalContainer - valle;
      var sdsdfsds                = orderTotalContainer - valle;

       //alert(valle);
       //alert(sdfds);
       //alert(sdsdfsds);
      $('#orderSubtotalContainerSp').text(sdfds);
      $('#orderTotalContainerSp').text(sdsdfsds);


      $.get('/sc/deleteItem/' + id).done(function () {
        $('#cartItemRow1-' + id).remove();
        $('#cartItemRow1-' + id).remove();
        $('#cartItemRow1-' + id).remove();
        $('#message').append('<p>Deleted item!</p>');

      }).fail(function () {
        $('#message').append('<p style="color:red">Deleting item failed.</p>');
      }).always(function () {
        $('#divFloat').text('');
        $('#centerFloatDiv').addClass('d-none');
      });

    });
  });




};
/******/ })()
;