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
                <div class="row   distributorUser p-1 m-1">
                    <div class="col-4 mt-1">
                        <label for="contactPersonPhone2" class="form-label">New Password</label>
                    </div>
                    <div class="col">
                        <input type="tel"
                               class="form-control"
                               id="password"
                               name="password"
                               value="">
                    </div>
                </div>


                <fieldset>
                    <legend>Shipping Address</legend>
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
                                        <option selected value="{{ $state }}">{{ $state }}</option>
                                    @else
                                        <option value="{{ $state }}">{{ $state }}</option>
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
            window.onload = function () {


            }
        </script>
    @stop
</x-app-layout>
