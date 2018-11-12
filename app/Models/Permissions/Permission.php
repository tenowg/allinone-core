<?php

namespace App\Models\Permissions;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'name'
    ];

    public function granted() {
        return $this->hasMany('App\Models\Permissions\GrantedPermission', 'perm_id', 'id');
    }

    public function filters() {
        return $this->hasMany('App\Models\Permissions\PermissionFilter', 'group_id', 'id');
    }
}
