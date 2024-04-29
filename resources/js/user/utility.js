const userTypeSelect = document.getElementById('selectUserType');

if (userTypeSelect) {
    //alert('sdfsf');
    userTypeSelect.addEventListener('change', function () {
        alert(this.value);
        $('.distributorUser').removeClass('d-none');
        $('.standardUser').removeClass('d-none');
        $('.distributorUser').addClass('d-none');
        $('.standardUser').addClass('d-none');
        $('.notADistributor').addClass('d-none');
        if (this.value == 'distributor') {
            $('.distributorUser').removeClass('d-none');
            $('.standardUser').removeClass('d-none');
        } else if (this.value == 'sales' || this.value == 'sales_manager') {
            $('.standardUser').removeClass('d-none');
            $('.notADistributor').removeClass('d-none');
        } else if (this.value == 'dealer') {
            $('.standardUser').removeClass('d-none');
            $('.notADistributor').removeClass('d-none');
        }else if (this.value == 'direct_dealer') {
            $('.standardUser').removeClass('d-none');
            $('.notADistributor').removeClass('d-none');
        }
    });
}

window.onload = function () {
    if ($('#selectedUserTypeHidden').val() == "distributor") {
        $('.distributorUser').removeClass('d-none');
        $('.standardUser').removeClass('d-none');
        $('.userTypeEmptySelector').removeAttr('selected')
        $('#distributorSelector').attr('selected', 'selected');
        $('.notADistributor').addClass('d-none');
    } else if ($('#selectedUserTypeHidden').val() == "sales") {
        $('.standardUser').removeClass('d-none');
        $('.notADistributor').removeClass('d-none');
        $('.userTypeEmptySelector').removeAttr('selected')
        $('#salesSelector').attr('selected', 'selected');
    } else if ($('#selectedUserTypeHidden').val() == "sales_manager") {
        $('.standardUser').removeClass('d-none');
        $('.notADistributor').removeClass('d-none');
        $('.userTypeEmptySelector').removeAttr('selected')
        $('#salesManagerSelector').attr('selected', 'selected');
    } else if ($('#selectedUserTypeHidden').val() == "dealer") {
        $('.standardUser').removeClass('d-none');
        $('.notADistributor').removeClass('d-none');
        $('.userTypeEmptySelector').removeAttr('selected')
        $('#dealerSelector').attr('selected', 'selected');
    }
    else if ($('#selectedUserTypeHidden').val() == "direct_dealer") {
        $('.distributorUser').removeClass('d-none');
        $('.standardUser').removeClass('d-none');
        $('.userTypeEmptySelector').removeAttr('selected')
        $('#directdealerSelector').attr('selected', 'selected');
        $('.notADistributor').addClass('d-none');
    }

}
