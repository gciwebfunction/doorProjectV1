<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order')  }} {{$product->product_name}}
        </h2>
    </x-slot>

    <div class="container  mt-4" style="min-width: 900px;">
        <h4 class="fw-bold">Configure your product...{{$product->name??''}}</h4>

        <form action="/sc/addObject/{{$product->id}}/{{$shoppingCart->id ?? 0}}" method="POST"
              id="cartItemForm">
            @csrf
            <input type="hidden" id="productId" value="{{$product->id}}">
            <input type="hidden" id="shoppingCartId" value="{{$shoppingCart->id ?? ''}}">
            <input type="hidden" id="addOnOptionCount" value="0">
            <div style="display: grid; grid-template-columns: 1fr 3fr">
                <div class="left-1/3">
{{--                    @php--}}
{{--                          $img_paths = '/storage/'.$product->images()->first()->image_path ?? null ;--}}
{{--                          if(file_exists('/storage/'.$product->images()->first()->image_path)){--}}
{{--                    @endphp--}}
{{--                    --}}{{-- <img src="/storage/{{$product->images()->first()->image_path}}" --}}
{{--                        <img src="/storage/{{$product->images()->first()->image_path}}" style="max-width: 255px">--}}
{{--                    @php--}}
{{--                        }else{--}}
{{--                    @endphp--}}
                    <img src="/storage/dummy.jpg">
{{--                         --}}
{{--                    @php--}}
{{--                    }--}}
{{--                    @endphp--}}
                </div>
                <div class="right-2/3" style="border-left: 1px solid lightgray">
                    <div class="" style="position: fixed; top: 120px; right: 50px; font-weight: bold; z-index: 93822992;
            border: 1px solid lightgray; background-color: lightblue; border-radius: 3px; padding: 2px;">
                        Current Item Price: $ <span id="priceValue">0.00</span>
                    </div>
                    <div class="row p-3 m-3">
                        <div class="col-md-3 ">
                            <label for="productName">Name</label>
                        </div>
                        <div class="col" id="productName">
                            <div class="form-control">{{$product->product_name}}</div>
                        </div>
                    </div>

                    <div class="row p-3 m-3">
                        <div class="col-md-3 ">
                            <label for="productOptionSelect">Product Option</label>
                        </div>
                        <div class="col ">
                            <select name="product_option_select" requried class="form-control" id="productOptionSelect" class="form-select" >
{{--                                    style="width: 400px">--}}
                                <option value="">Select an option...</option>
                                @foreach($product->productOptions as $option)
                                    <option
                                        value="{{$option->id}}">Size: {{$option->option_size}}
                                        Color: {{$option->option_color}} Price :  ${{$option->option_price}}</option>
                                @endforeach
                            </select>
                            @foreach($product->productOptions as $option)
                                <input type="hidden" id="productOptionPrice-{{$option->id}}"
                                       value="{{$option->option_price}}">
                            @endforeach
                        </div>
                    </div>
                    <div class="row p-3 m-3">
                        <div class="col-md-3 ">
                            <label for="quantity">Quantity</label>
                        </div>
                        <div class="col ">
                            <input type="number" class="form-control"  value="1"  min="1"
                                   name="quantity" id="quantity" requried>
                        </div>
                    </div>


                    <div class="row p-3 m-3">
                        <div class="col-md-3 ">
                            <label for="additionalNotes">Additional Notes</label>
                        </div>
                        <div class="col ">
                             <textarea class="form-control" cols="60" rows="4"
                                       name="additional_notes" id="additionalNotes"></textarea>
                        </div>
                    </div>

                    <div class="row p-3 m-3">
                        <div class="col-md-3 ">
                            &nbsp;
                        </div>
                        <div class="col ">
                            <div class="cartButtonDiv" id="addItemToCartButton" style="margin: 0;height: 45px;">
                                <p style="">Add To Cart</p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </form>
    </div>


    @section('scripts')
        <script src="{{ asset('js/shoppingcart/cart1.js') }}" defer></script>
        <script>
        </script>
    @stop
</x-app-layout>
