/******/ (() => { // webpackBootstrap
    var __webpack_exports__ = {};
    /*!************************************************!*\
      !*** ./resources/js/shoppingcart/doorcart1.js ***!
      \************************************************/
    var finishSizeCodeArray                 = [];
    var addOnOptionSizeCodeArray            = [];

    window.handleTypeSelectHTML             = $('#handleTypeSelect').clone();
//window.handleTypeSelectHTML2      = $('#handleTypeSelect2').clone();

    window.lockSetSelectHTML                = $('#lockSetSelect').clone();
    window.glassDepthSelectHTML             = $('#glassDepthSelect').clone();
    window.glassOptionSelectHTML            = $('#glassOptionSelect').clone();

    window.sillOptionSelectHTML             = $('#sillOptionSelect').clone();

    window.mullkitOptionSelectHTML          = $('#mullkitOptionSelect').clone();


    window.frameThicknessOptionSelectHTML   = $('#frameThicknessOptionSelect').clone();

// Screen option
    window.screennewOptionSelectHTML        = $('#screennewOptionSelect').clone();


    window.dpOptionSelectHTML               = $('#dpOptionSelect').clone();

    window.blindOptionSelectHTML            = $('#blindOptionSelect').clone();
    window.liteOptionSelectHTML             = $('#liteOptionSelect').clone();



    window.hardwareColorOptionSelectHTML    = $('#handlecolorOptionSelect').clone();

    window.lockColorOptionSelectHTML        = $('#lockcolorOptionSelect').clone();
    window.sillcolorOptionSelectHTML        = $('#sillcolorOptionSelect').clone();
    window.hingecolorOptionSelectHTML       = $('#hingecolorOptionSelect').clone();


    var validationError;
    //validationError = 0 ;


    window.onload = function () {
         validationError = 0 ;
        init();
        var doorNameTypeId              = $('#doorNameTypeIdSelection').val();
        var sizeId                      = $('#oldSize').val();
        var handlingId                  = $('#oldHandling').val();
        //var handlingId2                 = $('#oldHandling2').val();


        //var frameId                     = $('#oldFrame').val();
        var colorId                     = $('#oldColor').val();

        var gridId                      = $('#oldGlassGrid').val();
        // var gridId                      = $('#oldGlassGrid').val();
        // var gridId                      = $('#oldGlassGrid').val();



    
        var glassOptionId               = $('#oldGlassOption').val();
        var depthId                     = $('#oldGlassDepth').val();
        var handleTypeId                = $('#oldHandleType').val();
        var lockSetId                   = $('#oldLockset').val();

        var thicccId                    = $('#oldframeThickness').val();

        var sillId                      = $('#oldSillOption').val();
        var hardwarecolorId             = $('#oldhardwareColorOption').val();
        var screennewOptionId           = $('#oldscreennewOption').val();

        var mullKitSelectId             = $('#oldmullkitOptionSelect').val();
        var olddpOptionSelect           = $('#olddpOptionSelect').val();

        var blindOptionId               = $('#oldBlindOptionSelect').val();
        //dpOptionSelectHTML
        //var mullKitSelectId           = $('#oldThickness').val();


        var sillColortId                = $('#oldSillcolorOption').val();
        var lockdClrId                  = $('#oldLockcolorOption').val();
        var handlClrId                  = $('#oldHandlecolorOption').val();


        // this is taking old value / so commented it out  / so user will
        // have to select all options again
        /*if (sizeId && sizeId > 0) {
            $('#doorSizeSelect').val(sizeId);
            setupSelectBoxes();
        }*/

        if (doorNameTypeId && doorNameTypeId > 0) {
            $('.doorNameClass').attr('style', 'border: 2px solid black');
            //$('#doornameid-' + doorNameTypeId).attr('style', 'border: 2px solid red');
            $('#doornameid-' + doorNameTypeId).css({
                'border': '2px solid red',
                'text-align': 'center'
            });


            //alert('door chnah');
            // price to 0
            $('#priceValue').html('');
            $('#priceValueInput').val(0);

            // set size to 0 / reset
            $('#doornameid-' + doorNameTypeId).val('');
        }

        if (handlingId && handlingId > 0) {
            $('#doorHandlingSelect').val(handlingId);
        }

        // for door handle 2
        // if (handlingId2 && handlingId2 > 0) {
        //   $('#doorHandlingSelect2').val(handlingId2);
        // }


        // if (frameId && frameId > 0) {
        //   $('#doorFrameSelect').val(frameId);
        // }

        if (colorId && colorId > 0) {
            $('#doorColorSelect').val(colorId);
        }

        if (gridId && gridId > 0) {
            $('#glassGridSelect').val(gridId);
        }

        if (glassOptionId && glassOptionId > 0) {
            $('#glassOptionSelect').val(glassOptionId);
        }

        if (depthId && depthId > 0) {
            $('#glassDepthSelect').val(depthId);
        }

        if (handleTypeId && handleTypeId > 0) {
            $('#handleTypeSelect').val(handleTypeId);
        }

        if (lockSetId && lockSetId > 0) {
            $('#lockSetSelect').val(lockSetId);
        }

        if (thicccId && thicccId > 0) {
            $('#frameThicknessSelect').val(thicccId);
        }

        if (sillId && sillId > 0) {
            $('#sillOptionSelect').val(sillId);
        }

        // if (hardwarecolorId && hardwarecolorId > 0) {
        //   $('#hardwareColorOptionSelect').val(hardwarecolorId);
        // }

        // old selected value assignment
        if (screennewOptionId && screennewOptionId > 0) {
            $('#screennewOptionSelect').val(screennewOptionId);
        }

// old selected value assignment
        if (blindOptionId && blindOptionId > 0) {
            $('#blindOptionSelect').val(blindOptionId);
        }

        // mull kit select
        if (mullKitSelectId && mullKitSelectId > 0) {
            $('#mullKitSelect').val(mullKitSelectId);
        }

        if (sillColortId && sillColortId > 0) {
            $('#sillcolorOptionSelect').val(sillColortId);
        }
        if (lockdClrId && lockdClrId > 0) {
            $('#lockcolorOptionSelect').val(lockdClrId);
        }

        if (handlClrId && handlClrId > 0) {
            $('#handlecolorOptionSelect').val(handlClrId);
        }


    };


    function init() {
        setupOptionSpecificationsSelectBox();
        document.getElementById('doorSizeSelect').addEventListener('change', function (event) {

            $("#glassblindOptionSelect").val("");
            $("#blindGlassliteOptionSelect").val("");
            // doorColorSelect

            // reset the
            //

            setupSelectBoxes();
            //$("#doorSizeSelect option:selected").text();

            //assemble_knocked_option_select

            // for heigth check
            var doorSize    = $("#doorSizeSelect option:selected").text().split(" x ");
            var strss       = doorSize[0];
            var www         = strss.split("'")[0];

            if(www>=10){
                //alert
                //alert('GReater-equal');
                var select = $('#assemble_knocked_option_select');
                select.empty().append('<option value="Knocked Down">Knocked Down</option>');
            }else{
                //alert('lesser');
                var select = $('#assemble_knocked_option_select');
                select.empty().append('<option value="Full Assembled">Full Assembled</option><option value="Knocked Down">Knocked Down</option>');
            }

            var str         = doorSize[1];
            var height      =  (parseInt(str.substring(0,1)));
            $('#doorSizeSelectError').hide();
            if(height >= 8){
                $("#assemble_knocked_option_select option:contains('Assemble Option')").attr("disabled","disabled");
            }
        });

        $('.doorNameClass').each(function () {
            this.addEventListener('click', function (event) {

                $('select').prop("disabled", true);
                $('select#main_drop').prop("disabled", true);

                //alert('im called');
                event.preventDefault();
                //$('.doorNameClass').attr('style', 'border: 2px solid black');
                $('.doorNameClass').css({
                    'border': '2px solid black',
                    'text-align': 'center'
                });
                //$(this).attr('style', 'border: 2px solid red');
                //$(this).attr('style', 'text-align: center');
                $(this).css({
                    'border': '2px solid red',
                    'text-align': 'center'
                });

                $('.hiddeee').each(function() {
                    $(this).val(0);
                });
                $('#priceValue').text('');
                $("#priceValueInput").val(0);
                $("#vale_till_finish_color").val(0);
                $("#doorSizeSelect").val('');


                $('#doorSizeSelect').removeAttr('disabled');
                //$('#doorHandlingSelect2').removeAttr('disabled');
                //$('#doorHandlingSelect').removeAttr('disabled');


                var nameId    = this.id.split("-")[1];
                var doorName  = this.id.split("-")[2];
                $('#doorNameTypeIdSelection').val(nameId);

                var str2 = "Inswing";

                var str3 = "Outswing";
                if(doorName.indexOf(str2) != -1){
                    $('#dp_main_di').hide();
                }

                if(doorName.indexOf(str3) != -1){
                    $('#dp_main_di').show();
                }
                //$('#doorNameTypeIdSelection').val(nameId);
            });
        });




        // for door color Select
        var dorcClrSle  =  document.getElementById('doorColorSelect');
        if (typeof(dorcClrSle) != 'undefined' && dorcClrSle != null) {
            dorcClrSle.addEventListener('change', function () {

                var colorSelectArray  = $("#doorColorSelect option:selected").text().split("+");
                if (colorSelectArray.length > 1) {
                    var colorPrice    = colorSelectArray[1].trim();
                    colorPrice        =  colorPrice.replace("$", "");

                    $("#doorColorSelectError").hide();
                    $("#finish_color_pr").val(colorPrice);
                    var sum = 0;
                    $('.hiddeee').each(function() {
                        sum += parseInt($(this).val()) || 0;
                    });

                    basePrice         = sum;
                    $('#priceValue').text('');
                    $('#priceValue').text(basePrice);
                    $("#priceValueInput").val(basePrice);
                    $("#vale_till_finish_color").val(basePrice);
                }
            });
        }

        // for glass option
        var glasoTetSect =  document.getElementById('glassOptionSelect');
        if (typeof(glasoTetSect) != 'undefined' && glasoTetSect != null) {
            glasoTetSect.addEventListener('change', function () {
                var glassOptionIDArray = $("#glassOptionSelect option:selected").attr('id').split("-");

                if (glassOptionIDArray.length >= 1) {

                    //var glassOptoiPrice = parseInt(glassOptionIDArray[3].trim());
                    var glassOptoiPrice = glassOptionIDArray[3].trim();
                    //alert(glassOptoiPrice);
                    $("#glass_option_pr").val(glassOptoiPrice);
                    // set blind to 0
                    $("#blind_option_pr").val(0);

                    $('#old_glass_option_price').val(0);
                    $('#old_glass_option_price').val(glassOptoiPrice);

                    var sum = 0;
                    $('.hiddeee').each(function() {
                        sum += parseInt($(this).val()) || 0;
                    });
                    basePrice = sum;
                    $('#priceValue').text('');
                    $('#priceValue').text(basePrice);
                    $("#priceValueInput").val(basePrice);
                }
            });
        }



        // update price : Blind option
        var blindOptSele =  document.getElementById('blindOptionSelect');
        if (typeof(blindOptSele) != 'undefined' && blindOptSele != null) {
            blindOptSele.addEventListener('change', function () {

                var blindArray                = $("#blindOptionSelect option:selected").text().split("-");
                var blindIDArray              = $("#blindOptionSelect option:selected").attr('id').split("-");

                if (blindIDArray.length > 1) {
                    // set glass  / lite option to null / 0
                    $('#glass_option_pr,#lite_option_pr').val(0);

                    var blindIDArray            = +blindIDArray[3].trim();

                    //alert('condition tro ==> vale_till_finish_color' + vale_till_finish_color + 'blindIDArray==>' + blindIDArray);

                    $('#blind_option_pr').val(blindIDArray);
                    var sum = 0;
                    $('.hiddeee').each(function() {
                        sum += parseInt($(this).val()) || 0;
                    });
                    basePrice = sum;

                    $('#priceValue').text('');
                    $('#priceValue').text(basePrice);
                }
            });
        }


        // update price : Lite option
        var liteOptSele =  document.getElementById('liteOptionSelect');
        if (typeof(liteOptSele) != 'undefined' && liteOptSele != null) {
            liteOptSele.addEventListener('change', function () {

                var liteOptionIDArray  = $("#liteOptionSelect option:selected").attr('id').split("-");

                if (liteOptionIDArray.length > 1) {
                    var litePrice = liteOptionIDArray[3].trim();
                    $("#oldGlassGrid").val();
                    $('#glass_grid_pr').val(0);
                    $("#lite_option_pr").val(litePrice);
                    $("#liteOptionSelectError").hide();


                    $('#oldLiteOptionSelect').val(0);
                    $('#oldLiteOptionSelect').val(litePrice);

                    var sum = 0;
                    $('.hiddeee').each(function() {
                        sum += parseInt($(this).val()) || 0;
                    });
                    basePrice = sum;
                    $('#priceValue').text('');
                    $('#priceValue').text(basePrice);
                    $("#priceValueInput").val(basePrice);
                }
            });
        }

        //update price : Handle Types
        var hndlyStpeClrSle =  document.getElementById('handleTypeSelect');
        if (typeof(hndlyStpeClrSle) != 'undefined' && hndlyStpeClrSle != null) {
            hndlyStpeClrSle.addEventListener('change', function () {
                //  handleType price update
                var handleTypeIDArray = $("#handleTypeSelect option:selected").attr('id').split("-");
                if (handleTypeIDArray.length > 1) {
                    var handlePrice = handleTypeIDArray[3].trim();
                    $("#handle_type_pr").val(handlePrice);
                    $("#handleTypeSelectError").hide();
                    var sum = 0;
                    $('.hiddeee').each(function() {
                        sum += parseInt($(this).val()) || 0;
                    });
                    basePrice = sum;
                    $('#priceValue').text('');
                    $('#priceValue').text(basePrice);
                    $("#priceValueInput").val(basePrice);
                }
            });
        }


        var lockSetSect =  document.getElementById('lockSetSelect');
        if (typeof(lockSetSect) != 'undefined' && lockSetSect != null) {
            lockSetSect.addEventListener('change', function () {
                //updatePrice();
                var lockSetIDArray = $("#lockSetSelect option:selected").attr('id').split("-");
                if (lockSetIDArray.length > 1) {
                    var lockPrice = +lockSetIDArray[3].trim();
                    $("#lock_set_pr").val(lockPrice);

                    $("#lockSetSelectError").hide();

                    var sum = 0;
                    $('.hiddeee').each(function() {
                        sum += parseInt($(this).val()) || 0;
                    });
                    basePrice = sum;
                    $('#priceValue').text('');
                    $('#priceValue').text(basePrice);
                    $("#priceValueInput").val(basePrice);
                }
            });
        }

        var glassGridSle =  document.getElementById('glassGridSelect');
        if (typeof(glassGridSle) != 'undefined' && glassGridSle != null) {
            glassGridSle.addEventListener('change', function () {

                var glassGridIDArray  = $("#glassGridSelect option:selected").attr('id').split("-");

                if (glassGridIDArray.length > 1) {
                    var glsaPrice = +glassGridIDArray[3].trim();
                    // set blind and lite to 0
                    $("#lite_option_pr,#blind_option_pr").val(0);


                    $("#glassGridSelectError").hide();
                    $("#glass_grid_pr").val(glsaPrice);

                    var sum = 0;
                    $('.hiddeee').each(function() {
                        sum += parseInt($(this).val()) || 0;
                    });
                    basePrice = sum;
                    $('#priceValue').text('');
                    $('#priceValue').text(basePrice);
                    $("#priceValueInput").val(basePrice);
                }
            });
        }


        var famrethcikSle =  document.getElementById('frameThicknessOptionSelect');
        if (typeof(famrethcikSle) != 'undefined' && famrethcikSle != null) {
            famrethcikSle.addEventListener('change', function () {

                var famethickopIDArray  = $("#frameThicknessOptionSelect option:selected").attr('id').split("-");

                if (famethickopIDArray.length > 1) {
                    var farmtPrice = +famethickopIDArray[3].trim();
                    $('#frameThicknessOptionSelectError').hide();

                    $("#thickness_pr").val(farmtPrice);
                    var sum = 0;
                    $('.hiddeee').each(function() {
                        sum += parseInt($(this).val()) || 0;
                    });
                    basePrice = sum;
                    $('#priceValue').text('');
                    $('#priceValue').text(basePrice);
                    $("#priceValueInput").val(basePrice);
                }
            });
        }

        // update price sill option
        var sillOptSle =  document.getElementById('sillOptionSelect');
        if (typeof(sillOptSle) != 'undefined' && sillOptSle != null) {
            sillOptSle.addEventListener('change', function () {

                var sillOptionSelectIDArray = $("#sillOptionSelect option:selected").attr('id').split("-");

                if (sillOptionSelectIDArray.length > 1) {
                    var sillPrice = +sillOptionSelectIDArray[3].trim();
                    $('#sillOptionSelectError').hide();
                    $("#sill_pr").val(sillPrice);
                    var sum = 0;
                    $('.hiddeee').each(function() {
                        sum += parseInt($(this).val()) || 0;
                    });
                    basePrice = sum;
                    $('#priceValue').text('');
                    $('#priceValue').text(basePrice);
                    $("#priceValueInput").val(basePrice);

                }
            });
        }

        // update price mull kit
        var mulkitEle =  document.getElementById('mullkitOptionSelect');
        if (typeof(mulkitEle) != 'undefined' && mulkitEle != null) {
            mulkitEle.addEventListener('change', function () {
                if (mullkitOptionIDArray.length >= 1) {
                    var mulkitOptoiPrice = +mullkitOptionIDArray[3].trim();

                    $("#mull_kit_pr").val(mulkitOptoiPrice);
                    var sum = 0;
                    $('.hiddeee').each(function() {
                        sum += parseInt($(this).val()) || 0;
                    });
                    basePrice = sum;
                    $('#priceValue').text('');
                    $('#priceValue').text(basePrice);
                    $("#priceValueInput").val(basePrice);

                }
            });
        }

        // update price : DP option kit
        var dpOpSle =  document.getElementById('dpOptionSelect');
        if (typeof(dpOpSle) != 'undefined' && dpOpSle != null) {
            dpOpSle.addEventListener('change', function () {

                var dpOptionIDArray  = $("#dpOptionSelect option:selected").attr('id').split("-");

                if (dpOptionIDArray.length > 1) {
                    var dpOptoinPrice = +dpOptionIDArray[3].trim();
                    $("#dpOptionSelectError").hide();

                    $("#dp_option_pr").val(dpOptoinPrice);
                    var sum = 0;
                    $('.hiddeee').each(function() {
                        sum += parseInt($(this).val()) || 0;
                    });
                    basePrice = sum;
                    $('#priceValue').text('');
                    $('#priceValue').text(basePrice);
                    $("#priceValueInput").val(basePrice);
                }
            });
        }

        // update price : Handle Color Select
        //var handleClOpSle =  document.getElementById('handleColorOptionSelect');
        var handleClOpSle =  document.getElementById('handlecolorOptionSelect');
        if (typeof(handleClOpSle) != 'undefined' && handleClOpSle != null) {
            handleClOpSle.addEventListener('change', function () {
                var hanldecolorIDArray = $("#handlecolorOptionSelect option:selected").attr('id').split("-");
                if (hanldecolorIDArray.length > 1) {
                    var handlecolorPrice = parseInt(hanldecolorIDArray[3].trim());

                    $("#handle_clr_pr").val(handlecolorPrice);
                    $('#handlecolorOptionSelectError').hide();

                    var sum = 0;
                    $('.hiddeee').each(function() {
                        sum += parseInt($(this).val()) || 0;
                    });
                    basePrice = sum;
                    $('#priceValue').text('');
                    $('#priceValue').text(basePrice);
                    $("#priceValueInput").val(basePrice);


                }
            });
        }

        // update price : Lock Color option Select
        var lockClOpSle =  document.getElementById('lockcolorOptionSelect');
        if (typeof(lockClOpSle) != 'undefined' && lockClOpSle != null) {
            lockClOpSle.addEventListener('change', function () {
                var lockcolorIDArray = $("#lockcolorOptionSelect option:selected").attr('id').split("-");
                if (lockcolorIDArray.length > 1) {
                    var lockcolorPrice = parseInt(lockcolorIDArray[3].trim());


                    $('#lockcolorOptionSelectError').hide();
                    $('#lock_color_option_pr').val(lockcolorPrice);
                    var sum = 0;
                    $('.hiddeee').each(function() {
                        sum += parseInt($(this).val()) || 0;
                    });
                    basePrice = sum;
                    $('#priceValue').text('');
                    $('#priceValue').text(basePrice);
                    $("#priceValueInput").val(basePrice);
                }
            });
        }

// update price : Sill Color option Select
        var sillClePSle =  document.getElementById('sillcolorOptionSelect');
        if (typeof(sillClePSle) != 'undefined' && sillClePSle != null) {
            sillClePSle.addEventListener('change', function () {
                var silcolorIDArray = $("#sillcolorOptionSelect option:selected").attr('id').split("-");
                if (silcolorIDArray.length > 1) {
                    var silcolorPrice = parseInt(silcolorIDArray[3].trim());

                    $('#sill_clr_pr').val(silcolorPrice);
                    var sum = 0;
                    $('.hiddeee').each(function() {
                        sum += parseInt($(this).val()) || 0;
                    });
                    basePrice = sum;
                    $('#priceValue').text('');
                    $('#priceValue').text(basePrice);
                    $("#priceValueInput").val(basePrice);
                }
            });
        }

        // update price : Hinge Color option Select

        var hingClePSle =  document.getElementById('hingecolorOptionSelect');
        if (typeof(hingClePSle) != 'undefined' && hingClePSle != null) {
            hingClePSle.addEventListener('change', function () {
                var hincolorIDArray = $("#hingecolorOptionSelect option:selected").attr('id').split("-");
                if (hincolorIDArray.length > 1) {
                    var hincolorPrice = parseInt(hincolorIDArray[3].trim());
                    $('#hinge_clr_pr').val(hincolorPrice);
                    $('#hingecolorOptionSelectError').hide();
                    var sum = 0;
                    $('.hiddeee').each(function() {
                        sum += parseInt($(this).val()) || 0;
                    });
                    basePrice = sum;
                    $('#priceValue').text('');
                    $('#priceValue').text(basePrice);
                    $("#priceValueInput").val(basePrice);

                }
            });
        }

        // update price : Screen New option Select
        var scrnClePSle =  document.getElementById('screennewOptionSelect');
        if (typeof(scrnClePSle) != 'undefined' && scrnClePSle != null) {
            scrnClePSle.addEventListener('change', function () {
                var screenIDArray = $("#screennewOptionSelect option:selected").attr('id').split("-");
                if (screenIDArray.length > 1) {
                    var screenPrice = parseInt(screenIDArray[3].trim());
                    $('#screen_option_pr').val(screenPrice);
                    $('#screennewOptionSelectError').hide();

                    var sum = 0;
                    $('.hiddeee').each(function() {
                        sum += parseInt($(this).val()) || 0;
                    });
                    basePrice = sum;
                    $('#priceValue').text('');
                    $('#priceValue').text(basePrice);
                    $("#priceValueInput").val(basePrice);

                }
            });
        }



        var doorClePSle =  document.getElementById('doorHandlingSelect');
        if (typeof(doorClePSle) != 'undefined' && doorClePSle != null) {
            doorClePSle.addEventListener('change', function () {
                var value = doorClePSle.value;
                //alert(value);
                if (value) {
                    $('#doorHandlingSelectError').hide();
                }
            });
        }






        document.getElementById('addItemToCartButton').addEventListener('click', function (event) {

            // $('select').each(function( index ,element) {
            //     alert(  $( this ).val()  + ": " + $( element ).val());
            //     return false;
            //     event.preventDefault();
            //     e.preventDefault();
            // });


            //const dropss = document.getElementsByTagName("select");
            //document.querySelectorAll('select:not(main_drop)')
            document.querySelectorAll('select')
                .forEach((select) => {
                    //span.classList.add('highlight');
                    if(select.value == '' || select.value ==null || select.value ==undefined) {

                        //if (a.indexOf('Error') > -1) {

                        iddddd      = select.id;
                        iddddd_comb =iddddd+'Error';
                        if(iddddd!='main_drop' || iddddd != 'glassblindOptionSelect' || iddddd != 'glassOptionSelect'){
                            $("#"+iddddd_comb).show();
                            return false;
                            event.preventDefault();
                            e.preventDefault();
                        }
                        //document.getElementById(iddddd_comb).style.display = "block";
                        // +'Error';
                        //$(iddddd_comb).show();
                    }
                });







            // sillOptionSelect validation
            doorColorSelectLength  = $( "#doorColorSelect" ).length;
            doorColorSelectLengV   = $( "#doorColorSelect" ).val();
            if ( doorColorSelectLength )   {
                if( !doorColorSelectLengV  || doorColorSelectLengV == '') {
                    $('#doorColorSelectError').show();
                    return false;
                    event.preventDefault();
                    e.preventDefault();
                }
            }

            // DOOR HANDLING HAVE TO MANAGE ITS CONDITION
            if ($( "#doorHandlingSelect" ).length &&  ($('#doorHandlingSelect').val() == '0' || $('#doorHandlingSelect').val() == '' || $('#doorHandlingSelect').val() == 'undefined' || $('#doorHandlingSelect').val() == null) ) {
                $('#doorHandlingSelectError').show();
                return false;
                event.preventDefault();
                e.preventDefault();
            }


            // glassGridliteOption validation
            blindGlassliteOptionSelectLength  = $( "#blindGlassliteOptionSelect" ).length;
            blindGlassliteOptionSelectLengV   = $( "#blindGlassliteOptionSelect" ).val();
            if ( blindGlassliteOptionSelectLength )   {
                if( !blindGlassliteOptionSelectLengV  || blindGlassliteOptionSelectLengV == '') {
                    $("#blindGlassliteOptionSelectError").show();
                    return false;
                    event.preventDefault();
                    e.preventDefault();
                }
            }



            // lite validation
            liteOptionSelectLength    = $( "#liteOptionSelect" ).length;
            liteOptionSelectLengV     = $( "#liteOptionSelect" ).val();

            if ( $( "#lite_ht" ).css('display') != 'none' && liteOptionSelectLength > 1){
                // 'element' is hidden
                //alert('huhh');
                if( !liteOptionSelectLengV  || liteOptionSelectLengV == '') {
                    $("#liteOptionSelectError").show();
                    return false;
                    event.preventDefault();
                    e.preventDefault();
                }
            }



            // dpOptionSelect validation :Needs to check
            /*dpOptionSelectLength    = $( "#dpOptionSelect" ).length;
            dpOptionSelectLengV     = $( "#dpOptionSelect" ).val();
            if ( $( "#dpOptionSelect" ).css('display') != 'none'   && dpOptionSelectLength > 1){
                //alert('adad');
                if( !dpOptionSelectLengV  || dpOptionSelectLengV == '') {
                    $('#dpOptionSelectError').show();
                    return false;
                    event.preventDefault();
                    e.preventDefault();
                }
            }*/


            // glassGrid validation
            glassGridSelectLength    = $( "#glassGridSelect" ).length;
            glassGridSelectLengV     = $( "#glassGridSelect" ).val();
            //if ( glassGridSelectLength >   1 )   {

            if ( $( "#glass_grid_ht" ).css('display') != 'none' ){
                    // 'element' is hidden

                //alert('huhh');
                if( !glassGridSelectLengV  || glassGridSelectLengV == '') {
                    $("#glassGridSelectError").show();
                    return false;
                    event.preventDefault();
                    e.preventDefault();
                }
            }

            // handleTypeSelect validation
            handleTypeSelectLength    = $( "#handleTypeSelect" ).length;
            handleTypeSelectLengV     = $( "#handleTypeSelect" ).val();
            if ( handleTypeSelectLength )   {
                if( !handleTypeSelectLengV  || handleTypeSelectLengV == '') {
                    $("#handleTypeSelectError").show();
                    return false;
                    event.preventDefault();
                    e.preventDefault();
                }
            }

            // lockSetSelect validation
            lockSetSelectLength    = $( "#lockSetSelect" ).length;
            lockSetSelectLengV     = $( "#lockSetSelect" ).val();
            if ( lockSetSelectLength )   {
                if( !lockSetSelectLengV  || lockSetSelectLengV == '') {
                    $("#lockSetSelectError").show();
                    return false;
                    event.preventDefault();
                    e.preventDefault();
                }
            }







             doorHandlingSelectLength    = $( "#doorHandlingSelect" ).length;
             doorHandlingSelectLengV     = $( "#doorHandlingSelect" ).val();
             if ( doorHandlingSelectLength )   {
                 if( !doorHandlingSelectLengV  || doorHandlingSelectLengV == '') {
                     $('#doorHandlingSelectError').show();
                     return false;
                     event.preventDefault();
                     e.preventDefault();
                 }
             }

            // Frame thicknessSelect validation
            frameThicknessOptionSelectLength    = $( "#frameThicknessOptionSelect" ).length;
            frameThicknessOptionSelectLengV     = $( "#frameThicknessOptionSelect" ).val();
            if ( frameThicknessOptionSelectLength )   {
                if( !frameThicknessOptionSelectLengV  || frameThicknessOptionSelectLengV == '') {
                    $('#frameThicknessOptionSelectError').show();
                    return false;
                    event.preventDefault();
                    e.preventDefault();
                }
            }


            // sillOptionSelect validation
            sillOptionSelectLength  = $( "#sillOptionSelect" ).length;
            sillOptionSelectLengV   = $( "#sillOptionSelect" ).val();
            if ( sillOptionSelectLength )   {
                if( !sillOptionSelectLengV  || sillOptionSelectLengV == '') {
                    $('#sillOptionSelectError').show();
                    return false;
                    event.preventDefault();
                    e.preventDefault();
                }
            }

            /*
            // screennewOptionSelect validation
            screennewOptionSelectLength  = $( "#screennewOptionSelect" ).length;
            screennewOptionSelectLengV   = $( "#screennewOptionSelect" ).val();
            if ( screennewOptionSelectLength )   {
                if( !screennewOptionSelectLengV  || screennewOptionSelectLengV == '') {
                    $('#screennewOptionSelectError').show();
                    return false;
                    event.preventDefault();
                    e.preventDefault();
                }
            }
            */

            handlecolorOptionSelectLength  = $( "#handlecolorOptionSelect" ).length;
            handlecolorOptionSelectLengV   = $( "#handlecolorOptionSelect" ).val();
            if ( handlecolorOptionSelectLength )   {
                if( !handlecolorOptionSelectLengV  || handlecolorOptionSelectLengV == '') {
                    $('#handlecolorOptionSelectError').show();
                    return false;
                    event.preventDefault();
                    e.preventDefault();
                }
            }

            lockcolorOptionSelectLength  = $( "#lockcolorOptionSelect" ).length;
            lockcolorOptionSelectLengV   = $( "#lockcolorOptionSelect" ).val();
            if ( lockcolorOptionSelectLength )   {
                if( !lockcolorOptionSelectLengV  || lockcolorOptionSelectLengV == '') {
                    $('#lockcolorOptionSelectError').show();
                    return false;
                    event.preventDefault();
                    e.preventDefault();
                }
            }


            // hinge color validation
            hingecolorOptionSelectLength  = $( "#hingecolorOptionSelect" ).length;
            hingecolorOptionSelectLengtV  = $( "#hingecolorOptionSelect" ).val();
            if ( hingecolorOptionSelectLength )   {
                if( !hingecolorOptionSelectLengtV  || hingecolorOptionSelectLengtV == '') {
                    $('#hingecolorOptionSelectError').show();
                    return false;
                    event.preventDefault();
                    e.preventDefault();
                }
            }



            //event.preventDefault();


            qantu = document.getElementById('quantity');
            qantu_cval = qantu.value;

            if (!Number(qantu.value)) {
                alert('Quantity Must be a Number');
                return false;
                event.preventDefault();
            }

            if (qantu_cval < 1) {
                alert('Quantity Must be greater then 1');
                return false;
                event.preventDefault();
            } else if (qantu_cval > 9999) {
                alert('Quantity Must be less then 9999');
                return false;
                event.preventDefault();
            }else{
                $('#addItemToCartButton p').text('Saving...');
                $('#cartItemForm').submit();
            }
        });

        /*
            var index = 0;
            $('.customOptionPlaceHolder').each(function () {
              var optionName = $(this).attr('id');
              document.getElementById('customOptionSelect-' + optionName).addEventListener('change', function () {
                updatePrice();
              });
              index++;
            });
        */
    }



    // quantity code direct
    //function quntchange(){
    //$('#quantity').change(function () {
    $("#quantity").on("input", function() {
        var finaly;
        //alert('adad'+old_base_price);

        var quantity        = $(this).val();
        var old_base_price  = $('#priceValueInput').val();
        finaly = old_base_price * quantity;

        $('#priceValue').text('');
        $('#priceValue').text(finaly);
    });


    //$('#assemble_knocked_option_select').ready(function () {
    //$('#assemble_knocked_option_select').change(function () {

    //});
    //});




    function updatePrice() {
        var basePrice = 0;
        var glassOptionIDArray;

        //var colorSelectArray = $("#doorColorSelect option:selected").text().split("-");
        var colorSelectArray = $("#doorColorSelect option:selected").text().split("+");

        try {
            if (colorSelectArray.length > 1) {
                var colorPrice = colorSelectArray[1].trim();
                colorPrice = colorPrice.replace("$", "");
                basePrice = +colorPrice;

                $("#vale_till_finish_color").val(basePrice);
            }
        } catch (e) {
            console.log(e);
        }





        // blind  array
        $("#blindOptionSelect").change( function() {
            //alert('sdfsf');
            var blindArray = $("#blindOptionSelect option:selected").text().split("-");
            var blindIDArray = $("#blindOptionSelect option:selected").attr('id').split("-");

            if (blindIDArray.length > 1) {
                var blindIDArray = +blindIDArray[3].trim();

                // vale_till_finish_color
                var vale_till_finish_color = $('#vale_till_finish_color').val();
                vale_till_finish_color = parseInt(vale_till_finish_color);
                var vale_tsh_color = blindIDArray + vale_till_finish_color;
                //alert(vale_tsh_color);
                //alert('condition tro ==> vale_till_finish_color' + vale_till_finish_color + 'blindIDArray==>' + blindIDArray);

                $('#old_base_price').val('');
                $('#old_base_price').val(vale_tsh_color);

                $('#priceValue').text('');
                $('#priceValue').text(vale_tsh_color);
                //}else{
                basePrice = basePrice+vale_tsh_color;
                //}
            }
        });





        // glass grid array
        try {
            var glassGridArray    = $("#glassGridSelect option:selected").text().split("-");
            var glassGridIDArray  = $("#glassGridSelect option:selected").attr('id').split("-");

            if (glassGridIDArray.length > 1) {
                var glassGridPrice = +glassGridIDArray[3].trim();
                basePrice = basePrice + glassGridPrice;
                $('#glass_grid_lite_option').val(glassGridPrice);
            }
        } catch (e) {
            console.log(e);
        }


        try {
            var liteOptionArray    = $("#liteOptionSelect option:selected").text().split("-");
            var liteOptionIDArray  = $("#liteOptionSelect option:selected").attr('id').split("-");

            if (liteOptionIDArray.length > 1) {
                var litePrice = +liteOptionIDArray[3].trim();
                basePrice = basePrice + litePrice;
            }
        } catch (e) {
            console.log(e);
        }


        // dp option
        /*
        try {
          var dpOptArray        = $("#dpOptionSelect option:selected").text().split("-");
          var dpOptIDArray      = $("#dpOptionSelect option:selected").attr('id').split("-");

          if (dpOptIDArray.length > 1) {
            var dpOptPrice = +dpOptIDArray[3].trim();
            basePrice = basePrice + dpOptPrice;
          }
        } catch (e) {
          console.log(e);
        }*/










        // glass option price update
        /*try {
          var glassOptiIDArray = $("#glassOptionSelect option:selected").attr('id').split("-");
          //alert(glassOptionIDArray.length );
          if (glassOptiIDArray.length > 1) {
            var glassoptionPrice = parseInt(glassOptionIDArray[3].trim());
            basePrice = basePrice + glassoptionPrice;

            $('#priceValue').text(basePrice);
            //var frameThicknessPrice = parseInt(frameThicknessIDArray[3].trim());
            //basePrice = basePrice + frameThicknessPrice;
          }
        } catch (e) {
          console.log(e);
        }*/





        // for sill option
        try {
            var sillOptionSelectIDArray = $("#sillOptionSelect option:selected").attr('id').split("-");

            if (sillOptionSelectIDArray.length > 1) {
                var sillPrice = +sillOptionSelectIDArray[3].trim();
                basePrice = basePrice + sillPrice;
            }
        } catch (e) {
            //console.log(e);
        }


        // for mull kit option
        try {
            var mullkitOptionIDArray = $("#mullkitOptionSelect option:selected").attr('id').split("-");

        } catch (e) {
            console.log(e);
        }




        // dp opt array
        try {
            var DPArray    = $("#dpOptionSelect option:selected").text().split("-");
            var dpOptionIDArray  = $("#dpOptionSelect option:selected").attr('id').split("-");

            if (dpOptionIDArray.length > 1) {
                var dpOptoinPrice = +dpOptionIDArray[3].trim();
                //basePrice = basePrice + glassGridPrice;
                basePrice = basePrice + dpOptoinPrice;

            }
        } catch (e) {
            console.log(e);
        }


        // Handle Color price update
        try {
            var hanldecolorIDArray = $("#handlecolorOptionSelect option:selected").attr('id').split("-");
            if (hanldecolorIDArray.length > 1) {
                var handlecolorPrice = parseInt(hardwareIDArray[3].trim());


                basePrice = basePrice + handlecolorPrice;
                $('#priceValue').text(basePrice);
            }
        } catch (e) {
            //console.log('asdadadadda');
        }


        // Sill Color price update
        try {
            var silcolorIDArray = $("#sillcolorOptionSelect option:selected").attr('id').split("-");
            if (silcolorIDArray.length > 1) {
                var silcolorPrice = parseInt(silcolorIDArray[3].trim());
                basePrice = basePrice + silcolorPrice;
                $('#priceValue').text(basePrice);
            }
        } catch (e) {
            //console.log('asdadadadda');
        }

        // Hinge Color price update
        try {
            var hincolorIDArray = $("#hingecolorOptionSelect option:selected").attr('id').split("-");
            if (hincolorIDArray.length > 1) {
                var hincolorPrice = parseInt(hincolorIDArray[3].trim());
                basePrice = basePrice + hincolorPrice;
                $('#priceValue').text('');
                $('#priceValue').text(basePrice);

                $('#old_base_price').val('');
                $('#old_base_price').val(basePrice);

            }
        } catch (e) {
            //console.log('asdadadadda');
        }

        try {
            var lockcolorIDArray = $("#lockcolorOptionSelect option:selected").attr('id').split("-");
            if (lockcolorIDArray.length > 1) {
                var lockcolorPrice = parseInt(lockcolorIDArray[3].trim());
                basePrice = basePrice + lockcolorPrice;
                $('#priceValue').text(basePrice);

                $('#old_base_price').val('');
                $('#old_base_price').val(basePrice);
            }
        } catch (e) {
            //console.log('asdadadadda');
        }

// for the screen option array
        try {
            var screenIDArray = $("#screennewOptionSelect option:selected").attr('id').split("-");
            if (screenIDArray.length > 1) {
                var screenPrice = parseInt(screenIDArray[3].trim());
                basePrice = basePrice + screenPrice;
                $('#priceValue').text(basePrice);

                $('#old_base_price').val('');
                $('#old_base_price').val(basePrice);

            }
        } catch (e) {
            //console.log('asdadadadda');
        }




        // Hardware Color price update
        // try {
        //
        //   var hardwarecolorIDArray = $("#hardwareColorOptionSelect option:selected").attr('id').split("-");
        //
        //   //var  frameThicknessIDArray = sdfsf.split("-");
        //
        //   console.log(hardwarecolorIDArray[3]);
        //   console.log(hardwarecolorIDArray.length);
        //   if (hardwarecolorIDArray.length > 1) {
        //     //var frameThicknessPrice = +frameThicknessIDArray[3].trim();
        //     var hardwarecolorPrice = parseInt(hardwareIDArray[3].trim());
        //     basePrice = basePrice + hardwarecolorPrice;
        //     $('#priceValue').text(basePrice);
        //   }
        // } catch (e) {
        //   console.log('asdadadadda');
        // }




        // custom optpn
        try {
            var index = 0;
            $('.customOptionPlaceHolder').each(function () {
                var optionName = $(this).attr('id');
                var customIdArray = $('#customOptionSelect-' + optionName + ' option:selected').attr('id').split("-");

                if (customIdArray.length > 1) {
                    var customPrice = +customIdArray[3].trim();
                    basePrice = basePrice + customPrice;
                }

                index++;
            });
        } catch (e) {
            console.log(e);
        }


        /*  try {
            $('#quantity').change(function () {
              let quantity = $(this).val();
              //old_quantity.val(quantity);

              basePrice = basePrice * quantity;

              $('#priceValue').text('');
              $('#priceValue').text(basePrice);
              $("#quantity").attr("readonly", true);

            });
          } catch (e) {console.log(e)} */



        $('#priceValue').text('');
        $('#priceValue').text(basePrice);

        $('#old_base_price').val('');
        $('#old_base_price').val(basePrice);
    }

    function setupSelectBoxes() {
        $('#assemble_knocked_option_select,#glassblindOptionSelect,#doorHandlingSelect,#blindGlassliteOptionSelect').removeAttr('disabled');
        $('#doorHandlingSelect2').removeAttr('disabled');

        var measurementId                         = $('#doorSizeSelect').val();
        var handleTypeForSpecificSizeCount        = 0;
        var lockSetOptionForSpecificSizeCount     = 0;
        var glassDepthOptionForSpecificSizeCount  = 0;
        var glassOptionForSpecificSizeCount       = 0;
        var frameThicknessForSpecificSizeCount    = 0;
        var blindOptionForSpecificSizeCount       = 0;
        var liteOptionForSpecificSizeCount        = 0;
        var dpOptionForSpecificSizeCount          = 0;

        var sillOptionForSpecificSizeCount        = 0;
        var screennewOptionForSpecificSizeCount   = 0;
        var mullKitForSpecificSizeCount           = 0;

        var hardwareColorForSizeCount             = 0;
        var lockColorForSizeCount                 = 0;
        var sillcolorOptionForSpecificSizeCount   = 0;
        var hingecolorOptionForSpecificSizeCount  = 0;

        var handleColorForSizeCount               = 0;


        $('#blindGlassliteOptionSelect,#handlecolorOptionSelect,#lockcolorOptionSelect,#sillcolorOptionSelect').removeAttr('disabled');


        $('.noOptionForSize').remove();
        var index = 0;
        $('.customOptionPlaceHolder').each(function () {
            var optionName = $(this).attr('id');
            var optionId = optionName.split("-")[0];
            console.log("OPTIONANME: " + optionName);
            $('#customOptionSelect-' + optionName).empty();
            $('#customOptionSelect-' + optionName).append('<option value="">Please select ' + $('#customOptionNamePlaceHolder-' + index).val() + ' ...</option>');
            var customOptionCount = 0;
            $('.customOption option').each(function () {
                try {
                    var thisOptionId = $(this).attr('id').split('-');

                    if (thisOptionId[2] == measurementId && thisOptionId[1] == optionId) {
                        $('#customOptionSelect-' + optionName).append($(this).clone());
                        customOptionCount++;
                    }
                } catch (e) {
                    console.log(e);
                }
            });
            $('#customOptionSelect-' + optionName).removeAttr('disabled');

            if (customOptionCount == 0) {
                $('#customOptionSelect-' + optionName).remove();
                $('#customOptionSelect-' + optionName).append("<p class='bold noOptionForSize'>No " + optionName + " options for this size.</p>");
            }

            index++;
        });

        $('#doorColorSelect').empty();
        $('#doorColorSelect').append('<option value="">Select a color option...</option>');
        $('.colorOption').each(function () {
            var idArray = $(this).attr('id').split("-");

            if (idArray[1] == measurementId) {
                $('#doorColorSelect').append($(this).clone());
            }
        });
        $('#doorColorSelect').removeAttr('disabled');

        // ****************************************
        // HANDLE TYPE SELECT DYNAMIC UPDATES
        // ****************************************

        if ($('#handleTypeSelect').length == 0) {
            $('#handleTypeSelectPlaceholder').append(this.handleTypeSelectHTML);
        }

        $('#handleTypeSelect').empty();
        $('#handleTypeSelect').append('<option value="">Please select a handle...</option>');
        $('.HANDLE_TYPE_OPTION').each(function () {
            var idArray = $(this).attr('id').split("-");

            if (idArray[2] == measurementId) {
                handleTypeForSpecificSizeCount++;
                $('#handleTypeSelect').append($(this).clone());
            }
        });
        $('#handleTypeSelect').removeAttr('disabled');

        if (handleTypeForSpecificSizeCount == 0) {
            $('#handleTypeSelect').remove();
            $('#handleTypeSelectPlaceholder').append("<p class='bold noOptionForSize'>No handle type options for this size.</p>");
        }


        // ****************************************
        // HANDLE TYPE SELECT2 DYNAMIC UPDATES
        // ****************************************
        /*
          if ($('#handleTypeSelect2').length == 0) {
            $('#handleTypeSelectPlaceholder2').append(this.handleTypeSelectHTML2);
          }

          $('#handleTypeSelect2').empty();
          $('#handleTypeSelect2').append('<option value="">Please select a handle 2...</option>');
          $('.HANDLE_TYPE_OPTION2').each(function () {
            var idArray = $(this).attr('id').split("-");

            if (idArray[2] == measurementId) {
              handleTypeForSpecificSizeCount++;
              $('#handleTypeSelect').append($(this).clone());
            }
          });
          $('#handleTypeSelect').removeAttr('disabled');

          if (handleTypeForSpecificSizeCount == 0) {
            $('#handleTypeSelect').remove();
            $('#handleTypeSelectPlaceholder').append("<p class='bold noOptionForSize'>No handle type options for this size.</p>");
          }*/



        // ****************************************
        // LOCK SET SELECT DYNAMIC UPDATES
        // ****************************************


        if ($('#lockSetSelect').length == 0) {
            $('#lockSetSelectPlaceholder').append(this.lockSetSelectHTML);
        }

        $('#lockSetSelect').empty();
        $('#lockSetSelect').append('<option value="">Please select a lock...</option>');
        $('.LOCK_SET_OPTION').each(function () {
            var idArray = $(this).attr('id').split("-");

            if (idArray[2] == measurementId) {
                $('#lockSetSelect').append($(this).clone());
                lockSetOptionForSpecificSizeCount++;
            }
        });
        $('#lockSetSelect').removeAttr('disabled');

        if (lockSetOptionForSpecificSizeCount == 0) {
            $('#lockSetSelect').remove();
            $('#lockSetSelectPlaceholder').append("<p class='bold noOptionForSize'>No lock set options for this size.</p>");
        } // ****************************************
        // GLASS DEPTH SELECT DYNAMIC UPDATES
        // ****************************************


        if ($('#glassDepthSelect').length == 0) {
            $('#glassDepthSelectPlaceholder').append(this.glassDepthSelectHTML);
        }

        $('#glassDepthSelect').empty();
        $('#glassDepthSelect').append('<option value="">Please select a glass depth...</option>');
        $('.GLASS_DEPTH_OPTION').each(function () {
            var idArray = $(this).attr('id').split("-");

            if (idArray[2] == measurementId) {
                glassDepthOptionForSpecificSizeCount++;
                $('#glassDepthSelect').append($(this).clone());
            }
        });
        $('#glassDepthSelect').removeAttr('disabled');

        if (glassDepthOptionForSpecificSizeCount == 0) {
            $('#glassDepthSelect').remove();
            $('#glassDepthSelectPlaceholder').append("<p class='bold noOptionForSize'>No glass depth options for this size.</p>");
        } // ****************************************
        // GLASS GRID SELECT DYNAMIC UPDATES
        // ****************************************


        $('#glassGridSelect').empty();
        $('#glassGridSelect').append('<option value="">Please select a grid option...</option>');
        $('.GLASS_GRID').each(function () {
            var idArray = $(this).attr('id').split("-");

            if (idArray[2] == measurementId) {
                $('#glassGridSelect').append($(this).clone());
            }
        });
        $('#glassGridSelect').removeAttr('disabled');

        // ****************************************
        // GLASS OPTION SELECT DYNAMIC UPDATES
        // ****************************************

        if ($('#glassOptionSelect').length == 0) {
            $('#glassOptionSelectPlaceholder').append(this.glassOptionSelectHTML);
        }

        $('#glassOptionSelect').empty();
        $('#glassOptionSelect').append('<option value="">Please select a glass option...</option>');
        $('.GLASS_OPTION').each(function () {
            var idArray = $(this).attr('id').split("-");

            if (idArray[2] == measurementId) {
                glassOptionForSpecificSizeCount++;
                $('#glassOptionSelect').append($(this).clone());
            }
        });
        $('#glassOptionSelect').removeAttr('disabled');

        if (glassOptionForSpecificSizeCount == 0) {
            $('#glassOptionSelect').remove();
            $('#glassOptionSelectPlaceholder').append("<p class='bold noOptionForSize'>No glass options available.</p>");
        }


        // ****************************************
        // FRAME THICKNESS SELECT DYNAMIC UPDATES
        // ****************************************

        if ($('#frameThicknessOptionSelect').length == 0) {
            $('#frameThicknessOptionSelectPlaceholder').append(this.frameThicknessOptionSelectHTML);
        }

        $('#frameThicknessOptionSelect').empty();
        $('#frameThicknessOptionSelect').append('<option value="">Please select a frame thickness option...</option>');
        $('.FRAME_THICKNESS_OPTION').each(function () {
            var idArray = $(this).attr('id').split("-");

            if (idArray[2] == measurementId) {
                frameThicknessForSpecificSizeCount++;
                $('#frameThicknessOptionSelect').append($(this).clone());
            }
        });
        $('#frameThicknessOptionSelect').removeAttr('disabled');

        if (frameThicknessForSpecificSizeCount  == 0) {
            $('#frameThicknessOptionSelect').remove();
            $('#frameThicknessOptionSelectPlaceholder').append("<p class='bold noOptionForSize'>No thickness options for this size.</p>");
            $('#frameThicknessOptionSelectPlaceholder').parent().hide();
        }



        // ****************************************
        // BLIND OPTION SELECT DYNAMIC UPDATES
        // ****************************************
        if ($('#blindOptionSelect').length == 0) {
            $('#blindOptionSelectHTMLPlaceholder').append(this.blindOptionSelectHTML);
        }
        $('#blindOptionSelect').empty();
        $('#blindOptionSelect').append('<option value="">Please select a Blind option...</option>');
        $('.BLIND_OPTION').each(function () {
            var idArray = $(this).attr('id').split("-");

            if (idArray[2] == measurementId) {
                blindOptionForSpecificSizeCount++;
                $('#blindOptionSelect').append($(this).clone());
            }
        });
        $('#blindOptionSelect').removeAttr('disabled');

        if (blindOptionForSpecificSizeCount  == 0) {
            $('#blindOptionSelect').remove();
            $('#blindOptionSelectPlaceholder').append("<p class='bold noOptionForSize'>No Blind options available.</p>");
        }

// ****************************************
        // LITE OPTION SELECT DYNAMIC UPDATES
        // ****************************************

        if ($('#liteOptionSelect').length == 0) {
            $('#liteOptionSelectPlaceholder').append(this.liteOptionSelectHTML);
        }

        $('#liteOptionSelect').empty();
        $('#liteOptionSelect').append('<option value="">Please select a Lite option...</option>');
        $('.LITE_OPTION').each(function () {
            var idArray = $(this).attr('id').split("-");

            if (idArray[2] == measurementId) {

                liteOptionForSpecificSizeCount++;
                $('#liteOptionSelect').append($(this).clone());
            }
        });
        $('#liteOptionSelect').removeAttr('disabled');

        if (liteOptionForSpecificSizeCount  == 0) {
            $('#liteOptionSelect').remove();
            $('#liteOptionSelectPlaceholder').append("<p class='bold noOptionForSize'>No Lite Options available.</p>");
            $('#liteOptionSelectPlaceholder').parent().hide();
        }

        // ****************************************
        // DP OPTION SELECT DYNAMIC UPDATES
        // ****************************************

        if ($('#dpOptionSelect').length == 0) {
            $('#dpOptionSelectPlaceholder').append(this.dpOptionSelectHTML);
        }

        $('#dpOptionSelect').empty();
        $('#dpOptionSelect').append('<option value="">Please select a DP option...</option>');
        $('.DP_OPTION').each(function () {
            var idArray = $(this).attr('id').split("-");

            if (idArray[2] == measurementId) {

                dpOptionForSpecificSizeCount++;
                $('#dpOptionSelect').append($(this).clone());
            }
        });
        $('#dpOptionSelect').removeAttr('disabled');

        if (dpOptionForSpecificSizeCount  == 0) {
            $('#dpOptionSelect').remove();
            $('#dpOptionSelectPlaceholder').append("<p class='bold noOptionForSize'>No DP Options available.</p>");
            $('#dpOptionSelectPlaceholder').parent().hide();
        }



        // ****************************************
        // HARDWARE COLOR DYNAMIC UPDATES
        // ****************************************

        if ($('#hardwareColorOptionSelect').length == 0) {
            $('#hardwareColorOptionSelectPlaceholder').append(this.hardwareColorOptionSelectHTML);
        }

        $('#hardwareColorOptionSelect').empty();

        $('#hardwareColorOptionSelect').append('<option value="">Please select a Hardware Color option...</option>');
        $('.HARDWARE_COLOR_OPTION').each(function () {
            var idArray = $(this).attr('id').split("-");

            if (idArray[2] == measurementId) {
                hardwareColorForSizeCount++;
                $('#hardwareColorOptionSelect').append($(this).clone());
            }
        });
        $('#hardwareColorOptionSelect').removeAttr('disabled');

        if (hardwareColorForSizeCount  == 0) {
            $('#hardwareColorOptionSelect').remove();
            $('#hardwareColorOptionSelectPlaceholder').append("<p class='bold noOptionForSize'>No hardware color options for this size.</p>");
        }





        // ****************************************
        // MULL KIT SELECT DYNAMIC UPDATES
        // ****************************************

        if ($('#mullkitOptionSelect').length == 0) {
            $('#mullkitOptionSelectPlaceholder').append(this.mullkitOptionSelectHTML);
        }

        $('#mullkitOptionSelect').empty();
        $('#mullkitOptionSelect').append('<option value="">Please select a Mull kit option...</option>');
        $('.MULL_KIT').each(function () {
            var idArray = $(this).attr('id').split("-");

            if (idArray[2] == measurementId) {
                mullKitForSpecificSizeCount++;
                $('#mullkitOptionSelect').append($(this).clone());
            }
        });
        $('#mullkitOptionSelect').removeAttr('disabled');

        if (mullKitForSpecificSizeCount == 0) {
            $('#mullkitOptionSelect').remove();
            $('#mullkitOptionSelectPlaceholder').append("<p class='bold noOptionForSize'>No Mull kit options available.</p>");
        }




        // ****************************************
        // SILL OPTION SELECT DYNAMIC UPDATES
        // ****************************************

        if ($('#sillOptionSelect').length == 0) {
            $('#sillOptionSelectPlaceholder').append(this.sillOptionSelectHTML);
        }

        $('#sillOptionSelect').empty();
        $('#sillOptionSelect').append('<option value="">Please select a Sill  option...</option>');
        $('.SILL_OPTION').each(function () {
            var idArray = $(this).attr('id').split("-");

            if (idArray[2] == measurementId) {
                sillOptionForSpecificSizeCount++;
                $('#sillOptionSelect').append($(this).clone());
            }
        });
        $('#sillOptionSelect').removeAttr('disabled');

        if (sillOptionForSpecificSizeCount  == 0) {
            $('#sillOptionSelect').remove();
            $('#sillOptionSelectPlaceholder').append("<p class='bold noOptionForSize'>No Sill options for this size.</p>");
            //$('#sillyopp').hide();
            $(this).parents().fadeOut();

        }



        // ****************************************
        // SCREEN OPTION SELECT DYNAMIC UPDATES
        // ****************************************

        if ($('#screennewOptionSelect').length == 0) {
            $('#screennewOptionSelect').append(this.screennewOptionSelectHTML);
        }

        $('#screennewOptionSelect').empty();
        $('#screennewOptionSelect').append('<option value="">Please select a Screen  option...</option>');
        $('.SCREEN_OPTION').each(function () {
            var idArray = $(this).attr('id').split("-");

            if (idArray[2] == measurementId) {
                screennewOptionForSpecificSizeCount++;
                $('#screennewOptionSelect').append($(this).clone());
            }
        });
        $('#screennewOptionSelect').removeAttr('disabled');

        if (screennewOptionForSpecificSizeCount  == 0) {
            $('#screennewOptionSelect').remove();
            $('#screennewOptionSelectPlaceholder').append("<p class='bold noOptionForSize'>No screen options available.</p>");
        }




        // ****************************************
        // HINGE COLOR OPTION SELECT DYNAMIC UPDATES
        // ****************************************

        if ($('#hingecolorOptionSelect').length == 0) {
            $('#hingecolorOptionSelectPlaceholder').append(this.hingecolorOptionSelectHTML);
        }

        $('#hingecolorOptionSelect').empty();
        $('#hingecolorOptionSelect').append('<option value="">Please select a Hinge color option...</option>');
        $('.HINGE_COLOR_OPTION').each(function () {
            var idArray = $(this).attr('id').split("-");

            if (idArray[2] == measurementId) {
                hingecolorOptionForSpecificSizeCount++;
                $('#hingecolorOptionSelect').append($(this).clone());
            }
        });
        $('#hingecolorOptionSelect').removeAttr('disabled');

        if (hingecolorOptionForSpecificSizeCount  == 0) {
            $('#hingecolorOptionSelect').remove();
            $('#hingecolorOptionSelectPlaceholder').append("<p class='bold noOptionForSize'>No Hinge Color options available.</p>");
        }



        // ****************************************
        // SILL COLOR OPTION SELECT DYNAMIC UPDATES
        // ****************************************

        if ($('#sillcolorOptionSelect').length == 0) {
            $('#sillcolorOptionSelectPlaceholder').append(this.sillcolorOptionSelectHTML);
        }

        $('#sillcolorOptionSelect').empty();
        $('#sillcolorOptionSelect').append('<option value="">Please select a SILL color option...</option>');
        $('.SILL_COLOR_OPTION').each(function () {
            var idArray = $(this).attr('id').split("-");

            if (idArray[2] == measurementId) {
                sillcolorOptionForSpecificSizeCount++;
                $('#sillcolorOptionSelect').append($(this).clone());
            }
        });
        $('#sillcolorOptionSelect').removeAttr('disabled');

        if (sillcolorOptionForSpecificSizeCount  == 0) {
            $('#sillcolorOptionSelect').remove();
            $('#sillcolorOptionSelectPlaceholder').append("<p class='bold noOptionForSize'>No Sill Color options available.</p>");
            $('#sillcolorOptionSelectPlaceholder').parent().hide();
        }


        // ****************************************
        // Lock Color DYNAMIC UPDATES
        // ****************************************

        if ($('#lockcolorOptionSelect').length == 0) {
            $('#lockcolorOptionSelectPlaceholder').append(this.lockcolorOptionSelectHTML);
        }

        $('#lockcolorOptionSelect').empty();

        $('#lockcolorOptionSelect').append('<option value="">Please select a Lock Color option...</option>');
        //alert(lockColorForSizeCount);
        $('.LOCK_COLOR_OPTION').each(function () {
            var idArray = $(this).attr('id').split("-");

            if (idArray[2] == measurementId) {
                lockColorForSizeCount++;
                $('#lockcolorOptionSelect').append($(this).clone());
            }
        });
        //$('#lockcolorOptionSelect').removeAttr('disabled');

        if (lockColorForSizeCount  == 0) {
            //alert('adadad');
            $('#lockcolorOptionSelect').remove();
            //$('#lockColorOptionSelectPlaceholder').append("<p class='bold noOptionForSize'>No Lock color options available.</p>");
            $('#lockcolorOptionSelectPlaceholder').append("<p class='bold noOptionForSize'>No Lock color options available.</p>");
            //$('#lockcolorOptionSelectPlaceholder').parent().hide();
        }

        // ****************************************
        // Handle Color DYNAMIC UPDATES
        // ****************************************

        if ($('#handlecolorOptionSelect').length == 0) {
            $('#handlecolorOptionSelectPlaceholder').append(this.handlecolorOptionSelectPlaceholder);
        }

        $('#handlecolorOptionSelect').empty();

        $('#handlecolorOptionSelect').append('<option value="">Please select a Handle Color option...</option>');
        $('.HANDLE_COLOR_OPTION').each(function () {
            var idArray = $(this).attr('id').split("-");

            if (idArray[2] == measurementId) {
                handleColorForSizeCount++;
                $('#handlecolorOptionSelect').append($(this).clone());
            }
        });
        $('#handlecolorOptionSelect').removeAttr('disabled');

        if (handleColorForSizeCount  == 0) {
            $('#handlecolorOptionSelect').remove();
            $('#handlecolorOptionSelectPlaceholder').append("<p class='bold noOptionForSize'>No Handle color options available.</p>");
            //$('#handlecolorOptionSelectPlaceholder').parent().hide();
        }



    }

    function setupOptionSpecificationsSelectBox() {
        var optValues = [];
        $('.OPT_SPEC').each(function () {
            // m-{{$addOn->group_name}}-{{$addOn->door_measurement_id}}-{{$addOn->price}}
            optValues.push($(this).text());
        });

        if (optValues.length > 0) {
            $('#optSpecLabel').append('<label>Special Option</label>');
            $('#optSpecSelect').append('<select name="opt_select" id="optSelect"></select>');

            for (var index = 0; index < optValues.length; index++) {
                $('#optSelect').append('<option value="' + optValues[index] + '">' + optValues[index] + '</option>');
            }
        }
    }

    /******/ })()
;