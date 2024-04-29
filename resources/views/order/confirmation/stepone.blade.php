<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Confirmation')  }} {{$or->id}}
        </h2>
    </x-slot>
    <div class="py-5 text-center">
        <h2>Order Conversion</h2>
        <p class="lead">Verify the order below. All items are editable for a final check before creating the official
            order.</p>
    </div>
    <div class="container  mt-4" style="">
        <form action="/or/confirmstepone/{{$or->id}}" method="POST"
              id="cartItemForm">
            @csrf
            <input type="hidden" id="orderRequestId" name="order_request_id" value="{{$or->id}}">
            <input type="hidden" id="orderItemCount" name="item_count" value="{{$item_count}}">
            <div class="row g-1">

                @foreach ($or->doorItems as $doorItem)
                    <div class="col-md-7 col-lg-8" style="float: left">
                        <h4 class="mb-3">Item Number #{{$loop->index+1}}</h4>
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="doorName-{{$loop->index}}" class="form-label">Door name</label>
                                <input type="text" class="form-control" id="doorName-{{$loop->index}}" placeholder=""
                                       name="door_name-{{$loop->index}}"
                                       value="{{$doorItem->door_name}}"
                                       required>
                                <div class="invalid-feedback">
                                    Valid name is required.
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="categoryName-{{$loop->index}}" class="form-label">Category Name</label>
                                <input type="text" class="form-control"
                                       id="categoryName-{{$loop->index}}"
                                       name="category_name-{{$loop->index}}" value="{{$doorItem->category_name}}"
                                       required>
                                <div class="invalid-feedback">
                                    Category name is required.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="doorTypePrettyName-{{$loop->index}}" class="form-label">Door Type</label>
                                <input type="text" class="form-control"
                                       id="doorTypePrettyName-{{$loop->index}}"
                                       name="door_type_pretty_name-{{$loop->index}}"
                                       value="{{$doorItem->door_type_pretty_name}}"
                                       required>
                                <div class="invalid-feedback">
                                    Door type is required.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="quantity-{{$loop->index}}" class="form-label">Quantity</label>
                                <input type="number" class="form-control"
                                       id="quantity-{{$loop->index}}"
                                       name="quantity-{{$loop->index}}"
                                       value="{{$doorItem->quantity}}">
                                <div class="invalid-feedback">
                                    Please enter a valid quantity.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="address" class="form-label">Item Price</label>
                                <input type="number" class="form-control" id="price-{{$loop->index}}"
                                       name="price-{{$loop->index}}"
                                       value="{{$doorItem->price}}">
                                <div class="invalid-feedback">
                                    Please enter a valid price.
                                </div>
                            </div>


                            <div class="col-12">
                                <label for="address" class="form-label">Calculated Discount</label>
                                <input type="text" readonly class="form-control"
                                       name="calculated_discount-{{$loop->index}}"
                                       value="{{$doorItem->calculated_discount}}">
                                <div class="invalid-feedback">
{{--                                    Please enter a valid price.--}}
                                </div>
                            </div>


                            <hr class="my-4">

                            @foreach ($doorItem->doorItemModifiers as $modifier)
                                @if($modifier->door_modifier_key == 'SIZE')
                                    <div class="col-sm-6">
                                        <label class="form-label">Width</label>
                                        <input type="text" class="form-control" name="width-{{$loop->parent->index}}"
                                               value="{{explode(" ", $modifier->door_modifier_value)[0]}}"
                                               required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label">Height</label>
                                        <input type="text" class="form-control"
                                               name="width-{{$loop->parent->index}}"
                                               value="{{explode(" ", $modifier->door_modifier_value)[1]}}"
                                               required>
                                    </div>
                                @endif
                            @endforeach

                            @foreach ($doorItem->doorItemModifiers as $modifier)
                                @if($modifier->door_modifier_key != 'SIZE')
                                    <div class="col-12">
                                        <label class="form-label">{{$modifier->door_modifier_key}}</label>
                                        <input type="text" class="form-control" name="{{$modifier->door_modifier_key}}-{{$loop->parent->index}}"
                                               value="{{$modifier->door_modifier_value}}">
                                    </div>
                                @endif
                            @endforeach

                        </div>

                    </div>
                    <div class="container py-3"></div>
                @endforeach

                <div class="col-md-5 col-lg-4" style=" position: fixed; right: 20px; top: 320px;">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-primary">Information</span>
                        <span class="badge bg-primary rounded-pill">{{$item_count}}</span>
                    </h4>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Order Request#</h6>
                            </div>
                            <span class="text-muted">{{$or->id}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Owner</h6>
                                <small class="text-muted">User: {{ $or->user_id }}</small>
                            </div>
                            <span class="text-muted">{{$or_owner}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Distributor</h6>
                                <small class="text-muted">Dist-Id {{$or->distributor_id?? ''}}</small>
                            </div>
                            <span class="text-muted">{{$or_dist?$or_dist->email:''}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Expected Shipping Date</h6>
                                <small class="text-muted"></small>
                            </div>
                            <span class="text-muted">{{$or->expected_shipping_date?? ''}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between bg-light">
                            <div class="text-success">
                                <h6 class="my-0">Order Discount</h6>
                                <small>0%</small>
                            </div>
                            <span class="text-success">{{$or->expected_shipping_date?? ''}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (USD)</span>
                            <strong>$ {{ $or->total }}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <button type="submit" value="Convert Order">Convert Order</button>
                        </li>
                    </ul>


                </div>
            </div>
        </form>
    </div>

    @section('scripts')
        <script src="{{ asset('js/order/confirm1.js') }}" defer></script>
        <script>
        </script>
    @stop
</x-app-layout>
