<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Categories') }}
        </h2>
    </x-slot>
    <div class="container py-4">
        <x-auth-validation-errors class="mb-4" :errors="$errors"/>
        <form class="" action="/c" enctype="multipart/form-data"
              method="POST">
            @csrf
            <div class="row mb-4">
                <div class="col">
                    <label for="category_name" class="form-label">Category Name</label>
                </div>
                <div class="col">
                    <input type="text"
                           class="form-control{{ $errors->has('category_name') ? ' is-invalid': '' }}"
                           id="category_name"
                           name="category_name"
                           value="{{old('category_name')}}"
                           autocomplete="category_name">
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <label for="category_image" class="form-label">Upload a category image...</label>
                </div>
                <div class="col">
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
            </div>
            <div class="row mb-4">
                <div class="col">
                    <label for="category_note" class="form-label">Category Notes</label>
                </div>
                <div class="col">
                            <textarea
                                class="form-control{{ $errors->has('category_note') ? ' is-invalid': '' }}"
                                id="category_note"
                                name="category_note"
                                rows="3">{{old('category_note')}}</textarea>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <label class="form-label" for="categoryType">Category Type</label>
                </div>
                <div class="col">
                    <select
                        class="form-control{{ $errors->has('category_note') ? ' is-invalid': '' }}"
                        id="categoryType" name="category_type">
                        <option value="DOORS">Doors</option>
                        <option value="OTHERS">Others</option>
                    </select>
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
                           value="{{old('sort_order')}}"
                           autocomplete="sort_order">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="text-end " style="margin-right: 20px">
                        <button class="btn btn-primary mb-3" type="submit">
                            Create Category
                        </button>
                    </div>
                </div>
            </div>

        </form>
    </div>
    </div>
    </div>
</x-app-layout>
