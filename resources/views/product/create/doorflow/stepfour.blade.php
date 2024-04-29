<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a Product') }}
        </h2>
    </x-slot>
    <div class="container py-4">
        <div class="container" style="margin-top: 3px">
            <form class="row g-3" action="/p/doorflow/four" method="POST" enctype="multipart/form-data"
                  id="additionalOptionsForm">
                <input type="hidden" value="{{$door->id}}" name="door_id" id="doorId">

                @csrf

                <div style="display: grid; grid-template-columns: 1fr 3fr">
                    <div class="left-1/3" style="margin-right: 2px; padding-right: 1px">
                        <div class="alert alert-success" role="alert">
                            <h2 class="alert-heading"><strong>Product</strong></h2>
                            <p>Add Door Options. If no option, type 'NONE'</p>
                            <hr>
                        </div>
                    </div>
                    <div class="right-2/3 ml-3 pl-1">
                        <div class="" id="glassOption">
                            <div class="row">
                                <div class="col-lg p-1 m-1">
                                    <h5 class="bold underline">Create Glass Options (ie. Insulated, Laminated):</h5>
                                </div>
                                <input type="hidden" value="1" name="glass_option_count" value="1"
                                       id="glassOptionCount">
                            </div>
                            <div class="row flex">

                                <div class="col-4 p-1 m-1 small">
                                    Add prices?
                                </div>
                                <div class="col-1 p-1 m-1">
                                    <input type="checkbox" name="glass_option_has_prices" id="glassOptionHasPrices">
                                </div>
                            </div>
                            <div class="row flex">
                                <div class="col-4 p-1 m-1">
                                    Glass Option
                                </div>
                                <div class="col-6 p-1 m-1">
                                    <input class="form-control dataField" type="text" value="" size="60"
                                           placeholder="Glass Option"
                                           name="glass_option-0" id="glass_option-0">
                                </div>
                            </div>
                            <div class="" id="newGlassOptionRows">
                            </div>
                            <div class="row">
                                <div class="col-lg p-1 m-1">
                                    <button class="btn btn-primary" id="addGlassOptionButton">Add additional glass
                                        option.
                                    </button>
                                </div>
                            </div>
                            <hr/>
                        </div>
                        <div class="" id="customGlassOptions">
                            <div class="row">
                                <div class="col-lg p-1 m-1">
                                    <h5 class="bold underline">Add a custom glass option?</h5>
                                </div>
                                <input type="hidden" value="0" name="custom_glass_option_count"
                                       id="customGlassOptionCount">
                            </div>
                            <div class="row flex">
                                <div class="col">
                                    <button class="btn btn-primary" id="createGlassOptionButton">Create...</button>
                                </div>
                            </div>
                            <div class="container py-4" id="newCustomGlassOptionsPlaceholder">

                            </div>
                            <hr/>
                        </div>
                        <div class="" id="glassDepthOption">
                            <div class="row">
                                <div class="col-lg p-1 m-1">
                                    <h5 class="bold underline">Create Glass (Depth) Option:</h5>
                                </div>
                                <input type="hidden" value="1" name="glass_depth_count" value="1" id="glassDepthCount">
                            </div>
                            <div class="row flex">

                                <div class="col-4 p-1 m-1 small">
                                    Add prices?
                                </div>
                                <div class="col-1 p-1 m-1">
                                    <input type="checkbox" name="glassDepthHasPrices" id="glassDepthHasPrices">
                                </div>
                            </div>
                            <div class="row flex">
                                <div class="col-4 p-1 m-1">
                                    Glass (Depth) Option
                                </div>
                                <div class="col-6 p-1 m-1">
                                    <input class="form-control dataField" type="text" value="" size="60"
                                           placeholder="Glass (Depth) Option" name="glass_depth_option-0"
                                           id="glass_depth_option-0">
                                </div>
                            </div>
                            <div class="" id="newGlassDepthRows">
                            </div>
                            <div class="row">
                                <div class="col-lg p-1 m-1">
                                    <button class="btn btn-primary" id="addGlassDepthOptionButton">Add additional glass
                                        (depth)
                                        option.
                                    </button>
                                </div>
                            </div>
                            <hr/>
                        </div>
                        <div class="" id="handleOption">
                            <div class="row">
                                <div class="col-lg p-1 m-1">
                                    <h5 class="bold underline">Create Handle Type Option:</h5>
                                </div>

                                <input type="hidden" value="1" name="handle_type_count" value="1" id="handleTypeCount">
                            </div>
                            <div class="row flex">
                                <div class="col-4 p-1 m-1">
                                    Handle Type Option
                                </div>

                                <div class="col-6 p-1 m-1">
                                    <input class="form-control dataField" type="text" value="" size="60"
                                           placeholder="Handle Type Option" name="handle_type_option-0"
                                           id="handle_type_option-0">
                                </div>
                            </div>
                            <div class="row flex">
                                <div class="col-4 m-1 p-1">
                                    <label for="handleTypeImage" class="form-label">Handle Type Picture</label>
                                </div>
                                <div class="col-5 m-1 p-1">
                                    <input type="file"
                                           name="handle_type_option_image-0"
                                           aria-describedby="handleTypeImage"
                                           id="handleTypeImage-0"
                                           class="form-control-file">
                                </div>
                            </div>
                            <div class="" id="newHandleRows">
                            </div>
                            <div class="row">
                                <div class="col-lg p-1 m-1">
                                    <button class="btn btn-primary" id="addHandleTypeOptionButton">Add additional handle
                                        type
                                        option.
                                    </button>
                                </div>
                            </div>
                            <hr/>
                        </div>
                        <div class="" id="lockSetOption">
                            <div class="row">
                                <div class="col-lg p-1 m-1">
                                    <h5 class="bold underline">Create Lock Set Option:</h5>
                                </div>
                                <input type="hidden" value="1" name="lock_set_count" value="1" id="lockSetCount">
                            </div>
                            <div class="row flex">
                                <div class="col-4 p-1 m-1">
                                    Lock Set Option
                                </div>
                                <div class="col-6 p-1 m-1">
                                    <input class="form-control dataField" type="text" value="" size="60"
                                           placeholder="Lock Set Option" name="lock_set_option-0"
                                           id="lock_set_option-0">
                                </div>
                            </div>
                            <div class="row flex">
                                <div class="col-4 m-1 p-1">
                                    <label for="lockSetImage" class="form-label">Lock Set Picture</label>
                                </div>
                                <div class="col-5 m-1 p-1">
                                    <input type="file"
                                           name="lock_set_option_image-0"
                                           aria-describedby="lockSetImage"
                                           id="lockSetImage-0"
                                           class="form-control-file">
                                </div>
                            </div>
                            <div class="" id="newLockSetRow">
                            </div>
                            <div class="row">
                                <div class="col-lg p-1 m-1">
                                    <button class="btn btn-primary" id="addLockSetOptionButton">Add additional lock set
                                        option.
                                    </button>
                                </div>
                            </div>
                            <hr/>
                        </div>

                        <div class="" id="frameThicknessOptionContainer">
                            <div class="row">
                                <div class="col-lg p-1 m-1">
                                    <h5 class="bold underline">Create Frame Thickness Option:</h5>
                                </div>
                                <input type="hidden" value="1" name="frame_thickness_count" value="1"
                                       id="frameThicknessCount">
                            </div>
                            <div class="row flex">

                                <div class="col-4 p-1 m-1 small">
                                    Add prices?
                                </div>
                                <div class="col-1 p-1 m-1">
                                    <input type="checkbox" name="frameThicknessHasPrices" id="frameThicknessHasPrices">
                                </div>
                            </div>
                            <div class="row flex">
                                <div class="col-4 p-1 m-1">
                                    Frame Thickness Option
                                </div>
                                <div class="col-6 p-1 m-1">
                                    <input class="form-control dataField" type="text" value="" size="60"
                                           placeholder="Frame Thickness Option" name="frame_thickness_option-0"
                                           id="frame_thickness_option-0">
                                </div>
                            </div>
                            <div class="" id="newFrameThicknessRows">
                            </div>
                            <div class="row">
                                <div class="col-lg p-1 m-1">
                                    <button class="btn btn-primary" id="addFrameThicknessOptionButton">Add additional
                                        frame
                                        thickness
                                        option.
                                    </button>
                                </div>
                            </div>
                            <hr/>
                        </div>

                        <input type="hidden" id="customOptionCount" name="custom_option_count" value="0">

                        <div class="" id="addNewOptions">
                            <div class="row">
                                <div class="col-lg p-1 m-1">
                                    <h5 class="bold underline">Do you want to add a custom option?</h5>
                                </div>
                            </div>
                            <div class="row flex">
                                <div class="col-4">
                                    <button class="btn btn-primary" id="addCustomOptionButton">Add custom option...
                                    </button>
                                </div>
                            </div>
                            <hr/>
                            <div id="customOptionContainer">

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row bottom-button-bar" role="alert">
        <div class="col">
            <button class="btn btn-primary" id="continueButton">Continue...</button>
        </div>
    </div>
    <div class="d-none">

    </div>
    @section('scripts')
        <script src="{{ asset('js/product/door/utility4.js') }}" defer></script>
    @stop
</x-app-layout>
