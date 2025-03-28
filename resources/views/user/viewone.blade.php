<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <form class=" g-3" action="/u/update" method="POST">
        @csrf

        <input type="hidden" class="" id="selectedUserType" name="selectedUserType" value="{{$usermodel->usertype}}">
        <input type="hidden" name="existingUserId" value="{{$usermodel->id}}">

        <div class="container py-4">
            <h4 style="text-align: center">User Details</h4>
            @if($usermodel->usertype=='sales')
                <p style="text-align: center; text-transform: capitalize; font-variant: small-caps; ">Sales User</p>
            @elseif($usermodel->usertype=='slsmgr')
                <p style="text-align: center; text-transform: capitalize; font-variant: small-caps; ">Sales Manager
                    User</p>
            @elseif($usermodel->usertype=='distributor')
                <p style="text-align: center; text-transform: capitalize; font-variant: small-caps; ">Distributor
                    User</p>
            @elseif($usermodel->usertype=='dealer')
                <p style="text-align: center; text-transform: capitalize; font-variant: small-caps; ">Dealer
                    User</p>
            @elseif($usermodel->usertype=='direct_dealer')
                <p style="text-align: center; text-transform: capitalize; font-variant: small-caps; ">Direct Dealer
                    User</p>
            @elseif($usermodel->usertype=='manufacturer')
                <p style="text-align: center; text-transform: capitalize; font-variant: small-caps; ">Manufacturer
                    User</p>
            @endif
            <hr/>
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="row flex m-3">
                    <span class="" role="alert" style="color: red">
                                        <strong>{{$error}}</strong>
                                    </span>
                    </div>
                @endforeach
            @endif
            @if(session('success'))
                <div class="alert alert-success">
                    {!! session('success') !!}
                </div>
            @endif

            <div class="container">
                <div class="row standardUser p-1 m-1">
                    <div class="col-1 mt-1">
                        <label for="email" class="form-label">Email</label>
                    </div>
                    <div class="col">
                        <input type="email"
                               readonly
                               class="form-control{{ $errors->has('email') ? ' is-invalid': '' }}"
                               id="email"
                               name="email"
                               autocomplete="email"
                               value="{{$usermodel->email}}">
                    </div>
                    <div class="col-1 mt-1">
                        <label for="name" class="form-label">Name</label>
                    </div>
                    <div class="col ">
                        <input type="text"
                               class="form-control{{ $errors->has('name') ? ' is-invalid': '' }}"
                               id="name"
                               name="name"
                               autocomplete="name"
                               value="{{$usermodel->name}}">
                    </div>
                </div>
                {{--                @if ($usermodel->usertype == 'distributor' || $usermodel->usertype == 'direct_dealer')--}}
                @if ($usermodel->usertype == 'distributor' )

                    <input type="hidden" name="associated_manufacturer" value="{{$usermodel->associated_manufacturer}}" >
                    {{--                    <div class="row  standardUser p-1 m-1">--}}
                    {{--                        <div class="col-4 mt-1">--}}
                    {{--                            <label for="associated_manufacturer" class="form-label">Associated Manufacturer</label>--}}
                    {{--                        </div>--}}
                    {{--                        <div class="col">--}}
                    {{--                            <select name="associated_manufacturer"--}}
                    {{--                                    class="form-select form-control">--}}
                    {{--                                @foreach($manufacturers as $manufacturer)--}}
                    {{--                                    @if($manufacturer)--}}
                    {{--                                        @if($manufacturer->id == $usermodel->associated_manufacturer)--}}
                    {{--                                            <option selected--}}
                    {{--                                                    value="{{$manufacturer->id}}">{{$manufacturer->name}}--}}
                    {{--                                                - {{$manufacturer->email}}</option>--}}
                    {{--                                        @else--}}
                    {{--                                            <option--}}
                    {{--                                                value="{{$manufacturer->id}}">{{$manufacturer->name}}--}}
                    {{--                                                - {{$manufacturer->email}}</option>--}}
                    {{--                                        @endif--}}
                    {{--                                    @endif--}}
                    {{--                                @endforeach--}}
                    {{--                            </select>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}

                @elseif ($usermodel->usertype=='direct_dealer')
                    <input type="hidden" name="associated_manufacturer" value="{{$usermodel->associated_manufacturer}}" >
                @elseif ($usermodel->usertype=='manufacturer')
                    {{--                    <div class="row  standardUser p-1 m-1">--}}
                    {{--                        <div class="col-2 mt-1">--}}
                    {{--                            <label for="name" class="form-label">User Info</label>--}}
                    {{--                        </div>--}}
                    {{--                        <div class="col mt-1">--}}
                    {{--                            <p>This is a manufacturer user and has editing limitations.</p>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                @endif

                @if($usermodel->usertype!='distributor' && $usermodel->usertype != 'manufacturer' && $usermodel->usertype != 'direct_dealer' &&  $usermodel->usertype!='sales_manager' &&  $usermodel->usertype!='sales' )
                    <div class="row  standardUser m-1 p-1 ">
                        <div class="col-4 mt-1">
                            <label for="selectedDistributor" class="form-label">Select Distributor</label>
                        </div>
                        <div class="col">



                            <select name="selectedDistributor"
                                    class="form-select form-control">
                                @foreach($distributors as $distributor)
                                    @if($distributor)
                                        @if($distributor->id == $usermodel->distributor_id)
                                            <option selected
                                                    value="{{$distributor->id}}">{{$distributor->name}}</option>
                                        @else
                                            <option
                                                    value="{{$distributor->id}}">{{$distributor->name}}</option>
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif

                @php
                    if($usermodel->usertype=='distributor'     ){
                @endphp
                <div class="row distributorUser m-1 p-1">
                    <div class="col-4 mt-1">
                        Distributor Name
                    </div>
                    <div class="col">
                        <input type="text" class="form-control"
                               name="distributorName" id="distributorName"
                               value="{{$contactinfo->distributor_name??old('distributorName')}}">
                    </div>
                </div>
                @php
                    }
                @endphp


                @php
                    if($usermodel->usertype=='distributor'  ||  $usermodel->usertype=='dealer'  || $usermodel->usertype=='manufacturer'  || $usermodel->usertype=='direct_dealer'   ){
                @endphp
                <div class="row   distributorUser m-1 p-1">
                    <div class="col-4 mt-1">
                        <label for="contactPerson" class="form-label">Contact Person</label>
                    </div>
                    <div class="col">
                        <input type="text"
                               class="form-control{{$errors->has('contactPerson')?' is-invalid': '' }}"
                               id="contactPerson"
                               name="contactPerson"
                               value="{{$contactinfo->primary_contact??old('contactPerson')}}">
                    </div>
                </div>
                @php
                    }
                @endphp

                <div class="row   distributorUser p-1 m-1">
                    <div class="col-4 mt-1">
                        <label for="contactPersonPhone" class="form-label">Contact Phone</label>
                    </div>
                    <div class="col">
                        <input type="tel"
                               class="form-control{{$errors->has('contactPersonPhone')?' is-invalid': '' }}"
                               id="contactPersonPhone"
                               name="contactPersonPhone"
                               value="{{$contactinfo->primary_phone??old('contactPersonPhone')}}">

                    </div>
                </div>
                @php
                    if($usermodel->usertype=='distributor'  ||  $usermodel->usertype=='dealer'  || $usermodel->usertype=='manufacturer'  || $usermodel->usertype=='direct_dealer'   ){
                @endphp
                <div class="row   distributorUser p-1 m-1">
                    <div class="col-4 mt-1">
                        <label for="contactPerson2" class="form-label">Alt. Contact Person</label>
                    </div>
                    <div class="col">
                        <input type="text"
                               class="form-control{{$errors->has('contactPerson2')?' is-invalid': '' }}"
                               id="contactPerson2"
                               name="contactPerson2"
                               value="{{$contactinfo->secondary_contact??old('contactPerson2')}}">
                    </div>
                </div>
                <div class="row   distributorUser p-1 m-1">
                    <div class="col-4 mt-1">
                        <label for="contactPersonPhone2" class="form-label">Alt. Contact Phone</label>
                    </div>
                    <div class="col">
                        <input type="tel"
                               class="form-control{{$errors->has('contactPersonPhone2')?' is-invalid': '' }}"
                               id="contactPersonPhone2"
                               name="contactPersonPhone2"
                               value="{{$contactinfo->secondary_phone??old('contactPersonPhone2')}}">
                    </div>
                </div>
                @php
                    }
                @endphp

                <div class="row   distributorUser p-1 m-1">
                    <div class="col-4 mt-1">
                        <label for="contactPersonPhone2" class="form-label">New Password<span style="color: red">&nbsp;*&nbsp;</span></label>
                    </div>
                    <div class="col">
                        <input type="tel" required
                               class="form-control"
                               id="password"
                               name="password"
                               value="">
                    </div>
                </div>


                @php
                    if($usermodel->usertype=='distributor'  ||  $usermodel->usertype=='dealer'  || $usermodel->usertype=='manufacturer'  || $usermodel->usertype=='direct_dealer'   ){
                @endphp
                {{--                <div class="container py-4 d-none standardUser"--}}
                {{--                     style="max-width:700px; border: 1px solid lightgray" id="physical_address_div" >--}}
                <div class="row  standardUser m-1 p-1 ">
                    <fieldset style="width: 100%">
                        <h5>Physical Address</h5>
                        <hr/>
                        <div class="row distributorUser m-1 p-1">
                            <div class="col">
                                <label class="form-label" for="address">Address<span style="color: red">&nbsp;*&nbsp;</span></label>
                            </div>
                            <div class="col">
                                <input type="text" id="physical_address" required
                                       class="form-control{{$errors->has('physical_address')?' is-invalid':''}}"
                                       name="physical_address"
                                       value="{{$physiaclAddres[0]['address'] ?? ''}}" placeholder="">
                                {{--                                name="address" value="{{old('address')}}" placeholder="123 Main St.">--}}
                            </div>
                        </div>
                        <div class="row distributorUser m-1 p-1">
                            <div class="col">
                                <label class="form-label" for="physical_address2">Address line 2</label>
                            </div>
                            <div class="col">
                                <input type="text" id="physical_address2"
                                       class="form-control{{$errors->has('physical_address2')?' is-invalid':''}}"
                                       name="physical_address2"
                                       value="{{$physiaclAddres[0]['address2'] ?? ''}}"
                                       placeholder="">
                                {{--                        Apt / Suite #--}}
                            </div>
                        </div>

                        <div class="row distributorUser m-1 p-1">
                            <div class="col">
                                <label class="form-label" for="physical_city">City<span style="color: red">&nbsp;*&nbsp;</span></label>
                            </div>
                            <div class="col">
                                <input type="text" id="physical_city"
                                       class="form-control{{$errors->has('physical_city')?' is-invalid':''}}"
                                       name="physical_city"
                                       value="{{$physiaclAddres[0]['city'] ?? ''}}" >

                                {{--               value="{{$physiaclAddres[0]['city']}}" >         placeholder="Cityville"--}}
                            </div>
                        </div>
                        <div class="row distributorUser m-1 p-1">
                            <div class="col">
                                <label class="form-label" for="state">State</label>
                            </div>
                            <div class="col">
                                <select id="physical_state" name="physical_state"
                                        class="form-control{{$errors->has('physical_state')?' is-invalid':''}}">
                                    @foreach($usStates as $state)
                                        <option value="{{$state}}"
                                                @php


                                                    if ( !empty ( $physiaclAddres[0]['state'])  &&  (trim($physiaclAddres[0]['state'] ) == trim($state)) ) {
                                                            echo "selected" ;
                                                    }

                                                @endphp
                                        >{{ $state }}</option>
                                    @endforeach
                                    <option value="Taxes">Taxes</option>
                                </select>
                            </div>
                        </div>

                        <div class="row distributorUser m-1 p-1">
                            <div class="col">
                                <label class="form-label" for="physical_zip">Zip Code<span style="color: red">&nbsp;*&nbsp;</span></label>
                            </div>
                            <div class="col">
                                <input type="text" id="physical_zip" required
                                       class="form-control{{$errors->has('physical_zip')?' is-invalid':''}}"
                                       name="physical_zip"
                                       value="{{$physiaclAddres[0]['postal_code']?? ''}}"
                                >
                                {{--                        placeholder="12345-1234"--}}
                            </div>
                        </div>
                    </fieldset>
                </div>


                <fieldset>
                    <legend>Shipping Address
                        <label class="form-label" for="same_phy" style="font-size: 12px">Same As Physical</label>
                        <input type="checkbox"   name="same_phy" id="same_phy"  />
                    </legend>
                    <div class="row distributorUser p-1 m-1">
                        <div class="col-3 mt-1">
                            <label for="address" class="form-label">Address</label>
                        </div>
                        <div class="col">
                            <input type="text"
                                   class="form-control{{$errors->has('address')?' is-invalid':''}}"
                                   id="address"
                                   name="address"
                                   placeholder="1234 Main St"
                                   value="{{$usermodel->address->address??old('address')}}">
                        </div>
                    </div>
                    <div class="row distributorUser m-1 p-1">
                        <div class="col-3 mt-1">
                            <label for="address2" class="form-label">Address 2</label>
                        </div>
                        <div class="col">
                            <input type="text"
                                   class="form-control{{$errors->has('address2')?' is-invalid':''}}"
                                   id="address2"
                                   name="address2"
                                   placeholder="Suite #123B"
                                   value="{{$usermodel->address->address2??old('address2')}}">
                        </div>
                    </div>
                    <div class="row distributorUser m-1 p-1">
                        <div class="col-1 mt-1">
                            <label for="inputCity" class="form-label">City</label>
                        </div>
                        <div class="col-3">
                            <input type="text" class="form-control" id="inputCity" name="inputCity"
                                   value="{{$usermodel->address->city??old('inputCity')}}">
                        </div>
                        <div class="col-1 mt-1">
                            <label for="state" class="form-label">State</label>
                        </div>
                        <div class="col">
                            <select id="state" name="state" class="form-select form-control">
                                @foreach($usStates as $state)
                                    @if(trim($state) == trim($usermodel->address->state))
                                        <option selected value="{{$state}}">{{$state}}</option>
                                    @else
                                        <option value="{{$state}}">{{$state}}</option>
                                    @endif
                                @endforeach
                                <option value="Taxes">Taxes</option>
                            </select>
                        </div>
                        <div class="col-1 mt-1">
                            <label for="inputZip" class="form-label">Zip</label>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" id="inputZip" name="inputZip"
                                   value="{{$usermodel->address->postal_code}}">
                        </div>
                    </div>
                </fieldset>
                @php
                    }

                @endphp
            </div>

        </div>

        <div class="row bottom-button-bar">
            <div class="col">
                <button class="btn btn-primary" id="saveUserUpdatesButton">Save User Updates</button>
            </div>
        </div>
    </form>
    @section('scripts')
        <script>
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
            window.onload = function () {


            }
        </script>
    @stop
</x-app-layout>
