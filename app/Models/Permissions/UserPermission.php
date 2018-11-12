<?php

namespace App\Models\Permissions;

use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    protected $fillable = [
        'user_id',
        'perm_id'
    ];

    public function user() {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function permissions() {
        return $this->hasOne('App\Models\Permissions\Permission', 'id', 'perm_id');
    }
}
