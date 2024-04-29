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
                max-width: 1200px;
                /*width: 1000px;*/
                margin: auto;
            }

            table #checkin td{
                border-bottom: 2px solid black;
            }
        </style>
    </head>

    <body style="margin: 0 auto;">
        <div class="content">
            <table>
                <tr>
                    <td colspan="5"><h2>Order Details</h2></td>
                </tr>
                <tr>
                    <td colspan="5"><br></td>
                </tr>
                <tr>
                    <td colspan="2"><h3>Order #: {{$orderData->id}}</h3></td>
                    <td>&nbsp;&nbsp;</td>
                    <td colspan="2"><h3>Status #: Processing</h3></td>
                </tr>
                <tr>
                    <td colspan="5"><h4 style="text-align: left;">Manufacturer Information</h4></td>
                </tr>

                <tr>
                    <td colspan="5"><br></td>
                </tr>
                <tr>
                    <td><h5 style="text-align: right;">Tel:</h5></td>
                    <td><h5 style="text-align: right;">Fax:</h5></td>
                    <td  colspan="5">&nbsp;</td>
                </tr>
                <tr>
                    <td><h5 style="text-align: right;">Toll Free Tel:</h5></td>
                    <td><h5 style="text-align: right;">Fax:</h5></td>
                    <td><h5 style="text-align: right;">Ship to:</h5></td>
                    <td><h5 style="text-align: right;">Contact Person:</h5></td>
                    <td><h5 style="text-align: right;">Sales person code:</h5></td>
                </tr>
                <tr>
                    <td><h5 style="text-align: right;">S/O:</h5></td>
                    <td><h5 style="text-align: right;">Contact Person:</h5></td>
                    <td  colspan="3">&nbsp;</td>
                </tr>
                <tr>
                    <td align="left"  colspan="3"><h5 style="text-align: left;">Company PO#</h5></td>
                    <td><h5 style="text-align: right;">Tel:</h5></td>
                    <td><h5 style="text-align: right;">Fax:</h5></td>

                </tr>
                <tr>
                    <td colspan="5" style="text-align: left;"  colspan="3"><h5 >Address</h5></td>
                </tr>
                <tr>
                    <td colspan="5"><h2>Doors</h2></td>
                </tr>
                <tr>
                    <td colspan="5">
                        <table id="checkin">
                        <tr style="border-bottom: 2px solid black;">
                            <th>Sr#<th>
                            <th>Item<th>
                            <th>Prod type</th>
                            <th>Prod</th>
                            <th>Spec</th>
                            <th>Width</th>
                            <th>Height</th>
                            <th>Panel Type</th>
                            <th>Door Type</th>
                            <th>Door Frame</th>
                            <th>Color Code</th>
                            <th>Glass Type</th>
                            <th>Glass Option</th>
{{--                            <th>Glass Thickness</th>--}}
                            <th>Handle</th>
                            <th>Lock Set Type</th>
                            <th>Lock Set Color</th>
                            <th>Predrill Type</th>
                            <th>Wall Thickness</th>
                            <th>Order Qty</th>
{{--                            <th>Unit</th>--}}
                            <th>Unit price</th>
                            <th>Order Amount</th>
                            <th>Discount Rate</th>
                            <th>Discount Amount</th>
                        </tr>
                            @foreach($orderItems as $k=> $item)
                                <tr style="border-bottom: 2px solid black;">
                                <td>{{$k+1}}<td>
                                <td>{{$item->item}}</td>
                                <td>{{$item->prod_type}}</td>
                                <td>{{$item->prod}}</td>
                                <td>{{$item->spec}}</td>
                                <td>{{$item->width}}</td>
                                <td>{{$item->height}}</td>
                                <td>{{$item->panel_type}}</td>
                                <td>{{$item->door_type}}</td>
                                <td>{{$item->door_frame}}</td>
                                <td>{{$item->color_code}}</td>
                                <td>{{$item->glass_type}}</td>
                                <td>{{$item->glass_material}}</td>
                                <td>{{$item->glass_thickness}}</td>
                                <td>{{$item->handle}}</td>
                                <td>{{$item->lock_set_type}}</td>
                                <td>{{$item->lock_set_color}}</td>
                                <td>{{$item->predrill_type}}</td>
                                <td>{{$item->wall_thickness}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>{{$item->unit_price}}</td>
                                <td>{{$item->amount}}</td>
                                <td>{{$item->discount_amount}}</td>
                                <td>{{$item->calculated_discount}}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td style="border-bottom: none;"><br></td>
                            </tr>

                    </table>
                </td>
                </tr>
                <tr>
                    <td colspan="5"><h2>Other Products</h2></td>
                </tr>
            </table>
        </div>
    </body>
</html>