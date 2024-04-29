<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="pb-3">Create a Product</h1>
                    <hr class="mb-5"/>
                    @if($errors->has('general_error'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$errors->first('general_error')}}</strong>
                        </span>
                    @endif

                    <form class="row g-3" action="/p/flow/one" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row-cols-2 flex">

                            <div class="col-lg p-3 m-3">
                                <label class="form-label" for="category_id">Select a category for the product...</label>
                                @if(isset($categories))
                                    <input type="hidden" name="category_id" id="hiddenCategoryId" value="0">
                                    <input type="text" list="categories" id="categoriesDatalist" name="category_name" class="form-control"/>
                                    <datalist id="categories" >
                                        @foreach($categories as $category)
                                            <option value="{{ $category->category_name }}"></option>
                                        @endforeach
                                    </datalist>
                                @endif
                            </div>

                            <div class="col-lg p-3 m-3">
                                <label for="product_image" class="form-label">Upload a product image...</label>
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


                        <div class="row-cols-3 flex space-x-8 justify-center">
                            <div class="col">
                                <label for="product_name" class="form-label mt-4">Product Type or Name</label>
                                <input type="text"
                                       class="form-control{{ $errors->has('product_name') ? ' is-invalid': '' }}"
                                       id="product_name"
                                       name="product_name"
                                       aria-describedby="productName" placeholder="Product Name"
                                       value="{{old('product_name')}}"
                                       autocomplete="product_name">
                            </div>
                            <div class="col-md-2">
                                <label for="panel_count" class="form-label mt-4">Panel Count</label>
                                <input type="text"
                                       class="form-control{{ $errors->has('panel_count') ? ' is-invalid': '' }}"
                                       id="panel_count"
                                       name="panel_count"
                                       aria-describedby="panel_count" placeholder="0"
                                       value="{{old('panel_count')}}"
                                       autocomplete="panel_count">
                            </div>
                            <div class="col-md-2">
                                <label for="light_count" class="form-label mt-4">Light Count</label>
                                <input type="text"
                                       class="form-control{{ $errors->has('light_count') ? ' is-invalid': '' }}"
                                       id="light_count"
                                       name="light_count"
                                       aria-describedby="light_count" placeholder="0"
                                       value="{{old('light_count')}}"
                                       autocomplete="light_count">
                            </div>
                        </div>
                        <div class="row mt-4">

                        </div>

                        <hr/>
                        <div class="row-cols-1 ">
                            <div class="col-lg">

                                <label for="prod_description" class="form-label  mt-4">Product Description</label>
                                <textarea
                                    class="form-control{{ $errors->has('prod_description') ? ' is-invalid': '' }}"
                                    id="prod_description"
                                    name="prod_description"
                                    aria-describedby="productDescription" placeholder="Product Description"
                                    rows="3">{{old('prod_description')}}</textarea>
                            </div>
                        </div>

                        <label for="part_number" class="form-label  mt-4">Part Number</label>
                        <input type="text"
                               class="form-control{{ $errors->has('part_number') ? ' is-invalid': '' }}"
                               id="part_number"
                               name="part_number"
                               aria-describedby="partNumber" placeholder="Part Number"
                               value="{{old('part_number')}}"
                               autocomplete="part_number">
                </div>

                <div class="col-12">
                    <div class="p-6 bg-white border-b border-gray-200  border-top">
                        <button class="btn btn-secondary btn-lg px-4 text-white hover:text-white-800">
                            Add product details...
                        </button>
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="d-none">
        @foreach($categories as $category)
            <div class="categoryValuesHidden">
                {{$category->id}},{{ $category->category_name }}
            </div>
        @endforeach
    </div>
    @section('scripts')
        <script src="{{ asset('js/product/utility1.js') }}" defer></script>
    @stop
</x-app-layout>
