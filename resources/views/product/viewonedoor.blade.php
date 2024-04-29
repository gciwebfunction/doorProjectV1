<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Management') }}
        </h2>
    </x-slot>

    <div class="container py-4">
        <div class="container">
            <div class="row" style="border:1px solid #bacbe6">
                <div class="col-3 m-2">Product Id:</div>
                <div class="col-6 m-2">{{$product->id}}</div>
            </div>
            <div class="row" style="border:1px solid #bacbe6">
                <div class="col-3 m-2">Product Name:</div>
                <div class="col-6 m-2" onclick="editProductName({{$product->id}})"
                     style="cursor:pointer;">{{$product->product_name}}</div>
            </div>
            <div class="row" style="border:1px solid #bacbe6">
                <div class="col-3 m-2">Product Description:</div>
                <div class="col-6 m-2" onclick="editProductDescription({{$product->id}})"
                     style="cursor:pointer;">{{$product->product_description}}</div>
            </div>
            <div class="row" style="border:1px solid #bacbe6">
                <div class="col-3 m-2">Product Image:</div>
                <div class="col-6 m-2" onclick="editProductImage({{$product->id}})"
                     style="cursor:pointer;"><img src="/storage/{{$product->images()->first()->image_path}}"
                                                  alt="{{$product->product_name}}" style="max-width: 100px"></div>
            </div>
        </div>

    </div>
    @section('scripts')
        <script src="{{ asset('js/product/viewone.js') }}" defer></script>
    @stop
</x-app-layout>
