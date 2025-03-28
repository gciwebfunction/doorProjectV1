<html>
    <head>
        <style>
            h1,h2 {text-align: center;}
            p {text-align: center;}
            div {text-align: center;}
            table{ width: 100% }
            /*table tr td {text-align: center; border: 1px solid black; }*/
            table tr td {text-align: center; }
            .content {
                min-width: 1300px;
                /*width: 1000px;*/
                margin: auto;
            }

            table #checkin td{
                /*border-bottom: 2px solid black;*/
            }

            h3,h5,h5 {
                padding-bottom: 2px !important;;
                margin-bottom: 2px !important;
            }

            #checkin tr th td{
                vertical-align: top;
            }
        </style>
    </head>

    <body style="margin: 0 auto;">
        <div class="content">
            <table style="vertical-align: top">

                <tr>
                    <td colspan="5"><br><h2>Order Details</h2></td>
                </tr>
                <tr>
                    <td colspan="5"><br></td>
                </tr>
                <tr>
                    <td colspan="5"><h3>Order #: {{$orderData->id}} (Expected Shipping Date:
                @php
                    echo  date(('m-d-Y'), strtotime($orderData->manufacturer_shipping_date)).')';
                @endphp
                </h3></td>
                </tr>
                <tr>
                    <td colspan="5"><h3>Status #: Processing</h3></td>
{{--                    <td colspan="3"><h3 style="text-align: left;">Company PO# {{$orderData->purchase_order_number}}</h3></td>--}}
                </tr>


                <tr><td colspan="5">
                        <table>
                            <tr>
                                <td colspan="2"><h3>Manufacturer</h3></td>
                                <td colspan="2"><h3>Distributor</h3></td>
                                <td colspan="2"><h3>Dealer</h3></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    Address: {{$buyer_addres}}<br>
                                    Address2: {{$buyer_addres2}}<br>
                                    State: {{$buyer_state}}<br>
                                    City: {{$buyer_city}}<br>
                                    Postal Code: {{$buyer_postal_code}}<br>
                                    Phone: {{$buyer_primary_phone}}<br>
                                </td>

                                <td colspan="2">
                                    Address: {{$ship_addres}}<br>
                                    Address2: {{$ship_addres2}}<br>
                                    State: {{$ship_state}}<br>
                                    City: {{$ship_city}}<br>
                                    Postal Code: {{$ship_postal_code}}<br>
                                </td>

                            </tr>
                        </table>
                    </td>
                </tr>



{{--                    <td align="left"  colspan="3"><h5 style="text-align: left;">Company PO# {{$orderData->purchase_order_number}}</h5></td>--}}

                <tr><td colspan="5"><hr></td> </tr>
                <tr><td colspan="5"><h2>Doors</h2></td> </tr>

                <tr>
                    <td colspan="5">
                        <table id="checkin">
                            <tr><td colspan="24"><hr></td> </tr>
{{--                            <tr style="border-bottom: 2px solid black;vertical-align: top">--}}
                            <tr style="vertical-align: top">


                            <th>No.</th>
                            <th>Type </th>
                            <th>Name</th>
                            <th>Size</th>
                            <th>Color</th>

{{--                            <th>Panel Type</th>--}}
{{--                            <th>Door Type</th>--}}
{{--                            <th>Door Frame</th>--}}

                            <th>Door Handling</th>
                            <th>DP Option</th>
                            <th>Blind</th>
                            <th>Glass Option</th>
                            <th>Glass Grid</th>
                            <th>3/4 Lite</th>
                            <th>Handle</th>
                            <th>Lock</th>
                            <th>Frame Thickness</th>
                            <th>Sill</th>
                            <th>Screen</th>
                            <th>Handle Color</th>
                            <th>Lock Color</th>
                            <th>Sill Color</th>
                            <th>Hinge Color</th>
                            <th>Order Qty</th>
                            <th>Unit price</th>
                            <th>Order Amount</th>
                            <th>Discount Rate</th>
                            <th>Discount Amount</th>
                        </tr>
                        <tr><td colspan="24"><hr></td> </tr>
                            @foreach($orderItems as $k=> $item)
                                @php //dd($item) @endphp
                                <tr style="border-bottom: 2px solid black; vertical-align: top">
                                <td>{{$k+1}}</td>
                                <td>{{$item->prod_type}}</td>
                                <td>{{$item->item}}</td>
{{--                                <td>{{$item->prod}}</td>--}}
{{--                                <td>{{$item->spec}}</td>--}}
                                <td>{{$item->width}} {{$item->height}}</td>
                                <td>{{$item->color_code}}</td>
                                <td>{{$item->door_handling}}</td>
{{--                                <td>{{$item->panel_type}}</td>--}}
{{--                                <td>{{$item->door_type}}</td>--}}
{{--                                <td>{{$item->door_frame}}</td>--}}

                                <td>{{$item->dp_option}}</td>
                                <td>{{$item->blind_option}}</td>
                                    <td>{{$item->glass_material}}</td>
                                    <td>{{$item->glass_grid}}</td>
                                <td>{{$item->lite_option}}</td>

                                <td>{{$item->handle}}</td>
                                <td>{{$item->lock_option}}</td>

                                <td>{{$item->frame_thickness}}</td>
                                <td>{{$item->sill_option}}</td>
                                <td>{{$item->screen_option}}</td>
                                <td>{{$item->handle_color}}</td>
                                <td>{{$item->lock_color}}</td>
                                <td>{{$item->sill_color}}</td>
                                <td>{{$item->hinge_color}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>{{$item->unit_price}}</td>
                                <td>{{$item->quantity*$item->unit_price}}</td>
                                <td>{{$item->discount_amount}}</td>
                                <td>{{$item->calculated_discount}}</td>
                            </tr>
                            @endforeach
{{--                            <tr>--}}
{{--                                <td colspan="26" style="border-bottom: none;"><br></td>--}}
{{--                            </tr>--}}

                    </table>
                </td>
                </tr>


                <tr>
                    <td colspan="5"><br></td>
                </tr>

                <tr>
                    <td colspan="5"><hr></td>
                </tr>

                <?php
                    if(sizeof($orderRequestProducts) >=1   && $orderRequestProducts != null)   {
                ?>
                <tr>
                    <td colspan="5"><h2>Other Products</h2></td>
                </tr>
                <tr>
                    <td colspan="5">
                        <table class="table-striped" id="orderRequestTable" style="width:100%; margin: 0px 6px 13px 3px; font-size:12px">
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Option Name</th>
                                <th>Product Size</th>
                                <th>Product Color</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Sub Total</th>
                            </tr>
                            <tr>
                                <td colspan="8"><hr></td>
                            </tr>

                        @foreach($orderRequestProducts as $k => $orp)
                            <tr id="itemRowssss-{{$orp->id}}">
                                <input type="hidden" name="products[]" value="{{$orp->id}}" readonly>
                                <td>{{$k+1}}</td>
                                <td>{{$orp->product_name}}</td>
                                <td>{{$orp->option_name}}</td>
                                <td>@isset($orp->product_size){{$orp->product_size}}@endisset</td>
                                <td>@isset($orp->product_color){{$orp->product_color}}@endisset</td>
                                <td>@isset($orp->quantity){{$orp->quantity}}@endisset</td>
                                <td>@isset($orp->product_unit_price){{$orp->product_unit_price}}@endisset</td>
                                <td>{{$orp->product_unit_price*$orp->quantity }}</td>
                            </tr>
                        @endforeach

                        </table>
                </td>
                </tr>

                <?php
                    }
                ?>

            </table>
        </div>
    </body>
</html>