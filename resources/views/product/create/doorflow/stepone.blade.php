<x-app-layout>
    <x-slot name="header">
        {{ __('Create a Product') }}
    </x-slot>

    <div class="container py-4">
        <h4 class="text-center">Product Creation</h4>
        <div id="errorContainer">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <hr/>
        <form class="row g-3" action="/p/doorflow/one" method="POST" enctype="multipart/form-data"
              id="addProductForm">
            @csrf

            <input type="hidden" value="1" id="optionalSelectCount" name="optional_select_count">

            <div style="display: grid; grid-template-columns: 1fr 3fr">
                <div class="left-1/3" style="margin-right: 2px; padding-right: 1px">
                    <div class="alert alert-success" role="alert">
                        <h2 class="alert-heading"><strong>Create a Product</strong></h2>
                        <p>Add a new product to the catalog, configure available options.</p>
                        <hr>

                    </div>
                    <div class="col-lg p-3 m-3">
                        <label class="form-label" for="category_id">Category for the product...</label>
                        @if(isset($categories))
                            <select type="text" id="categorySelection" name="product_category"
                                    class="form-control" style="min-width: 300px ">
                                <option value="0">Select a category...</option>
                                @foreach($categories as $category)
                                    @if(isset($door) && $door->category->id==$category->id)
                                        <option selected
                                                value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @elseif(old('product_category')==$category->id)
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
                <div class="right-2/3 d-none" id="doorProductContainer"
                     style="margin-left: 4px; padding-left: 3px;border-left: 1px solid black"
                     id="rightContainer">

                    <div id="doorTypeListContainer">
                        <div class="row p-1 m-1">
                            <div class="col">
                                <label class="form-label" for="door_type"
                                       id="subCategoryNameLabel">Sub-category...</label>
                            </div>
                        </div>
                        <div class="row p-1 m-1">
                            <div class="col">
                                <input type="text" list="subCatList"
                                       @if(!isset($door))
                                       disabled
                                       @endif
                                       id="doorTypesList" name="door_type"
                                       class="form-control" style="min-width: 300px">
                                <datalist id="subCatList">
                                    @foreach($doorTypes as $doorType)
                                        @if(isset($door) && $door->doorType->id==$doorType->id)
                                            <option
                                                class="doorTypeOption doorTypeCategory-{{$doorType->category_id}}"
                                                value="{{$doorType->door_type_pretty_name}}"
                                                selected>{{$doorType->door_type_pretty_name}}</option>
                                        @else
                                            <option
                                                class="doorTypeOption doorTypeCategory-{{$doorType->category_id}}"
                                                value="{{$doorType->door_type_pretty_name}}">{{$doorType->door_type_pretty_name}}</option>
                                        @endif
                                    @endforeach
                                </datalist>
                            </div>
                        </div>
                    </div>

                    <div id="additionalDoorSpecifierContainer">

                        <div class="row p-1 m-1">
                            <div class="col">
                                <label class="form-label" for="doorName" id="doorNameLabel">Product Main Image</label>
                                <input type="file" name="main_image" id="main_image" class="form-control" onchange="readURL(this ,  'main_image_preview');">
                                <img id="main_image_preview" src="" style="display: none;" width="100px" height="100px">
                            </div>
                        </div>

                        <div class="row p-1 m-1">
                            <div class="col">
                                <label class="form-label" for="additionalDoorSpec" id="subCategoryNameLabel">Optional
                                    Select
                                    (ie.
                                    Full Lite)...</label>
                            </div>
                        </div>
                        <div class="row p-1 m-1">
                            <div class="col">
                                <input type="text" id="additionalDoorSpec-0" name="additional_door_spec-0" disabled
                                       class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg p-1 m-1" id="additionalDoorSpecifierButtonContainer">
                        <button class="btn btn-primary" id="addSpecifierInputField" disabled>Add another optional
                            selection
                        </button>
                    </div>
                    <div id="doorNameContainer">

                        <div class="row p-1 m-1">
                            <div class="col">

                                <label class="form-label" for="doorName" id="doorNameLabel">Product Name or
                                    Identifier</label>
                            </div>
                        </div>
                        <div class="row p-1 m-1">
                            <div class="col">
                                @if(isset($door))
                                    <input type="text" value="{{$door->name}}" class="form-control"
                                           id="doorName" name="door_name">
                                @else
                                    <input type="text" value="" class="form-control"
                                           id="doorName" name="door_name">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row p-1 m-1">
                        <div class="col">
                            <label class="form-label" for="doorPanelCount" id="panelCountLabel">Panel Count</label>
                        </div>
                    </div>
                    <div class="row p-1 m-1">
                        <div class="col">
                            <input type="number" name="panel_count" id="doorPanelCount" class="form-control"
                                   value="{{$door->panel_count??1}}">
                        </div>
                    </div>
                    @if(isset($door))
                        @foreach($door->doorNames as $name)
                            <div class="col-lg p-1 m-1" id="doorTypeContainer-{{$loop->index}}">
                                <label class="form-label" for="doorNameType-{{$loop->index}}"
                                       id="doorNameTypeLabel-{{$loop->index}}">Name or Type (ie.
                                    Inswing or XO, XOOX)</label>
                                <input type="text" value="{{$name->door_name_or_type}}"
                                       id="doorNameType-{{$loop->index}}" name="door_name_type-{{$loop->index}}"
                                       class="form-control productFormElement dataFieldDoorProduct"
                                       style="min-width: 300px"/>
                            </div>
                        @endforeach
                    @else
                        <div class="col-lg p-1 m-1" id="doorTypeContainer-0">
                            <label class="form-label" for="doorNameType-0" id="doorNameTypeLabel-0">Name or Type (ie.
                                Inswing or XO, XOOX)</label>
                            <input type="text"
                                   id="doorNameType-0" name="door_name_type-0"
                                   class="form-control productFormElement dataFieldDoorProduct"
                                   style="min-width: 300px"/>
                        </div>
                        <div class="col-lg p-1 m-1" id="doorTypeImageContainer-0">
                            <label class="form-label" for="doorNameType" id="doorNameTypeLabel">
                                Add Image for Type
                            </label>
                            <input type="file"
                                   style="margin-left: 20px;"
                                   name="door_type_image-0"
                                   aria-describedby="doorTypeImage"
                                   id="door_type_image-0"
                                   class="form-control-file"  onchange="readURL(this ,  'main_image_preview11');"
                            >
                            <img id="main_image_preview11" src="" width="100px" height="100px" style="display: none;" />
                            @if($errors->has('category_image'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('door_type_image-0')}}</strong>
                                    </span>
                            @endif
                        </div>
                    @endif
                    <div id="addTypeContainer" class="col-lg p-3 m-3"></div>
                    <div class="col-lg p-1 m-1" id="addTypeAndImageButtonContainer">
                        <button class="btn btn-primary" id="addTypeAndImageDivButton"
                                disabled>Add Another Type
                        </button>
                        <input type="hidden" id="typeCount" name="type_count" value="1">
                    </div>

                </div>
                <div class="right-2/3 d-none" id="otherProductContainer"
                     style="margin-left: 4px; padding-left: 3px;border-left: 1px solid black"
                     id="rightContainer">
                    <div class="row p-3 m-3">
                        <div class="col">
                            <label class="form-label" for="otherProductName">Product Name</label>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control dataFieldOtherProduct" name="product_name">
                        </div>
                    </div>
                    <div class="row p-3 m-3">
                        <div class="col">
                            <label class="form-label" for="otherProductImage">Product Image</label>
                        </div>
                        <div class="col">
                            <input type="file"
                                   style="margin-left: 20px;"
                                   name="other_product_image"
                                   aria-describedby="otherProductImage"
                                   id="otherProductImage"
                                   class="form-control-file"
                                   onchange="readURL(this ,  'main_image_preview');"  >
                                <img id="main_image_preview" src="" width="100px" height="100px" style="display: none;" />
                        </div>
                    </div>
                    <div class="row p-3 m-3">
                        <div class="col">
                            <label class="form-label" for="productDescription">Product Description</label>
                        </div>
                        <div class="col">
                            <textarea cols="40" rows="5" class="form-control" name="product_description" id="productDescription"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="row bottom-button-bar" role="alert">
        <div class="col">
            <button class="btn btn-primary" id="continueButton"> Continue...</button>
        </div>
    </div>

    <div style="height: 50px"></div>

    <div class="d-none">
        @foreach($categories as $category)
            <div class="categoryValuesHidden">
                {{$category->id}},{{ $category->category_name }}
            </div>
            <input type="hidden" id="categoryTypeHolder-{{$category->id}}" value="{{$category->type}}">
        @endforeach
    </div>
    @section('scripts')
        <script src="{{ asset('js/product/door/utility1.js') }}" defer></script>
        <script>
        // function readURL(input , jquery_id) {
        //     if (input.files && input.files[0]) {
        //     var reader = new FileReader();
        //     reader.onload = function (e) {
        //     $('#'+jquery_id)
        //     .attr('src', e.target.result);
        //     };
        //     reader.readAsDataURL(input.files[0]);
        //     $('#'+jquery_id).show();
        //     }
        // }
        </script>
    @stop
</x-app-layout>
