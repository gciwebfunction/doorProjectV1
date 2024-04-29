@php //echo $global_user_id;die; @endphp
<x-app-layout>
    <x-slot name="header">
        {{ __('Manufacturer Dashboard') }}
    </x-slot>
    <div class="container py-4">


        <section class="py-5 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">Product Catalog</h1>
                    <p class="lead text-muted">Products are detailed below. Please click a link to initiate the order
                        process for a product.</p>
                    <p>
                        <a href="/o" class="btn btn-primary my-2">Confirmed Orders</a>
                        {{--                        <a style="border-radius: 2px; border: 1px solid black; background-color: lightgray; padding: 3px" href="/o/{{$or->id}}">--}}
{{--                        <a href="/o#current_order_reqss" class="btn btn-secondary my-2">In Progress Orders</a>--}}
                                                <a href="/o#current_order_reqss" class="btn btn-secondary my-2">In Process Orders</a>
                    </p>
                </div>
            </div>
        </section>
        @foreach($categories as $category)
            @foreach($doorTypes as $t)
                @if($t->category_id == $category->id)
                    @foreach($t->doors as $door)
                        <div class="row m-3 py-4" style="border: 1px solid lightgrey; border-radius: 5px; box-shadow: #adb5bd; margin-right: auto"   >
                            <div class="col-5 text-right">
                                @php
                                  //echo '<pre>';var_dump($door['main_image']);echo '</pre>';
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

                            @if(($category->main_image))
                                <img src="/storage/product_image/{{$t->main_image}}"
                                     alt=""
                                     class=" "
                                     style="max-width:430px;  max-height:444px;  width: auto;  height: auto; ">

                                @else
                                <img src="/storage/product_image/coming-soon.jpg"
                                     alt=""
                                     class=" "
                                     style="max-width:430px;  max-height:444px;  width: auto;  height: auto; ">
                                @endif
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
            });
        </script>
    @stop

    <x-slot name="footer">
    </x-slot>
</x-app-layout>
