<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order')  }} {{$door->doorType->door_type_pretty_name}}
        </h2>
    </x-slot>
    <style>
        .ErrorRed{
            color: red;
            font-weight: bold;
        }
    </style>
    <div class="container  mt-4" style="min-width: 900px;">
        <h4 class="fw-bold">{{$door->name??''}} </h4>
        <br>

        <form action="/sc/addDoor/{{$door->id}}/{{$shoppingCart->id ?? 0}}" method="POST"
              id="cartItemForm">
            @csrf
            <input type="hidden" id="productId" name="product_id" value="{{$door->id}}">
            <input type="hidden" id="shoppingCartId" name="shopping_cart_id" value="{{$shoppingCart->id ?? ''}}">
            <input type="hidden" name="door_name_type_id_selection" id="doorNameTypeIdSelection"
                   value="{{old('door_name_type_id_selection')}}">

            <div class="" style="position: fixed; top: 120px; right: 50px; font-weight: bold; z-index: 93822992;
            border: 1px solid lightgray; background-color: lightblue; border-radius: 3px; padding: 2px;">
                Current Item Price: $ <span id="priceValue">0.00</span>
            </div>

            {{--            DOOR NAMES/IMAGES--}}

            <div class="row flex align-content-center justify-center">
                @foreach($door->doorNames as $n)
                    <div class="col-3 doorNameClass" style="border: 2px solid black; cursor: pointer;text-align: center"
                         id="doornameid-{{$n->id}}-{{$n->door_name_or_type}}">
                        <img src="/storage/product_image/{{$n->image->image_path}}"
                             style="max-width: 255px ">
                        {{$n->door_name_or_type}}
{{--                        <p style="text-align: center" class="fw-bolder" >{{$n->door_name_or_type}}</p>--}}
                    </div>
                @endforeach
            </div>
            <br>
            <h4 class="fw-bold">Configure your product </h4>


            {{-- --}}

            @if($errors->has('door_name_type_id_selection'))
                <div class="row flex m-3">
                    <span class="" role="alert" style="color: red">
                        <strong>Please select a door type.</strong>
                    </span>
                </div>
            @endif

            {{--            ERRORS--}}

            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="row flex m-3">
                        <span class="" role="alert" style="color: red">
                             <strong>{{$error}}</strong>
                        </span>
                    </div>
                @endforeach
            @endif

            {{--            DOOR SIZE--}}

            <div class="row flex m-3">
                <div class="col-3" style="text-align: center" id="optSpecLabel">
                </div>
                <div class="col-4" id="optSpecSelect">
                </div>
            </div>

            <div class="row flex m-3">
                <div class="col-3" style="text-align: left">
                    Door Size
                </div>
                <div class="col-4">
                    <select name="door_size_select" id="doorSizeSelect" size="1"
                            style="width: 400px" disabled required>
                        <option value="">Select a size...</option>

                        @foreach($door_measurements as $m)
                            <option value="{{$m->id}}">{{$m->width}} x {{$m->height}}</option>
                        @endforeach
{{--                        @foreach($door->doorMeasurements as $m)--}}
{{--                            <option value="{{$m->id}}">{{$m->width}} x {{$m->height}}</option>--}}
{{--                        @endforeach--}}
                    </select>
                    <input type="hidden" id="door_size_sel_pr" value="">

                    <input type="hidden" id="oldSize" value="{{old('door_size_select')}}">

                    <div id="doorSizeSelectError" class="ErrorRed" style="display: none;">Door Size is required</div>
                </div>
            </div>


            {{-- FINISH COLOR --}}
            <div class="row flex m-3">
                <div class="col-3" style="text-align: left">
                    Finish Color
                </div>
                <div class="col-4">
                    <select name="door_color_select" id="doorColorSelect" size="1"
                            style="width: 400px" disabled>
                        <option value="">Select a color option...</option>
                    </select>
                    <input type="hidden" id="oldColor" value="{{old('door_color_select')}}">
                    <input type="hidden" id="panelCount" value="{{$door->panel_count??1}}">
                    <input type="hidden" id="finish_color_pr" class="hiddeee" name="finish_color_pr" value="">
                    <div id="doorColorSelectError" class="ErrorRed" style="display: none;">Door Color is required</div>

                </div>
            </div>



            @if(isset($door->category))
                @php //echo $door->category->category_name;die;
                //older ones //$door_ids        = [1001,1002,1003,1004,1005,1006, 1007,1008, 1017, 1018, 1009,1010,1011,1012,1013,1014,1015,1016, 1029,1031,1030];
                $door_ids        = [1001,1002,1003,1004,1005,1006, 1007,1008, 1017, 1018,
                                    1010,1011,1013,1014,1015,1016, 1029,1031,1030];
                if (in_array($door_id, $door_ids)){

                   if (count($doorHandlings1) > 0){
                @endphp
                    {{--  @if(!str_contains($door->category->category_name, "Gliding"))--}}
                        {{--            DOOR HANDLING--}}
                        <div class="row flex m-3">
                            <div class="col-3" style="text-align: left">
                                Door Handling
                            </div>
                            <div class="col-4">
                                <select name="door_handling_select" id="doorHandlingSelect" size="1"
                                        style="width: 400px" disabled="disabled">
                                    <option value="">Select a handling option...</option>
                                        {{-- @foreach($door->doorHandlings as $dh)--}}
                                    @foreach($doorHandlings1 as $dh)
                                        <option value="{{$dh->id}}">{{$dh->handling}}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" id="oldHandling" value="{{old('door_handling_select')}}">
                                <input type="hidden" class="hiddeee" id="door_hanlding_pr" name="door_hanlding_pr" value="">
                                <div id="doorHandlingSelectError" class="ErrorRed" style="display: none;">Door Handling is required</div>
                            </div>
                        </div>
                    @php
                        } }
                    @endphp

{{--                    @endif--}}
                @endif

                {{-- DP_OPTION --}}
                <div class="row flex m-3" id="dp_main_di">
                    <div class="col-3" style="text-align: left">
                        DP Option
                    </div>
                    <div class="col-4" id="dpOptionSelectPlaceholder">
                        <select name="dp_option_select" id="dpOptionSelect"
                                style="width: 400px"  disabled>
                            <option value="-1">Please select a DP Option...</option>
                        </select>
                        <input type="hidden" id="olddpOptionSelect" value="{{old('dp_option_select')}}">
                        <input type="hidden" class="hiddeee" id="dp_option_pr" name="dp_option_pr" value="">
{{--                        <div id="dpOptionSelectError" class="ErrorRed" style="display: none;">DP Option is required</div>--}}
                    </div>
                </div>

                {{-- GLASS  / BLIND OPTION--}}

                <div class="row flex m-3">
                    <div class="col-3" style="text-align: left">
                        Glass Option / Blind Option
                    </div>
                    <div class="col-4" id="">
                        <select name="" id="glassblindOptionSelect"
                                style="width: 400px"  disabled="disabled">
                            <option value="">Please Select an option</option>
                            <option value="glassselected">Glass Option</option>
                            <option value="blindselected">Blind Option</option>
                        </select>
{{--                        <div id="glassblindOptionSelectError" class="ErrorRed" style="display: none;">Glass Option / Blind is required</div>--}}
                    </div>

                </div>


                <script type="text/javascript">
                    $('#glassblindOptionSelect').change(function(){


                        if($(this).val() == 'blindselected'){
                            $("#glassGridSelect").val('');
                            $("#glass_grid_pr").val(0);

                            $("#liteOptionSelect").val('');
                            $("#lite_option_pr").val(0);


                            $('#blind_ht').show();
                            $('#lite_gird_combo').hide();
                            $('#glass_ht,#glass_grid_ht,#lite_ht,#glass_opt').hide();




                            //hide the other tions to
                        }
                        if($(this).val() == 'glassselected'){


                            //$("#blindGlassliteOptionSelect").val("");
                            //$('#blindGlassliteOptionSelect').prop('selectedIndex',0);

                            $('#glassOptionSelect').prop('selectedIndex',0);
                            $("#glassOptionSelect").val("");

                            //$('#glassOptionSelect,#blindGlassliteOptionSelect,#glassGridSelect').val("");

                            //$("#liteOptionSelect").val('');
                            //$("#lite_option_pr").val(0);


                            //$('#liteOptionSelectPlaceholder').hide();
                            $('#liteOptionSelectPlaceholder').show();
                            $('#glassGridSelectPlaceholder').show();

                            $('#glassOptionSelectPlaceholder').show();



                            // glass_grid_ht
                            $('#glass_grid_ht').show();
                            $('#glass_ht,#lite_ht,#glass_opt').show();
                            $('#blind_ht').hide();
                            $('#lite_gird_combo').show();
                        }


                    });
                </script>


                {{-- GLASS OPTION--}}
                <input type="hidden" id="old_glass_option_price" value="" name="old_glass_option_price">
                <div class="row flex m-3" id="glass_opt" >
                    <div class="col-3" style="text-align: left">
                        Glass Option
                    </div>
                    <div class="col-4" id="glassOptionSelectPlaceholder">
                        <select name="glass_option_select" id="glassOptionSelect" size="1"
                                style="width: 400px" disabled>
                            <option value="">Please select a glass option...</option>
                        </select>
                        <input type="hidden" id="oldGlassOption" value="{{old('glass_option_select')}}">
                        <input type="hidden" class="hiddeee" id="glass_option_pr"  name="glass_option_pr" value="">
{{--                        <div id="glassOptionSelectError" class="ErrorRed" style="display: none;">Glass Option is required</div>--}}
                    </div>
                </div>

                <div class="row flex m-3" id="blind_ht" style="display: none;">
                    <div class="col-3" style="text-align: left">
                        Blind
                    </div>
                    <div class="col-4" id="blindOptionSelectPlaceholder">
                        <select name="blind_option_select" id="blindOptionSelect" size="1"
                                style="width: 400px" disabled>
                            <option value="-1">Please select a Blind option...</option>
                        </select>
                        <input type="hidden" id="oldBlindOptionSelect" value="{{old('blind_option_select')}}">
                        <input type="hidden" class="hiddeee"  id="blind_option_pr" name="blind_option_pr" value="">
                        <div id="blindOptionSelectError" class="ErrorRed" style="display: none;">Blind Option is required</div>
                    </div>
                </div>


                <input type="hidden" value="" name="vale_till_finish_color" id="vale_till_finish_color">

                {{-- BLIND_OPTION --}}



{{--            <div class="row flex m-3" id="glass_op" style="display: none;">--}}
{{--                <div class="col-3" style="text-align: left">--}}
{{--                    Glass Option--}}
{{--                </div>--}}
{{--                <div class="col-4" id="glassOptionSelectPlaceholder">--}}
{{--                    <select name="glass_grid_select" id="glassGridSelect" size="1"--}}
{{--                            style="width: 400px" disabled>--}}
{{--                        <option value="-1">Please select a glass option...</option>--}}
{{--                    </select>--}}
{{--                    <input type="hidden"   id="oldGlassGrid" value="{{old('glass_grid_select')}}">--}}
{{--                    <input type="hidden" class="hiddeee"  id="glass_grid_pr" value="{{old('glass_grid_select')}}">--}}
{{--                    <div id="glassGridSelectError" class="ErrorRed" style="display: none;">Glass Options is required</div>--}}
{{--                </div>--}}
{{--            </div>--}}


{{--            <div class="row flex m-3" id="glass_grid_ht" style="display: block;">--}}
{{--                <div class="col-3" style="text-align: left"> Glass Grid </div>--}}
{{--                <div class="col-4" id="glassGridSelectPlaceholder">--}}
{{--                    <select name="glass_grid_select" id="glassGridSelect" size="1"--}}
{{--                            style="width: 400px" disabled>--}}
{{--                        <option value="-1">Please select a glass grid...</option>--}}
{{--                    </select>--}}
{{--                    <input type="hidden"   id="oldGlassGrid" value="{{old('glass_grid_select')}}">--}}
{{--                    <input type="hidden" class="hiddeee"  id="glass_grid_pr" value="{{old('glass_grid_select')}}">--}}
{{--                    <div id="glassGridSelectError" class="ErrorRed" style="display: none;">Glass Grid Options is required</div>--}}
{{--                </div>--}}
{{--            </div>--}}

            <div class="row flex m-3" id="glass_grid_ht" style="display: none;">
                <div class="col-3" style="text-align: left">Glass Grid</div>
                <div class="col-4" id="glassGridSelectPlaceholder">
                    <select name="glass_grid_select" id="glassGridSelect" size="1"
                            style="width: 400px" disabled>
                        <option value="-1">Please select a glass grid...</option>
                    </select>
            <input type="hidden"   id="oldGlassGrid" value="{{old('glass_grid_select')}}">
            <input type="hidden" class="hiddeee"  id="glass_grid_pr" value="{{old('glass_grid_select')}}">
            <div id="glassGridSelectError" class="ErrorRed" style="display: none;">Glass Grid Options is required</div>
                </div>
            </div>


            <div class="row flex m-3" id="lite_ht" style="display: none;">
                <div class="col-3" style="text-align: left">3/4 Lite Panel Option</div>
                <div class="col-4" id="liteOptionSelectPlaceholder">
                    <select name="lite_option_select" id="liteOptionSelect" size="1"
                            style="width: 400px" disabled>
                        <option value="-1">Please select a Lite Panel option...</option>
                    </select>
                    <input type="hidden" id="oldLiteOptionSelect" value="{{old('lite_option_select')}}">
                    <input type="hidden" class="hiddeee"  id="lite_option_pr" value="">
{{--                    <div id="liteOptionSelectError" class="ErrorRed" style="display: none;">Lite Options is required</div>--}}
                </div>
            </div>


{{--                <div class="row flex m-3"  id="lite_gird_combo">--}}
{{--                    <div class="col-3" style="text-align: left">--}}
{{--                         Glass Grid / Lite Panel Option--}}
{{--                    </div>--}}
{{--                    --}}
{{--                    <div class="col-4" id="">--}}
{{--                        <select name="blind_glass_lite" id="blindGlassliteOptionSelect" size="1"--}}
{{--                                style="width: 400px"  disabled="disabled"  >--}}
{{--                            <option value="">Please select an option...</option>--}}
{{--                            <option value="Glass Grid">Glass Grid</option>--}}
{{--                            <option value="Lite Option">Lite Panel Option</option>--}}
{{--                        </select>--}}
{{--                        <div id="blindGlassliteOptionSelectError" class="ErrorRed" style="display: none;">Glass Grid/Lite Panel is required</div>--}}
{{--                    </div>--}}
{{--                </div> --}}


                <script type="text/javascript">

                   /* $('#blindGlassliteOptionSelect').change(function(){
                        if($(this).val() == 'Glass Grid'){
                            $('#glass_grid_ht').show();
                            $('#lite_ht').hide();

                            $("#liteOptionSelect").val('');
                            $("#lite_option_pr").val(0);

                            $("#blindOptionSelect").val('');
                            $("#blind_option_pr").val(0);
                        }

                        if($(this).val() == 'Lite Option'){

                            $('#liteOptionSelectPlaceholder').show();
                            $('#lite_ht').show();
                            $('#glass_grid_ht').hide();

                            $("#glassGridSelect").val('');
                            $("#glass_grid_pr").val(0);

                            $("#blindOptionSelect").val('');
                            $("#blind_option_pr").val(0);
                        }
                    });*/
                </script>


{{--                <input type="hidden" name="glass_grid_lite_option" id="glass_grid_lite_option" >--}}


                {{--            HANDLE TYPE            --}}
                <div class="row flex m-3">
                    <div class="col-3" style="text-align: left">
                        Handle Types
                    </div>
                    <div class="col-4" id="handleTypeSelectPlaceholder">
                        <select name="handle_type_select" id="handleTypeSelect" size="1"
                                style="width: 400px" disabled>
                            <option>Please select a handle...</option>
                        </select>
                        <input type="hidden"   id="oldHandleType" value="{{old('handle_type_select')}}">
                        <input type="hidden" class="hiddeee"  id="handle_type_pr" value="{{old('handle_type_select')}}">
                        <div id="handleTypeSelectError" class="ErrorRed" style="display: none;">Handle Type is required</div>

                    </div>
                </div>

                {{--            LOCK SET--}}
                <div class="row flex m-3">
                    <div class="col-3" style="text-align: left">
                        Lock Set
                    </div>
                    <div class="col-4" id="lockSetSelectPlaceholder">
                        <select name="lock_set_select" id="lockSetSelect" size="1"
                                style="width: 400px" disabled>
                            <option>Please select a lock...</option>
                        </select>
                        <input type="hidden" id="oldLockset" value="{{old('lock_set_select')}}">
                        <input type="hidden" class="hiddeee"  id="lock_set_pr" name="lock_set_pr" value="">
                        <div id="lockSetSelectError" class="ErrorRed" style="display: none;">Lock Set is required</div>
                    </div>
                </div>

                {{--            FRAME THICKNESS--}}

                <div class="row flex m-3">
                    <div class="col-3" style="text-align: left">
                        Frame Thickness
                    </div>
                    <div class="col-4" id="frameThicknessOptionSelectPlaceholder">
                        <select name="frame_thickness_select" id="frameThicknessOptionSelect"
                                style="width: 400px" disabled>
                            <option value="">Please select a thickness...</option>
                        </select>
                        <input type="hidden" id="oldframeThickness" value="{{old('frame_thickness_select')}}">
                        <input type="hidden" class="hiddeee"  id="thickness_pr" name="thickness_pr" value="">
                        <div id="frameThicknessOptionSelectError" class="ErrorRed" style="display: none;">Frame thickness is required</div>
                    </div>
                </div>



                {{--            SILL OPTION--}}

                @php
                    $os       = array(1001 ,1002, 1003,1004 ,1005, 1006  ,1007,1008 ,1019,1018,1017);
                    $request  = Request::path();

                    $last_word_start = strrpos($request, '/') + 1; // +1 so we don't include the space in our result
                    $last_word = substr($request, $last_word_start);
                    //dd($last_word);
                    if(in_array($last_word,$os)){
            @endphp
            <div class="row flex m-3" id="sillyopp">
                <div class="col-3" style="text-align: left">
                    Sill Option
                </div>
                <div class="col-4" id="sillOptionSelectPlaceholder">
                    <select name="sill_option_select" id="sillOptionSelect" size="1"
                            style="width: 400px" disabled>
                        <option>Please select a Sill Option...</option>
                    </select>
                    <input type="hidden" id="oldSillOption" value="{{old('sill_option_select')}}">
                    <input type="hidden" class="hiddeee"  id="sill_pr" value="" name="sill_pr">
                    <div id="sillOptionSelectError" class="ErrorRed" style="display: none;">Sill Option is required</div>

                </div>
            </div>
            @php
              }
            @endphp



            {{-- SCREEN OPTOIN--}}
            <div class="row flex m-3">
                <div class="col-3" style="text-align: left">
                    Screen option
                </div>
                <div class="col-4" id="screennewOptionSelectPlaceholder">
                    <select name="screen_new_option_select" id="screennewOptionSelect" size="1"
                            style="width: 400px" disabled>
                        <option>Please select a Screen option...</option>
                    </select>
                    <input type="hidden" id="oldscreennewOption" value="{{old('screen_new_option_select')}}">
                    <input type="hidden" class="hiddeee"  id="screen_option_pr" value="" name="screen_option_pr">
{{--                    <div id="screennewOptionSelectError" class="ErrorRed" style="display: none;">Screen is required</div>--}}

                </div>
            </div>


            {{-- MULL_KIT --}}
            @php
                $fixed_door_arr = [1015,1016,1017,1018,1019,1102,1103,1104];
                $door_id        = $door->id;
                if($door->doorType->door_type == 'Transom' || in_array($door_id,$fixed_door_arr)   ){
            @endphp

            <div class="row flex m-3">
                <div class="col-3" style="text-align: left">
                    Mull kit
                </div>
{{--                hardwareColorOptionSelect--}}
                <div class="col-4" id="mullkitOptionSelectPlaceholder">
                    <select name="mull_kit_select" id="mullkitOptionSelect" size="1"
                            style="width: 400px" disabled>
                        <option>Please select a Mull kit option...</option>
                    </select>
                    <input type="hidden" id="oldmullkitOptionSelect" value="{{old('mull_kit_select')}}">
                    <input type="hidden" id="mull_kit_pr" class="hiddeee"  value="" name="mull_kit_pr">
                </div>
            </div>
            @php
                }

            // gliding  / hide hinge optoin
            // 1009,1010, 1011, 1012,1013, 1014 , 1015 , 1016 , 1030 , 1031
            $glging       = array(1009,1010, 1011, 1012,1013, 1014 , 1015 , 1016 , 1030 , 1031);

            // fixed panels  / hide hinge / handle and lock color
            $fixed_panel_doors       = array(1015 ,1016,1017,1018 ,1019, 1102  ,1103,1104);
            if(!in_array($door->id,$fixed_panel_doors)){



            @endphp

            {{--  HANLDLE COLOR--}}
            <div class="row flex m-3">
                <div class="col-3" style="text-align: left">
                    Handle Color
                </div>
                <div class="col-4" id="handlecolorOptionSelectPlaceholder">
                    <select name="handle_color_option_select" id="handlecolorOptionSelect" size="1"
                            style="width: 400px" disabled >
                        <option>Please select a Handle Color...</option>
                    </select>
                    <input type="hidden" id="oldHandlecolorOption" value="{{old('handle_color_option_select')}}">
                    <input type="hidden" id=“handle_clr_pr" value="" name="handle_clr_pr">
                    <div id="handlecolorOptionSelectError" class="ErrorRed" style="display: none;">Handle Color is required</div>
                </div>

            </div>


            {{--  LOCK COLOR--}}
            <div class="row flex m-3">
                <div class="col-3" style="text-align: left">
                    Lock Color
                </div>
                <div class="col-4" id="lockcolorOptionSelectPlaceholder">
                    <select name="lock_color_option_select" id="lockcolorOptionSelect" size="1"
                            style="width: 400px" disabled>
                        <option>Please select a Lock Color...</option>
                        @foreach($door->additionalOptions as $addOn)
                        @endforeach
                    </select>
                    <input type="hidden" id="oldLockcolorOption" value="{{old('lock_color_option_select')}}">
                    <input type="hidden" id="lock_color_option_pr" value="{{old('lock_color_option_pr')}}">
                    <div id="lockcolorOptionSelectError" class="ErrorRed" style="display: none;">Lock Color is required</div>
                </div>
            </div>

            @php }   @endphp
            {{--  SILL COLOR--}}
            <div class="row flex m-3">
                <div class="col-3" style="text-align: left" >
                    Sill Color
                </div>
                <div class="col-4" id="sillcolorOptionSelectPlaceholder">
                    <select name="sill_color_option_select" id="sillcolorOptionSelect" size="1"
                            style="width: 400px" disabled>
                        <option>Please select a Sill Color...</option>
                    </select>
                    <input type="hidden" id="oldSillcolorOption" value="{{old('sill_color_option_select')}}">
                    <input type="hidden" id="sill_clr_pr" value="" name="sill_clr_pr">
                </div>
            </div>



            {{--  HINGE_COLOR_OPTION --}}
            @php
                if(!in_array($door->id,$fixed_panel_doors)){
                    if(!in_array($door->id,$glging)){

            @endphp
            <div class="row flex m-3">
                <div class="col-3" style="text-align: left" >
                    Hinge Color
                </div>
                <div class="col-4" id="hingecolorOptionSelectPlaceholder">
                    <select name="hinge_color_option_select" id="hingecolorOptionSelect" size="1"
                            style="width: 400px" disabled>
                        <option>Please select a Hinge Color...</option>
                    </select>
                    <input type="hidden" id="oldHingecolorOption" value="{{old('hinge_color_option_select')}}">
                    <input type="hidden" id="hinge_clr_pr" value="" name="hinge_clr_pr">
                    <div id="hingecolorOptionSelectError" class="ErrorRed" style="display: none;">Hinge Color is required</div>
                </div>
            </div>
            @php } }
            @endphp




            {{--       Custom OPTIONS --}}

            @foreach($door->customOptions as $customOption)
                <div class="d-none customOptionPlaceHolder" id="{{$customOption->id}}-{{$loop->index}}">
                    <input type="hidden" id="customOptionNamePlaceHolder-{{$loop->index}}"
                           value="{{$customOption->option_name}}">
                </div>
                <div class="row flex m-3">
                    <div class="col-3" style="text-align: left">
                        {{$customOption->option_name}}
                    </div>
                    <div class="col-4">
                        <select name="custom_option-{{$customOption->id}}"
                                id="customOptionSelect-{{$customOption->id}}-{{$loop->index}}"
                                style="width: 400px" disabled>
                            <option value="">Please select {{$customOption->option_name}}...</option>
                        </select>
                    </div>
                </div>
            @endforeach





            @php    // if($door->id != 1111) { @endphp
            <div class="row flex m-3">
                <div class="col-3" style="text-align: left" >Assemble Option / Knocked Down </div>

                <div class="col-4" id="">
                    <select name="assemble_knock" id="assemble_knocked_option_select" size=""
                            style="width: 400px"  required disabled="disabled">
{{--                        <option value="">Select an Option</option>--}}
                        <option value="Full Assembled">Full Assembled</option>
                        @php
                            if($door->id != 1023 || $door->id != 1024 ||  $door->id != 1022 ||  $door->id != 1098 ||  $door->id != 1099  ||  $door->id != 1100 ||    $door->id != 1112 ) { @endphp
                        <option value="Knocked Down">Knocked Down</option>
                        @php } @endphp

                    </select>
{{--                    <input type="hidden" id="oldHingecolorOption" value="{{old('hinge_color_option_select')}}">--}}
                </div>
            </div>

            @php   /* } else{   */ @endphp
{{--            <input type="hidden"  name="assemble_knock" id="assemble_knocked_option_select" value="0">--}}

            @php /* } */ @endphp


            {{--            <div class="row flex m-3">--}}
{{--                <div class="col-3" style="text-align: left ; width: 400px;" >PO Number </div>--}}

{{--                <div class="col-4" id="">--}}
{{--                    <input type="text" name="po_number" required id="po_number" value="{{old('po_number')}}">--}}
{{--                    --}}{{--                    <input type="hidden" id="oldHingecolorOption" value="{{old('hinge_color_option_select')}}">--}}
{{--                </div>--}}
{{--            </div>--}}


            {{--            NOTES CONTAINER--}}

            <div class="row flex m-3" id="notesContainer">
                <div class="col-3" style="text-align: left" >Quantity</div>
                <div class="col-4">
                    <input type="number" onchange="return isNumber()" maxlength= "4" max="9999"  class="form-control" value="1" required min="1" name="quantity" id="quantity"  style="width: 400px" >
                </div>
            </div>
{{--            <div class="row flex m-3" id="notesContainer">--}}
{{--                <div class="col-3" style="text-align: left">--}}
{{--                    Order Notes--}}
{{--                </div>--}}
{{--                <div class="col-4" id="">--}}
{{--                                    <textarea class="form-control" style="width:400px;" rows="4"--}}
{{--                                              name="additional_notes">{{old('additional_notes')}}</textarea>--}}
{{--                </div>--}}
{{--            </div>--}}

            <input type="hidden"  value=""   name="old_base_price" id="old_base_price"  >
            <input type="hidden"  value=""   name="priceValueInput" id="priceValueInput"   >

            <div class="row flex m-3" id="notesContainer">
                <div class="col-3" style="text-align: left">&nbsp;</div>
                    <div class="col-4" id="">
                        <div class="cartButtonDiv" id="addItemToCartButton" style="margin: 0;height: 45px;">
                            <p style="">Add To Order</p>
                        </div>
                </div>
            </div>
        </form>
    </div>

    {{--    Hidden options for JS handling--}}

    <div class="d-none" id="dd-nonnoo">
        <?php
//
//            echo '<pre>';
//            var_dump($door->additionalOptions);
//            echo '</pre>';
//            die;
        ?>

{{--        @foreach($door->additionalOptions as $addOn)--}}

        @foreach($addOn_option as $addOn)
            @if($addOn->is_custom_option>0)
                @php
                    if($addOn->price == 0 ){
                        $price_text1 = ' Included';
                    }else{
                        $price_text1 = '+$'.$addOn->price;
                    }
                @endphp

                <div class="customOption addOn-{{$addOn->id}}">
                    <option value="{{$addOn->id}}" class=" addOnOption"
                            id="m-{{$addOn->is_custom_option}}-{{$addOn->door_measurement_id}}-{{$addOn->price}}">{{$addOn->name}}{{$price_text1}}</option>
                </div>

            @else
                @php
                    $price      = $addOn->price;
                    //echo $addOn->group_name;die;
                        // change the price calculation
                        if($addOn->group_name == 'GLASS_GRID'){
                                //12-Lite GBG
                                if ( str_contains($addOn->name, 'SDL')  &&   (strpos($addOn->name, 'GBG') == false) ){

                                        $esxp_arr   = explode('-',$addOn->name);
                                        $pricetpe   = $esxp_arr[0];
                                        $price      = ($pricetpe)*($addOn->price)*($door->panel_count);
                                        //$price      = ($pricetpe)*($addOn->price)*($addOn->panel_count);
                                }else{
                                        $price      = $addOn->price;
                                }
                                //strpos($addOn->name)
                        }else{
                            $price      = $addOn->price;
                        }


                        if($price == 0 ){
                            $price_text = ' Included';
                        }else{
                            $price_text = '+$'.$price;
                        }


                        if (!in_array($addOn->door_id, $os)   &&  $addOn->group_name == 'SILL_OPTION') {
                            continue;
                        }


                    @endphp
                        <div class="addOn-{{$addOn->id}}">

                            <option value="{{$addOn->id}}" class="{{$addOn->group_name}} addOnOption"
                                    id="m-{{$addOn->group_name}}-{{$addOn->door_measurement_id}}-{{$price}}">{{$addOn->name}}{{$price_text}}
                            </option>
                        </div>


            @endif
        @endforeach

        <div class="colors d-none">
            @foreach($door->doorMeasurements as $dm)
                @foreach($dm->doorFinishPrices as $doorFinishPrice)
                    @php

                        //$interiorColor_Color = $doorFinishPrice->interiorColor->color ?? 'Default Name';
                        if ($doorFinishPrice->interiorColor->color ?? false) {
                        //if($doorFinishPrice->interiorColor->color){


                         @endphp
                    <option
                        value="{{$doorFinishPrice->interior_color_id}}"

                        class="colorOption"
                        id="finish-{{$dm->id}}-{{$doorFinishPrice->id}}">{{$doorFinishPrice->interiorColor->color}}+${{$doorFinishPrice->price}}</option>
                    @php  }  @endphp
                @endforeach
            @endforeach
        </div>
    </div>
    @section('scripts')
        <script src="{{ asset('js/shoppingcart/doorcart1.js') }}" defer></script>
        <script>
            // var qantu_cval = 0;
            // function isNumber() {
            //
            //     qantu_cval = $('#quantity)'.val();
            //     alert(qantu_cval);
            //     //var charCode = (evt.which) ? evt.which : evt.keyCode;
            //     if (qantu_cval < 1 || qantu_cval > 100)  {
            //         alert('Wrong');
            //         $('#cartItemForm').attr('onsubmit','return false;');
            //         return false;
            //     }
            //     //$('#cartItemForm').attr('onsubmit','return true;');
            //     return true;
            // }
        </script>
    @stop
</x-app-layout>
