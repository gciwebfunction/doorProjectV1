<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Auth\Group;
use App\Models\Auth\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view()
    {
        return view('permission.view', ['permissions' => Permission::all()]);
    }

    public function getPermissionsForUser()
    {
        $user = auth()->user();

        return view('permission.viewuser', [
            'theuser' => $user,
            'all_permissions' => Permission::all()
        ]);
    }

    public function addPermissionToGroup($groupId)
    {
        dd(request()->all());
        $data = request()->all();
        $group = Group::findOrFail($groupId);

        $group->assignPermissions($data['new_permission']);

        return $this->getPermissionsForUser();
    }

}
