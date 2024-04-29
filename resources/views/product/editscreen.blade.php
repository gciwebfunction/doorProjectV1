<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Management') }}
        </h2>
    </x-slot>

    <div class="container mt-2">
        <form action="{{route('updateProduct')}}" method="POST" enctype="multipart/form-data" id="productForm">
            @csrf

            <h4 class="text-center">Eidt Prdouct...</h4>
            <hr class="mb-5"/>
            <h4 class="pb-3 fw-bolder">Product Details</h4>
            <hr class="mb-5"/>
            @if($errors->has('general_error'))
                <span class="invalid-feedback" role="alert">
                            <strong>{{$errors->first('general_error')}}</strong>
                        </span>
            @endif

            <input name="product_id" id="productId" type="hidden" value="{{$product->id}}">
            <div class="row p-3 m-3 ">
                <div class="col form-label">
                    Category
                </div>
                <div class="col form-control">
                    {{$product->category->category_name}}
                </div>
            </div>

            <div class="row p-3 m-3 ">
                <div class="col form-label">
                    Product Name
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="product_name" value="{{$product->product_name}}" />
                </div>
            </div>

            <div class="row p-3 m-3 ">

                <div class="col form-label">
                    Part No.
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="part_number" value="{{$product->part_number}}" />
                </div>
            </div>

            <div class="row p-3 m-3 ">

                <div class="col form-label">
                    Product Description
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="prod_description" value="{{$product->prod_description}}" />
                </div>
            </div>

            <div class="row p-3 m-3 ">

                <div class="col form-label">
                    Image
                    @php
                        if($product->image_name){
                    @endphp
                        <img width="150" src="/storage/product_image/{{$product->image_name??0}}" >
                    @php
                        }
                    @endphp
                </div>
                <div class="col">
                    <input type="file" name="main_image" class="form-control"  onchange="readURL(this ,  'main_image_preview');"  >
                    <img id="main_image_preview" src="" width="100px" height="100px" style="display: none;" />
                </div>
            </div>

            <input type="hidden" name="old_main_image" value="{{$product->image_name}}" id="" class="form-control" >



            <div class="container mt-4">

                {{--                       Options --}}

                <h4>Product Options</h4>
                <hr class="mb-5"/>
                <div class="container py-4" id="productOptionContainer">
                    @if(!empty($product->productOptions))
                        @php $count = 0; @endphp
                        <input type="hidden" id="productOptionCount" value="{{ $product->product_options_count }}" name="product_option_count">
                        @foreach($product->productOptions as $key => $options)
                            <div class="p-2 m-2 productOptionContainerTracking" style="border: 1px solid lightgray">
                                <div class=" p-3 m-3 text-center" style="width: 100%">
                                    <h4>Option {{ $count }}</h4>
                                </div>
                                <div class="row p-3 m-3">
                                    <div class="col">
                                        <label for="productOptionSize-0" class="form-label">Size</label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control sizeOption optionFormField" id="productOptionSize-{{ $key }}" value="{{ $options->option_size }}" name="product_option_size-{{ $key }}">
                                    </div>
                                </div>
                                <div class="row p-3 m-3">
                                    <div class="col">
                                        <label for="productOptionColor-0" class="form-label">Color</label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control colorOption optionFormField" id="productOptionColor-{{ $key }}" value="{{ $options->option_color }}" name="product_option_color-{{$key}}">
                                    </div>
                                </div>
                                <div class="row p-3 m-3">
                                    <div class="col">
                                        <label for="productOptionPrice-0" class="form-label">Price</label>
                                    </div>
                                    <div class="col">
                                        <input type="number" class="form-control priceOption optionFormField" id="productOptionPrice-{{ $key }}" value="{{ $options->option_price }}" name="product_option_price-{{$key}}">
                                    </div>
                                </div>
                            </div>
                            @php $count++; @endphp
                        @endforeach
                    @endif
                </div>
                <div class="row p-3 m-3">
                    <div class="col">
                        <button class="btn btn-primary" id="addAnotherOptionButton">Add another option...</button>
                    </div>
                    <div class="col">
                        <button class="btn btn-primary" id="saveProductOptionsButton">Update Product Options</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @section('scripts')
        <script src="{{ asset('js/product/utility2.js') }}" defer></script>
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
        </script>

    @stop
</x-app-layout>