<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permission Management') }}
        </h2>
    </x-slot>

    <div class="container py-4">
        <h4>User Details</h4>
        <table class="table table-striped">
            <tbody>
            <tr>
                <td>Email:</td>
                <td>{{$theuser->email}}</td>
                <td>Username:</td>
                <td>{{$theuser->name}}</td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="container py-4">
        @foreach($theuser->groups as $group)
            @if(isset($group))

                <div class="row mb-5">
                    <div class="col-1"></div>
                    <div class="col p-1 m-1">Groupname:</div>
                    <div class="col  p-1 m-1">{{$group->name}}</div>
                </div>

                <form id="addPermissionForm" method="post" action="/perm/add/{{$group->id}}">
                    <div class="row flex mb-2">
                        <div class="col-1"></div>
                        <div class="col p-1 m-1">Add permission to group</div>
                        <div class="col p-1 m-1">
                            <select name="new_permission">
                                @foreach($all_permissions as $p)
                                    <option value="{{$p->id}}">{{$p->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row flex mb-2">
                        <div class="col-1"></div>
                        <div class="col p-1 m-1"></div>
                        <div class="col p-1 m-1">
                            <button id="addPermission" class="button button-primary" type="submit">Save Permission</button>
                        </div>
                    </div>
                </form>
                <table id="permissionTable" class="table table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Permission</th>
                        <th>Slug</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($group->permissions as $permission)
                        <tr>
                            <td class="alert-danger">
                                <div data-bs-toggle="modal"
                                     data-bs-target="#removePermissionFromGroup{{$permission->id}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#FF0000"
                                         class="bi bi-x" viewBox="0 0 16 16">
                                        <path
                                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                    </svg>
                                </div>
                                <div class="modal" id="removePermissionFromGroup{{$permission->id}}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Remove permission from group</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to remove the permission {{$permission->name}}
                                                    from the group {{$group->name}}?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Cancel
                                                </button>
                                                <button type="button" class="btn btn-primary"
                                                        onclick="removePermissionFromGroup({{$permission->id}},{{$group->id}})">
                                                    Remove permission
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>{{$permission->name}}</td>
                            <td>{{$permission->slug}}</td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            @endif
        @endforeach
    </div>

    @section('scripts')
        <script src="{{ asset('js/permission/viewuser.js') }}" defer></script>
    @stop
</x-app-layout>
