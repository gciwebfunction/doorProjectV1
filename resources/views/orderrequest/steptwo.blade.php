<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Detailsss')  }}
        </h2>
    </x-slot>
    <div class="py-7 text-center">
        <h2>Order Details</h2>
        <p class="lead">Verify or update the address information below.</p>
        <div class="row flex m-3">

        </div>
    </div>
    <div class="container  mt-4" style="">
        <form action="/or/finalize" method="POST" id="cartItemForm">
            @csrf
            <input type="hidden" id="orderRequestId" name="order_request_id" value="{{$orderRequest->id}}">
            <div class="container">
                <div class="row">

                    <div class="col-md-8 mb-4">
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <span class="" role="alert" style="color: red">
                                        <strong>{{$error}}</strong>
                                    </span>
                        @endforeach
                    @endif
                    </div>

                    <div class="col-md-8 mb-4">
                        <div class="card mb-4">
                            <div class="card-header py-3">
                                <h5 class="mb-0">Shipping Address</h5>
                            </div>


                            <div class="card-body">

                                <div class="form-outline mb-4">
{{--                                    <label class="form-label" for="form7Example4">Address</label>--}}
{{--                                    <select class="form-control" name="address" id="add">--}}
{{--                                        <option value="own">Own address</option>--}}
{{--                                        <option value="shipping">Type in the new address</option>--}}
{{--                                    </select>--}}

                                </div>
{{--                                <script>--}}
{{--                                    var trimm;--}}
{{--                                    $(document).ready(function(){--}}
{{--                                        $('#add').change(function(){--}}
{{--                                            trimm = $.trim(($(this).val() ));--}}
{{--                                            if(trimm == 'own'){--}}
{{--                                                $('#resss').hide();--}}
{{--                                            }--}}
{{--                                            if(trimm == 'shipping'){--}}
{{--                                                $('#resss').show();--}}
{{--                                            }--}}
{{--                                        });--}}
{{--                                    });--}}
{{--                                </script>--}}

{{--                                <div class="form-outline mb-4" id="resss" style="display: none" >--}}
                                <div class="form-outline mb-4" id="resss" style="" >
{{--                                    <label class="form-label" for="form7Example4">Shipping Address</label>--}}
                                    <input type="text"
                                           class="form-control{{ $errors->has('address1') ? ' is-invalid': '' }}"
                                           id="address1"
                                           name="address1" value="{{ old('address1') }}"
                                           autocomplete="address1">

                                </div>

                                <div class="row mb-4">
                                    <div class="col">
                                        <div class="form-outline">
                                            <label class="form-label" for="form7Example1">City</label>
                                            <input type="text"
                                                   class="form-control{{ $errors->has('city') ? ' is-invalid': '' }}"
                                                   id="city"
                                                   name="city"  value="{{ old('city') }}"
                                                   autocomplete="city">

                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-outline">
                                            <label class="form-label" for="form7Example2">State</label>
{{--                                            <div class="p-1 m-1 col">--}}
                                                <select id="state" required name="state" class="form-control">
                                                    <option value="">Select State</option>
                                                    @foreach($usStates as $state)
                                                        <option value="{{ $state }}">{{ $state }}</option>
                                                    @endforeach
                                                </select>
{{--                                            </div>--}}

                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-outline">
                                            <label class="form-label" for="form7Example2">Zip</label>

                                            <input type="number"
                                                   class="form-control{{ $errors->has('zipcode') ? ' is-invalid': '' }}"
                                                   id="zipcode" value="{{ old('zipcode') }}"
                                                   name="zipcode" onkeypress="return isNumberKey(event)"
                                                   autocomplete="zipcode" >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form7Example4">Expected Shipping date</label>
                                    <input type="date"
                                           class="form-control{{ $errors->has('expected_shipping_date') ? ' is-invalid': '' }}"
                                           id="expected_shipping_date"
                                           name="expected_shipping_date" required placeholder="MM-dd-YYYY" value="{{  date('m-d-Y' , strtotime( '+30 days'))   }}"
                                           autocomplete="expected_shipping_date">

                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form7Example7">Shipping Instructions</label>
                                    <textarea class="form-control" id="addInfo" name="shipping_instruction" rows="1">{{ old('shipping_instruction') }}</textarea>
                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form7Example7">Package Instruction</label>
                                    <textarea class="form-control" id="package" name="package_instruction" rows="1">{{ old('package_instruction') }}</textarea>
                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form7Example7">PO Number</label>
                                    <textarea class="form-control" id="addInfo" name="po_number" rows="1">{{ old('po_number') }}</textarea>
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form7Example7">Order Notes</label>
                                    <textarea class="form-control" id="addInfo" name="additionalInformation" rows="2">{{ old('additionalInformation') }}</textarea>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card mb-4">
                            <div class="card-header py-3">
                                <h5 class="mb-0">Summary</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                        Products
                                        <span>$  {{sprintf('%0.02f', $orderRequest->total)}} </span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                        Shipping
                                        <span>$ 0.00</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                        <div>
                                            <strong>Total amount</strong>
                                            <strong>
                                                <p class="mb-0"></p>
                                            </strong>
                                        </div>
                                        <span><strong>$ {{sprintf('%0.02f', $orderRequest->total)}}</strong></span>
                                    </li>
                                </ul>

                                <div class="p-6 bg-white border-b border-gray-200  ">
                                    <button class="btn btn-primary" style="background-color:  green;">
                                        Submit Request
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>


            @section('scripts')
                <script src="{{ asset('js/orderrequest/finalize.js') }}" defer></script>
                <script type="text/javascript">
                    function disablePrev() { window.history.forward() }

                    $(document).ready(function() {
                        window.onload = disablePrev();
                        window.onpageshow = function(evt) { if (evt.persisted) disableBack() }
                    });

                    window.onload =function(){
                        setInterval(function(){
                            disablePrev();
                        }, 1000);
                    };


                    function isNumberKey(evt) {
                        var charCode = (evt.which) ? evt.which : evt.keyCode
                        if (charCode > 31 && (charCode < 48 || charCode > 57))
                            return false;
                        return true;
                    }


                </script>
    @stop
</x-app-layout>
