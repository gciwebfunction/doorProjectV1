/******/ (() => { // webpackBootstrap
  var __webpack_exports__ = {};
  /*!**************************************!*\
    !*** ./resources/js/user/utility.js ***!
    \**************************************/
  var userTypeSelect = document.getElementById('selectUserType');

  if (userTypeSelect) {
    userTypeSelect.addEventListener('change', function () {
      //alert('Aspirant');

      $('.distributorUser').removeClass('d-none');
      $('.standardUser').removeClass('d-none');
      $('.distributorUser').addClass('d-none');
      $('.standardUser').addClass('d-none');
      $('.notADistributor').addClass('d-none');
      $('.notAManufacturere').addClass('d-none');


      $('#shipping_address_div,#physical_address_div').show();

      $('#contact_person_div,#all_contact_div,#name_div,#all_contact_phone').show();
      $('#physical_address,#physical_state,#physical_city,#physical_zip,#state,#address,#state,#inputCity,#inputZip').prop('required',true);


      $('#new_dealer_fields').hide();



      if (this.value == 'distributor') {
        $('.distributorUser').removeClass('d-none');
        $('.standardUser').removeClass('d-none');
        $('.title_user_type').html("Distributor");
        $('#new_dealer_fields').show();


      } else if (this.value == 'sales' || this.value == 'sales_manager') {

        $('#shipping_address_div,#physical_address_div').hide();
        $('#contact_person_div,#all_contact_div,#name_div,#all_contact_phone').hide();
        $('#physical_address,#physical_address2,#physical_state,#physical_city,#physical_zip,#state,#address,#address2,#state,#inputCity,#inputZip').prop('required',false);

        $('.standardUser').removeClass('d-none');
        //$('.notADistributor').removeClass('d-none');
        $('.notAManufacturere').removeClass('d-none');
        if(this.value == 'sales'){
          $('.title_user_type').html("Sales User");
        }
        else{
          $('.title_user_type').html("Sales Manager");
          // don't show the shipping address for sales mananger


        }
      } else if (this.value == 'dealer') {
        $('.standardUser').removeClass('d-none');
        $('.notADistributor').removeClass('d-none');
        $('.title_user_type').html("Dealer");
        $('#new_dealer_fields').show();
      }else if (this.value == 'direct_dealer') {
        $('.distributorUser').removeClass('d-none');
        $('.standardUser').removeClass('d-none');
        $('.title_user_type').html("Direct Dealer");
        $('#new_dealer_fields').show();

      }
      // condition for the manufatuerr user
      else if (this.value == 'manufacturer') {
        $('.distributorUser').removeClass('d-none');
        $('.standardUser').removeClass('d-none');
        $('.userTypeEmptySelector').removeAttr('selected');
        //$('#distributorSelector').attr('selected', 'selected');
        $('.notADistributor').addClass('d-none');
        $('.title_user_type').html("Manufacturer");
      }


    });
  }

  window.onload = function () {

    //$('#selectUserType').find('option[class=userTypeEmptySelector]').prop('selected', true);
    $('option.userTypeEmptySelector').prop('selected', true);
    // var should_be_selected = '.userTypeEmptySelector';
    // $('#selectUserType').find(should_be_selected).prop('selected', true)

    // for sales manager hide only
    $('#shipping_address_div').show();

    if ($('#selectedUserTypeHidden').val() == "distributor") {
      $('.distributorUser').removeClass('d-none');
      $('.standardUser').removeClass('d-none');
      $('.userTypeEmptySelector').removeAttr('selected');
      $('#distributorSelector').attr('selected', 'selected');
      $('.notADistributor').addClass('d-none');
      $('.title_user_type').html("Distributor");



    } else if ($('#selectedUserTypeHidden').val() == "sales") {
      $('.standardUser').removeClass('d-none');
      $('.notADistributor').removeClass('d-none');
      $('.userTypeEmptySelector').removeAttr('selected');
      $('#salesSelector').attr('selected', 'selected');
      $('.title_user_type').html("Sales User");


      $('#shipping_address_div,#physical_address_div').hide();
      $('#contact_person_div,#all_contact_div,#name_div,#all_contact_phone').hide();
      $('#physical_address,#physical_address2,#physical_state,#physical_city,#physical_zip,#state,#address,#address2,#state,#inputCity,#inputZip').prop('required',false);


    } else if ($('#selectedUserTypeHidden').val() == "sales_manager") {


      $('#shipping_address_div,#physical_address_div').hide();
      $('#contact_person_div,#all_contact_div,#name_div,#all_contact_phone').hide();
      $('#physical_address,#physical_address2,#physical_state,#physical_city,#physical_zip,#state,#address,#address2,#state,#inputCity,#inputZip').prop('required',false);
      $('.standardUser').removeClass('d-none');
      $('.notADistributor').removeClass('d-none');
      $('.userTypeEmptySelector').removeAttr('selected');
      $('#salesManagerSelector').attr('selected', 'selected');
      $('.title_user_type').html("Sales Manager");



    } else if ($('#selectedUserTypeHidden').val() == "dealer") {
      $('.standardUser').removeClass('d-none');
      $('.notADistributor').removeClass('d-none');
      $('.userTypeEmptySelector').removeAttr('selected');
      $('#dealerSelector').attr('selected', 'selected');
      $('.title_user_type').html("Dealer");
    } else if ($('#selectedUserTypeHidden').val() == "direct_dealer") {
      $('.distributorUser').removeClass('d-none');
      $('.standardUser').removeClass('d-none');
      $('.userTypeEmptySelector').removeAttr('selected');
      $('#distributorSelector').attr('selected', 'selected');
      $('.notADistributor').addClass('d-none');
      $('.title_user_type').html("Direct Dealer");
    }
  };
  /******/ })()
;