<x-app-layout>
    <x-slot name="header">
        {{ __('Manufacturer Dashboard') }}
    </x-slot>
    <div class="container py-4">
        <div class="container">
            <h4 style="text-align: center">Orders</h4>
            <table id="manufOrderRequestsTable" class="display">
                <thead>
                <tr>
                    <th>Order #</th>
                    <th>User</th>
                    <th>Order Total</th>
                    <th>Order Status</th>
                </tr>
                </thead>
                <tbody>
                @can('r_order')
                    @if(isset($orders))
                        @foreach($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->created_by_user_id}}</td>
                                <td class="currSign">{{sprintf('%0.2f', $order->total_order_amount)}}</td>
                                <td>
                                    @php
                                    if($order->status == -1){
                                            $status = 'Internal';
                                    }else{
                                            $status = $order->status;
                                    }
                                    @endphp
                                    {{$status}}

                                </td>
                            </tr>
                        @endforeach
                    @else
                        <td>No current order requests.</td>
                    @endif
                @endcan
                </tbody>
            </table>
        </div>


        @foreach($categories as $category)
            @foreach($doorTypes as $t)
                @if($t->category_id == $category->id)
                    @foreach($t->doors as $door)
                        <div class="row m-3 py-4" style="border: 1px solid lightgrey; border-radius: 5px; box-shadow: #adb5bd; margin-right: auto"   >
                            <div class="col-5 text-right">
                                @php
                                //dd($door);
                                    if($door['main_image']){
                                          $img = asset('/storage/product_image/'.$door['main_image']);
                                      }else{
                                          $img = asset('/storage/product_image/coming-soon.jpg');
                                      }
                                @endphp
                                <img src="{{$img}}"
                                     alt="{{$category->category_name}}"
                                     class=" "
                                     style="max-width:430px;  max-height:444px;  width: auto;  height: auto; ">
                            </div>
                            <div class="col-4">
                                <h4>{{$door->name}}</h4>
                                <p class="card-text">{{$category->category_name}}
                                    - {{$category->category_note}}</p>
                            </div>
                            <div class="col-3" style="text-align: center; vertical-align: bottom">
                                <p class="p-3 mb-5">

                                </p>
                                <button type="button" class="btn btn-lg"
                                        onclick="window.location = '/sc/door/{{$shoppingCart->id}}/{{$door->id}}'">Order
                                </button>
                            </div>
                        </div>
                    @endforeach
                @endif
            @endforeach
        @endforeach
        @foreach($categories as $category)
            @foreach($products as $t)
                @if($t->category_id == $category->id)

                    <div class="row m-3 py-4" style="border: 1px solid lightgrey; border-radius: 5px; box-shadow: #adb5bd; margin-right: auto"   >
                        <div class="col-5 text-right">
                            @php

                                if(!empty($category->main_image) && $category->main_image !=NULL){
                                    $img = asset('/storage/product_image/'.$category->main_image);
                                }else{
                                    $img = asset('/storage/product_image/coming-soon.jpg');
                                }
                            @endphp

                            <img src="{{$img}}"
                                 alt="{{$category->category_name}}"
                                 class=" "
                                 style="max-width:430px;  max-height:444px;  width: auto;  height: auto; ">
{{--                            <img src="/storage/product_image/coming-soon.jpg"--}}
{{--                                                           alt=""--}}
{{--                                                           class=" "--}}
{{--                                                           style="max-width:430px;  max-height:444px;  width: auto;  height: auto; ">--}}
                        </div>
                        <div class="col-4">
                            <h4>{{$t->product_name}}</h4>
                            <p class="card-text">{{$category->category_name}}
                                - {{$category->category_note}}</p>
                        </div>
                        <div class="col-3" style="text-align: center; vertical-align: bottom">
                            <p class="p-3 mb-5">

                            </p>
                            <button type="button" class="btn btn-lg"
                                    onclick="window.location = '/sc/product/{{$shoppingCart->id}}/{{$t->id}}'">Order
                            </button>
                        </div>
                    </div>

                @endif
            @endforeach
        @endforeach
    </div>
    @section('scripts')
        <script src="{{ asset('js/dashboard/manufdash.js') }}" defer></script>
        <script>
            $(document).ready(function () {
                $('#manufOrderTable').DataTable();
                $('#manufOrderRequestsTable').DataTable();
            });
        </script>
    @stop


    <x-slot name="footer">
    </x-slot>
</x-app-layout>
