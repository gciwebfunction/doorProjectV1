<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="container py-4">
        <div style="float: left;"><h5>User Management</h5></div>
        @permission('c_user')
        <div style="float: right;">

                <div class="col">
                    <button class="btn btn-primary" onclick="window.location='{{route('ucreate')}}'">
                        Create a new user
                    </button>
                </div>

        </div>
        @endpermission


        @if (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
{{--        @if(Session::has('success'))--}}
{{--            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>--}}
{{--        @endif--}}



    @if (Session::has('error'))
            <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif


        <table class="table table-striped" id="userTable" style="width: 100%">
            <thead>
            <th>Name</th>
            <th>Email</th>
            <th>User Type</th>
            <th class="text-center">Disabled </th>
            <th> Edit</th>
            </thead>
            @foreach($detailedusers as $detaileduser)
                <tr class="" style="cursor: pointer">
                    <td class="d-none">{{$detaileduser->id}}</td>
                    <td>{{$detaileduser->name}}</td>
                    <td>{{$detaileduser->email}}</td>

                    @if ($detaileduser->usertype == 'manufacturer')
                        <td class="table-cell">
                            <span style="color: red">{{$detaileduser->usertype}}</span>
                        </td>
                    @else
                        <td>
                            {{$detaileduser->usertype}}
                        </td>
                    @endif

                    @if ($detaileduser->disabled == 1)
                        <td class="table-cell disabled-indicator text-center">
                            <span style="color: red">DISABLED</span>
                        </td>
                    @else
                        <td class="table-cell disabled-indicator text-center">
                            <span style="color: green;">ENABLED</span>
                        </td>
                    @endif
                    <td class="table-cell text-center">
                        <span style="color: green;">EDIT</span>
                    </td>
                </tr>
            @endforeach

        </table>
    </div>



    @section('scripts')
        <script src="{{ asset('js/user/view.js') }}" defer></script>
    @stop
</x-app-layout>
