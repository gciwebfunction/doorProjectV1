<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Management') }}
        </h2>
    </x-slot>

    <div class="container py-4">
        <input type="hidden" value="" id="deleteLocation">
        @if(isset($products))
            <table class="table table-striped" id="productTable" style="width: 100%">
                <thead>
                <th></th>
                <th>Product Name</th>
                <th>Part Number</th>
                <th>Category</th>
                <th>Product Image</th>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr class="" style="cursor: pointer">
                        <td class="d-none">{{$product->id}}</td>
                        <td class="alert-info deleteProduct"
                            style="text-align: center;cursor:pointer;background: red"
                            id="deleteProduct-{{$product->id}}" href="/p/delete/{{$product->id}}">
                                        <span class="deleteProduct">
                                            <a href="/p/delete/{{$product->id}}">X</a>
                                        </span>
                        </td>
                        <td>{{$product->product_name}}</td>
                        <td>{{$product->part_number}}</td>
                        <td>{{$product->category->category_name}}</td>
                        <td>{{$product->images()->first()->image_path}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
    <div class="p-6 bg-white border-b border-gray-200  border-top" style="margin-right: 20px; text-align: right">
        <a href="{{route('pcreatedoorflowstepone')}}">
            <button class="btn btn-secondary btn-lg px-4 text-white hover:text-white-800">Add New Product
            </button>
        </a>
    </div>

    @section('scripts')
        <script src="{{ asset('js/product/view.js') }}" defer></script>
    @stop
</x-app-layout>
