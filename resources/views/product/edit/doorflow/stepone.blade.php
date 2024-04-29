<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a Product') }}
        </h2>
    </x-slot>

    {{--    @php die('sdadsd'); @endphp--}}

    <div class="container py-4">
        <div class="container" style="margin-top: 3px">
            <form class="row g-3" action="/p/editdoorflow/updatestepone" method="POST" enctype="multipart/form-data"
                  id="editProductForm">
                @csrf

                <div style="display: grid; grid-template-columns: 1fr 3fr">
                    <div class="left-1/3" style="margin-right: 2px; padding-right: 1px">
                        <div class="alert alert-success" role="alert">
                            <h2 class="alert-heading"><strong>Edit a Product</strong></h2>
                            <p>Add a new product to the catalog, configure available options.</p>
                            <hr>

                        </div>
                        <div class="col-lg p-3 m-3">
                            <label class="form-label" for="category_id">Category for the product...</label>
                            @if(isset($categories))
                                <input type="hidden" name="category_id" id="hiddenCategoryId" value="0">
                                @if(isset($door->category) && str_contains($door->category->category_name, 'Gliding'))
                                    <input type="hidden" id="isGliding" value="1">
                                @else
                                    <input type="hidden" id="isGliding" value="0">
                                @endif
                                <select type="text" id="categorySelection" name="product_category"
                                        class="form-control" style="min-width: 300px ">
                                    <option value="0">Select a category...</option>
                                    @foreach($categories as $category)
                                        @if(isset($door) && isset($door->category) && $door->category->id==$category->id)
                                            <option selected
                                                    value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @else
                                            <option
                                                    value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            @else
                                <h2>Error loading category data, contact support.</h2>
                            @endif

                        </div>
                    </div>
                    <div class="right-2/3" style="margin-left: 4px; padding-left: 3px;border-left: 1px solid black"
                         id="rightContainer">
                        <div id="errorContainer">
                            @if($errors->has('general_error'))
                                <span class="invalid-feedback" role="alert">
                            <strong>{{$errors->first('general_error')}}</strong>
                        </span>
                                <hr/>
                            @endif
                        </div>

                        <div class="col-lg p-3 m-3 d-none" id="doorTypeListContainer">
                            <label class="form-label" for="door_type" id="subCategoryNameLabel">Sub-category...</label>

                            <select type="text"
                                    @if(!isset($door))
                                    disabled
                                    @endif
                                    id="doorTypesList" name="door_type"
                                    class="form-control" style="min-width: 300px">
                                <option value="-1">Select sub-category...</option>
                                @foreach($doorTypes as $doorType)
                                    @if(isset($door) && isset($door->doorType) && $door->doorType->id==$doorType->id)
                                        <option
                                                class="doorTypeOption doorTypeCategory-{{$doorType->category_id}}"
                                                value="{{$doorType->id}}"
                                                selected>{{$doorType->door_type_pretty_name??''}}</option>
                                    @else
                                        <option
                                                class="doorTypeOption doorTypeCategory-{{$doorType->category_id}}"
                                                value="{{$doorType->id}}">{{$doorType->door_type_pretty_name??''}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="row" id="doorNameContainer">
                            <div class="col-lg p-3 m-3">
                                <label class="form-label" for="doorName" id="doorNameLabel">Product Name or
                                    Identifier</label>
                                @if(isset($door))
                                    <input class="form-control" type="text" value="{{$door->name}}"
                                           id="doorName" name="door_name">
                                @else
                                    <input type="text" value="" class="form-control"
                                           id="doorName" name="door_name">
                                @endif
                            </div>
                        </div>

                        <div class="row" id="doorNameContainer">
                            <div class="col-lg p-3 m-3">
                                <label class="form-label" for="doorName" id="doorNameLabel">Product Main Image</label>
                                <input type="file" name="main_image" id="main_image" class="form-control"

{{--                                       onchange="preview(main_image_preview, 'main_image_preview')"--}}
                                onchange="readURL(this ,  'main_image_preview');"  >
                                <img id="main_image_preview" src="" width="100px" height="100px" style="display: none;" />
                                <input type="hidden" name="old_main_image" value="{{$door->main_image}}" id="" class="form-control" >
                                <img src="/storage/product_image/{{$door->main_image??0}}" >
{{--                                {{$door->main_image}}--}}

                            </div>
                        </div>

                        <div class="row p-3 m-3">
                            <div class="col">
                                <label class="form-label" for="doorPanelCount" id="panelCountLabel">Panel Count</label>
                            </div>
                            <div class="col">
                                <input type="number" name="panel_count" id="doorPanelCount" class="form-control"
                                       value="{{$door->panel_count??0}}">
                            </div>
                        </div>

                        @if(isset($door))
                            @foreach($door->doorNames as $k => $name)
                                <div class="container py-4 ml-3" style="border:1px solid lightgray">
                                    <div class="row">

                                        <div class="col p-1 m-1" id="doorTypeContainer-{{$loop->index}}">
                                            <label class="form-label" for="doorNameType-{{$loop->index}}"
                                                   id="doorNameTypeLabel-{{$loop->index}}">Name or Type (ie.
                                                Inswing)</label>
                                        </div>
                                        <div class="col p-1 m-1">
                                            <input type="text" value="{{$name->door_name_or_type}}"
                                                   id="doorNameType-{{$loop->index}}"
                                                   name="door_name_type-{{$loop->index}}"
                                                   class="form-control productFormElement dataField doorNameType"
                                                   style="min-width: 300px"/>
                                            <input type="hidden" name="door_name_type_id[]"
                                                   value="{{$name->door_name_or_type}}">
                                            <input type="hidden" name="door_name_id-{{$loop->index}}"
                                                   value="{{$name->id}}">
                                        </div>

                                    </div>
                                    <div class="row ml-3">
                                        <div class="col p-3 m-3">
                                            <p class="bolder" style="text-align: center">Current Image</p>
                                            <img src="/storage/product_image/{{$name->image->image_path}}"
                                                 style="max-width: 255px ">
                                            <input type="hidden" name="old_image_id-{{$loop->index}}"
                                                   value="{{$name->image->id}}">
                                            <input type="hidden" name="old_image_name-{{$loop->index}}"
                                                   value="{{$name->image->image_path}}">
                                        </div>

                                        <div class="col p-3 m-3">
                                            <input type="file"
                                                   style="margin-left: 20px;"
                                                   name="door_type_image-{{$loop->index}}"
                                                   aria-describedby="doorTypeImage"
                                                   id="door_type_image-{{$loop->index}}"
                                                   class="form-control-file img-fluid border rounded-3 shadow-lg"
                                            onchange="readURL(this ,  'imagess_{{$loop->index}}');"  >

                                            <img id="imagess_{{$loop->index}}" src="" width="100px" height="100px" style="display: none;" />


                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-lg p-3 m-3" id="doorTypeContainer-0">
                                <label class="form-label" for="doorNameType-0" id="doorNameTypeLabel-0">Name or Type
                                    (ie.
                                    Inswing)</label>
                                <input type="text" disabled
                                       id="doorNameType-0" name="door_name_type-0"
                                       class="form-control productFormElement dataField" style="min-width: 300px"/>
                            </div>
                            <div class="col-lg p-3 m-3" id="doorTypeImageContainer-0">
                                <label class="form-label" for="doorNameType" id="doorNameTypeLabel">
                                    Add Image for Type
                                </label>
                                <input type="file"
                                       style="margin-left: 20px;"
                                       name="door_type_image-0"
                                       aria-describedby="doorTypeImage"
                                       id="door_type_image-0"
                                       class="form-control-file"
                                       onchange="readURL(this, 'image_222')"
                                >
                                <img id="image_222" src="" width="100px" height="100px" style="display: none;" />

                                @if($errors->has('category_image'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('door_type_image-0')}}</strong>
                                    </span>
                                @endif
                            </div>
                        @endif

                        <div id="addTypeContainer"></div>

                        <div class="col-lg p-3 m-3" id="addTypeAndImageButtonContainer">
                            <div class="col-lg p-3 m-3 text-center " style="margin-right: 20px">
                                <button class="btn btn-primary mb-3" id="addTypeAndImageDivButton" style="visibility:hidden">
                                    Add Another Type
                                </button>
                            </div>
                            <input type="hidden" id="typeCount" name="type_count" value="{{$typeCount ?? 0}}">
                        </div>
                    </div>

                </div>
                <div class="">
                    <hr/>
                    <input type="hidden" id="doorHandlingCount" value="{{$doorHandlingCount ?? 0}}"
                           name="door_handling_count">
                    <input type="hidden" id="colorCount" value="{{$colorCount ?? 0}}" name="color_count">
                    <input type="hidden" id="frameOptionCount" value="{{$doorFrameCount ?? 0}}"
                           name="frame_option_count">
                    <input type="hidden" id="doorMeasurementsCount" name="door_measurement_count"
                           value="{{$doorMeasurementCount ?? 0}}">
                    <input type="hidden" id="doorId" name="door_id" value="{{$door->id}}">

                    @csrf

                    <div>
                        <div id="errorContainer">
                            @if($errors)
                                @foreach($errors as $error)
                                    <span class="invalid-feedback" role="alert">
                            <strong>{{$error}}</strong>
                        </span>
                                    <hr/>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    @if(isset($door->category) && !str_contains($door->category->category_name, 'Gliding'))
                        <div>
                            <div class="p-1 m-1" id="doorHandlingContainer">
                                <label>Door Handling (ie. L Left Hand Opening)</label><br/>
                                @foreach($door->doorHandlings as $h)
                                    <input class="form-control  dataField doorHandlingClass" type="text" size="70"
                                           name="doorhandling-{{$loop->index}}"
                                           id="doorhandling-{{$loop->index}}"
                                           placeholder="Door Handling"
                                           value="{{$h->handling}}">
                                    <input type="hidden" class="hiddenHandlingId"
                                           name="doorhandling_id-{{$loop->index}}"
                                           value="{{$h->id}}">
                                    <p class="ml-10 handlingDelete"
                                       style="text-transform: capitalize;font-size: small;font-weight: bold;color: red;cursor:pointer;"
                                       id="doorhandling-delete-{{$loop->index}}-{{$h->id}}">
                                        Delete</p>
                                @endforeach
                            </div>
                            <div class="col-lg p-3 m-3 text-center " style="margin-right: 20px">
                                <button class="btn btn-primary mb-3" id="addDoorHandlingButton">
                                    Add another door handling
                                </button>
                            </div>
                        </div>
                    @endif
                    <div id="sizeContainer">
                        <div class="col-lg p-1 m-1" id="measurementContainer">
                            <label>Size Options W/H</label><br/>
                            @foreach($door->doorMeasurements as $m)
                                <input type="hidden" class="hiddenMeasurementId" name="measurement_id-{{$loop->index}}"
                                       value="{{$m->id}}">
                                <input class="form-control-sm dataField doorMeasurementClass" type="text"
                                       name="width-{{$loop->index}}"
                                       placeholder="Width" id="doorWidthMeasurement-{{$loop->index}}"
                                       value="{{$m->width}}">
                                <input class="form-control-sm dataField doorMeasurementHeightClass" type="text"
                                       name="height-{{$loop->index}}"
                                       placeholder="Height" id="doorHeightMeasurement-{{$loop->index}}"
                                       value="{{$m->height}}">
                                <p class=" ml-10 measurementDelete" style="text-transform: capitalize;font-size: small;font-weight: bold;color: red;
                                cursor:pointer;"
                                   id="doorMeasurements-delete-{{$loop->index}}-{{$m->id}}">
                                    Delete</p>
                            @endforeach
                        </div>
                        <div class="col-lg p-3 m-3 text-center " style="margin-right: 20px">
                            <button class="btn btn-primary mb-3" id="addSizeButton">
                                Add another size
                            </button>
                        </div>
                    </div>

                    @if(isset($door->category) && !str_contains($door->category->category_name, 'Gliding'))
                        <div id="frameContainer">
                            <div class="col-lg p-3 m-3" id="frameContainer-0">
                                <label>Frame Options (ie. Knocked Down, Fully Assembled)</label><br/>
                                @foreach($door->doorFrames as $f)


                                    <input class="form-control-sm dataField doorFrameClass" size="70" type="text"
                                           name="frame-{{$loop->index}}"
                                           id="frame-{{$loop->index}}"
                                           placeholder="Frame Option" value="{{$f->frame}}">
                                    <input type="hidden" class="hiddenFrameId"
                                           name="door_frame_option_id-{{$loop->index}}"
                                           value="{{$f->id}}">
                                    <p class=" ml-10 doorFrameDelete" style="text-transform: capitalize;font-size: small;font-weight: bold;color: red;
                                cursor:pointer;"
                                       id="doorFrame-delete-{{$loop->index}}-{{$f->id}}">
                                        Delete</p>
                                @endforeach
                            </div>

                            <div id="addFrameContainer"></div>

                            <div class="col-lg p-3 m-3 text-center " style="margin-right: 20px">
                                <button class="btn btn-primary mb-3" id="addFrameOptionButton">
                                    Add another Frame Option
                                </button>
                            </div>
                        </div>
                    @endif

                    <div id="colorContainer">
                        <div class="col-lg p-3 m-3" id="colorContainer-0">
                            <label>Finish/Color (ie. Unstained Wood Grain Both Sides)</label><br/>

                            @foreach($door->interiorColors as $c)


                                <input class="form-control-sm dataField colorClass" size="70" type="text"
                                       name="color-{{$loop->index}}"
                                       id="color-{{$loop->index}}"
                                       placeholder="Finish/Color" value="{{$c->color}}">
                                <input type="hidden" class="hiddenColorId" name="color_id-{{$loop->index}}"
                                       id="hiddenColorId-{{$loop->index}}" value="{{$c->id}}">
                                <p class=" ml-10 colorDelete" style="text-transform: capitalize;font-size: small;font-weight: bold;color: red;
                                cursor:pointer;"
                                   id="doorColor-delete-{{$loop->index}}-{{$c->id}}">
                                    Delete</p>
                            @endforeach
                        </div>

                        <div id="addColorContainer"></div>
                        <div class="col-lg p-3 m-3 text-center " style="margin-right: 20px">
                            <button class="btn btn-primary mb-3" id="addColorButton">
                                Add another Finish/Color
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="" style=";text-align: right; margin-top: 5px; padding-top: 2px;">
        <div class="alert alert-warning" role="alert" style="; margin: 5px auto 0; text-align: right">
            <div class="row">
                <div class="col-sm" style="text-align: right;">
                    <div class="text-end " style="margin-right: 20px">
                        <button class="btn btn-primary mb-3" id="submitEditButton"> Continue...
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="height: 50px"></div>

    <div class="d-none">
        @foreach($categories as $category)
            <div class="categoryValuesHidden">
                {{$category->id}},{{ $category->category_name }}
            </div>
        @endforeach
    </div>
    @section('scripts')
        <script src="{{ asset('js/product/door/editutility1.js') }}" defer></script>
        <script>

        function readURL(input , jquery_id) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#'+jquery_id)
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
                $('#'+jquery_id).show();
            }
        }


        function preview(idd, jquery_id) {
            //alert(idd)
            //frame.src=URL.createObjectURL(event.target.files[0]);
            //URL.createObjectURL(event.target.files[0]) = '';
            idd.src= '';
            idd.src=URL.createObjectURL(event.target.files[0]);
            $('#'+jquery_id).show();
        }
        </script>

    @stop
</x-app-layout>
