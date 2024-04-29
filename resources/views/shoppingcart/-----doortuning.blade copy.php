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
                         id="doornameid-{{$n->id}}">
                        <img src="/storage/{{$n->image->image_path}}"
                             style="max-width: 255px ">
                        <p style="text-align: center" class="fw-bolder">{{$n->door_name_or_type}}</p>
                    </div>
                @endforeach
            </div>

            @php

            @endphp
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
                            style="width: 400px">
                        <option value="">Select a size...</option>
                        @foreach($door->doorMeasurements as $m)
                            <option value="{{$m->id}}">{{$m->width}} x {{$m->height}}</option>
                        @endforeach
                    </select>
                    <input type="hidden" id="oldSize" value="{{old('door_size_select')}}">
                </div>
            </div>

            @if(isset($door->category))
                @if(!str_contains($door->category->category_name, "Gliding"))
                    {{--            DOOR HANDLING--}}

                    <div class="row flex m-3">
                        <div class="col-3" style="text-align: left">
                            Door Handling
                        </div>
                        <div class="col-4">
                            <select name="door_handling_select" id="doorHandlingSelect" size="1"
                                    style="width: 400px">
                                <option value="">Select a handling option...</option>
                                @foreach($door->doorHandlings as $dh)
                                    <option value="{{$dh->id}}">{{$dh->handling}}</option>
                                @endforeach
                            </select>
                            <input type="hidden" id="oldHandling" value="{{old('door_handling_select')}}">
                        </div>
                    </div>
                @endif
            @endif







            {{--            DOOR FRAME--}}
            @if(isset($door->category))
                @if(!str_contains($door->category->category_name, "Gliding"))
                    {{--            DOOR HANDLING--}}

                    <div class="row flex m-3">
                        <div class="col-3" style="text-align: left">
                            Door Frame
                        </div>
                        <div class="col-4">
                            <select name="door_frame_select" id="doorFrameSelect" size="1"
                                    style="width: 400px">
                                <option>Please select a frame type...</option>
                                @foreach($door->doorFrames as $df)
                                    <option value="{{$df->id}}">{{$df->frame}}</option>
                                @endforeach
                            </select>
                            <input type="hidden" id="oldFrame" value="{{old('door_frame_select')}}">
                        </div>
                    </div>
                @endif
            @endif

            {{--            GLASS COLOR--}}

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

            {{-- GLASS OPTION--}}

            <div class="row flex m-3">
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


            {{--            GLASS GRID--}}

            <div class="row flex m-3">
                <div class="col-3" style="text-align: left">
                    Glass Grid ({{$door->panel_count??1}} Panel(s))
                </div>
                <div class="col-4">
                    <select name="glass_grid_select" id="glassGridSelect" size="1"
                            style="width: 400px" disabled>
                        <option value="-1">Please select a glass option...</option>
                    </select>
                    <input type="hidden" id="oldGlassGrid" value="{{old('glass_grid_select')}}">
                </div>
            </div>


            {{-- GLASS DEPTH--}}
            <div class="row flex m-3">
                <div class="col-3" style="text-align: left">
                    Glass DEPTH Options
                </div>
                <div class="col-4" id="glassDepthSelectPlaceholder">
                    <select name="glass_depth_select" id="glassDepthSelect" size="1"
                            style="width: 400px" disabled>
                        <option>Please select glass depth...</option>
                    </select>
                    <input type="hidden" id="oldGlassDepth" value="{{old('glass_depth_select')}}">
                </div>
            </div>

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
                <div class="col-4" id="frameThicknessSelectPlaceholder">
                    <select name="frame_thickness_select" id="frameThicknessSelect" size="1"
                            style="width: 400px" disabled>
                        <option>Please select a thickness...</option>
                    </select>
                    <input type="hidden" id="oldThickness" value="{{old('frame_thickness_select')}}">
                </div>
            </div>


            {{--            SILL OPTION--}}

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

            {{-- HARDWARE_COLOR_OPTION --}}

            <div class="row flex m-3">
                <div class="col-3" style="text-align: left">
                    Hardware Color Option
                </div>
                <div class="col-4" id="hardwareColorOptionSelectPlaceholder">
                    <select name="hardware_color_option_select" id="hardwareColorOptionSelect" size="1"
                            style="width: 400px" disabled>
                        <option>Please select a Hardware Color Option...</option>
                    </select>
                    <input type="hidden" id="oldhardwareColorOption" value="{{old('hardware_color_option_select')}}">
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

            {{--            NOTES CONTAINER--}}

            <div class="row flex m-3" id="notesContainer">
                <div class="col-3" style="text-align: left">
                    Additional Notes
                </div>
                <div class="col-4" id="">
                                    <textarea class="form-control" style="width:300px;" rows="4"
                                              name="additional_notes">{{old('additional_notes')}}</textarea>
                </div>
            </div>

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
                <div class="customOption addOn-{{$addOn->id}}">
                    <option value="{{$addOn->id}}" class=" addOnOption"
                            id="m-{{$addOn->is_custom_option}}-{{$addOn->door_measurement_id}}-{{$addOn->price}}">{{$addOn->name}}-${{$addOn->price}}</option>
                </div>

            @else
                <div class="addOn-{{$addOn->id}}">
                    <option value="{{$addOn->id}}" class="{{$addOn->group_name}} addOnOption"
                            id="m-{{$addOn->group_name}}-{{$addOn->door_measurement_id}}-{{$addOn->price}}">{{$addOn->name}} -- ${{$addOn->price}}</option>
                </div>
            @endif
        @endforeach

        <div class="colors d-none">
            @foreach($door->doorMeasurements as $dm)
                @foreach($dm->doorFinishPrices as $doorFinishPrice)
                    <option
                        value="{{$doorFinishPrice->interior_color_id}}"
                        class="colorOption"
                        id="finish-{{$dm->id}}-{{$doorFinishPrice->id}}">{{$doorFinishPrice->interiorColor->color}}
                        - ${{$doorFinishPrice->price}}</option>
                @endforeach
            @endforeach
        </div>
    </div>
    @section('scripts')
        <script src="{{ asset('js/shoppingcart/doorcart1.js') }}" defer></script>
        <script>
        </script>
    @stop
</x-app-layout>
