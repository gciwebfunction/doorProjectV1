<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manufacturer Update Order Request Form')  }}
        </h2>
    </x-slot>
    <div class="py-5 text-center">
        <h2>Manufacturer</h2>
        <p class="lead">Update Order Request Form</p>

    </div>
    <div class="container  mt-4" style="">
        <form action="/or/finalize" method="POST" id="cartItemForm">
            @csrf
            <input type="hidden" id="orderRequestId" name="order_request_id" value="{{$orderRequest->id}}">
            <div class="container">
                <div class="row">
                    <!-- Right  Side html starts -->
{{--                    <div class="col-md-8 mb-4">--}}
                    <div class="col-md-12">
                    </div>
                    <div class="col-md-12 mb-4">



                        <div class="card mb-4">
                            <div class="card-header py-3">
                                <h5 class="mb-0">Shipping Address</h5>
                            </div>
                            <div class="card-body">


                                <div class="row">

                                        <div class="form-outline">

                                            <div id="container">
                                                <table class="table-striped" id="orderRequestTable">
                                                    <tr>
                                                        {{--                                                        <th>Sr</th>--}}
                                                        <th>Category</th>
                                                        <th>Door Name</th>
                                                        <th>Qty</th>
                                                        <th>Unit Price</th>
                                                        <th>Discount</th>
                                                        <th>Discount Amt</th>
                                                        <th>Price </th>

                                                    </tr>
                                                    @foreach($doorViewItems as $k=> $item)

                                                        <tr id="itemRow-{{$item->id}}">
                                                            {{--                                                            <td>{{$k+1}}</td>--}}
                                                            <td>{{$item->category_name}}</td>
                                                            <td>{{$item->door_name}}</td>
                                                            <td>{{$item->quantity}}</td>
                                                            <td>{{$item->price}} <input type="hidden" value="{{$item->price}}" id="item_price{{$item->id}}"></td>
                                                            {{--                                                            <td><input onchange="calculater_recentage('{{$item->id}}')"  class="form-control discount_val"  id="discount_val{{$item->id}}" type="text" name="discount[]"></td>--}}

                                                            <td><select class="form-control">
                                                                    <option>%</option>
                                                                    <option>Amt</option>
                                                                </select></td>
                                                            {{--                                                            <td><input onchange="calculatetotal('{{$item->id}}')"  class="form-control discount_val"  id="discount_val{{$item->id}}" type="text" name="discount[]"></td>--}}
                                                            <td><input class="form-control" id="subtotal_price{{$item->id}}"   name="subtotal[]"> </td>
                                                            <td><input class="form-control" id="subtotal_price{{$item->id}}"   name="subtotal[]"> </td>

                                                            {{--                                                            <td><input  class="form-control discount_per"  id="discount_per{{$item->id}}" type="text" name="discount_per[]" disabled></td>--}}
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>

                                        </div>





                                    <div class="col">
                                        <div class="p-1 m-1 col">
                                            <label class="form-label" for="form7Example1">Shipping Address</label>

                                            <input type="text"
                                                   class="form-control{{ $errors->has('address1') ? ' is-invalid': '' }}"
                                                   id="shipping_address"
                                                   name="shipping_address"
                                                   autocomplete="shipping_address">
                                        </div>

                                        @if($user->usertype != 'manufacturer' )
                                        <div class="p-1 m-1 col">
                                            <label class="form-label" for="form7Example1">Expected Shipping Date</label>
                                            <input type="text"
                                                   class="form-control{{ $errors->has('expected_shipping_date') ? ' is-invalid': '' }}"
                                                   id="expected_shipping_date"
                                                   name="expected_shipping_date"
                                                   autocomplete="expected_shipping_date">
                                        </div>
                                        @endif

                                        <div class="p-1 m-1 col">
                                            <label class="form-label" for="form7Example2">Shipping Instruction</label>
                                            <input type="text"
                                                   class="form-control{{ $errors->has('shipping_instructions') ? ' is-invalid': '' }}"
                                                   id="shipping_instructions"
                                                   name="shipping_instructions"
                                                   autocomplete="shipping_instructions">
                                        </div>

                                        <div class="form-outline">
                                            <div class="p-1 m-1 col">
                                                <label class="form-label" for="form7Example2">Package Instruction</label>
                                                <input type="text"
                                                       class="form-control{{ $errors->has('package_instruction') ? ' is-invalid': '' }}"
                                                       id="package_instruction"
                                                       name="package_instructio"
                                                       autocomplete="package_instruction">
                                            </div>
                                        </div>


                                        @if($user->usertype != 'manufacturer' )
                                        <div class="form-outline">
                                            <div class="p-1 m-1 col">
                                                <label class="form-label" for="form7Example2">PO Number</label>
                                                <input type="text"
                                                       class="form-control{{ $errors->has('po_number') ? ' is-invalid': '' }}"
                                                       id="po_number"
                                                       name="po_number"
                                                       autocomplete="po_number">
                                            </div>
                                        </div>
                                        @endif





                                    </div>

                                    <div class="row mb-4">
                                        <div class="col">
                                            <div class="form-outline">
                                                <div class="p-1 m-1 col">
                                                    <label class="form-label" for="form7Example2">Freight term</label>
                                                    <input type="text"
                                                           class="form-control{{ $errors->has('freight_term') ? ' is-invalid': '' }}"
                                                           id="freight_term"
                                                           name="freight_term"
                                                           autocomplete="freight_term">
                                                </div>
                                                <div class="p-1 m-1 col">
                                                    <label class="form-label" for="form7Example2">Transportation Mode</label>
                                                    <input type="text"
                                                           class="form-control{{ $errors->has('transportation_mode') ? ' is-invalid': '' }}"
                                                           id="transportation_mode"
                                                           name="transportation_mode"
                                                           autocomplete="transportation_mode">

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                                <div class="row mb-4">
{{--                                    <div class="col">--}}
{{--                                        <div class="p-1 m-1 col">--}}
{{--                                            <label class="form-label" for="form7Example1">Shipping Address</label>--}}
{{--                                            <label class="form-label" for="form7Example7">Additional information</label>--}}
{{--                                            <textarea class="form-control" id="addInfo" name="additionalInformation" rows="4"></textarea>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}


{{--                                    <div class="form-outline">--}}
{{--                                        <div class="col">--}}
{{--                                            <button type="submit" value="update" id="submitOrderButton" class="ml-10 button-gci">--}}
{{--                                                <span aria-hidden="true">Update</span>--}}
{{--                                            </button>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Right  Side html ends -->


                    <!-- Left Side html starts -->
{{--                    <div class="col-md-4 mb-4">--}}
{{--                        <div class="card mb-4">--}}
{{--                            <div class="card-header py-3">--}}
{{--                                <h5 class="mb-0">Summary</h5>--}}
{{--                            </div>--}}
{{--                            <div class="card-body">--}}
{{--                                <ul class="list-group list-group-flush">--}}
{{--                                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">--}}
{{--                                        Sub total--}}
{{--                                        <span>$ {{ $orderRequest->total}}</span>--}}
{{--                                    </li>--}}
{{--                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">--}}
{{--                                        Discount--}}
{{--                                        <span> <input class="form-control" onchange="cumdics()"  id="cumdic_disc" type="number"   name="cummulative" ></span>--}}
{{--                                    </li>--}}
{{--                                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">--}}
{{--                                        <div>--}}
{{--                                            <strong>Total amount</strong>--}}
{{--                                            <strong>--}}
{{--                                                <p class="mb-0"></p>--}}
{{--                                            </strong>--}}
{{--                                        </div>--}}
{{--                                        <span>--}}
{{--                                            <strong>$ {{sprintf('%0.02f', $orderRequest->total)}}</strong>--}}
{{--                                            <input type="hidden" id="total_val" name="total_val" value="{{ $orderRequest->total}}" >--}}
{{--                                        </span>--}}

{{--                                    </li>--}}

{{--                                </ul>--}}

{{--                                <div class="p-6 bg-white border-b border-gray-200  " style="margin-bottom: 5px;">--}}

{{--                                    <label class="form-label">Amt After Discount</label>--}}
{{--                                    <span style="font-weight: bold;" id="total_disc_cval">${{sprintf('%0.02f', $orderRequest->total)}}</span>--}}

{{--                                </div>--}}
{{--                                <div class="p-6 bg-white border-b border-gray-200  ">--}}

{{--                                    <button class="btn btn-primary">--}}
{{--                                        Send Request--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}


                </div>
            </div>


            @section('scripts')
                <script src="{{ asset('js/orderrequest/finalize.js') }}" defer></script>
    @stop

    <script type="text/javascript">


        function cumdics(){
            var discount_val        = parseInt($('#cumdic_disc').val());
            var total_val           = parseInt($('#total_val').val());

            var sum                 = 0;
            $('.form-control.discount_val').each(function()
            {
                //alert(parseInt($(this).val()));
                alert ( Number($(this).val()));
                sum+=Number($(this).val());
            });

            //alert(sum);
            var total_after_diosc = total_val-sum-discount_val;

            $('#total_disc_cval').html("$"+total_after_diosc);
        }

        function calculater_recentage(iddd){

                var disval          = "#discount_val"+iddd;
                var discount_per    = "#discount_per"+iddd;
                var item_pric       = "#item_price"+iddd;


                var item_price      = parseInt($(item_pric).val());
                var discount_vale   = parseInt($(disval).val());
                //alert(discount_val);

                var perc            ="";
                if(isNaN(item_price) || isNaN(discount_vale)){
                    perc=" ";
                }else{
                    perc = ((discount_vale/item_price) * 100).toFixed(3);
                }

                $(discount_per).val(perc);

                var sumi                 = 0;

                $('.form-control.discount_val').each(function()
                {
                    sumi += parseInt($(this).text());
                });

                var discount_val        = parseInt($('#cumdic_disc').val());
                var total_val           = parseInt($('#total_val').val());
                var total_after_diosc   = total_val-sumi-discount_val;

                $('#total_disc_cval').html("$"+total_after_diosc);


        }


    </script>
</x-app-layout>
