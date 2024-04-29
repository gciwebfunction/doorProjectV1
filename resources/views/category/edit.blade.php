<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Categories') }}
        </h2>
    </x-slot>
    <div class="container py-4">
        <div class="container">
            <h4 style="text-align: center; margin-bottom: 10px">Category Edit</h4>
            <x-auth-validation-errors class="mb-4" :errors="$errors"/>
            <form class="" action="/c/update" enctype="multipart/form-data"
                  method="POST">
                @csrf
                <input type="hidden" value="{{$category->id}}" name="category_id" id="categoryId">
                <div class="row flex">
                    <div class="col p-3 m-3">
                        <label for="category_name" class="form-label">Category Name</label>
                    </div>
                    <div class="col p-3 m-3">
                        <input type="text"
                               class="form-control{{ $errors->has('category_name') ? ' is-invalid': '' }}"
                               id="category_name"
                               name="category_name"
                               placeholder="Category Name"
                               value="{{$category->category_name}}"
                               autocomplete="category_name">
                    </div>
                </div>
                <div class="row flex">
                    <div class="col p-3 m-3">
                        <label for="category_image" class="form-label">Upload a category image...</label>
                        <input type="file"
                               name="category_image"
                               aria-describedby="categoryImage"
                               id="category_image"
                               class="form-control-file" onchange="readURL(this ,  'main_image_preview11');"
                        >
                        <img id="main_image_preview11" src="" width="100px" height="100px" style="display: none;" />
                        @if($errors->has('category_image'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('category_image')}}</strong>
                                    </span>
                        @endif
                    </div>
                    @if($category->image)
                        <div class="col p-3 m-3">
                            <div class="form-group">
                                <div style="max-width: 200px; margin: auto">
                                    <p class="bolder" style="text-align: center">Current Image</p>
                                </div>
                                <div style="max-width: 200px; margin: auto">
                                    <img src="/storage/category_image/{{$category->image}}"
                                         class="img-fluid border rounded-3 shadow-lg"
                                         style="margin: 0 auto"
                                         alt="{{$category->category_name}}"
                                         loading="lazy">
                                </div>

                            </div>
                        </div>
                    @endif
                </div>
                <input type="hidden" name="old_image" value="{{$category->image}}">
                <div class="row flex">
                    <div class="col p-3 m-3">
                        <div class="form-group">
                            <label for="category_note" class="form-label">Category Notes</label>
                            <textarea
                                class="form-control{{ $errors->has('category_note') ? ' is-invalid': '' }}"
                                id="category_note"
                                name="category_note"
                                rows="3">{{$category->category_note}}</textarea>
                        </div>
                    </div>

                </div>

                <div class="row mb-4">
                    <div class="col">
                        <label for="sort_order" class="form-label">Sort Order</label>
                    </div>
                    <div class="col">
                        <input type="number" min="1"
                               class="form-control{{ $errors->has('sort_order') ? ' is-invalid': '' }}"
                               id="sort_order"
                               name="sort_order"
                               value="{{$category->sort_order}}"
                               autocomplete="sort_order">
                    </div>
                </div>

                <div class="row flex">
                    <div class="col p-3 m-3">
                        <div class="" style="text-align: right;margin-right: 20px">
                            <button class="btn btn-primary mb-3">
                                Update Category
                            </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
    </div>
</x-app-layout>
