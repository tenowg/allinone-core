<?php

namespace App\Models\Permissions;

use Illuminate\Database\Eloquent\Model;

class GrantedPermission extends Model
{
    protected $fillable = [
        'perm_id',
        'permission'
    ];
}
