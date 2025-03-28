<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manufacturer Update Order Request Form')  }}
        </h2>
    </x-slot>
    <div class=" text-center" style=" margin: 0 auto; padding-bottom: 0rem !important;padding-top: 0rem !important;"> <h3>  Order Request Detail</h3> </div>
    <style>
        .form-label{
            font-size: 10px !important; margin-bottom: 0px !important;
        }
        #orderRequestTable tr {
            text-align: center;
            vertical-align: top;
        }

        .form-control{
            display: block;
            width: 100%;
            height: calc(2.25rem + 2px);
            padding: .1rem .4rem;
            font-size: 10px !important;
            line-height: 0.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }

    </style>
    <div class="container" style="min-width: 1350px;">
        @php
            if($orderRequest->request_type == '3 level' && $orderRequest->current_level == '2' ) {
                $form_method = 'manufacturerReqconfirm';
            }else{
                $form_method = '    ';
            }
        @endphp
        <form action="/o/{{$form_method}}" method="POST" >
            @csrf
            <input type="hidden" id="orderRequestId" name="order_request_id" value="{{$orderRequest->id}}">
{{--            <div class="container">--}}
                <div class="row">
                    <div class="col-md-12 mb-4" style="line-height: 20px">
                        <div style="border: 1px solid black;border-radius: 2px;">
                            <div class="card-body">
                                <div class="row">
                                    <table class="table-striped" id="orderRequestTable" style="width:100%; margin: 0px 6px 1px 3px; font-size:11px">
                                    <tr>
                                        <th>No.</th>
                                        <th>Type </th>
                                        <th>Name</th>
                                        <th>Size</th>
                                        <th>Color</th>
                                        <th>Door Handling</th>
                                        <th>DP Option</th>
                                        <th>Glass Option</th>
                                        <th>Blind</th>
                                        <th>Glass Grid</th>
                                        <th>3/4 Lite</th>
                                        <th>Frame Thickness</th>
                                        <th>Handle</th>
                                        <th>Lock</th>
                                        <th>Sill </th>
                                        <th>Screen</th>
                                        <th>Handle Color</th>
                                        <th>Lock Color</th>
                                        <th>Sill Color</th>
                                        <th>Hinge Color</th>
                                        <th>Assemble</th>
                                        <th>Qty</th>
                                        <th>Unit Prices</th>
{{--                                        <th>Discount</th>--}}
{{--                                        <th>Discount Val</th>--}}
                                        <th>Discount Amt</th>
                                        <th>Extention</th>
                                </tr>

                                            @php($sdfsdf = 0)

                                            @foreach($item_arr as $k => $item)
                                        <tr id="itemRowssss-{{$item['item_id']}}">
                                            <input type="hidden" name="items[]" value="{{$item['item_id']}}" readonly>
                                            <td>{{$k+1}}</td>
                                            <td>{{$item['category_name']}}</td>
                                            <td>{{$item['door_name']}}</td>
                                            <td>@isset($item['SIZE']){{$item['SIZE']}}@endisset</td>
                                            <td>@isset($item['COLOR']){{$item['COLOR']}}@endisset</td>
                                            <td>@isset($item['HANDLING']){{$item['HANDLING']}}@endisset</td>
                                            <td>@isset($item['DP_OPTION']){{$item['DP_OPTION']}}@endisset</td>
                                            <td>@isset($item['GLASS_OPTION']){{$item['GLASS_OPTION']}}@endisset</td>
                                            <td>@isset($item['BLIND_OPTION']){{$item['BLIND_OPTION']}}@endisset</td>
                                            <td>@isset($item['GLASS_GRID']){{$item['GLASS_GRID']}}@endisset</td>
                                            <td>@isset($item['LITE_OPTION']){{$item['LITE_OPTION']}}@endisset</td>
                                            <td>@isset($item['FRAME_THICKNESS_OPTION']){{$item['FRAME_THICKNESS_OPTION']}}@endisset</td>
                                            <td>@isset($item['SILL_OPTION']){{$item['SILL_OPTION']}}@endisset</td>

                                            <td>@isset($item['HANDLE']){{$item['HANDLE']}}@endisset</td>
                                            <td>@isset($item['LOCK']){{$item['LOCK']}}@endisset</td>
                                            <td>@isset($item['SILL_OPTION']){{$item['SILL_OPTION']}}@endisset</td>
                                            <td>@isset($item['SCREEN_OPTION']){{$item['SCREEN_OPTION']}}@endisset</td>

                                            <td>@isset($item['HANDLE_COLOR_OPTION']){{$item['HANDLE_COLOR_OPTION']}}@endisset</td>
                                            <td>@isset($item['LOCK_COLOR_OPTION']){{$item['LOCK_COLOR_OPTION']}}@endisset</td>
                                            <td>@isset($item['SILL_COLOR_OPTION']){{$item['SILL_COLOR_OPTION']}}@endisset</td>
                                            <td>@isset($item['HINGE_COLOR_OPTION']){{$item['HINGE_COLOR_OPTION']}}@endisset</td>
                                            <td>@isset($item['assemble_knock']){{$item['assemble_knock']}}@endisset</td>

                                            <td>{{$item['quantity']}} <input type="hidden" value="{{$item['quantity']}}" id="item_qty{{$item['item_id']}}"></td>
                                            <td>{{sprintf('%0.02f', $item['price'])}} <input type="hidden" value="{{$item['price']}}" id="item_price{{$item['item_id']}}"></td>

                                            <td><input type="text"  readonly name="calculated_discount[]"  value="{{sprintf('%0.02f',$item['calculated_discount'])}}"  class="form-control discountedamt" id="discountedamtind{{$item['item_id']}}" > </td>
                                            <td>
                                                <input class="form-control subtotal_price" id="subtotal_price{{$item['item_id']}}"  value="{{sprintf('%0.02f',$item['sub_total'])}}"  name="sub_total[]">
                                            </td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>

                            <?php
                            if(sizeof($orderRequestProducts) >=1){
                            ?>
                            <div class="card-body">
                                <div class="row">
                                    <table class="table-striped" id="orderRequestTable" style="width:100%; margin: 0px 6px 1px 3px; font-size:11px">
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
                                </div>
                            </div>
                            <?php
                            }
                            ?>


                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="p-1 m-1 col">
                                            <label class="form-label" for="form7Example2">Freight term</label>
                                            <input type="text" readonly
                                                   class="form-control{{ $errors->has('freight_term') ? ' is-invalid': '' }}"
                                                   id="freight_term"
                                                   name="freight_term" value="{{$orderRequest->freight_term}}"
                                                   autocomplete="freight_term">
                                        </div>
                                        <div class="p-1 m-1 col">
                                            <label class="form-label" for="form7Example2">Transportation Mode</label>
                                            <input type="text" readonly
                                                   class="form-control{{ $errors->has('transportation_mode') ? ' is-invalid': '' }}"
                                                   id="transportation_mode"
                                                   name="transportation_mode" value="{{$orderRequest->transportation_mode}}"
                                                   autocomplete="transportation_mode">
                                        </div>


                                        <div class="form-outline">
                                            <div class="p-1 m-1 col">
                                                <label class="form-label" for="form7Example2"><b>Message</b></label>
                                                <br>
                                                @foreach($orderRequestmsgs as $orm)
                                                    <label class="form-label">{{$orm->message}}</label>
                                                    <br>
                                                @endforeach
                                            </div>
                                        </div>

                                    </div>



                                    <div class="col-md-4" >
                                        <div class="p-1 m-1 col">
                                            <label class="form-label" for="form7Example1">Shipping Address</label>

                                            <input type="text"  value="{{ $distiryAdd ?? '' }}"
                                                   class="form-control{{ $errors->has('address1') ? ' is-invalid': '' }}"
                                                   id="shipping_address"
                                                   name="shipping_address" readonly
                                                   autocomplete="shipping_address">
                                        </div>

                                        @if($user->usertype != 'manufacturer' )
                                            <div class="p-1 m-1 col">
                                                <label class="form-label" for="form7Example1">Expected Shipping Date</label>

                                                <input type="text"
                                                       class="form-control{{ $errors->has('expected_shipping_date') ? ' is-invalid': '' }}"
                                                       id="expected_shipping_date"
                                                       name="expected_shipping_date" value="{{date('m-d-Y',strtotime($orderRequest->expected_shipping_date))}}"
                                                       autocomplete="expected_shipping_date">
                                            </div>
                                        @endif

                                        <div class="form-outline">
                                            <div class="p-1 m-1 col">
                                                <label class="form-label" for="form7Example2">Package Instruction</label>
                                                <input type="text"
                                                       class="form-control{{ $errors->has('package_instruction') ? ' is-invalid': '' }}"
                                                       id="package_instruction" value="{{$orderRequest->package_instruction}}"
                                                       name="package_instructio" readonly
                                                       autocomplete="package_instruction">
                                            </div>
                                        </div>
                                        <div class="p-1 m-1 col">
                                            <label class="form-label" for="form7Example2">Shipping Instruction</label>
                                            <input type="text"
                                                   class="form-control{{ $errors->has('shipping_instructions') ? ' is-invalid': '' }}"
                                                   id="shipping_instructions" readonly
                                                   name="shipping_instructions" value="{{$orderRequest->shipping_instruction}}"
                                                   autocomplete="shipping_instructions">
                                        </div>




{{--                                        @if($user->usertype != 'manufacturer' )--}}
                                            <div class="form-outline">
                                                <div class="p-1 m-1 col">
                                                    <label class="form-label" for="form7Example2">PO Number</label>
                                                    <input type="text"
                                                           class="form-control{{ $errors->has('po_number') ? ' is-invalid': '' }}"
                                                           id="po_number" readonly
                                                           name="po_number" value="{{$orderRequest->po_number}}"
                                                           autocomplete="po_number">
                                                </div>
                                            </div>

                                            <div class="form-outline">

                                                <div class="p-1 m-1 col">
                                                    <label class="form-label" for="form7Example2"><b>Order Notes</b></label>
                                                    <br>
                                                    @foreach($OrderRequestNotes as $orderRequestnote)
                                                        <label class="form-label">{{$orderRequestnote->order_note}}</label>
                                                        <br>
                                                    @endforeach
                                                </div>

                                            </div>

{{--                                        @endif--}}

                                </div>

{{--                                    tyle="font-weight: bold"--}}
                                    <div class="col-md-4">
                                        <div class="p-1 m-1 col" style="float: right">
                                            <label class="form-label"  for="form7Example1">
{{--                                                <span>Sub Total :</span> $<span id="total_value">{{ $orderRequest->total}}</span>--}}
                                                <span class="form-label">Sub Total &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                                                    </span>$<span id="total_value">{{  sprintf('%01.2f',$sub_total) }}</span>
                                            </label>
                                        </div>



                                        <div class="p-1 m-1 col" style="float: right">

                                            <label class="form-label"  for="form7Example1">Additional discount :
                                                <input type="radio" disabled id="" name="add_disc_type" {{ ($orderRequest->add_disc_type=="%")? "checked" : "" }} value="%"><label>%</label>
                                                <input type="radio" disabled id="" name="add_disc_type"  {{ ($orderRequest->add_disc_type=="Amt")? "checked" : "" }} value="Amt"><label>Amt</label>
                                            </label>



                                                <input type="number" readonly  id="add_disc_val" style="width: 29%"
                                                       name="add_disc_val" value="{{$orderRequest->add_disc_val}}" class="for" min="1" >

                                                <input type="hidden" name="add_disc_amt" id="add_disc_amt">

                                                <br>

                                                <span class="form-label"> Additional Discount: $</span><span    id="add_disc_text">{{$orderRequest->add_disc_amt}}</span>


                                        </div>

                                        <div class="p-1 m-1 col" style="float: right; visibility: hidden;">
                                            <label class="form-label"  for="form7Example1">
                                                <span> Total Discount : $</span> <span id="total_disc_amt"></span>
                                            </label>
                                        </div>

                                        <div class="p-1 m-1 col" style="float: right">

                                            <label class="form-label"  for="form7Example1">Mull Fee : </label>
                                            <input type="text"  readonly  class="form-control"   id="mull_fee"
                                                   name="mull_fee" value="{{$orderRequest->mull_fee}}"
                                                   autocomplete="mull_fee">

                                        </div>

                                        <div class="p-1 m-1 col" style="float: right">

                                                <label class="form-label"  for="form7Example1">Shipping Fee : </label>
                                                    <input type="text"  readonly  class="form-control"   id="delivery_charges"
                                                           name="shipping_fee" value="{{$orderRequest->shipping_fee}}"
                                                           autocomplete="delivery_charges">

                                        </div>
                                        <div class="p-1 m-1 col" style="float: right">
                                                <label class="form-label"  for="form7Example1">Total: $<span id="total_text">{{ sprintf('%01.2f',$orderRequest->total) }}</span> </label>

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6" style="margin-left:7px;margin-top:10px;">
                                        <div class="p-6 bg-white border-b border-gray-200  ">
                                            @if($orderRequest->request_type == '3 level' && $orderRequest->current_level == '2' && $user->usertype == 'distributor' )
                                                <input style="background: green" type="submit" id="accept_order" value="Convert"    class="btn btn-primary"> |
                                            @endif
                                                <input style="background: orange" type=button class="btn btn-primary" onClick="location.href='/o'" value='Back'>
                                        </div>
                                    </div>
                                </div>

                        </div>

                    </div>
                </div>
                    <!-- Right  Side html ends -->



                </div>
{{--            </div>--}}

        </form>
    </div>
            @section('scripts')
                <script src="{{ asset('js/orderrequest/finalize.js') }}" defer></script>
    @stop
    <script type="text/javascript">

        <?php  $orderRequest_id = $orderRequest->id; ?>

        /*$('#accept_order').click(function(){
            window.location.replace="<?php '/o/Distributor_request_update/accept/'.$orderRequest_id;?>";
            //alert('asdadiidd');
        });*/

        $('#recject_order').click(function(){
            //alert('asdaduuusdususd');
            window.location.replace="<?php '/o/Distributor_request_update/reject/'.$orderRequest_id;?>";
        });


        var valeeees;
        var cechk_vale;
        var add_disc_rs;
        //var total_va_tmp = 0;
        $('input[type=radio][name=add_disc_type]').change(function(){
            $('#add_disc_val').val('');
            $('#add_disc_amt').val('');
            $('#add_disc_text').html('');
        });
        $('#add_disc_val').change(function(){

            var totaldisc_amt_sum = 0;
            $('.form-control.discountedamt').each(function(){
                totaldisc_amt_sum+= Number($(this).val());
            });

            //alert($('input[type=radio][name=add_disc_type]').val());
            cechk_vale = $('input[name="add_disc_type"]:checked').val();
            var add_disc_val = Number($('#add_disc_val').val());
            var total_va_tmp = Number($('#total_value').text());

            if(cechk_vale == '%'){
                add_disc_rs  = parseFloat( (total_va_tmp  * 10) / 100 ).toFixed(2);
                all_desc     = add_disc_rs + totaldisc_amt_sum;

                $('#add_disc_text').html(add_disc_rs);
                $('#add_disc_amt').val(add_disc_rs);
                $('#total_disc_amt').val(all_desc);
            }

            if(cechk_vale == 'Amt'){
                add_disc_rs  =  add_disc_val;
                $('#add_disc_text').html(add_disc_rs);
                $('#add_disc_amt').val(add_disc_rs);
                $('#total_disc_amt').val(all_desc);
            }
        });

        var total_disc_amt_sum      = 0;

        function dis_type(idd){
            var sum                     = 0;
            var amtpe               = "#amtpe"+idd;
            var amtpeval            = $(amtpe).val();

            var discamountcal       = "#discamountcal"+idd;
            var discamountcalval    = $(discamountcal).val();

            var item_prval          = $("#item_price"+idd);
            var item_pr_prval       = item_prval.val();

            var subtotal_price_val;
            var subtotal_price      = "#subtotal_price"+idd;
            var quartnitit          = parseInt($("#item_qty"+idd).val());


            var sumii;

            var discountedamtind = 0;
            if(amtpeval =='%'){
                //discamountaftercal = ;
                discountedamtind =  parseInt( parseInt(item_pr_prval) * (parseInt(discamountcalval)/100));

                subtotal_price_val = (parseFloat(item_pr_prval) -    discountedamtind) * quartnitit;
                $(subtotal_price).val(subtotal_price_val);
                // assign value to the amt
                $("#discountedamtind"+idd).val(parseFloat(discountedamtind*quartnitit));


            }else{
                discountedamtind =  parseInt( parseInt(item_pr_prval) - parseInt(discamountcalval));
                subtotal_price_val = (parseFloat( discountedamtind) ) * quartnitit;
                $(subtotal_price).val(subtotal_price_val);
                $("#discountedamtind"+idd).val(parseFloat(parseInt(discamountcalval)*quartnitit));
            }

            $('.form-control.subtotal_price').each(function(){
                sum+= Number($(this).val());
            });

            // check not empty deliver charges
            //var deliver_val = Number($('#delivery_charges').val());

            //alert(sum+'sadad');
            /*if( deliver_val >=1 ){
                sumii = sum-deliver_val;
            }else{} */

            sumii = sum;
            var total_disc_amt_sum = 0;
            $('.form-control.discountedamt').each(function(){
                total_disc_amt_sum+= Number($(this).val());
            });

            //alert(total_disc_amt_sum);

            $('#total_value').html(sumii);
            $('#total_value_field').val(sumii);
            $('#total_disc_amt').html(total_disc_amt_sum);
            //var sum                     = 0;
        }

        $(document).ready(function () {
            $('#delivery_charges').change(function (){
                //$('#delivery_charges').mouseout(function (){
                var total_value     = Number($('#total_value').text());
                var deliver_charge  = Number( $(this).val());
                var add_disc        = Number( $('#add_disc_text').text());
                if(deliver_charge < total_value) {
                    var last_vel = total_value + deliver_charge-add_disc;


                    $('#total_text').text(last_vel);
                    $('#total').val(last_vel);
                }
            });
        });


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
