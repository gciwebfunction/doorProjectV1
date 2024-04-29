<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Management') }}
        </h2>
    </x-slot>

    <div class="container mt-2">
        <form action="/p/flow/two" method="POST" enctype="multipart/form-data" id="productForm">
            @csrf

            <h4 class="text-center">Creating a new product...</h4>
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
                <div class="col form-control">
                    {{$product->product_name}}
                </div>
            </div>

            <div class="row p-3 m-3 ">

                <div class="col form-label">
                    Part No.
                </div>
                <div class="col form-control">
                    {{$product->part_number}}
                </div>
            </div>

            <div class="row p-3 m-3 ">

                <div class="col form-label">
                    Product Description
                </div>
                <div class="col form-control">
                    {{$product->prod_description}}
                </div>
            </div>

            <div class="container mt-4">

                {{--                       Options --}}

                <h4>Product Options</h4>
                <hr class="mb-5"/>
                <div class="container py-4" id="productOptionContainer">
                    <input type="hidden" id="productOptionCount" value="1" name="product_option_count">
                    <div class="p-2 m-2 productOptionContainerTracking" style="border: 1px solid lightgray">
                        <div class=" p-3 m-3 text-center" style="width: 100%">
                            <h4>Option 1</h4>
                        </div>
                        <div class="row p-3 m-3">
                            <div class="col">
                                <label for="productOptionSize-0" class="form-label">Size</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control sizeOption optionFormField" id="productOptionSize-0"
                                       name="product_option_size-0">
                            </div>
                        </div>

                        <div class="row p-3 m-3">
                            <div class="col">
                                <label for="productOptionColor-0" class="form-label">Color</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control colorOption optionFormField" id="productOptionColor-0"
                                       name="product_option_color-0">
                            </div>
                        </div>

                        <div class="row p-3 m-3">
                            <div class="col">
                                <label for="productOptionPrice-0" class="form-label">Price</label>
                            </div>
                            <div class="col">
                                <input type="number" class="form-control priceOption optionFormField" id="productOptionPrice-0"
                                       name="product_option_price-0">
                            </div>
                        </div>
                    </div>


                </div>

                <div class="row p-3 m-3">
                    <div class="col">
                        <button class="btn btn-primary" id="addAnotherOptionButton">Add another option...</button>
                    </div>
                    <div class="col">
                        <button class="btn btn-primary" id="saveProductOptionsButton">Save Product Options</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @section('scripts')
        <script src="{{ asset('js/product/utility2.js') }}" defer></script>
        <script>
        </script>
    @stop
</x-app-layout>
