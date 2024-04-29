<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Management') }}
            <meta name="csrf-token" content="{{ csrf_token() }}" />\
{{--            https://stackoverflow.com/questions/41981922/minimum-working-example-for-ajax-post-in-laravel-5-3--}}
        </h2>
    </x-slot>

    <div class="container py-4">
        <div class="text-end " style="margin-right: 20px; text-align: right; position: fixed; right: 50px; top: 120px; z-index: 1000000">
            <a href="{{route('pcreatedoorflowstepone')}}">
                <button class="btn btn-primary mb-3">Add New Product
                </button>
            </a>
        </div>
        <div class="card">
            <h5 class="card-header">Product List</h5>
            <div class="card-body">

                <div id="message" class="text-center">
                </div>

                <div id="centerFloatDiv" class="d-none">
                    <div class="divFloat" id="divFloat" style="text-align: center"></div>
                </div>

                <input type="hidden" value="" id="deleteLocation">

                @if(isset($doors))
{{--                    <table class="table table-striped" id="productTable" style="width: 100%">--}}
                    <table class="table table-striped" id="" style="width: 100%">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Id</th>
                            <th>Product</th>
                            <th>Type</th>
                            <th>Names</th>
                            <th>Sort Order</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($doors as $product)
{{--                            <tr class="" style="cursor: pointer" id="rowProductId-{{$product->id}}">--}}
                            <tr class="" >
                                <td class="d-none">{{$product->id}}</td>
                                <td class="alert-danger delete">
                                    <div data-bs-toggle="modal" data-bs-target="#deleteProduct{{$product->id}}"
                                         style="text-align: center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#FF0000"
                                             class="bi bi-x" viewBox="0 0 16 16">
                                            <path
                                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                        </svg>
                                    </div>
                                    <div class="modal" id="deleteProduct{{$product->id}}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Delete Order Request</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to delete product: {{$product->name}}?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">
                                                        Cancel
                                                    </button>
                                                    <button type="button" class="btn btn-primary"
                                                            onclick="deleteProduct({{$product->id}}, '{{$product->name}}')">
                                                        Delete Product
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{$product->id}}</td>
                                <td>

                                    <a href="{{route('peditdoorflowstepone', $product->id)}}">
                                        {{$product->name}}
                                    </a>
{{--                                    {{$product->name}}--}}

                                </td>


                                <td>{{$product->doorType->door_type_pretty_name??' '}}</td>
                                <td>
                                    @foreach($product->doorNames as $name)
                                        @if($loop->index>0)
                                            ,
                                        @endif
                                        {{$name->door_name_or_type}}
                                    @endforeach</td>
{{--                                <td><input type="number" min="1" name="sort_order_door[]"> </td>--}}
                                <td>
                                    <input type="number" id="sort_order_door{{$product->id}}"  min="1" name="sort_order_door[]"  onchange="sortioraaferDor({{$product->id}})"  value="{{$product->sort_order}}"  >
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif


                @if(isset($products))
                    <table class="table table-striped" id="product2Table" style="width: 100%">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Id</th>
                            <th>Product</th>
                            <th>Type</th>
                            <th>Sort Order</th>
{{--                            <th>Names</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr class="" style="cursor: pointer" id="rowProductId-{{$product->id}}">
{{--                            <tr class="" >--}}
                                <td class="d-none">{{$product->id}}</td>
                                <td class="alert-danger delete" style="width: 10px;">
                                    <div data-bs-toggle="modal" data-bs-target="#deleteProduct{{$product->id}}"
                                         style="text-align: center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#FF0000"
                                             class="bi bi-x" viewBox="0 0 16 16">
                                            <path
                                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                        </svg>
                                    </div>
                                    <div class="modal" id="deleteProduct{{$product->id}}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Delete Order Request</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to delete product: {{$product->name}}?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">
                                                        Cancel
                                                    </button>
                                                    <button type="button" class="btn btn-primary"
                                                            onclick="deleteProduct({{$product->id}}, '{{$product->name}}')">
                                                        Delete Product
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $product->id }}</td>
                                <td>
                                    <a href="{{route('myproductedit', $product->id)}}">
                                        {{$product->product_name}}
                                    </a>
                                </td>
                                @if(isset($product->category))
                                    <td>{{$product->category->category_name}}</td>
                                @else
                                    <td>No Category - Update product, bad data</td>
                                @endif

                                <td><input type="number" min="1" name="sort_order_product[]"  onchange="sortioraaferPor({{$product->id}})"  value="{{$product->sort_order}}" id="sort_order_product{{$product->id}}" > </td>
{{--                                <td><input type="number" min="1" name="sort_order[]"    onchange="sortioraafer('{{$category->id}}')" > </td>--}}

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
        <div class="text-end " style="margin-right: 20px; text-align: right">
            <a href="{{route('pcreatedoorflowstepone')}}">
                <button class="btn btn-primary mb-3">Add New Product
                </button>
            </a>
        </div>
    </div>
    @section('scripts')
        <script src="{{ asset('js/product/view.js') }}" defer></script>
        <script>
            // $(document).ready(function () {
            //     $('#manufOrderTable').DataTable();
            // });

            // function for the product
            var sort_order_p;
            function sortioraaferPor(idd){
                sort_order_p = $('#sort_order_product'+idd).val();
                $.ajax({
                    type:'POST',
                    url:'/p/updateSortProduct',
                    data:{
                        _token: "{{ csrf_token() }}",
                        idd         : idd,
                        sort_order  : sort_order_p
                    },
                    success: function( msg ) {
                         //alert('Sort Order Updated');
                    }
                });
            }




            // function for the door

            var sort_order_d;
            function sortioraaferDor(idd){
                //alert('sfdsdf');
                //var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                sort_order_d = $('#sort_order_door'+idd).val();
                $.ajax({
                    type:'POST',
                    url:'/p/updateSortDoor',
                    data:{
                        _token: "{{ csrf_token() }}",
                        idd         : idd,
                        sort_order  : sort_order_d
                    },
                    success: function( msg ) {
                        //alert('Sort Order Updated');
                    }
                });
            }







            function change_product_order(){
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        /* the route pointing to the post function */
                        url: '/updateSortProduct',
                        type: 'POST',
                        /* send the csrf-token and the input to the controller */
                        data: {_token: CSRF_TOKEN, message:$(".getinfo").val()},
                        dataType: 'JSON',
                        /* remind that 'data' is the response of the AjaxController */
                        success: function (data) {
                            $(".writeinfo").append(data.msg);
                        }

                });
            }

        </script>
    @stop
</x-app-layout>
