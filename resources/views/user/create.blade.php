<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="container py-4">

        <form class=" g-3" action="/u" method="POST">
            @csrf

            <div class="row p-1 m-1">
                <div class="col">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="selectUserType" class="form-label">Type of user to create...</label>
                </div>
                <div class="col">
                    <input type="hidden" value="{{old('selectedUserType')}}"
                           id="selectedUserTypeHidden">
                    <select class="form-select form-control" aria-label="User Creation" id="selectUserType"
                            name="selectedUserType">
                        <option class="userTypeEmptySelector" selected="selected">Select a user
                            type...
                        </option>
                        @permission('c_distributor')
                        <option id="distributorSelector" value="distributor">Create a distributor user
                        </option>
                        @endpermission
                        @permission('c_dealer')
                        <option id="dealerSelector" value="dealer">Create a dealer user</option>
                        @endpermission
                        @permission('c_dealer')
                        <option id="directdealerSelector" value="direct_dealer">Create a direct dealer user</option>
                        @endpermission
                        @permission('c_sales_manager')
                        <option id="salesManagerSelector" value="sales_manager">Create a sales manager
                            user
                        </option>
                        @endpermission
                        @permission('c_sales_user')
                        <option id="salesSelector" value="sales">Create a sales user</option>
                        @endpermission

                        {{--                        @permission('c_manuf_user')--}}
                        @php  if($user_own_type == 'manufacturer'){ @endphp
                        <option id="manufacturerSelector" value="manufacturer">Create a manufacturer user </option>
                        @php } @endphp
                        {{--                        @endpermission--}}
                    </select>
                </div>
            </div>

            <div class="row  notADistributor m-1 p-1 d-none">
{{--                <div class="col-4 mt-1">--}}
                <div class="col">
                    <label for="selectedDistributor" class="form-label">Select Distributor</label>
                </div>
                <div class="col">
{{--                    <select name="selectedDistributor" id="selectedDistributor"--}}
                        <select name="distributor_id" id="selectedDistributor"
                            class="form-select form-control">
                        @foreach($distributors as $distributor)
                            @if($distributor)
                                    <option value="{{$distributor->id}}">{{$distributor->name}}</option>
{{--                                <option value="{{$distributor->id}}-{{$distributor->name}}">{{$distributor->name}}</option>--}}
                                

                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row  notAManufacturere m-1 p-1 d-none">
{{--                <div class="col-4 mt-1">--}}
                <div class="col">
                    <label for="selectedManufacturer" class="form-label">Select Manufacturer</label>
                </div>
                <div class="col">
                    <select name="selectedManufacturer" id="selectedManufacturer"
                            class="form-select form-control">
                        @foreach($manufactureres as $manufacturer)
                            @if($manufacturer)
                                <option value="{{$manufacturer->id}}">{{$manufacturer->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>



            <div class="container py-4 standardUser d-none"
                 style="max-width: 700px; border:1px solid lightgray">
                <h5>Basic Info</h5>
                <hr/>
                <div class="row p-1 m-1">
                    <div class="col">
                        <label for="email" class="form-label">Email (This is your login)<span style="color: red">&nbsp;*&nbsp;</span></label>
                    </div>
                    <div class="col">
                        <input type="email" required
                               class="form-control{{ $errors->has('email') ? ' is-invalid': '' }}"
                               id="email"
                               name="email"
                               value="{{old('email')}}"
                               autocomplete="email">
                    </div>
                </div>
                <div class="row p-1 m-1">
                    <div class="col">
                        <label for="name" class="form-label">Name<span style="color: red">&nbsp;*&nbsp;</span></label>
                    </div>
                    <div class="col">
                        <input type="text" required
                               class="form-control{{ $errors->has('name') ? ' is-invalid': '' }}"
                               id="name"
                               name="name"
                               value="{{old('name')}}"
                               autocomplete="name">
                    </div>
                </div>
                <div class="row p-1 m-1">
                    <div class="col">
                        <label for="password" class="form-label">Password<span style="color: red">&nbsp;*&nbsp;</span>
                        </label>

                        <ul>
                            <li>must be of 8 characters in length</li>
                            <li>must contain at least one lowercase letter</li>
                            <li>must contain at least one uppercase letter</li>
                            <li>must contain at least one digit</li>

                        </ul>

                    </div>
                    <div class="col">
                        <input type="password" required
                               class="form-control"
                               id="password"
                               name="password">
                    </div>
                </div>
                <div class="row p-1 m-1">
                    <div class="col">
                        <label for="passwordConfirm" class="form-label">Password Confirmation<span style="color: red">&nbsp;*&nbsp;</span></label>
                    </div>
                    <div class="col">
                        <input type="password" required
                               class="form-control"
                               id="password_confirmation"
                               name="password_confirmation">
                    </div>
                </div>
            </div>

            <div class="container py-4 standardUser d-none"
                 style="border:1px solid lightgray;max-width: 700px;">
                <h5><span class="title_user_type"></span> Information</h5>
                <hr/>
                <div class="row p-1 m-1"  id="name_div">
                    <div class="col">
                        <label for="distributorName" class="form-label"><span class="title_user_type"></span> Name</label>
                    </div>
                    <div class="col">
                        <input type="text"
                               class="form-control{{ $errors->has('distributorName') ? ' is-invalid': '' }}"
                               id="distributorName"
                               name="distributorName"
                               value="{{old('distributorName')}}"
                               autocomplete="distributorName">
                    </div>
                </div>
                <div class="row p-1 m-1 " id="contact_person_div">
                    <div class="col">
                        <label for="contactPerson" class="form-label">Contact Person</label>
                    </div>
                    <div class="col">
                        <input type="text"
                               class="form-control{{$errors->has('contactPerson')?' is-invalid': '' }}"
                               id="contactPerson"
                               name="contactPerson"
                               value="{{old('contactPerson')}}">
                    </div>
                </div>
                <div class="row p-1 m-1 ">
                    <div class="col">
                        <label for="contactPersonPhone" class="form-label">Contact Phone<span style="color: red">&nbsp;*&nbsp;</span></label>
                    </div>
                    <div class="col">
                        <input type="tel" required
                               class="form-control{{$errors->has('contactPersonPhone')?' is-invalid': '' }}"
                               id="contactPersonPhone"
                               name="contactPersonPhone"
                               value="{{old('contactPersonPhone')}}">
                    </div>
                </div>
                <div class="row p-1 m-1 " id="all_contact_div">
                    <div class="col">
                        <label for="contactPerson2" class="form-label">Alt. Contact Person</label>
                    </div>
                    <div class="col">
                        <input type="text"
                               class="form-control{{$errors->has('contactPerson2')?' is-invalid': '' }}"
                               id="contactPerson2"
                               name="contactPerson2"
                               value="{{old('contactPerson2')}}">
                    </div>
                </div>
                <div class="row p-1 m-1 " id="all_contact_phone">
                    <div class="col">
                        <label for="contactPersonPhone2" class="form-label">Alt. Contact Phone</label>
                    </div>
                    <div class="col">
                        <input type="tel"
                               class="form-control{{$errors->has('contactPersonPhone2')?' is-invalid': '' }}"
                               id="contactPersonPhone2"
                               name="contactPersonPhone2"
                               value="{{old('contactPersonPhone2')}}">
                    </div>
                </div>

                    <div id="new_dealer_fields" style="display: none;">
                {{-- new fields for the dealer starts --}}
                <div class="row p-1 m-1 ">
                    <div class="col">
                        <label for="credit_limit" class="form-label">Credit Limit</label>
                    </div>
                    <div class="col">
                        <input type="text"
                               class="form-control{{$errors->has('credit_limit')?' is-invalid': '' }}"
                               id="credit_limit"
                               name="credit_limit"
                               value="{{old('credit_limit')}}">
                    </div>
                </div>
                <div class="row p-1 m-1 ">
                    <div class="col">
                        <label for="payment_term" class="form-label">Payment Term</label>
                    </div>
                    <div class="col">
                        <input type="text"
                               class="form-control{{$errors->has('payment_term')?' is-invalid': '' }}"
                               id="payment_term"
                               name="payment_term"
                               value="{{old('payment_term')}}">
                    </div>
                </div>

                <div class="row p-1 m-1 ">
                    <div class="col">
                        <label for="primary_fax" class="form-label">Fax 1</label>
                    </div>
                    <div class="col">
                        <input type="text"
                               class="form-control{{$errors->has('primary_fax')?' is-invalid': '' }}"
                               id="primary_fax"
                               name="primary_fax"
                               value="{{old('primary_fax')}}">
                    </div>
                </div>

                <div class="row p-1 m-1 ">
                    <div class="col">
                        <label for="secondary_fax" class="form-label">Fax 2</label>
                    </div>
                    <div class="col">
                        <input type="text"
                               class="form-control{{$errors->has('secondary_fax')?' is-invalid': '' }}"
                               id="secondary_fax"
                               name="secondary_fax"
                               value="{{old('secondary_fax')}}">
                    </div>
                </div>
                </div>
                {{-- new fields for the dealer ends --}}




            </div>


            <div class="container py-4 d-none standardUser"
                 style="max-width:700px; border: 1px solid lightgray" id="physical_address_div" >
                <h5>Physical Address</h5>
                <hr/>
                <div class="row">
                    <div class="col">
                        <label class="form-label" for="address">Address<span style="color: red">&nbsp;*&nbsp;</span></label>
                    </div>
                    <div class="col">
                        <input type="text" id="physical_address" required
                               class="form-control{{$errors->has('physical_address')?' is-invalid':''}}"
                               name="physical_address"
                               value="{{old('physical_address')}}" placeholder="">
                        {{--                                name="address" value="{{old('address')}}" placeholder="123 Main St.">--}}
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label class="form-label" for="physical_address2">Address line 2</label>
                    </div>
                    <div class="col">
                        <input type="text" id="physical_address2"
                               class="form-control{{$errors->has('physical_address2')?' is-invalid':''}}"
                               name="physical_address2"
                               value="{{old('physical_address2')}}"
                               placeholder="" >
                        {{--                        Apt / Suite #--}}
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label class="form-label" for="physical_city">City<span style="color: red">&nbsp;*&nbsp;</span></label>
                    </div>
                    <div class="col">
                        <input type="text" id="physical_city"
                               class="form-control{{$errors->has('physical_city')?' is-invalid':''}}"
                               name="physical_city" value="{{old('physical_city')}}" >
                        {{--                        placeholder="Cityville"--}}
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label class="form-label" for="state">State</label>
                    </div>
                    <div class="col">
                        <select id="physical_state" name="physical_state"
                                class="form-control{{$errors->has('physical_state')?' is-invalid':''}}">
                            @foreach($usStates as $state)
                                <option value="{{ $state }}">{{ $state }}</option>
                            @endforeach
                            <option value="Taxes">Taxes</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label class="form-label" for="physical_zip">Zip Code<span style="color: red">&nbsp;*&nbsp;</span></label>
                    </div>
                    <div class="col">
                        <input type="text" id="physical_zip" required
                               class="form-control{{$errors->has('physical_zip')?' is-invalid':''}}"
                               name="physical_zip" value="{{old('physical_zip')}}" >
                        {{--                        placeholder="12345-1234"--}}
                    </div>
                </div>
            </div>


            <div class="container py-4 d-none standardUser"
                 style="max-width:700px; border: 1px solid lightgray" id="shipping_address_div" >
                <h5>Shipping Address
                    <label class="form-label" for="same_phy" style="font-size: 12px">Same As Physical</label>
                    <input type="checkbox"   name="same_phy" id="same_phy"  />
                </h5>
                <hr/>
                <div class="row">
                    <div class="col">
                        <label class="form-label" for="address">Address<span style="color: red">&nbsp;*&nbsp;</span></label>
                    </div>
                    <div class="col">
                        <input type="text" id="address" required
                               class="form-control{{$errors->has('address')?' is-invalid':''}}"
                               name="address" value="{{old('address')}}" placeholder="">
{{--                                name="address" value="{{old('address')}}" placeholder="123 Main St.">--}}
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label class="form-label" for="address2">Address line 2</label>
                    </div>
                    <div class="col">
                        <input type="text" id="address2"
                               class="form-control{{$errors->has('address2')?' is-invalid':''}}"
                               name="address2" value="{{old('address2')}}" placeholder="">
{{--                        Apt / Suite #--}}
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label class="form-label" for="inputCity">City<span style="color: red">&nbsp;*&nbsp;</span></label>
                    </div>
                    <div class="col">
                        <input type="text" id="inputCity"
                               class="form-control{{$errors->has('inputCity')?' is-invalid':''}}"
                               name="inputCity" value="{{old('inputCity')}}" >
{{--                        placeholder="Cityville"--}}
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label class="form-label" for="state">State</label>
                    </div>
                    <div class="col">
                        <select id="state" name="state"
                                class="form-control{{$errors->has('state')?' is-invalid':''}}">
                            @foreach($usStates as $state)
                                <option value="{{ $state }}">{{ $state }}</option>
                            @endforeach
                            <option value="Taxes">Taxes</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label class="form-label" for="inputZip">Zip Code<span style="color: red">&nbsp;*&nbsp;</span></label>
                    </div>
                    <div class="col">
                        <input type="text" id="inputZip" required
                               class="form-control{{$errors->has('inputZip')?' is-invalid':''}}"
                               name="inputZip" value="{{old('inputZip')}}" >
{{--                        placeholder="12345-1234"--}}
                    </div>
                </div>
            </div>

            @permission('c_user')
            <div class="row bottom-button-bar standardUser d-none" role="alert">
                <div class="col">
                    <button class="btn btn-primary" type="submit">Create User</button>
                </div>
            </div>
            @endpermission
        </form>
    </div>

    @section('scripts')
                <script type="text/javascript" src="{{ asset('js/user/utility.js') }}" ></script>
{{--        <script type="text/javascript" src="{{ asset('js/user/utility.js') }}" defer></script>--}}
        <script>
            // $('#same_phy').click(function(){
            //     alert('adadad');
            // });

            $(document).ready(function(){
                $("#same_phy").on("click", function(){
                    if (this.checked) {
                        $("#address").val($("#physical_address").val());
                        $("#address2").val($("#physical_address2").val());
                        $("#state").val($("#physical_state").val());
                        $("#inputCity").val($("#physical_city").val());
                        $("#inputZip").val($("#physical_zip").val());
                    }
                    else {
                        $("#address").val('');
                        $("#address2").val('');
                        $("#state").val('');
                        $("#inputCity").val('');
                        $("#inputZip").val('');
                    }
                });
            });



        </script>
    @stop
</x-app-layout>
