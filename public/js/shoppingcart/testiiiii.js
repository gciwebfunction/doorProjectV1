


    (function($) {
    $(document).ready(function() {
        $("#openfaq").attr("href", "javascript:void(0)");
        $("#closefaq").attr("href", "javascript:void(0)");

        setTimeout(function() {
            if (navigator.userAgent.toLowerCase().match(/mobile/i)) {

                // for mobile menu close
                /*    jQuery( 'li.menu-item a' ).on( 'click', function() {
                        document.getElementByClass( 'elementor-nav-menu--dropdown' ).classList.remove( 'active', 'show' ); document.getElementsByTagName('body')[0].classList.remove( 'ast-popup-nav-open', 'ast-main-header-nav-open' ); jQuery('.main-header-menu-toggle')[0].style.display = 'flex'; 	jQuery('.main-header-menu-toggle')[1].style.display = 'flex'; } );*/



                $("div.elementor-tabs-content-wrapper > :first-child").removeClass('elementor-active');
                //$("#LeftScrollableDiv > :first-child")
                //$("div.elementor-tab-title").setAttribute('aria-checked', 'false');
                var preview = document.querySelectorAll (".elementor-tab-title");
                for (var i = 0; i < preview.length;  i++) {
                    preview[i].setAttribute("aria-checked", 'false');
                    preview[i].setAttribute("aria-expanded", 'false');

                    //$("div.elementor-tab-title").first().removeClass('elementor-active');
                    //preview[i].removeClass('elementor-active');
                }

                //alert("This is a mobile device.");
                $('#elementor-tab-content-5431').hide();
                $('#elementor-tab-content-1311').hide();
                $('.elementor-tab-content').hide();


                $("div.elementor-tabs-content-wrapper > :first-child").click(function(){

                    $(this).addClass('elementor-active');
                    if($(this).text() == 'QR Menu'){
                        //$('#elementor-tab-content-1311').hide();
                        $('#elementor-tab-content-8611').show();
                        //
                        //alert('inside QR menu');
                    }


                    if($(this).text() == 'All'){
                        $('#elementor-tab-content-1311').show();


                    }

                });




            }
        }, 2000);

    });
})(jQuery);

