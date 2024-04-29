<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order')  }} {{$door->doorType->door_type_pretty_name}}
        </h2>
    </x-slot>

    <div class="container  mt-4" style="min-width: 900px;">
        <h4 class="fw-bold">Configure your product... {{$door->name??''}} </h4>

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
                    <div class="col-3 doorNameClass" style="border: 2px solid black; cursor: pointer"
                         id="doornameid-{{$n->id}}-{{$n->door_name_or_type}}">
                        <img src="/storage/product_image/{{$n->image->image_path}}"
                             style="max-width: 255px ">
                        <p style="text-align: center" class="fw-bolder" >{{$n->door_name_or_type}}</p>
                    </div>
                @endforeach
            </div>


            {{-- --}}

            @if($errors->has('door_name_type_id_selection'))
                <div class="row flex m-3">
                    <div class="col-3">
                        <span class="" role="alert" style="color: red">
                            <strong>Please select a door type.</strong>
                        </span>
                    </div>
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
                    Select Door Size
                </div>
                <div class="col-4">
                    <select name="door_size_select" id="doorSizeSelect" size="1"
                            style="width: 400px" disabled>
                        <option value="">Select a size...</option>
                        @foreach($door->doorMeasurements as $m)
                            <option value="{{$m->id}}">{{$m->width}} x {{$m->height}}</option>
                        @endforeach
                    </select>
                    <input type="hidden" id="oldSize" value="{{old('door_size_select')}}">
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
                </div>
            </div>


            {{-- Door handlng two --}}
{{--            @if(isset($door->category))--}}
{{--                @if(str_contains($door->category->category_name, "Hinged Units"))--}}
{{--                    --}}{{-- DOOR HANDLING 2 --}}
{{--                    <div class="row flex m-3">--}}
{{--                        <div class="col-3" style="text-align: left">--}}
{{--                            Door Handling 2--}}
{{--                        </div>--}}
{{--                        <div class="col-4">--}}
{{--                            <select name="door_handling_select2" id="doorHandlingSelect2" size="1"--}}
{{--                                    style="width: 400px" disabled>--}}
{{--                                <option value="">Select a handling option 2...</option>--}}
{{--                                @foreach($doorHandlings2 as $dh)--}}
{{--                                    <option value="{{$dh->id}}">{{$dh->handling}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            <input type="hidden" id="oldHandling2" value="{{old('door_handling_select2')}}">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            @endif--}}

            @if(isset($door->category))
                @php //echo $door->category->category_name;die; @endphp
                @if(!str_contains($door->category->category_name, "Gliding"))
                    {{--            DOOR HANDLING--}}
                    <div class="row flex m-3">
                        <div class="col-3" style="text-align: left">
                            Door Handling
                        </div>
                        <div class="col-4">
                            <select name="door_handling_select" id="doorHandlingSelect" size="1"
                                    style="width: 400px" disabled>
                                <option value="">Select a handling option...</option>
                                    {{-- @foreach($door->doorHandlings as $dh)--}}
                                @foreach($doorHandlings1 as $dh)
                                    <option value="{{$dh->id}}">{{$dh->handling}}</option>
                                @endforeach
                            </select>
                            <input type="hidden" id="oldHandling" value="{{old('door_handling_select')}}">
                        </div>
                    </div>
                @endif
            @endif
















            {{--            DOOR FRAME--}}
{{--            @if(isset($door->category))--}}
{{--                @if(!str_contains($door->category->category_name, "Gliding"))--}}
{{--                    --}}{{--            DOOR HANDLING--}}

{{--                    <div class="row flex m-3">--}}
{{--                        <div class="col-3" style="text-align: left">--}}
{{--                            Door Frame--}}
{{--                        </div>--}}
{{--                        <div class="col-4">--}}
{{--                            <select name="door_frame_select" id="doorFrameSelect" size="1"--}}
{{--                                    style="width: 400px">--}}
{{--                                <option>Please select a frame type...</option>--}}
{{--                                @foreach($door->doorFrames as $df)--}}
{{--                                    <option value="{{$df->id}}">{{$df->frame}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            <input type="hidden" id="oldFrame" value="{{old('door_frame_select')}}">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            @endif--}}


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
                </div>
            </div>

            {{-- GLASS  / BLIND OPTION--}}

            <div class="row flex m-3">
                <div class="col-3" style="text-align: left">
                    Glass Option / Blind Option
                </div>
                <div class="col-4" id="">
                    <select name="" id="glassblindOptionSelect" size="1"
                            style="width: 400px" >
                        <option value="">Please Select an option</option>
                        <option value="glassselected">Glass Option</option>
                        <option value="blindselected">Blind Option</option>
                    </select>
                </div>
            </div>


            <script type="text/javascript">
                $('#glassblindOptionSelect').change(function(){
                    if($(this).val() == 'blindselected'){
                        $('#blind_ht').show();
                        $('#lite_gird_combo').hide();
                        $('#glass_ht,#glass_grid_ht,#lite_ht').hide();

                        //hide the other tions to
                    }
                    if($(this).val() == 'glassselected'){

                        $('#glassOptionSelect,#blindGlassliteOptionSelect,#glassGridSelect').val("");

                        $('#glass_ht,#lite_ht').show();
                        $('#blind_ht').hide();
                        $('#lite_gird_combo').show();
                    }
                });
            </script>


            {{-- GLASS OPTION--}}
            <input type="hidden" id="old_glass_option_price" value="" name="old_glass_option_price">
            <div class="row flex m-3" id="glass_ht" >
                <div class="col-3" style="text-align: left">
                    Glass Option
                </div>
                <div class="col-4" id="glassOptionSelectPlaceholder">
                    <select name="glass_option_select" id="glassOptionSelect" size="1"
                            style="width: 400px" disabled>
                        <option value="-1">Please select a glass option...</option>
                    </select>
                    <input type="hidden" id="oldGlassOption" value="{{old('glass_option_select')}}">
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
                </div>
            </div>


            <input type="hidden" value="" name="vale_till_finish_color" id="vale_till_finish_color">

            {{-- BLIND_OPTION --}}
            <div class="row flex m-3"  id="lite_gird_combo">
                <div class="col-3" style="text-align: left">
                     Glass Grid / Lite Panel Option
                </div>
                {{--                hardwareColorOptionSelect--}}
                <div class="col-4" id="">
                    <select name="blind_glass_lite" id="blindGlassliteOptionSelect" size="1"
                            style="width: 400px"   >
                        <option>Please select an option...</option>
{{--                        <option value="Blind">Blind</option>--}}
                        <option value="Glass Grid">Glass Grid</option>
                        <option value="Lite Option">Lite Panel Option</option>
                    </select>
                    {{-- <input type="hidden" id="oldmullkitOptionSelect" value="{{old('mull_kit_select')}}"> --}}
                </div>
            </div>

            <script type="text/javascript">
                $('#blindGlassliteOptionSelect').change(function(){
                    /*if($(this).val() == 'Blind'){
                        $('#blind_ht').show();
                        $('#glass_grid_ht,#lite_ht').hide();
                    }*/
                    if($(this).val() == 'Glass Grid'){
                        $('#glass_grid_ht').show();
                        $('#lite_ht').hide();
                    }
                    if($(this).val() == 'Lite Option'){
                        $('#lite_ht').show();
                        $('#glass_grid_ht').hide();
                    }
                });
            </script>


            <input type="hidden" name="glass_grid_lite_option" id="glass_grid_lite_option" >

            <div class="row flex m-3" id="glass_grid_ht" style="display: none;">
                <div class="col-3" style="text-align: left">
                    Glass Grid
                </div>
                <div class="col-4" id="glassGridSelectPlaceholder">
                    <select name="glass_grid_select" id="glassGridSelect" size="1"
                            style="width: 400px" disabled>
                        <option value="-1">Please select a glass option...</option>
                    </select>
                    <input type="hidden" id="oldGlassGrid" value="{{old('glass_grid_select')}}">
                </div>
            </div>

            <div class="row flex m-3" id="lite_ht" style="display: none;">
                <div class="col-3" style="text-align: left">
                    Lite Option
                </div>
                <div class="col-4" id="liteOptionSelectPlaceholder">
                    <select name="lite_option_select" id="liteOptionSelect" size="1"
                            style="width: 400px" disabled>
                        <option value="-1">Please select a Lite Panel option...</option>
                    </select>
                    <input type="hidden" id="oldLiteOptionSelect" value="{{old('lite_option_select')}}">
                </div>
            </div>



            {{--            GLASS GRID--}}

{{--            <div class="row flex m-3">--}}
{{--                <div class="col-3" style="text-align: left">--}}
{{--                    Glass Grid ({{$door->panel_count??1}} Panel(s))--}}
{{--                    Glass Grid/Blind/3/4 Lite--}}
{{--                </div>--}}
{{--                <div class="col-4">--}}
{{--                    <select name="glass_grid_select" id="glassGridSelect" size="1"--}}
{{--                            style="width: 400px" disabled>--}}
{{--                        <option value="-1">Please select a glass option...</option>--}}
{{--                    </select>--}}
{{--                    <input type="hidden" id="oldGlassGrid" value="{{old('glass_grid_select')}}">--}}
{{--                </div>--}}
{{--            </div>--}}


            {{-- GLASS DEPTH--}}
{{--            <div class="row flex m-3">--}}
{{--                <div class="col-3" style="text-align: left">--}}
{{--                    Glass DEPTH Options--}}
{{--                </div>--}}
{{--                <div class="col-4" id="glassDepthSelectPlaceholder">--}}
{{--                    <select name="glass_depth_select" id="glassDepthSelect" size="1"--}}
{{--                            style="width: 400px" disabled>--}}
{{--                        <option>Please select glass depth...</option>--}}
{{--                    </select>--}}
{{--                    <input type="hidden" id="oldGlassDepth" value="{{old('glass_depth_select')}}">--}}
{{--                </div>--}}
{{--            </div>--}}

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
                    <input type="hidden" id="oldHandleType" value="{{old('handle_type_select')}}">
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
                </div>
            </div>




            {{-- HARDWARE_COLOR_OPTION --}}
{{--            <div class="row flex m-3">--}}
{{--                <div class="col-3" style="text-align: left">--}}
{{--                    Hardware Color--}}
{{--                </div>--}}
{{--                <div class="col-4" id="hardwareColorOptionSelectPlaceholder">--}}
{{--                    <select name="hardware_color_select" id="hardwareColorOptionSelect"--}}
{{--                            style="width: 400px" >--}}
{{--                        <option value="">Please select a Hardware Color...</option>--}}
{{--                    </select>--}}
{{--                    <input type="hidden" id="oldhardwareColor" value="{{old('hardware_color_select')}}">--}}
{{--                </div>--}}
{{--            </div>--}}




            {{--            SILL OPTION--}}

            @php
                $os       = array(1001 ,1002, 1003,1004 ,1005, 1006  ,1007,1008 ,1019,1018,1017);
                $request  = Request::path();

                $last_word_start = strrpos($request, '/') + 1; // +1 so we don't include the space in our result
                $last_word = substr($request, $last_word_start);
                //dd($last_word);
                if(in_array($last_word,$os)){
            @endphp
            <div class="row flex m-3">
                <div class="col-3" style="text-align: left">
                    Sill Option
                </div>
                <div class="col-4" id="sillOptionSelectPlaceholder">
                    <select name="sill_option_select" id="sillOptionSelect" size="1"
                            style="width: 400px" disabled>
                        <option>Please select a Sill Option...</option>
                    </select>
                    <input type="hidden" id="oldSillOption" value="{{old('sill_option_select')}}">
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
                </div>
            </div>
            @php
                }
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
                </div>
            </div>

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
                </div>
            </div>



            {{--  HINGE_COLOR_OPTION --}}
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
                </div>
            </div>





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



{{--            if the all doors H= > 8', can't choose Fully Assembled.--}}
{{--            （transom + door h =>8‘ ）--}}





            <div class="row flex m-3">
                <div class="col-3" style="text-align: left" >Assemble Option / Knocked Down </div>

                <div class="col-4" id="">
                    <select name="assemble_knocked_option_select" id="" size=""
                            style="width: 400px" >
                        <option value="Assemble Option">Assemble Option</option>
                        <option value="Knocked Down">Knocked Down</option>
                    </select>
{{--                    <input type="hidden" id="oldHingecolorOption" value="{{old('hinge_color_option_select')}}">--}}
                </div>
            </div>

            {{--            NOTES CONTAINER--}}

            <div class="row flex m-3" id="notesContainer">
                <div class="col-3" style="text-align: left" >Quantity</div>
                <div class="col-4">
                    <input type="number"  value="1" required min="1" name="quantity" id="quantity"  style="width: 400px" >
                </div>
            </div>
            <div class="row flex m-3" id="notesContainer">
                <div class="col-3" style="text-align: left">
                    Additional Notes
                </div>
                <div class="col-4" id="">
                                    <textarea class="form-control" style="width:300px;" rows="4"
                                              name="additional_notes">{{old('additional_notes')}}</textarea>
                </div>
            </div>

            <input type="hidden"  value=""   name="old_base_price" id="old_base_price"  >
            <input type="hidden"  value=""   name="priceValueInput" id="priceValueInput"   >



            {{--            SAVE ITEM IN CART--}}

            <div class="cartButtonDiv" id="addItemToCartButton">
                <p style="">Add To Order</p>
            </div>
        </form>
    </div>

    {{--    Hidden options for JS handling--}}

    <div class="d-none">
        @foreach($door->additionalOptions as $addOn)
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
                //echo $addOn->group_name;die;
                    // change the price calculation
                    if($addOn->group_name == 'GLASS_GRID'){
                            //12-Lite GBG
                            if ( str_contains($addOn->name, 'SDL')  &&   (strpos($addOn->name, 'GBG') === false) ){

                                    $esxp_arr   = explode('-',$addOn->name);
                                    $pricetpe   = $esxp_arr[0];
                                    $price      = ($pricetpe)*($addOn->price)*($door->panel_count);
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
                    <option
                        value="{{$doorFinishPrice->interior_color_id}}"
                        class="colorOption"
                        id="finish-{{$dm->id}}-{{$doorFinishPrice->id}}">{{$doorFinishPrice->interiorColor->color}}+${{$doorFinishPrice->price}}</option>
                @endforeach
            @endforeach
        </div>
    </div>
    @section('scripts')
        <script src="{{ asset('js/shoppingcart/doorcart1.js') }}" defer></script>
        <script></script>
    @stop
</x-app-layout>
