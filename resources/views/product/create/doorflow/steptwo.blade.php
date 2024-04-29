<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a Product') }}
        </h2>
    </x-slot>

    <div class="container py-4">

        <div class="container" style="margin-top: 3px">
            <form class="row g-3" action="/p/doorflow/two" method="POST" enctype="multipart/form-data"
                  id="productDetailsForm">
                <input type="hidden" id="sizeCount" value="1" name="size_count">

                @if(!$door->isGliding())
                    @if($doorHandlingCount > 0)
                        <input type="hidden" id="doorHandlingCount" value="{{$doorHandlingCount}}"
                               name="door_handling_count">
                    @else
                        <input type="hidden" id="doorHandlingCount" value="1" name="door_handling_count">
                    @endif
                    @if($doorFrameCount > 0)
                        <input type="hidden" id="frameOptionCount" value="{{$doorFrameCount}}"
                               name="frame_option_count">
                    @else
                        <input type="hidden" id="frameOptionCount" value="1" name="frame_option_count">
                    @endif
                    <input type="hidden" id="isGliding" value="false">
                @else
                    <input type="hidden" id="isGliding" value="true">
                @endif

                @if($colorCount > 0)
                    <input type="hidden" id="colorCount" value="{{$colorCount}}" name="color_count">
                @else
                    <input type="hidden" id="colorCount" value="1" name="color_count">
                @endif

                <input type="hidden" id="doorId" name="door_id" value="{{$door->id}}">

                @csrf

                <div style="display: grid; grid-template-columns: 1fr 3fr">
                    <div class="left-1/3" style="margin-right: 2px; padding-right: 1px">
                        <div class="alert alert-success" role="alert">
                            <h2 class="alert-heading"><strong>Product - {{$door->name}}</strong></h2>
                            <p>Add additional details about a product.</p>
                            <hr>

                        </div>
                    </div>
                    <div class="right-2/3">

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


                        <div class="container py-4">
                            <h5>Measurements</h5>
                            <div id="sizeContainer">
                                <div class="row  p-1 m-1 measurementRow">
                                    <div class="col" id="measurement-0">
                                        <label>Size Option W/H</label>
                                    </div>
                                    <div class="col">
                                        <input class="form-control dataField widthDatafield" type="text"
                                               name="width-0" id="width-0"
                                               placeholder="Width">
                                    </div>
                                    <div class="col">
                                        <input class="form-control dataField heightDatafield" type="text"
                                               name="height-0" id="height-0"
                                               placeholder="Height">
                                    </div>
                                    <div class="col-1"></div>
                                </div>
                            </div>
                            <div>
                                <div class="row p-1 m-1">
                                    <div class="col text-center">
                                        <button class="button-gci" id="addSizeButton">Add another size.</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="container py-4">
                            <h5>Finish/Colors (ie. Unstained Wood Grain Both Sides)</h5>
                            <div id="colorContainer">
                                <div class="row p-1 m-1 colorRow">
                                    <div class="col">
                                        <label>Finish/Color</label>
                                    </div>
                                    <div class="col">
                                        <input class="form-control dataField colorDatafield" type="text" name="color-0"
                                               placeholder="Finish/Color">
                                    </div>
                                    <div class="col-1"></div>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <div class="row p-1 m-1">
                                        <div class="col text-center">
                                            <button class="button-gci" id="addColorButton">Add another Finish/Color.
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if(!$door->isGliding())
                            <div id="doorHandlingContainer">
                                @if($doorHandlingCount > 0)
                                    @foreach($door->doorHandlings as $h)
                                        <div class="p-3 m-3" id="doorhandling-{{$loop->index}}">
                                            <label>Door Handling (ie. L Left Hand Opening)</label><br/>
                                            <input class="form-control  dataField" type="text" size="70"
                                                   name="doorhandling-{{$loop->index}}"
                                                   placeholder="Door Handling"
                                                   value="{{$h->handling}}">
                                            </td>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="p-3 m-3" id="doorhandling-0">
                                        <label>Door Handling (ie. L Left Hand Opening)</label><br/>
                                        <input class="form-control  dataField" type="text" size="70"
                                               name="doorhandling-0"
                                               placeholder="Door Handling">
                                        </td>
                                    </div>

                                @endif
                                <div class="col-lg p-3 m-3">
                                    <button class="button-gci" id="addDoorHandlingButton">Add another door handling.
                                    </button>
                                </div>
                            </div>
                            <div class="container">
                                <h5>Frames</h5>
                                <div id="frameContainer">
                                    <div class="col-lg p-3 m-3" id="frame-0">
                                        <label>Frame Options (ie. Knocked Down, Fully Assembled)</label><br/>
                                        <input class="form-control-sm dataField" size="70" type="text" name="frame-0"
                                               placeholder="Frame Option">
                                    </div>

                                    <div class="col-lg p-3 m-3">
                                        <button class="button-gci" id="addFrameOptionButton">Add another Frame Option.
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif

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

    @section('scripts')
        <script src="{{ asset('js/product/door/utility2.js') }}" defer></script>
    @stop
</x-app-layout>
