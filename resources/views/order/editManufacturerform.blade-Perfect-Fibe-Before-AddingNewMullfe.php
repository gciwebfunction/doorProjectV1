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
        @php
            if($orderRequest->request_type == '3 level' && $orderRequest->current_level == '3'  && $user->usertype == 'manufacturer' ) {
                $form_method = 'Editmanufacturerreq';
            }elseif($orderRequest->request_type == '3 level' && $orderRequest->current_level == '4'  && $user->usertype == 'distributor' ){
                $form_method = 'Editmanufacturerreq';
            }elseif($orderRequest->request_type == '3 level' && $orderRequest->current_level == '5'  && $user->usertype == 'dealer' ){
                $form_method = 'Editmanufacturerreq';
            }elseif($orderRequest->request_type == '2 level' && $orderRequest->current_level == '2'  && $user->usertype == 'manufacturer' ){
                $form_method = 'Editmanufacturerreq';
            }else{
                $form_method = '    ';
            }
        @endphp
        <form action="/o/{{$form_method}}" method="POST" id="">
            @csrf
            <input type="hidden" id="orderRequestId" name="order_request_id" value="{{$orderRequest->id}}">
            <input type="hidden" id="req_generator_type" name="req_generator_type" value="{{$orderRequest->req_generator_type}}">
            <input type="hidden" id="request_type" name="request_type" value="{{$orderRequest->request_type}}">
            <input type="hidden" id="current_level" name="current_level" value="{{$orderRequest->current_level}}">
            <div class="container">
                <div class="row">
                    <!-- Right  Side html starts -->
{{--                    <div class="col-md-8 mb-4">--}}
                    <div class="col-md-12 mb-4" style="line-height: 25px" >
                        <div style="border: 1px solid black;border-radius: 2px; ">
                            <div class="card-header py-3">
                                <h5 class="mb-0">Update Order Request</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <table class="table-striped" id="orderRequestTable" style="width:100%; margin: 23px 16px 23px 25px;">
                                <tr>
                                    <th>Item</th>
                                    <th>Category </th>
                                    <th>Door Name</th>

                                    <th>Size </th>
                                    <th>Color </th>
                                    <th>Handling </th>
                                    <th>Frame </th>
                                    <th>Handle </th>
                                    <th>Lock</th>
                                    <th>Glass</th>


                                    <th>Qty</th>
                                    <th>Unit Price</th>
                                    <th>Discount</th>
                                    <th>Discount Value</th>
                                    <th>Discount Amt</th>
                                    <th>Extention </th>

                                </tr>
                                @foreach($item_arr as $k => $item)


                                    <tr id="itemRowssss-{{$item['item_id']}}">
                                        <input type="hidden" name="items[]" value="{{$item['item_id']}}" readonly>
                                        <td>{{$k+1}}</td>
                                        <td>{{$item['category_name']}}</td>
                                        <td>{{$item['door_name']}}</td>

                                        <td>@isset($item['SIZE'])
                                                {{$item['SIZE']}}
                                            @endisset</td>
                                        <td>@isset($item['COLOR'])

                                                {{$item['COLOR']}}
                                            @endisset</td>
                                        <td>@isset($item['HANDLING'])

                                                {{$item['HANDLING']}}
                                            @endisset</td>

                                        <td>@isset($item['FRAME'])

                                                {{$item['FRAME']}}
                                            @endisset</td>




                                        <td>@isset($item['HANDLE'])
                                                {{$item['HANDLE']}}
                                            @endisset</td>
                                        <td>@isset($item['LOCK'])
                                                {{$item['LOCK']}}
                                            @endisset</td>
                                        <td>@isset($item['GLASS_OPTION'])
                                                {{$item['GLASS_OPTION']}}
                                            @endisset</td>
                                        <td>{{$item['quantity']}} <input type="hidden" value="{{$item['quantity']}}" id="item_qty{{$item['item_id']}}"></td>
                                        <td>{{$item['price']}} <input type="hidden" value="{{$item['price']}}" id="item_price{{$item['item_id']}}"></td>
{{--                                        <td>{{$item->price*$item->quantity}} </td>--}}

                                        <td><select class="form-control" name="discount_type[]" id="amtpe{{$item['item_id']}}" >
                                                <option value="%" {{ ($item['discount_type']=="%")? "selected" : "" }}>%</option>
                                                <option value="Amt" {{ ($item['discount_type']=="Amt")? "selected" : "" }}>Amt</option>
                                            </select></td>
                                        <td><input type="text" name="discount_amount[]" value="{{$item['discount_amount']}}"   class="form-control discamountcal" id="discamountcal{{$item['item_id']}}" onchange="dis_type('{{$item['item_id']}}')">
                                        </td>

                                        <td><input type="text"  name="calculated_discount[]"  value="{{$item['calculated_discount']}}"  class="form-control discountedamt" id="discountedamtind{{$item['item_id']}}" >
                                        </td>
                                        <td>
                                            <input class="form-control subtotal_price" id="subtotal_price{{$item['item_id']}}"  value="{{ $ttt =  $item['quantity']*$item['price'] - $item['calculated_discount']}}"  name="sub_total[]">
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                                </div>



                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="p-1 m-1 col">
                                            <label class="form-label" for="form7Example2">Freight term</label>
                                            <input type="text"
                                                   class="form-control{{ $errors->has('freight_term') ? ' is-invalid': '' }}"
                                                   id="freight_term"
                                                   name="freight_term" value="{{$orderRequest->freight_term}}"
                                                   autocomplete="freight_term">
                                        </div>
                                        <div class="p-1 m-1 col">
                                            <label class="form-label" for="form7Example2">Transportation Mode</label>
                                            <input type="text"
                                                   class="form-control{{ $errors->has('transportation_mode') ? ' is-invalid': '' }}"
                                                   id="transportation_mode"
                                                   name="transportation_mode" value="{{$orderRequest->transportation_mode}}"
                                                   autocomplete="transportation_mode">
                                        </div>
{{--                                        //@if($user->usertype != 'manufacturer' )--}}
                                        <div class="p-1 m-1 col">
                                            <label class="form-label" for="form7Example2"><b>Order Notes</b></label>
                                            <br>
                                            @foreach($orderRequestnotes as $OrderRequestNot)
                                                {{$OrderRequestNot->order_note}}
                                            @endforeach
                                        </div>
{{--                                        @endif--}}
                                        <div class="p-1 m-1 col">
                                            <label class="form-label" for="form7Example2">Message</label>
                                            <textarea
                                                   class="form-control{{ $errors->has('message') ? ' is-invalid': '' }}"
                                                   id="message"
                                                   name="message"
                                                   autocomplete="message"></textarea>
                                        </div>


                                    </div>



                                    <div class="col-md-4" >
                                        @if($user->usertype != 'manufacturer' )
                                        <div class="p-1 m-1 col">
                                            <label class="form-label" for="form7Example1">Address</label>
                                            <select name="add_sel" class="form-control" required id="drop_sho">
                                                <option value="">Select</option>
                                                <option value="Own">Own</option>
                                                <option  value="Drop Shipping">Drop Shipping</option>
                                            </select>
                                        </div>

                                        <div class="p-1 m-1 col" id="own" style="display: none">
                                            <input type="text"
                                                   class="form-control{{ $errors->has('address1') ? ' is-invalid': '' }}"
                                                   id="shipping_address"
                                                   name="shipping_address" readonly
                                                   value="{{$shipping_address}}"
                                                   autocomplete="shipping_address">
                                        </div>



                                        <div class="p-1 m-1 col" id="dropshipping" style="display: none;" >

                                            <label class="form-label" for="form7Example1"> Address</label>
                                            <input type="text"
                                                   class="form-control{{ $errors->has('address1') ? ' is-invalid': '' }}"
                                                   id="dropshipadd"
                                                   name="dropshipadd"
                                                   value=""
                                                   autocomplete="dropshipadd">
                                            <br>
                                            <table>
                                                <tr>
                                                    <td><label class="form-label" for="form7Example1"> City</label></td>
                                                    <td><label class="form-label" for="form7Example1"> State</label></td>
                                                    <td><label class="form-label" for="form7Example1"> Zip</label></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text"
                                                               class="form-control{{ $errors->has('address1') ? ' is-invalid': '' }}"
                                                               id="state"
                                                               name="state"
                                                               value=""
                                                               autocomplete="state"></td>
                                                    <td><input type="text"
                                                               class="form-control{{ $errors->has('address1') ? ' is-invalid': '' }}"
                                                               id="city"
                                                               name="city"
                                                               value=""
                                                               autocomplete="city"></td>
                                                    <td><input type="text"
                                                               class="form-control"
                                                               id="zip"
                                                               name="zip"
                                                               value=""
                                                               autocomplete="zip"></td>
                                                </tr>
                                            </table>
                                        </div>
                                        @endif


                                        <script>

                                            $("#drop_sho").change(function() {
                                                var ssa = $(this).val();
                                                if(ssa == "Own"){
                                                    $("#own").show();
                                                    $("#dropshipping").hide();
                                                }
                                                if(ssa == "Drop Shipping"){
                                                    $("#own").hide();
                                                    $("#dropshipping").show();
                                                }
                                            });
                                        </script>



                                            <div class="p-1 m-1 col">
                                                <label class="form-label" for="form7Example1">Expected Shipping Date</label>
                                                <input type="text"  readonly class="form-control"  value="{{date('m-d-Y', strtotime('+20 day'))}}">
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
                                                    <label class="form-label" for="form7Example1"> Shipping Date</label>
                                                    <input type="text"
                                                           class="form-control{{ $errors->has('manufacturer_shipping_date') ? ' is-invalid': '' }}"
                                                           id="manufacturer_shipping_date"
                                                           name="manufacturer_shipping_date" value="{{Date('m-d-Y', strtotime('+14 days'))}}"
                                                           autocomplete="manufacturer_shipping_date">
                                                </div>


                                        <div class="p-1 m-1 col">
                                            <label class="form-label" for="form7Example2">Shipping Instruction</label>
                                            <input type="text"
                                                   class="form-control{{ $errors->has('shipping_instructions') ? ' is-invalid': '' }}"
                                                   id="shipping_instructions"
                                                   name="shipping_instruction" value="{{ $orderRequest->shipping_instruction}}"
                                                   autocomplete="shipping_instructions">
                                        </div>

                                        <div class="form-outline">
                                            <div class="p-1 m-1 col">
                                                <label class="form-label" for="form7Example2">Package Instruction</label>
                                                <input type="text"
                                                       class="form-control{{ $errors->has('package_instruction') ? ' is-invalid': '' }}"
                                                       id="package_instruction"
                                                       name="package_instruction" value="{{ $orderRequest->package_instruction}}"
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

{{--                                    tyle="font-weight: bold"--}}
                                    <div class="col-md-4">
                                        <div class="p-1 m-1 col" style="float: right">
                                            <label class="form-label"  for="form7Example1">
{{--                                                <span>Sub Total :</span> $<span id="total_value">{{ $orderRequest->total}}</span>--}}
                                                <span>Sub Total &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                                                    </span>$<span id="total_value">{{ sprintf('%0.02f',($itemTotals  )  )}}
                                                </span>
                                            </label>
                                        </div>



                                        <div class="p-1 m-1 col" style="float: right">
                                            <label class="form-label"  for="form7Example1">Additional Discount:
                                                <input type="radio" id="" name="add_disc_type" {{ ($orderRequest->add_disc_type=="%")? "checked" : "" }} value="%"><label>%</label>
                                                <input type="radio" id="" name="add_disc_type" {{ ($orderRequest->add_disc_type=="Amt")? "checked" : "" }} value="Amt"><label>Amt</label>
                                            </label>

                                            <input type="number"  id="add_disc_val" style="width: 29%"
                                                   name="add_disc_val" value="{{$orderRequest->add_disc_val}}" class="for" min="0" >

                                            <input type="hidden" value="{{$orderRequest->add_disc_amt}}" name="add_disc_amt" id="add_disc_amt">
                                            <br>
                                            <span> Additional Discount: $</span><span    id="add_disc_text">{{$orderRequest->add_disc_amt}}</span>
                                        </div>

                                        <div class="p-1 m-1 col" style="float: right; display: block;">
                                            <label class="form-label"  for="form7Example1">
                                                <span> Total Discount : $</span>
                                                <span id=""><input type="text" id="total_disc_amt" value="{{$orderRequest->add_disc_amt + $itemTotal_dis}}" readonly style="width: 29%"></span>
                                                {{--                                                <input type="hidden" id="total_value_field" value="{{$orderRequest->total}}" name="total_value_field" >--}}
                                            </label>
                                        </div>

                                            @if($orderRequest->shipping_fee	 >= 1 )
                                                 @php
                                                    $shipping_fee = $orderRequest->shipping_fee
                                                 @endphp
                                            @else
                                                @php
                                                  $shipping_fee = 0
                                                @endphp
                                            @endif


                                        <div class="p-1 m-1 col" style="float: right">
                                            <label class="form-label"  for="mull_fee">Mull Fee : </label>
                                            <input type="number" min="0"  required  class="form-control"   id="mull_fee"
                                                   name="mull_fee" value="{{$shipping_fee}}"
                                                   autocomplete="mull_fee">
                                        </div>

                                        <div class="p-1 m-1 col" style="float: right">
                                                <label class="form-label"  for="form7Example1">Shipping Fee : </label>
                                                    <input type="number" min="0"  required  class="form-control"   id="delivery_charges"

                                                           name="shipping_fee" value="{{$shipping_fee}}"
                                                           autocomplete="delivery_charges">
                                        </div>

                                        <div class="p-1 m-1 col" style="float: right">
                                            @php
                                            if (empty($orderRequest->total)){
                                                $rtotal = $itemTotals - $orderRequest->add_disc_amt - $orderRequest->add_disc_amt +  $orderRequest->shipping_fee;
                                            }else{
                                                $rtotal = $orderRequest->total;
                                            }
                                            @endphp
                                            <label class="form-label"  for="form7Example1">Total:$<span id="total_text">{{ sprintf('%0.02f',$rtotal)}}</span> </label>
                                            <input type="hidden"   class="form-control"   id="total" value="{{$rtotal}}" name="total" >
                                        </div>
                                        <div class="p-1 m-1 col" style="float: right">
                                            <input type="button"  id="recalculate" value="Re-Calculate"  class="btn btn-primary" style="background-color: green;">
                                        </div>

                                        <script type="text/javascript">

                                            $(document).ready(function(){
                                                //$('#add_disc_val').mouseout(function(){
                                                var allitems_discount   = 0;
                                                var allitems_subtotal   = 0;
                                                var add_disc_typing;
                                                var add_disc_valing     = 0;
                                                var add_disc_cal_val    = 0;
                                                var comp_discount       = 0;
                                                var deliver_charge      = 0;

                                                $('#recalculate').click(function(){
                                                    allitems_subtotal = 0;
                                                    allitems_discount = 0;
                                                    //alert('asdadad');
                                                    // all items discount sum
                                                    $('.form-control.discountedamt').each(function(){
                                                        allitems_discount+= parseFloat($(this).val());
                                                    });

                                                    // all items sub total
                                                    $('.form-control.subtotal_price').each(function(){

                                                        allitems_subtotal+= parseFloat($(this).val());
                                                    });

                                                    $('#total_value').text(allitems_subtotal.toFixed(2));

                                                    // get the additional discount type
                                                    add_disc_typing = $('input[name="add_disc_type"]:checked').val();
                                                    // get the additional discount val
                                                    add_disc_valing = $('#add_disc_val').val();

                                                    if(isNaN(allitems_discount)) {
                                                        allitems_discount = 0;
                                                    }

                                                    if(add_disc_typing == '%'){

                                                        add_disc_cal_val    =  parseFloat( parseFloat(allitems_subtotal) * (parseFloat(add_disc_valing)/100));
                                                        add_disc_cal_val    =  add_disc_cal_val.toFixed(2) ;

                                                        comp_discount       = add_disc_cal_val + allitems_discount;
                                                        comp_discount       = parseFloat(comp_discount).toFixed(2);

                                                        $('#add_disc_text').html(add_disc_cal_val);
                                                        $('#add_disc_amt').val(add_disc_cal_val);
                                                        $('#total_disc_amt').val(comp_discount);

                                                        deliver_charge      = parseFloat( $('#delivery_charges').val());
                                                        var total_va_tmp    = parseFloat($('#total_value').text());

                                                        last_vel            = total_va_tmp + deliver_charge-add_disc_cal_val;
                                                        last_vel            = parseFloat(last_vel).toFixed(2);
                                                        $('#total_text').text(last_vel);
                                                        $('#total').val(last_vel);
                                                    }

                                                    if(add_disc_typing == 'Amt'){
                                                        //add_disc_cal_val    =  parseFloat( parseFloat(allitems_subtotal) * (parseFloat(add_disc_valing)/100));
                                                        //alert(add_disc_valing);
                                                        add_disc_cal_val    =  parseFloat( add_disc_valing);
                                                        //add_disc_cal_val    =   add_disc_valing.toFixed(2);
                                                        //alert(add_disc_valing);


                                                        comp_discount       = add_disc_cal_val + allitems_discount;
                                                        comp_discount       = parseFloat(comp_discount);
                                                        //comp_discount       = parseFloat(comp_discount).toFixed(2);

                                                        $('#add_disc_text').html(add_disc_cal_val);
                                                        $('#add_disc_amt').val(add_disc_cal_val);
                                                        $('#total_disc_amt').val(comp_discount);

                                                        deliver_charge      = parseFloat( $('#delivery_charges').val());
                                                        var total_va_tmp    = parseFloat($('#total_value').text());

                                                        last_vel            = total_va_tmp + deliver_charge-add_disc_cal_val;
                                                        last_vel            = parseFloat(last_vel).toFixed(2);
                                                        $('#total_text').text(last_vel);
                                                        $('#total').val(last_vel);
                                                    }
                                                });
                                            });
                                        </script>
                                    </div>


                                    <div class="col-md-6" >
                                        <div class="form-outline">

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6" style="margin-left:7px;margin-top:10px;">
                                        <div class="p-6 bg-white border-b border-gray-200  ">
                                                <input type="submit" value="Update Request"  class="btn btn-primary">
                                        </div>
                                    </div>
                                </div>

{{--                            items total discount =  200 <br>--}}
{{--                            Summary discount =  100 <br>--}}
{{--                            total = 9857 -4758 = 5099--}}
                        </div>

                    </div>
                </div>
                    <!-- Right  Side html ends -->



                </div>
            </div>

        </form>
    </div>
            @section('scripts')
                <script src="{{ asset('js/orderrequest/finalize.js') }}" defer></script>
    @stop

    <script type="text/javascript">

        var valeeees;
        var cechk_vale;
        var add_disc_rs;
        var last_vel;
        var totaldisc_amt_sum;
        var all_desc;
        var deliver_charge;
        //var total_va_tmp = 0;

        $('input[type=radio][name=add_disc_type]').change(function(){
            //if($(this).is(':checked')) {//$('#add_disc_val').attr('required');
            // else { $('#add_disc_val').removeAttr('required');  }

            $('#add_disc_val').prop('required', true);

            totaldisc_amt_sum   = 0;
            all_desc            = 0;
            last_vel            = 0;

            $('#add_disc_val').val('');
            $('#add_disc_amt').val('');
            $('#total_disc_amt').val('');
            $('#add_disc_text').html('');
        });

        //$('#add_disc_val').change(function(){
            //$('input[type=radio][name=add_disc_type]').prop('disabled', true);
        $(document).ready(function(){
            //$('#add_disc_val').mouseout(function(){
            $('#add_disc_val').change(function(){
                //$('input[type=radio][name=add_disc_type]').prop('disabled', true);
                $('input[type=text][name=add_disc_val]').prop('readonly', true);


                totaldisc_amt_sum   = 0;
                all_desc            = 0;
                last_vel            = 0;

                $('.form-control.discountedamt').each(function(){
                    if( $(this).val() != '' ) totaldisc_amt_sum += parseFloat($(this).val());
                });
                //totaldisc_amt_sum.toFixed(2);

                //alert($('input[type=radio][name=add_disc_type]').val());
                cechk_vale = $('input[name="add_disc_type"]:checked').val();

                var add_disc_val = parseFloat($('#add_disc_val').val());
                var total_va_tmp = parseFloat($('#total_value').text());

                if(cechk_vale == '%'){

                    all_desc        = 0;
                    add_disc_rs_tm  =  parseFloat( parseFloat(total_va_tmp) * (parseFloat(add_disc_val)/100));
                    add_disc_rs     =  add_disc_rs_tm.toFixed(2) ;


                    //alert(total_va_tmp);
                    //alert(add_disc_rs);
                    //alert(add_disc_rs);
                    all_desc        = add_disc_rs + totaldisc_amt_sum;
                    all_desc        = parseFloat(all_desc).toFixed(2);


                    $('#add_disc_text').html(add_disc_rs);
                    $('#add_disc_amt').val(add_disc_rs);
                    $('#total_disc_amt').val(all_desc);

                    // calculating total amt

                    deliver_charge  = parseFloat( $('#delivery_charges').val());
                    //var add_disc        = add_disc_val;
                    //if(deliver_charge < total_value) {
                        last_vel = total_va_tmp + deliver_charge-all_desc;
                        last_vel = parseFloat(last_vel).toFixed(2);
                        $('#total_text').text(last_vel);
                        $('#total').val(last_vel);
                    //}

                }//else{
                if(cechk_vale == 'Amt'){
                    //totaldisc_amt_sum   = 0;
                    all_desc            = 0;
                    //last_vel            = 0;

                    add_disc_rs  =  add_disc_val;
                    //alert(add_disc_rs);
                    all_desc     = add_disc_rs + totaldisc_amt_sum;
                    all_desc     = parseFloat(all_desc).toFixed(2);
                    $('#add_disc_text').html(add_disc_rs);
                    $('#add_disc_amt').val(add_disc_rs);
                    $('#total_disc_amt').val(all_desc);

                    // calculating total amt

                    deliver_charge  = parseFloat( $('#delivery_charges').val());

                    //last_vel        = total_va_tmp + deliver_charge-all_desc;
                    last_vel        = total_va_tmp + deliver_charge-add_disc_rs;


                    //alert(total_value);alert(deliver_charge);alert(all_desc);

                    last_vel        = parseFloat(last_vel).toFixed(2);

                    $('#total_text').text(last_vel);
                    $('#total').val(last_vel);
                }

            });

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
            var total_text          = "#total_text";
            var quartnitit          = parseFloat($("#item_qty"+idd).val());


            var sumii;

            var discountedamtind = 0;
            if(amtpeval =='%'){
                //discamountaftercal = ;
                discountedamtind =  parseFloat( parseFloat(item_pr_prval) * (parseFloat(discamountcalval)/100));

                subtotal_price_val = (parseFloat(item_pr_prval) -    discountedamtind) * quartnitit;
                $(subtotal_price).val(subtotal_price_val);



                // assign value to the amt
                $("#discountedamtind"+idd).val(parseFloat(discountedamtind*quartnitit));


            }else{
                discountedamtind =  parseFloat( parseFloat(item_pr_prval) - parseFloat(discamountcalval));
                subtotal_price_val = (parseFloat( discountedamtind) ) * quartnitit;
                $(subtotal_price).val(subtotal_price_val);
                $("#discountedamtind"+idd).val(parseFloat(parseInt(discamountcalval)*quartnitit));


            }

            $('.form-control.subtotal_price').each(function(){
                sum+= parseFloat($(this).val());
            });


            sumii = sum;
            var total_disc_amt_sum = 0;
            $('.form-control.discountedamt').each(function(){
                total_disc_amt_sum+= parseFloat($(this).val());
            });


            sumiiuuu  = sumii.toFixed(2);
            $('#total_value').html(sumiiuuu);
            $('#total_value_field').val(sumiiuuu);

            // total fields
            $(total_text).html(sumiiuuu);
            $('#total').val(sumiiuuu);

            $('#total_disc_amt').html(total_disc_amt_sum);
            //var sum                     = 0;
        }

        $(document).ready(function () {
            $('#delivery_charges').change(function (){
            //$('#delivery_charges').mouseout(function (){
                var total_value     = parseFloat($('#total_value').text());
                var deliver_charge  = parseFloat( $(this).val());
                //delivery_charges
                //var add_disc        = parseFloat( $('#total_disc_amt').val());

                //read it from the  add_disc_text OR add_disc_amt
                //var add_disc        = parseFloat( $('#add_disc_text').text());
                var add_disc        = parseFloat( $('#add_disc_amt').val());
                if(isNaN(add_disc)) {
                    var add_disc = 0;
                }
                //alert('Sub_total_value'+total_value);alert('deliver_charge'+deliver_charge);alert('additinol_disc'+add_disc);

                //if(deliver_charge < total_value) {
                    var sdsd = (total_value + deliver_charge-add_disc).toFixed(2);

                    $('#total_text').text(sdsd);
                    $('#total').val(sdsd);
                //}
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
