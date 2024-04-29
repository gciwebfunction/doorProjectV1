<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Management') }}
        </h2>
    </x-slot>

    <div class="container mt-2">
        <h4 class="fw-bold">Update Product</h4>
        @if($errors->has('general_error'))
            <span class="invalid-feedback" role="alert">
                            <strong>{{$errors->first('general_error')}}</strong>
                        </span>
        @endif

        <form class="row g-3" action="/p/flow/three" method="POST"
              enctype="multipart/form-data" id="updateCategoryForm">
            @csrf
            <input name="product_id" id="productId" type="hidden" value="{{$product->id}}">
            <div class="row  p-1">
                <div class="input-group input-group-icon mt-4 mb-1 ">
                    <input type="text" name="product_name" id="productName"
                           class="form-control{{ $errors->has('category_name') ? ' is-invalid': '' }}"
                           aria-describedby="product_name" placeholder="Product Name"
                           value="{{$product->product_name}}">
                    <div class="input-icon"><i class="fa fa-user"></i></div>
                </div>
                <div class="input-group input-group-icon mb-1">
                    <input type="text" name="part_number" id="partNumber"
                           class="form-control{{ $errors->has('part_number') ? ' is-invalid': '' }}"
                           aria-describedby="part_number" placeholder="Part Number"
                           value="{{$product->part_number}}">
                    <div class="input-icon"><i class="fa fa"></i></div>
                </div>
                <div class="input-group input-group-icon mb-1">
                    <input type="number" name="unit_price" id="unitPrice"
                           class="form-control{{ $errors->has('unit_price') ? ' is-invalid': '' }}"
                           aria-describedby="unit_price" placeholder="Unit Price"
                           value="{{$product->unit_price}}">
                    <div class="input-icon"><i class="fa fa-user"></i></div>
                </div>
            </div>

            <div class="row p-1">
                <h4 class="fw-bold"> Current Category: {{$product->category->category_name}}</h4>
                <div class="input-group input-group-icon mt-2 mb-1 ">
                    @if(isset($categories))
                        <input type="hidden" name="category_id" id="hiddenCategoryId" value="0">
                        <input type="text" list="categories" id="categoriesDatalist"
                               name="category_name"
                               class="form-control{{ $errors->has('category_name') ? ' is-invalid': '' }}"
                               aria-describedby="category_name" placeholder="Select a new Category"
                               value="{{old('category_name')}}"
                        />
                        <datalist id="categories">
                            @foreach($categories as $category)
                                <option value="{{ $category->category_name }}"></option>
                            @endforeach
                        </datalist>
                    @endif
                </div>
            </div>
            <div class="row flex">
                <div class="col-5">
                    <h4>Existing image...</h4>
                    <div class="input-group">
                        <img width="140px" src="/storage/{{$product->images->first()->image_path}}">
                    </div>
                </div>
                <div class="col-5">
                    <h4>Upload a product image...</h4>
                    <div class="input-group input-group-icon m-3 p-3">
                        <input type="file"
                               name="product_image"
                               aria-describedby="productImage"
                               id="product_image"
                               class="form-control-file">
                        @if($errors->has('product_image'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('product_image')}}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
            </div>

            <hr/>
            <div class="row mt-2" style="text-align: center">
                <div class="col-3">
                </div>
                <div class="col-3">
                    <div class="input-group">
                        <input type="button" class="button-gci" value="Go back" id="backButton">
                    </div>
                </div>
                <div class="col-3">
                    <div class="input-group">
                        <input type="button" class="button-gci" value="Save Category"
                               id="saveChanges">
                    </div>
                </div>
            </div>
        </form>
    </div>

    @section('scripts')
        <script src="{{ asset('js/product/utility3-changecategory.js') }}" defer></script>
    @stop
</x-app-layout>
