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
                        <label for="password" class="form-label">Password<span style="color: red">&nbsp;*&nbsp;</span></label>
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
                        <label for="passwordConfirm" class="form-label">Password Confirmation</label>
                    </div>
                    <div class="col">
                        <input type="password"
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
                <div class="row p-1 m-1">
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
                <div class="row p-1 m-1 ">
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
                <div class="row p-1 m-1 ">
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
                <div class="row p-1 m-1 ">
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
            </div>

            <div class="container py-4 d-none standardUser"
                 style="max-width:700px; border: 1px solid lightgray">
                <h5>Shipping Address</h5>
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
                        <label class="form-label" for="address2">Address 2</label>
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
                        <label class="form-label" for="inputCity">City</label>
                    </div>
                    <div class="col">
                        <input type="text" id="inputCity"
                               class="form-control{{$errors->has('inputCity')?' is-invalid':''}}"
                               name="inputCity" value="{{old('inputCi ty')}}" >
{{--                        placeholder="Cityville"--}}
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
    @stop
</x-app-layout>
