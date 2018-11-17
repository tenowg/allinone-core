<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ViewModels\PermissionDefinitions\Permissions;
use App\Http\Requests\CreatePermissionGroup;
use App\Models\Permissions\Permission;
use App\Http\Requests\SavePermissionsGroup;
use App\Http\Requests\SetUserPermissions;
use App\Models\Permissions\GrantedPermission;
use App\Models\Permissions\UserPermission;

use App\User;

class PermissionsController extends Controller
{
    public function listAllPermissions(Permissions $perms) {
        return $perms->permissions;
    }

    public function createPermissionGroup(CreatePermissionGroup $request) {
        $validated = $request->validated();

        $perm = Permission::create($validated)->refresh('granted');
        $corporations = [];
        $alliances = [];
        $filters = new \stdClass();
        $filters->corporations = $corporations;
        $filters->alliances = $alliances;
        $perm->filters = $filters;

        return $perm;
    }

    public function savePermissionGroup(SavePermissionsGroup $request) {
        $request->validated();
        $group = Permission::find($request->id);
        $granteds = [];
        foreach($request->granted as $granted) {
            GrantedPermission::firstOrCreate(['perm_id' => $group->id, 'permission' => $granted['permission']]);
            array_push($granteds, $granted['permission']);
        }
        GrantedPermission::where('perm_id', $request->id)->whereNotIn('permission', $granteds)->delete();
        return $group;
    }

    public function saveUserPermissions(SetUserPermissions $request, User $user) {
        $val = $request->validated();
        $perms_id = [];
        foreach($val['permissions'] as $perm) {
            array_push($perms_id,  UserPermission::updateOrCreate(['user_id' => $user->id, 'perm_id' => $perm['id']])->id);
        }
        UserPermission::where('user_id' , $user->id)->whereNotIn('id', $perms_id)->delete();
        return [];
    }

    public function listAllGroups() {
        $groups = Permission::with('granted')->get()->toArray();
        foreach ($groups as &$group) {
            $corporations = [];
            $alliances = [];
            $filters = new \stdClass();
            $filters->corporations = $corporations;
            $filters->alliances = $alliances;
            $group['filters'] = $filters;
            $group['inverse'] = $filters;
        }
        return $groups;
    }
}
