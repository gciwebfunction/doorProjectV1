<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order')  }} {{$door->doorType->door_type_pretty_name}}
        </h2>
    </x-slot>

    <div class="container  mt-4" style="min-width: 900px;">
        <h4 class="fw-bold">Configure your product...</h4>

        <form action="/sc/addObject/{{$door->id}}/{{$shoppingCarts->first()->id ?? 0}}" method="POST"
              id="cartItemForm">
            @csrf
            <input type="hidden" id="productId" value="{{$door->id}}">
            <input type="hidden" id="shoppingCartId" value="{{$shoppingCart->id ?? ''}}">

            <div class="sticky-sm-top" style="text-align: right">
                Current Item Price: $ <span id="priceValue">0.00</span>
            </div>

            <div class="row flex">
            @foreach($door->doorNames as $n)
                <div class="col-5" style="border: 2px solid black; cursor: pointer">
                    <img src="/storage/{{$n->image->image_path}}"
                         style="max-width: 255px">
                    <p style="text-align: center" class="fw-bolder">{{$n->door_name_or_type}}</p>
                </div>
            @endforeach
            </div>


            <div class="row flex m-3">
                <div class="col-3" style="text-align: center">
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
                </div>
            </div>
            <div class="row flex m-3">
                <div class="col-3" style="text-align: center">
                    Door Handling
                </div>
                <div class="col-4">
                    <select name="door_handling_select" id="doorHanldingSelect" size="1"
                            style="width: 400px">
                        <option value="">Select a handling option...</option>
                        @foreach($door->doorHandlings as $dh)
                            <option value="{{$dh->id}}">{{$dh->handling}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row flex m-3">
                <div class="col-3" style="text-align: center">
                    Door Frame
                </div>
                <div class="col-4">
                    <select name="door_handling_select" id="doorHanldingSelect" size="1"
                            style="width: 400px">
                        <option value="">Select a frame option...</option>
                        @foreach($door->doorFrames as $df)
                            <option value="{{$df->id}}">{{$df->frame}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row flex m-3">
                <div class="col-3" style="text-align: center">
                    Color
                </div>
                <div class="col-4">
                    <select name="door_color_select" id="doorColorSelect" size="1"
                            style="width: 400px">
                        <option value="">Select a color option...</option>
                        @foreach($door->interiorColors as $ic)
                            <option value="{{$ic->id}}">{{$ic->color}}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="row flex m-3">
                <div class="col-3" style="text-align: center">
                    Glass Grid
                </div>
                <div class="col-4">
                    <select name="glass_grid_select" id="glassGridSelect" size="1"
                            style="width: 400px">
                        <option value="">Select a glass grid option...</option>
                        @foreach($door->additionalOptions as $addOn)
                            @if($addOn->group_name == "GLASS_GRID")
                                <option value="{{$addOn->id}}">{{$addOn->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row flex m-3">
                <div class="col-3" style="text-align: center">
                    Glass Options
                </div>
                <div class="col-4">
                    <select name="glass_grid_select" id="glassGridSelect" size="1"
                            style="width: 400px">
                        <option value="">Select additional glass option...</option>
                        @foreach($door->additionalOptions as $addOn)
                            @if($addOn->group_name == "GLASS_GRID")
                                <option value="{{$addOn->id}}">{{$addOn->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>



            <div class="row flex m-3" id="notesContainer">
                <div class="col-3" style="text-align: center">
                    Additional Notes
                </div>
                <div class="col-4" id="">
                                    <textarea class="form-control" style="width:300px;" rows="4"
                                              name="additionalNotes"></textarea>
                </div>
            </div>
            <div class="cartButtonDiv" id="addItemToCartButton">
                <p style="">Add To Order</p>
            </div>
        </form>
    </div>


    @section('scripts')
        <script src="{{ asset('js/shoppingcart/cart1.js') }}" defer></script>
        <script>
        </script>
    @stop
</x-app-layout>
