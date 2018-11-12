<?php

namespace App\Models\Permissions;

use Illuminate\Database\Eloquent\Model;

class PermissionFilter extends Model
{
    protected $fillable = [
        'group_id', // The Permission Group (Permission)
        'type',     // The type of filter (alliance, corporation, user)
        'type_id',  // The id of the type that this filter is associated with
        'inverse'   // the inverse or nevative (exclusion)
    ];
}
